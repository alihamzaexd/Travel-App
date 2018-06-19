<!DOCTYPE html>
<html lang="en">

<head>
<?php
    // including header file containing all style and JQuery files 
session_start();

// checking if user in not logged in
if(!isset($_SESSION['loggedInFlag'])){
	// setting his currect page link, where he will be redirected after login
	$_SESSION['redirectTo'] = "hoteldetails.php";
	echo "
			<script>
			alert('You need to login in order to make any booking.')
			location.replace('login.php');
			</script>
			";
}
else // allowing logged in user to see the page.
{

include 'roomdetails.php';
include 'Functions.php';
include 'UtilityFunctions_Policy.php';
include 'UtilityFunctions_Booking.php';
include 'header.php';

$booking= null;
if(isset($_POST['Reservation']))
{
	$hid = $_POST['hotelid'];
	$_SESSION['hotelid']= $hid;
	
	$sid = $_POST['searchid'];
	$_SESSION['searchid']= $sid;
	
	$sectionid = $_POST['sectionid'];
	$_SESSION['sectionid']= $sectionid;
	
	$classid = $_POST['classid'];	
	$_SESSION['classid']= $classid;
	
}


if(isset($_SESSION['hotelid']))
{
	$hid= $_SESSION['hotelid'] ;
}
if(isset($_SESSION['searchid']))
{
	$sid= $_SESSION['searchid'] ;
}
if(isset($_SESSION['sectionid']))
{
	$sectionid= $_SESSION['sectionid'] ;
}
if(isset($_SESSION['classid']))
{
	$classid= $_SESSION['classid'] ;
}

$policyrequest = createPolicyRequest($hid,$sid,$sectionid);
//echo $policyrequest;
$policy = getResponce($policyrequest);
//echo "  Response  ";
//echo $policy;
$policydetails  = json_decode($policy,true);
$rate = $policydetails["TotalBookingAmount"];

$_SESSION['charges']= $rate;

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
	
		<h2 style="color:white; float:center">Review and Book</h2>
		<div style="color:white;">
			<hr>
		</div>
		<div class="row" style="padding:2%; margin-top:2%;margin-left:30%;">
			<!-- Booking form below -->
			<div style=" background-color:rgba(255,255,255,0.60);" class="col-xs-9 col-md-6" >	
				<form class="form-signin" style="padding:10px;" action="bookedHotelDetails.php" method="post">
					<h2> Personal Details</h2>
					<hr>
					<label for="hotelBookingSalutation">Salutation</label><br>
					<select class="form-control" id="hotelBookingSalutation" name="hotelBookingSalutation" required>
						<option value="" selected disabled>Select</option>
						<?php if(isset($_SESSION['salutation'])){ ?>
						
						<option value="Mr" <?php if($_SESSION['salutation']=="Mr"){echo "selected";} ?> >Mr</option>
						<option value="Mrs" <?php if($_SESSION['salutation']=="Mrs"){echo "selected";} ?>>Mrs</option>
						<option value="Miss" <?php if($_SESSION['salutation']=="Miss"){echo "selected";} ?>>Miss</option>
						
						<?php }else{ ?>
						<option value="Mr" >Mr</option>
						<option value="Mrs" >Mrs</option>
						<option value="Miss">Miss</option>
						
						<?php }?>
					</select>
					<br>
					<label for="hotelBookingFirstName">First Name</label>
					<input type="text" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z]/, '')" id="hotelBookingFirstName" name="hotelBookingFirstName" 
						 value="<?php if(isset($_SESSION['customerFirstName'])){echo $_SESSION['customerFirstName'];} ?>" required>
					<br>
					
					<label for="hotelBookingLastName">Last Name</label>
					<input type="text" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z]/, '')" id="hotelBookingLastName" name="hotelBookingLastName"
					 value="<?php if(isset($_SESSION['customerLastName'])){echo $_SESSION['customerLastName'];} ?>" required>
					<br>
					
					<button class="btn btn-lg btn-primary" type="submit" value = "bookHotel" name="bookHotel">Book Now</button>
				  </form>
				  <!-- End of Booking form -->
				  <br>
			</div>
		</div>

	</div>
    <!-- /.container -->

   
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container" style="color:white;">
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

<?php
}
?>