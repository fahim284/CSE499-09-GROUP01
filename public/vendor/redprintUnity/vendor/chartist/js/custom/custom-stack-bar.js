new Chartist.Bar('.stacked-bar', {
	labels: ['Q1', 'Q2', 'Q3', 'Q4'],
	series: [
		[
			{meta: 'Visitors', value: 5500},
			{meta: 'Visitors', value: 8300},
			{meta: 'Visitors', value: 7200},
			{meta: 'Visitors', value: 6800},
		],
		[
			{meta: 'Orders', value: 3500},
			{meta: 'Orders', value: 5200},
			{meta: 'Orders', value: 3700},
			{meta: 'Orders', value: 4500},
		],
		[
			{meta: 'Income', value: 1200},
			{meta: 'Income', value: 2500},
			{meta: 'Income', value: 2200},
			{meta: 'Income', value: 3000},
		],
	],
}, {
	stackBars: true,
	seriesBarDistance: 6,
	height: "150px",
	chartPadding: {
		left: 0,
		top: 0,
		bottom: 0,
	},
	axisX: {
		offset: 0,
	}, 
	axisY: {
		showLabel: true,
		showGrid: false,
		offset: 0,
	},
	plugins: [
		Chartist.plugins.tooltip()
	], 
}).on('draw', function(data) {
	if(data.type === 'bar') {
		data.element.attr({
			style: 'stroke-width: 30px'
		});
	}
});