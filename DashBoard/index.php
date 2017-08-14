<?php 
    require_once "../config.php";
    require_once (ROOT_DIR.'/includes/verifySession.inc.php'); 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="index">
    <meta name="description" content="Dashboard of somewhere">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>DashBoard</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.2.6/gridstack.min.css" />
    <link rel="stylesheet" href="css/index.css" />

</head>

<body>
    <div>
        <div>
            <h1>Dashboard</h1>
        </div>
        <!-- Container -->
        <div id='outer'>
            <div id='inner' class="grid-stack grid-stack-main" data-gs-x="0" data-gs-y="0" data-gs-width="12" data-gs-height="12" data-gs-locked="true" data-gs-no-move="true" data-gs-no-resize="true">
                <!-- Calendar -->
                <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="4" data-gs-height="2">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-A1">
                            <img class="icon dataIcon" src="src/calendar.png" />
                        </div>
                        <div class="content-down grid-stack-item-A2">
                            <div id="cal"></div>
                        </div>
                    </div>
                </div>
                <!-- Temperature -->
                <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="2">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-B1">
                            <img class="icon dataIcon" src="src/temperature%20meter.png" />
                        </div>
                        <div class="content-down grid-stack-item-B2">
                            <div id="temp" class="dataDiv"></div>
                        </div>
                    </div>
                </div>
                <!-- Humitity -->
                <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="4" data-gs-height="2">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-C1">
                            <img class="icon dataIcon" src="src/humidity%20meter.png" />
                        </div>
                        <div class="content-down grid-stack-item-C2">
                            <div id="humi" class="dataDiv"></div>
                        </div>
                    </div>
                </div>
                <!-- Cat Food -->
                <div class="grid-stack-item" data-gs-x="0" data-gs-y="2" data-gs-width="4" data-gs-height="2">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-D1">
                            <img class="icon dataIcon" src="src/catFoodIcon.png" />
                        </div>
                        <div class="content-down grid-stack-item-D2">
                            <div id="food" class="dataDiv"></div>
                        </div>
                    </div>
                </div>
                <!-- Cat Water -->
                <div class="grid-stack-item" data-gs-x="4" data-gs-y="2" data-gs-width="4" data-gs-height="2">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-E1">
                            <img class="icon dataIcon" src="src/catWaterIcon.png" />
                        </div>
                        <div class="content-down grid-stack-item-E2">
                            <div id="water" class="dataDiv"></div>
                        </div>
                    </div>
                </div>
                <!-- Buton chart.php -->
                <div class="grid-stack-item" data-gs-x="8" data-gs-y="2" data-gs-width="2" data-gs-height="1">
                    <div class="grid-stack-item-content grid-stack-item-1">
                        <a href="tempHumiChart.php" alt="TempHumiChart Page"><img class="icon buttonIcon" src="src/TempHumiChartBtnIcon.png" /></a>
                    </div>
                </div>
                <!-- Buton CatChart -->
                <div class="grid-stack-item" data-gs-x="10" data-gs-y="2" data-gs-width="2" data-gs-height="1">
                    <div class="grid-stack-item-content grid-stack-item-2">
                        <a href="catChart.php" alt="CatChart Page"><img class="icon buttonIcon" src="src/CatChartBtnIcon.png" /></a>
                    </div>
                </div>
                <!-- Buton 3 -->
                <div class="grid-stack-item" data-gs-x="8" data-gs-y="3" data-gs-width="2" data-gs-height="1">
                    <div class="grid-stack-item-content grid-stack-item-3">
                    </div>
                </div>
                <!-- Buton Disconnect.php -->
                <div class="grid-stack-item" data-gs-x="10" data-gs-y="3" data-gs-width="2" data-gs-height="1">
                    <div class="grid-stack-item-content grid-stack-item-4">
                        <a href="../disconnect/" alt="Disconnect"><img class="icon buttonIcon" src="src/disconnect.png" /></a>
                    </div>
                </div>
                <!-- TemHumiChart -->
                <div class="grid-stack-item" data-gs-x="0" data-gs-y="4" data-gs-width="6" data-gs-height="3">
                    <div class="grid-stack-item-content grid-stack-item-5">
                        <canvas id="tempHumiChart"></canvas>
                    </div>
                </div>
                <!-- FoodWaterChart -->
                <div class="grid-stack-item" data-gs-x="6" data-gs-y="4" data-gs-width="6" data-gs-height="3">
                    <div class="grid-stack-item-content grid-stack-item-6">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/gridstack.js"></script>
    <script src="js/gridstack.jQueryUI.js"></script>

    <script type="text/javascript">
        $(function() {
            var options = {
                float: false,
                cellHeight: 'auto'
            };
            $('.grid-stack').gridstack(options);

            $.get("data.php", {
                single: true
            }, function(result) {
                result = result.replace(/"/g, ""); // js replace only replace the first caractor, use g for global
                var list = result.split(';');

                var dt = new Date($.now());
                var date = dt.getFullYear() + "-" + dt.getMonth() + "-" + dt.getDay();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

                var dtData = new Date();
                dtData.setFullYear(list[0].substr(0, 4));
                dtData.setMonth(parseInt(list[0].substr(5, 2)) - 1);
                dtData.setDate(list[0].substr(8, 2));
                dtData.setHours(list[0].substr(11, 2));
                dtData.setMinutes(list[0].substr(14, 2));
                dtData.setSeconds(list[0].substr(17, 2));

                function msToTime(s) {
                    s = s / 1000;
                    var secs = s % 60;
                    s = (s - secs) / 60;
                    var mins = s % 60;
                    var hrs = (s - mins) / 60;

                    if (hrs == 0) {
                        return mins + ' minutes ' + secs + ' seconds ago';
                    } else {
                        return hrs + ' hours ' + mins + ' minutes ' + secs + ' seconds ago';
                    }
                }

                $("#temp").wrapInner("<p id='tempValue' class='pWhite dataP'>" + list[1] + "</p><p id='tempTime' class='pWhite timeP'>" + msToTime(dt - dtData) + "</p>");
                $("#humi").wrapInner("<p id='humiValue' class='pWhite dataP'>" + list[2] + "</p><p id='humiTime' class='pWhite timeP'>" + msToTime(dt - dtData) + "</p>");
                $("#cal").wrapInner("<p id='calendarDate'>" + date + "</p><p id='calendarDate'>" + time + "</p>");

                $("#food").wrapInner("<p id='foodValue' class='pWhite dataP'>100%</p><p id='foodTime' class='pWhite timeP'>1s ago</p>");
                $("#water").wrapInner("<p id='waterValue' class='pWhite dataP'>100%</p><p id='waterTime' class='pWhite timeP'>1s ago</p>");

                // fitText.js
                $("#tempValue, #humiValue, #foodValue, #waterValue").each(
                    function() {
                        $(this).fitText(0.8, {
                            maxFontSize: '55px',
                            maxFontSize: '40px'
                        });
                    });
            });
        });

    </script>

    <script type="text/javascript" src="js/papaparse.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script>
        var json = null;
        var finalList = [];
        var data = {};
        var options = {};
        var ctx = $("#tempHumiChart");

        window.onload = function() {
            window.myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
            $("#tempHumChart").css("display", "inline-block");
        }

        var url = "data.php";
        $.get(url, {
            oneday: true,
            t: new Date().getTime()
        }, function(result) {

            //console.log(result);
            Papa.parse(result, {
                //download: true,
                header: true,
                skipEmptyLines: true,
                complete: function(result) {
                    //console.log(result);
                    var tempList = [];
                    var humList = []
                    var timeList = []

                    var step = result.data.length >= 30 ? (result.data.length / 20 | 0) : 1;
                    console.log(step);
                    var counter = step;
                    // loop over json object
                    for (var key in result.data) {
                        if (result.data.hasOwnProperty(key)) {
                            if (counter == step) {
                                counter = 0;
                                // extract data
                                time = result.data[key].DateTime.split(" ")[1];
                                temp = result.data[key].Temp;
                                hum = result.data[key].Hum;

                                timeList.push(time);
                                tempList.push(temp);
                                humList.push(hum);
                            }
                            counter++;
                        }
                    }

                    data = {
                        labels: timeList,
                        datasets: [{
                                label: "Temperature",
                                data: tempList,
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                fill: false
                            },
                            {
                                label: "Humitity",
                                data: humList,
                                backgroundColor: 'rgb(99, 132, 255)',
                                borderColor: 'rgb(99, 132, 255)',
                                fill: false
                            }
                        ]
                    };
                    console.log(data);
                    options = {
                        responsive: true,
                        layout: {
                            padding: {
                                left: 10,
                                right: 10,
                                top: 0,
                                bottom: 0
                            }
                        },
                        title: {
                            display: true,
                            text: 'Temperature & Humitity'
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: false
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Value'
                                }
                            }]
                        }
                    };

                    window.myChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: options
                    });;
                }
            });
        });

    </script>

</body>

</html>
