type = ['primary', 'info', 'success', 'warning', 'danger'];
var chart_labels1 = [];
var chart_data1 = [];
var chart_labels2 = [];
var chart_data2 = [];
var chart_labels3 = [];
var chart_data3 = [];
var chart_labels4 = [];
var chart_data4 = [];
var chart_labels5 = [];
var chart_data5 = [];
var chart_labels6 = [];
var chart_data6 = [];

//dashboard
var chart_product_trivia_revenue_labels = [];
var chart_product_trivia_revenue_data = [];
var chart_chart_product_bid_revenue_labels = [];
var chart_chart_product_bid_revenue_data = [];
var chart_chart_product_wallet_revenue_labels = [];
var chart_chart_product_wallet_revenue_data = [];
var chart_chart_product_voteussd_revenue_labels = [];
var chart_chart_product_voteussd_revenue_data = [];
var chart_chart_product_votewallet_revenue_labels = [];
var chart_chart_product_votewallet_revenue_data = [];


var bidChart;
var triviaChart, triviaChart1, triviaChart2,triviaChart3,triviaChart4,triviaChart5,triviaChart6,triviaChart7 ;
var walletChart;
var voteChart;
var revenueChart;

gradientChartOptionsConfigurationWithTooltipBlue = {
    maintainAspectRatio: false,
    legend: {
        display: false
    },
    tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
    },
    responsive: true,
    scales: {
        yAxes: [{
            barPercentage: 1.6,
            gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.0)',
                zeroLineColor: "transparent",
            },
            ticks: {
                suggestedMin: 60,
                suggestedMax: 125,
                padding: 20,
                fontColor: "#2380f7"
            }
        }],
        xAxes: [{
            barPercentage: 1.6,
            gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.1)',
                zeroLineColor: "transparent",
            },
            ticks: {
                padding: 20,
                fontColor: "#2380f7"
            }
        }]
    }
};

demo1 = {
    
    initDashboardBidPageCharts: function() {
 
        var ctx_productbid = document.getElementById("chartProduct_revenue").getContext("2d");
        //ctx_productbid.clear();
        var gradientStroke = ctx_productbid.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        
        var data = {
            labels: chart_chart_product_bid_revenue_labels,
            datasets: [
            {
                label: "Bid Revenue (USSD)",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'red',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_bid_revenue_data,
            },
            {
                label: "Bid Revenue (Wallet)",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'gold',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_wallet_revenue_data,
            }]
        };
            bidChart =new Chart(ctx_productbid, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

    },
}
demo = {
    initDashboardRevenuePageCharts: function() {
 
        var ctx_productrevenue = document.getElementById("chartProduct_revenue").getContext("2d");
        var gradientStroke = ctx_productrevenue.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        
        var data = {
            labels: chart_chart_product_bid_revenue_labels,
            datasets: [{
                label: "Trivia Revenue",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_product_trivia_revenue_data,
            },
            {
                label: "Bid Revenue",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'red',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_bid_revenue_data,
            },
            {
                label: "Wallet Revenue",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'gold',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_wallet_revenue_data,
            },
            {
                label: "Vote (Wallet)",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'gold',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_votewallet_revenue_data,
            },
            {
                label: "Vote (USSD)",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'gold',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_voteussd_revenue_data,
            }]
        };
        revenueChart = new Chart(ctx_productrevenue, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

    },
   
    initDashboardWalletPageCharts: function() {
 
        var ctx_productrevenue = document.getElementById("chartProduct_revenue").getContext("2d");
        var gradientStroke = ctx_productrevenue.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        
        var data = {
            labels: chart_chart_product_bid_revenue_labels,
            datasets: [
            {
                label: "Debits",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'red',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_bid_revenue_data,
            },
            {
                label: "Credits",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'gold',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_wallet_revenue_data,
            }]
        };
        walletChart = new Chart(ctx_productrevenue, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

    },
    initDashboardVotePageCharts: function() {
 
        var ctx_productrevenue = document.getElementById("chartProduct_revenue").getContext("2d");
        var gradientStroke = ctx_productrevenue.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        
        var data = {
            labels: chart_chart_product_voteussd_revenue_labels,
            datasets: [
            {
                label: "Ussd Vote",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'red',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_voteussd_revenue_data,
            },
            {
                label: "Wallet Vote",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: 'gold',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_chart_product_votewallet_revenue_data,
            }]
        };
        voteChart = new Chart(ctx_productrevenue, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

    },

    initDashboardPageCharts: function() {

 
       var ctx_trivia = document.getElementById("chartLinePurple1").getContext("2d");
        var gradientStroke = ctx_trivia.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        console.log("datadd "+chart_data4);
        var data = {
            labels: chart_labels4,
            datasets: [{
                label: "Data",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data4,
            }]
        };
        triviaChart1 = new Chart(ctx_trivia, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

        var ctx_triviafree = document.getElementById("chartLinePurplefree").getContext("2d");
        var gradientStroke = ctx_triviafree.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        
        var data = {
            labels: chart_labels5,
            datasets: [{
                label: "Data",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data5,
            }]
        };
        triviaChart2 = new Chart(ctx_triviafree, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });


        var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");
        var gradientStroke = ctxGreen.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
        gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)');
        gradientStroke.addColorStop(0, 'rgba(66,134,121,0)');
        var data = {
            labels: chart_labels3,
            datasets: [{
                label: "My First dataset",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#00d6b4',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#00d6b4',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#00d6b4',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data3,
            }]
        };
        triviaChart3 = new Chart(ctxGreen, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

        var ctx = document.getElementById("chartLinePurple").getContext("2d");
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
        var data = {
            labels: chart_labels1,
            datasets: [{
                label: "Data",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data1,
            }]
        };
        triviaChart4 = new Chart(ctx, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });
        var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");
        var gradientStroke = ctxGreen.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
        gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)');
        gradientStroke.addColorStop(0, 'rgba(66,134,121,0)');
        var data = {
            labels: chart_labels3,
            datasets: [{
                label: "My First dataset",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#00d6b4',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#00d6b4',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#00d6b4',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data3,
            }]
        };
        triviaChart5 = new Chart(ctxGreen, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });


        var ctx = document.getElementById("CountryChart").getContext("2d");
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
        gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)');
        gradientStroke.addColorStop(0, 'rgba(66,134,121,0)');
        var data = {
            labels: chart_labels2,
            datasets: [{
                label: "My First dataset",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#00d6b4',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#00d6b4',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#00d6b4',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data2,
            }]
        };
        triviaChart6 = new Chart(ctx, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });

        var ctxfree = document.getElementById("CountryChartfree").getContext("2d");
        var gradientStroke = ctxfree.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
        gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)');
        gradientStroke.addColorStop(0, 'rgba(66,134,121,0)');
        var data = {
            labels: chart_labels6,
            datasets: [{
                label: "My First dataset",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#00d6b4',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#00d6b4',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#00d6b4',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: chart_data6,
            }]
        };
        triviaChart7 = new Chart(ctxfree, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipBlue
        });


    },
    initGoogleMaps: function() {
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            scrollwheel: false,
            styles: [{
                "elementType": "geometry",
                "stylers": [{
                    "color": "#1d2c4d"
                }]
            }, {
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#8ec3b9"
                }]
            }, {
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#1a3646"
                }]
            }, {
                "featureType": "administrative.country",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#4b6878"
                }]
            }, {
                "featureType": "administrative.land_parcel",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#64779e"
                }]
            }, {
                "featureType": "administrative.province",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#4b6878"
                }]
            }, {
                "featureType": "landscape.man_made",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#334e87"
                }]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#023e58"
                }]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#283d6a"
                }]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#6f9ba5"
                }]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#1d2c4d"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#023e58"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#3C7680"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#304a7d"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#98a5be"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#1d2c4d"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#2c6675"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#9d2a80"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#9d2a80"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#b0d5ce"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#023e58"
                }]
            }, {
                "featureType": "transit",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#98a5be"
                }]
            }, {
                "featureType": "transit",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#1d2c4d"
                }]
            }, {
                "featureType": "transit.line",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#283d6a"
                }]
            }, {
                "featureType": "transit.station",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#3a4762"
                }]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#0e1626"
                }]
            }, {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#4e6d70"
                }]
            }]
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!"
        });
        marker.setMap(map);
    },
    showNotification: function(from, align) {
        color = Math.floor((Math.random() * 4) + 1);
        $.notify({
            icon: "tim-icons icon-bell-55",
            message: "Welcome to <b>Black Dashboard</b> - a beautiful freebie for every web developer."
        }, {
            type: type[color],
            timer: 8000,
            placement: {
                from: from,
                align: align
            }
        });
    }
};