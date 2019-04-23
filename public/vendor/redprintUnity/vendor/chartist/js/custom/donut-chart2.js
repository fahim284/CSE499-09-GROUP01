new Chartist.Pie('.donut-chart', {
  series: [985, 476, 670]
}, {
	donut: true,
	donutWidth: 6,
	donutSolid: true,
	startAngle: 270,
	showLabel: false,
	height: "143px",
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});