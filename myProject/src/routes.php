<?php
// Routes
$app->get('/logout',function($request,$response){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']=== true){
            session_unset();//free all session variable
            session_destroy();//
            return $this->response->withStatus(200);
        }else{
           return $this->response->withStatus(400);
        }
        
        });
$app->post('/signin',function($request,$response){

		$input = $request->getBody();
		$input = json_decode($input, true); 
		$pass = md5($input["password"]);
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND pass = :password");
		$stmt->bindValue(':username',$input["username"],PDO::PARAM_STR);
		$stmt->bindValue(':password',$pass,PDO::PARAM_STR);
		$stmt->execute();
		$userInfo = $stmt->fetchAll();
		if(!empty($userInfo)){
			session_start();
			$_SESSION["login"] = true;
		}
		else{
			return $this->response->withStatus(400);
		}
		return $this->response->withJson($userInfo);
	
});  

$app->post('/signup',function($request,$response){
		session_start();
		if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
			return $this->response->withStatus(201);
		}
		else{
			$input = $request->getBody();
						//$input = $request->getParsedBody();
			$input = json_decode($input, true); 
		    $stmt = $this->db->prepare("INSERT into users(username,pass,email,phone) VALUES (:username, :password,:email,:phone)");
			$pass = $input["password"];
			$pass = md5($pass);
			$stmt->bindValue(':username', $input["username"],PDO::PARAM_STR);
			$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
			$stmt->bindValue(':email', $input["email"], PDO::PARAM_STR);
			$stmt->bindValue(':phone', $input["phone"], PDO::PARAM_INT);
			try{
				$stmt->execute();
			}
			catch(PDOException $e){
					return $this->response->withStatus(400);
			}
			$to = $input["email"];
			$subject = "My subject";
			$txt = "Hello world!";
			$headers = "From:Eduexchange";
			mail($to,$subject,$txt,$headers,"-feduexchange@smu.edu");    
			return $this->response->withStatus(200);      
		}
});

$app->get('/listings/[{id}]',function($request,$response,$arg){
	$id= $arg["id"];
	$stmt= $this->db->prepare( "SELECT * FROM (SELECT id, description, title, uploader_id, price, class, stat, type, cover, upload_date FROM textbooks WHERE uploader_id = :id UNION ALL SELECT id, description, title, uploader_id, price, class, stat, type ,cover, upload_date FROM supplies WHERE uploader_id = :id UNION ALL SELECT id, description, title, uploader_id, price, class, stat, type, cover, upload_date FROM notes WHERE uploader_id = :id) AS searched ORDER BY price");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	 try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $listing = $stmt->fetchAll();
    return $this->response->withJson($listing);    
    });
$app->get('/saledtextbooks/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$stmt=$this->db->prepare("SELECT * FROM textbooks WHERE uploader_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	 try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);        }
    $listing = $stmt->fetchAll();
    return $this->response->withJson($listing);
    });
$app->get('/saledtexnotes/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$stmt=$this->db->prepare("SELECT * FROM notes WHERE uploader_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	 try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $listing = $stmt->fetchAll();
    return $this->response->withJson($listing);
});
$app->get('/saledsupplies/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$stmt=$this->db->prepare("SELECT * FROM supplies WHERE uploader_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	 try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $listing = $stmt->fetchAll();
    return $this->response->withJson($listing);
});

$app->get('/user/[{id}]', function($request,$response,$arg){
	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT username, email, phone, avatar, rating, joined_date FROM users WHERE userID = :id");
	$stmt->bindValue(':id',$id, PDO::PARAM_INT);
	  try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $user = $stmt->fetchAll();
    return $this->response->withJson($user);
});

$app->post('/user/[{id}]',function($request,$response,$arg){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
    	$stmt = $this->db->prepare("UPDATE users SET 
        email = COALESCE(:email, email),
        phone = COALESCE(:phone, phone),
        rating = COALESCE(:rating, rating),
        avatar = COALESCE(:avatar,avatar),
        username = COALESCE(:username,username)
		WHERE userID=:id");
		$stmt->bindValue(':email',$request["email"],PDO::PARAM_STR);
		$stmt->bindValue(':phone',$request["phone"],PDO::PARAM_STR);
		$stmt->bindValue(':rating',$request[":rating"],PDO::PARAM_STR);
		$stmt->bindValue(':avatar',$request["avatar"],PDO::PARAM_STR);
		$stmt->bindValue(':username',$request["username"],PDO::PARAM_STR);
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        	$stmt->execute();
        	}
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        	}  
        	return $this->response->withStatus(200);	
        }else{
    		return $this->response->withStatus(401);
    	}
	
});
$app->get('/textbooks',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY title");
    try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $textbooks = $stmt->fetchAll();
    return $this->response->withJson($textbooks);
});

$app->get('/textbooks/[{id}]',function($request,$response,$arg){
	
	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT * FROM textbooks WHERE id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	$textbook = $stmt->fetchAll();
	return $this->response->withJson($textbook);
});



$app->post('/textbooks',function($request,$response){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] === true){
    	$input = $request->getBody();
		$input = json_decode($input,true);
		$stmt = $this->db->prepare("INSERT INTO textbooks (title, description,price,class,uploader_id, stat, cover) VALUES ( :title, :description, :price, :class, :uploader_id, :stat, :cover)");
		$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
		$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
		$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
		$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
		$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
		$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		$stmt->bindValue(':cover', $input["cover"],PDO::PARAM_STR);
			try{
        		$stmt->execute();
        	}
        	catch(PDOException $e){
        		return $this->response->withStatus(400);
        	}
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
		
	});


$app->post('/textbooks/[{id}]',function($request,$response,$arg){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
		$input = $request->getBody();
		$input = json_decode($input,true);
		$stmt = $this->db->prepare("UPDATE textbooks SET 
        title = COALESCE(:title, title),
        description = COALESCE(:description, description),
        price = COALESCE(:price, price),
        class = COALESCE(:class,class),
        uploader_id = COALESCE(:uploader_id,uploader_id),
        cover = COALESCE(:cover,cover)
		WHERE id=:id");
		$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
		$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
		$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
		$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
		$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
		$stmt->bindValue(':cover',$input["cover"],PDO::PARAM_STR);
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        		$stmt->execute();
        	}
        	catch(PDOException $e){
        			return $this->response->withStatus(400);
        	}
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	
});



$app->delete('/textbooks/[{id}]',function($request,$response,$arg){

	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
		$stmt = $this->db->prepare("DELETE FROM textbooks WHERE id = :id");
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        		$stmt->execute();
        	}
        	catch(PDOException $e){
        			return $this->response->withStatus(400);
        	}
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	
});

$app->get('/notes',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM notes ORDER BY title");
    $stmt -> execute();
    $notes = $stmt->fetchAll();
    return $this->response->withJson($notes);
});

$app->get('/notes/[{id}]',function($request,$response,$arg){
	
	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT * FROM notes WHERE id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	$textbook = $stmt->fetchAll();
	return $this->response->withJson($textbook);
});




$app->post('/notes',function($request,$response){

	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$input = $request->getBody();
		$input = json_decode($input,true);
		$stmt = $this->db->prepare("INSERT into supplies(title, description,price,class,uploader_id,stat,cover) VALUES (:title,:description,:price,:class,:uploader_id,:stat,:cover)");
		$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
		$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
		$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
		$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
		$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
		$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		$stmt->bindValue(':cover',$input["cover"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
		
	});


$app->post('/notes/[{id}]',function($request,$response,$arg){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
		$input = $request->getBody();
		$input = json_decode($input,true);
			$stmt = $this->db->prepare("UPDATE notes SET 
        title = COALESCE(:title, title),
        description = COALESCE(:description, description),
        price = COALESCE(:price, price),
        class = COALESCE(:class,class),
        uploader_id = COALESCE(:uploader_id,uploader_id),
        cover = COALESCE(:cover,cover)
		WHERE id=:id");
		$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
		$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
		$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
		$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
		$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
		$stmt->bindValue(':cover',$input["cover"],PDO::PARAM_STR);
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	
});



$app->delete('/notes/[{id}]',function($request,$response,$arg){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
		$stmt = $this->db->prepare("DELETE FROM notes WHERE id = :id");
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        		$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	
});


















$app->get('/supplies',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY title");
    $stmt -> execute();
    $supplies = $stmt->fetchAll();
    return $this->response->withJson($supplies);
});


$app->get('/supplies/[{id}]',function($request,$response,$arg){
	
	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	$textbook = $stmt->fetchAll();
	return $this->response->withJson($textbook);
});


$app->post('/supplies',function($request,$response){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$input = $request->getBody();
		$input = $request->getBody();
		$input = json_decode($input,true);
		$stmt = $this->db->prepare("INSERT into supplies(title, description,price,class,uploader_id, stat,cover) VALUES (:title,:description,:price,:class,:uploader_id,:stat,:cover)");
		$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
		$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
		$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
		$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
		$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
		$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		$stmt->bindValue(':cover',$input["cover"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	});


$app->post('/supplies/[{id}]',function($request,$response,$arg){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
		$input = $request->getBody();
		$input = json_decode($input,true);
		$stmt = $this->db->prepare("UPDATE supplies SET 
        title = COALESCE(:title, title),
        description = COALESCE(:description, description),
        price = COALESCE(:price, price),
        class = COALESCE(:class,class),
        uploader_id = COALESCE(:uploader_id,uploader_id),
        cover = COALESCE(:cover,cover)
		WHERE id=:id");
		$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
		$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
		$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
		$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
		$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
		$stmt->bindValue(':cover',$input["cover"],PDO::PARAM_STR);
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	
});



$app->delete('/supplies/[{id}]',function($request,$response,$arg){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']===true){
    	$id = $arg["id"];
		$stmt = $this->db->prepare("DELETE FROM supplies WHERE id = :id");
		$stmt->bindValue(':id',$id,PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    
		return $this->response->withStatus(200);
		}else{
			return $this->response->withStatus(401);
		}
	
});


$app->get('/recent',function($request,$response){
	
	$stmt = $this->db->prepare("SELECT * FROM ( SELECT * FROM (SELECT id, description, title, uploader_id, price, class, stat, type, cover, upload_date FROM textbooks ORDER BY upload_date LIMIT 10) AS selected1 UNION ALL SELECT * FROM (SELECT id, description, title, uploader_id, price, class, stat, type, cover, upload_date FROM notes ORDER BY upload_date LIMIT 10) AS selected2 UNION ALL SELECT * FROM (SELECT id, description, title, uploader_id, price, class, stat, type, cover, upload_date FROM supplies ORDER BY upload_date LIMIT 10) AS selected3) AS selected4 ORDER BY upload_date DESC LIMIT 10 ");
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $recent = $stmt->fetchAll();
    return $this->response->withJson($recent);
    
    });

$app->get('/search/[{query}]',function($request,$response,$arg){
	$query = $arg["query"];
	$stmt = $this->db->prepare(" SELECT * FROM (SELECT id, description, title, uploader_id, price, class, stat, type, cover,upload_date FROM textbooks WHERE title LIKE :query OR description LIKE :query OR class LIKE :query UNION ALL SELECT id, description, title, uploader_id, price, class, stat, type ,cover, upload_date FROM supplies WHERE title like :query OR description LIKE :query or class like :query UNION ALL SELECT id, description, title, uploader_id, price, class, stat, type, cover, upload_date FROM notes WHERE title like :query OR description LIKE :query or class like :query) AS searched ORDER BY price");
	$stmt->bindValue(':query',"%".$query."%",PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $searched = $stmt->fetchAll();
	return $this->response->withJson($searched);
	
	});


$app->get('/textbooksByClass/[{query}]',function($request,$response)
{
	$query = $arg["query"];
	$stmt = $this->db->prepare("SELECT * FROM textbooks WHERE title LIKE :query OR description LIKE :query OR class LIKE :query");
	$stmt->bindValue(':query',"%".$query."%",PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $searched = $stmt->fetchAll();
	return $this->response->withJson($searched);
	
});
$app->get('/suppliessByClass/[{query}]',function($request,$response,$arg)
{
	$query = $arg["query"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE title LIKE :query OR description LIKE :query OR class LIKE :query");
	$stmt->bindValue(':query',"%".$query."%",PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $searched = $stmt->fetchAll();
	return $this->response->withJson($searched);
	
});

$app->get('/notesByClass/[{query}]',function($request,$response,$arg)
{
	$query = $arg["query"];
	$stmt = $this->db->prepare("SELECT * FROM notes WHERE title LIKE :query OR description LIKE :query OR class LIKE :query");
	$stmt->bindValue(':query',"%".$query."%",PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $searched = $stmt->fetchAll();
	return $this->response->withJson($searched);
	
});









///-------Chris part
$app->get('/textbooksByClassAsc',function($request,$response,$arg)
{
	$stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY class ASC");
	$stmt -> execute();
	$textbooks = $stmt->fetchAll();
	return $this->response->withJson($textbooks);
});

$app->get('/notesByClassAsc',function($request,$response)
{
	$stmt = $this->db->prepare("SELECT * FROM notes ORDER BY class ASC");
	$stmt -> execute();
	$notes = $stmt->fetchAll();
	return $this->response->withJson($notes);
});

$app->get('/notesByClassDesc',function($request,$response)
{
	$stmt = $this->db->prepare("SELECT * FROM notes ORDER BY class DESC");
	$stmt -> execute();
	$notes = $stmt->fetchAll();
	return $this->response->withJson($notes);
});

$app->get('/suppliesByClassDesc',function($request,$response)
{
	$stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY class DESC");
	$stmt -> execute();
	$supplies = $stmt->fetchAll();
	return $this->response->withJson($supplies);
});

$app->get('/suppliesByClassAsc',function($request,$response)
{
	$stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY class ASC");
	$stmt -> execute();
	$supplies = $stmt->fetchAll();
	return $this->response->withJson($supplies);
});

//-----Alan part
$app->get('/textbooksByPriceDesc',function($request,$response)

{

	$stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY price DESC");

	$stmt -> execute();

	$textbooks = $stmt->fetchAll();

	return $this->response->withJson($textbooks);

});



$app->get('/textbooksByPriceAsc',function($request,$response)

{

	$stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY Price ASC");

	$stmt -> execute();

	$textbooks = $stmt->fetchAll();

	return $this->response->withJson($textbooks);

});
$app->get('/notesByPriceAsc',function($request,$response)

{

	$stmt = $this->db->prepare("SELECT * FROM notes ORDER BY Price ASC");

	$stmt -> execute();

	$notes = $stmt->fetchAll();

	return $this->response->withJson($notes);

});



$app->get('/notesByPriceDesc',function($request,$response)

{

	$stmt = $this->db->prepare("SELECT * FROM notes ORDER BY price DESC");

	$stmt -> execute();

	$notes = $stmt->fetchAll();

	return $this->response->withJson($notes);

});

$app->get('/suppliesByPriceDesc',function($request,$response)

{

	$stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY price DESC");

	$stmt -> execute();

	$supplies = $stmt->fetchAll();

	return $this->response->withJson($supplies);

});



$app->get('/suppliesByPriceAsc',function($request,$response)

{

	$stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY Price ASC");

	$stmt -> execute();

	$supplies = $stmt->fetchAll();

	return $this->response->withJson($supplies);

});


//code below doesn't relate to our current project, just ignore it.

$app->get('/todos/search/[{query}]', function($request, $response, $args){
$sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
$query ="%".$args['query']."%";
$sth->bindParam("query", $query);
$sth->execute();
$todos = $sth->fetchAll();
return $this->response->withJson($todos);
});

