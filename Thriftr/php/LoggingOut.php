<?php
	require_once('../support/support.php');
	$connection = new MyPDO("trafficmart",DBUSER,DBPASSWORD);
	if(isset($_SESSION[APPNAME]['UserId'])){
	$userId=$_SESSION[APPNAME]['UserId'];
	$connection->myQuery("UPDATE `users` SET `is_logged_in` = '0' where user_id='$userId'");
	session_destroy();
	redirect('../index.php');
	die;
	}else{
		redirect('../index.php');
	}
?>