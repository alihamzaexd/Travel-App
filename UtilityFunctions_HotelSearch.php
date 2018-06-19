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
	
function getCountryCode($db,$cname)
{
	$sql3 =<<<EOF
		SELECT country_code FROM countries WHERE LOWER(country_name) = LOWER('{$cname}');
EOF;


$ret3 = pg_query($db, $sql3);

while($row = pg_fetch_array($ret3))
	{
		$code = $row["country_code"];
		
	}
	return $code;
}


function getCityCode($db,$cname)
{
	$sql3 =<<<EOF
		SELECT city_code FROM cities WHERE LOWER(city_name) = LOWER('{$cname}');
EOF;


$ret3 = pg_query($db, $sql3);

while($row = pg_fetch_array($ret3))
	{
		$code = $row["city_code"];
		
	}
	return $code;
}
?>