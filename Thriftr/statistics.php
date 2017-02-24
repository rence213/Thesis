<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	$query = $connection -> myQuery("SELECT location_name from location_dimension");
	
?>

<div class="container-fluid">

	<div class="row" style=" margin-left:1rem; margin-top: 5rem;"><h2><b>Statistics</b></h2></div>
	 
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
					<span id="location">fdsf</span>
					<span id ="interval">das</span>
					<span id="date">ads</span>
			</center>
	</div>

		<div class="row"  style="margin-top:2rem;">
			<span class="col-lg-1"></span>
			<span class="col-lg-10" id="chart" style="height:50rem;">
			<canvas id="myChart"></canvas>
				
			</span>
			<span class="col-lg-1"></span>
		</div>

	</div>
	
</div>




<?php
	addComponent('foot');
?>
<script = "text/javascript">

	 function view() {
			document.getElementById('intervalOptions').style.display='none';
	}
	
	function intervalCheck() {
        if (document.getElementById('intervalOption_Daily').checked) {
		console.log("dasd");
            document.getElementById('daily_option').style.display = 'block';
			document.getElementById('hourly_option').style.display = 'none';
			document.getElementById('hourly_option').style.display = 'none';
        } 
			else {
				document.getElementById('daily_option').style.display = 'none';
				document.getElementById('hourly_option').style.display = 'block';
			}
		}
		var ctx = document.getElementById("myChart").getContext("2d");


var data = {
    labels: ["Chocolate", "Vanilla", "Strawberry"],
    datasets: [
        {
            label: "LOW",
            backgroundColor: "blue",
            data: [3,7,4]
        },
        {
            label: "MEDIUM",
            backgroundColor: "red",
            data: [4,3,5]
        },
        {
            label: "HIGH",
            backgroundColor: "green",
            data: [7,2,6]
        }
    ]
};

var myBarChart = new Chart(ctx, {
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

 $("#visualize").click(function(){
      
   //    var e = document.getElementById("location");
	  // var location = e.options[e.selectedIndex].text;
   //    $.get('php/getGraph.php',{request:'trafficCount', 'interval' : interval, 'location':location},function(response){

   //    }
   //    	,'json').fail(function(response){
   //    		console.log(response);
   //    })
  });

 $('#subform').submit(function () {
		switch($('input[name="intervaldateOptions"]:checked').val()){
      	case '0': var interval = 'daily';  break;
      	case '1': var interval = 'hourly';  break;
      }
        var e = document.getElementById("location");
	   var location = e.options[e.selectedIndex].text;
	   var todate = document.getElementById("todate").value;
	   var fromdate = document.getElementById("fromdate").value;
	   var onedaydate = document.getElementById("onedaydate").value;
	  	
	  	var dates = {'fromdate': fromdate, 'todate': todate, 'onedaydate':onedaydate};
     $.get('php/getGraph.php',{request:'trafficCount', 'interval' : interval, 'location':location, 'dates':dates},function(response){
      		console.log(response);

      		var data = [];
      		var data = {
    labels: ["Chocolate", "Vanilla", "Strawberry"],
    datasets: [
        {
            label: "LOW",
            backgroundColor: "blue",
            data: [3,7,4]
        },
        {
            label: "MEDIUM",
            backgroundColor: "red",
            data: [4,3,5]
        },
        {
            label: "HIGH",
            backgroundColor: "green",
            data: [7,2,6]
        }
    ]
};

      }

      	,'json').fail(function(response){
      		console.log(response);
      })
	 return false;
	});

	
</script>

