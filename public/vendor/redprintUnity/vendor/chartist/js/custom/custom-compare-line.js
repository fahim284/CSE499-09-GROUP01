// Line Chart Sales
var chart = new Chartist.Line('.compare-one', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Sales', value: 100 },
			{meta: 'Sales', value: 250},
			{meta: 'Sales', value: 300},
			{meta: 'Sales', value: 500}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "170px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 10,
		bottom: 0,
	},
	axisX: {
		offset: 0,
	}, 
	axisY: {
		offset: 0,
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
				begin: 3000 * data.index,
				dur: 3000,
				from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
				to: data.path.clone().stringify(),
				easing: Chartist.Svg.Easing.easeOutQuint
			}
		});
	}
});

// Line chart Expenses
var chart = new Chartist.Line('.compare-two', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Expenses', value: 200 },
			{meta: 'Expenses', value: 400},
			{meta: 'Expenses', value: 100},
			{meta: 'Expenses', value: 700}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "170px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 10,
		bottom: 0,
	},
	axisX: {
		offset: 0,
	}, 
	axisY: {
		offset: 0,
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
				begin: 3000 * data.index,
				dur: 3000,
				from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
				to: data.path.clone().stringify(),
				easing: Chartist.Svg.Easing.easeOutQuint
			}
		});
	}
});
