new Chartist.Pie('.pie-chart', {
  series: [985, 476],
}, {
	pie: true,
	showLabel: false,
	height: "180px",
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});

new Chartist.Pie('.pie-chart2', {
  series: [367, 555]
}, {
	pie: true,
	showLabel: false,
	height: "180px",
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});

new Chartist.Pie('.pie-chart3', {
  series: [133, 662]
}, {
	pie: true,
	showLabel: false,
	height: "180px",
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});