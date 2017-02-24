<?php

	if(isset($_REQUEST['request'])){
			require_once('../support/config.php');
			require_once('../classes/class.MyPDO.php');
			$connection = new MyPDO('datamart',DBUSER,DBPASSWORD);
	}else{
		redirect("index.php");
	}

	

	if($_REQUEST['request']=='trafficCount'){
	
		$response = [];
		$response['data'] = [];
		$location = $_REQUEST['location'];
		if($_REQUEST['interval']=='daily'){

		
		$fromdate =$_REQUEST['dates']['fromdate'];		
		$fromdate = str_replace('/', '-', $fromdate);
		$fromdate = date('Y-d-m', strtotime($fromdate));
		$todate =$_REQUEST['dates']['todate'];		
		$todate = str_replace('/', '-', $todate);
		$todate = date('Y-d-m', strtotime($todate));
		
			
			
		}else if($_REQUEST['interval']=='hourly'){
			$onedaydate=$_REQUEST['dates']['onedaydate'];		
			$onedaydate = str_replace('/', '-', $onedaydate);
			$onedaydate = date('Y-d-m', strtotime($onedaydate));
			$query = $connection -> myQuery("SELECT * FROM rep_levelcount_hourly WHERE `date`= '$onedaydate' AND location_name = '$location'");
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$response['data'][]=$row;
			}
			echo json_encode($response);
			
		}
		
		
		

}
		
	
		
	
?>