<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	
	$query = $connection -> myQuery("SELECT location_name from location_dimension");


?>

<div class="container-fluid">

		<div class="row" style=" margin-left:1rem; margin-top: 5rem;"><h2><b>Graph</b></h2></div>
		<div class="row" style="margin-top: 5rem;">
			<span class="col-lg-3">
				<select class="form-control select2 select2-hidden-accessible" aria-hidden="true">
					<option disabled>-Location-</option>
					<?php
						while($row = $query->fetch(PDO::FETCH_ASSOC)){
									$selected ="";
							if($row['location_name']==$_GET['location']){
									$selected = 'selected';
							}
							echo "<option".$selected.">".$row['location_name']."</option>";
						}
					?>
				</select>
			</span>
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
			<span class="col-lg-3">
				<div class="input-group">
				<select class="form-control select2 select2-hidden-accessible" aria-hidden="true">
					<option selected="selected" disabled>-Time-</option>
					<option>0</option><option>1</option><option>2</option><option>3</option>
					<option>4</option><option>5</option><option>6</option><option>7</option>
					<option>8</option><option>9</option><option>10</option><option>11</option>
					<option>12</option><option>13</option><option>14</option><option>15</option>
					<option>16</option><option>17</option><option>18</option><option>19</option>
					<option>20</option><option>21</option><option>22</option><option>23</option>
				</select>
						<div class="input-group-addon">to</div>
				<select class="form-control select2 select2-hidden-accessible" aria-hidden="true">
					<option selected="selected" disabled>-Time-</option>
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
				<select class="form-control select2 select2-hidden-accessible" aria-hidden="true">
					<option selected="selected" disabled>-Factors-</option>
					<option>Weather</option>
					<option>Mall Sales</option>
					<option>Road Accidents</option>
				</select>
			</span>
		</div><br>
		<div class="row" style="margin-top:5rem;">
			<span class="col-lg-2"></span>
			<span class="col-lg-8" style="background-color:grey; height:50rem;"></span>
			<span class="col-lg-2"></span>
		</div>
			
		
		


	
</div>

<script = "text/javascript">


</script>



<?php
	addComponent('foot');
?>
