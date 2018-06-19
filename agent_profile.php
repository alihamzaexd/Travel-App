<!DOCTYPE html>
<html lang="en">

<head>
<?php

    // including header file containing all style and JQuery files 
session_start();
include 'header.php';
include 'navbar.php';
include 'LogInFunctions.php';
include 'Functions.php';
include 'Profiling/Agent/AgentProfile.php';

$db = MakeConnection2();
$email = $_SESSION['userEmail'];
$name = getname($email,$db);
$type = type($email,$db);
$id = getCustomerId($email,$db);
ShowPersonalDetails($db,$id);
ShowAgentInfo($db,$id);

if(isset($_POST['updateCustomerPersonalInfo']))
{

$fname = $_POST['editCustomerFirstName'];
$lname = $_POST['editCustomerLastName'];
$cnic = $_POST['editCustomerCnic'];
$dob = $_POST['editCustomerDob'];
$gender = $_POST['editCustomerGender'];
$phone = $_POST['editCustomerPhone'];
$cell  = $_POST['editCustomerMobile'];
$countrycode = $_POST['editCustomerCountryCode'];

updateCustomerDetails($db,$id,$fname,$lname,$cnic,$dob,$gender,$phone,$cell,$countrycode);

$city = $_POST['editCustomerCity'];
$country = $_POST['editCustomerCountry'];
$addressline = $_POST['editCustomerAddress'];

updateAddress($db,$id,$city,$country,$addressline);
ShowPersonalDetails($db,$id);
	
}

if(isset($_POST['updateCustomerPassword']))
{
	$pass = $_POST['customerPassword'];
	$cpass = $_POST['confirmCustomerPassword'];
	$check = strcmp($pass,$cpass);
	if($check==0)
	{
		updatePassword($db,$id,$pass);
	echo "
			<script>
			alert('Password is updated');
		
			</script>
			";
		
	}
	else{
		echo "
			<script>
			alert('Your password does not match');
		
			</script>
			";
	}
	
}



if(isset($_POST['updateAgencyInfo']))
{
	$ntnNumber = $_POST['ntnNumber'];
	$creditLimit = $_POST['creditLimit'];
	$availableCredit = $_POST['availableCredit'];
	
	updateAgentInfo($db,$id,$ntnNumber,$creditLimit,$availableCredit);
	ShowAgentInfo($db,$id);
}

//print_r($row);





?>

<!-- including navigation bar-->





</head> 

<style>
/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: auto;
}
</style>

<script>

</script>

<body style="background: #F1F3FA;"> 
	<div class="container" >
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="asset/images/user.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $name  ?>
					</div>
					<div class="profile-usertitle-job">
						<?php echo $type  ?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<hr>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#" onclick="loadCustomerPersonalDetails()">
							<i class="glyphicon glyphicon-user"></i>
							Personal Details </a>
						</li>
						<li>
							<a href="#" onclick="loadCustomerTravelDetails()">
							<i class="glyphicon glyphicon-plane"></i>
							Agency Info </a>
						</li>
						<li>
							<a href="#" onclick="loadCustomerSecurity()">
							<i class="glyphicon glyphicon-wrench"></i>
							Security </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
			<hr>
		</div>
		
		<div class="col-md-9">
            <div class="profile-content" id="profileContent">
				<div class="row">
					<div class="col-md-12" align="center">
						<h3 style="color:#5b9bd1;"> Personal Details </h3>
					<hr>
					</div>
					<div class="col-md-6" style="float:left;">
						<h4> First Name</h4>
						<p style="margin-left:30%"> 
							<?php
							if($_SESSION['customer_fname']==null)
							{
								echo '----';
							}
							else
								echo $_SESSION['customer_fname'];
							?>
						</p>
						<h4> Last Name</h4>
						<p style="margin-left:30%"> 
							<?php
							if($_SESSION['customer_lname']==null)
							{
								echo '----';
							}
							else
								echo $_SESSION['customer_lname'];
							?>
						</p>
						<h4> Email</h4>
						<p style="margin-left:30%">
							<?php
							if($_SESSION['customer_email']==null)
							{
								echo '----';
							}
							else
								echo $_SESSION['customer_email'];
							?>
						</p>
					</div>
					<div class="col-md-6" style="float:left;">
						<h4> CNIC</h4>
						<p style="margin-left:30%">
							<?php
							if($_SESSION['customer_cnic']==null)
							{
								echo '----';
							}
							else
								echo $_SESSION['customer_cnic'];
							?>
						</p>
						<h4> Date of Birth</h4>
						<p style="margin-left:30%"> 
							<?php
							if($_SESSION['customer_dob']==null)
							{
								echo '----';
							}
							else
								echo $_SESSION['customer_dob'];
							?>
						</p>
						<h4> Gender</h4>
						<p style="margin-left:30%">
							<?php
							if($_SESSION['customer_gender']==null)
							{
								echo '----';
							}
							else
								echo $_SESSION['customer_gender'];
							?>
						</p>
					</div>
					<div class="col-md-12" style="float:left;">
					<hr>
						<div class="col-md-6" style="float:left;">
							<h4> Phone</h4>
							<p style="margin-left:30%"> 
								<?php
								if($_SESSION['customer_phone']==null)
								{
									echo '----';
								}
								else
									echo $_SESSION['customer_phone'];
								?>
							</p>
							<h4> Mobile</h4>
							<p style="margin-left:30%"> 
								<?php
								if($_SESSION['customer_cell']==null)
								{
									echo '----';
								}
								else
									echo $_SESSION['customer_cell'];
								?>
							</p>
							<h4> Country Code</h4>
							<p style="margin-left:30%"> 
								<?php
								if($_SESSION['customer_countrycode']==null)
								{
									echo '----';
								}
								else
									echo $_SESSION['customer_countrycode'];
								?>
							</p>
						</div>
						<div class="col-md-6" style="float:left;">
							<h4> City</h4>
							<p style="margin-left:30%">
								<?php
								if($_SESSION['address_city']==null)
								{
									echo '----';
								}
								else
									echo $_SESSION['address_city'];
								?>
							</p>
							<h4> Country</h4>
							<p style="margin-left:30%"> 
								<?php
								if($_SESSION['address_country']==null)
								{
									echo '----';
								}
								else
									echo $_SESSION['address_country'];
								?>
							</p>
							<h4> Address</h4>
							<p style="margin-left:30%"> 
								<?php
								if($_SESSION['address_line']==null)
								{
									echo '----';
								}
								else
									echo $_SESSION['address_line'];
								?>
							</p>
						</div>
					</div>
					
					<div class="col-md-12" style="float:left;">
						<hr>
						<button style="background-color:#581845; color:white; float:right;" class="btn " 
						id="editCustomerPersonalInfo" name="editCustomerPersonalInfo" onclick="loadCustomerPersonalInfoEdit()"> 
							Edit  <i class="glyphicon glyphicon-pencil" style="font-size:13px;"></i> 
						</button>
					</div> 
				</div> <!-- personal info div content-->
				   
            </div>
		</div>
		
	</div>
  </div>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

<!-- personal details div-->
<div id="personalInfo" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center">
			<h3 style="color:#5b9bd1;"> Personal Details </h3>
		<hr>
		</div>
		<div class="col-md-6" style="float:left;">
			<h4> First Name</h4>
			<p style="margin-left:30%"> 
				<?php
				if($_SESSION['customer_fname']==null)
				{
					echo '----';
				}
				else
					echo $_SESSION['customer_fname'];
				?>
			</p>
			<h4> Last Name</h4>
			<p style="margin-left:30%"> 
				<?php
				if($_SESSION['customer_lname']==null)
				{
					echo '----';
				}
				else
					echo $_SESSION['customer_lname'];
				?>
			</p>
			<h4> Email</h4>
			<p style="margin-left:30%">
				<?php
				if($_SESSION['customer_email']==null)
				{
					echo '----';
				}
				else
					echo $_SESSION['customer_email'];
				?>
			</p>
		</div>
		<div class="col-md-6" style="float:left;">
			<h4> CNIC</h4>
			<p style="margin-left:30%">
				<?php
				if($_SESSION['customer_cnic']==null)
				{
					echo '----';
				}
				else
					echo $_SESSION['customer_cnic'];
				?>
			</p>
			<h4> Date of Birth</h4>
			<p style="margin-left:30%"> 
				<?php
				if($_SESSION['customer_dob']==null)
				{
					echo '----';
				}
				else
					echo $_SESSION['customer_dob'];
				?>
			</p>
			<h4> Gender</h4>
			<p style="margin-left:30%">
				<?php
				if($_SESSION['customer_gender']==null)
				{
					echo '----';
				}
				else
					echo $_SESSION['customer_gender'];
				?>
			</p>
		</div>
		<div class="col-md-12" style="float:left;">
		<hr>
			<div class="col-md-6" style="float:left;">
				<h4> Phone</h4>
				<p style="margin-left:30%"> 
					<?php
					if($_SESSION['customer_phone']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['customer_phone'];
					?>
				</p>
				<h4> Mobile</h4>
				<p style="margin-left:30%"> 
					<?php
					if($_SESSION['customer_cell']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['customer_cell'];
					?>
				</p>
				<h4> Country Code</h4>
				<p style="margin-left:30%"> 
					<?php
					if($_SESSION['customer_countrycode']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['customer_countrycode'];
					?>
				</p>
			</div>
			<div class="col-md-6" style="float:left;">
				<h4> City</h4>
				<p style="margin-left:30%">
					<?php
					if($_SESSION['address_city']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['address_city'];
					?>
				</p>
				<h4> Country</h4>
				<p style="margin-left:30%"> 
					<?php
					if($_SESSION['address_country']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['address_country'];
					?>
				</p>
				<h4> Address</h4>
				<p style="margin-left:30%"> 
					<?php
					if($_SESSION['address_line']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['address_line'];
					?>
				</p>
			</div>
		</div>
		
		<div class="col-md-12" style="float:left;">
			<hr>
			<button style="background-color:#581845; color:white; float:right;" class="btn " 
			id="editCustomerPersonalInfo" name="editCustomerPersonalInfo" onclick="loadCustomerPersonalInfoEdit()"> 
				Edit  <i class="glyphicon glyphicon-pencil" style="font-size:13px;"></i> 
			</button>
		</div>
	</div> 
</div> <!-- personal info div -->


<!-- agent details div-->
<div id="travelInfo" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center">
			<h3 style="color:#5b9bd1;"> Agency Details </h3>
		<hr>
		</div>
		<div class="col-md-6" style="float:left; border-right: 1px solid;">
			<h4> NTN Number</h4>
			<p style="margin-left:30%"> 
				<?php
					if($_SESSION['ntn_number']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['ntn_number'];
					?>
			</p>
			<h4> Credit Limit </h4>
			<p style="margin-left:30%"> 
				<?php
					if($_SESSION['credit_limit']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['credit_limit'];
					?>
			</p>
			<h4> Available Credit</h4>
			<p style="margin-left:30%">
				<?php
					if($_SESSION['available_credit']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['available_credit'];
					?>
			</p>
		</div>
		
		<div class="col-md-12" style="float:left;">
			<hr>
			<button style="background-color:#581845; color:white; float:right;" class="btn " 
			onclick="loadCustomerTravelInfoEdit()" id="editCustomerTravelInfo" name="editCustomerTravelInfo"> 
				Edit  <i class="glyphicon glyphicon-pencil" style="font-size:13px;"></i> 
			</button>
		</div>
	</div> 
</div> <!-- travel info div end-->


<!-- security div-->
<div id="security" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center" >
		<h3 style="color:#5b9bd1;"> Reset Password </h3>
		<hr>
		<div class="col-md-3">
		 
		</div>
			<div class="col-md-6" align="left">
				<form class="form-signin" style="padding:10px;" action="" method="post">
					<label for="loginPassword">Password</label>
					<input type="password" class="form-control" id="customerPassword" name="customerPassword"
					required >
					<br>
					<label for="loginPassword">Confirm Password</label>
					<input type="password" class="form-control" id="confirmCustomerPassword" name="confirmCustomerPassword"
					required onchange "validatePassword">
					<hr>
					<button style="background-color:#581845; color:white; float:right;" class="btn " 
					type="submit" id="updateCustomerPassword" name="updateCustomerPassword"> 
						Update  <i class="glyphicon glyphicon-pencil" style="font-size:13px;"></i> 
					</button>
				</form>
			</div>
		</div>
	</div> 
</div> <!-- security div end-->

<!-- personal info form div-->
<div id="editPersonalInfo" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center" >
			<h3 style="color:#5b9bd1;"> Edit Personal Details </h3>
			<hr>
			<div class="col-md-12" align="left">
				<form class="form-signin" style="padding:10px;" action="" method="post">
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerFirstName">First Name</label>
							<input type="text" class="form-control" id="editCustomerFirstName" 
							name="editCustomerFirstName" value="<?php
							if($_SESSION['customer_fname']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['customer_fname'];
							?>">
						</div>
						<div class="col-md-6">
							<label for="editCustomerLastName">Last Name</label>
							<input type="text" class="form-control" id="editCustomerLastName" 
							name="editCustomerLastName" value="<?php
				if($_SESSION['customer_lname']==null)
				{
					echo '';
				}
				else
					echo $_SESSION['customer_lname'];
				?>">
							<br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerEmail">Email</label>
							<input type="text" class="form-control" id="editCustomerEmail" 
							name="editCustomerEmail" value="<?php
				if($_SESSION['customer_email']==null)
				{
					echo '';
				}
				else
					echo $_SESSION['customer_email'];
				?>" disabled>
						</div>
						<div class="col-md-6">
							<label for="editCustomerGender">Gender</label><br>
							 <select class="form-control" id="editCustomerGender" name="editCustomerGender" >
							 <option value=""  disabled>Select</option>
								<option value="Male" <?php
							if($_SESSION['customer_gender']=='Male')
							{
								echo 'selected';
							}?>>Male</option>
								<option value="Female" <?php
							if($_SESSION['customer_gender']=='Female')
							{
								echo 'selected';
							}?>>Female</option>
								<option value="Other" <?php
							if($_SESSION['customer_gender']=='Other')
							{
								echo 'selected';
							}?>>Other</option>
							 </select>
							 <br>
						</div>
						
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerDob">Date of Birth</label>
							<input type="date" class="form-control" id="editCustomerDob" 
							name="editCustomerDob" value="<?php
							if($_SESSION['customer_dob']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['customer_dob'];
							?>" >
						</div>
						<div class="col-md-6">
							<label for="editCustomerCnic">CNIC #</label>
							<input type="text" class="form-control" id="editCustomerCnic" 
							name="editCustomerCnic" value="<?php
							if($_SESSION['customer_cnic']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['customer_cnic'];
							?>" >
							<br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerPhone">Phone</label>
							<input type="number" class="form-control" id="editCustomerPhone" 
							name="editCustomerPhone" value="<?php
					if($_SESSION['customer_phone']==null)
					{
						echo '';
					}
					else
						echo $_SESSION['customer_phone'];
					?>" >
						</div>
						<div class="col-md-6">
							<label for="editCustomerMobile">Mobile</label>
							<input type="number" class="form-control" id="editCustomerMobile" 
							name="editCustomerMobile" value="<?php
					if($_SESSION['customer_cell']==null)
					{
						echo '';
					}
					else
						echo $_SESSION['customer_cell'];
					?>" >
							<br><br>
						</div>
					</div>
					<div class="col-md-12" style="border-top: 1px solid #ccc;"> <br></div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerCountryCode">Country Code</label>
							<input type="number" class="form-control" id="editCustomerCountryCode" 
							name="editCustomerCountryCode" value="<?php
					if($_SESSION['customer_countrycode']==null)
					{
						echo '';
					}
					else
						echo $_SESSION['customer_countrycode'];
					?>" >
						</div>
						<div class="col-md-6">
							<label for="editCustomerCity">City</label>
							<input type="text" class="form-control" id="editCustomerCity" 
							name="editCustomerCity" value="<?php
					if($_SESSION['address_city']==null)
					{
						echo '';
					}
					else
						echo $_SESSION['address_city'];
					?>" >
							<br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerCountry">Country</label>
							<input type="text" class="form-control" id="editCustomerCountry" 
							name="editCustomerCountry" value="<?php
					if($_SESSION['address_country']==null)
					{
						echo '';
					}
					else
						echo $_SESSION['address_country'];
					?>" >
						</div>
						<div class="col-md-12">
							<label for="editCustomerAddress">Address</label>
							<input type="text" class="form-control" id="editCustomerAddress" 
							name="editCustomerAddress" value="<?php
					if($_SESSION['address_line']==null)
					{
						echo '';
					}
					else
						echo $_SESSION['address_line'];
					?>" >
							<br>
						</div>
					</div>
					<div class="col-md-12" style="border-top: 1px solid #ccc;"> <br></div>
					
					<button style="background-color:#581845; color:white; float:right;" class="btn " 
					type="submit" id="updateCustomerPersonalInfo" name="updateCustomerPersonalInfo"> 
						Update  <i class="glyphicon glyphicon-pencil" style="font-size:13px;"></i> 
					</button>
				</form>
			</div>
		</div>
	</div> 
</div> <!-- personal info form div end-->


<!-- Agency info form div-->
<div id="editTravelInfo" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center" >
			<h3 style="color:#5b9bd1;"> Edit Agency Info </h3>
			<hr>
			<div class="col-md-12" align="left">
				<form class="form-signin" style="padding:10px;" action="" method="post">
					<div class="form-group">
						<div class="col-md-6">
							<label for="ntnNumber">NTN Number</label>
							<input type="text" class="form-control" id="ntnNumber" 
							name="ntnNumber" value="<?php
							if($_SESSION['ntn_number']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['ntn_number'];
							?>">
						</div>
						<div class="col-md-6">
							<label for="creditLimit">Credit Limit</label>
							<input type="text" class="form-control" id="creditLimit" 
							name="creditLimit" value="<?php
							if($_SESSION['credit_limit']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['credit_limit'];
							?>">
						</div>
						
					</div>
					<div class="form-group">
					
					<div class="col-md-6">
							<label for="availableCredit">Available Credit</label>
							<input type="text" class="form-control" id="availableCredit" 
							name="availableCredit" value="<?php
							if($_SESSION['credit_limit']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['credit_limit'];
							?>">
						</div>
								
					</div>
					
					<div class="col-md-12" style="border-top: 1px solid #ccc;"> <br></div>
					
					<button style="background-color:#581845; color:white; float:right;" class="btn " 
					type="submit" id="updateAgencyInfo" name="updateAgencyInfo"> 
						Update  <i class="glyphicon glyphicon-pencil" style="font-size:13px;"></i> 
					</button>
				</form>
			</div>
		</div>
	</div> 
</div> <!-- travel info form div end-->



  <footer class="py-5 bg-dark">
      <div class="container">
	  <br></br>
	  <hr>
        <p class="m-0 text-center text-white">Copyright &copy; Travel Solution 2018</p>
		<br></br>
      </div>
      <!-- /.container -->
	</footer>
	
</html>

<script>
function loadCustomerPersonalDetails(){
	var content = document.getElementById("personalInfo").innerHTML;
	document.getElementById("profileContent").innerHTML = content;
}

function loadCustomerTravelDetails(){
	var content = document.getElementById("travelInfo").innerHTML;
	document.getElementById("profileContent").innerHTML = content;
}
function loadCustomerSecurity(){
	var content = document.getElementById("security").innerHTML;
	document.getElementById("profileContent").innerHTML = content;
}

function loadCustomerPersonalInfoEdit(){
	var content = document.getElementById("editPersonalInfo").innerHTML;
	document.getElementById("profileContent").innerHTML = content;
}

function loadCustomerTravelInfoEdit(){
	var content = document.getElementById("editTravelInfo").innerHTML;
	document.getElementById("profileContent").innerHTML = content;
}

var password = document.getElementById("customerPassword").innerHTML;
 var confirm_password = document.getElementById("confirmCustomerPassword").innerHTML;

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


