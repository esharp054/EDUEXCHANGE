<?php
// Routes
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
        $stmt = $this->db->prepare("INSERT into users(username,password,email,phone) VALUES (:username, :password,:email,:phone)");
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

// $app->get('/textbooks',function($request,$response){
//     $stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY title");
//     try{
//         	$stmt->execute();
//         }
//         catch(PDOException $e)
// 				{
//         		return $this->response->withStatus(400);
//         }
//     $textbooks = $stmt->fetchAll();
//     return $this->response->withJson($textbooks);
// });
// $app->get('/textbooks/[{id}]',function($request,$response,$arg){
//
// 	$id = $arg["id"];
// 	$stmt = $this->db->prepare("SELECT * FROM textbooks WHERE textbook_id = :id");
// 	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
// 	try{
//         	$stmt->execute();
//         }
//         catch(PDOException $e){
//         		return $this->response->withStatus(400);
//         }
// 	$textbook = $stmt->fetchAll();
// 	return $this->response->withJson($textbook);
// });
// $app->get('/textbooks/[{class}]', function($request,$response,$arg){
//
// 	$class = $arg["class"];
// 	$stmt = $this->db->prepare("SELECT * FROM textbooks WHERE class = :class");
// 	$stmt->bindValue(':class', $class, PDO::PARAM_STR);
// 	try{
//         	$stmt->execute();
//         }
//         catch(PDOException $e){
//         		return $this->response->withStatus(400);
//         }
// 	$textbook = $stmt->fetchAll();
// 	return $this->response->withJson($textbook);
//
// });
// $app->post('/textbooks',function($request,$response){
// 	$input = $request->getParsedBody();
// 	$stmt = $this->db->prepare("INSERT into textbooks(title, description,price,class,uploader_id) VALUES (:title,:description,:price,:class,:uploader_id)");
// 	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
// 	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);
// 	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
// 	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
// 	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
// 	try{
//         	$stmt->execute();
//         }
//         catch(PDOException $e){
//         		return $this->response->withStatus(400);
//         }
// 	return $this->response->withStatus(200);
//
// 	});
// $app->post('/textbooks/[{id}]',function($request,$response,$arg){
// 	$id = $arg["id"];
// 	$input = $request->getParsedBody();
// 	$stmt = $this->db->prepare("UPDATE textbooks(title, description,price,class,uploader_id) VALUES (:title,:description,:price,:class,:uploader_id)");
// 	$stmt->bindValue(':title', $input["title"],PDO::PARAM_STR);
// 	$stmt->bindValue(':description', $input["description"],PDO::PARAM_STR);
// 	$stmt->bindValue(':price', $input["price"],PDO::PARAM_STR);
// 	$stmt->bindValue(':class', $input["class"],PDO::PARAM_STR);
// 	$stmt->bindValue(':uploader_id', $input["uploader_id"],PDO::PARAM_STR);
// 	try{
//         	$stmt->execute();
//         }
//         catch(PDOException $e){
//         		return $this->response->withStatus(400);
//         }
// 	return $this->response->withStatus(200);
//
// });
// $app->delete('/textbooks/[{id}]',function($request,$response,$arg){
// 	$id = $arg["id"];
// 	$stmt = $this->db->prepare("DELETE FROM textbooks WHERE textbook_id = :id");
// 	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
// 	try{
//         	$stmt->execute();
//         }
//         catch(PDOException $e){
//         		return $this->response->withStatus(400);
//         }
// 	return $this->response->withStatus(200);
//
// });

$app->get('/notes',function($request,$response){
    $stmt = $this->db->prepare("SELECT * FROM notes ORDER BY title");
    $stmt -> execute();
    $notes = $stmt->fetchAll();
    return $this->response->withJson($notes);
});

$app->get('/supplies',function($request,$response){
	$stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY title");
	try
	{
		$stmt->execute();
	}
	catch(PDOException $e)
	{
			return $this->response->withStatus(400);
	}
	$textbooks = $stmt->fetchAll();
	return $this->response->withJson($textbooks);

});

$app->get('/supplies/[{id}]',function($request,$response,$arg){

	$id = $arg["id"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE supplies_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_STR);
	try
	{
    $stmt->execute();
  }
  catch(PDOException $e)
	{
    return $this->response->withStatus(400);
  }
	$supply = $stmt->fetchAll();
	return $this->response->withJson($supplies);
});

$app->get('/textbooks/[{class}]', function($request,$response,$arg)
{
	$class = $arg["class"];
	$stmt = $this->db->prepare("SELECT * FROM supplies WHERE class = :class");
	$stmt->bindValue(':class', $class, PDO::PARAM_STR);
	try
	{
    $stmt->execute();
  }
  catch(PDOException $e)
	{
    return $this->response->withStatus(400);
  }
	$textbook = $stmt->fetchAll();
	return $this->response->withJson($textbook);

});
