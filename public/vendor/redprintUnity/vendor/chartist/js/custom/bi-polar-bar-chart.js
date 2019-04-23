// Create a simple bi-polar bar chart
var chart = new Chartist.Bar('.bi-polar-bar-chart', {
	labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	series: [
		[3, 2, 4, 6, 2, 4, 5],
	]
}, {
	high: 10,
	low: 1,
	axisX: {
		labelInterpolationFnc: function(value, index) {
			return index % 2 === 0 ? value : null;
		},
		showGrid: false,
		showLabel: false,
	},
	axisY: {
		showLabel: false,
	},


	height: "100px",
	chartPadding: {
		right: 0,
		left: -30,
		bottom: 0,
		top: 0
	},
	plugins: [
		Chartist.plugins.tooltip()
	],
});

// Listen for draw events on the bar chart
chart.on('draw', function(data) {
	// If this draw event is of type bar we can use the data to create additional content
	if(data.type === 'bar') {
		// We use the group element of the current series to append a simple circle with the bar peek coordinates and a circle radius that is depending on the value
		data.group.append(new Chartist.Svg('circle', {
			cx: data.x2,
			cy: data.y2,
			r: Math.abs(Chartist.getMultiValue(data.value)) * 2 + 5
		}, 'ct-slice-pie'));
	}
});
