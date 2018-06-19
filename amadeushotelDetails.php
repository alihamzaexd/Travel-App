<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
    // including header file containing all style and JQuery files 

include 'header.php';
include 'roomdetails.php';
include 'Functions.php';
include 'UtilityFunctions_HotelDetail.php';
include 'UtilityFunctions_Policy.php';





if(isset($_POST['Detail']))
{
$link = $_POST['link'];

	
}




$json_data = file_get_contents($link);
//echo $json_data;
$temp = json_decode($json_data, TRUE);
$name = $temp["property_name"];

$line = $temp["address"]["line1"];
$city = $temp["address"]["city"];
$country = $temp["address"]["country"];
$address =  $line . ' ' . $city . ' ' . $country;

$phone =  $temp["contacts"][0]["detail"];


$amenities = $temp["amenities"];
$totalamenties = count($amenities);
$details1 =array();
for($i =0;$i<$totalamenties;$i++)
		{	
			$amenitiesname = $amenities[$i]["description"];
			array_push($details1,$amenitiesname);
			
		}

$rooms = $temp["rooms"];
$totalrooms = count($rooms);
$data =array();		


for($i =0;$i<$totalrooms;$i++)
{
	$details =array();
	$rates = $rooms[$i]["rates"][0]["price"];
	
	$roomdes = $rooms[$i]["descriptions"];
	
	$type = $rooms[$i]["room_type_info"]["room_type"];
	$bed = $rooms[$i]["room_type_info"]["bed_type"];
	$numberofbed =$rooms[$i]["room_type_info"]["number_of_beds"];
	
	$roomtype = $numberofbed . ' ' . $bed . ' bed ' . $type . ' room.' ; 
	
	
	
	array_push($details,$rates);
	array_push($details,$roomdes);
	array_push($details,$roomtype);
	array_push($data,$details);
	
	//print_r($roomdes);
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
		  <h3 class="mt-4" > Hotel Amenities </h3>
		  <!-- hotel descriptions in the paragraphs below.-->
           <?php echo ShowAmenities1($details1)  ?>
          
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
		<?php echo $phone  ?>
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
	  ShowRooms1($data)
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
