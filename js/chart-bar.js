// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


// Bar Chart Example
var ctx = document.getElementById("dashBarChart");
var chartData = {
	labels: [
		"HYDRO",
		"THERMAL",
		"SOLAR",
		"WIND",
		"BIOMASS",
		"CGP",
		"IPP"
	],
	datasets: [
		{
			label: "State",
			backgroundColor: "#4e73df",
			borderColor: "#4e73df",
			borderWidth: 1,
			data: [10, 15, 9, 3,4, 8, 10]
			
		},
		{
			label: "Central",
			backgroundColor: "#1cc88a",
			borderColor: "#1cc88a",
			borderWidth: 1,
			data: [5, 11, 6, 6,3, 7, 6]
		}
	]
};
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: chartData,
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'source'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15,
          maxTicksLimit: 6,
          padding: 0,
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: true,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: true
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: true,
      caretPadding: 5,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + " " + tooltipItem.yLabel;
        }
      }
    },
  }
});
