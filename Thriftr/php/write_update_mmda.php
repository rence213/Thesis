<?php
	//JOB to Update MMDA traffic table in the database

	include('simple_html_dom.php');
	$html = file_get_html('http://mmdatraffic.interaksyon.com/line-view-edsa.php/');
	require_once('../support/config.php');
	require_once('../classes/class.MyPDO.php');
	$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);

	$query = $connection -> myQuery("SELECT `location_name`, `area_id` FROM location_dimension");
	$areaArray = [];
	$index = 0;
	while($row  = $query->FETCH(PDO::FETCH_ASSOC)){
		$areaArray[$index]['area_id'] = $row['area_id'];
		$areaArray[$index]['location_name'] = $row['location_name'];
		$index++;
	}
	$insertQuery = "INSERT INTO `trafficwarehouse`.`stg_traffic_table_temp`
		(`id`,
		`road`,
		`northbound`,
		`southbound`,
		`time`)
		VALUES";
	 foreach($areaArray as $area){
	 	$id = $area['area_id'];
	 	$NorthBound = $html->find('div[id=1_'.$id.'_0_status]',-1);
	 	$SouthBound = $html->find('div[id=1_'.$id.'_1_status]',-1);
	 	$NorthBound = $NorthBound->plaintext;
	 	$SouthBound = $SouthBound->plaintext;
	 	$NorthBound = preg_replace('/\s+/', '', $NorthBound);
	 	$NorthBound = substr($NorthBound, 1);
	 	$NorthBound = str_replace('TRAFFIC','',$NorthBound);
	 	$SouthBound = preg_replace('/\s+/', '', $SouthBound);
	 	$SouthBound = substr($SouthBound, 1);
	 	$SouthBound = str_replace('TRAFFIC','',$SouthBound);
	 	switch($NorthBound){
	 		case "LIGHT":
	 			$NorthBound = "L";
	 		break;
	 		case "MODERATE":
	 			$NorthBound = "M";
	 		break;
	 		case "HEAVY":
	 			$NorthBound = "H";
	 		break;
	 	}

	 	switch($SouthBound){
	 		case "LIGHT":
	 			$SouthBound = "L";
	 		break;
	 		case "MODERATE":
	 			$SouthBound = "M";
	 		break;
	 		case "HEAVY":
	 			$SouthBound = "H";
	 		break;
	 	}
	 	$time = time();
	 	$road = $area['location_name'];
	 	$insertQuery .= "(NULL, '$road','$NorthBound','$SouthBound',$time),";


	}
	$insertQuery = substr($insertQuery,0,strlen($insertQuery)-1);
	$query = $connection -> myQuery($insertQuery);



	
?>