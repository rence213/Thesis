<?php
	require_once('support/support.php');
	addComponent('head');
	addComponent('navbar');
	$query = $connection -> myQuery("SELECT area_id,location_name from location_dimension");
	
?>

<div class="container-fluid">

	<div class="row" style=" margin-left:1rem; margin-top: 5rem;"><h2><b> Current Statistics All Edsa</b></h2><a href="http://thehackerdudes.com/T4-thesis/t4/statistics.php"><button role="button" class="btn btn-flat bg-green">Back</button></a></div>

	<hr class="style4">

	<div class="row" id="graph-container" style="margin-top:2rem;" style="background-color:white;">
			
			<span class="col-lg-2" id="ranking" style="height:80rem; background-color:white;"></span>
			<span class="col-lg-10" id="chart" style="height:80rem; background-color:white;">
			<span class="col-lg-12"><center><h4> Highest Congested Areas In EDSA</center></h4></span>
			<canvas id="myChart"></canvas>
				
			</span>
		</div>
		<br>
			<hr class="style4">
	
	 <div class="row">
	 <?php
	 	while($row = $query -> fetch(PDO::FETCH_ASSOC)){


	 ?>
	 <span class="col-lg-4">
		 <div class="info-box" style="height:35rem;">
	            <span class="info-box-icon bg-aqua" style="font-size:20px;"><?php echo $row['location_name'];?></span>

	            <div class="info-box-content">
	              <span class="info-box-text"><b></b></span>
	              <span class="info-box-number"><canvas id="<?php echo $row['area_id'];?>"></span>
	            </div>
	            <!-- /.info-box-content -->
	      </div>
      </span>
	 <?php
		}
	 ?>

	</div>
	 
</div>







<?php
	addComponent('foot');
?>

<script text = "text/javascript">

var ctx = document.getElementById('myChart').getContext('2d');

$.get('php/getGraph.php',{request:'top'},function(response){

			var road = "";

      		$.each(response, function(i, item) {
			  	road += "<li>"+Object.keys(item)+"</li>";
			});

			var html = "<h4>Rank of congestion</h4><br><ol>" + road + "</ol>";
			console.log(road);
			document.getElementById("ranking").innerHTML = html;
      	
      }

      	,'json').fail(function(response){
      		console.log(response);
      });

$.get('php/getGraph.php',{request:'wholeEdsaTraffic'},function(response){
      		

      		var high = [];
      		$.each(response['data'], function(i, item) {
			  high.push(item['H']);
			});

		
			data = {
			
    labels: Object.keys(response['data']),
    datasets: [
        {
            label: "High Counts",
            backgroundColor: "#ff4c79",
            data: high
        }																																						
    ]
	};
		var myBarChart4 = new Chart(ctx, {
		    type: 'bar',
		    data: data,
		    options: {
		        barValueSpacing: 0,
		        scales: {
		            yAxes: [{
		                ticks: {
		                    min: 0,
		                }
		            }],

		        	xAxes:[{
		        		ticks:{
		        			autoskip: false,
		        			stepSize:1
		        		}
		        	}]
		        }
		    }
		});
      	


      }

      	,'json').fail(function(response){
      		console.log(response);
      });





$.get('php/getGraph.php',{request:'wholeEdsaTraffic2'},function(response){
      		console.log(response);

      		$.each(response['data'], function(i, item) {
			  

			 var total =  parseInt(item['H'])+ parseInt(item['M'])+ parseInt(item['L']);
			 console.log(total);
			 var h = (item['H']/total)*100;
			 var m = (item['M']/total)*100;
			 var l = (item['L']/total)*100;
			  var data = {
     labels: [
        "High " + h.toFixed(2)+"%",
        "Medium "+ m.toFixed(2)+"%",
         "Low "+ m.toFixed(2)+"%"
     ],
     datasets: [
         {
             data: [h.toFixed(2), m.toFixed(2), l.toFixed(2)],
            backgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
            ],
            hoverBackgroundColor: [
                 "#FF6384",
                 "#36A2EB",
                 "#FFCE56"
            ]
         }]
 };
 var ctx1 = document.getElementById(item['area_id']).getContext('2d');
 var myPieChart = new Chart(ctx1,{
     type: 'pie',
     data: data
 });
			});

      
 

      }

      	,'json').fail(function(response){
      		console.log(response);
      });



</script>

