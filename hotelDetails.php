<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
set_time_limit (0);
    // including header file containing all style and JQuery files 

include 'header.php';
include 'roomdetails.php';
include 'Functions.php';
include 'UtilityFunctions_HotelDetail.php';
include 'UtilityFunctions_Policy.php';


if(isset($_POST['Detail']))
{
$hid = $_POST['hotelId'];
$sid = $_POST['searchId'];	
$rating = $_POST['rating'];	

$_SESSION['hotelSearchHotelID'] = $hid;
$_SESSION['hotelSearchUniqueID'] = $sid;
$_SESSION['rating'] = $rating;	
	
}

if(isset($_SESSION['hotelSearchHotelID']))
	{
		$hid = $_SESSION['hotelSearchHotelID'];
	}
if(isset($_SESSION['hotelSearchUniqueID']))
	{
		$sid = $_SESSION['hotelSearchUniqueID'];
	}


$request = createRequest($hid,$sid);
//echo $request;
$response = getResponce($request);


$temp =json_decode($response,true);
$name = $temp["HotelName"];
$des = $temp["Description"];
$address = $temp["HotelAddress"];
$hotelid =  $temp["HotelId"];

$amenities  = $temp["Amenities"];
$roomamenties = $amenities["RoomAmenities"];
//echo "     ";
$totalamenties = count($roomamenties);
$details1 =array();
for($k=0;$k<$totalamenties;$k++)
{
	
	$amenitiesname = $roomamenties[$k]["RoomAmenityName"];
	array_push($details1,$amenitiesname);//0
	
}

//print_r($details1);

$roomlist = $temp["SectionSelection"];
$total = count($roomlist);
//echo $hotelid;
$data =array();
for($i =0;$i<$total;$i++)
	{
		$details =array();
		$sectionid = $roomlist[$i]["SectionUniqueId"];
		
		
		$roomrate = $roomlist[$i]["RoomRates"];
		//print_r($roomrate);
		
		$rate = $roomlist[$i][ "DisplayRoomRate"];
		
		$totalstay = $_SESSION['totalstay'];
		
		$rate = round($rate/$totalstay);
		
		$type = $roomrate[0]["RoomType"];
		$classid = $roomrate[0]["ClassUniqueId"];
		
		
		
		
		
		
		//echo $classid;
		//echo "     next   ";
		$policyrequest = createPolicyRequest($hid,$sid,$sectionid);
		
		//echo $policyrequest;
		
		$policy = getResponce($policyrequest);
		//echo $policy;
		
		$policydetails  = json_decode($policy,true);
		
		$soldout = $policydetails["BookingAllowedInfo"]["SoldOut"];
		$cancellationHours = $policydetails["CancellationHours"];
		$days = round($cancellationHours/24); // valid cancellation days
		
		$date = date_create($_SESSION['hotelCheckInDate']);
		date_sub($date, date_interval_create_from_date_string(''.$days.'days'));
		$CancellationDate = "".date_format($date, 'd-M-Y')." ";

		array_push($details,$type);//0
		array_push($details,$rate);//1
		
		array_push($details,$hotelid);//2
		array_push($details,$sid);//3
		array_push($details,$sectionid);//4
		array_push($details,$classid);//5
		
		array_push($details,$soldout);//6
		array_push($details,$name);//7
		array_push($details,$details1);//8
		array_push($details,$CancellationDate);//9
		array_push($data,$details);
		
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


  <body>

    <!-- Page Content -->
    <div class="container" style="padding:2%; margin-top:2%;">

      <div class="row">
        <div class="col-sm-8">
		  <!-- hotel name in the heading below -->
          <h2 class="mt-4"> <?php echo $name  ?></h2>
		  <!-- hotel descriptions in the paragraphs below.-->
          <p> <?php echo $des  ?> </p>
          
          <p>
		    <!-- If need this button for any redirection-->
            <a class="btn btn-primary btn-lg" href="#">More Details &raquo;</a>
          </p>
        </div>
		<!-- hotel address or conteact details-->
        <div class="col-sm-4">
          <h2 class="mt-4">Contact Details</h2>
          <address>
            <strong>Address</strong>
            <br><?php echo $address  ?>
            
            <br>
          </address>
          <address>
            <i class="fa fa-phone" style="font-size:20px;"> :</i>
			(123) 456-7890
            <br>
             <i class="fa fa-envelope" style="font-size:20px;"> :</i>
            <a href="mailto:#">test@example.com</a>
          </address>
        </div>
		
      </div>
	  
      <!-- /.row -->
	  <br></br>
	  
	  <!-- use the div below to show your results fetched in loop-->
	  <?php
	  ShowRooms($data)
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
