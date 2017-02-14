function showShop(marketid){
		document.getElementById("loading").style.visibility = "visible";
		document.getElementById("loading1").style.visibility = "visible";
		
		$.ajax({
			type:'post',
			url:'php/getshops.php',
			data:{id:marketid,request:'shopinfo'},
			success: function(response){
				$("#shopmodal").modal();
				$(".modal-content").show().html(response);
				document.getElementById("loading").style.visibility = "hidden";
				document.getElementById("loading1").style.visibility = "hidden";
				console.log(response);
			},
			fail: function(response){
				console.log(response);
			}
		});
}