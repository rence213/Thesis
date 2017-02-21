<?php
	require_once('support/support.php');
	
	

	if(isset($_SESSION[APPNAME]['UserId'])){
		addComponent('head');
		addComponent('navbar2');
	}else{
		redirect('index.php');
	}
	

	
?>



<div class="container-fluid" style="">
	<div class="row">
		<div style="position:absolute;top:15rem; color:white; background-color: rgba(0, 0, 0, 0.7); width:40rem; ">
			<h1 class="pull-right" style="margin-right: 5rem"><strong>Download Data</strong></h1>
		</div>
	</div>
	<br>
	<div class="row" style="top:15rem; margin-top: 22rem">
		<span class="col-lg-4">
			<ul>
						<li>Download From the Source Systems</li>
						<li>Choose range of data source</li>
						<li>(Optional) Specify Specific fields or columns</li>
			</ul>
			<br>
			<h4 style="margin-left:5rem;">DataSource Selected: <b><?php echo $_GET['type'];?> data</b></h4>
			<br>
		</span>
		<span class="col-lg-7">
			<div class="box box-default">
            <div class="box-header with-border" style="background-color:#001F3F; color:white;">
              <i class="fa fa-info"></i>
              <h3 class="box-title">Overview</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body row" style="padding:2rem;padding-top:1rem;">
            	<span class="col-lg-6">
            	<center><b style="font-size:1.75rem;">Data Info</b><br></center><br>
            	Dataset name: <br>
            	Number of Records: <br>
            	Source: <br>
            	</span>
            	<span class="col-lg-6">
            	<center><b style="font-size:1.75rem;">Technical</b><br></center><br>
            	Table Name: <br>
            	Number Of Columns: <br>
            	 <br>
            	</span>
            </div>
            <!-- /.box-body -->
          </div>
		</span>

	</div>
<br><br>

	<div class="row">
		<form id="subform">
		 <div class="form-group col-lg-3">
		 	<label>From Date:</label>
				<div class="input-group date " data-provide="datepicker">
			    	<input type="text" class="form-control" placeholder="mm/dd/yyyy" required>
				    <div class="input-group-addon">
				        <span class="glyphicon glyphicon-th"></span>
				    </div>
				</div>
		</div>

		<div class="form-group col-lg-3">
		 	<label>To Date:</label>
				<div class="input-group date " data-provide="datepicker">
			    	<input type="text" class="form-control" placeholder="mm/dd/yyyy" required>
				    <div class="input-group-addon">
				        <span class="glyphicon glyphicon-th"></span>
				    </div>
				</div>
		</div>

		<div class=" form-group col-lg-6">
				<button type="submit"  class="btn btn-flat bg-green" onclick="preview()"><i class="glyphicon glyphicon-search"></i> Preview</button>
				<button type="button" class="btn btn-flat bg-green"><i class="glyphicon glyphicon-download-alt"></i> Download Excel</button>
				<input type="checkbox"  id="enable" onclick="enable_cb(this);"> Select Fields</input>
				<button type="button" class="btn btn-flat " id="select_field"  disabled><i class="glyphicon glyphicon-th"></i> Fields</button>
				
		</div>
		
		</form>	
	</div>
  		<center>Click <b>Preview</b>  to preview data</center>
	<div class="row box" style="margin-left:.25rem;">
	<div class="box-header with-border">
              <h3 class="box-title"><?php echo $_GET['type'];?> data</h3>
            </div>
			<div  style=" overflow:scroll">
				<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="">
                <thead>
                <tr role="row" id="tablehead">
	                
                </tr>
                </thead>
                <tbody>
                <tr role="row" class="odd">
                </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
			</div>
	</div>
	<!-- <tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td>Firefox 1.5</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr> -->
</div>


<?php
	addComponent('foot');
?>

<script type="text/javascript">

	var fields = [];

 $.get('php/getTableInfo.php',{request : "tablerows", table:$_GET['type']},function(data){
	var options = { 
       trigger: 'click',
       html: 'true',
       title:  "<b>Select Fields to include</b>",
       content: ""+data.html

   };
    $('#select_field').popover(options);
	document.getElementById("tablehead").innerHTML = data.tablehead;
	},'json').fail(function(data){
    	console.log(data);
  });


	function enable_cb(cb) {
	  if (cb.checked) {
	    $("#select_field").removeAttr("disabled");
	    	$("#select_field").addClass("bg-blue");
	  } else {
	    $("#select_field").attr("disabled", true);
	    $("#select_field").removeClass("bg-blue");
	  }
	}



	 $("#select_field").on('hide.bs.popover', function(){

		$("input:checkbox[name=fieldset]:checked").each(function(){
    		fields.push($(this).val());
		});
		console.log(fields);
    });


	 $("#select_field").on('show.bs.popover', function(){
		fields = [];
		console.log(fields);
    });
	function preview(){
		$("input:checkbox[name=fieldset]:checked").each(function(){
    		fields.push($(this).val());
		});


		$.get("php/getTableInfo.php",{request:'row', table:$_GET['type']}, function(response){

		},'json').fail(function(response){
			console.log(response)
		});



	}

	$('#subform').submit(function () {
	 return false;
	});

   



</script>