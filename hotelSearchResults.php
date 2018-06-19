<!DOCTYPE html>
<html lang="en">

<head>
<?php
    // including header file containing all style and JQuery files 
session_start();
include 'header.php';
include 'showData.php';
include 'Functions.php';
include 'amadeus/Hotels.php';
include 'UtilityFunctions_HotelSearch.php';
$data =array();
$data1 =array();
$db = MakeConnection2();


if(isset($_POST['hotelSearch']))
{
$destination = $_POST['hotelDestination'];


$pieces = explode(",", $destination);
$cityname = $pieces[0]; // piece1
$countryname =  trim($pieces[1]); // piece2

$country = getCountryCode($db,$countryname);
$city = getCityCode($db,$cityname);


$nationality = '97';
//$nationality = '125';

$checkindate = $_POST['hotelCheckInDate'];
$checkoutdate = $_POST['hotelCheckOutDate'];
$currency = 'USD';

// session maintaince 
$_SESSION['hotelCityCode']=$city;
$_SESSION['hotelCountryCode']=$country;
$_SESSION['hotelNationality']= $nationality;
$_SESSION['hotelCheckInDate']= $checkindate;
$_SESSION['hotelCheckOutDate']= $checkoutdate;
$_SESSION['currency']= $currency;

//$data1 = getHotels($destination,$checkindate,$checkoutdate);
$roomspersondata = array();
$childagedata = array();
//rooms related
$rooms = $_POST['hotelRooms'];
$_SESSION['hotelRooms']= $rooms;

for($i=1;$i<=$rooms;$i++)
{
	$persons= array();
	$age =array();
	$adults = $_POST['room'.$i.'Adults'];
	//echo "Adults = " . $adults;
	$childs = $_POST['room'.$i.'Children'];
	//echo "Childs = " . $childs;
	array_push($persons,$adults);
	array_push($persons,$childs);
	for($j=1;$j<=$childs;$j++)
	{
		$childage = $_POST['room' .$i. 'Child' . $j];
		array_push($age,$childage);
		//echo "Child Age = " . $childage;
	}
	array_push($childagedata,$age);
	array_push($roomspersondata,$persons);
	
	//print_r($childagedata);
	//print_r($roomspersondata);
}
	//echo json_encode($childagedata);
	//echo "rooms data";
	//echo json_encode($roomspersondata);

//$adults = $_POST['hotelAdults'];

$_SESSION['hotelPersonsData']= $roomspersondata;
$_SESSION['childAgeData']= $childagedata;

//print_r($data1);
}


$request = 'https://sandbox.24x7rooms.com/ws/index.php?action=hotel_search&username=exd_now_ws&password=ws@test';
	//$request .= '?origin=' . $origin . '&destination=' . $destination . '&departure_date=' . $ddate;
	if(isset($_SESSION['hotelCheckInDate']))
	{
		
		$checkindate=$_SESSION['hotelCheckInDate'];
		$newDate = date("d-m-Y", strtotime($checkindate));
		$checkindate = str_replace('-', '/', $newDate);
		$request .= '&checkin_date=' . $checkindate;
	}
	
	if(isset($_SESSION['hotelCheckOutDate']))
	{
		$checkoutdate = $_SESSION['hotelCheckOutDate'];
		$newDate = date("d-m-Y", strtotime($checkoutdate));
		$checkoutdate = str_replace('-', '/', $newDate);
		$request .= '&checkout_date=' . $checkoutdate;
	}
	
	if(isset($_SESSION['hotelCountryCode']))
	{
		$country = $_SESSION['hotelCountryCode'];
		$request .= '&sel_country=' . $country;
	}
	if(isset($_SESSION['hotelCityCode']))
	{
		$city = $_SESSION['hotelCityCode'];
		$request .= '&sel_city=' . $city;
	}
	
	$request .= '&chk_ratings=1.0,2.0,3.0,4.0,5.0';
	
	
	if(isset($_SESSION['hotelNationality']))
	{
		$nationality = $_SESSION['hotelNationality'];
		$request .= '&sel_nationality=' . $nationality;
		$request .= '&country_of_residence=' . $nationality;
	}
	
	if(isset($_SESSION['currency']))
	{
		$currency = $_SESSION['currency'];
		$request .= '&sel_currency=' . $currency;
	}
	$request .= '&availableonly=1&number_of_rooms=';
	
	if(isset($_SESSION['hotelRooms']))
	{
	$rooms = $_SESSION['hotelRooms'];	
	$request .= $rooms;
	}
	
	//making request for roomdetails in main request format
	$details = null;
	if(isset($_SESSION['hotelPersonsData']))
	{
	
		for($i=0;$i<$rooms;$i++)
			{
				$persons = $roomspersondata[$i];
				$onedetail = '{"numberOfAdults":' . $persons[0];
				if($persons[1]==0)
					{
						$onedetail = $onedetail . '}';
					}
				else
					{
						$onedetail =$onedetail . ',';
						$onedetail =$onedetail . '"numberOfChild":' . $persons[1] . ',' ;	
						
						$arrayofages = $childagedata[$i];
						$stringofages = join(',', $arrayofages);
				
						$onedetail =   $onedetail . '"ChildAge":"' . $stringofages . '"}';
					}
					
				if($i==0)
					{
						$details = $onedetail;
					}
				else							
					{
						$details = $details . ',' . $onedetail;
					}		
		
			}
		$request .= '&roomDetails=[' . $details . ']';
	}
	
	$request.= '&sel_hotel=&gzip=no&timeout=120&static_data=0&limit_hotel_room_type=';
	
	$apiresponse = getResponce($request);
	$temp = json_decode($apiresponse,true);
	$data =array();
	json_encode($temp);
	
	$message = $temp["Message"];
	if($message == "fail")
	{
		echo "<script>
			alert('There is a problem. Please search again.');
			</script>
			";
	}
	else
	{
		$searchid = $temp["SearchUniqueId"]; // uniques search ID, used in hotel details request
		$hotels = $temp["HotelList"];
		$total = count($hotels);
		
		if($total==0)
		{
			echo "<script>
				alert('No hotel found. Please search again.');
				window.location = 'index.php';
				</script>
				";
		}
		else
		{
			for($i =0;$i<$total;$i++)
			{
				$details =array();
					
				$hotelid =  $hotels[$i]["HotelId"];
				$name = $hotels[$i]["HotelName"];
				$rating = $hotels[$i]["PropertyRating"];
				
				$property = $hotels[$i]["HotelProperty"];
				$propertycount = count($property);
				$avgrate =0;
				for($j=0;$j<$propertycount;$j++)
				{
					$avgrate = $avgrate + $property[$j]["RoomRates"][0]["RateBreakup"][0]["DisplayNightlyRate"];
				}
					
				$avgrate = $avgrate/$propertycount;
				$avgrate = round($avgrate);
				array_push($details,$name);
				array_push($details,$rating);
				array_push($details,$avgrate);
				array_push($details,$hotelid);
				array_push($details,$searchid);
				
				array_push($data,$details);
				
				$stay = $property[0]["RoomRates"][0]["RateBreakup"];
				$totalstay = count($stay);
				$_SESSION['totalstay']=$totalstay;		
				//echo $name;
			}
		}
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
		
		if($total!=0)
		{
			SearchData($data);
		}
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
// functions to load search forms based on user selection
function loadHotelsSearchForm(){
	var content = document.getElementById("hotelSearchContent").innerHTML;
	document.getElementById("tab-contents").innerHTML = content;
}

function loadFlightsSearchForm(){
	var content = document.getElementById("flightSearchContent").innerHTML;
	document.getElementById("tab-contents").innerHTML = content;
}
</script>  
<script>
function RDate() {
    var RDate = document.getElementById("hotelCheckOutDate").value;
	var DDate = document.getElementById("hotelCheckInDate").value;
    

    if ((new Date(RDate).getTime() > new Date(DDate).getTime())) {
          return true;
     }
	 
	 if ((new Date(RDate).getTime() <= new Date(DDate).getTime())) {
          alert("The checkout date must be after checkin date");
		  document.getElementById("hotelCheckOutDate").value = "";
          return false;
     }
	 if(DDate == "")
	 {
		 alert("Please select checkin date first.");
		 document.getElementById("hotelCheckOutDate").value = "";
         return false;
		 
	 }
	 else
	 {
		  return true;
	 }	
}

function Disabledate()
{
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
		dd = '0'+dd
	} 
	if(mm<10) {
		mm = '0'+mm
	} 
	today = yyyy + '-' + mm + '-' + dd ;
	document.getElementById("hotelCheckInDate").setAttribute("min", today);
	
}

function Disabledate1()
{
	var checkedin = document.getElementById("hotelCheckInDate").value;
	var today = new Date(checkedin);
	
var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	dd=dd+1;
	if(dd<10) {
		dd = '0'+dd
	} 

	if(mm<10) {
		mm = '0'+mm
	} 
	today = yyyy + '-' + mm + '-' + dd ;
	document.getElementById("hotelCheckOutDate").setAttribute("min", today);
}


</script>
