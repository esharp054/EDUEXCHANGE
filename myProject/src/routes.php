<?php
// Routes
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
        $stmt->execute();
        //$rows = $stmt->fetchAll();
        $to = $input["email"];
		$subject = "My subject";
		$txt = "Hello world!";
		$headers = "From:Eduexchange";
		mail($to,$subject,$txt,$headers,"-feduexchange@smu.edu");

        return $this->response->withJson($rows);
        }
});


$app->get('/textbooks',function($request,$response){

    $stmt = $this->db->prepare("SELECT * FROM textbooks ORDER BY title");
    $stmt -> execute();
    $textbooks = $stmt->fetchAll();
    return $this->response->withJson($textbooks);
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

$app->delete('/notes/[{id}]',function($request,$response,$args){
	$sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
	$sth->bindParam("id",$args["id"]);
	$sth->execute();
	$todos = $sth->fetchAll();
	return $this->response->withJson($todos);
});










//code below doesn't relate to our current project, just ignore it.
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
