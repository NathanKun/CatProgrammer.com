<?php

$dateandtime = ( isset ( $_GET["dt"] ) ) ? trim ( $_GET["dt"] ) : '';
$temp = ( isset ( $_GET["t"] ) ) ? trim ( $_GET["t"] ) : '';
$hum = ( isset ( $_GET["h"] ) ) ? trim ( $_GET["h"] ) : '';
$food = ( isset ( $_GET["f"] ) ) ? trim ( $_GET["f"] ) : '';
$water = ( isset ( $_GET["w"] ) ) ? trim ( $_GET["w"] ) : '';
$foodpct = ( isset ( $_GET["fp"] ) ) ? trim ( $_GET["fp"] ) : '';
$waterpct = ( isset ( $_GET["wp"] ) ) ? trim ( $_GET["wp"] ) : '';

require_once "../config.php";
require_once (ROOT_DIR.'/includes/param.inc.php');

if(($dateandtime != '' && $temp != '' && $hum != '') || ($food != '' && $water != '' && $foodpct != '' && $waterpct != '')){
    $conn = new mysqli($host, $user, $dbpw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "Connection failed: $conn";
    } else {
        if($temp != '' && $hum != '') {
            $dateandtime = $conn->real_escape_string(urldecode($dateandtime));
            $temp =  $conn->real_escape_string(urldecode($temp));
            $hum =  $conn->real_escape_string(urldecode($hum));

            $sql = "INSERT INTO temphum VALUES('$dateandtime', '$temp', '$hum')";
        } else {
            $food =  $conn->real_escape_string(urldecode($food));
            $water =  $conn->real_escape_string(urldecode($water));
            $foodpct =  $conn->real_escape_string(urldecode($foodpct));
            $waterpct =  $conn->real_escape_string(urldecode($waterpct));

            $sql = "INSERT INTO foodwater(food, foodpct, water, waterpct) VALUES('$food', '$foodpct', '$water', '$waterpct')";
        }
	//echo $sql;
        if($conn->query($sql) === true){
            echo 'ok'; 
        } else{
            echo $conn->error;
            echo 'failed';
        }
        $conn->close();
    }
} else {
    echo 'params error';
}
?>
