type = ['primary', 'info', 'success', 'warning', 'danger'];
var chart_labels1 = [];
var chart_data1 = [];
var triviaChart4

gradientChartOptionsConfigurationWithTooltipBlue = {
    maintainAspectRatio: false,
    legend: {
        display: true
    },
    tooltips: {
        backgroundColor: '#2380f7',
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


demo = {
    initDashboardRevenuePageCharts: function() {
 triviaChart4.destroy();
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
   

    initDashboardPageCharts: function() {

        var ctx = document.getElementById("chartLinePurple").getContext("2d");

        if (triviaChart4) {
            triviaChart4.destroy();
        }
    console.log(chart_labels1)
    console.log(chart_data1)
        // Gradient for bars (optional)
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');
    
        var data = {
            labels: chart_labels1,
            datasets: [{
                label: "Date",
                backgroundColor: gradientStroke, // gradient fill inside bars
                //borderColor: '#d048b6',          // optional bar border
                borderWidth: 1,
                data: chart_data1
            }]
        };
    
        triviaChart4 = new Chart(ctx, {
            type: 'bar', // 🔹 Changed from 'line' to 'bar'
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(119,52,169,0)"
                        },
                        title: {           // ✅ Y-axis label
                            display: true,
                            text: "Cost for Item", // <--- Change this to what you want
                            color: "#333",
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        enabled: true
                    },
                    legend: {
                        display: true
                    }
                }
            }
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