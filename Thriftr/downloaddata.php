<?php
	require_once('support/support.php');
	
	

	if(isset($_SESSION[APPNAME]['UserId'])){
		addComponent('head');
		addComponent('navbar2');
	}else{
		addComponent('head');
		addComponent('navbar2');
	}
	
?>



<div>
	

<br><br><br>
<div class="input-group date" data-provide="datepicker">
    <input type="text" class="form-control">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>



	
</div>

<?php
	addComponent('foot');
?>

