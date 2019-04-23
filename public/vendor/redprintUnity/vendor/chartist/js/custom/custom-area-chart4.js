new Chartist.Line('.custom-area-chart4', {
	labels: [1, 2, 3, 4, 5, 6, 7, 8],
  series: [
		[
			{meta: 'Visitors', value: 500 },
			{meta: 'Visitors', value: 900},
			{meta: 'Visitors', value: 700},
			{meta: 'Visitors', value: 800},
			{meta: 'Visitors', value: 500},
			{meta: 'Visitors', value: 300},
			{meta: 'Visitors', value: 500},
			{meta: 'Visitors', value: 400},
		]
	]
}, {
	low: 0,
	lineSmooth: true,
	showArea: true,
	showLine: true,
	showPoint: true,
	showLabel: false,
	fullWidth: true,
	height: "190px",
	chartPadding: {
		right: 10,
		left: 10,
		bottom: -20,
		top: 20
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