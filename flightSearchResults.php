<!DOCTYPE html>
<html lang="en">

<head>
<?php


session_start();
include 'header.php';
include 'showDataFlights.php';
include 'Functions.php';
include 'amadeus/Hotels.php';
include 'UtilityFunctions_FlightSearch.php';
$data =array();
$data1 =array();
$db = MakeConnection2();
$apikey = 'AXBysQZkf8RKM7rPtBjybFGkcjAbMwnw';

if(isset($_POST['flightSearch']))
{
	
	//destination+origin
$departure = $_POST['flyingFromCity'];
$dpieces = explode(",", $departure);
$departIATACode = $dpieces[1]; // piece1
$departIATACode = str_replace(' ', '', $departIATACode);



$arrival = $_POST['flyingToCity']; 
$apieces = explode(",", $arrival);
$arrivalIATACode = $apieces[1]; // piece1
$arrivalIATACode = str_replace(' ', '', $arrivalIATACode);
//dates
$departureDate = $_POST['departureDate'];
$returnDate = $_POST['returnDate'];

$currency = 'USD';

$adults = $_POST['adults'];
$children = $_POST['children'];


$_SESSION['airlineDepatureCityCode']=$departIATACode;

$_SESSION['airlineReturnCityCode']=$arrivalIATACode;


$_SESSION['airlineDepatureDate']= $departureDate;
$_SESSION['airlineReturnDate']= $returnDate;
$_SESSION['airlineCurrency']= $currency;
$_SESSION['airlineAdults']= $adults;
$_SESSION['airlineChild']= $children;
$_SESSION['airlineApiKey']= $apikey;


$request = 'https://api.sandbox.amadeus.com/v1.2/flights/low-fare-search';
$request .= '?origin=' . $departIATACode . '&destination=' . $arrivalIATACode . '&departure_date=' . $departureDate;

if(!($returnDate == null))
	{
		$request .= '&return_date=' . $returnDate;
	}
	
	if(!($adults == null))
	{
		$request .= '&adults=' . $adults;
	}
	
	if(!($children == null))
	{
		$request .= '&childern=' . $children;
	}
	
	$request .= '&nonstop=' . "false";
	$request .= '&max_price=' . "100000";
	$request .= '&number_of_results=' . "10";
	$request .= '&apikey=' . $apikey;
	
	//echo $request;
	
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$request);
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, 'SandBox Demo');
	$jsondata = curl_exec($curl_handle);
	//echo $jsondata;
	$temp = json_decode($jsondata,true);
	
	$data =array();
	
	if(isset($temp["status"]))
	{
		echo "<script>
				alert('No flight found. Please search again.');
				window.location = 'index.php';
				</script>
				";
	}
	else
	{
		foreach ($temp["results"] as $value)
		{
			//array_push($details,"inBound");
			$itineraries = $value["itineraries"];
			$total = count($itineraries);
			$type;
			for($k=0;$k<$total;$k++)
			// type selection
			{
				if (array_key_exists("outbound",$itineraries[$k])==true)
					{
						$flights = $value["itineraries"][$k]["outbound"]["flights"];
						$i = count($flights);
						$data1 =array();
						for($j=0;$j<$i;$j++)
							{
								$details =array();
								array_push($details,"outBound");
								//times
								$dtime = $flights[$j]["departs_at"];
								$atime = $flights[$j]["arrives_at"];
								array_push($details,$dtime,$atime);
								//origin info
								$airport = $flights[$j]["origin"]["airport"];
								array_push($details,$airport);
								
								//destination info
								
								$dairport = $flights[$j]["destination"]["airport"];
								array_push($details,$dairport);
								
								//flight number
								
								$flightnumber = $flights[$j]["flight_number"];
								array_push($details,$flightnumber);
								
								
								//Class
								$class = $flights[$j]["booking_info"]["travel_class"];
								array_push($details,$class);
								
								//seats Remaining
								
								$seats = $flights[$j]["booking_info"]["seats_remaining"];
								array_push($details,$seats);
								//fare
								
								$fare= $value["fare"]["total_price"];
								array_push($details,$fare);
								array_push($data1,$details);
								
							}
						array_push($data,$data1);
					}	
			}	
		}

		foreach ($temp["results"] as $value)
			{
				//array_push($details,"inBound");
				$itineraries = $value["itineraries"];
				$total = count($itineraries);
				$type;
				for($k=0;$k<$total;$k++)
				// type selection
				{
					if (array_key_exists("inbound",$itineraries[$k])==true)
						{
							$flights1 = $value["itineraries"][$k]["inbound"]["flights"];
							$i = count($flights1);
							$data2 =array();
							for($j=0;$j<$i;$j++)
								{
								
									$details =array();
									array_push($details,"inBound");
									//times
									$dtime = $flights1[$j]["departs_at"];
									$atime = $flights1[$j]["arrives_at"];
									array_push($details,$dtime,$atime);
									//origin info
									$airport = $flights1[$j]["origin"]["airport"];
									array_push($details,$airport);
									
									//destination info
									
									$dairport = $flights1[$j]["destination"]["airport"];
									array_push($details,$dairport);
									
									//flight number
									
									$flightnumber = $flights1[$j]["flight_number"];
									array_push($details,$flightnumber);
									
									
									//Class
									$class = $flights1[$j]["booking_info"]["travel_class"];
									array_push($details,$class);
									
									//seats Remaining
									
									$seats = $flights1[$j]["booking_info"]["seats_remaining"];
									array_push($details,$seats);
									
									//fare
									
									$fare= $value["fare"]["total_price"];
									array_push($details,$fare);
									array_push($data2,$details);
								
						
								}
							array_push($data,$data2);
						}
					
					
				}
				
				
			}	
	}
		//echo json_encode($data);

}

?>

</head>
  
<script>
$(function(){
	$('a[title]').tooltip();
});
</script>  


<!-- including navigation bar-->
<?php
    // including navbar file containing responsible top navigation bar. 
    include 'navbar.php';
?>
<script>
function myFunction(object) {
    var parentDiv = object.parentElement; // parent node of 'a' tag
	var children = parentDiv.children; // all children of the tag
    var i;
	
	if ( $(children[1]).css('display') == 'block' ){ // if elements are visible
		for (i = 1; i < children.length; i++) {
			children[i].style.display = 'none';  
		}
	}else{   									     // in case, when elements are not visible
		for (i = 1; i < children.length; i++) { 
			children[i].style.display = 'block';
		}
	}
}
</script>

<body style="background-image: url('asset/images/hotelSearchResults2.jpg');  
        background-size:  cover;                      
        background-repeat: no-repeat;
        background-position: center center;">

    <!-- Page Content -->
    <div class="container" style="padding:2%; margin:5%; background-color:rgba(0,0,0,0.60);">
	
	<h2 style="color:white; float:center">Results</h2>
	<div style="color:white;">
	<hr>
    </div>
	
	
	  <!-- use the div below to show your results fetched in loop-->
		
		<?php
		
		
		
			ShowFlights2($db,$data)
	
		/*
		if($total1!=0)
		{
			SearchData1($data1);
		}
		*/	
		?>

    </div>
    <!-- /.container -->

   
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
	  <br></br>
        <p class="m-0 text-center text-white">Copyright &copy; Travel Solution 2018</p>
      </div>
      <!-- /.container -->
	</footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>

<script>
