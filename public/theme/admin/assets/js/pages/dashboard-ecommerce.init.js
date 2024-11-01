var ordersData = JSON.parse(
    document.querySelector('meta[name="orders-data"]').getAttribute("content")
);

var ordersCancelData = JSON.parse(
    document
        .querySelector('meta[name="orderscancel-data"]')
        .getAttribute("content")
);

var earningsData = JSON.parse(
    document.querySelector('meta[name="earnings-data"]').getAttribute("content")
);

var refundsData = JSON.parse(
    document.querySelector('meta[name="refunds-data"]').getAttribute("content")
);

var productData = JSON.parse(
    document.querySelector('meta[name="product-data"]').getAttribute("content")
);

function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t = document.getElementById(e).getAttribute("data-colors");
        if (t)
            return (t = JSON.parse(t)).map(function (e) {
                var t = e.replace(" ", "");
                return -1 === t.indexOf(",")
                    ? getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(t) || t
                    : 2 == (e = e.split(",")).length
                    ? "rgba(" +
                      getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(e[0]) +
                      "," +
                      e[1] +
                      ")"
                    : t;
            });
        console.warn("data-colors atributes not found on", e);
    }
}
var options,
    chart,
    linechartcustomerColors = getChartColorsArray("customer_impression_charts"),
    chartDonutBasicColors =
        (linechartcustomerColors &&
            ((options = {
                series: [
                    {
                        name: "Orders",
                        type: "area",
                        data: ordersData,
                    },
                    {
                        name: "Earnings",
                        type: "bar",
                        data: earningsData,
                    },
                    {
                        name: "Refunds",
                        type: "line",
                        data: refundsData,
                    },
                    {
                        name: "Order Cancel",
                        type: "line",
                        data: ordersCancelData,
                    },
                    {
                        name: "Product",
                        type: "area",
                        data: productData,
                    },
                ],
                chart: { height: 370, type: "line", toolbar: { show: !1 } },
                stroke: {
                    curve: "straight",
                    dashArray: [0, 0, 8, 4],
                    width: [2, 0, 2.2, 2],
                },
                fill: { opacity: [0.1, 0.9, 1, 0.5] },
                markers: {
                    size: [0, 0, 0, 0],
                    strokeWidth: 2,
                    hover: { size: 4 },
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    axisTicks: { show: !1 },
                    axisBorder: { show: !1 },
                },
                // yaxis: {
                //     min: 0,
                //     max: 120,
                //     tickAmount: 4,
                //     labels: {
                //         formatter: function (value) {
                //             return value + " tr"; // Hiển thị đơn vị "tr"
                //         }
                //     }
                // },
                grid: {
                    show: !0,
                    xaxis: { lines: { show: !0 } },
                    yaxis: { lines: { show: !1 } },
                    padding: { top: 0, right: -2, bottom: 15, left: 10 },
                },
                legend: {
                    show: !0,
                    horizontalAlign: "center",
                    offsetX: 0,
                    offsetY: -5,
                    markers: { width: 9, height: 9, radius: 6 },
                    itemMargin: { horizontal: 10, vertical: 0 },
                },
                plotOptions: { bar: { columnWidth: "30%", barHeight: "70%" } },
                colors: linechartcustomerColors,
                tooltip: {
                    shared: !0,
                    y: [
                        {
                            formatter: function (e) {
                                return void 0 !== e ? e.toFixed(0) : e;
                            },
                        },
                        {
                            formatter: function (e) {
                                return void 0 !== e
                                    ? "$ " +
                                          e.toLocaleString("vi-VN", {
                                              style: "currency",
                                              currency: "VND",
                                          })
                                    : e;
                            },
                        },
                        {
                            formatter: function (e) {
                                return void 0 !== e
                                    ? e.toFixed(0) + " Sales"
                                    : e;
                            },
                        },
                        {
                            formatter: function (e) {
                                return void 0 !== e
                                    ? e.toFixed(0) + " "
                                    : e;
                            },
                        },
                        {
                            formatter: function (e) {
                                return void 0 !== e
                                    ? e.toFixed(0) + " "
                                    : e;
                            },
                        },
                    ],
                },
            }),
            (chart = new ApexCharts(
                document.querySelector("#customer_impression_charts"),
                options
            )).render()),
        getChartColorsArray("store-visits-source")),
    worldemapmarkers =
        (chartDonutBasicColors &&
            ((options = {
                series: [44, 55, 41, 17, 15],
                labels: ["Direct", "Social", "Email", "Other", "Referrals"],
                chart: { height: 333, type: "donut" },
                legend: { position: "bottom" },
                stroke: { show: !1 },
                dataLabels: { dropShadow: { enabled: !1 } },
                colors: chartDonutBasicColors,
            }),
            (chart = new ApexCharts(
                document.querySelector("#store-visits-source"),
                options
            )).render()),
        "");
function loadCharts() {
    var e = getChartColorsArray("sales-by-locations");
    e &&
        ((document.getElementById("sales-by-locations").innerHTML = ""),
        (worldemapmarkers = ""),
        (worldemapmarkers = new jsVectorMap({
            map: "world_merc",
            selector: "#sales-by-locations",
            zoomOnScroll: true,
            zoomButtons: true,
            selectedMarkers: [0, 5],
            regionStyle: {
                initial: {
                    stroke: "#9599ad",
                    strokeWidth: 0.25,
                    fill: e[0],
                    fillOpacity: 1,
                },
            },
            markersSelectable: !0,
            markers: [
                { name: "Hà Nội", coords: [21.0285, 105.8542] },
                { name: "Đà Nẵng", coords: [16.0471, 108.2068] },
                { name: "Hồ Chí Minh", coords: [10.8231, 106.6297] },
            ],
            markerStyle: { initial: { fill: e[1] }, selected: { fill: e[2] } },
            labels: {
                markers: {
                    render: function (e) {
                        return e.name;
                    },
                },
            },
        })));
}
(window.onresize = function () {
    setTimeout(() => {
        loadCharts();
    }, 0);
}),
    loadCharts();
var overlay,
    swiper = new Swiper(".vertical-swiper", {
        slidesPerView: 2,
        spaceBetween: 10,
        mousewheel: !0,
        loop: !0,
        direction: "vertical",
        autoplay: { delay: 2500, disableOnInteraction: !1 },
    }),
    layoutRightSideBtn = document.querySelector(".layout-rightside-btn");
layoutRightSideBtn &&
    (Array.from(document.querySelectorAll(".layout-rightside-btn")).forEach(
        function (e) {
            var t = document.querySelector(".layout-rightside-col");
            e.addEventListener("click", function () {
                t.classList.contains("d-block")
                    ? (t.classList.remove("d-block"), t.classList.add("d-none"))
                    : (t.classList.remove("d-none"),
                      t.classList.add("d-block"));
            });
        }
    ),
    window.addEventListener("resize", function () {
        var e = document.querySelector(".layout-rightside-col");
        e &&
            Array.from(
                document.querySelectorAll(".layout-rightside-btn")
            ).forEach(function () {
                window.outerWidth < 1699 || 3440 < window.outerWidth
                    ? e.classList.remove("d-block")
                    : 1699 < window.outerWidth && e.classList.add("d-block");
            }),
            "semibox" == document.documentElement.getAttribute("data-layout") &&
                (e.classList.remove("d-block"), e.classList.add("d-none"));
    }),
    (overlay = document.querySelector(".overlay"))) &&
    document.querySelector(".overlay").addEventListener("click", function () {
        1 ==
            document
                .querySelector(".layout-rightside-col")
                .classList.contains("d-block") &&
            document
                .querySelector(".layout-rightside-col")
                .classList.remove("d-block");
    }),
    window.addEventListener("load", function () {
        var e = document.querySelector(".layout-rightside-col");
        e &&
            Array.from(
                document.querySelectorAll(".layout-rightside-btn")
            ).forEach(function () {
                window.outerWidth < 1699 || 3440 < window.outerWidth
                    ? e.classList.remove("d-block")
                    : 1699 < window.outerWidth && e.classList.add("d-block");
            }),
            "semibox" == document.documentElement.getAttribute("data-layout") &&
                1699 < window.outerWidth &&
                (e.classList.remove("d-block"), e.classList.add("d-none"));
    });
