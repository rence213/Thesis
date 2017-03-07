<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	
	$query = $connection -> myQuery("SELECT area_id,location_name from location_dimension");


?>

<div class="container-fluid">
		<form id="myForm">
		<div class="row" style=" margin-left:1rem; margin-top: 5rem;"><h2><b>Forecast</b></h2></div>
			<div class="row" style=" margin-left:1rem; margin-top: 2rem;"><p> This is used to forecast upto 24 hours of probabilities per road</p></div>
		<div class="row" style="margin-top: 5rem;">
			<span class="col-lg-3">
				<select required class="form-control select2 select2-hidden-accessible" id='location' name="location" aria-hidden="true" data-role="none">
				<option selected="selected" value="" disabled>-Location-</option>
					<?php
						while($row = $query->fetch(PDO::FETCH_ASSOC)){
									$selected ="";
							if($row['location_name']==$_GET['location']){
									$selected = 'selected';
							}
							echo "<option ".$selected." value='".$row['area_id']."'>".$row['location_name']."</option>";
						}
					?>
			</select>
			</span>
			<!--
			<span class="col-lg-2">
				<div class="input-group date " data-provide="datepicker">
					<div class="input-group-addon">
				        <i class="glyphicon glyphicon-calendar"></i>
					</div>
			    	<input type="text" class="form-control" placeholder="From: mm/dd/yyyy"  id="fromdate" required>
				</div>
			</span>
			<span class="col-lg-2">
				<div class="input-group date " data-provide="datepicker">
					<div class="input-group-addon">
				        <i class="glyphicon glyphicon-calendar"></i>
						</div>
			    	<input type="text" class="form-control" placeholder="To: mm/dd/yyyy"  id="todate" required>
				</div>
			</span>
			-->
			<span class="col-lg-3">
				<div class="input-group">
				<select class="form-control select2 select2-hidden-accessible" aria-hidden="true" id="fromdate" required>
					<option selected="selected" value="" disabled>-Time-</option>
					<option>0</option><option>1</option><option>2</option><option>3</option>
					<option>4</option><option>5</option><option>6</option><option>7</option>
					<option>8</option><option>9</option><option>10</option><option>11</option>
					<option>12</option><option>13</option><option>14</option><option>15</option>
					<option>16</option><option>17</option><option>18</option><option>19</option>
					<option>20</option><option>21</option><option>22</option><option>23</option>
				</select>
						<div class="input-group-addon">to</div>
				<select class="form-control select2 select2-hidden-accessible" aria-hidden="true" id="todate" required>
					<option selected="selected" value="" disabled>-Time-</option>
					<option>0</option><option>1</option><option>2</option><option>3</option>
					<option>4</option><option>5</option><option>6</option><option>7</option>
					<option>8</option><option>9</option><option>10</option><option>11</option>
					<option>12</option><option>13</option><option>14</option><option>15</option>
					<option>16</option><option>17</option><option>18</option><option>19</option>
					<option>20</option><option>21</option><option>22</option><option>23</option>
				</select>
				</div>
			</span>
				<span class="col-lg-2">

					<button class="btn btn-flat bg-green col-lg-12"> Forecast<i class="ion ion-arrow-graph-up-right" style="margin-left:2rem; font-size:2rem;"></i> </button>
			</span>
		</div><br>
		<div class="row" style="margin-top:5rem;">
			
			<span class="col-lg-8" style="background-color:white; "><center>North bound</center></span>
			<span class="col-lg-4"></span> 
		</div>
		<div class="row" style="">
			
			<span class="col-lg-8" id='chart' style="background-color:white; height:50rem;"><canvas id="myChart"></canvas></span>
			<span class="col-lg-4"><div class="row">
			<div class="col-lg-12" style="overflow:scroll;height:40rem;">
				<div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Probability Matrix</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body no-padding">
	              <table class="table table-bordered table-striped dataTable">
	              <thead>
	              	 <th>Hour</th>
	                  <th>Low</th>
	                  <th>Medium</th>
	                  <th>High</th>
	                 
	              </thead>
	                <tbody id="tbod">
	                 </tbody>
	              </table>
	            </div>
	            <!-- /.box-body -->
	          </div>
			</div>
		</div></span>
		</div>
		
		<div class="row" style="margin-top:3rem;">
			<span class="col-lg-8" style="background-color:white; "><center>South Bound</center></span>
			<span class="col-lg-4"></span>
		</div>
		<div class="row" style="">
			<span class="col-lg-8" id='chart2' style="background-color:white; height:50rem;"><canvas id="myChart2"></canvas><br></span>
			<span class="col-lg-4">
					<div class="row">
			<div class="col-lg-12" style="overflow:scroll;height:40rem;">
				<div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Probability Matrix</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body no-padding">
	              <table class="table table-bordered table-striped dataTable">
	              <thead>
	              	 <th>Hour</th>
	                  <th>Low</th>
	                  <th>Medium</th>
	                  <th>High</th>
	                 
	              </thead>
	                <tbody id="tbod2">
	                 </tbody>
	              </table>
	            </div>
	            <!-- /.box-body -->
	          </div>
			</div>
		</div>
			</span>
		</div>
		<br>
				
		</form>
		
		


	
</div>



<?php
	addComponent('foot');
?>
<script = "text/javascript">
	 var ctx = document.getElementById("myChart").getContext("2d");
	 var ctx2 = document.getElementById("myChart2").getContext("2d");
		var data = {
	    labels: ["January", "February", "March", "April", "May", "June", "July"],
	    datasets: [
	        {
	            label: "High",
	            fill: false,
	            lineTension: 0.2,
	           backgroundColor: "rgba(217,95,14,0.4)",
	            borderColor: "rgba(217,95,14,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(0,0,0,1)",
	            pointBackgroundColor: "rgba(0,0,0,1)",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(217,95,14,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: 0,
	            spanGaps: false,
	        },
	         {
	            label: "Medium",
	            fill: false,
	            lineTension: 0.2,
	           backgroundColor: "rgba(127,205,187,0.4)",
	            borderColor: "rgba(127,205,187,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(0,0,0,1)",
	            pointBackgroundColor: "rgba(0,0,0,1)",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(127,205,187,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: 0,
	            spanGaps: false,
	        },
	         {
	            label: "Low",
	            fill: false,
	            lineTension: 0.2,
	            backgroundColor: "rgba(49,163,84,0.4)",
	            borderColor: "rgba(49,163,84,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(0,0,0,1)",
	            pointBackgroundColor: "rgba(0,0,0,1)",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(49,163,84,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: 0,
	            spanGaps: false,
	        }
	    ]
	};
		 var myLineChart = new Chart(ctx, {
	    type: 'line',
	    data: data,
	    options : {
	  scales: {
	    yAxes: [{
	      scaleLabel: {
	        display: true,
	        labelString: 'Probability',
	        fontStyle: 'bold',
	        fontSize: 20

	      }
	    }], xAxes: [{
	      scaleLabel: {
	        display: true,
	        labelString: 'Hours',
	        fontStyle: 'bold',
	        fontSize: 20
	      }
	    }]
	  }
	}
	});
		  var myLineChart2 = new Chart(ctx2, {
	    type: 'line',
	    data: data,
	    options : {
	  scales: {
	    yAxes: [{
	      scaleLabel: {
	        display: true,
	        labelString: 'Probability',
	        fontStyle: 'bold',
	        fontSize: 20

	      }
	    }], xAxes: [{
	      scaleLabel: {
	        display: true,
	        labelString: 'Hours',
	        fontStyle: 'bold',
	        fontSize: 20
	      }
	    }]
	  }
	}
	});

	$('#myForm').submit(function () {
		var area_id = document.getElementById('location').value;
		var todate = document.getElementById('todate').value;
		var fromdate = document.getElementById('fromdate').value;
		$.get('php/getPredictions.php',{request:'getHourPrediction','area_id':area_id, 'todate':todate, 'fromdate':fromdate },function(response){
      		console.log(response);
      		resetCanvas();
      		var ctx = document.getElementById("myChart").getContext("2d");
      		var ctx2 = document.getElementById("myChart2").getContext("2d");
      		var low = [];
      		var medium = [];
      		var high = [];
      		var table1 = "";
      		$.each(response['data']['N'], function(i, item) {
			 low.push(item[1]);
			  medium.push(item[2]);
			  high.push(item[0]);
			  table1 += "<tr><td>"+i+"</td><td>"+(item[1]*100).toFixed(4)+"</td>";
			  table1 += "<td>"+(item[2]*100).toFixed(4)+"</td>";
			  table1 += "<td>"+(item[0]*100).toFixed(4)+"</td></tr>";
			});
      		console.log(table1);
			document.getElementById("tbod").innerHTML = table1;

      		var data = {
    		labels: response['label'],
      		datasets: [
        	{
            label: "High",
            fill: false,
            lineTension: 0.2,
           backgroundColor: "rgba(217,95,14,0.4)",
            borderColor: "rgba(217,95,14,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0,0,0,1)",
            pointBackgroundColor: "rgba(0,0,0,1)",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(217,95,14,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: high,
            spanGaps: false,
        },
         {
            label: "Medium",
            fill: false,
            lineTension: 0.2,
           backgroundColor: "rgba(127,205,187,0.4)",
            borderColor: "rgba(127,205,187,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0,0,0,1)",
            pointBackgroundColor: "rgba(0,0,0,1)",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(127,205,187,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: medium,
            spanGaps: false,
        },
         {
            label: "Low",
            fill: false,
            lineTension: 0.2,
            backgroundColor: "rgba(49,163,84,0.4)",
            borderColor: "rgba(49,163,84,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0,0,0,1)",
            pointBackgroundColor: "rgba(0,0,0,1)",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(49,163,84,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: low,
            spanGaps: false,
        }
    ]
};
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options : {
  scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Probability',
        fontStyle: 'bold',
        fontSize: 20

      }
    }], xAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Hours',
        fontStyle: 'bold',
        fontSize: 20
      }
    }]
  }
}
});
		var low = [];
      		var medium = [];
      		var high = [];
      		table1="";
$.each(response['data']['S'], function(i, item) {
			  low.push(item[1]);
			  medium.push(item[2]);
			  high.push(item[0]);
			  table1 += "<tr><td>"+i+"</td><td>"+(item[1]*100).toFixed(4)+"</td>";
			  table1 += "<td>"+(item[2]*100).toFixed(4)+"</td>";
			  table1 += "<td>"+(item[0]*100).toFixed(4)+"</td></tr>";
			});
      		console.log(table1);
			document.getElementById("tbod2").innerHTML = table1;

      		var data = {
    		labels: response['label'],
      		datasets: [
        	{
            label: "High",
            fill: false,
            lineTension: 0.2,
           backgroundColor: "rgba(217,95,14,0.4)",
            borderColor: "rgba(217,95,14,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0,0,0,1)",
            pointBackgroundColor: "rgba(0,0,0,1)",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(217,95,14,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: high,
            spanGaps: false,
        },
         {
            label: "Medium",
            fill: false,
            lineTension: 0.2,
           backgroundColor: "rgba(127,205,187,0.4)",
            borderColor: "rgba(127,205,187,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0,0,0,1)",
            pointBackgroundColor: "rgba(0,0,0,1)",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(127,205,187,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: medium,
            spanGaps: false,
        },
         {
            label: "Low",
            fill: false,
            lineTension: 0.2,
            backgroundColor: "rgba(49,163,84,0.4)",
            borderColor: "rgba(49,163,84,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0,0,0,1)",
            pointBackgroundColor: "rgba(0,0,0,1)",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(49,163,84,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: low,
            spanGaps: false,
        }
    ]
};

var myLineChart2 = new Chart(ctx2, {
    type: 'line',
    data: data,
    options : {
  scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Probability',
        fontStyle: 'bold',
        fontSize: 20

      }
    }], xAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Hours',
        fontStyle: 'bold',
        fontSize: 20
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

function resetCanvas() {
  $('#myChart').remove(); // this is my <canvas> element
  $('#chart').append('<canvas id="myChart"></canvas>');
   $('#myChart2').remove(); // this is my <canvas> element
  $('#chart2').append('<canvas id="myChart2"></canvas>');
};


</script>

