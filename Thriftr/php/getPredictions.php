<?php

	if(isset($_REQUEST['request'])){
			require_once('../support/config.php');
			require_once('../classes/class.MyPDO.php');
			$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);
	}else{
		redirect("index.php");
	}


	if($_REQUEST['request'] == 'getHourPrediction'){
		
		$fromtime=$_REQUEST['fromdate'];
		$totime=$_REQUEST['todate'];
		$area_id = $_REQUEST['area_id'];
		$month = date("j");
		$week = date("N");
		$is_event = 0;
	$response = file_get_contents("http://api.apixu.com/v1/current.json?key=ac1f3273943048feb14121122170902&q=Manila");
	$weatherarray = json_decode($response,true);
	$currentweather = $weatherarray['current'];
	$mean = $currentweather['temp_c'];
	$min = $currentweather['temp_c'];
	$max = $currentweather['temp_c'];
	$speed = $currentweather['wind_mph'];
	$rain = $currentweather['precip_mm'];
	$humidity = $currentweather['humidity'];
	$heat_index = $currentweather['feelslike_c'];
	$text = $currentweather['condition']['text'];
	$lightning = 0;
	if( strpos( $text, "rain" ) !== false ) {
    	$rain = 1;
    	$storm = 1;

	}else{
		$rain = 0;
    	$storm = 0;

	}
	$response =[];
	//$command =  'D:\Utilities\R-3.3.2\bin\Rscript.exe testing.r '.$month.' '.' '.$week.' '.$time.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$Humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' '.$direction;	
		$query = $connection -> myQuery("SELECT * FROM `location_dimension`  INNER JOIN roadstructures on location_name = road_location where `area_id` = $area_id;");
		$row = $query->fetch(PDO::FETCH_ASSOC);
			$bus = $row['bus_stop'];
			$ped = $row['pedestrian_lane'];
			$uturn = $row['uturn_slot'];
			$inter = $row['intersection'];
			$mrt = $row['mrt_stop'];
			$location = $row['area_id'];
			$timearray = [];
		for($fromtime;$fromtime<=$totime;$fromtime++){
			
			$timearray[] = $fromtime;
			//PC $command =  'D:\Utilities\R-3.3.2\bin\Rscript.exe ..\testing.r '.$month.' '.$week.' '.$fromtime.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' N';
			$command =  'C:\"Program Files"\R\R-3.3.2\bin\Rscript.exe ..\testing.r '.$month.' '.$week.' '.$fromtime.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' N';
			$num = exec($command);	
 	 		 $values = substr($num, 2);
 	 		 $status = explode(" ", $values);
 	 		$response['data']['N'][] = $status;
			//PC $command =  'D:\Utilities\R-3.3.2\bin\Rscript.exe ..\testing.r '.$month.' '.$week.' '.$fromtime.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' S';
			$command =  'C:\"Program Files"\R\R-3.3.2\bin\Rscript.exe ..\testing.r '.$month.' '.$week.' '.$fromtime.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' S';
			$response['command'][] = $command;
			$num = exec($command);	
 	 		$values = substr($num, 2);
 	 		$status = explode(" ", $values);
 	 		$response['data']['S'][] = $status;
		}
		$response['label'] = $timearray;


		// while($row = $query -> fetch(PDO::FETCH_ASSOC)){
		
		// 	$command =  'D:\Utilities\R-3.3.2\bin\Rscript.exe testing.r '.$month.' '.' '.$week.' '.$time.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$Humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' S';
		// 	$num = exec($command);	
 	// 		$values = substr($num, 2);
 	// 		$status = explode(" ", $values);
 	// 		$response[$row['location_name']]['N']['L']= $status[1];
 	// 		$response[$row['location_name']]['N']['M']= $status[2];
 	// 		$response[$row['location_name']]['N']['H']= $status[0];
		// 	$command =  'D:\Utilities\R-3.3.2\bin\Rscript.exe testing.r '.$month.' '.' '.$week.' '.$time.' '.$location .' '.$max.' '. $min.' '. $mean .' '.$Humidity .' '.$heat_index .' '.$speed.' '. $rain.' '. $storm.' '. $lightning .' '.$bus.' '. $ped .' '.$uturn .' '.$inter.' '. $mrt .' '.$is_event .' N';
		// 	$num = exec($command);	
 	// 		$values = substr($num, 2);
 	// 		$status = explode(" ", $values);
 	// 		$response[$row['location_name']]['S']['L']= $status[1];
 	// 		$response[$row['location_name']]['S']['M']= $status[2];
 	// 		$response[$row['location_name']]['S']['H']= $status[0];
		// }
		echo json_encode($response);
	}
	

	
		
	
?>