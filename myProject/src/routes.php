<?php
// Routes
$app->post('/signup',function($request,$response){

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
});
        
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

