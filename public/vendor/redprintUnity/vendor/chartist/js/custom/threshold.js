new Chartist.Line('.threshold', {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  series: [
    [5, -4, 3, 7, 20, 10, 3, 4, 8, -10, 6, -8]
  ]
}, {
  showArea: true,
  height: "240px",
  axisY: {
    onlyInteger: true
  },
  plugins: [
    Chartist.plugins.ctThreshold({
      threshold: 4
    }),
    Chartist.plugins.tooltip(),
    Chartist.plugins.animation({
      duration: 2000
    })
  ],
});
