<?php

// xml request
/*$xml_data = '<?xml version="1.0" encoding="UTF-8"?>
<Request>
	<Source>
		<RequestorID  Client="2324"  EMailAddress="XML.EXCELLENCED@MATCHLESSTOURS.COM" Password="PASS"/>
		<RequestorPreferences Language="en">
			<RequestMode>SYNCHRONOUS</RequestMode>
		</RequestorPreferences>
	</Source>
	<RequestDetails>
		<SearchCountryRequest>
			<CountryName><![CDATA[UNITED ARAB EMIRATES]]></CountryName>
		</SearchCountryRequest>
	</RequestDetails>
</Request>';

// xml request
$xml_city_Search = '<?xml version="1.0" encoding="UTF-8"?>
<Request>
	<Source>
		<RequestorID Client="2324" EMailAddress="XML.EXCELLENCED@MATCHLESSTOURS.COM" Password="PASS"/>
		<RequestorPreferences Language="en">
		<RequestMode>SYNCHRONOUS</RequestMode>
		</RequestorPreferences>
	</Source>
	<RequestDetails>
		<SearchCityRequest CountryCode="AE">
			<CityName><![CDATA[DUBAI]]></CityName>
		</SearchCityRequest>
	</RequestDetails>
</Request>';

*/
// country code = AE;
// city code = DUBW;

$xml_data = '<?xml version="1.0" encoding="UTF-8"?>
<Request>
	<Source>
		<RequestorID  Client="2324"  EMailAddress="XML.EXCELLENCED@MATCHLESSTOURS.COM" Password="PASS"/>
		<RequestorPreferences Language="en">
			<RequestMode>SYNCHRONOUS</RequestMode>
		</RequestorPreferences>
	</Source>
	<RequestDetails>
		<SearchItemRequest  ItemType="hotel">
			<ItemDestination  DestinationType="city"  DestinationCode="DXB"/>
			<ItemName>AL KHALEEJ</ItemName>
		</SearchItemRequest>
	</RequestDetails>
</Request>';
 
 // submission URL
$URL = 'https://interface.demo.gta-travel.com/wbsapi/RequestListenerServlet';

	// sending request using cURL
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	
	$hotelsArray = array();
	$hotelsCodesArray = array();
	// if response is recieved
	if($output){

		$xml=simplexml_load_string($output, 'SimpleXMLElement', LIBXML_NOCDATA) or die("Error: Cannot create object");
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		
		$xmlCodes =simplexml_load_string($output) or die("Error: Cannot create object");
		$jsonCodes = json_encode($xmlCodes);
		$arrayCodes = json_decode($jsonCodes,TRUE);
		
		$hotels = $array['ResponseDetails']['SearchItemResponse']['ItemDetails']['ItemDetail'];
		$hotelCodes =  $arrayCodes['ResponseDetails']['SearchItemResponse']['ItemDetails']['ItemDetail'];
		
		if(isset($hotels['City'])){  // means single hotel
			array_push($hotelsArray,$hotels['Item']);
			array_push($hotelsCodesArray,$hotelCodes['Item']['@attributes']['Code']);
		}else{
			foreach ($hotels as $value){
				array_push($hotelsArray,$value['Item']);
			}
			foreach ($hotelCodes as $value){
				array_push($hotelsCodesArray,$value['Item']['@attributes']['Code']);
			}
		}
		
		print_r($hotelsArray);
		echo "<br>";
		print_r($hotelsCodesArray);
	}else{
		echo "request failed";
	}	
	
	
	curl_close($ch);

?>
