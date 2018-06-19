<?php
include 'Functions.php';
$db = MakeConnection2();

$country = $_POST['hotelDestination'];
$temp = $country . "%";
//$temp = "lon"."%";
$sql3 =<<<EOF
		SELECT city,country,iata_code,name FROM airports WHERE 
		(LOWER(city) LIKE LOWER('{$temp}')) 
		OR 
		(LOWER(country) LIKE LOWER('{$temp}'))
		OR
		(LOWER(name) LIKE LOWER('{$temp}')) ;
EOF;


$ret3 = pg_query($db, $sql3);

while($row = pg_fetch_array($ret3))
	{
		if(($row["iata_code"]== "N/A") or (strcmp($row["iata_code"],"N/A")== 0 ) or ($row["name"]== "N/A") or (strcmp($row["name"],"N/A")== 0 ) )
		{
			
		}
		else
		{
			$city = $row["city"];
			$country = $row["country"];
			$iata = $row["iata_code"];
			$airport = $row["name"];
		
	
	
		$data = $airport . ", " . $iata . ", " . $city . ", " . $country ;

	
		echo "<option value='{$data}'>"; 
	
		echo "</option>";
			
		}
		
	}




?>