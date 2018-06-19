<?php

function getHotels($destination,$checkindate,$checkoutdate)
{
	$destination = $_POST['hotelDestination'];
	$pieces = explode(",", $destination);
	$cityname = strtolower($pieces[0]); // piece1
	$countryname =  trim($pieces[1]); // piece2
	//echo $cityname;
	//echo $checkindate;
	$currency = 'USD';
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$cityname";
	$json_data = file_get_contents($url);
	$result = json_decode($json_data, TRUE);
	$latitude;
	$longitude;
	if($result['status']!='OK')
	{
		echo "<script>
			alert('There is error in Google Maps Api. Please try again later');
			location.replace('index.php');
			</script>
			";
	}
	else
	{
		$latitude = $result['results'][0]['geometry']['location']['lat'];
		$longitude = $result['results'][0]['geometry']['location']['lng'];
//echo $latitude;
//echo $longitude;


		
		$url2 = "http://api.sandbox.amadeus.com/v1.2/hotels/search-circle?latitude=$latitude&longitude=$longitude&radius=50&check_in=$checkindate&check_out=$checkoutdate&cy=$currency&number_of_results=40&apikey=An1SDC0J8MZG7ARuANdKcgG2KGtcxTvB";
		$json_data = file_get_contents($url2);
		$temp = json_decode($json_data, TRUE);
	
		$hotels =  $temp["results"];
		$totalhotel = count($hotels);
	
	//echo $totalhotel;
		$data =array();
	
	if($totalhotel==0)
	{
		echo "<script>
			alert('No hotel found. Please search again.');
			location.replace('index.php');
			</script>
			";
		
	}
	
	else{
		
		for($i =0;$i<$totalhotel;$i++)
		{	
			$details =array();
			$rating = rand(2,5);
		
			$name = $hotels[$i]["property_name"];
			$price = $hotels[$i]["min_daily_rate"]["amount"];
			$link = $hotels[$i]["_links"]["more_rooms_at_this_hotel"]["href"];
			array_push($details,$name);
			array_push($details,$rating);
			
			
			array_push($details,$price);
			array_push($details,$link);		
		
			array_push($data,$details);

	}
			
	}
	
}
	
	return $data;
	
}

?>