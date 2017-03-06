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
		$date_array = explode("/",$fromdate); // split the array
		$var_day = $date_array[0]; //day seqment
		$var_month = $date_array[1]; //month segment
		$var_year = $date_array[2]; //year segment
		$fromdate = "$var_year-$var_day-$var_month"; 
		$todate =$_REQUEST['dates']['todate'];		
		$date_array = explode("/",$todate); // split the array
		$var_day = $date_array[0]; //day seqment
		$var_month = $date_array[1]; //month segment
		$var_year = $date_array[2]; //year segment
		$todate = "$var_year-$var_day-$var_month"; 
		

		$query = $connection -> myQuery("SELECT * FROM `rep_levelcount_daily` WHERE (`date` between '$fromdate' and '$todate') AND location_name = '$location'");
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$weekdayname = $row['weekday_name'];
				$response['data'][]=$row;
				$response['hours'][$row['date'].' '.$weekdayname][$row['level']] = $row['levelcount'];
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
			 $response['details']['date'] = $fromdate.' TO '.$todate;
			 $response['details']['road'] = $location;
			 $response['details']['day'] = '';
			echo json_encode($response);
		
		}else if($_REQUEST['interval']=='hourly'){
			$onedaydate=$_REQUEST['dates']['onedaydate'];		
			// $onedaydate = str_replace('/', '-', $onedaydate);
			// $date = date_create($onedaydate);
			// $onedaydate = date_format($date, "Y-m-d");
			$date_array = explode("/",$onedaydate); // split the array
			$var_day = $date_array[0]; //day seqment
			$var_month = $date_array[1]; //month segment
			$var_year = $date_array[2]; //year segment
			$onedaydate = "$var_year-$var_day-$var_month"; 
			$query = $connection -> myQuery("SELECT * FROM rep_levelcount_hourly WHERE `date`= '$onedaydate' AND location_name = '$location'");
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$weekdayname = $row['weekday_name'];
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
			$response['details']['date'] = $onedaydate;
			$response['details']['road'] = $location;
			$response['details']['day'] = $weekdayname;
			echo json_encode($response);
			
		}


		
		

}
if($_REQUEST['request']=='trafficCountWeeklyBehavior'){
		$location = $_REQUEST['location'];
		$query = $connection -> myQuery("SELECT *,sum(LevelCountsPerWeek) as perday FROM `level_direction_location_weekday` where location_name = '$location' AND direction = 'N' group by week, level order by week, hour");
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$weekdayname = $row['weekday_name'];
				$response['N']['data'][]=$row;
				$response['N']['days'][$row['weekday_name']][$row['level']] = $row['perday'];
			}
			}
			foreach($response['N']['days'] as $key => $hour){
				if(!array_key_exists('H', $hour)){
					$response['N']['days'][''.$key]["H"] = 0; 
				} if(!array_key_exists('M', $hour)){
					$response['N']['days'][''.$key]['M']= 0; 
				} if(!array_key_exists('L', $hour)){
					$response['N']['days'][''.$key]['L']= 0; 
				}
					
			}
			$query = $connection -> myQuery("SELECT *,sum(LevelCountsPerWeek) as perday FROM `level_direction_location_weekday` where location_name = '$location' AND direction = 'S' group by week, level order by week, hour");
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$weekdayname = $row['weekday_name'];
				$response['data'][]=$row;
				$response['S']['days'][$row['weekday_name']][$row['level']] = $row['perday'];
			}
			}
			foreach($response['S']['days'] as $key => $hour){
				if(!array_key_exists('H', $hour)){
					$response['S']['days'][''.$key]["H"] = 0; 
				} if(!array_key_exists('M', $hour)){
					$response['S']['days'][''.$key]['M']= 0; 
				} if(!array_key_exists('L', $hour)){
					$response['S']['days'][''.$key]['L']= 0; 
				}
					
			}
			echo json_encode($response);
		
};


if($_REQUEST['request']=='trafficCountHourlyBehavior'){
		$location = $_REQUEST['location'];
		$week = $_REQUEST['week'];
		$query = $connection -> myQuery("SELECT *FROM `level_direction_location_weekday` where location_name = '$location' AND direction = 'N' and weekday_name = '$week' order by hour");
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				
				$response['N'][$row['hour']][$row['level']] = $row['LevelCountsPerWeek'];
			}
			}
			foreach($response['N'] as $key => $hour){
				if(!array_key_exists('H', $hour)){
					$response['N'][''.$key]["H"] = 0; 
				} if(!array_key_exists('M', $hour)){
					$response['N'][''.$key]['M']= 0; 
				} if(!array_key_exists('L', $hour)){
					$response['N'][''.$key]['L']= 0; 
				}
					
			}
			
		$query = $connection -> myQuery("SELECT *FROM `level_direction_location_weekday` where location_name = '$location' AND direction = 'S' and weekday_name = '$week' order by hour");
			if($query->rowCount() <=0){

			}else{
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				
				$response['S'][$row['hour']][$row['level']] = $row['LevelCountsPerWeek'];
			}
			}
			foreach($response['S'] as $key => $hour){
				if(!array_key_exists('H', $hour)){
					$response['S'][''.$key]["H"] = 0; 
				} if(!array_key_exists('M', $hour)){
					$response['S'][''.$key]['M']= 0; 
				} if(!array_key_exists('L', $hour)){
					$response['S'][''.$key]['L']= 0; 
				}
					
			}
			
			echo json_encode($response);
		
}


if($_REQUEST['request']=='wholeEdsaTraffic'){

	$query = $connection -> myQuery("SELECT location_name, level, sum(levelcount) as total FROM datamart.rep_levelcount_daily where level = 'H' group by location_name, level order by total asc;");

	while($row = $query -> fetch(PDO::FETCH_ASSOC)){
		$response['data'][$row['location_name']]['H'] = $row['total'];
	}
	echo json_encode($response);

}


if($_REQUEST['request']=='wholeEdsaTraffic2'){

	$query = $connection -> myQuery("SELECT area_id , dt.location_name, level, sum(levelcount) as total FROM datamart.rep_levelcount_daily as dt
INNER JOIN trafficwarehouse_updated.location_dimension as ld on dt.location_name = ld.location_name
 group by location_name, level ;");

	while($row = $query -> fetch(PDO::FETCH_ASSOC)){
	
		$response['data'][$row['location_name']][$row['level']] = $row['total'];
		$response['data'][$row['location_name']]['area_id'] = $row['area_id'];
	}
	echo json_encode($response);

}


if($_REQUEST['request']=='top'){

	$query = $connection -> myQuery("SELECT location_name, level, sum(levelcount) as total FROM datamart.rep_levelcount_daily where level = 'H' group by location_name, level order by total desc;");

	while($row = $query -> fetch(PDO::FETCH_ASSOC)){
	
		$response[][$row['location_name']]['H'] = $row['total'];
	}
	echo json_encode($response);

}
	
		
	
?>