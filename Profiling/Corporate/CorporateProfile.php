<?php
<?php

function ShowContactDetails($db,$id){
	
	
	$sql2 =<<<EOF
		SELECT * FROM customer WHERE customer_id ='{$id}';
EOF;
	
$retuser1 = pg_query($db, $sql2);
$cdetail = pg_fetch_assoc($retuser1);
	
	
$sql3 =<<<EOF
		SELECT * FROM address WHERE customer_id ='{$id}';
EOF;
	
$retuser2 = pg_query($db, $sql3);
$adetail = pg_fetch_assoc($retuser2);
	
	
	



if (!$retuser1 || !$retuser2 ) {
    echo "
			<script>
			alert('There is a problem. Please try again.');
			location.replace('index.php');
			</script>
			";
}



/
   //email
   if($cdetail['customer_email']==null || $cdetail['customer_email']=='')
		{
		
		
			$_SESSION['company_email'] = null;
		}
	else
		{
	
			$_SESSION['company_email'] = $cdetail['customer_email'];
		}
   
   //cnic
   
    
   
   //dob
   
    
		
		//cell
	if($cdetail['customer_phone']==null || $cdetail['customer_phone']=='')
		{
		
		
			$_SESSION['customer_phone'] = null;
		}
	else
		{
	
			$_SESSION['customer_phone'] = $cdetail['customer_phone'];
		}
	
	//mobile
	
	if($cdetail['customer_cell']==null || $cdetail['customer_cell']=='')
		{
		
		
			$_SESSION['company_cell'] = null;
		}
	else
		{
	
			$_SESSION['company_cell'] = $cdetail['customer_cell'];
		}
	//country code
	
	
		
		//city
	if($adetail['address_city']==null || $adetail['address_city']=='')
		{
		
		
			$_SESSION['company_address_city'] = null;
		}
	else
		{
	
			$_SESSION['company_address_city'] = $adetail['address_city'];
		}	
		
		//country
		if($adetail['address_country']==null || $adetail['address_country']=='')
		{
		
		
			$_SESSION['company_address_country'] = null;
		}
	else
		{
	
			$_SESSION['company_address_country'] = $adetail['address_country'];
		}
		
		//address line
		if($adetail['address_line']==null || $adetail['address_line']=='')
		{
		
		
			$_SESSION['company_address_line'] = null;
		}
	else
		{
	
			$_SESSION['company_address_line'] = $adetail['address_line'];
		}
		
		
	
   
  
   


}

function updateCustomerDetails($db,$id,$fname,$lname,$cnic,$dob,$gender,$phone,$cell,$countrycode)
{
	$sql2 =<<<EOF
		UPDATE customer 
		SET 
		customer_fname = '{$fname}',
		customer_lname = '{$lname}',
		customer_gender = '{$gender}',
		customer_dob = '{$dob}',
		customer_cnic = '{$cnic}',
		customer_phone = '{$phone}',
		customer_cell = '{$cell}',
		customer_countrycode = '{$countrycode}'
		WHERE 
		customer_id ='{$id}';
EOF;
	$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{

							
						}
	
}

function updateAddress($db,$id,$city,$country,$addressline)
{
	
	$sql2 =<<<EOF
		UPDATE address		
		SET 
		address_line = '{$addressline}',
		address_city = '{$city}',
		address_country = '{$country}'
		WHERE 
		customer_id ='{$id}';
EOF;

$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{

							
						}
	
}




function updatePassword($db,$id,$pass)
{
	
	$sql2 =<<<EOF
		UPDATE customer		
		SET 
		customer_password = '{$pass}'
		WHERE 
		customer_id ='{$id}';
EOF;

$ret2 = pg_query($db, $sql2);
			
	

						if((!$ret2)) {
							echo pg_last_error($db);
						} 
						else 
						{

							
						}
	
}

function ShowCompanyInfo($db,$id)
{
	$sql2 =<<<EOF
		SELECT * FROM corporate WHERE customer_id ='{$id}';
EOF;
	
$retuser1 = pg_query($db, $sql2);
$cdetail = pg_fetch_assoc($retuser1);

$sql2 =<<<EOF
		SELECT * FROM customer WHERE customer_id ='{$id}';
EOF;
	
$retuser2 = pg_query($db, $sql2);
$cdetail2 = pg_fetch_assoc($retuser1);

if (!$retuser1 ) {
    echo "
			<script>
			alert('There is a problem. Please try again.');
			location.replace('index.php');
			</script>
			";
}




//air port
	if($cdetail['corporate_number']==null || $cdetail['corporate_number']=='')
		{
		
		
			$_SESSION['company_registration'] = null;
		}
	else
		{
	
			$_SESSION['company_registration'] = $cdetail['corporate_number'];
		}

		
		
	//Company name
	
	if($cdetail2['customer_fname']==null || $cdetail2['customer_fname']=='')
		{
		
		
			$_SESSION['company_name'] = null;
		}
	else
		{
	
			$_SESSION['company_name'] = $cdetail2['customer_fname'] . ' ' . $cdetail2['customer_lname'] ;
		}
	
	
}


function updateTravelInfo($db,$id,$registration_number, $name)
{
	
	$sql2 =<<<EOF
		UPDATE customer	
		SET 
		customer_fname = '{$name}',
		customer_lname =  ' '
		
		WHERE 
		customer_id ='{$id}';
EOF;

$ret2 = pg_query($db, $sql2);
			
$sql3 =<<<EOF
		UPDATE corporate	
		SET 
		corporate_number = '{$registration_number}',
		
		
		WHERE 
		customer_id ='{$id}';
EOF;

$ret3 = pg_query($db, $sql3);	

						if((!$ret2) || (!$ret3) ) {
							echo pg_last_error($db);
						} 
						else 
						{

							
						}
	
}



?>?>