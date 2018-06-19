
 <!-- Navigation -->
    <nav class="navbar navbar-default" style="margin-bottom:0px; !important">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=
"#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#" style="color:#581845"><strong>Travel Solution</strong></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="visibility: inherit; 
!important">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			<li><a href="#" onclick="">Hotels</a></li>
			<li><a href="#" onclick="">Flights</a></li>
			<li><a href="#">Discover</a></li>
			<li><a href="#">Flights+Hotels</a></li>
			<li><a href="#">Holiday Activities</a></li>
			<?php 
					if(isset($_SESSION['loggedInFlag'])){
						echo '
							
							<li><a href="BookedHotelRecords.php">Booking History</a></li>
						';
					}
			?>
		  </ul>
		    
		  <ul class="nav navbar-nav navbar-right">
			<div class="dropdown" style="margin:7px;">
			  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
				Account
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<?php 
					if(isset($_SESSION['loggedInFlag'])){

							$type = $_SESSION['userType'];
						if($type== 'customer')
						{
							echo '
							<li role="presentation"><a role="menuitem" tabindex="-1" href="customer_profile.php">Profile</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Logout</a></li>
						';
							
						}
						if($type == 'agent')
						{
							echo '
							<li role="presentation"><a role="menuitem" tabindex="-1" href="agent_profile.php">Profile</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Logout</a></li>
						';
							
						}
						
						if($type == 'corporate')
						{
							echo '
							<li role="presentation"><a role="menuitem" tabindex="-1" href="corporate_profile.php">Profile</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Logout</a></li>
						';
							
						}
						
						
					}else{
						echo '
						<li role="presentation"><a role="menuitem" tabindex="-1" href="login.php">Login</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="signup.php">Signup</a></li>
						';
					}
			    ?>		
			  </ul>
			</div>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
