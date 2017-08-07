<?php
/*
require "./path.php";
if (defined(ROOTPATH)){
	require_once ROOTHPATH . "/includes/param.inc.php";
} else if(defined (INCLUDESPATH)){
	require_once INCLUDESPATH . "/param.inc.php";
}*/

@include "./includes/param.inc.php";
@include "./param.inc.php";

global $host;
global $user;
global $dbpw;
global $db;
$conn = new mysqli($host, $user, $dbpw, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection failed: $conn";
} 
?>
