<?php 
    require_once "../config.php";
    require_once (ROOT_DIR.'/includes/verifySession.inc.php'); 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="index">
    <meta name="description" content="Temperature and humitity chart of some place">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>DashBoard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.2.6/gridstack.min.css" />
    <link rel="stylesheet" href="css/index.css" />

</head>

<body>
    <div class="container-fluid">
        <!-- Container -->
        <div class="grid-stack" data-gs-width="12" data-gs-height="12">
            <div class="grid-stack grid-stack-item" data-gs-x="2" data-gs-y="0" data-gs-width="8" data-gs-height="1" data-gs-locked="true" data-gs-no-move="true" data-gs-no-resize="true">
                <div class="grid-stack-item-content">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <!-- Second Container at (2, 0) to have some margin -->
            <div class="grid-stack grid-stack-item" data-gs-x="2" data-gs-y="1" data-gs-width="8" data-gs-height="10" data-gs-locked="true" data-gs-no-move="true" data-gs-no-resize="true">
                <!-- Temperature -->
                <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-A1">
                            <img class="icon" src="src/calendar.png" />
                        </div>
                        <div class="content-down grid-stack-item-A2">
                            <div id="cal"></div>
                        </div>
                    </div>
                </div>
                <!-- Humitity -->
                <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-B1">
                            <img class="icon" src="src/temperature%20meter.png" />
                        </div>
                        <div class="content-down grid-stack-item-B2">
                            <div id="temp"></div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-C1">
                            <img class="icon" src="src/humidity%20meter.png" />
                        </div>
                        <div class="content-down grid-stack-item-C2">
                            <div id="humi"></div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="grid-stack-item" data-gs-x="0" data-gs-y="4" data-gs-width="8" data-gs-height="6">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-D1"></div>
                        <div class="content-down grid-stack-item-D2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="js/gridstack.js"></script>
    <script src="js/gridstack.jQueryUI.js"></script>

    <script type="text/javascript">
        $(function() {
            var options = {
                float: false
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

                    return hrs + ' hours ' + mins + ' minutes ' + secs + ' seconds ago';
                }
                
                $("#temp").wrapInner("<p class='dataP'>" + list[1] + "</p><p class='timeP'>" + msToTime(dt - dtData) + "</p>");
                $("#humi").wrapInner("<p class='dataP'>" + list[2] + "</p><p class='timeP'>" + msToTime(dt - dtData) + "</p>");
                $("#cal").wrapInner("<p>" + date + "</p><p>" + time + "</p>");
            });
        });

    </script>

</body>

</html>
