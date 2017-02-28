<?php


			require_once('../support/config.php');
			require_once('../classes/class.MyPDO.php');
			$connection = new MyPDO('datamart',DBUSER,DBPASSWORD);
	
			$query = $connection -> myQuery("SELECT * FROM rep_levelcount_hourly WHERE `date`= '2015-10-09' AND location_name = 'NORTH AVENUE'");
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$response['hours'][$row['hour']][$row['level']] = $row['levelcount'];
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

			print_r($response);

			
		
		
		
		

	
		
	
?>