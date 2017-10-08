<?php
require_once "../config.php";
require_once (ROOT_DIR.'/includes/param.inc.php');

$header = null;
$data = null;
$sql = null;
$line = null;

$conn = new mysqli($host, $user, $dbpw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection failed: $conn";
} else {
    if (isset($_GET['all'])) {
        $sql = "SELECT dateandtime AS DateTime, temp AS Temp, hum AS Hum FROM temphum;";
    }else if (isset($_GET['single'])) {
        $sql = "SELECT dateandtime AS DateTime, temp AS Temp, hum AS Hum FROM temphum ORDER BY dateandtime DESC LIMIT 1;";
    }else if (isset($_GET['single_food_water'])) {
        $sql = "SELECT dateandtime AS DateTime, foodpct AS Food, waterPCT AS water FROM foodwater ORDER BY dateandtime DESC LIMIT 1;";
    }else if (isset($_GET['oneday'])) {
        $sql = "SELECT dateandtime AS DateTime, temp AS Temp, hum AS Hum FROM temphum where (
                    dateandtime >=  '". date("Y-m-d") . "' and dateandtime < '" . (new DateTime('tomorrow'))->format('Y-m-d') .
                "');";
    }else{ // 1000 data
        $sql = "SELECT dateandtime AS DateTime, temp AS Temp, hum AS Hum FROM (
                    SELECT * FROM temphum 
                    ORDER BY dateandtime DESC LIMIT 1000) as latest
                ORDER BY dateandtime ASC;";
    }
    
    //echo $sql;
    $result = $conn->query($sql);
    $conn->close();
    if($result->num_rows == 0){
        echo 'failed';
    } else if (isset($_GET['single'])) {
        $row = $result->fetch_row();
        foreach( $row as $value )
        {                                            
            if ( ( !isset( $value ) ) || ( $value == "" ) )
            {
                $value = ";";
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '"' . $value . '"' . ";";
            }
            $line .= $value;
        }
        echo $line;
    } else{
        $fields = $result->field_count;       
        for ( $i = 0; $i < $fields; $i++ )
        {
            $header .= $result->fetch_fields()[$i]->name . ";";
        }
        //echo $header;

        while( $row = $result->fetch_row() )
        {
            $line = '';
            foreach( $row as $value )
            {                                            
                if ( ( !isset( $value ) ) || ( $value == "" ) )
                {
                    $value = ";";
                }
                else
                {
                    $value = str_replace( '"' , '""' , $value );
                    $value = '"' . $value . '"' . ";";
                }
                $line .= $value;
            }
            $data .= trim( $line ) . "\n";
        }
        $data = str_replace( "\r" , "" , $data );
        echo "$header\n$data";
    }
}
?>
