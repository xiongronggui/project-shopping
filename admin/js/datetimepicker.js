$(document).ready(function() {
	datetimepickerShow();
});

function datetimepickerShow()
{
	$('#paytime_start').datetimepicker();
	$('#paytime_start').datetimepicker({
		lang:'ch', 
		format:'Y-m-d',
		timepicker:false
	});

	$('#paytime_end').datetimepicker();
	$('#paytime_end').datetimepicker({
		lang:'ch', 
		format:'Y-m-d',
		timepicker:false
	});

	$('#usetime_start').datetimepicker();
	$('#usetime_start').datetimepicker({
		lang:'ch', 
		format:'Y-m-d',
		timepicker:false
	});
	
	$('#usetime_end').datetimepicker();
	$('#usetime_end').datetimepicker({
		lang:'ch', 
		format:'Y-m-d',
		timepicker:false
	});

	$('#time_start').datetimepicker();
	$('#time_start').datetimepicker({
		lang:'ch', 
		format:'Y-m-d',
		timepicker:false
	});
	
	$('#time_end').datetimepicker();
	$('#time_end').datetimepicker({
		lang:'ch', 
		format:'Y-m-d',
		timepicker:false
	});
}