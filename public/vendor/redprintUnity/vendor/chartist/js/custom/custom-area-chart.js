new Chartist.Line('.income-area-chart', {
	series: [
		[2, 2.5, 4, 4, 5, 5, 5, 3.5, 2, 1.5, 3, 5],
		[3 ,2 ,2 ,3 ,2.5, 2, 3, 3, 4, 6.5, 9, 9],		
	]
}, {
	low: 0,
	lineSmooth: false,
	showArea: true,
	showLine: false,
	showPoint: false,
	showLabel: false,
	fullWidth: true,
	height: "110px",
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


