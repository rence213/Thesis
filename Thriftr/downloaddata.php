<?php
	require_once('support/support.php');
	
	

	if(isset($_SESSION[APPNAME]['UserId'])){
		addComponent('head');
		addComponent('navbar2');
	}else{
		redirect('index.php');
	}
	
?>



<div>
	


	<div class="container-fluid" style="position:absolute; z-index:0; background-color: #e6e6e6; width:100%; height:100rem;">
			<div style="position:absolute;top:15rem; left:-5rem; color:white; background-color: rgba(0, 0, 0, 0.7); width:30%; ">
			<h1 class="pull-right" style="margin-right: 40px"><strong>Weather data</strong></h1>
		</div>

		<div style="position:absolute;top:15rem; right:0; height:100px;  width:30%; ">
			<img src="img/mmda.png" style="height:150px;width:150px;"/>
			<img src="img/Pagasa_logo.png" style="height:150px;width:150px;"/>
			<img src="img/dpwh.png" style="height:150px;width:150px;"/>
		</div>
		<div style="position:absolute;top:50rem; color:white; left:50px; width:100%; " class="row">
			<span class="col-lg-3">
				<input type="text" placeholder="mm/dd/yyyy" name="date" class="form-control"  style="position: relative; z-index: 100000;" required>
						<div class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</div>
			</span>
			<span class="col-lg-3">
			</span>
			<span class="col-lg-3">
			</span>
			<span class="col-lg-3">
			</span>
		</div>
	</div>



	
</div>

<?php
	addComponent('foot');
?>

