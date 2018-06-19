<?php

function createRequest($sid, $hid,$sectionid,$childs,$roomclassid,$salutation,$firstname,$lastname,$price)
{
	//echo $childs;
	$request = 'https://sandbox.24x7rooms.com/ws/index.php?action=hotel_reservation&username=exd_now_ws&password=ws@test';
	
	if(!($sid == null))
	{
		$request .= '&unique_id=' . $sid;
	}	
	if(!($hid == null))
	{				
		$request .= '&hotel_id=' . $hid . '&';
	}
	if(!($sectionid == null))
	{				
		$request .=  'section_unique_id=' . $sectionid ;
	}
		$n = rand(10000,100000);				
		$request .= '&agent_ref_no=' . $n ;
		$request .= '&roomDetails=[{"numberOfChilds":"';
	if(!($childs == null))
	{				
		$request .=  $childs ;
	}
	
	if(!($roomclassid == null))
	{				
		$request .= '","roomClassId":"' . $roomclassid ;
	}
	if(!($salutation == null))
	{				
		$request .= '","passangers":[{"salutation":"' . $salutation ;
	}
	
	$request .= '","first_name":"';
	if(!($firstname == null))
	{				
		$request .= $firstname ;
	}
	$request .= '","last_name":"';
	if(!($lastname == null))
	{				
		$request .= $lastname ;
	}
	
	//if(!($price == null))
	//{				
		$request .= '"}]}]&expected_price=' . $price . '&gzip=no' ;
	//}
	
	return $request;
	
}


function getResponce($requesturl)
	{
		$request = $requesturl;
		
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,$request);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT,0);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Hotel Search Demo');
		$jsondata = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		return $jsondata;
		
	}

?>