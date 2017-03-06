<?php
	//JOB to Update MMDA traffic table in the database

	
	require_once('../support/config.php');
	require_once('../classes/class.MyPDO.php');
	$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);


;


	$query = $connection -> myQuery("SELECT `date` from realtime_traffic_update_log order by update_id desc limit 1");
	$lastupdate = $query -> FETCH(PDO::FETCH_ASSOC);
	$lastupdate = $lastupdate['date'];
	$query = $connection -> myQuery("SELECT `time` from stg_traffic_table_temp order by `time` desc limit 1");
	$newupdate = $query -> FETCH(PDO::FETCH_ASSOC);
	$newupdate = $newupdate['time'];
	$query = $connection -> myQuery("SELECT count(*) as c from stg_traffic_table_temp where `time` BETWEEN IFNULL($lastupdate,0) AND $newupdate");
	$count = $query -> FETCH(PDO::FETCH_ASSOC);
	$count = $count['c'];

	echo $lastupdate;
	/*
	$query = $connection -> myQuery("INSERT INTO `realtime_traffic_update_log`
(`update_id`,
`date`,
`update_date`,
`num_affected_rows`)
VALUES
(NULL,
$newupdate,
now(),
$count);");


	$query = $connection ->myQuery("INSERT INTO `stg3_traffic_table` ( `year`, `month`, `day`, `hour`, `minute`, `road`, `direction`, `level` )
    (SELECT
			EXTRACT(YEAR FROM from_unixtime(`time`)) AS `year`,
			EXTRACT(MONTH FROM from_unixtime(`time`)) AS `month`,
			EXTRACT(DAY FROM from_unixtime(`time`)) AS `day`,
			EXTRACT(HOUR FROM from_unixtime(`time`)) AS `hour`,
			EXTRACT(MINUTE FROM from_unixtime(`time`)) AS `minute`, 
            `road`, 
            'N' as `direction`, 
            northbound as `level` 
		FROM  stg_traffic_table_temp where `time` > $lastupdate)
			UNION
    (SELECT
			EXTRACT(YEAR FROM from_unixtime(`time`)) AS `year`,
			EXTRACT(MONTH FROM from_unixtime(`time`)) AS `month`,
			EXTRACT(DAY FROM from_unixtime(`time`)) AS `day`,
			EXTRACT(HOUR FROM from_unixtime(`time`)) AS `hour`,
			EXTRACT(MINUTE FROM from_unixtime(`time`)) AS `minute`, 
			`road`, 
			'S' as `direction`, 
			southbound as `level` 
		FROM stg_traffic_table_temp where `time` > $lastupdate);");


	$query = $connection ->myQuery("TRUNCATE `stg_time_traffic`;");
$query = $connection ->myQuery ("INSERT INTO `stg_time_traffic`
(`id`,
`level`,
`direction`,
`time_id`,
`day`,
`month`,
`year`,
`road`)
SELECT 
IFNULL(`stg`.`id`,0) as stg_time_date_location_ID,
`level`,
`direction`,
IFNULL(`time_dimension`.`id`, 0),
stg.`day`,
stg.`month`,
stg.`year`,
stg.`road`
FROM stg3_traffic_table as stg, time_dimension
where (stg.`hour`, stg.`minute`) = (time_dimension.`hour`, time_dimension.`minute`) 
AND level in ('H','M','L') and 
unix_timestamp(CONCAT(
stg.`year`,'-',stg.`month`,'-',stg.`day`,' ', stg.`hour`,':',stg.`minute`,':00')) > $lastupdate;");
$query = $connection ->myQuery("truncate stg_time_date_traffic;");
$query = $connection ->myQuery ("INSERT INTO `stg_time_date_traffic`
(`id`,
`level`,
`direction`,
`time_id`,
`date_id`,
`road`)
SELECT id,level,direction,time_id,date_format(concat(stg.`year`,'-',stg.`month`,'-',stg.`day`), '%Y%m%d')-1 as date_id,stg.road
FROM stg_time_traffic as stg;");

$query = $connection ->myQuery ("INSERT INTO `stg_time_date_location`
(`stg_time_date_location_ID`,
`timeID`,
`dateID`,
`locationID`,
`direction`,
`level`)
SELECT 
NULL, 
time_id, date_id,
IFNULL(location_id, 0) as locationID,
direction,
level
FROM stg_time_date_traffic as stg
LEFT JOIN location_dimension ON stg.`road` = `location_dimension`.`location_name`;");

*/

?>