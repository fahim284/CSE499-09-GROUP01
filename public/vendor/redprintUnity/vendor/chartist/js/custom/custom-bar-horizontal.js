new Chartist.Bar('.barHorizontal', {
  labels: ['Q1', 'Q2', 'Q3', 'Q4'],
  series: [
    [
      {meta: 'Likes', value: 5},
      {meta: 'Likes', value: 2},
      {meta: 'Likes', value: 4},
      {meta: 'Likes', value: 7},
    ],
    [
      {meta: 'Comments', value: 3},
      {meta: 'Comments', value: 2},
      {meta: 'Comments', value: 9},
      {meta: 'Comments', value: 6},
    ],
    [
      {meta: 'Shares', value: 2},
      {meta: 'Shares', value: 3},
      {meta: 'Shares', value: 5},
      {meta: 'Shares', value: 9},
    ],
  ],
}, {
  seriesBarDistance: 11,
  reverseData: true,
  horizontalBars: true,
  height: "190px",
  chartPadding: {
    right: 0,
    left: 0,
    top: 0,
    bottom: -10,
  },
  axisY: {
    offset: 30
  },
  plugins: [
    Chartist.plugins.tooltip()
  ], 
});
