// Line Chart Sales
var chart = new Chartist.Line('.line-chart-sales', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Sales', value: 200 },
			{meta: 'Sales', value: 1250},
			{meta: 'Sales', value: 700},
			{meta: 'Sales', value: 1800}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "60px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 0,
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

// Line chart Income
var chart = new Chartist.Line('.line-chart-income', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Income', value: 900 },
			{meta: 'Income', value: 300},
			{meta: 'Income', value: 1300},
			{meta: 'Income', value: 800}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "60px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 0,
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


// Line chart Visitors
var chart = new Chartist.Line('.line-chart-visits', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Income', value: 650 },
			{meta: 'Income', value: 1250},
			{meta: 'Income', value: 470},
			{meta: 'Income', value: 3200}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "60px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 0,
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


// Line chart Likes
var chart = new Chartist.Line('.line-chart-likes', {
	labels: [1, 2, 3, 4],
	series: [
		[
			{meta: 'Income', value: 250},
			{meta: 'Income', value: 1650},
			{meta: 'Income', value: 1250},
			{meta: 'Income', value: 650}
		]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "60px",
	fullWidth: true,
	chartPadding: {
		right: 5,
		left: 5,
		top: 0,
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