<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
include 'Functions.php';
include 'LogInFunctions.php';
include 'emailHandler.php';
$db= MakeConnection2();

// including header file containing all style and JQuery files 
include 'header.php';
	
if(isset($_POST['insertPersonalInfo']))
{
	$salutation = $_POST['salutation'];
	$gender = $_POST['gender'];
	$mobile = $_POST['mobile'];
	$_SESSION['salutation'] = $salutation;
	SetPersonalInfo($salutation,$gender,$mobile,$db);
	
	
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
	
		<!-- test content-->
		<section class="bgimg">
        <div class="container">
            <div class="row">
			
                <div class="board" style="background-color:rgba(0,0,0,0.75); padding-left:10%;padding-top:5%;padding-right:10%;">
                    
					<form class="form-signin" style="padding:10px;" action="" method="post">
						<h2 >Edit Peronal Details</h2>
						<hr>
						<label for="salutation">Salutation</label><br>
						<select class="form-control" id="salutation" name="salutation" required>
							<option value="" selected disabled>Select</option>
							<option value="Mr">Mr</option>
							<option value="Mrs">Mrs</option>
							<option value="Miss">Miss</option>
						</select>
						<br>
						<label for="gender">Gender</label>
						<select class="form-control" id="gender" name="gender" required>
							<option value="" selected disabled>Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="Other">Other</option>
						</select>
						<br>
						<label for="mobile">Mobile Number</label>
						<input type="number" class="form-control"  id="mobile" name="mobile" 
							 required>
						<br>
						<button class="btn btn-lg btn-primary" type="submit" name="insertPersonalInfo">Save</button>
						<br></br>
						<p><a href="index.php" style="font-size:20px;">Skip</a></p>
					  </form>
					  
				</div>
				<br></br><br></br><br></br>
				
			</div>
		</div>
		</section>


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
function loadHotelsSearchForm(){
	var content = document.getElementById("hotelSearchContent").innerHTML;
	document.getElementById("tab-contents").innerHTML = content;
}

function loadFlightsSearchForm(){
	var content = document.getElementById("flightSearchContent").innerHTML;
	document.getElementById("tab-contents").innerHTML = content;
}
</script>  

