
<script src="js/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>	
<!-- Bootstrap 3.3.6 -->
<script src="js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/AdminLTE/js/app.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places,drawing&amp;sensor=false&amp;key=AIzaSyB1hBlgm-B5aaLB2470dyJVGyC-nx_UnQg"></script>
<script src="js/myjs/map.js"></script>
<script src="js/myjs/modals.js"></script>
<script src="js/gmaps.js"></script>
<script type="text/javascript" src="plugins/waves/dist/waves.min.js"></script>
<script type="text/javascript">





$('#click_advance').click(function() {
	icon = $(this).find("span");
    icon.toggleClass("glyphicon glyphicon-chevron-up hvr-float").toggleClass("glyphicon glyphicon-chevron-down hvr-sink");
});
Waves.attach('.wave-button', ['flat-buttons', 'waves-effect', 'waves-light']); //flat button
	Waves.attach('.wave-button2', [ 'waves-effect', 'waves-button']); //flat button
	Waves.attach('.wave-circle', ['waves-effect', 'waves-circle', 'waves-float']);
    Waves.init();

</script>

</body>
</html>