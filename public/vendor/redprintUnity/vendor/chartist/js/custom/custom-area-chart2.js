new Chartist.Line('.custom-area-chart', {
  labels: [1, 2, 3, 4, 5, 6, 7, 8],
  series: [
    [5, 9, 7, 8, 5, 3, 5, 4]
  ]
}, {
  low: 0,
  showArea: true,
	lineSmooth: true,
	fullWidth: true,
	height: "190px",
	chartPadding: {
		right: 5,
		left: 5,
		bottom: 0,
		top: 5
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