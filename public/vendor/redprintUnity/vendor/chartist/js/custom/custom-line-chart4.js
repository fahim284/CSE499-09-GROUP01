// Line Chart Sales
var chart = new Chartist.Line('.team-act', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Tasks', value: 2 },
			{meta: 'Tasks', value: 3},
			{meta: 'Tasks', value: 1},
			{meta: 'Tasks', value: 4}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "40px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 5,
		bottom: 0,
	},
	axisX: {
		offset: 0,
		showGrid: false,
		showLabel: false,
	}, 
	axisY: {
		offset: 0,
		showLabel: false,
		showGrid: false,
	},
	plugins: [
		Chartist.plugins.tooltip()
	],
	low: 0
});
chart.on('draw', function(data) {
	if(data.type === 'line' || data.type === 'area') {
		data.element.animate({
			d: {
				begin: 2000 * data.index,
				dur: 2000,
				from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
				to: data.path.clone().stringify(),
				easing: Chartist.Svg.Easing.easeOutQuint
			}
		});
	}
});

