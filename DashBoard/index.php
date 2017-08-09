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
        <h1>Dashboard</h1>
        <!-- Container -->
        <div class="grid-stack" data-gs-width="12" data-gs-height="12">
            <!-- Second Container at (2, 0) to have some margin -->
            <div class="grid-stack grid-stack-item" data-gs-x="2" data-gs-y="0" data-gs-width="8" data-gs-height="10" data-gs-locked="true" data-gs-no-move="true" data-gs-no-resize="true">
                <!-- Temperature -->
                <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-A1"></div>
                        <div class="content-down grid-stack-item-A2"></div>
                    </div>
                </div>
                <!-- Humitity -->
                <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-B1"></div>
                        <div class="content-down grid-stack-item-B2"></div>
                    </div>
                </div>
                <!--  -->
                <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                    <div class="grid-stack-item-content">
                        <div class="content-up grid-stack-item-C1"></div>
                        <div class="content-down grid-stack-item-C2"></div>
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
            
            $.get("data.php", {single:true}, function(result){
                alert(result);
            });
        });

    </script>

</body>

</html>
