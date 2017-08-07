<?php

$dateandtime = ( isset ( $_GET["dt"] ) ) ? trim ( $_GET["dt"] ) : '';;
$temp = ( isset ( $_GET["t"] ) ) ? trim ( $_GET["t"] ) : '';;
$hum = ( isset ( $_GET["h"] ) ) ? trim ( $_GET["h"] ) : '';;

$host = '127.0.0.1';
$user = 'catprogrammer';
$pw = 'catcatcat';
$db = 'catprogrammer';

if($dateandtime != '' && $temp != '' && $hum != ''){
    $conn = new mysqli($host, $user, $pw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "Connection failed: $conn";
    } else {
        $dateandtime = $conn->real_escape_string(urldecode($dateandtime));
        $temp =  $conn->real_escape_string(urldecode($temp));
        $hum =  $conn->real_escape_string(urldecode($hum));

        $sql = "INSERT INTO temphum VALUES('$dateandtime', '$temp', '$hum')";
	//echo $sql;
        if($conn->query($sql) === true){
            echo 'ok'; 
        } else{
            //echo $conn->error;
            echo 'failed';
        }
        $conn->close();
    }
} else {
    echo 'params error';
}
?>

