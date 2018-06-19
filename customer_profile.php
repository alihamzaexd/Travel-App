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
include 'Profiling/Customer/CustomerProfile.php';

$db = MakeConnection2();
$email = $_SESSION['userEmail'];
$name = getname($email,$db);
$type = type($email,$db);
$id = getCustomerId($email,$db);
ShowPersonalDetails($db,$id);
ShowTravelInfo($db,$id);

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



if(isset($_POST['updateCustomerTravelInfo']))
{
	$home_airport = $_POST['editCustomerHomeAirport'];
	$seating_pref = $_POST['editCustomerSeatingPreference'];
	$special_assistance = $_POST['editCustomerSpecialAssitance'];
	$passport_country = $_POST['editCustomerPassportCountry'];
	$passport_number = $_POST['editCustomerPassportNumber'];
	updateTravelInfo($db,$id,$home_airport,$seating_pref,$special_assistance,$passport_country,$passport_number);
	ShowTravelInfo($db,$id);
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
							personal Details </a>
						</li>
						<li>
							<a href="#" onclick="loadCustomerTravelDetails()">
							<i class="glyphicon glyphicon-plane"></i>
							Travel Info </a>
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


<!-- travel details div-->
<div id="travelInfo" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center">
			<h3 style="color:#5b9bd1;"> Travel Details </h3>
		<hr>
		</div>
		<div class="col-md-6" style="float:left; border-right: 1px solid;">
			<h4> Home Airport</h4>
			<p style="margin-left:30%"> 
				<?php
					if($_SESSION['home_airport']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['home_airport'];
					?>
			</p>
			<h4> Seating Preference</h4>
			<p style="margin-left:30%"> 
				<?php
					if($_SESSION['seating_pref']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['seating_pref'];
					?>
			</p>
			<h4> Special Assistance</h4>
			<p style="margin-left:30%">
				<?php
					if($_SESSION['special_assistance']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['special_assistance'];
					?>
			</p>
		</div>
		<div class="col-md-6" style="float:left;">
			<h4> Passport Country</h4>
			<p style="margin-left:30%"> 
				<?php
					if($_SESSION['passport_country']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['passport_country'];
					?>
			</p>
			</p>
			</p>
			<h4> Passport Number</h4>
			<p style="margin-left:30%"> 
			
				<?php
					if($_SESSION['passport_number']==null)
					{
						echo '----';
					}
					else
						echo $_SESSION['passport_number'];
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


<!-- travel info form div-->
<div id="editTravelInfo" style="display:none;">
	<div class="row">
		<div class="col-md-12" align="center" >
			<h3 style="color:#5b9bd1;"> Edit Travel Info </h3>
			<hr>
			<div class="col-md-12" align="left">
				<form class="form-signin" style="padding:10px;" action="" method="post">
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerHomeAirport">Home Airport</label>
							<input type="text" class="form-control" id="editCustomerHomeAirport" 
							name="editCustomerHomeAirport" value="<?php
							if($_SESSION['home_airport']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['home_airport'];
							?>">
						</div>
						<div class="col-md-6">
							<label for="editCustomerSeatingPreference">Seating Preference</label><br>
							 <select class="form-control" id="editCustomerSeatingPreference" 
							 name="editCustomerSeatingPreference" >
							 <option value=""  disabled selected>Select</option>
								<option value="Aisle"
								<?php
								if($_SESSION['seating_pref']=='Aisle')
								{
									echo 'selected' ;
								}
								?>>Aisle</option>
								<option value="Window"
								<?php
								if($_SESSION['seating_pref']=='Window')
								{
									echo 'selected' ;
								}

								?>>Window</option>
								<option value="No Preference"
								<?php
								if($_SESSION['seating_pref']=='No Preference')
								{
									echo 'selected' ;
								}
								
								?>>No Preference</option>
							 </select>
							<br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerSpecialAssitance">Special Assistance</label><br>
							 <select class="form-control" id="editCustomerSpecialAssitance" 
							 name="editCustomerSpecialAssitance" >
							 <option value=""  disabled selected>Select</option>
								<option value="Blind"
								<?php
								if($_SESSION['special_assistance']=='Blind')
								{
									echo 'selected';
								}
			
								?>>Blind</option>
								<option value="Deaf"
								<?php
								if($_SESSION['special_assistance']=='Deaf')
								{
									echo 'selected';
								}
								
								?>>Deaf</option>
								<option value="Bulky"
								<?php
								if($_SESSION['special_assistance']=='Bulky')
								{
									echo '';
								}
							
								?>>Baggage - Bulky</option>
								<option value="Aisle"<?php
								if($_SESSION['special_assistance']=='Aisle')
								{
									echo '';
								}
							
								?>>Baggage - Fragile</option>
								<option value="Fragile"<?php
								if($_SESSION['special_assistance']=='Fragile')
								{
									echo 'selected';
								}
								
								?> >Wheelchair - Immobile</option>
								<option value="Cannot Ascend/Descend"<?php
								if($_SESSION['special_assistance']=='Cannot Ascend/Descend')
								{
									echo 'selected';
								}
								
								?> >Wheelchair - Cannot Ascend/Descend</option>
								<option value="Language"<?php
								if($_SESSION['special_assistance']=='Language')
								{
									echo '';
								}
								
								?> >Help - Language</option>
							 </select>
							<br>
						</div>			
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label for="editCustomerPassportCountry">Passport Country</label>
							<select class="form-control" name="editCustomerPassportCountry" id="editCustomerPassportCountry" required>
							<option value="" selected disabled>Select</option>
							<option value="AFG">Afghanistan</option>
							<option value="ALB">Albania</option>
							<option value="DZA">Algeria</option>
							<option value="ASM">American Samoa</option>
							<option value="AND">Andorra</option>
							<option value="AGO">Angola</option>
							<option value="AIA">Anguilla</option>
							<option value="ATA">Antarctica</option>
							<option value="ATG">Antigua and Barbuda</option>
							<option value="ARG">Argentina</option>
							<option value="ARM">Armenia</option>
							<option value="ABW">Aruba</option>
							<option value="AUS">Australia</option>
							<option value="AUT">Austria</option>
							<option value="AZE">Azerbaijan</option>
							<option value="BHS">Bahamas</option>
							<option value="BHR">Bahrain</option>
							<option value="BGD">Bangladesh</option>
							<option value="BRB">Barbados</option>
							<option value="BLR">Belarus</option>
							<option value="BEL">Belgium</option>
							<option value="BLZ">Belize</option>
							<option value="BEN">Benin</option>
							<option value="BMU">Bermuda</option>
							<option value="BTN">Bhutan</option>
							<option value="BOL">Bolivia</option>
							<option value="BES">Bonaire, Sint Eustatius and Saba</option>
							<option value="BIH">Bosnia and Herzegovina</option>
							<option value="BWA">Botswana</option>
							<option value="BVT">Bouvet Island</option>
							<option value="BRA">Brazil</option>
							<option value="IOT">British Indian Ocean Territory</option>
							<option value="VGB">British Virgin Islands</option>
							<option value="BRN">Brunei</option>
							<option value="BGR">Bulgaria</option>
							<option value="BFA">Burkina Faso</option>
							<option value="BDI">Burundi</option>
							<option value="KHM">Cambodia</option>
							<option value="CMR">Cameroon</option>
							<option value="CAN">Canada</option>
							<option value="CPV">Cape Verde</option>
							<option value="CYM">Cayman Islands</option>
							<option value="CAF">Central African Republic</option>
							<option value="TCD">Chad</option>
							<option value="CHL">Chile</option>
							<option value="CHN">China</option>
							<option value="CXR">Christmas Island</option>
							<option value="CCK">Cocos Islands</option>
							<option value="COL">Colombia</option>
							<option value="COM">Comoros</option>
							<option value="COK">Cook Islands</option>
							<option value="CRI">Costa Rica</option>
							<option value="CIV">Cote D'ivoire</option>
							<option value="HRV">Croatia</option>
							<option value="CUB">Cuba</option>
							<option value="CUW">Curacao</option>
							<option value="CYP">Cyprus</option>
							<option value="CZE">Czech Republic</option>
							<option value="COD">Democratic Republic of the Congo</option>
							<option value="DNK">Denmark</option>
							<option value="DJI">Djibouti</option>
							<option value="DMA">Dominica</option>
							<option value="DOM">Dominican Republic</option>
							<option value="ECU">Ecuador</option>
							<option value="EGY">Egypt</option>
							<option value="SLV">El Salvador</option>
							<option value="GNQ">Equatorial Guinea</option>
							<option value="ERI">Eritrea</option>
							<option value="EST">Estonia</option>
							<option value="ETH">Ethiopia</option>
							<option value="FLK">Falkland Islands</option>
							<option value="FRO">Faroe Islands</option>
							<option value="SOM">Federal Republic of Somalia</option>
							<option value="FSM">Federated States of Micronesia</option>
							<option value="FJI">Fiji</option>
							<option value="FIN">Finland</option>
							<option value="FRA">France</option>
							<option value="GUF">French Guiana</option>
							<option value="PYF">French Polynesia</option>
							<option value="ATF">French Southern and Antarctic Territories</option>
							<option value="GAB">Gabon</option>
							<option value="GMB">Gambia</option>
							<option value="GEO">Georgia</option>
							<option value="DEU">Germany</option>
							<option value="GHA">Ghana</option>
							<option value="GIB">Gibraltar</option>
							<option value="GRC">Greece</option>
							<option value="GRL">Greenland</option>
							<option value="GRD">Grenada</option>
							<option value="GLP">Guadeloupe</option>
							<option value="GUM">Guam</option>
							<option value="GTM">Guatemala</option>
							<option value="GIN">Guinea</option>
							<option value="GNB">Guinea-Bissau</option>
							<option value="GUY">Guyana</option>
							<option value="HTI">Haiti</option>
							<option value="HMD">Heard and Mcdonald Islands</option>
							<option value="HND">Honduras</option>
							<option value="HKG">Hong Kong SAR</option>
							<option value="HUN">Hungary</option>
							<option value="ISL">Iceland</option>
							<option value="IND">India</option>
							<option value="IDN">Indonesia</option>
							<option value="IRN">Iran</option>
							<option value="IRQ">Iraq</option>
							<option value="IRL">Ireland</option>
							<option value="ISR">Israel</option>
							<option value="ITA">Italy</option>
							<option value="JAM">Jamaica</option>
							<option value="JPN">Japan</option>
							<option value="JOR">Jordan</option>
							<option value="KAZ">Kazakhstan</option>
							<option value="KEN">Kenya</option>
							<option value="KIR">Kiribati</option>
							<option value="KWT">Kuwait</option>
							<option value="KGZ">Kyrgyzstan</option>
							<option value="LAO">Laos</option>
							<option value="LVA">Latvia</option>
							<option value="LBN">Lebanon</option>
							<option value="LSO">Lesotho</option>
							<option value="LBR">Liberia</option>
							<option value="LBY">Libya</option>
							<option value="LIE">Liechtenstein</option>
							<option value="LTU">Lithuania</option>
							<option value="LUX">Luxembourg</option>
							<option value="MAC">Macau SAR</option>
							<option value="MKD">Macedonia</option>
							<option value="MDG">Madagascar</option>
							<option value="MWI">Malawi</option>
							<option value="MYS">Malaysia</option>
							<option value="MDV">Maldives</option>
							<option value="MLI">Mali</option>
							<option value="MLT">Malta</option>
							<option value="MHL">Marshall Islands</option>
							<option value="MTQ">Martinique</option>
							<option value="MRT">Mauritania</option>
							<option value="MUS">Mauritius</option>
							<option value="MYT">Mayotte</option>
							<option value="MEX">Mexico</option>
							<option value="MDA">Moldova</option>
							<option value="MCO">Monaco</option>
							<option value="MNG">Mongolia</option>
							<option value="MNE">Montenegro</option>
							<option value="MSR">Montserrat</option>
							<option value="MAR">Morocco</option>
							<option value="MOZ">Mozambique</option>
							<option value="MMR">Myanmar</option>
							<option value="NAM">Namibia</option>
							<option value="NRU">Nauru</option>
							<option value="NPL">Nepal</option>
							<option value="NLD">Netherlands</option>
							<option value="NCL">New Caledonia</option>
							<option value="NZL">New Zealand</option>
							<option value="NIC">Nicaragua</option>
							<option value="NER">Niger</option>
							<option value="NGA">Nigeria</option>
							<option value="NIU">Niue</option>
							<option value="NFK">Norfolk Island</option>
							<option value="PRK">North Korea</option>
							<option value="MNP">Northern Mariana Islands</option>
							<option value="NOR">Norway</option>
							<option value="OMN">Oman</option>
							<option value="PAK">Pakistan</option>
							<option value="PLW">Palau</option>
							<option value="PAN">Panama</option>
							<option value="PNG">Papua New Guinea</option>
							<option value="PRY">Paraguay</option>
							<option value="PER">Peru</option>
							<option value="PHL">Philippines</option>
							<option value="PCN">Pitcairn Island</option>
							<option value="POL">Poland</option>
							<option value="PRT">Portugal</option>
							<option value="PRI">Puerto Rico</option>
							<option value="QAT">Qatar</option>
							<option value="COG">Republic of the Congo</option>
							<option value="REU">Reunion</option>
							<option value="ROU">Romania</option>
							<option value="RUS">Russia</option>
							<option value="RWA">Rwanda</option>
							<option value="WSM">Samoa</option>
							<option value="SMR">San Marino</option>
							<option value="STP">Sao Tome and Principe</option>
							<option value="SAU">Saudi Arabia</option>
							<option value="SEN">Senegal</option>
							<option value="SRB">Serbia</option>
							<option value="SYC">Seychelles</option>
							<option value="SLE">Sierra Leone</option>
							<option value="SGP">Singapore</option>
							<option value="SXM">Sint Maarten</option>
							<option value="SVK">Slovakia</option>
							<option value="SVN">Slovenia</option>
							<option value="SLB">Solomon Islands</option>
							<option value="ZAF">South Africa</option>
							<option value="SGS">S. Georgia and Sandwich Is.</option>
							<option value="KOR">South Korea</option>
							<option value="SSD">South Sudan</option>
							<option value="ESP">Spain</option>
							<option value="LKA">Sri Lanka</option>
							<option value="BLM">St. Barthelemy</option>
							<option value="SHN">St. Helena</option>
							<option value="KNA">St. Kitts and Nevis</option>
							<option value="LCA">St. Lucia</option>
							<option value="MAF">St. Martin</option>
							<option value="SPM">St. Pierre and Miquelon</option>
							<option value="VCT">St. Vincent and the Grenadines</option>
							<option value="PSE">State of Palestine</option>
							<option value="SDN">Sudan</option>
							<option value="SUR">Suriname</option>
							<option value="SJM">Svalbard</option>
							<option value="SWZ">Swaziland</option>
							<option value="SWE">Sweden</option>
							<option value="CHE">Switzerland</option>
							<option value="SYR">Syria</option>
							<option value="TWN">Taiwan</option>
							<option value="TJK">Tajikistan</option>
							<option value="TZA">Tanzania</option>
							<option value="THA">Thailand</option>
							<option value="TLS">Timor Leste</option>
							<option value="TGO">Togo</option>
							<option value="TKL">Tokelau</option>
							<option value="TON">Tonga</option>
							<option value="TTO">Trinidad and Tobago</option>
							<option value="TUN">Tunisia</option>
							<option value="TUR">Turkey</option>
							<option value="TKM">Turkmenistan</option>
							<option value="TCA">Turks and Caicos</option>
							<option value="TUV">Tuvalu</option>
							<option value="VIR">U.S. Virgin Islands</option>
							<option value="UGA">Uganda</option>
							<option value="UKR">Ukraine</option>
							<option value="ARE">United Arab Emirates</option>
							<option value="GBR">United Kingdom</option>
							<option value="USA">United States of America</option>
							<option value="URY">Uruguay</option>
							<option value="UMI">US Minor Outlying Islands</option>
							<option value="UZB">Uzbekistan</option>
							<option value="VUT">Vanuatu</option>
							<option value="VAT">Vatican City</option>
							<option value="VEN">Venezuela</option>
							<option value="VNM">Vietnam</option>
							<option value="WLF">Wallis and Futuna</option>
							<option value="ESH">Western Sahara</option>
							<option value="YEM">Yemen</option>
							<option value="ZMB">Zambia</option>
							<option value="ZWE">Zimbabwe</option>
							</select>
							<br>
						</div>
						
						<div class="col-md-6">
							<label for="editCustomerPassportNumber">Passport No.</label>
							<input type="text" class="form-control" id="editCustomerPassportNumber" 
							name="editCustomerPassportNumber" value="
							<?php
							if($_SESSION['passport_number']==null)
							{
								echo '';
							}
							else
								echo $_SESSION['passport_number'];
							?>" >
							<br>
						</div>
					</div>
					<div class="col-md-12" style="border-top: 1px solid #ccc;"> <br></div>
					
					<button style="background-color:#581845; color:white; float:right;" class="btn " 
					type="submit" id="updateCustomerTravelInfo" name="updateCustomerTravelInfo"> 
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


