<?php

$host = '127.0.0.1';
$user = 'catprogrammer';
$pw = 'catcatcat';
$db = 'catprogrammer';

$conn = new mysqli($host, $user, $pw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection failed: $conn";
} else {
    $sql = "SELECT dateandtime AS DateTime, temp AS Temp, hum AS Hum FROM temphum";
    //echo $sql;
    $result = $conn->query($sql);
    $conn->close();
    if($result->num_rows == 0){
        echo 'failed';
    } else {
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

