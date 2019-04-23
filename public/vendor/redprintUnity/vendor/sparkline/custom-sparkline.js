// Bar Graph
$(function() {
	$("#barOne").sparkline([5,6,7,8,9,10,13,16,13,12,10,9,10,12,16,18,16,14,12,10,8,5], {
		type: 'bar',
		barColor: '#5c36b1',
		barWidth: 6,
		height: 30,
	});
});

$(function(){
	$('#barTwo').sparkline([5,6,7,8,9,10,13,16,13,12,10,9,10,12,16,18,16,14,12,10,8,5], {
		type: 'bar',
		barColor: '#ff4081',
		barWidth: 6,
		height: 30,
	});
});