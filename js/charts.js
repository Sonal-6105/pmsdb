//Function to show the Area Chart in Dashboard
function showAreaChartPurchase() {
  // Set new default font family and font color to mimic Bootstrap's default styling
  (Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#858796";

  var ctx1 = document.getElementById("cmPurchase");
  var ctx2 = document.getElementById("cmSale");

  var months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"];
  var purchase = [];
  var sale = [];
  var cumPurchase = [];
  var cumSale = [];

  $.post("api_graph_area.php", function (data) {
    console.log(data);
    var jarrays = data.split("-");
    var jdataPurchase = JSON.parse(jarrays[0]);
    var jdataSale = JSON.parse(jarrays[1]);

    for (var i in jdataPurchase) {
      purchase.push(jdataPurchase[i].MU_PURCHASE);
    }
    for (var i in jdataSale) {
      sale.push(jdataSale[i].MU_SALE);
    }
    temp = 0;
    for (var i = 0; i < purchase.length; i++) {
      cumPurchase[i] = (temp + parseFloat(purchase[i])).toFixed(2);
      temp = temp + parseFloat(purchase[i]);
    }

    temp = 0;
    for (var i = 0; i < sale.length; i++) {
      cumSale[i] = (temp + parseFloat(sale[i])).toFixed(2);
      temp = temp + parseFloat(sale[i]);
    }
    //console.log(months, purchase, sale);

    var myLineChart = new Chart(ctx1, {
      type: "line",
      data: {
        labels: months,
        datasets: [
          {
            label: "Purchase",
            lineTension: 0.4,
            backgroundColor: "rgba(21, 218, 200, 1)",
            borderColor: "rgba(21, 218, 200, 1)",
            pointRadius: 6,
            pointBackgroundColor: "rgba(63, 166, 0, 1)",
            pointBorderColor: "rgba(255, 255, 255, 1)",
            pointHoverRadius: 7,
            pointHoverBackgroundColor: "rgba(63, 166, 0, 1)",
            pointHoverBorderColor: "rgba(255, 255, 255, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 3,
            data: cumPurchase,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 0,
            bottom: 0,
          },
        },
        scales: {
          xAxes: [
            {
              time: {
                unit: "date",
              },
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                maxTicksLimit: 12,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                maxTicksLimit: 4,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function (value, index, values) {
                  return number_format(value);
                },
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: true,
                borderDash: [2],
                zeroLineBorderDash: [2],
              },
            },
          ],
        },
        legend: {
          display: false,
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: "#6e707e",
          titleFontSize: 14,
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: "index",
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, chart) {
              var datasetLabel =
                chart.datasets[tooltipItem.datasetIndex].label || "";
              return number_format(tooltipItem.yLabel) + " MU";
            },
          },
        },
      },
    });

    var myLineChart = new Chart(ctx2, {
      type: "line",
      data: {
        labels: months,
        datasets: [
          {
            label: "Sale",
            lineTension: 0.4,
            backgroundColor: "rgba(243, 105, 67, 1)",
            borderColor: "rgba(243, 105, 67, 1)",
            pointRadius: 6,
            pointBackgroundColor: "rgba(255, 0, 0, 1)",
            pointBorderColor: "rgba(255, 255, 255, 1)",
            pointHoverRadius: 7,
            pointHoverBackgroundColor: "rgba(255, 0, 0, 1)",
            pointHoverBorderColor: "rgba(243, 105, 67, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 3,
            data: cumSale,
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 0,
            bottom: 0,
          },
        },
        scales: {
          xAxes: [
            {
              time: {
                unit: "date",
              },
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                maxTicksLimit: 12,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                maxTicksLimit: 4,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function (value, index, values) {
                  return number_format(value);
                },
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: true,
                borderDash: [2],
                zeroLineBorderDash: [2],
              },
            },
          ],
        },
        legend: {
          display: false,
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: "#6e707e",
          titleFontSize: 14,
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: "index",
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, chart) {
              var datasetLabel =
                chart.datasets[tooltipItem.datasetIndex].label || "";
              return number_format(tooltipItem.yLabel) + " MU";
            },
          },
        },
      },
    });
  });
}

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + "").replace(",", "").replace(" ", "");
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
    dec = typeof dec_point === "undefined" ? "." : dec_point,
    s = "",
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return "" + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += new Array(prec - s[1].length + 1).join("0");
  }
  return s.join(dec);
}

function showStackBar() {
  // Set new default font family and font color to mimic Bootstrap's default styling
  (Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#858796";

  var ctx = document.getElementById("poolProfileBar");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug"],
      datasets: [
        {
          label: "State-Hydro",
          type: "bar",
          stack: "State",
          backgroundColor: "#44d1df",
          minBarLength: 10,
          data: [582.05, 597.17, 547.12, 697.54, 685.83],
        },
        {
          label: "Satate-Thermal",
          type: "bar",
          stack: "State",
          backgroundColor: "#730517",
          minBarLength: 10,
          data: [915.88, 1030.39, 1024.62, 1071.28, 879.03],
        },
        {
          label: "IPP",
          type: "bar",
          stack: "State",
          backgroundColor: "#f44560",
          minBarLength: 10,
          data: [318.22, 424.23, 386.76, 376.26, 394.62],
        },
        {
          label: "CGP",
          type: "bar",
          stack: "State",
          backgroundColor: "#1e7069",
          minBarLength: 10,
          data: [23.15, 39.4, 36.71, 43.06, 39.35],
        },
        {
          label: "SH",
          type: "bar",
          stack: "State",
          backgroundColor: "#a7ecf2",
          minBarLength: 10,
          data: [20.45, 24.51, 27.89, 32.83, 35.41],
        },
        {
          label: "State-Solar",
          type: "bar",
          stack: "State",
          backgroundColor: "#f17c37",
          minBarLength: 10,
          data: [38.99, 35.32, 30.4, 31.78, 23.87],
        },
        {
          label: "BM",
          type: "bar",
          stack: "State",
          backgroundColor: "#36244f",
          minBarLength: 10,
          data: [3.19, 2.76, 1.26, 0.87, 8.98],
        },
        {
          label: "Central-Hydro",
          type: "bar",
          stack: "Central",
          backgroundColor: "#586c5c",
          minBarLength: 10,
          data: [66.65, 137.81, 184.74, 211.25, 215.33],
        },
        {
          label: "Central-Thermal",
          type: "bar",
          stack: "Central",
          backgroundColor: "#ffbb6c",
          minBarLength: 10,
          data: [354.43, 366.54, 329.58, 332.62, 396.29],
        },
        {
          label: "Central-Solar",
          type: "bar",
          stack: "Central",
          backgroundColor: "#35b5ff",
          minBarLength: 10,
          data: [14.06, 13.09, 12.41, 11.33, 10.01],
        },
        {
          label: "Central-Wind",
          type: "bar",
          stack: "Central",
          backgroundColor: "#503c52",
          minBarLength: 10,
          data: [36.74, 33.23, 30.31, 37.4, 44.29],
        },
        {
          label: "TPCODL",
          type: "bar",
          stack: "Sale",
          backgroundColor: "#9500ff",
          minBarLength: 10,
          data: [661.4, 643.67, 654.76, 765.87, 777.65],
        },
        {
          label: "NESCO",
          type: "bar",
          stack: "Sale",
          backgroundColor: "#108aff",
          minBarLength: 10,
          data: [350.35, 345.22, 324.67, 333.54, 434.56],
        },
        {
          label: "WESCO",
          type: "bar",
          stack: "Sale",
          backgroundColor: "#ff6000",
          minBarLength: 10,
          data: [819.32, 530.2, 512.5, 560.34, 601.23],
        },
        {
          label: "SOUTHCO",
          type: "bar",
          stack: "Sale",
          backgroundColor: "#0b8c00",
          minBarLength: 10,
          data: [279.8, 289.03, 266.09, 298.34, 302.9],
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        xAxes: [
          {
            //stacked: true,
            stacked: true,
            ticks: {
              beginAtZero: true,
              maxRotation: 0,
              minRotation: 0,
            },
            maxBarThickness: 50,
          },
        ],
        yAxes: [
          {
            stacked: true,
          },
        ],
      },
    },
  });
}

//Pie Charts
function showPieChart() {
  (Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#858796";

  var ctx = document.getElementById("pieOne");
  var ctx1 = document.getElementById("pieTwo");
  var ctx3 = document.getElementById("pieThree");
  var ctx4 = document.getElementById("pieFour");

  new Chart(ctx, {
    type: "pie",
    data: {
      datasets: [
        {
          data: [10, 30, 50, 40],
          backgroundColor: ["#471337", "#b13254", "#ff5349", "#ff9248"],
          label: "Dataset 1",
        },
      ],
      labels: ["State", "Center", "Other", "Extra"],
    },
    options: {
      responsive: false,
      legend: {
        display: false,
      },
    },
  });

  new Chart(ctx1, {
    type: "pie",
    data: {
      datasets: [
        {
          data: [40, 30, 20, 10],
          backgroundColor: ["#85937a", "#586c5c", "#dfdcb9", "#202e32"],
          label: "Dataset 1",
        },
      ],
      labels: ["State", "Center", "Other", "Extra"],
    },
    options: {
      responsive: false,
      legend: {
        display: false,
      },
    },
  });

  new Chart(ctx3, {
    type: "pie",
    data: {
      datasets: [
        {
          data: [30, 30, 50, 40],
          backgroundColor: ["#35b5ff", "#ff479c", "#ff8172", "#36244f"],
          label: "Dataset 1",
        },
      ],
      labels: ["State", "Center", "Other", "Extra"],
    },
    options: {
      responsive: false,
      legend: {
        display: false,
      },
    },
  });

  new Chart(ctx4, {
    type: "pie",
    data: {
      datasets: [
        {
          data: [40, 10, 5, 40],
          backgroundColor: ["#1e7069", "#a8216b", "#f7dc66", "#a7ecf2"],
          label: "Dataset 1",
        },
      ],
      labels: ["State", "Center", "Other", "Extra"],
    },
    options: {
      responsive: false,
      legend: {
        display: false,
      },
    },
  });
}
