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
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$response['data'][]=$row;
				$response['hours'][$row['hour']][$row['level']] = $row['levelcount'];
			}
			}
			foreach($response['hours'] as $key => $hour){
				if(!array_key_exists('H', $hour)){
					$response['hours'][''.$key]["H"] = 0; 
				} if(!array_key_exists('M', $hour)){
					$response['hours'][''.$key]['M']= 0; 
				} if(!array_key_exists('L', $hour)){
					$response['hours'][''.$key]['L']= 0; 
				}
					
			}
			echo json_encode($response);
			
		}
		
		
		

}
		
	
		
	
?>