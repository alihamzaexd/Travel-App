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
	if(isset($_GET['userId'])){
		// making class object
		$emailHanlderClass = new EmailHandler();
		
		$userId = $emailHanlderClass->encrypt_decrypt("decrypt", $_GET['userId']);
		//echo "user ID: ".$userId;
		//echo "<script>alert('user activated');</script>";
		
		$sql2 =<<<EOF
		UPDATE customer SET verified = 'yes' WHERE customer_id = '{$userId}';
EOF;
		$ret2 = pg_query($db, $sql2);
	

			if((!$ret2)) {
				echo pg_last_error($db);
			} 
			else 
		
			{
				$_SESSION['userSessionId'] = $userId;
				echo "
				<script>
				location.replace('getCustomerPersonalInfo.php');
				</script>
				";
			}
	}
	
if(isset($_POST['login']))
{
	

$email = $_POST['loginEmail'];
$pass = $_POST['loginPassword'];



$username = CheckUserName($email,$db);
$password = CheckPassword($email,$pass,$db);
$verified = CheckVerified($email,$db);
$type = type($email,$db);
$name = getname($email,$db);
if($username == false)
{
	echo "
			<script>
			alert('Email not found.');
			location.replace('login.php');
			</script>
			";
	
}
if($username == true and $password == false)
{
	
	echo "
			<script>
			alert('Password is incorrect.');
			location.replace('login.php');
			</script>
			";
	
	
}
if(($username == true) and ($password == true) and ($verified ==false))
{
	
	echo "
			<script>
			alert('Please check your email to verify your account.');
			location.replace('login.php');
			</script>
			";
	
}

if(($username == true) and ($password == true) and ($verified ==true))
{
	
	$_SESSION['userEmail'] = $email;
	$_SESSION['userType'] = $type;
	$_SESSION['loggedInFlag'] = "yes";
	
	// if user came to login from hotelBooking page; as user must login before proceeding to booking section
	if(isset($_SESSION['redirectTo'])){
		
		// redirect to user on the page where he left
		echo "
			<script>
			location.replace('";echo $_SESSION['redirectTo']; echo "');
			</script>
			";
	}
	echo "
			<script>
			location.replace('index.php');
			</script>
			";
	
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


<body> 
	
		<!-- test content-->
		<section class="bgimg">
        <div class="container">
            <div class="row">
			
                <div class="board" style="background-color:rgba(0,0,0,0.75); padding-left:10%;padding-top:5%;padding-right:10%;">
                    
					<form class="form-signin" style="padding:10px;" action="" method="post">
						<h2 >Sign in</h2>
						<hr>
						<label for="loginEmail">Email</label>
						<input type="email" class="form-control" id="loginEmail" name="loginEmail" 
							placeholder="e.g. John@gmail.com" required>
						<br>
						<label for="loginPassword">Password</label>
						<input type="password" class="form-control" id="loginPassword" name="loginPassword"
						required>
						<br>
						<div class="checkbox">
						  <label>
							<input type="checkbox" value="remember-me"> Remember me
						  </label>
						</div>
						<button class="btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
						<br></br>
						<p>Don't have an account?  <a href="signup.php" style="font-size:20px;">  Signup</a></p>
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

