<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	
?>

<div class="fadeMe" id="loading"></div>
<div class="loader" id="loading1"></div>	

<div class="wrapper-content">
	
	<div id="map" style="height: 100%; width:100%;">
	  
	</div>


	
			<div class="navbar navbar-inverse navbar-fixed-bottom" style='background-color: transparent ; border:transparent;'>
			
				<div class="navbar-header2" >
					<center>
						<button type="button" id="click_advance" class="btn btn-circle bg-orange btn-lg  wave-circle" data-toggle="collapse" data-target=".navbar-collapse-bottom">
							<span class="glyphicon glyphicon-chevron-down hvr-sink"></span>
						</button>
					</center>
				</div>
			
				<div class="navbar-collapse-bottom collapse sidebar-css"  id="CollapseFoot">
					<div class = "row">
						<div class="col-xs-2 margin">
							<strong>Who we Are</strong><br>
						<p align="justify">
							Thriftr was an idea at local hackathon that aims to help the community be aware of the current prices of commodities in their area.
							Now being developed and maintained by a small group, Thriftr aims to becoming the first online catalogue map.
						</p>
						
						</div>
					<div class="col-xs-4 margin">
					<strong>What is Thriftr?</strong><br>
							<p align="justify">
							Thirftr is online catalogue map for your local market goods and basic commodities. Be aware of what's the cheapest around you by searching the area.
						</p> <br><strong>Visit Us On:</strong><br>
							<button type="button" class="btn btn-circle btn-lg  wave-circle" style="background:#a9a9a9;">
								<span class="fa fa-facebook" style="font-size: 150%;"></span>
							</button>
							<button type="button" class="btn btn-circle btn-lg  wave-circle" style="background:#a9a9a9;">
								<span class="fa fa-twitter" style="font-size: 150%;"></span>
							</button>
							<button type="button" class="btn btn-circle btn-lg  wave-circle" style="background:#a9a9a9; ">
								<span class="fa fa-instagram" style="font-size: 150%;"></span>
							</button>
					</div>
						<div class="col-xs-5 margin pull-right">
							<strong>More Questions?</strong><br>
							<form action="#">
							
								<label for="your_email" class="control-label">From:</label>
									<input type="email" class="form-control" placeholder="Your Email" name="your_email">
								<label>To:</label>
									<input type="email" class="form-control" placeholder="info@thriftr.com.ph" name="email" disabled>
								<label>Email</label>
									<textarea type="text" class="form-control" rows="3" placeholder="Enter Message" name="msg"></textarea><br>
								<input type="submit" class="btn bg-orange wave-button2"></button>
							</form>
						</div>
				</div>
			
			</div>
		</div>
</div>




	<?php addComponent('sidebar');?>
	<aside class="control-sidebar control-sidebar-light">
	<!-- Content of the sidebar goes here -->
		<table>
			<tr>
				<th>Product</th>
				<th>Price</th>
			</tr>
				<tr>
					<td>Product1</td>
					<td>Price1</td>
				</tr>
				<tr>
					<td>Product2</td>
					<td>Price2</td>
				</tr>
		</table>
	</aside>
	<div class="control-sidebar-bg"></div>
	
</div>

<?php
	addComponent('modals/shopmodal');
	addComponent('foot');
?>

<script type="text/javascript">
	google.maps.event
 .addListenerOnce(map, 'tilesloaded', function(){
	// setLocation();
	setShops();
 });					
</script>
