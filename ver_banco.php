<?php
$json = file_get_contents("BDreceitas.json");

print_r(json_decode($json, JSON_PRETTY_PRINT));


/*$json = json_decode($json);

foreach ($json as $key => $value) {
	print_r($value->totalTime->datetime);
	echo "<br>";
}*/

