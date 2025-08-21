<script>

     var inData  = @json($monthly->pluck('in_total'));
    var outData = @json($monthly->pluck('out_total'));
    var categories = @json($monthly->pluck('month_name'));
    // Sales By Category
var options1 = {
        series: [{{ $loanpercentage }}, {{ $dpsPercentage }}, {{ $depositPercentage }}, {{ $savingsPercentage }}],
        labels: ["Loan", "DPS", "Deposit", "Savings"],
  chart: {
    type: "donut",
    width: "100%",
    height: 350,
  },
  plotOptions: {

    pie: {
      startAngle: -90,
      endAngle: 270,
    },
  },
  dataLabels: {
    enabled: false,
  },
  fill: {
    type: "gradient",
  },
  legend: {
    position: "bottom",
    formatter: function (val, opts) {
      return val + " - " + opts.w.globals.series[opts.seriesIndex];
    },
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: "100%",
        },
        legend: {
          position: "bottom",
        },
      },
    },
  ],
};
var chart = new ApexCharts(document.querySelector("#sales-by-category"), options1);
chart.render();

//  Monthly Sales Statistics
var options2 = {
  series: [
    {
      name: "In",
      data: inData,
    },
    {
      name: "Out",
      data: outData,
    },
  ],
  chart: {
    height: 350,
    type: "area",
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
  },
  xaxis: {
    type: "category",
    categories: categories,
  },
  tooltip: {
    x: {
      formatter: function (val) {
        return "Month: " + val; // you can customize this
      },
    },
  },
};
var chart = new ApexCharts(document.querySelector("#monthly-sales-statistics"), options2);
chart.render();


</script>