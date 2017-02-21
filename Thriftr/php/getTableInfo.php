<?php

	if(isset($_REQUEST['request'])){
			require_once('../support/config.php');
			require_once('../classes/class.MyPDO.php');
			$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);
	}else{
		redirect("index.php");
	}

	$table = $_REQUEST['table'];
		switch($table){
		case 'Accident':
			$tablename="stg_road_acc";
		break;
		case 'Weather':
			$tablename="stg2_weather";
		break;
		case 'Traffic':
			$tablename="stg3_traffic_table";
		break;
		case 'Mall':
			$tablename="event";
		break;
		case 'Real Traffic':
			$tablename="stg_traffic_table_temp";
		break;
		case 'Real Weather':
			$tablename="stg_weather_temp";
		break;
		}


	if($_REQUEST['request']=='tablerows'){
		$query = $connection -> myQuery("SELECT COLUMN_NAME
										FROM `INFORMATION_SCHEMA`.`COLUMNS` 
										WHERE `TABLE_SCHEMA`='trafficwarehouse2' 
	    								AND `TABLE_NAME`='".$tablename."';");
		$html = "";
		$tablehead ="";
		$response = [];
		while($row = $query -> fetch(PDO::FETCH_ASSOC)){
			$fieldset = $row['COLUMN_NAME'];
			$html .= "<input type='checkbox' value='".$fieldset."' name='fieldset' >".$fieldset."</input><br>";
			$tablehead .="<th class='sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending' style='width: 181px;'>
				                ".$fieldset."
				           </th>";
		}
		$response['html'] = $html;
		$response['tablehead'] = $tablehead;
		echo json_encode($response);
	}


	if($_REQUEST['request']=='row'){


		
		// $query = $connection -> myQuery("SELECT COLUMN_NAME
		// 								FROM `INFORMATION_SCHEMA`.`COLUMNS` 
		// 								WHERE `TABLE_SCHEMA`='trafficwarehouse2' 
	 //    								AND `TABLE_NAME`='".$tablename."';");
		// $html = "";
		// $tablehead ="";
		// $response = [];
		// while($row = $query -> fetch(PDO::FETCH_ASSOC)){
		// 	$fieldset = $row['COLUMN_NAME'];
		// 	$html .= "<input type='checkbox' value='".$fieldset."' name='fieldset' >".$fieldset."</input><br>";
		// 	$tablehead .="<th class='sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending' style='width: 181px;'>
		// 		                ".$fieldset."
		// 		           </th>";
		// }
		// $response['html'] = $html;
		// $response['tablehead'] = $tablehead;
		// echo json_encode($response);
	}
		
	
?>