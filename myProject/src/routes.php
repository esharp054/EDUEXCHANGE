<?php
// Routes
$app->get('/logout',function($request,$response){
	session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']==='true'){
            session_unset();//free all session variable
            session_destroy();//
            return $this->response->withStatus(200);
        }else{
           return $this->response->withStatus(400);
        }
        
        });
$app->post('/signin',function($request,$response){

		$input = $request->getParsedBody();
		$pass = md5($input["password"]);
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
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
			$input = $request->getParsedBody();
			$stmt = $this->db->prepare("INSERT into users(username,password,email,phone, stat) VALUES (:username, :password,:email,:phone, :stat)");
			$pass = $input["password"];
			$pass = md5($pass);
			$stmt->bindValue(':username', $input["username"],PDO::PARAM_STR);
			$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
			$stmt->bindValue(':email', $input["email"], PDO::PARAM_STR);
			$stmt->bindValue(':phone', $input["phone"], PDO::PARAM_INT);
			$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
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
	$stmt = $this->db->prepare("SELECT * FROM textbooks WHERE textbook_id = :id");
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


$app->get('/textbooks/[{class}]', function($request,$response,$arg){
	
	$class = $arg["class"];
	$stmt = $this->db->prepare("SELECT * FROM textbooks WHERE class = :class");
	$stmt->bindValue(':class', $class, PDO::PARAM_STR);
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
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("INSERT into textbooks(title, description,price,class,uploader_id, stat) VALUES (:title,:description,:price,:class,:uploader_id, :stat)");
	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
	$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
		
	});


$app->post('/textbooks/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("UPDATE textbooks(title, description,price,class,uploader_id,stat) VALUES (:title,:description,:price,:class,:uploader_id, :stat)");
	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
	
});



$app->delete('/textbooks/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$stmt = $this->db->prepare("DELETE FROM textbooks WHERE textbook_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
	
});

$app->get('/notes',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM notes ORDER BY title");
    $stmt -> execute();
    $notes = $stmt->fetchAll();
    return $this->response->withJson($notes);
});

$app->get('/notes/[{id}]',function($request,$response,$arg){
	
	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT * FROM notes WHERE notes_id = :id");
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


$app->get('/notes/[{class}]', function($request,$response,$arg){
	
	$class = $arg["class"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE class = :class");
	$stmt->bindValue(':class', $class, PDO::PARAM_STR);
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
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("INSERT into supplies(title, description,price,class,uploader_id,stat) VALUES (:title,:description,:price,:class,:uploader_id,:stat)");
	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
	$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
		
	});


$app->post('/notes/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("UPDATE supplies(title, description,price,class,uploader_id,stat) VALUES (:title,:description,:price,:class,:uploader_id,:stat)");
	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
	$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
	
});



$app->delete('/notes/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$stmt = $this->db->prepare("DELETE FROM notes WHERE notes_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
	
});




















$app->get('/supplies',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY title");
    $stmt -> execute();
    $supplies = $stmt->fetchAll();
    return $this->response->withJson($supplies);
});


$app->get('/supplies/[{id}]',function($request,$response,$arg){
	
	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE supplies_id = :id");
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


$app->get('/supplies/[{class}]', function($request,$response,$arg){
	
	$class = $arg["class"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE class = :class");
	$stmt->bindValue(':class', $class, PDO::PARAM_STR);
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
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("INSERT into supplies(title, description,price,class,uploader_id, stat) VALUES (:title,:description,:price,:class,:uploader_id,:stat)");
	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
	$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
		
	});


$app->post('/supplies/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("UPDATE supplies(title, description,price,class,uploader_id,stat) VALUES (:title,:description,:price,:class,:uploader_id,:stat)");
	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);	
	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
	$stmt->bindValue(':stat', $input["stat"],PDO::PARAM_STR);
		try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
	return $this->response->withStatus(200);
	
});



$app->delete('/supplies/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$stmt = $this->db->prepare("DELETE FROM supplies WHERE supplies_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    
	return $this->response->withStatus(200);
	
});




$app->get('/search/[{query}]',function($request,$response,$arg){
	$query = $arg["query"];
	$stmt = $this->db->prepare(" SELECT * FROM (SELECT id, description, price, class, stat, type FROM textbooks WHERE title LIKE :query OR description LIKE :query OR class LIKE :query UNION ALL SELECT id, description, price, class, stat, type FROM supplies WHERE title like :query OR description LIKE :query or class like :query UNION ALL SELECT id, description, price, class, stat, type FROM supplies WHERE title like :query OR description LIKE :query or class like :query) AS searched ORDER BY price");
	$stmt->bindValue(':query',"%".$query."%",PDO:PARAM_STR);
	try{
        	$stmt->execute();
        }
        catch(PDOException $e){
        		return $this->response->withStatus(400);
        }
    $searched = $stmt->fetchAll();
	return $this->response->withJson($searched);
	
	});

//-------Chris Search By order

$app->get('/textbooksByClassDesc',function($request,$response)
{
	$stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY class DESC");
	$stmt -> execute();
	$textbooks = $stmt->fetchAll();
	return $this->response->withJson($textbooks);
});

$app->get('/textbooksByClassAsc',function($request,$response)
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



//code below doesn't relate to our current project, just ignore it.

$app->get('/todos/search/[{query}]', function($request, $response, $args){
$sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
$query ="%".$args['query']."%";
$sth->bindParam("query", $query);
$sth->execute();
$todos = $sth->fetchAll();
return $this->response->withJson($todos);
});

