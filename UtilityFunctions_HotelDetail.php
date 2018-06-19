<?php

set_time_limit (0);
function createRequest($hid,$sid)
{
	$request = 'https://sandbox.24x7rooms.com/ws/index.php?action=hotel_detail&username=exd_now_ws&password=ws@test&hotel_id=';
	
	if(!($hid==null))
	{
		$request .= $hid;
	}
	$request .= '&unique_id=';
	if(!($sid==null))
	{
		$request .= $sid;
	}
	$request .= '&gzip=no';
	
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