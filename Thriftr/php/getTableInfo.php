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
		$columns = [];
		while($row = $query -> fetch(PDO::FETCH_ASSOC)){
			$fieldset = $row['COLUMN_NAME'];
			$columns[] = $row['COLUMN_NAME'];
			$html .= "<input type='checkbox' value='".$fieldset."' name='fieldset' >".$fieldset."</input><br>";
			$tablehead .="<th class='sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending' style='width: 181px;'>
				                ".$fieldset."
				           </th>";
		}
		$response['html'] = $html;
		$response['tablehead'] = $tablehead;
		$response['tablename'] = $tablename;
		$response['columns'] = sizeof($columns);
		$query = $connection -> myQuery("SELECT year, month, day from $tablename group by year, month, day order by year asc, month asc, day asc");
		$response['oldest'] = $query->fetch(PDO::FETCH_ASSOC);
		$query = $connection -> myQuery("SELECT year, month, day from $tablename group by year, month, day order by year desc, month desc, day desc");
		$response['recent'] = $query->fetch(PDO::FETCH_ASSOC);
		echo json_encode($response);
	}


	if($_REQUEST['request']=='row'){


		$from_date = explode("/", $_REQUEST['from']);
		$to_date = explode("/", $_REQUEST['to']);
		if(isset($_REQUEST['fieldset'])){
			$fieldset = $_REQUEST['fieldset'];
			if ($fieldset=="" || $fieldset == null){
				$fieldset = "*";
			}else{
				
				$fieldset = implode(",", $fieldset);
			}
		}else{
			$fieldset = "*";
		}


									

		$query = $connection -> myQuery("SELECT $fieldset FROM `".$tablename."` 
										WHERE (year BETWEEN ".$from_date[2]." AND ".$to_date[2]." )
										AND
										(
										(month BETWEEN ".$from_date[1]." AND  ".$to_date[1].")
										AND (day BETWEEN ".$from_date[0]." AND ".$to_date[0]." ) )LIMIT 10");
		echo print_r($query->fetch(PDO::FETCH_ASSOC));


		// $html = "";
		// $tablehead ="";
		// $response = [];
		// for(var i; i<=){
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