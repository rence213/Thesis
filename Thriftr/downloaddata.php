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



<div class="container-fluid">
	<div class="row">
		<div style="position:absolute;top:15rem; color:white; background-color: rgba(0, 0, 0, 0.7); width:30%; ">
			<h1 class="pull-right" style="margin-right: 40px"><strong>Download Data</strong></h1>
		</div>
	</div>
	
	<br>

	<div class="row"  style="top:15rem; margin-top: 25rem">
	<span style="margin-left:5rem;">
			<ul>
					<li>Download From the Source Systems</li>
					<li>Choose range of data source</li>
					<li>(Optional) Specify Specific fields or columns</li>
			</ul>
			<br>
			<h4 style="margin-left:5rem;">DataSource Selected: <b>Weather data</b></h4>
	</span><br><br>
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

		<div class=" form-group col-lg-3">
				<button class="btn btn-flat bg-green"><i class="glyphicon glyphicon-search"></i> Preview</button>
				<button class="btn btn-flat bg-green"><i class="glyphicon glyphicon-download-alt"></i> Download Excel</button>
		</div>
			<div class=" form-group col-lg-3">
				<input type="checkbox"  id="enable" onclick="enable_cb(this);"> Select Fields</input>
				
				<button class="btn btn-flat " id="select_field"  disabled><i class="glyphicon glyphicon-search"></i> Fields</button>
				
		</div>
			
	</div>

	<div class="row">
			<div class="col-lg-12">
				<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
	                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">
	                Rendering engine
	                </th>
	                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">
	                Browser
	                </th>
	                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 197px;">
	                Platform(s)
	                </th>
	                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 154px;">
	                Engine version
	                </th>
	                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">
	                CSS grade
	                </th>

                </tr>
                </thead>
                <tbody>
                <tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td>Firefox 1.0</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.7</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td>Firefox 1.5</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td>Firefox 2.0</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td>Firefox 3.0</td>
                  <td>Win 2k+ / OSX.3+</td>
                  <td>1.9</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td>Camino 1.0</td>
                  <td>OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td>Camino 1.5</td>
                  <td>OSX.3+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td>Netscape 7.2</td>
                  <td>Win 95+ / Mac OS 8.6-9.2</td>
                  <td>1.7</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td>Netscape Browser 8</td>
                  <td>Win 98SE+</td>
                  <td>1.7</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td>Netscape Navigator 9</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td>Mozilla 1.0</td>
                  <td>Win 95+ / OSX.1+</td>
                  <td>1</td>
                  <td>A</td>
                </tr></tbody>
                <tfoot>
                </tfoot>
              </table>
			</div>
	</div>
	
</div>


<?php
	addComponent('foot');
?>

<script type="text/javascript">
function enable_cb(cb) {
  if (cb.checked) {
    $("#select_field").removeAttr("disabled");
    	$("#select_field").addClass("bg-blue");
  } else {
    $("#select_field").attr("disabled", true);
    $("#select_field").removeClass("bg-blue");
  }
}


var    options = { 
       trigger: 'click',
       html: 'true',
       title:  "<b>Select Fields to include</b>",
       content: "<button>asdasa</button>"
       };

    /**
     *  Create the Popover with above Options
    **/
    $('#select_field').popover(options);



</script>