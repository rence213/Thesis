
	 function view() {
			document.getElementById('intervalOptions').style.display='none';
	}
	
	function intervalCheck() {
        if (document.getElementById('intervalOption_Daily').checked) {
		console.log("dasd");
            document.getElementById('daily_option').style.display = 'block';
			document.getElementById('hourly_option').style.display = 'none';
			document.getElementById('hourly_option').style.display = 'none';
        } 
			else {
				document.getElementById('daily_option').style.display = 'none';
				document.getElementById('hourly_option').style.display = 'block';
			}
		}
		  var ctx = document.getElementById("myChart").getContext("2d");
		  var ctx2 = document.getElementById("myChart2").getContext("2d");
      	  var ct3 = document.getElementById("myChart3").getContext("2d");
      	  var ctx4 = document.getElementById("myChart4").getContext("2d");
      	  var ct5 = document.getElementById("myChart5").getContext("2d");

      	data = {
	    labels: [1,2],
	    datasets: [
        {
            label: "LOW",
            backgroundColor: "#FF992B",
            data: [0,0]
        },
        {
            label: "MEDIUM",
            backgroundColor: "#1477C3",
            data: [0,0]
        },
        {
            label: "HIGH",
            backgroundColor: "#8712C7",
            data: [0,0]
        }																																						
    ]
	};
		var myBarChart = new Chart(ctx, {
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
		var myBarChart2 = new Chart(ctx2, {
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

var myBarChart3 = new Chart(ct3, {
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





 $('#subform').submit(function () {
		switch($('input[name="intervaldateOptions"]:checked').val()){
      	case '0': var interval = 'daily';  break;
      	case '1': var interval = 'hourly';  break;
      }

       resetCanvas();
       var ctx = document.getElementById("myChart").getContext("2d");
       var e = document.getElementById("location");
	   var location = e.options[e.selectedIndex].text;
	   var todate = document.getElementById("todate").value;
	   var fromdate = document.getElementById("fromdate").value;
	   var onedaydate = document.getElementById("onedaydate").value;
	   var dates = {'fromdate': fromdate, 'todate': todate, 'onedaydate':onedaydate};
     $.get('php/getGraph.php',{request:'trafficCount', 'interval' : interval, 'location':location, 'dates':dates},function(response){
      		console.log(response);

      		document.getElementById("intervaltext").innerHTML = interval;
      		document.getElementById("locationtext").innerHTML = response['details']['road']+", ";
      		document.getElementById("datetext").innerHTML = response['details']['date'] + " " +response['details']['day'];
      		var data = [];
      		var low = [];
      		var medium = [];
      		var high = [];
      		$.each(response['hours'], function(i, item) {
			  low.push(item['L']);
			  medium.push(item['M']);
			  high.push(item['H']);
			})
      		data = {
    labels: Object.keys(response['hours']),
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
		var myBarChart = new Chart(ctx, {
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


 $('#subform2').submit(function () {
		

       resetCanvas2();
       var ctx2 = document.getElementById("myChart2").getContext("2d");
       var ct3 = document.getElementById("myChart3").getContext("2d");
       var e = document.getElementById("location2");
	   var location = e.options[e.selectedIndex].text;
     $.get('php/getGraph.php',{request:'trafficCountWeeklyBehavior', 'location':location},function(response){
      		console.log(response);
      		var data = [];
      		var low = [];
      		var medium = [];
      		var high = [];
      		$.each(response['N']['days'], function(i, item) {
			  low.push(item['L']);
			  medium.push(item['M']);
			  high.push(item['H']);
			});

      		var sum = 0;
			for( var i = 0; i < high.length; i++ ){
			    sum += parseInt( high[i]-1, 10 ); //don't forget to add the base
			}
			var avg = sum/high.length;
			var text1 = "Average Occurences Of High Traffic: <b>"+Math.round(avg)+"</b> <br>"		
			var temp = [];
			$.each(response['N']['days'], function(i, item) {
			  if(avg<item['H']){
			  	temp.push(i);
			  }
			});

			if(temp.length>0){
				text1 += "Peak Days: ";
				for( var i = 0; i < temp.length; i++ ){
			    	text1 += "<b>"+temp[i]+", </b>";
				}
			}
			document.getElementById("text1").innerHTML = text1;
			

			data = {
			
    labels: Object.keys(response['N']['days']),
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
		var myBarChart2 = new Chart(ctx2, {
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
      		$.each(response['S']['days'], function(i, item) {
			  low.push(item['L']);
			  medium.push(item['M']);
			  high.push(item['H']);
			})
			var sum = 0;
			for( var i = 0; i < high.length-1; i++ ){
			    sum += parseInt( high[i], 10 ); //don't forget to add the base
			}
			var avg = sum/high.length;
			var text2 = "Average Occurences Of High Traffic: <b>"+Math.round(avg)+"</b> <br>"		
			var temp = [];
			$.each(response['S']['days'], function(i, item) {
			  if(avg<item['H']){
			  	temp.push(i);
			  }
			});

			if(temp.length>0){
				text2 += "Peak Days: ";
				for( var i = 0; i < temp.length; i++ ){
			    	text2 += "<b>"+temp[i]+", </b>";
				}
			}
			document.getElementById("text2").innerHTML = text2;
			
      		data = {
    labels: Object.keys(response['S']['days']),
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
		var myBarChart3 = new Chart(ct3, {
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



function resetCanvas() {
  $('#myChart').remove(); // this is my <canvas> element
  $('#chart').append('<canvas id="myChart"></canvas>');
};

function resetCanvas2() {
  $('#myChart2').remove(); // this is my <canvas> element
  $('#chart2').append('<canvas id="myChart2"></canvas>');

  $('#myChart3').remove(); // this is my <canvas> element
  $('#chart3').append('<canvas id="myChart3"></canvas>');
};
