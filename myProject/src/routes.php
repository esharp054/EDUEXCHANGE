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
	$stmt = $this->db->prepare("INSERT into textbooks(title, description,price,class,uploader_id) VALUES (:title,:description,:price,:class,:uploader_id)");
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
$app->post('/textbooks/[{id}]',function($request,$response,$arg){
	$id = $arg["id"];
	$input = $request->getParsedBody();
	$stmt = $this->db->prepare("UPDATE textbooks(title, description,price,class,uploader_id) VALUES (:title,:description,:price,:class,:uploader_id)");
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

$app->get('/supplies',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM supplies ORDER BY title");
    $stmt -> execute();
    $supplies = $stmt->fetchAll();
    return $this->response->withJson($supplies);
});


//--------------
//--------------
//--------------      
$app->get('/todos',function($request,$response,$args){
	$sth = $this->db->prepare("SELECT * FROM tasks ORDER BY task");
	$sth -> execute();
	$todos = $sth->fetchAll();
	return $this->response->withJson($todos);
});

$app->get('/todos/search/[{query}]', function($request, $response, $args){
$sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
$query ="%".$args['query']."%";
$sth->bindParam("query", $query);
$sth->execute();
$todos = $sth->fetchAll();
return $this->response->withJson($todos);
});

$app->post('/todo', function($request, $response){
$input = $request->getParsedBody();
$sql = "INSERT INTO tasks (task) VALUES (:task)";
$sth = $this->db->prepare($sql);
$sth->bindParam("task",$input["task"]);
$sth->execute();
$input["id"] = $this->db->lastInsertId();
return $this->response->withJson($inpute);
});

$app->delete('/todo/[{id}]',function($request,$response,$args){
$sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
$sth->bindParam("id",$args["id"]);
$sth->execute();
$todos = $sth->fetchAll();
return $this->response->withJson($todos);
});

$app->put('todo/[{id}]', function($request, $response,$args){
$input = $request->getParsedBody();
$sql = "UPDATE tasks SET task=:task WHERE id=:id";
$sth = $this->db->prepare($sql);
$sth->bindParam("id",$args["id"]);
$sth->bindParam("task",$input["task"]);
$sth->execute();
$input["id"] = $args["id"];
return $this->response->withJson($inpute);

});
