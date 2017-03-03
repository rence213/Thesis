<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	$query = $connection -> myQuery("SELECT location_name from location_dimension");
	
?>

<div class="container-fluid">

	<div class="row" style=" margin-left:1rem; margin-top: 5rem;"><h2><b>Statistics</b></h2></div>
	<hr class="style4">
	
	 <div class="row">
	 	<h4><center><b>Historical Level count Daily or Hourly</b></center></h4>
	 	<br>
	 </div>
	<div class="row">
		<div class="col-lg-3">
			<select class="form-control select2 select2-hidden-accessible" id='location' aria-hidden="true">
				<option selected="selected" disabled>-Location-</option>
					<?php
						while($row = $query->fetch(PDO::FETCH_ASSOC)){
									$selected ="";
							if($row['location_name']==$_GET['location']){
									$selected = 'selected';
							}
							echo "<option ".$selected.">".$row['location_name']."</option>";
						}
					?>
			</select>
		</div>
		
		<div class="col-lg-1">
			
				
					<label>
						<input type="radio" onclick="intervalCheck()" name="intervaldateOptions" value="0" id="intervalOption_Daily"  checked></input>
						 Daily
					</label>
				
			    
				<label>
					<input type="radio" onclick="intervalCheck()" name="intervaldateOptions" value="1" id="intervalOption_Hourly" ></input>
						 Hourly
					</label>
		</div>
			
		<form id="subform" name="myform" novalidate>
		<div class="col-lg-5" >
			<div id="daily_option">
				<span class="col-lg-6">
					<label>From Date:</label>
					<div class="input-group date " data-provide="datepicker">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-calendar"></i>
						</div>
								<input type="text"  name="daily1" class="form-control" placeholder="mm/dd/yyyy"  id="fromdate" required>
					</div>
				</span>
				<span class="col-lg-6">
					<label>To Date:</label>
						<div class="input-group date" data-provide="datepicker">
							<div class="input-group-addon">
								<i class="glyphicon glyphicon-calendar"></i>
							</div>
								<input type="text"  name="daily" class="form-control" placeholder="mm/dd/yyyy"  id="todate" required>
						</div>
				</span>
			</div>
					
			<div id="hourly_option" style="display:none;" >
				<span class="col-lg-6">
					<label>Day Of:</label>
					<div class="input-group date " data-provide="datepicker">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-calendar"></i>
						</div>
							<input type="text" name="hourly" class="form-control" placeholder="mm/dd/yyyy"  id="onedaydate" required>
						</div>
				</span>
			</div>
		</div>

		<div class="col-lg-2">
							<button id="visualize" class="btn btn-flat bg-purple col-lg-8"><i class="glyphicon glyphicon-eye-open" style="margin-left:0rem; margin-right:1rem;"></i>   Visualize</button>
			</div>
		</form>
	</div>


	

	<div class="row"  style="margin-top:2rem;">
			<center>
				<h3>
					<b><span id="locationtext"></span></b>
					<span id ="intervaltext"></span><br>
					<span id="datetext"></span>
				</h3>
			</center>
	</div>

		<div class="row" id="graph-container" style="margin-top:2rem;">
			<span class="col-lg-1"></span>
			<span class="col-lg-10" id="chart" style="height:50rem;">
			<canvas id="myChart"></canvas>
				
			</span>
			<span class="col-lg-1"></span>
		</div>

	</div>

<br><br>
	<div class="row"><hr class="style4">
	 	<h4><center><b> Summary Weekly Behavior of a Location</b></center></h4>
	 
	 </div>
	 <form id="subform2">
	 <div class="row" style="margin-left:5rem;">
	 	<div class="col-lg-5">
			<select class="form-control select2 select2-hidden-accessible" id='location2' aria-hidden="true">
				<option selected="selected" disabled>-Location-</option>
					<?php
					$query = $connection -> myQuery("SELECT location_name from location_dimension");
						while($row = $query->fetch(PDO::FETCH_ASSOC)){
									$selected ="";
							if($row['location_name']==$_GET['location']){
									$selected = 'selected';
							}
							echo "<option ".$selected.">".$row['location_name']."</option>";
						}
					?>
			</select>
		</div>
		<div class="col-lg-2">
				<button id="visualize" class="btn btn-flat bg-purple col-lg-8"><i class="glyphicon glyphicon-eye-open" style="margin-left:0rem; margin-right:1rem;"></i>   Visualize</button>
		</div>
	 </div>
	 </form>
	 <br>
	 <div class="row">
	 <div class="col-lg-6"><b><center>North Bound</center></b></div>
	 <div class="col-lg-6"><b><center>South Bound</center></b></div>
	 </div>
	  <div class="row">
	 <div class="col-lg-6" id="chart2" style="height:40rem;"><canvas id="myChart2"></canvas></div>
	 <div class="col-lg-6" id="chart3" style="height:40rem;"><canvas id="myChart3"></canvas></div>
	 </div>

 	<div class="row" style="margin-left:5rem;">
	 <div class="col-lg-6" id="text1"></div>
	 <div class="col-lg-6" id="text2"></div>
	 </div>

<br><br>
	<div class="row"><hr class="style4">
	 	<h4><center><b> Summary Hourly Behavior of a Location Per Day</b></center></h4>
	 
	 </div>
	 <form id="subform3">
	 <div class="row" style="margin-left:5rem;">
	 	<div class="col-lg-5">
			<select class="form-control select2 select2-hidden-accessible" id='location3' aria-hidden="true">
				<option selected="selected" disabled>-Location-</option>
					<?php
					$query = $connection -> myQuery("SELECT location_name from location_dimension");
						while($row = $query->fetch(PDO::FETCH_ASSOC)){
									$selected ="";
							if($row['location_name']==$_GET['location']){
									$selected = 'selected';
							}
							echo "<option ".$selected.">".$row['location_name']."</option>";
						}
					?>
			</select>
		</div>
		<div class="col-lg-2">
			<select class="form-control select2 select2-hidden-accessible" id='weekday' aria-hidden="true">
				<option selected="selected" disabled>-Weekday-</option>
				<option value="Monday">Monday</option>
				<option value="Tuesday">Tuesday</option>
				<option value="Wednesday">Wednesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Friday">Friday</option>
				<option value="Saturday">Saturday</option>
				<option value="Sunday">Sunday</option>
			</select>
		</div>
		<div class="col-lg-2">
				<button id="visualize" class="btn btn-flat bg-purple col-lg-8"><i class="glyphicon glyphicon-eye-open" style="margin-left:0rem; margin-right:1rem;"></i>   Visualize</button>
		</div>
	 </div>
	 </form>
	 <br>
	 <div class="row">
	 <div class="col-lg-6"><b><center>North Bound</center></b></div>
	 <div class="col-lg-6"><b><center>South Bound</center></b></div>
	 </div>
	   <div class="row">
	 <div class="col-lg-6" id="chart4" style="height:40rem;"><canvas id="myChart4"></canvas></div>
	 <div class="col-lg-6" id="chart5" style="height:40rem;"><canvas id="myChart5"></canvas></div>
	 </div>

</div>







<?php
	addComponent('foot');
?>
<script src="js/stat.js"></script>
<script text = "text/javascript">
$('#subform3').submit(function () {
		

       resetCanvas3();
       var ctx4 = document.getElementById("myChart4").getContext("2d");
       var ct5 = document.getElementById("myChart5").getContext("2d");
       var e = document.getElementById("location3");
	   var location = e.options[e.selectedIndex].text;
	   var e = document.getElementById("weekday");
	   var weekday = e.options[e.selectedIndex].text;
     $.get('php/getGraph.php',{request:'trafficCountHourlyBehavior','week':weekday, 'location':location},function(response){
      		console.log(response);
      		var data = [];
      		var low = [];
      		var medium = [];
      		var high = [];
      		$.each(response['N'], function(i, item) {
			  low.push(item['L']);
			  medium.push(item['M']);
			  high.push(item['H']);
			});

      		

			data = {
			
    labels: Object.keys(response['N']),
    datasets: [
        {
            label: "LOW",
            backgroundColor: "blue",
            data: low
        },
        {
            label: "MEDIUM",
            backgroundColor: "yellow",
            data: medium
        },
        {
            label: "HIGH",
            backgroundColor: "red",
            data: high
        }																																						
    ]
	};
		var myBarChart4 = new Chart(ctx4, {
		    type: 'bar',
		    data: data,
		    options: {
		        barValueSpacing: 0,
		        scales: {
		            yAxes: [{
		                ticks: {
		                    min: 0,
		                }
		            }]
		        }
		    }
		});

		var data = [];
      		var low = [];
      		var medium = [];
      		var high = [];
      		$.each(response['S'], function(i, item) {
			  low.push(item['L']);
			  medium.push(item['M']);
			  high.push(item['H']);
			});

      		

			data = {
			
    labels: Object.keys(response['S']),
    datasets: [
        {
            label: "LOW",
            backgroundColor: "blue",
            data: low
        },
        {
            label: "MEDIUM",
            backgroundColor: "yellow",
            data: medium
        },
        {
            label: "HIGH",
            backgroundColor: "red",
            data: high
        }																																						
    ]
	};
		var myBarChart5 = new Chart(ct5, {
		    type: 'bar',
		    data: data,
		    options: {
		        barValueSpacing: 0,
		        scales: {
		            yAxes: [{
		                ticks: {
		                    min: 0,
		                }
		            }]
		        }
		    }
		});
      	
      	

      }

      	,'json').fail(function(response){
      		console.log(response);
      })
	 return false;
	});

function resetCanvas3() {
  $('#myChart4').remove(); // this is my <canvas> element
  $('#chart4').append('<canvas id="myChart4"></canvas>');

  $('#myChart5').remove(); // this is my <canvas> element
  $('#chart5').append('<canvas id="myChart5"></canvas>');
};

	
</script>

