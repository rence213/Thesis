<?php
	 
	 include('../support/config.php');
	 $row = $connection->myQuery('SELECT * FROM user_table')->fetch(PDO::FETCH_ASSOC); // Database Call here
	 echo $row['username'];
	 if(isset($_SERVER['HTTP_ORIGIN'])){ // For now it accpets any request from any origin
	 	header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']); // Change access origin here
	 	header('Access-Control-Allow-Credentials: true');
	 	header("Access-Control-Allow-Methods: GET, POST");
	 	header('Access-Control-Max-Age: 86400'); //cache?
	    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	 
	 	$postdata = file_get_contents("php://input");
	 	$data = json_decode($postdata);
	 	$username = $data->credentials->username;
	 	$password = $data->credentials->password;
	 	$uuid = $data -> credentials->uuid;
	 	$row = $connection->myQuery("SELECT * FROM users_table where username='$username'")->fetch(PDO::FETCH_ASSOC);

	 	if($password==$row['password']){
	 		echo 'true'. $uuid ;
	 	}else{
	 		echo 'false';
	 	}
	 	
	 }else{
	 	redirect('../index.php');
	 }
?>