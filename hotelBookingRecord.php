<?php

function insertRecord($db,$customerid,$apiname,$hotelname,$roomname,$bookingid,$bookingfrom,$bookingto,$status,$grossrate,$fname,$lname,$rooms,$type)
{
	if($type == 'customer')
	{
		$sql2 =<<<EOF
		INSERT INTO customer_hotel_order(hotel_name,room_name,api_name,order_status,customer_id,booking_id,booking_from
		,booking_to,gross_rate ,first_name,last_name,rooms) VALUES 
	('{$hotelname}','{$roomname}', '{$apiname}','{$status}' , '{$customerid}' , '{$bookingid}' , '{$bookingfrom}' , '{$bookingto}'
	, '{$grossrate}' , '{$fname}' , '{$lname}' , '{$rooms}');
EOF;
		$ret2 = pg_query($db, $sql2);

			if((!$ret2)) {
				echo pg_last_error($db);
			} 
			else 
			{}
	}
	if($type == 'agent')
	{
		$sql2 =<<<EOF
		INSERT INTO agent_hotel_order(hotel_name,room_name,api_name,order_status,agent_id,booking_id,booking_from
		,booking_to,gross_rate ,first_name,last_name,rooms) VALUES 
	('{$hotelname}','{$roomname}', '{$apiname}','{$status}' , '{$customerid}' , '{$bookingid}' , '{$bookingfrom}' , '{$bookingto}'
	, '{$grossrate}' , '{$fname}' , '{$lname}' , '{$rooms}');
EOF;
		$ret2 = pg_query($db, $sql2);

			if((!$ret2)) {
				echo pg_last_error($db);
			} 
			else 
			{}
	}
	if($type == 'corporate')
	{
		$sql2 =<<<EOF
		INSERT INTO corporate_hotel_order(hotel_name,room_name,api_name,order_status,corporate_id,booking_id,booking_from
		,booking_to,gross_rate ,first_name,last_name,rooms) VALUES 
	('{$hotelname}','{$roomname}', '{$apiname}','{$status}' , '{$customerid}' , '{$bookingid}' , '{$bookingfrom}' , '{$bookingto}'
	, '{$grossrate}' , '{$fname}' , '{$lname}' , '{$rooms}');
EOF;
		$ret2 = pg_query($db, $sql2);
			
	

			if((!$ret2)) {
				echo pg_last_error($db);
			} 
			else 
			{}
	}
			
}

function ShowBookingRecords($db,$id,$type){
	
	
	if($type == 'customer')
	{
	$sql2 =<<<EOF
		SELECT * FROM customer_hotel_order WHERE customer_id ='{$id}' ORDER BY customer_order_id DESC;
EOF;
$retuser1 = pg_query($db, $sql2);	
	}
	
	if($type == 'agent')
	{
	$sql2 =<<<EOF
		SELECT * FROM agent_hotel_order WHERE agent_id ='{$id}';
EOF;
$retuser1 = pg_query($db, $sql2);	
	}
	if($type == 'corporate')
	{
	$sql2 =<<<EOF
		SELECT * FROM corporate_hotel_order WHERE corporate_id ='{$id}';
EOF;
$retuser1 = pg_query($db, $sql2);	
	}


if (!$retuser1) {
    echo "
			<script>
			alert('There is a problem. Please try again.');
			location.replace('index.php');
			</script>
			";
}

if (pg_num_rows($retuser1) == 0) {
    echo "
			<script>
			alert('No Record Found.');
			location.replace('index.php');
			</script>
			";
}

 while ($row1 = pg_fetch_assoc($retuser1)) {
	
   echo '<div class="row" style="padding:2%; margin:2%; background-color:rgba(255,255,255,0.60);">
		<!-- hotel details area below. -->
			<div style="padding-top:1%;" class="col-xs-9 col-md-4">
				<a href="#" class="thumbnail">
				  <img src="https://images.trvl-media.com/media/content/expus/graphics/launch/hotel1320x742.jpg" alt="...">
				</a>
				<h2 class="card-title" style="color:#581845">Hotel Name</h2>
				<h4 class="card-title" style="color:#581845">'.$row1['hotel_name'].'</h4>
			</div>
			<div class="col-xs-9 col-md-4">
			<h4 class="card-title" style="color:#581845">Reference No</h4>
				<p class="card-text" style="margin-left:20%;">'.$row1['booking_id'].'</p>
				<h4 class="card-title" style="color:#581845">Booked By</h4>
				<p class="card-text" style="margin-left:20%;">'.$row1['first_name']. ' ' . $row1['last_name'].'</p>
				<h4 class="card-title" style="color:#581845">From Date</h4>
				<p class="card-text" style="margin-left:20%;">'.$row1['booking_from'].'</p>
				<h4 class="card-title" style="color:#581845">To Date</h4>
				<p class="card-text" style="margin-left:20%;">'.$row1['booking_to'].'</p>
				<h4 class="card-title" style="color:#581845">Rooms</h4>
				<p class="card-text" style="margin-left:20%;">'.$row1['rooms'].'</p>
			</div>
			<!-- hotel details area end-->
			
			<div  class="col-xs-9 col-md-4" >	
				
				 <p class="card-text"><strong>Room Type</strong></p>
				 <p class="card-text">'.$row1['room_name'].'</p>
				 <hr>
				 <h4 class="card-title" style="color:#154360;"><strong>Total:</strong> '.$row1['gross_rate'].' USD</h3>
			</div>
		</div>';
  
   }

}


?>