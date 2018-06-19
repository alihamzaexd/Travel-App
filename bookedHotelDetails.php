<!DOCTYPE html>
<html lang="en">

<head>
<?php
    // including header file containing all style and JQuery files 

session_start();
include 'header.php';
include 'showData.php';
include 'Functions.php';
include 'LogInFunctions.php';
include 'hotelBookingRecord.php';
include 'UtilityFunctions_Booking.php';

$db= MakeConnection2();


$hid =$_SESSION['hotelid'];
$sid = $_SESSION['searchid'];
$sectionid = $_SESSION['sectionid'];
$classid = $_SESSION['classid'];
$charges = $_SESSION['charges'];
$rating = $_SESSION['rating'];
$totalstay = $_SESSION['totalstay'];
$email = $_SESSION['userEmail'];


if(isset($_POST['bookHotel']))
{
	$sal =  $_POST['hotelBookingSalutation'];
	$firstname =  strtolower($_POST['hotelBookingFirstName']);
	$lastname = strtolower($_POST['hotelBookingLastName']);

	$_SESSION['hotelBookingSalutation'] = trim($sal);
	$_SESSION['hotelBookingFirstName'] = trim($firstname);
	$_SESSION['hotelBookingLastName'] = trim($lastname);
}


if(isset($_SESSION['hotelBookingSalutation']))
	{
		$sal = $_SESSION['hotelBookingSalutation'];
	}
if(isset($_SESSION['hotelBookingFirstName']))
	{
		$firstname = $_SESSION['hotelBookingFirstName'];
	}
if(isset($_SESSION['hotelBookingLastName']))
	{
		$lastname = $_SESSION['hotelBookingLastName'];
	}


$persondata =$_SESSION['hotelPersonsData'];
$count = count($persondata);
$numberofchilds = 0;
for($i=0;$i<$count;$i++)
{
	$roomsdata = $persondata[$i]; 
	$numberofchilds = $numberofchilds + $roomsdata[1] ;
}
//echo $numberofchilds;
$request = createRequest($sid, $hid,$sectionid,$numberofchilds,$classid,$sal,$firstname,$lastname,$charges);
//echo $request;

$response = getResponce($request);
//echo $response;
	$bookingdetails  = json_decode($response,true);
	$message = $bookingdetails["Message"];
	//echo $response;
	$details =array();
	$data =array();
	if($message=='Success')
	{
		$details = $bookingdetails["BookingDetail"];
		
		$referncenumber = $details["Id"]; //0
		$fname = $details["LeaderFirstName"];
		$lname = $details["LeaderLastName"];
		$bookedby = $fname . " " . $lname; 
		$from = $details["CheckInDate"];
		$to = $details["CheckOutDate"]; 
		$contactnumber = $details["HotelPhone"];
		
		
		$room = $details["RoomDetail"];
		$type = $room[0]["RoomTypeDescription"];
		$numberofrooms = $room[0]["NumberOfRoom"]; 
		
		
		$hotelname = $details["HotelName"];
		$address = $details["HotelAddress1"];
		$city = $details["CityId"];
		$country = $details["CountryName"];
		
		$hoteldetail = $address . ",". $city ."," . $country . '( ' . $contactnumber . ' )'; 
		
		
		$grossrate = $details["GrossAmount"]; 
		$rate = round($grossrate/$totalstay);
		
		$status = $details["CurrentStatus"];
		
		//get customer if
		$ctype = type($email,$db);


			if($ctype == 'customer')
			{
			$id = getCustomerId($email,$db);	
			}
			if($ctype == 'agent')
			{
			$id = getAgentId($email,$db);	
			}
			if($ctype == 'corporate')
			{
			$id = getCorporateId($email,$db);	
			}
		
		$record = insertRecord($db,$id,'24X7Rooms',$hotelname,$type,$referncenumber,$from,$to,$status,$grossrate,$fname,$lname,$numberofrooms,$ctype);
		
		array_push($details,$referncenumber);//0
		array_push($details,$bookedby);//1
		array_push($details,$from);//2
		array_push($details,$to);//3
		array_push($details,$type);//4
		array_push($details,$hotelname);//5
		array_push($details,$hoteldetail);//6
		array_push($details,$grossrate);//7
		array_push($details,$status);//8
		array_push($details,$rating);//9
		array_push($details,$rate);//10
		array_push($details,$numberofrooms); //11
		array_push($data,$details);
	}
	else
	{
		echo "<script>
				alert('There is a problem. Please search again.');
			</script>
			";
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
    <div class="container" style="padding:2%; margin-top:2%; background-color:rgba(0,0,0,0.60);">
		<h2 style="color:white;">Booking Details</h2>
		<div style="color:white;">
			<hr>
		</div>
		
		<?php
		ShowBooking($data);
		?>
		
		<p style="color:white; margin-left:2%;"> Want another Booking? <a href="index.php">Click here</a></p> 

	</div>
    <!-- /.container -->

   
   

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  
   
</html>
<!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container" style="color:black;">
	  <br></br>
        <p class="m-0 text-center text-white">Copyright &copy; Travel Solution 2018</p>
      </div>
      <!-- /.container -->
	</footer>
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
