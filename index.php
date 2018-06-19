<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start(); 
    // including header file containing all style and JQuery files 
include 'header.php';

?>

<!-- including navigation bar-->
<?php
    // including navbar file containing responsible top navigation bar. 
    include 'navbar.php';
?>

</head>
  
<script>
$(function(){
	$('a[title]').tooltip();
});
</script>  

<script>
function countryChanged(value){
	
	$.post("sample.php",{country:value}, function(x){
			if(x){  
			// x contains response of the function
			
			document.getElementById("data").innerHTML = x;
			}
			else{
				document.getElementById("data").innerHTML = "No City Information found for the selected Country";
			}
	});
	
}

window.onload = function() {	
  countryChanged(' ');
};


function getFlyingFromCities(value){
	
	$.post("flightsample.php",{country:value}, function(x){
			if(x){  
			// x contains response of the function
			
			document.getElementById("flyingFromCitiesData").innerHTML = x;
			}
			else{
				document.getElementById("flyingFromCitiesData").innerHTML = "No City Information found for the selected Country";
			}
	});
	
}


function getFlyingToCities(value){
	
	$.post("flightsample.php",{country:value}, function(x){
			if(x){  
			// x contains response of the function
			
			document.getElementById("flyingToCitiesData").innerHTML = x;
			}
			else{
				document.getElementById("flyingToCitiesData").innerHTML = "No City Information found for the selected Country";
			}
	});
	
}

</script>


<body> 
		<!-- test content-->
		<section class="bgimg">
        <div class="container">
            <div class="row">
                <div class="board" style="background-color:rgba(0,0,0,0.75);">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
						<ul class="nav nav-tabs" id="myTab">
						<div class="liner"></div>
						  <li>
							  <a href=""  onclick="loadFlightsSearchForm();" data-toggle="tab" title="Flights">
								<span class="round-tabs one">
									<img src="asset/images/plane.png" style="border-radius: 50%;" alt="Flights">
								</span> 
							  </a>
						  </li>

					      <li>  <a href="" onclick="loadHotelsSearchForm();" data-toggle="tab" title="Hotels">
								<span class="round-tabs two">
									<img src="asset/images/hotel.png" style="border-radius: 50%;" alt="">
								</span> 
					            </a>
					      </li>
						  <li><a href="#messages" data-toggle="tab" title="Flight + Hotel">
								<span class="round-tabs three">
								 <img src="asset/images/hotelAndPlane.png" style="border-radius: 50%;" alt="">
								</span> </a>
						  </li>

						  <li>  <a href="#settings" data-toggle="tab" title="Car Hire">
							    <span class="round-tabs four">
								  <img src="asset/images/car.png" style="border-radius: 50%;" alt="">
							    </span> 
						        </a>
						  </li>

						  <li>  <a href="#doner" data-toggle="tab" title="Discover">
							    <span class="round-tabs five">
								  <i class="glyphicon glyphicon-search"></i>
							    </span>
								</a>
						  </li>
						 
						</ul>
					</div>
					 
					<!-- tab content to be updated by javascript function-->
                    <div class="tab-content" id="tab-contents" style="padding-left:10%;padding-right:10%;">
						<!-- form for hotels search-->
						<div id="hotelSearchContent" style="display:block;">
							<div class="tab-pane fade in active" id="home">
								<form class="form-horizontal" role="form" action="hotelSearchResults.php" method="post">
								  <div class="form-group">
									<div class="col-md-12">
										<label for="hotelDestination">Going to</label><br>
										<input type="text" list="data" class="form-control" id="hotelDestination"
										name="hotelDestination" placeholder="Destination, City or Country ..."  required />
										<datalist id="data">
	
											</datalist>
									</div>
								  </div>
								  <div class="form-group">
									<div class="col-md-5">
										<label for="hotelCheckInDate">Check in</label><br>
										<input type="date" class="form-control" id="hotelCheckInDate" name="hotelCheckInDate"
										placeholder="Destination, City or Country ..." onclick="Disabledate()" onchange="Disabledate()" required>
									</div>
									<div class="col-md-5">
										<label for="hotelCheckOutDate">Check out</label><br>
										<input type="date" class="form-control" id="hotelCheckOutDate" name="hotelCheckOutDate"
										placeholder="Destination, City or Country ..."  onclick = "RDate();Disabledate1()" onchange="RDate();Disabledate1()" required>
									</div>
								  </div>
								  <div class="form-group">
									<div class="col-md-3">
										<label for="hotelRooms">Rooms</label><br>
										 <select class="form-control" id="hotelRooms" name="hotelRooms" onchange="changeNumberOfRooms(this.value);" required>
										 <option value="" selected disabled>Select</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											
										  </select>
									</div>
								  </div>
								  <div class="form-group" id="RoomsForm" style="padding-left:3%;">
									<!-- room details dropdowns are shown here-->
								  </div>
									
								  
								  <div class="form-group">
									<div class="col-md-4">
									<br>
									  <button type="submit" name="hotelSearch" class="btn btn-primary btn-lg">Search <i class="fa fa-search"></i></button>
									</div>
								  </div>
								</form>
							
							</div>	 
						</div>
						<!-- End hotels search form -->
					</div>
							

				</div>
			</div>
		</div>
		</section>
		
		
	<div id="room1Form" style="display:none;">
	<hr>
		<label id="roomNumber">Room 1</label>
		<br>
		<div class="row">
		  <div class="col-md-3">
			<label for="room1Adults">Adults (18+)</label><br>
			<select class="form-control" id="room1Adults" name="room1Adults" required>
			 <option value="" selected disabled>Select</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		  <div class="col-md-3">
			<label for="room1Children">Children (0-17)</label>
			<select class="form-control" id="room1Children" name="room1Children" 
			onchange="room1ChildrenChange(this.value);"
			required>
			 <option value="" selected disabled>Select</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		  
		  <div id="room1ChildrenForm">
											 
		  </div> <!-- children age dropdowns -->  
		</div>
	</div> <!-- single room form -->
	
	<div id="room2Form" style="display:none;">
	<hr>
		<label id="roomNumber">Room 2</label>
		<br>
		<div class="row">
		  <div class="col-md-3">
			<label for="room2Adults">Adults (18+)</label><br>
			<select class="form-control" id="room2Adults" name="room2Adults" required>
			 <option value="" selected disabled>Select</option>
				
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		  <div class="col-md-3">
			<label for="room2Children">Children (0-17)</label>
			<select class="form-control" id="room2Children" name="room2Children" 
			onchange="room2ChildrenChange(this.value);"
			required>
			 <option value="" selected disabled>Select</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		   <div id="room2ChildrenForm">
											 
		  </div> <!-- children age dropdowns -->  
		</div>
	</div> <!-- single room form -->
	
	<div id="room3Form" style="display:none;">
	<hr>
		<label id="roomNumber">Room 3</label>
		<br>
		<div class="row">
		  <div class="col-md-3">
			<label for="room3Adults">Adults (18+)</label><br>
			<select class="form-control" id="room3Adults" name="room3Adults" required>
			 <option value="" selected disabled>Select</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		  <div class="col-md-3">
			<label for="room3Children">Children (0-17)</label>
			<select class="form-control" id="room3Children" name="room3Children" 
			onchange="room3ChildrenChange(this.value);"
			required>
			 <option value="" selected disabled>Select</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		   <div id="room3ChildrenForm">
											 
		  </div> <!-- children age dropdowns -->  
		</div>
	</div> <!-- single room form -->
	
	<div id="room4Form" style="display:none;">
	<hr>
		<label id="roomNumber">Room 4</label>
		<br>
		<div class="row">
		  <div class="col-md-3">
			<label for="room4Adults">Adults (18+)</label><br>
			<select class="form-control" id="room4Adults" name="room4Adults" required>
			 <option value="" selected disabled>Select</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		  <div class="col-md-3">
			<label for="room4Children">Children (0-17)</label>
			<select class="form-control" id="room4Children" name="room4Children" 
			onchange="room4ChildrenChange(this.value);"
			required>
			 <option value="" selected disabled>Select</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		   <div id="room4ChildrenForm">
											 
		  </div> <!-- children age dropdowns -->  
		</div>
	</div> <!-- single room form -->
	
	<div id="room5Form" style="display:none;">
	<hr>
		<label id="roomNumber">Room 5</label>
		<br>
		<div class="row">
		  <div class="col-md-3">
			<label for="room5Adults">Adults (18+)</label><br>
			<select class="form-control" id="room5Adults" name="room5Adults" required>
			 <option value="" selected disabled>Select</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		  <div class="col-md-3">
			<label for="room5Children">Children (0-17)</label>
			<select class="form-control" id="room5Children" name="room5Children" 
			onchange="room5ChildrenChange(this.value);"
			required>
			 <option value="" selected disabled>Select</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select>
		  </div>
		   <div id="room5ChildrenForm">
											 
		  </div> <!-- children age dropdowns -->  
		</div>
	</div> <!-- single room form -->

	
	<!-- room1 children age dropdowns -->
	
	<div id="room1Child1f" style="display:none;">
	  <div class="col-md-2">
		<label for="room1Child1">Child 1</label><br>
		<select class="form-control" id="room1Child1" name="room1Child1" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child1 form --> 

	<div id="room1Child2f" style="display:none;">
	  <div class="col-md-2">
		<label for="room1Child2">Child 2</label><br>
		<select class="form-control" id="room1Child2" name="room1Child2" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child2 form --> 

	<div id="room1Child3f" style="display:none;">
	  <div class="col-md-2">
		<label for="room1Child3">Child 3</label><br>
		<select class="form-control" id="room1Child3" name="room1Child3" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child3 form --> 

	<div id="room1Child4f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room1Child4">Child 4</label><br>
		<select class="form-control" id="room1Child4" name="room1Child4" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child4 form --> 
	
	<div id="room1Child5f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room1Child5">Child 5</label><br>
		<select class="form-control" id="room1Child5" name="room1Child5" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child5 form --> 
	
	<div id="room1Child6f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room1Child6">Child 6</label><br>
		<select class="form-control" id="room1Child6" name="room1Child6" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child6 form --> 
	
	<!-- ======================================= end of children age dropdowns ==============================-->
	
	
		<!-- room2 children age dropdowns -->
	
	<div id="room2Child1f" style="display:none;">
	  <div class="col-md-2">
		<label for="room2Child1">Child 1</label><br>
		<select class="form-control" id="room2Child1" name="room2Child1" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child1 form --> 

	<div id="room2Child2f" style="display:none;">
	  <div class="col-md-2">
		<label for="room2Child2">Child 2</label><br>
		<select class="form-control" id="room2Child2" name="room2Child2" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child2 form --> 

	<div id="room2Child3f" style="display:none;">
	  <div class="col-md-2">
		<label for="room2Child3">Child 3</label><br>
		<select class="form-control" id="room2Child3" name="room2Child3" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child3 form --> 

	<div id="room2Child4f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room2Child4">Child 4</label><br>
		<select class="form-control" id="room2Child4" name="room2Child4" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child4 form --> 
	
	<div id="room2Child5f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room2Child5">Child 5</label><br>
		<select class="form-control" id="room2Child5" name="room2Child5" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child5 form --> 
	
	<div id="room2Child6f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room2Child6">Child 6</label><br>
		<select class="form-control" id="room2Child6" name="room2Child6" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child6 form --> 
	
	<!-- ============================== end of children age dropdowns==================================================-->
			<!-- room3 children age dropdowns -->
	
	<div id="room3Child1f" style="display:none;">
	  <div class="col-md-2">
		<label for="room3Child1">Child 1</label><br>
		<select class="form-control" id="room3Child1" name="room3Child1" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child1 form --> 

	<div id="room3Child2f" style="display:none;">
	  <div class="col-md-2">
		<label for="room3Child2">Child 2</label><br>
		<select class="form-control" id="room3Child2" name="room3Child2" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child2 form --> 

	<div id="room3Child3f" style="display:none;">
	  <div class="col-md-2">
		<label for="room3Child3">Child 3</label><br>
		<select class="form-control" id="room3Child3" name="room3Child3" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child3 form --> 

	<div id="room3Child4f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room3Child4">Child 4</label><br>
		<select class="form-control" id="room3Child4" name="room3Child4" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child4 form --> 
	
	<div id="room3Child5f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room3Child5">Child 5</label><br>
		<select class="form-control" id="room3Child5" name="room3Child5" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child5 form --> 
	
	<div id="room3Child6f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room3Child6">Child 6</label><br>
		<select class="form-control" id="room3Child6" name="room3Child6" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child6 form --> 
	
	<!-- ============================== end of children age dropdowns==================================================-->
			<!-- room4 children age dropdowns -->
	
	<div id="room4Child1f" style="display:none;">
	  <div class="col-md-2">
		<label for="room4Child1">Child 1</label><br>
		<select class="form-control" id="room4Child1" name="room4Child1" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child1 form --> 

	<div id="room4Child2f" style="display:none;">
	  <div class="col-md-2">
		<label for="room4Child2">Child 2</label><br>
		<select class="form-control" id="room4Child2" name="room4Child2" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child2 form --> 

	<div id="room4Child3f" style="display:none;">
	  <div class="col-md-2">
		<label for="room4Child3">Child 3</label><br>
		<select class="form-control" id="room4Child3" name="room4Child3" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child3 form --> 

	<div id="room4Child4f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room4Child4">Child 4</label><br>
		<select class="form-control" id="room4Child4" name="room4Child4" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child4 form --> 
	
	<div id="room4Child5f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room4Child5">Child 5</label><br>
		<select class="form-control" id="room4Child5" name="room4Child5" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child5 form --> 
	
	<div id="room4Child6f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room4Child6">Child 6</label><br>
		<select class="form-control" id="room4Child6" name="room4Child6" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child6 form --> 
	
	<!-- ============================== end of children age dropdowns==================================================-->
			<!-- room5 children age dropdowns -->
	
	<div id="room5Child1f" style="display:none;">
	  <div class="col-md-2">
		<label for="room5Child1">Child 1</label><br>
		<select class="form-control" id="room5Child1" name="room5Child1" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child1 form --> 

	<div id="room5Child2f" style="display:none;">
	  <div class="col-md-2">
		<label for="room5Child2">Child 2</label><br>
		<select class="form-control" id="room5Child2" name="room5Child2" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child2 form --> 

	<div id="room5Child3f" style="display:none;">
	  <div class="col-md-2">
		<label for="room5Child3">Child 3</label><br>
		<select class="form-control" id="room5Child3" name="room5Child3" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child3 form --> 

	<div id="room5Child4f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room5Child4">Child 4</label><br>
		<select class="form-control" id="room5Child4" name="room5Child4" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child4 form --> 
	
	<div id="room5Child5f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room5Child5">Child 5</label><br>
		<select class="form-control" id="room5Child5" name="room5Child5" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child5 form --> 
	
	<div id="room5Child6f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="room5Child6">Child 6</label><br>
		<select class="form-control" id="room5Child6" name="room5Child6" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child6 form --> 
	
	<!-- ============================== end of children age dropdowns==================================================-->
	
	
	<!-- ============================== Flight children children age dropdowns==================================================-->
	<!-- Flight children age dropdowns -->
	
	<div id="flightChild1f" style="display:none;">
	  <div class="col-md-2">
		<label for="flightChild1">Child 1</label><br>
		<select class="form-control" id="flightChild1" name="flightChild1" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child1 form --> 

	<div id="flightChild2f" style="display:none;">
	  <div class="col-md-2">
		<label for="flightChild2">Child 2</label><br>
		<select class="form-control" id="flightChild2" name="flightChild2" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child2 form --> 

	<div id="flightChild3f" style="display:none;">
	  <div class="col-md-2">
		<label for="flightChild3">Child 3</label><br>
		<select class="form-control" id="flightChild3" name="flightChild3" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child3 form --> 

	<div id="flightChild4f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="flightChild4">Child 4</label><br>
		<select class="form-control" id="flightChild4" name="flightChild4" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child4 form --> 
	
	<div id="flightChild5f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="flightChild5">Child 5</label><br>
		<select class="form-control" id="flightChild5" name="flightChild5" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child5 form --> 
	
	<div id="flightChild6f" style="display:none;">
	  <div class="col-md-2" style="margin-top:10px;">
		<label for="flightChild6">Child 6</label><br>
		<select class="form-control" id="flightChild6" name="flightChild6" required>
		 <option value="" selected disabled>Age</option>
			<option value="1">1</option><option value="2">2</option><option value="3">3</option>
			<option value="4">4</option><option value="5">5</option><option value="6">6</option>
			<option value="7">7</option><option value="8">8</option><option value="9">9</option>
			<option value="10">10</option><option value="11">11</option><option value="12">12</option>
			
		</select>
	  </div>
	</div> <!-- single child6 form --> 
	
	<!-- ============================== end of children age dropdowns==================================================-->
	
	
	
	<!-- form for flights search-->
	<div id="flightSearchContent" style="display:none;">
	 <div class="tab-pane fade in active" id="home">
			<form class="form-horizontal" role="form" action="flightSearchResults.php" method="post">
			  <div class="form-group">
				<div class="col-md-6">
					<label for="inputEmail3">Flying from</label><br>
					<input type="text" list="flyingFromCitiesData"  class="form-control" id="flyingFromCity" name="flyingFromCity" 
					placeholder="City or Country ..." required />
					<datalist id="flyingFromCitiesData">

					</datalist>
					
				</div>
				<div class="col-md-6">
					<label for="inputEmail3">Flying to</label><br>
					<input type="text" list="flyingToCitiesData" class="form-control" id="flyingToCity" name="flyingToCity"
					placeholder="City or Country ..." required />
					<datalist id="flyingToCitiesData">

						</datalist>
					
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-5">
					<label for="inputEmail3">Departing</label><br>
					<input type="date" class="form-control" id="departureDate" name="departureDate"
					placeholder="Destination, City or Country ..." onclick="Disabledateforflight()" onchange="Disabledateforflight()"  required>
				</div>
				<div class="col-md-5">
					<label for="inputEmail3">Returning</label><br>
					<input type="date" class="form-control" id="returnDate" name="returnDate"
					placeholder="Destination, City or Country ..." onclick = "RDateForFlight();Disabledate1ForFlight()" onchange="RDateForFlight();Disabledate1ForFlight()" required>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">
					<label for="adults">Adults (18+)</label><br>
					<select class="form-control" id="adults" name="adults" required>
					 <option value="" selected disabled>Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9+</option>
					  </select>
				</div>
				<div class="col-md-3">
					<label for="children">Children (0-17)</label><br>
					<select class="form-control" id="children" name="children" onchange="changeNumberOfChildrenFlights(this.value);" required>
					 <option value="" selected disabled>Select</option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
					  </select>
				</div>
				
				<div class="form-group" id="flightChildForm" style="padding-left:3%;">
				
				</div>
				
			  </div>
			  <div class="form-group">
				<div class="col-md-4">
				<br>
				  <button type="submit" name="flightSearch" class="btn btn-primary btn-lg">Search <i class="fa fa-search"></i></button>
				</div>
			  </div>
			</form>
		
		  </div>	 
	</div>
	<!-- End flights search form -->
	
	<!-- form for hotels search-->
	<div id="hotelSearchContent" style="display:none;">
		<div class="tab-pane fade in active" id="home">
			<form class="form-horizontal" role="form" action="hotelSearchResults.php" method="post">
			  <div class="form-group">
				<div class="col-md-12">
					<label for="hotelDestination">Going to</label><br>
					<input type="text" list="data" class="form-control" id="hotelDestination"
					name="hotelDestination" placeholder="Destination, City or Country ..."  required />
					<datalist id="data">

						</datalist>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-5">
					<label for="hotelCheckInDate">Check in</label><br>
					<input type="date" class="form-control" id="hotelCheckInDate" name="hotelCheckInDate"
					placeholder="Destination, City or Country ..." onclick="Disabledate()" onchange="Disabledate()" required>
				</div>
				<div class="col-md-5">
					<label for="hotelCheckOutDate">Check out</label><br>
					<input type="date" class="form-control" id="hotelCheckOutDate" name="hotelCheckOutDate"
					placeholder="Destination, City or Country ..."  onclick = "RDate();Disabledate1()" onchange="RDate();Disabledate1()" required>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">
					<label for="hotelRooms">Rooms</label><br>
					 <select class="form-control" id="hotelRooms" name="hotelRooms" onchange="changeNumberOfRooms(this.value);" required>
					 <option value="" selected disabled>Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						
					  </select>
				</div>
			  </div>
			  <div class="form-group" id="RoomsForm" style="padding-left:3%;">
				<!-- room details dropdowns are shown here-->
			  </div>
			  
			  <div class="form-group">
				<div class="col-md-4">
				<br>
				  <button type="submit" name="hotelSearch" class="btn btn-primary btn-lg">Search <i class="fa fa-search"></i></button>
				</div>
			  </div>
			</form>		
		</div>
	</div>
	<!-- End hotels search form -->
<br>
	
	<!-- Page Content -->
    <div class="container" style="background-color:rgba(0,0,0,0.15);padding:5%;">
      <div class="row" >
        <div class="col-sm-4 my-4" >
			<a href="#">
			  <div class="card"  >
				<img class="card-img-top" src="https://thumbnails.trvl-media.com/C04QLIGDulzyiLGpXOVQM6eP-i0=/images.trvl-media.com/media/content/expuk/Images/deals/destinations/w456/MERCH/image_gromerch-1581_532x299.jpg" alt=""  style="max-width:300px;">
				<div class="card-body">
				  <h3 class="card-title" style="color:#581845;">72 Hours Only</h3>
				  <p class="card-text">Hurry, Book now or miss out!</p>
				</div>
				<br></br><br>
				<div class="card-footer">
				  <a href="#" class="btn btn-primary">Find Out More!</a>
				</div>
			  </div>
		    </a>
        </div>
        <div class="col-sm-4 my-4">
			<a href="#">
			  <div class="card">
				<img class="card-img-top" src="https://thumbnails.trvl-media.com/R2Arc2E9vNstLUqxZpYm768xb44=/cdn.lemediavault.com/images/c31296a3cd99f88d95b76836648a8f51.jpeg" alt="" style="max-width:300px;">
				<div class="card-body">
				  <h3 class="card-title" style="color:#581845;">Save Save Save</h3>
				  <p class="card-text">Book early & Save</p>
				</div>
				<br></br><br>
				<div class="card-footer">
				  <a href="#" class="btn btn-primary">Find Out More!</a>
				</div>
			  </div>
			</a>
        </div>
        <div class="col-sm-4 my-4">
			<a href="#">
			  <div class="card">
				<img class="card-img-top" src="https://thumbnails.trvl-media.com/FUuUX7FUND_8YriYrNl3pUGfhFI=/a.travel-assets.com/media/bexasia/201802/IN/asiasale.png" alt=""  style="max-width:300px;">
				<div class="card-body">
				  <h3 class="card-title" style="color:#581845;">Great deals for you! Book your Asia vacations here.</h3>
				  <p class="card-text">Booking period: 1 - 31 Mar 2018</p>
				  <p class="card-text">Travel period: 1 Mar - 30 Apr 2018</p>
				</div>
				
				<div class="card-footer">
				  <a href="#" class="btn btn-primary">Find Out More!</a>
				</div>
			  </div>
			</a>
        </div>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
	
	<div class="container">
	<br>
		<p>*All prices and offers are subject to change with availability. Hotel prices are per night based on twin share. Flight prices are per person. Package prices are per person, based on twin share. All taxes and fees (except any applicable mandatory or resort fees collected by the hotel) are included. </p>

		<p>*Savings are based on package bookings on our site from 1 January 2014 to 31 October 2014, as opposed to price if booked separately using full published fare. Savings will vary by product and seasonality and may not be available on all packages. </p>
	</div>
	
	
	
    <!-- Footer -->
	
    <footer class="py-5 bg-dark">
      <div class="container">
	  <br></br>
	  <hr>
        <p class="m-0 text-center text-white">Copyright &copy; Travel Solution 2018</p>
		<br></br>
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
	countryChanged(' ');
}

function loadFlightsSearchForm(){
	var content = document.getElementById("flightSearchContent").innerHTML;
	document.getElementById("tab-contents").innerHTML = content;
	getFlyingFromCities(' ');
	getFlyingToCities(' ');
}

// show adults+ children dropdown based on number of rooms
function changeNumberOfRooms(value){
	
	var RoomsForm = document.getElementById("RoomsForm");
	
	var room1Form = document.getElementById("room1Form").innerHTML;
	var room2Form = document.getElementById("room2Form").innerHTML;
	var room3Form = document.getElementById("room3Form").innerHTML;
	var room4Form = document.getElementById("room4Form").innerHTML;
	var room5Form = document.getElementById("room5Form").innerHTML;
	
	if(value == "1"){
		RoomsForm.innerHTML = room1Form;
	}
	if(value == "2"){
		RoomsForm.innerHTML = room1Form+"<br>"+room2Form;
	}
	if(value == "3"){
		RoomsForm.innerHTML = room1Form+"<br>"+room2Form+"<br>"+room3Form;
	}
	if(value == "4"){
		RoomsForm.innerHTML = room1Form+"<br>"+room2Form+"<br>"+room3Form+"<br>"+room4Form;
	}
	if(value == "5"){
		RoomsForm.innerHTML = room1Form+"<br>"+room2Form+"<br>"+room3Form+"<br>"+room4Form+"<br>"+room5Form;
	}
	
}

// show children dropdown based on number of child selected
function changeNumberOfChildrenFlights(value){
	var ChildrenForm = document.getElementById("flightChildForm");
	
	var child1Form = document.getElementById("flightChild1f").innerHTML;
	var child2Form = document.getElementById("flightChild2f").innerHTML;
	var child3Form = document.getElementById("flightChild3f").innerHTML;
	var child4Form = document.getElementById("flightChild4f").innerHTML;
	var child5Form = document.getElementById("flightChild5f").innerHTML;
	var child6Form = document.getElementById("flightChild6f").innerHTML;
	
	if(value == "0"){
		ChildrenForm.innerHTML = "";
	}
	if(value == "1"){
		ChildrenForm.innerHTML = child1Form;
	}
	if(value == "2"){
		ChildrenForm.innerHTML = child1Form+child2Form;
	}
	if(value == "3"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form;
	}
	if(value == "4"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form;
	}
	if(value == "5"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form;
	}
	if(value == "6"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form+child6Form;
	}
	
}

// show children age dropdowns based on number of children
function room1ChildrenChange(value){
	
	var ChildrenForm = document.getElementById("room1ChildrenForm");
	
	var child1Form = document.getElementById("room1Child1f").innerHTML;
	var child2Form = document.getElementById("room1Child2f").innerHTML;
	var child3Form = document.getElementById("room1Child3f").innerHTML;
	var child4Form = document.getElementById("room1Child4f").innerHTML;
	var child5Form = document.getElementById("room1Child5f").innerHTML;
	var child6Form = document.getElementById("room1Child6f").innerHTML;
	
	if(value == "0"){
		ChildrenForm.innerHTML = "";
	}
	if(value == "1"){
		ChildrenForm.innerHTML = child1Form;
	}
	if(value == "2"){
		ChildrenForm.innerHTML = child1Form+child2Form;
	}
	if(value == "3"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form;
	}
	if(value == "4"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form;
	}
	if(value == "5"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form;
	}
	if(value == "6"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form+child6Form;
	}
	
}

//=========================================================
// show children age dropdowns based on number of children
function room2ChildrenChange(value){

	var ChildrenForm = document.getElementById("room2ChildrenForm");
	
	var child1Form = document.getElementById("room2Child1f").innerHTML;
	var child2Form = document.getElementById("room2Child2f").innerHTML;
	var child3Form = document.getElementById("room2Child3f").innerHTML;
	var child4Form = document.getElementById("room2Child4f").innerHTML;
	var child5Form = document.getElementById("room2Child5f").innerHTML;
	var child6Form = document.getElementById("room2Child6f").innerHTML;
	
	if(value == "0"){
		ChildrenForm.innerHTML = "";
	}
	if(value == "1"){
		ChildrenForm.innerHTML = child1Form;
	}
	if(value == "2"){
		ChildrenForm.innerHTML = child1Form+child2Form;
	}
	if(value == "3"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form;
	}
	if(value == "4"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form;
	}
	if(value == "5"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form;
	}
	if(value == "6"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form+child6Form;
	}
	
}

//=======================================

// show children age dropdowns based on number of children
function room3ChildrenChange(value){

	var ChildrenForm = document.getElementById("room3ChildrenForm");
	
	var child1Form = document.getElementById("room3Child1f").innerHTML;
	var child2Form = document.getElementById("room3Child2f").innerHTML;
	var child3Form = document.getElementById("room3Child3f").innerHTML;
	var child4Form = document.getElementById("room3Child4f").innerHTML;
	var child5Form = document.getElementById("room3Child5f").innerHTML;
	var child6Form = document.getElementById("room3Child6f").innerHTML;
	
	if(value == "0"){
		ChildrenForm.innerHTML = "";
	}
	if(value == "1"){
		ChildrenForm.innerHTML = child1Form;
	}
	if(value == "2"){
		ChildrenForm.innerHTML = child1Form+child2Form;
	}
	if(value == "3"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form;
	}
	if(value == "4"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form;
	}
	if(value == "5"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form;
	}
	if(value == "6"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form+child6Form;
	}
	
}

//=======================================

// show children age dropdowns based on number of children
function room4ChildrenChange(value){

	var ChildrenForm = document.getElementById("room4ChildrenForm");
	
	var child1Form = document.getElementById("room4Child1f").innerHTML;
	var child2Form = document.getElementById("room4Child2f").innerHTML;
	var child3Form = document.getElementById("room4Child3f").innerHTML;
	var child4Form = document.getElementById("room4Child4f").innerHTML;
	var child5Form = document.getElementById("room4Child5f").innerHTML;
	var child6Form = document.getElementById("room4Child6f").innerHTML;
	
	if(value == "0"){
		ChildrenForm.innerHTML = "";
	}
	if(value == "1"){
		ChildrenForm.innerHTML = child1Form;
	}
	if(value == "2"){
		ChildrenForm.innerHTML = child1Form+child2Form;
	}
	if(value == "3"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form;
	}
	if(value == "4"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form;
	}
	if(value == "5"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form;
	}
	if(value == "6"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form+child6Form;
	}
	
}

//=======================================

// show children age dropdowns based on number of children
function room5ChildrenChange(value){

	var ChildrenForm = document.getElementById("room5ChildrenForm");
	
	var child1Form = document.getElementById("room5Child1f").innerHTML;
	var child2Form = document.getElementById("room5Child2f").innerHTML;
	var child3Form = document.getElementById("room5Child3f").innerHTML;
	var child4Form = document.getElementById("room5Child4f").innerHTML;
	var child5Form = document.getElementById("room5Child5f").innerHTML;
	var child6Form = document.getElementById("room5Child6f").innerHTML;
	
	if(value == "0"){
		ChildrenForm.innerHTML = "";
	}
	if(value == "1"){
		ChildrenForm.innerHTML = child1Form;
	}
	if(value == "2"){
		ChildrenForm.innerHTML = child1Form+child2Form;
	}
	if(value == "3"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form;
	}
	if(value == "4"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form;
	}
	if(value == "5"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form;
	}
	if(value == "6"){
		ChildrenForm.innerHTML = child1Form+child2Form+child3Form+child4Form+child5Form+child6Form;
	}
	
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

function RDateForFlight() {
    var RDate = document.getElementById("returnDate").value;
	var DDate = document.getElementById("departureDate").value;
    

    if ((new Date(RDate).getTime() > new Date(DDate).getTime())) {
          return true;
     }
	 
	 if ((new Date(RDate).getTime() <= new Date(DDate).getTime())) {
          alert("The checkout date must be after checkin date");
		  document.getElementById("returnDate").value = "";
          return false;
     }
	 if(DDate == "")
	 {
		 alert("Please select checkin date first.");
		 document.getElementById("returnDate").value = "";
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


function Disabledateforflight()
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
	document.getElementById("departureDate").setAttribute("min", today);
	
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

function Disabledate1ForFlight()
{
	var checkedin = document.getElementById("departureDate").value;
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
	document.getElementById("returnDate").setAttribute("min", today);
	
}


</script>
