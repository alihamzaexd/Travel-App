<?php


function SearchData($array){
	
	
	
  foreach ($array as $value) {
	  $comments;
	  if($value[1]== '5.0')
	  {
		  $comments = 'Exceptional';
	  }
	  
	  if($value[1]== '4.0')
	  {
		  $comments = 'Excellent';
	  }
	  if($value[1]== '3.0')
	  {
		  $comments = 'Good';
	  }
	  if($value[1]== '2.0')
	  {
		  $comments = 'Average';
	  }
	  if($value[1]== '1.0')
	  {
		  $comments = 'Below Averagee';
	  }
	  
   
   $hotelimages = "https://www.berjayahotel.com/sites/default/files/styles/gallery_slide/public/johorbahru_34.jpg,
   https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGAhh7jc80WFkgLxaQKs1FABrLJ6IsCQ19lf0tqf14kcRqXnvlVQ,
   https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKZYoSzrdmfxSU64---IWNJWb8PsvtkcIv0DNxzdIO4QCG0qA5
   ,https://t-ec.bstatic.com/images/hotel/max1024x768/546/54686729.jpg
   ,https://media-cdn.tripadvisor.com/media/photo-s/0a/86/fa/97/movenpick-hotel-ibn-battuta.jpg
   ,https://s-ec.bstatic.com/images/hotel/max1024x768/729/72986794.jpg
   ,https://s-ec.bstatic.com/images/hotel/max1024x768/787/78757562.jpg
   ,https://media-cdn.tripadvisor.com/media/photo-s/06/f2/99/63/grand-hyatt-dubai.jpg
   ,https://www.ahstatic.com/photos/8500_ho_01_p_2048x1536.jpg
   ,https://www.dusit.com/dusitthani/dubai/wp-content/blogs.dir/31/files/home/dtdu_home_hero_gracious-thai-hospitality-in-the-heart-of-dubai.jpg";
   $paths = explode(",", $hotelimages);
   
   $number = rand(0,9);
	echo ' <div class="row" style="background-color:rgba(255,255,255,0.60); border:1px solid #581845; margin:10px;padding:10px;">
		  <div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
			  <img src= '.$paths[$number].' alt="...">
			</a>
		  </div>
		  <div class="col-xs-6 col-md-5">
			<h4 class="card-title">'.$value[0].'</h4>
			<form action="hoteldetails.php" method="post">
		   <input type="text" style ="display:none;" id="hotelId" name="hotelId" value="'.$value[3].'"/>
		   <input type="text" style ="display:none;" id="searchId" name="searchId" value="'.$value[4].'"/>
		   <input type="text" style ="display:none;" id="rating" name="rating" value="'.$value[1].'"/>
	
		   <button class="btn btn-info" type="submit" value="Detail" name = "Detail">Hotel Details</button>
		   </form>
			
		  </div>
		  <div class="col-xs-6 col-md-3">
			<h4 class="card-title"><strong>'.$value[1].'</strong>/5 '.$comments .'!</h4>
			 <h3 class="card-title"> USD '.$value[2].' per night</h3>
			 
		  </div>
		</div>';

}
}


function SearchData1($array){
	
  foreach ($array as $value) {
	  $comments;
	  if($value[1]== '5.0')
	  {
		  $comments = 'Exceptional';
	  }
	  
	  if($value[1]== '4.0')
	  {
		  $comments = 'Excellent';
	  }
	  if($value[1]== '3.0')
	  {
		  $comments = 'Good';
	  }
	  if($value[1]== '2.0')
	  {
		  $comments = 'Average';
	  }
	  if($value[1]== '1.0')
	  {
		  $comments = 'Below Averagee';
	  }
	  
   
   $hotelimages = "https://www.berjayahotel.com/sites/default/files/styles/gallery_slide/public/johorbahru_34.jpg,
   https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGAhh7jc80WFkgLxaQKs1FABrLJ6IsCQ19lf0tqf14kcRqXnvlVQ,
   https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKZYoSzrdmfxSU64---IWNJWb8PsvtkcIv0DNxzdIO4QCG0qA5
   ,https://t-ec.bstatic.com/images/hotel/max1024x768/546/54686729.jpg
   ,https://media-cdn.tripadvisor.com/media/photo-s/0a/86/fa/97/movenpick-hotel-ibn-battuta.jpg
   ,https://s-ec.bstatic.com/images/hotel/max1024x768/729/72986794.jpg
   ,https://s-ec.bstatic.com/images/hotel/max1024x768/787/78757562.jpg
   ,https://media-cdn.tripadvisor.com/media/photo-s/06/f2/99/63/grand-hyatt-dubai.jpg
   ,https://www.ahstatic.com/photos/8500_ho_01_p_2048x1536.jpg
   ,https://www.dusit.com/dusitthani/dubai/wp-content/blogs.dir/31/files/home/dtdu_home_hero_gracious-thai-hospitality-in-the-heart-of-dubai.jpg";
   $paths = explode(",", $hotelimages);
   
   $number = rand(0,9);
	echo ' <div class="row" style="background-color:rgba(255,255,255,0.60); border:1px solid #581845; margin:10px;padding:10px;">
		  <div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
			  <img src= '.$paths[$number].' alt="...">
			</a>
		  </div>
		  <div class="col-xs-6 col-md-5">
			<h4 class="card-title">'.$value[0].'</h4>
			<form action="amadeushoteldetails.php" method="post">
		   
		   <input type="text" style ="display:none;" id="link" name="link" value="'.$value[3].'"/>
	
		   <button class="btn btn-info" type="submit" value="Detail" name = "Detail">Hotel Details</button>
		   </form>
			
		  </div>
		  <div class="col-xs-6 col-md-3">
			<h4 class="card-title"><strong>'.$value[1].'</strong>/5 '.$comments .'!</h4>
			 <h3 class="card-title"> USD '.$value[2].' per night</h3>
			 
		  </div>
		</div>';

}
}
function Policy($array){
	
	
	
  foreach ($array as $value) {
   
	
   echo "<tr>
   <td>{$value[0]}</td>
   <td>{$value[1]}</td>
   <td>{$value[2]}</td>
   <td align='center'><form action = 'BookingDetails.php' method = 'post'>
	<input id='hotelid' name='hotelid' value='{$value[3]}' type='text' style='display:none;'/>
	<input id='searchid' name='searchid' style='display:none' value='{$value[4]}' type='text'/>
	<input id='sectionid' name='sectionid' style='display:none' value='{$value[5]}' type='text'/>
	<input id='classid' name='classid' style='display:none' value='{$value[6]}' type='text'/>
	<input id='rate' name='rate' style='display:none' value='{$value[1]}' type='text'/>
	<button class='btn btn-info' type='submit' value='Detail'>Proceed to Booking</button></form></td>
   
   </tr>";
  
   }

}

function ShowBooking($array){
		
  foreach ($array as $value) {
   
   $comments;
	  if($value[9]== '5.0')
	  {
		  $comments = 'Exceptional';
	  }
	  
	  if($value[9]== '4.0')
	  {
		  $comments = 'Excellent';
	  }
	  if($value[9]== '3.0')
	  {
		  $comments = 'Good';
	  }
	  if($value[9]== '2.0')
	  {
		  $comments = 'Average';
	  }
	  if($value[9]== '1.0')
	  {
		  $comments = 'Below Averagee';
	  }
   
	
   echo '<div class="row" style="padding:2%; margin:2%; background-color:rgba(255,255,255,0.60);">
		<!-- hotel details area below. -->
			<div style="padding-top:1%;" class="col-xs-9 col-md-4">
				<a href="#" class="thumbnail">
				  <img src="https://images.trvl-media.com/media/content/expus/graphics/launch/hotel1320x742.jpg" alt="...">
				</a>
				<h3 class="card-title" style="color:#581845">'.$value[5].'</h3>
				<p class="card-text">'.$value[6].'</p>
				<h4 class="card-title"><strong>'.$value[9].'</strong>/5 '.$comments .'</h4>
			</div>
			<div class="col-xs-9 col-md-4">
			<h4 class="card-title" style="color:#581845">Reference No</h4>
				<p class="card-text" style="margin-left:20%;">'.$value[0].'</p>
				<h4 class="card-title" style="color:#581845">Booked by</h4>
				<p class="card-text" style="margin-left:20%;">'.$value[1].'</p>
				<h4 class="card-title" style="color:#581845">From Date</h4>
				<p class="card-text" style="margin-left:20%;">'.$value[2].'</p>
				<h4 class="card-title" style="color:#581845">To Date</h4>
				<p class="card-text" style="margin-left:20%;">'.$value[3].'</p>
				<h4 class="card-title" style="color:#581845">Rooms</h4>
				<p class="card-text" style="margin-left:20%;">'.$value[11].'</p>
			</div>
			<!-- hotel details area end-->
			
			<div  class="col-xs-9 col-md-4" >	
				 <h4 class="card-title" style="color:#154360;"><strong>USD '.$value[10].' per Night </strong></h4>
				
				 <p class="card-text"><strong>Room Type</strong></p>
				 <p class="card-text">'.$value[4].'</p>
				 <hr>
				 <h4 class="card-title" style="color:#154360;"><strong>Total:</strong> '.$value[7].' USD</h3>
			</div>
		</div>';
  
   }


}


?>