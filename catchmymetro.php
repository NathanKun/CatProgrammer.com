<?php
header('Content-Type:application/json');

// http POST
//$url = 'https://requestb.in/1adeisq1';
$url = 'https://reseau-astuce.fr/fr/horaires-a-larret/28/StopTimeTable/NextDeparture';
$data = array(
	"sens" => "1",
	"destinations" => "{\"1\":\"Technopôle SAINT-ETIENNE-DU-ROUVRAY\"}",
	"stopId" => "100783",
	"lineId" => "175"
);
$header = 
	"Content-type: application/x-www-form-urlencoded\r\n"
	."Cache-Control: no-cache\r\n"
	."User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36\r\n"
	."Accept: */*\r\n"
;
$options = array(
    'http' => array(
        'header'  => $header,
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// build result time array
libxml_use_internal_errors(true); //Prevents Warnings, remove if desired
$dom = new DOMDocument();
$dom->loadHTML($result);
$resultList = array();

foreach($dom->getElementsByTagName("ul")->item(0)->childNodes as $child) {
	$time = trim($child->nodeValue);
	if($time !== ""){
		$int = preg_replace('/\D/', '', $time);
		$int = $int == "" ? "<1" : $int;
		array_push($resultList, $int);
	}
}

//echo '<pre>'; print_r($resultList); echo '</pre>';
$now = new DateTime();
$now->setTimezone(new DateTimeZone('Europe/Paris'));
$reponseText = "It is " . $now->format('H:i') . ". Next metro in ";
foreach ($resultList as $minutes) {
	$reponseText .= $minutes;
	$reponseText .= " minutes, ";
}


if ($reponseText === FALSE) { /* Handle error */ }

// response
$res = array(
	'speech' => $reponseText,
	'displayText' => $reponseText,
	'data'=> array(
		'google' => array(
			'expect_user_response' => false)
		),
	'source' => 'CatProgrammer');
	
echo json_encode($res);
