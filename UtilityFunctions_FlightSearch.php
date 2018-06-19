<?php
function getResponce($requesturl)
	{
		$url = $requesturl;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');
		curl_setopt($ch, CURLOPT_URL, $url);// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Get the response and close the channel.
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	

function getCityIATACode($db,$cname)
{
	$sql3 =<<<EOF
		SELECT iata_code FROM airports WHERE LOWER(city) = LOWER('{$cname}');
EOF;


$ret3 = pg_query($db, $sql3);

while($row = pg_fetch_array($ret3))
	{
		$code = $row["iata_code"];
		
	}
	return $code;
}


function getCity($db,$iata)
{
	$sql3 =<<<EOF
		SELECT city FROM airports WHERE LOWER(iata_code) = LOWER('{$iata}');
EOF;


$ret3 = pg_query($db, $sql3);


$city;
if(pg_num_rows($ret3)==0)
{
	return $iata;
	
}

else
{
	while($row = pg_fetch_array($ret3))
	{
		$city = $row["city"];
		
	}
	return $city;
	
}




}


?>