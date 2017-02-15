
<?php
	require_once('support/support.php');
	addComponent('head');
?>







<div class="login-box box box-solid box-primary" style="background-color:#3c8dbc;" align= "center">
	<div class="login-box-header" style="color:#fff;" ><strong><h3>Traffic Data Center</h3></strong></div>
		
	<div class="login-box-body">
		<h4>Login to your Account</strong></h4><br>
		<div class="form-horizontal" >
		<?php
			Alert();
			unsetAlert();
		?>
			<form method="POST" action='php/LoggingIn.php'>
				<div class="form-group has-feedback">
				<input class="form-control" type="text"  name="username" placeholder="Username" required></input>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
				<input class="form-control" type="password" name="password" placeholder="Password" required></input>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<a href="#"><h5>Forgot Password?</strong></h5></a>
				<br>
				<a href="index.php"><button type='button' class="btn btn-flat" style="color:black;">Back</button></a>
				<button type="submit" class="btn btn-primary btn-flat">Log In</button>
			</form>

		</div>

		
		
	</div>
</div>

<div style="width:100%; margin-top:10rem; textAlign:center;">
<center>Powered by Traffic Forecast - Thesis IT</center>
</div>




<?php
	addComponent('foot');
?>
