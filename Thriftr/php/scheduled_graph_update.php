<?php
	//JOB to Update MMDA traffic table in the database

	
	require_once('config.php');
	require_once('class.MyPDO.php');
	$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);


;

$query = $connection -> myQuery("Truncate `thehack8_datamart`.`rep_levelcount_daily_realtime`;");
$query = $connection -> myQuery("INSERT INTO `thehack8_datamart`.`rep_levelcount_daily_realtime`
(`date`,
`weekday_name`,
`location_name`,
`level`,
`levelcount`)
SELECT
date_dimension.date,
weekday_name,
location_name,
level,
COUNT(`level`) as levelcount
FROM stg_time_date_location as stg
INNER JOIN date_dimension on stg.dateId = date_dimension.date_id
INNER JOIN location_dimension ON stg.locationId = location_dimension.location_id
group by location_name, stg.dateId, `level`;
");

$query = $connection -> myQuery("Truncate `thehack8_datamart`.`rep_levelcount_hourly_realtime`;");
$query = $connection -> myQuery("INSERT INTO `thehack8_datamart`.`rep_levelcount_hourly`
(`date`,
`weekday_name`,
`hour`,
`level`,
`location_name`,
`levelcount`)
SELECT 
date_dimension.date,
weekday_name,
time_dimension.hour,
level,
location_name,
COUNT(`level`) as levelcount
FROM stg_time_date_location as stg
INNER JOIN date_dimension on stg.dateId  = date_dimension.date_id
INNER JOIN time_dimension ON stg.timeId = time_dimension.time_id
INNER JOIN location_dimension ON stg.locationId = location_dimension.location_id 
group by location_name, stg.dateId , time_dimension.hour, `level`;
");

?>