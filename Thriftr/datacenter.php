<?php
	require_once('support/support.php');
	
	

	if(isset($_SESSION[APPNAME]['UserId'])){
		addComponent('head');
		addComponent('navbar2');

		//ajax this part//
		$trafficCount = $connection -> myQuery('SELECT COUNT(id) as traffic FROM stg3_traffic_table;')->fetch(PDO::FETCH_ASSOC);
		$weatherCount = $connection -> myQuery('SELECT COUNT(mean) as weather FROM stg_weather;')->fetch(PDO::FETCH_ASSOC);
		$accCount = $connection -> myQuery('SELECT COUNT(*) as acc FROM stg_road_acc;')->fetch(PDO::FETCH_ASSOC);
		$eveCount = $connection -> myQuery('SELECT COUNT(mall_name) as eve FROM event;')->fetch(PDO::FETCH_ASSOC);
	}else{
		redirect('index.php');
	}
	
?>



<div class="parallax" >
	
	<div >
		<div style="position:absolute;top:15rem; color:white; background-color: rgba(0, 0, 0, 0.7); width:30%; ">
			<h1 class="pull-right" style="margin-right: 40px"><strong>Data Center</strong></h1>
		</div>

		<!-- <div style="position:absolute;top:15rem; right:0; height:100px;  width:30%; ">
			<img src="img/mmda.png" style="height:150px;width:150px;"/>
			<img src="img/Pagasa_logo.png" style="height:150px;width:150px;"/>
			<img src="img/dpwh.png" style="height:150px;width:150px;"/>
		</div> -->

		<div class="container-fluid" style="position:absolute;top:50rem; background-color: #e6e6e6; width:100%; height:100rem;">
			<span class="row">
				<span class="col-md-6">
				<h2>
					Data Center
				</h2>
				<p> Comprises of all the data from the Data Warehouse that are from different sources available for download.</p>
				
				<br>
				</span>
				<span class="col-md-6">
				<br>
				<br>
				
				</span>
			</span>
			<br>
			<h3>Real Time Records</h3>	
			<br>
			<span class="row">
				<span class="col-md-3">
				<div class="small-box bg-green">
		            <div class="inner">
		              <h3>Traffic</h3>
		              <p>35,300,000 Records</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-car"></i>
		            </div>
		            <a href="#" class="small-box-footer">Download <i class="fa fa-download"></i></a>
		          </div>		
				
				</span>
				<span class="col-md-3">
				<div class="small-box bg-green">
		            <div class="inner">
		              <h3>Weather</h3>
		              <p>35,300 Records</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-cloud"></i>
		            </div>
		            <a href="#" class="small-box-footer">Download <i class="fa fa-download"></i></a>
		          </div>		
				
				</span>

				<span class="col-md-6">
					<p>Real Time Records are records that are recorded from the web scrapers of this application. 
					<br>It gets merged to the historical data sources every 12mn.</p>	
					<br>
					SOURCES:<br>
					<ul>
						<li>Traffic Navigator TV5</li>
						<li>Weather API (Apimux.com)</li>
					</ul>
				</span>
			</span>

			<br>
			<h3>Historical Records</h3>	
			<br>
			<span class="row">
				<span class="col-md-3">
				<div class="small-box bg-aqua">
		            <div class="inner">
		              <h3>Accidents</h3>
		              <p><?php echo number_format($accCount['acc']); ?> Records</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-warning"></i>
		            </div>
		            <a href="downloaddata.php?type=Accident" class="small-box-footer">Download <i class="fa fa-download"></i></a>
		          </div>		
				
				</span>

				<span class="col-md-3">
				<div class="small-box bg-aqua">
		            <div class="inner">
		              <h3>Mall Sales</h3>
		              <p><?php echo number_format($eveCount['eve']); ?> Records</p>
		            </div>
		            <div class="icon">
		              <i class="fa  fa-building-o"></i>
		            </div>
		            <a href="downloaddata.php?type=Mall" class="small-box-footer">Download <i class="fa fa-download"></i></a>
		          </div>		
				
				</span>
					<span class="col-md-6">
					<p>Historical Records are past records that have been recorded by the application merged with the encoded datasets from the respective Sources</p>	
					<br>
					SOURCES:<br>
					<ul>
						<li>Traffic Navigator TV5</li>
						<li>Weather API (Apimux.com)</li>
						<li>PAG-ASA Science Garden Data</li>
						<li>Road Safety Unit MMARS</li>
						<li>MALL Sales ()</li>

					</ul>
				</span>
				
			</span>
			<span class="row">
				<span class="col-md-3">
				<div class="small-box bg-aqua">
		            <div class="inner">
		              <h3>Traffic</h3>
		              <p><?php echo number_format($trafficCount['traffic']); ?> Records</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-car"></i>
		            </div>
		            <a href="downloaddata.php?type=Traffic" class="small-box-footer">Download <i class="fa fa-download"></i></a>
		          </div>		
				
				</span>

				<span class="col-md-3">
				<div class="small-box bg-aqua">
		            <div class="inner">
		              <h3>Weather</h3>
		              <p><?php echo number_format($weatherCount['weather']); ?> Records</p>
		            </div>
		            <div class="icon">
		              <i class="fa  fa-cloud"></i>
		            </div>
		            <a href="downloaddata.php?type=Weather" class="small-box-footer">Download <i class="fa fa-download"></i></a>
		          </div>		
				
				</span>
					
				
			</span>

		</div>
	</div>



	
</div>

<?php
	addComponent('foot');
?>

