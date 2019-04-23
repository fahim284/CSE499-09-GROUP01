new Chartist.Line('.custom-area-chart3', {
	series: [
		[2, 2.5, 4, 4, 5, 5, 5, 3.5, 2, 1.5, 8, 5],
		[3 ,2 ,2 ,3 ,2.5, 2, 3, 3, 4, 6.5, 9, 6],		
	]
}, {
	low: 0,
	lineSmooth: true,
	showArea: true,
	showLine: false,
	showPoint: false,
	showLabel: false,
	fullWidth: true,
	height: "190px",
	chartPadding: {
		right: -20,
		left: -20,
		bottom: 0,
		top: -10
	},
	axisX: {
		offset: 0,
		showGrid: false,
		showLabel: false,
	}, 
	axisY: {
		offset: 0,
		showGrid: false,
		showLabel: false,
	},
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});


