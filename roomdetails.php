<?php


function ShowRooms($array){
	
	$hotelimages = "https://i.ytimg.com/vi/bDpO8i4Aty0/maxresdefault.jpg
	,http://www.hoteliermiddleeast.com/pictures/gallery/Hotels/Wyndham.jpg
	,http://www.dubaichronicle.com/wp-content/uploads/2013/06/The-Operoi-Dubai-Hotel-Room.jpg
	,https://www.parkregiskriskin.ae/files/2012/09/Two-Bedroom-Suites-Twin-Room-Image-.jpg
	,http://www.timeoutdubai.com/thumb/md-9/content/66852/2015_hotelview_1_base.jpg
	,https://cache.emirates247.com/polopoly_fs/1.512997.1452303335!/image/image.JPG
	,https://taj.tajhotels.com/content/dam/luxury/hotels/Taj-Dubai/images/3x2/R_&_S_LUXURY_ROOMS_67395672-H1-2_Luxury_Room_City_View_Twin_Bed-Master.jpg
	,https://media-cdn.tripadvisor.com/media/photo-s/09/68/95/8a/panorama-hotel-bur-dubai.jpg
	,http://bbd9266b5de9fb94565c-009cecf0c2b6c8e3b03e434af3a50dfd.r33.cf1.rackcdn.com/XLGallery/St-Regis-Dubai-Hotel---Executive-Suite---Bedroom.jpg
	,https://media-cdn.tripadvisor.com/media/photo-s/02/93/f2/87/filename-melia-dubai.jpg";
   $paths = explode(",", $hotelimages);
	
  foreach ($array as $value) {
   
    $number = rand(0,9);
	
    echo '
   <div class="row" style="background-color:#E5E7E9; border:2px solid #581845; margin:10px;padding:10px;">
		  <div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
			  <img src='.$paths[$number].' alt="...">
			</a>
		  </div>
		  <div class="col-xs-6 col-md-6">
			<h4 class="card-title"><strong>'.$value[0].'</strong></h4>
			<h4 class="card-title">Room Amenities</h4>
			<p class="card-text">';
			
			foreach ($value[8] as $value1) {
			echo ' <span class="glyphicon glyphicon-certificate" style="font-size:5px;"></span>'.$value1." ";
			}
			
			echo'</p>
		  </div>
		  <div class="col-xs-6 col-md-3">
			
		  <h3 class="card-title">USD '.$value[1].' per Night</h3>
			 
		  <form action = "hotelBooking.php" method = "post">
			<input id="hotelid" name="hotelid" value="'.$value[2].'" type="text" style="display:none;"/>
			<input id="searchid" name="searchid" style="display:none" value="'.$value[3].'" type="text"/>
			<input id="sectionid" name="sectionid" style="display:none" value="'.$value[4].'" type="text"/>
			<input id="classid" name="classid" style="display:none" value="'.$value[5].'" type="text"/>
			<button class="btn btn-info" type="submit" name="Reservation" value="Reservation">Book Now</button>
		  </form>
		  <br><br>
		  <p style="color:red; font-style: italic;"> *free cancellation before '.$value[9].'</p>
			 
		  </div>
		</div>';
 }

}


function ShowAmenities($array){
	
  foreach ($array as $value) {
   
   echo '
   <p class="card-text">'.$value.'</p>';
 }

}

function ShowRooms1($array){
	
	$hotelimages = "https://i.ytimg.com/vi/bDpO8i4Aty0/maxresdefault.jpg
	,http://www.hoteliermiddleeast.com/pictures/gallery/Hotels/Wyndham.jpg
	,http://www.dubaichronicle.com/wp-content/uploads/2013/06/The-Operoi-Dubai-Hotel-Room.jpg
	,https://www.parkregiskriskin.ae/files/2012/09/Two-Bedroom-Suites-Twin-Room-Image-.jpg
	,http://www.timeoutdubai.com/thumb/md-9/content/66852/2015_hotelview_1_base.jpg
	,https://cache.emirates247.com/polopoly_fs/1.512997.1452303335!/image/image.JPG
	,https://taj.tajhotels.com/content/dam/luxury/hotels/Taj-Dubai/images/3x2/R_&_S_LUXURY_ROOMS_67395672-H1-2_Luxury_Room_City_View_Twin_Bed-Master.jpg
	,https://media-cdn.tripadvisor.com/media/photo-s/09/68/95/8a/panorama-hotel-bur-dubai.jpg
	,http://bbd9266b5de9fb94565c-009cecf0c2b6c8e3b03e434af3a50dfd.r33.cf1.rackcdn.com/XLGallery/St-Regis-Dubai-Hotel---Executive-Suite---Bedroom.jpg
	,https://media-cdn.tripadvisor.com/media/photo-s/02/93/f2/87/filename-melia-dubai.jpg";
   $paths = explode(",", $hotelimages);
   
  
	
  foreach ($array as $value) {
   
    $number = rand(0,9);
   
   echo '
   <div class="row" style="background-color:#E5E7E9; border:2px solid #581845; margin:10px;padding:10px;">
		  <div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
			  <img src='.$paths[$number].' alt="...">
			</a>
		  </div>
		  <div class="col-xs-6 col-md-6">
			<h4 class="card-title"><strong>'.$value[2].'</strong></h4>
			<h4 class="card-title">Room Description</h4>
			<p class="card-text">';
			
			foreach ($value[1] as $value1) {
			echo ' <span class="glyphicon glyphicon-certificate" style="font-size:5px;"></span>'.$value1." ";
			}
			
			
			echo'</p>
		  </div>
		  <div class="col-xs-6 col-md-3">
			
			 <h3 class="card-title">USD '.$value[0].' per Night</h3>
			 
			 <form action = "hotelBooking.php" method = "post"
	
	

	<button class="btn btn-info" type="submit" name="Reservation" value="Reservation" disabled>Book Now</button></form>
			 
		  </div>
		  	  
		</div>';
 }

}

function ShowAmenities1($array){
	
  foreach ($array as $value) {   
   
   echo '
   <p glyphicon glyphicon-certificate" >'.$value.'</p>';
 }


}






?>