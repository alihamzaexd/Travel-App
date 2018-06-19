<?php


function ShowFlights($array){
		
  foreach ($array as $value) {
   
	echo '<div class="row" style="background-color:rgba(255,255,255,0.60); border:1px solid #581845; margin:10px;padding:10px;">
		  <div class="col-xs-6 col-md-4">
			<h3 class="card-title">'.$value[3].' To '.$value[4].'</h3>
			<h4 class="card-title"><strong>Arrival: </strong>'.$value[1].'</h4>
			<h4 class="card-title"><strong>Departure: </strong>'.$value[2].'</h4>
		  </div>
		  <div class="col-xs-6 col-md-4" style="padding-top:8px;">
			<h5 class="card-title"><strong>Type: </strong>'.$value[0].' </h5>
			<h5 class="card-title"><strong>Number:</strong>'.$value[5].' </h5>
			<h5 class="card-title" style="color:#154360;"><strong>'.$value[6]. ' Class</strong></h5>
			<h5 class="card-title" style="color:#186015;"><strong>'.$value[7]. ' seats left !</strong></h5>
			
		  </div>
		  <div class="col-xs-6 col-md-4">
			 <h3 class="card-title">'.$value[8]. ' USD</h3>
			
	
		   <button class="btn btn-info" type="submit" value="Detail" name = "Detail">Book</button>
		   
			 
		  </div>
		</div>';
  
   }


}



function ShowFlights2($db,$array){	
  foreach ($array as $value) {
	  
	  $size = sizeof($value);
	  $size = $size-1;
	  
	  $dcity = getCity($db,$value[0][3]);
	  $acity = getCity($db,$value[$size][4]);
	  
	  echo '<div class="row" style="background-color:rgba(255,255,255,0.60); border:1px solid #581845; margin:10px;padding:10px;">
		  <div class="col-xs-6 col-md-4">
			<h3 class="card-title">'.$dcity.' To '.$acity.'</h3>
			<h4 class="card-title"><strong>Departure: </strong>'.$value[0][1].' </h4>
			<h4 class="card-title"><strong>Arrival: </strong>'.$value[$size][2].'</h4>
		  </div>
		  <div class="col-xs-6 col-md-4" style="padding-top:8px;">
			<h5 class="card-title"><strong>Type: </strong>'.$value[0][0].'</h5>
			<h5 class="card-title"><strong>Number:</strong>'.$value[0][5].' </h5>
			<h5 class="card-title" style="color:#154360;"><strong>'.$value[0][6]. '</strong></h5>
			
		  </div>
		  <div class="col-xs-6 col-md-4">
			<h3 class="card-title">'.$value[0][8]. ' USD</h3>	
		    <button class="btn btn-info" type="submit" value="Detail" name = "Detail">Book</button>			 
		  </div>
		  <div class="col-md-12" >
			<a onclick="myFunction(this)" >Flight details >></a>
			<br></br>';
			
		for($i=0;$i<sizeof($value);$i++)
		{
	
			$dcity = getCity($db,$value[$i][3]);
			$acity = getCity($db,$value[$i][4]);
			echo
			'<div class="col-md-12" style="display:none; background-color:white; padding-bottom:10px; padding-top:10px;">
				<h3 class="card-title">'.$value[$i][1].' To '.$value[$i][2].'</h3>
				<div style="padding-left:20%;">
					<h4 class="card-title">'.$dcity.' To '.$acity.'</h4>
					<h5 class="card-title" style="color:#186015;"> <strong> Flight # '.$value[$i][5]. ' </strong></h5>
					<h5 class="card-title" style="color:#154360;"><strong>'.$value[$i][6]. '</strong></h5>
					<h5 class="card-title" style="color:#186015;"><strong>'.$value[$i][7]. ' seats left !</strong></h5>';
					
					
					if(isset($value[$i+1]))
					{
						$datetime1 = new DateTime( $value[$i][2]);//start time
						$datetime2 = new DateTime( $value[$i+1][1]);//end time
						$interval = $datetime1->diff($datetime2);
						echo'<h4 class="card-title"><strong> '.$interval->format('%Hh %im').' stop</strong></h4>
						</div>
						</div>';
					}
					
					else
					{
						echo'<h4 class="card-title"><strong></strong></h4>
						</div>
						</div>';
						
					}
					
			
		}		
		  echo '</div></div>';
		  
  }
	  
   
	
  
   


}



?>