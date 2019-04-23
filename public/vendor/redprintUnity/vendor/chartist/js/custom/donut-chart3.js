new Chartist.Pie('.donut-chart', {
  series: [985, 476, 670]
}, {
	donut: true,
	donutWidth: 9,
	donutSolid: true,
	startAngle: 270,
	showLabel: false,
	height: "80px",
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});