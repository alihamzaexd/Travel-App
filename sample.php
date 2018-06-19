<?php
include 'Functions.php';
$db = MakeConnection2();

$country = $_POST['hotelDestination'];
$temp = $country . "%";
 
$sql3 =<<<EOF
		SELECT city_name,city_code,country_code,country_name FROM cities WHERE (LOWER(city_name) LIKE LOWER('{$temp}')) OR (LOWER(country_name) LIKE LOWER('{$temp}'));
EOF;


$ret3 = pg_query($db, $sql3);

while($row = pg_fetch_array($ret3))
	{
		$code = $row["city_code"];
		$code2 = $row["country_code"]; 
		$ccode = $code . "," . $code2;
	
	$city = $row["city_name"];
	$country = $row["country_name"];
	$data = $city . ", " . $country;
	$c = '-' . $ccode;
	//$data .= $c;
	echo "<option value='{$data}'>"; 
	
	echo "</option>";
	}




?>