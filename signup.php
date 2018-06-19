<!DOCTYPE html>
<html lang="en">

<head>
<?php

session_start();
    // including header file containing all style and JQuery files 
include 'header.php';
include 'Functions.php';
include 'emailHandler.php';
$db= MakeConnection2();

if(isset($_POST['signup']))
{


$fname = $_POST['signupFirstName'];
$lname = $_POST['signupLastName'];
$email = $_POST['signupEmail'];
$pass = $_POST['signupPassword'];
$type = $_POST['signupJoinAs'];

$emailHanlderClass = new EmailHandler();

//echo $fname;
//echo $lname;
//echo $email;

	$sql1 =<<<EOF
		SELECT * FROM customer WHERE customer_email ='{$email}';
EOF;
	
$retuser1 = pg_query($db, $sql1);
$Emailrow = pg_fetch_row($retuser1);

	if($Emailrow){
		echo "
				<script>
				alert('You Registered Already');
				location.replace('signup.php');
				</script>
				";
	}
	else
	{	
		$sql2 =<<<EOF
		INSERT INTO customer(customer_fname,customer_lname,customer_email, customer_password,customer_type) VALUES 
	('{$fname}','{$lname}', '{$email}','{$pass}' , '{$type}');
EOF;
		$ret2 = pg_query($db, $sql2);
			
	

			if((!$ret2)) {
				echo pg_last_error($db);
			} 
			else 
			{
			$_SESSION['customerFirstName'] = $fname;
			$_SESSION['customerLastName'] = $lname;
			
			$sql1 =<<<EOF
				SELECT customer_id FROM customer WHERE customer_email ='{$email}';
EOF;
			$ret3 = pg_query($db, $sql1);
			$customer = pg_fetch_assoc($ret3);
			$id = $customer['customer_id'];
			if((!$ret3)) {
				echo pg_last_error($db);
			} 
			else 
			{
				
				//agent customer id
				if($type == 'agent')
				{
					$sql2 =<<<EOF
		INSERT INTO agent(customer_id) VALUES ('{$id}');
EOF;
	
					$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{
							//echo "You SignUp successfully. Please check your email for verification";
							$emailHanlderClass->email($email,$fname,$id);
							
							echo "
							<script>
							alert('Signup Successful! Activate your account using activation link sent to you via Email.');
							location.replace('login.php');
							</script>
							";
						}
			
				}
				
				//coprate customer id
				if($type == 'corporate')
				{
					$sql2 =<<<EOF
		INSERT INTO corporate(customer_id) VALUES ('{$id}');
EOF;
	
					$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{
							//echo "You SignUp successfully. Please check your email for verification";
							$emailHanlderClass->email($email,$fname,$id);
							echo "
							<script>
							alert('You signup successfully. Please verified your account by opening activation link in your email');
							location.replace('login.php');
							</script>
							";
						}
					
				}
				//customer id
				if($type == 'customer')
				{
					//echo "You SignUp successfully. Please check your email for verification";
					$emailHanlderClass->email($email,$fname,$id);
					echo "
							<script>
							alert('You signup successfully. Please verified your account by opening activation link in your email');
							location.replace('login.php');
							</script>
							";
					
				}
				
				//to insert address table
				$sql2 =<<<EOF
		INSERT INTO address(customer_id) VALUES ('{$id}');
EOF;
	
					$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{

							
						}
						
						
						//customer details
						
						$sql2 =<<<EOF
		INSERT INTO customer_details(customer_id) VALUES ('{$id}');
EOF;
	
					$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{

							
						}
				
			}
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


<body> 
	
		<!-- test content-->
		<section class="bgimg">
        <div class="container">
            <div class="row">
			
                <div class="board" style="background-color:rgba(0,0,0,0.75); padding-left:10%;padding-top:5%;padding-right:10%;">
                    
					<form class="form-signin" style="padding:10px;" action="signup.php" method="post">
						<h2 >Signup</h2>
						<hr>
						<div class="form-group">
							<div class="col-md-6">
								<label for="signupFirstName">First Name</label>
								<input type="text" class="form-control" id="signupFirstName" name="signupFirstName" 
						 placeholder="John" required>
							</div>
							<div class="col-md-6">
								<label for="signupLastName">Last Name</label>
								<input type="text" class="form-control" id="signupLastName" name="signupLastName" 
						 placeholder="Doe" required>
							</div>
							<br><br/>
						</div>
						
						<br>
						<div class="col-md-12">
							<label for="signupEmail">Email</label>
							<input type="email" class="form-control" id="signupEmail" name="signupEmail" 
								placeholder="e.g. John@gmail.com" required>
							<br>
							<label for="signupPassword">Password</label>
							<input type="password" class="form-control" id="signupPassword" name="signupPassword"
							required>
							<br>
							<label for="signupConfirmPassword">Confirm Password</label>
							<input type="password" class="form-control" id="signupConfirmPassword" name="signupConfirmPassword"
							required>
							<br>
							<label for="signupJoinAs">Join As</label><br>
							 <select class="form-control" id="signupJoinAs" name="signupJoinAs" required>
							 <option value="" selected disabled>Select</option>
								<option value="customer">Individual Customer</option>
								<option value="agent">Agency/Agent</option>
								<option value="corporate">Company</option>
							  </select>
							  <br>
							<div class="checkbox">
							  <label>
								<input type="checkbox" value="remember-me"> Remember me
							  </label>
							</div>
							<button class="btn btn-lg btn-primary" type="submit" name="signup" >Signup</button>
						</div>
						<div style="padding-left:2%;">
						<p>Already have an account?  <a href="login.php" style="font-size:20px;">  Sign in</a></p>
						</div>
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

var password = document.getElementById("signupPassword")
  , confirm_password = document.getElementById("signupConfirmPassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


</script>

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

