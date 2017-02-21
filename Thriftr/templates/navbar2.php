<header class="main-header" >
   <a href="../../index2.html" class="logo"  style="background-color:rgba(0,0,0,0.6);">
	<span class="logo-lg" >
		<b>	Data Center</b>
	</span>
   </a>
  <nav class="navbar navbar-static-top" style="background-color:rgba(0,0,0,0.6);">
		<div class="navbar-custom-menu pull-left">
		<ul class="nav navbar-nav">
		<li ><a class="wave-button" role="button" style="font-size:15px;"><i class="fa fa-dashboard"></i> <span style="margin-left:5px;"> &nbsp Dashboard</span></a></li>
		<li><a class="wave-button"  data-toggle="control-sidebar" role="button" style="font-size:15px;"><i class="fa fa-pie-chart"></i>  <span style="margin-left:5px;">&nbsp Graphs</span></a></li>
		<li style="background-color:rgba(0,0,0,0.7);"><a class="wave-button" href="datacenter.php" role="button"><i class="fa fa-database" style="font-size:15px;"></i> &nbsp <span style="margin-left:5px;">Data Center</span></a></li>
		</ul>

		
	</div>
	  
	  

	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
		
		<li><a class="wave-button" role="button" style="font-size:15px;">Hi, <?php echo $_SESSION[APPNAME]['FullName'];?></a></li>
		<li><a class="wave-button" role="button" style="font-size:15px;" href="php/LoggingOut.php">Log Out</a></li>
		</ul>

		
	</div>
	  
		
  </nav>
</header>
