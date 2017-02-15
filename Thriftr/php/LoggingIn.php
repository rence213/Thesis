<?php
	require_once('../support/support.php');
	$connection = new MyPDO("trafficmart",DBUSER,DBPASSWORD);
	if(isset($_POST['username'])&&isset($_POST['password'])){
	
		$userName=$_POST['username'];
		$password=$_POST['password'];
		
		$query = $connection -> myQuery("SELECT * FROM users where username='$userName' AND password='$password'")->fetch(PDO::FETCH_ASSOC);
		
		
	
			if(!isset($_SESSION['User_Id'])){
				if($query['is_logged_in']==0){
					if($query['password']==$password){
					//echo 'log in good';
						$_SESSION[APPNAME]['UserName']=$query['username'];
						$_SESSION[APPNAME]['FullName']=$query['full_name'];
						$_SESSION[APPNAME]['UserType']=$query['user_type'];
						$userId = $query['user_id'];
						$_SESSION[APPNAME]['UserId'] = $userId;
						$connection->myQuery("UPDATE `users` SET `is_logged_in` = '1' where user_id='$userId'");
						redirect('../datacenter.php');
					}else{
						setAlert('Wrong Username /Password','danger');
						redirect('../login.php');
					}
				}else{
					setAlert('User is logged in on another pc','danger');
					redirect('../login.php');
				}
			}else{
				if($query['password']==$password){
					//echo 'log in good';
						$_SESSION[APPNAME]['UserName']=$query['username'];
						$_SESSION[APPNAME]['FullName']=$query['full_name'];
						$_SESSION[APPNAME]['UserType']=$query['user_type'];
						$userId = $query['user_id'];
						$_SESSION[APPNAME]['UserId'] = $userId;
						$connection->myQuery("UPDATE `users` SET `is_logged_in` = '1' where user_id='$userId'");
						redirect('../datacenter.php');
					}else{
						setAlert('Wrong Username /Password','danger');
						redirect('../login.php');
					}
			}
		
		
	}else{
		redirect('../login.php');
	}
	
	
?>