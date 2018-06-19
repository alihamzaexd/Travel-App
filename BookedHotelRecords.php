<!DOCTYPE html>
<html lang="en">

<head>
<?php
    // including header file containing all style and JQuery files 

session_start();
include 'header.php';
include 'Functions.php';
include 'LogInFunctions.php';
include 'hotelBookingRecord.php';


$db= MakeConnection2();



$email = $_SESSION['userEmail'];
$type = type($email,$db);


if($type == 'customer')
{
$id = getCustomerId($email,$db);	
}
if($type == 'agent')
{
$id = getAgentId($email,$db);	
}
if($type == 'corporate')
{
$id = getCorporateId($email,$db);	
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
		<h2 style="color:white;">Booking Records</h2>
		<div style="color:white;">
			<hr>
		</div>
		
		<?php
		ShowBookingRecords($db,$id,$type);
		?>
		

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
