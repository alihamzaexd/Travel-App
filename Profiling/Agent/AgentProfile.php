<?php

function ShowPersonalDetails($db,$id){
	
	
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



//fname
	if($cdetail['customer_fname']==null || $cdetail['customer_fname']=='')
		{
		
		
			$_SESSION['customer_fname'] = null;
		}
	else
		{
	
			$_SESSION['customer_fname'] = $cdetail['customer_fname'];
		}
 
  //lname
  
	if($cdetail['customer_lname']==null || $cdetail['customer_lname']=='')
		{
		
		
			$_SESSION['customer_lname'] = null;
		}
	else
		{
	
			$_SESSION['customer_lname'] = $cdetail['customer_lname'];
		}
   
   //email
   if($cdetail['customer_email']==null || $cdetail['customer_email']=='')
		{
		
		
			$_SESSION['customer_email'] = null;
		}
	else
		{
	
			$_SESSION['customer_email'] = $cdetail['customer_email'];
		}
   
   //cnic
   
    if($cdetail['customer_cnic']==null || $cdetail['customer_cnic']=='')
		{
		
		
			$_SESSION['customer_cnic'] = null;
		}
	else
		{
	
			$_SESSION['customer_cnic'] = $cdetail['customer_cnic'];
		}
   
   //dob
   
    if($cdetail['customer_dob']==null || $cdetail['customer_dob']=='')
		{
		
		
			$_SESSION['customer_dob'] = null;
		}
	else
		{
	
			$_SESSION['customer_dob'] = $cdetail['customer_dob'];
		}
		
		//gender
	
   if($cdetail['customer_gender']==null || $cdetail['customer_gender']=='')
		{
		
		
			$_SESSION['customer_gender'] = null;
		}
	else
		{
	
			$_SESSION['customer_gender'] = $cdetail['customer_gender'];
		}
		
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
		
		
			$_SESSION['customer_cell'] = null;
		}
	else
		{
	
			$_SESSION['customer_cell'] = $cdetail['customer_cell'];
		}
	//country code
	
	if($cdetail['customer_countrycode']==null || $cdetail['customer_countrycode']=='')
		{
		
		
			$_SESSION['customer_countrycode'] = null;
		}
	else
		{
	
			$_SESSION['customer_countrycode'] = $cdetail['customer_countrycode'];
		}
		
		//city
	if($adetail['address_city']==null || $adetail['address_city']=='')
		{
		
		
			$_SESSION['address_city'] = null;
		}
	else
		{
	
			$_SESSION['address_city'] = $adetail['address_city'];
		}	
		
		//country
		if($adetail['address_country']==null || $adetail['address_country']=='')
		{
		
		
			$_SESSION['address_country'] = null;
		}
	else
		{
	
			$_SESSION['address_country'] = $adetail['address_country'];
		}
		
		//address line
		if($adetail['address_line']==null || $adetail['address_line']=='')
		{
		
		
			$_SESSION['address_line'] = null;
		}
	else
		{
	
			$_SESSION['address_line'] = $adetail['address_line'];
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

function ShowAgentInfo($db,$id)
{
	$sql2 =<<<EOF
		SELECT * FROM agent WHERE customer_id ='{$id}';
EOF;
	
$retuser1 = pg_query($db, $sql2);
$cdetail = pg_fetch_assoc($retuser1);

if (!$retuser1 ) {
    echo "
			<script>
			alert('There is a problem. Please try again.');
			location.replace('index.php');
			</script>
			";
}




//air port
	if($cdetail['agent_ntn']==null || $cdetail['agent_ntn']=='')
		{
		
		
			$_SESSION['ntn_number'] = null;
		}
	else
		{
	
			$_SESSION['ntn_number'] = $cdetail['agent_ntn'];
		}
	
	//setting pref
	if($cdetail['agent_limit']==null || $cdetail['agent_limit']=='')
		{
		
		
			$_SESSION['credit_limit'] = null;
		}
	else
		{
	
			$_SESSION['credit_limit'] = $cdetail['agent_limit'];
		}
		
	//special_assit
	if($cdetail['agent_credit']==null || $cdetail['agent_credit']=='')
		{
		
		
			$_SESSION['available_credit'] = null;
		}
	else
		{
	
			$_SESSION['available_credit'] = $cdetail['agent_credit'];
		}
	
	
	//passport_country
	
	
	
	
}


function updateAgentInfo($db,$id,$ntn,$limit,$credit)
{
	
	$sql2 =<<<EOF
		UPDATE agent		
		SET 
		agent_ntn = '{$ntn}',
		agent_credit = '{$credit}',
		agent_limit = '{$limit}'

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



?>