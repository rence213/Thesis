<?php
	/*======Support PHP=========================================
		*Starts Session
		*Defines APPNAME for session variable
		*Support php contains commonly used functions
			-encryption
			-redirect
			-MVC for head food and sidebars navbars
		*as well as a database object should you need a connection
			-PDO
			
			
		8/20/2016
	===========================================================*/
	
	session_start();
	/*===== include config php for property constants====*/
	//include_once('support/config.php');
	define("APPNAME","Thriftr");
	define("DBUSER","root");
	define("DBPASSWORD","");
	define("DATABASE","trafficwarehouse");
	define("HOST","127.0.0.1"); //default host is localhost 127.0.0.1
	define("CRYPTKEY","D02Psd334IvnkL");
	
	

	
	

	/*=====Navigation====*/
	function redirect($url)
	{
		header("location:".$url);
	}
	//END NAVIGATION//
	
	
	
	/*=====User Interface Components===*/
	function addComponent( $ComponentName=NULL,$DirectoryLevel=0){
		require_once str_repeat('../',$DirectoryLevel).'templates/'.$ComponentName.'.php';
	}
	
	//END UI
	
	
	
	/*=====Decrypt and Encrypt====*/
	/// MD5 HASH/////
	function encryptIt( $q ) {
	    $cryptKey  = CRYPTKEY;
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}
	function decryptIt( $q ) {
	    $cryptKey  = CRYPTKEY;
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
	//END Encryption//
	
	
	
		
	
	/*======DATABASE======*/
	require_once('class.MyPDO.php');
	$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);
	
	
	
	
	
	
	
	
	
?>