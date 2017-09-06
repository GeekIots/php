$(function () {
  function random_numbers() {
    for (var a = [],i = 0; i < 300; ++i) a[i] = i;

    var tmp, current, top = a.length;

    if(top) while(--top) {
      current = Math.floor(Math.random() * (top + 1));
      tmp = a[current];
      a[current] = a[top];
      a[top] = tmp;
    }
    return a;
  }
  
  Highcharts.setOptions({
    colors: ['#60be7b']
  });

  $('#areaChart').highcharts({
    chart: {
      type: 'areaspline',
      zoomType: 'x'
    },
    title: { text: null },
    legend: { enabled: false },

    xAxis: {
      type: 'datetime',
      categories: [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        '14',
        '15'
      ],
      min: 0.5,
      max: 11,
      plotLines: [{
        color: 'red',
        dashStyle: 'solid',
        value: '3',
        width: '1'
      }]
    },

    yAxis: {
      title: {
        text: null
      }
    },

    tooltip: {
      shared: true
    },

    credits: {
      enabled: false
    },

    plotOptions: {
      areaspline: {
        fillOpacity: 0.8
      },
      series: {
        marker: { enabled: false },
        lineWidth: 0
      }
    },

    series: [{
      name: 'value:',
      data: random_numbers()
    }]
  });
});