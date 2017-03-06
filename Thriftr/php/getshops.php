<?php
if(isset($_REQUEST['request'])){
require_once('../support/config.php');
		require_once('../classes/class.MyPDO.php');
		$connection = new MyPDO(DATABASE,DBUSER,DBPASSWORD);
}
	if($_REQUEST['request']=='shops'){
		$market_info = $connection -> myQuery("SELECT * FROM location_dimension");
		while($row=$market_info->fetch(PDO::FETCH_ASSOC)){
			$array[$row['location_id']][]=$row['location_name'];
			$array[$row['location_id']][]=$row['lat'];
			$array[$row['location_id']][]=$row['long'];
			$array[$row['location_id']][]=$row['location_id'];
		}
		echo json_encode($array);
	}

	if($_REQUEST['request']=="shopinfo"){
		include('simple_html_dom.php');
		$html = file_get_html('http://mmdatraffic.interaksyon.com/line-view-edsa.php/');
		if(isset($_REQUEST['id'])){
		$market_id = $_REQUEST['id'];
		$market_info = $connection -> myQuery("SELECT * FROM location_dimension where $market_id = location_id" )->fetch(PDO::FETCH_ASSOC);
		$NorthBound = $html->find('div[id=1_'.$market_info['area_id'].'_0_status]',-1);
		$SouthBound = $html->find('div[id=1_'.$market_info['area_id'].'_1_status]',-1);
		$updatetime = $html->find('p[id=1_'.$market_info['area_id'].'_1_datetime]',-1);
		$updatetime = $updatetime ->plaintext;
		$NorthBound = $NorthBound->plaintext;
		$SouthBound = $SouthBound->plaintext;
		$NorthBound = preg_replace('/\s+/', '', $NorthBound);
		$NorthBound = substr($NorthBound, 1);
		$NorthBound = str_replace('TRAFFIC',' TRAFFIC',$NorthBound);
		$SouthBound = preg_replace('/\s+/', '', $SouthBound);
		$SouthBound = substr($SouthBound, 1);
		$SouthBound = str_replace('TRAFFIC',' TRAFFIC',$SouthBound);

		switch(str_replace(" TRAFFIC", "" ,$NorthBound)){
	 		case "LIGHT":
	 			$Ncss = "bg-green";
	 		break;
	 		case "MODERATE":
	 			$Ncss = "bg-yellow";
	 		break;
	 		case "HEAVY":
	 			$Ncss = "bg-red";
	 		break;
	 	};

	 	switch(str_replace(" TRAFFIC", "" ,$SouthBound)){
	 		case "LIGHT":
	 			$Scss = "bg-green";
	 		break;
	 		case "MODERATE":
	 			$Scss = "bg-yellow";
	 		break;
	 		case "HEAVY":
	 			$Scss = "bg-red";
	 		break;
	 	};
			echo '
				<div class="modal-header sidebar-css">
					<button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
					<strong><h4 class="modal-title">'.$market_info['location_name'].' Statistics</h4></strong>
				</div>
				<div class="container-fluid modal-body">
					<div class="row" >
						 <span class="col-md-6"><h4><b>Current Status:</b></h4></span>
						 <span class="col-md-6">'.$updatetime.'</span>
					</div><br>
					<div class="row">
					<div class="col-md-4 col-lg-4 col-xs-4"><b>North Bound</b><br><span class="badge '.$Ncss.'">'.$NorthBound.'</span></div>
					<div class="col-md-4 col-lg-4 col-xs-4"></div>
					<div class="col-md-4 col-lg-4 col-xs-4"><b>South Bound</b><br><span class="badge '.$Scss.'">'.$SouthBound.'</span></div>
					</div>

					<div class="row">
						<span class="col-md-12"><center><h4><b>Traffic Level Probability Table</b></h4></center></span>

					</div>
					<div class="row">
						<span class="col-lg-12"><center>
							<table class="table table-condensed">
							<tr class="odd">
								<th>Low Traffic</th>
								<th>Medium Traffic</th>
								<th>High Traffic</th>
							</tr>
							<tr class="odd">
								<td><span class="badge bg-red">88% Chance</span></td>
								<td><span class="badge bg-green">10% Chance</span></td>
								<td><span class="badge bg-orange">55% Chance</span></td>
							</tr>
							
						</table>
						</center></span
					</div>

					<div class="row">
						 <span class="col-md-8"></span>
						 <span class="col-md-4"><a  href="statistics.php?location='.$market_info['location_name'].'"><button role="button" class="btn btn-flat	"><i class="fa fa-bar-chart" style="font-size:22px;"></i> View Full Statistics</button></a></span>
						 
					</div>
				</div>';
		
		
		}
	}
?>