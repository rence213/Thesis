<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar3');
	
	$query = $connection -> myQuery("SELECT location_name from location_dimension");

	if(isset($_GET['location'])){
		$location = $_GET['location'];
		$direction = $_GET['direction'];
		$month = $_GET['month'];
		$week = $_GET['weekday'];
		$time = $_GET['time'];
		$Humidity = $_GET['humidity'];
		$max = $_GET['max'];
		$min = $_GET['min'];
		$mean = $_GET['mean'];
		$heat_index = 
		round((((-42.379 + 2.04901523*(($mean*(9/5))+32) + 10.14333127*$Humidity - 0.22475541*(($mean*(9/5))+32)*$Humidity - 0.00683783*(($mean*(9/5))+32)*(($mean*(9/5))+32) - 0.05481717*$Humidity*$Humidity + 0.00122874*(($mean*(9/5))+32)*(($mean*(9/5))+32)*$Humidity + 0.00085282*(($mean*(9/5))+32)*$Humidity*$Humidity - 0.00000199*(($mean*(9/5))+32)*(($mean*(9/5))+32)*$Humidity*$Humidity)-32)/1.8));
		
	};

?>
<link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">

<div class="container-fluid" >




<div class="row" style=" margin-left:1rem; margin-top: 5rem;"><h2><b>Make a Prediction</b></h2></div><br>
<hr class="style-one">
<div class="row"> 

	<span class="col-lg-1"></span>
	
	 <?php
		if(isset($_GET['location'])){
	?>
     
	<span class="col-lg-5">
	<div class="info-box">
            <span class="info-box-icon bg-aqua">
            <i class="ion" style="margin-top:2rem;">Low</i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><br>Probability Of Low traffic</span>
              <span class="info-box-number">75.55<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
     </span>
     <span class="col-lg-5">
	<div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion" style="margin-top:2rem;">High</i></span>

            <div class="info-box-content">
              <span class="info-box-text"><br>Probability Of High traffic</span>
              <span class="info-box-number">75.55%</span>
            </div>
            <!-- /.info-box-content -->
          </div>
     </span>
     <?php
     	}else{

     	}
     ?>

     <span class="col-lg-1"></span>
</div>
<hr class="style-one">
<form method="get" action="predict.php">
<div class="row" style=" margin-left:3.5rem; margin-top: 5rem;">
	<div class="col-lg-3">
			<select required class="form-control select2 select2-hidden-accessible" id='location' name="location" aria-hidden="true" data-role="none">
				<option selected="selected" value="" disabled>-Location-</option>
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

		<div  class="col-lg-2">
			<select required class="form-control select2 select2-hidden-accessible" id='direction' name="direction" aria-hidden="true"  required >
				<option selected="selected" value="" disabled>-Direction-</option>
				<option value="N">North Bound</option>
				<option value="S">South Bound</option>
				
			</select>
		</div>

		<div  class="col-lg-2">
			<select required class="form-control select2 select2-hidden-accessible" id='month' name="month" aria-hidden="true"  required >
				<option selected="selected"  value="" disabled>-Month-</option>
				<option value="1">January</option>
				<option value="2">Febuary</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
		</div>

		<div  class="col-lg-2 ">
			<select class="form-control select2 select2-hidden-accessible" id='weekday' name="weekday" aria-hidden="true"  required >
				<option selected="selected" value="" disabled>-Weekday-</option>
				<option value="1">Monday</option>
				<option value="2">Tuesday</option>
				<option value="3">Wednesday</option>
				<option value="4">Thursday</option>
				<option value="5">Friday</option>
				<option value="6">Saturday</option>
				<option value="7">Sunday</option>
			</select>
		</div>
		<div class="col-lg-2">
		<select required class="form-control select2 select2-hidden-accessible" name="time" aria-hidden="true">
					<option selected="selected"  value="" disabled>-Time-</option>
					<option>0</option><option>1</option><option>2</option><option>3</option>
					<option>4</option><option>5</option><option>6</option><option>7</option>
					<option>8</option><option>9</option><option>10</option><option>11</option>
					<option>12</option><option>13</option><option>14</option><option>15</option>
					<option>16</option><option>17</option><option>18</option><option>19</option>
					<option>20</option><option>21</option><option>22</option><option>23</option>
				</select>
		</div>

	</div>
</div>

<br>


<div class="row" style="margin-left:5rem; margin-right:5rem;">
	<span class="col-lg-4">
			<div class="box box-success">
            <div class="box-header with-border">
              <i class="fa  fa-map-signs"></i>
              <h3 class="box-title">Road Structures</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body row" style="padding:2rem;padding-top:1rem;">
            	<div class="col-lg-6">
            	<input type="hidden" name="uturn" value="0"> 
            	 	<input type="checkbox" name="uturn" value="1"> 
            	 	<label>U Turn</label>
            	</div>
            	<div class="col-lg-6">
            	<input type="hidden" name="ped" value="0"> 
            	<input type="checkbox" name="ped" value="1">
            		<label>Pedestrian Lane</label>
            	</div>
            	<div class="col-lg-6">
            	<input type="hidden" name="inter" value="0"> 
            	<input type="checkbox" name="inter" value="1">

            		<label>Intersection</label>
            	 
            	</div>
            	<div class="col-lg-6">
            	<input type="hidden" name="mrt" value="0"> 
            	<input type="checkbox" name="mrt" value="1">

            		<label>MRT Station</label>
            	 
            	</div>
            	<div class="col-lg-6">
            	<input type="hidden" name="bus" value="0"> 
            	<input type="checkbox" name="bus" value="1">

            		<label>Bus Stop</label>
            	 
            	</div>
            </div>
            <!-- /.box-body -->
          </div>
	</span>
	<span class="col-lg-4">
			<div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-cloud"></i>
              <h3 class="box-title">Weather Variables</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body row" style="padding:2rem;padding-top:1rem;">
            	<span class="col-lg-12">
	  			 <label>Humidity:</label>
				 <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" />
	    		 <input type="text" class="form-control" name="humidity" id="inputValue" value="0" />
				</span>
				<br>
				<div class="col-lg-12">
					<label>Temperature(Celsius)</label>
					<div class="row">
						<span class="col-lg-3">
						Maximum<input required type="text" id="maximum" name="max" value = "0" ></input>
						</span>
						<span class="col-lg-3">
						Minimum<input required type="text" id="minimum" name="min" value = "0"></input>
						</span>
						<span class="col-lg-3">
						Mean<input  required type="text" name="mean" id="mean" disabled required></input>
						<input type="hidden" name="mean" id="mean1" ></input>
						</span>
					</div>
				</div>
<br>
				<div class="col-lg-6">
					<label>Speed(MPH)</label><br>
						<input type="text" required name="speed" placeholder="MPH"></input>
				</div>
				<div class="col-lg-6">
					<label>Rainfall Amount:</label><br>
						<input type="text" required name="amount" placeholder="rain in mm"></input>
				</div>

				<div class="col-lg-4">
				<input type="hidden" name="st" value="0"> 
            	 	<input type="checkbox" name="st" value="1">
            	 	<label>Storm</label>
            	</div>
            	<div class="col-lg-4">
            	<input type="hidden" name="rn" value="0"> 
            	 	<input type="checkbox" name="rn" value="1">
            	 	<label>Rain</label>
            	</div>
            	<div class="col-lg-4">
            	<input type="hidden" name="lg" value="0"> 
            	 	<input type="checkbox" name="lg" value="1">
            	 	<label>Lightning</label>
            	</div>
            	<div class="col-lg-4">
            	 	<input type="checkbox" name="rs" value="1">
            	 	<label>Rain Shower</label>
            	</div>
            	<div class="col-lg-4">
            	<input type="hidden" name="hl" value="0"> 
            	 	<input type="checkbox" name="hl" value="1">
            	 	<label>Hail</label>
            	</div>
            	<div class="col-lg-4">
            	<input type="hidden" name="hz" value="0"> 
            	 	<input type="checkbox" name="hz" value="1">
            	 	<label>Haze</label>
            	</div>
            </div>
            <!-- /.box-body -->
          </div>
	</span>
	<span class="col-lg-4">
			<div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-exclamation-triangle"></i>
              <h3 class="box-title">Road events</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body row" style="padding:2rem;padding-top:1rem;">
            	<div class="col-lg-6">
            		<label>Is Sale?</label><br>
            		<input type="hidden" name="sale" value="0"> 
            	 	<input type="checkbox" name="sale" value="1">
            	</div>
            	<div class="col-lg-6">
            		<label>Is Accident?</label><br>
            		<input type="hidden" name="accident" value="0"> 
            	 	<input type="checkbox" name="accident" value="1">
            	</div>
            </div>
            <!-- /.box-body -->
          </div>
	</span>
	
	 <button  type="submit" class="btn btn-flat bg-green " data-role="none">Predict</button>

</div>
<



<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
<?php
	addComponent('foot');
?>
<script type="text/javascript">
var minSliderValue = $("#ex1").data("slider-min");
var maxSliderValue = $("#ex1").data("slider-max");

// Without JQuery
var slider = new Slider('#ex1', {
	formatter: function(value) {
		document.getElementById("inputValue").value = value;
		return 'Current value: ' + value;
	}
});
$("#inputValue").on("keyup", function() {
    var val = Math.abs(parseInt(this.value, 10) || minSliderValue);
    this.value = val > maxSliderValue ? maxSliderValue : val;
    slider.setValue(val);
});

</script>

<script type="text/javascript">


$("#minimum").on("keyup", function() {
    var maximum = parseFloat(document.getElementById('maximum').value);
   var minimum = parseFloat(document.getElementById('minimum').value);
   var mean = parseFloat((maximum+minimum)/2);
   document.getElementById("mean").value = mean.toFixed(2);
     document.getElementById("mean1").value = mean.toFixed(2);
});


$("#maximum").on("keyup", function() {
   var maximum = parseFloat(document.getElementById('maximum').value);
   var minimum = parseFloat(document.getElementById('minimum').value);
   var mean = parseFloat((maximum+minimum)/2);
  document.getElementById("mean").value = mean.toFixed(2);
    document.getElementById("mean1").value = mean.toFixed(2);
});




</script>
