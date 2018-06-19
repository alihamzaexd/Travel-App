<?php

function createPolicyRequest($hid,$sid,$sectionid)
{
	
	$request = 'https://sandbox.24x7rooms.com/ws/index.php?action=hotel_cancellation_policy&username=exd_now_ws&password=ws@test&hotel_id=';
	
	if(!($hid==null))
	{
		$request .= $hid;
	}
	$request .= '&unique_id=';
	if(!($sid==null))
	{
		$request .= $sid;
	}
	$request .= '&section_unique_id=';
	if(!($sectionid==null))
	{
		$request .= $sectionid;
	}
	$request .= '&gzip=no';
	
	return $request;
}





?>