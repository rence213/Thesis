<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	$query = $connection -> myQuery("SELECT location_name from location_dimension");
	
?>

<div class="container-fluid parallax2">

	<div class="row" style="height:50rem; margin-top:6rem;">

		<div class="col-lg-6"  style="height:40rem;overflow:auto;overflow-y: scroll;">
			<div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Road Structure</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-bordered table-striped dataTable">
                <tbody id="tbod">
                <tr id="tablehead">
                  <th>Road Name</th>
                  <th>Has Bus Stop</th>
                  <th>Has Pedestrian Lane</th>
                  <th>Has U Turn</th>
                  <th>Intersection</th>
                  <th>Mrt Stop</th>
                </tr>
                <?php
                	$query2 = $connection -> myQuery("SELECT * FROM roadstructures;");
                	while ($row2 = $query2 -> fetch(PDO::FETCH_ASSOC)){


                ?>
               	<tr role="row" class="odd">
                  <td><?php echo $row2['road_location'];?></td>
                  <td><?php echo $row2['bus_stop'];?></td>
                  <td><?php echo $row2['pedestrian_lane'];?></td>
                  <td><?php echo $row2['uturn_slot'];?></td>
                  <td><?php echo $row2['intersection'];?></td>
                  <td><?php echo $row2['mrt_stop'];?></td>
                </tr>
                <?php
                }?>
             	 </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		</div>
		<div class="col-lg-3">
		</div>
		<div class="col-lg-3">
			<div class="info-box">
	            <span class="info-box-icon bg-red"><i class="fa fa-automobile" style="margin-top:2rem;"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Accidents in EDSA</span>
	              <span class="info-box-number"><?php 
	              	$query3 = $connection -> myQuery("SELECT COUNT(*) as count FROM trafficwarehouse_updated.stg_road_acc;");
	              	$row = $query3 -> fetch(PDO::FETCH_ASSOC);
	              echo $row['count'];
	              ?></span>Recorded accidents
	            </div>
	            <!-- /.info-box-content -->
	          </div>

	          

		</div>
	</div>

	<div class="row" style=" margin-left:1rem;"><h2><b>Historic Statistics</b></h2><a href="http://thehackerdudes.com/T4-thesis/t4/statistics.php"><button role="button" class="btn btn-flat bg-green">Go To Realtime</button></a></div>

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
			<span class="col-lg-10" id="chart" style="height:51rem; background-color:white;">
			<canvas id="myChart"></canvas>
				
			</span>
			<span class="col-lg-1"></span>
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
	 <div class="col-lg-6" id="chart2" style="height:32rem; background-color:white;"><canvas id="myChart2"></canvas></div>
	 <div class="col-lg-6" id="chart3" style="height:32rem; background-color:white;"><canvas id="myChart3"></canvas></div>
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
	 <div class="col-lg-6" id="chart4" style="height:32rem; background-color:white;"><canvas id="myChart4"></canvas></div>
	 <div class="col-lg-6" id="chart5" style="height:32rem; background-color:white;"><canvas id="myChart5"></canvas></div>
	 </div>

	  </div>
	 <div class="row" style="margin-left:5rem;">
	 <div class="col-lg-6" id="text3"></div>
	 <div class="col-lg-6" id="text4"></div>
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
var sum = 0;
      		var temparray = [];
			for( var i = 0; i < high.length; i++ ){
				if(high[i]!=0){
				temparray.push(high[i]);
			    sum += parseInt( high[i], 10 );
			    } //don't forget to add the base
			}
			var avg = sum/temparray.length;
			var text1 = "Average Occurences Of High Traffic on this day: <b>"+Math.round(avg)+"</b> <br>"		
			var temp = [];
			$.each(response['N'], function(i, item) {
			  if(item['H']>=avg){
			  	temp.push(i);
			  }
			});

			if(temp.length>0){
				text1 += "Peak Hours: ";
				for( var i = 0; i < temp.length; i++ ){
					if(temp[i]>=10){
 						var time = temp[i]+"00000";
				    	time = time.slice(0,4);
				    	time = makeTime(time);
					}else{
						var time = temp[i]+":00am";
					}
			    	text1 += "<b>"+time+" </b>";
				}
			}
			document.getElementById("text3").innerHTML = text1;
      		

			data = {
			
    labels: Object.keys(response['N']),
    datasets: [
        {
            label: "LOW",
            backgroundColor: "#FF992B",
            data: low
        },
        {
            label: "MEDIUM",
            backgroundColor: "#1477C3",
            data: medium
        },
        {
            label: "HIGH",
            backgroundColor: "#8712C7",
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

      			var sum = 0;
      		var temparray = [];
			for( var i = 0; i < high.length; i++ ){
				if(high[i]!=0){
				temparray.push(high[i]);
			    sum += parseInt( high[i], 10 );
			    } //don't forget to add the base
			}
			var avg = sum/temparray.length;
			var text1 = "Average Occurences Of High Traffic on this day: <b>"+Math.round(avg)+"</b> <br>"		
			var temp = [];
			$.each(response['S'], function(i, item) {
			  if(item['H']>=avg){
			  	temp.push(i);
			  }
			});

			if(temp.length>0){
				text1 += "Peak Hours: ";
				for( var i = 0; i < temp.length; i++ ){
				    if(temp[i]>=10){
 						var time = temp[i]+"00000";
				    	time = time.slice(0,4);
				    	time = makeTime(time);
					}else{
						var time = temp[i]+":00am";
					}
			    	text1 += "<b>"+time+" </b>";

				}
			}
			document.getElementById("text4").innerHTML = text1;

			data = {
			
    labels: Object.keys(response['S']),
    datasets: [
        {
            label: "LOW",
            backgroundColor: "#FF992B",
            data: low
        },
        {
            label: "MEDIUM",
            backgroundColor: "#1477C3",
            data: medium
        },
        {
            label: "HIGH",
            backgroundColor: "#8712C7",
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

 function makeTime(fourDigitTime) {
    /* make sure add radix*/
    var hours24 = parseInt(fourDigitTime.substring(0, 2),10);
    var hours = ((hours24 + 11) % 12) + 1;
    var amPm = hours24 > 11 ? 'pm' : 'am';
    var minutes = fourDigitTime.substring(2);

    return hours + ':' + minutes + amPm;
};


function resetCanvas3() {
  $('#myChart4').remove(); // this is my <canvas> element
  $('#chart4').append('<canvas id="myChart4"></canvas>');

  $('#myChart5').remove(); // this is my <canvas> element
  $('#chart5').append('<canvas id="myChart5"></canvas>');
};

	
</script>

