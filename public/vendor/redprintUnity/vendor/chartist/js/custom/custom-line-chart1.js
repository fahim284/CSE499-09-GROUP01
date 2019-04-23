var chart = new Chartist.Line('.line-chart2', {
	labels: [1, 2, 3, 4, 5],
	series: [
	  [
			{meta: 'Sales', value: 800 },
			{meta: 'Sales', value: 1250},
			{meta: 'Sales', value: 2100},
			{meta: 'Sales', value: 800},
			{meta: 'Sales', value: 3700},
	  ]
	]
}, {
	// Remove this configuration to see that chart rendered with cardinal spline interpolation
	// Sometimes, on large jumps in data values, it's better to use simple smoothing.
	lineSmooth: Chartist.Interpolation.simple({
		divisor: 2
	}),
	height: "190px",
	fullWidth: true,
	chartPadding: {
		right: 20,
		left: 10,
		top: 10,
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