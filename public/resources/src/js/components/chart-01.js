import ApexCharts from "apexcharts";

const chart01 = () => {
  let chartOne;
  const chartEl = document.querySelector("#chartOne");

  const generateChartData = (range, year) => {
    switch (range) {
      case "day":
        return {
          categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
          series: [
            { name: "Product One", data: [10, 20, 30, 40, 25, 35, 45] },
            { name: "Product Two", data: [15, 25, 35, 20, 30, 40, 50] },
          ],
        };
      case "week":
        return {
          categories: ["Week 1", "Week 2", "Week 3", "Week 4"],
          series: [
            { name: "Product One", data: [100, 150, 120, 130] },
            { name: "Product Two", data: [90, 110, 140, 160] },
          ],
        };
      case "month":
        return {
          categories: [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
          ],
          series: [
            { name: "Product One", data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30, 45] },
            { name: "Product Two", data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39, 51] },
          ],
        };
      case "year":
        return {
          categories: ["2021", "2022", "2023", "2024", "2025"],
          series: [
            { name: "Product One", data: [500, 700, 800, 750, 900] },
            { name: "Product Two", data: [450, 650, 700, 800, 950] },
          ],
        };
      default:
        return { categories: [], series: [] };
    }
  };

  const initChart = (range = "month", year = "2025") => {
    const data = generateChartData(range, year);

    const chartOneOptions = {
      series: data.series,
      legend: { show: false, position: "top", horizontalAlign: "left" },
      colors: ["#3C50E0", "#80CAEE"],
      chart: {
        fontFamily: "Satoshi, sans-serif",
        height: 335,
        type: "area",
        dropShadow: {
          enabled: true,
          color: "#623CEA14",
          top: 10,
          blur: 4,
          left: 0,
          opacity: 0.1,
        },
        toolbar: { show: false },
      },
      responsive: [
        {
          breakpoint: 1024,
          options: { chart: { height: 300 } },
        },
        {
          breakpoint: 1366,
          options: { chart: { height: 350 } },
        },
      ],
      stroke: { width: [2, 2], curve: "straight" },
      dataLabels: { enabled: false },
      markers: {
        size: 4,
        colors: "#fff",
        strokeColors: ["#3056D3", "#80CAEE"],
        strokeWidth: 3,
        hover: { sizeOffset: 5 },
      },
      grid: {
        xaxis: { lines: { show: true } },
        yaxis: { lines: { show: true } },
      },
      xaxis: {
        type: "category",
        categories: data.categories,
        axisBorder: { show: false },
        axisTicks: { show: false },
      },
      yaxis: {
        title: { style: { fontSize: "0px" } },
        min: 0,
        max: 1000,
      },
    };

    if (chartOne) {
      chartOne.updateOptions(chartOneOptions);
    } else {
      chartOne = new ApexCharts(chartEl, chartOneOptions);
      chartOne.render();
    }
  };

  initChart(); // default "month"

  // Event listener
  document.querySelectorAll(".btn-range").forEach((btn) => {
    btn.addEventListener("click", () => {
      const range = btn.dataset.range;
      const year = document.querySelector("#yearSelector").value;
      initChart(range, year);
    });
  });

  document.querySelector("#yearSelector").addEventListener("change", (e) => {
    const range = document.querySelector(".btn-range.bg-white")?.dataset.range || "month";
    initChart(range, e.target.value);
  });
};

export default chart01;
