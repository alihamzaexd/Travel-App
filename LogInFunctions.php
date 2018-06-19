<?php

function CheckUserName($uname,$db)
{

	$sql2 =<<<EOF
		SELECT customer_salutation,customer_fname,customer_lname FROM customer WHERE customer_email ='{$uname}';
EOF;
	
$retuser1 = pg_query($db, $sql2);
$Emailrow = pg_fetch_row($retuser1);
	
	
	if((!$Emailrow))
	{
	
		return false;
	}
	if(($Emailrow))
	{	$_SESSION['salutation'] = $Emailrow[0];
		$_SESSION['customerFirstName'] = $Emailrow[1];
		$_SESSION['customerLastName'] = $Emailrow[2];
		return true;
					
	}	
	
}


function CheckPassword($uname,$pass,$db)
{

	$sql2 =<<<EOF
		SELECT * FROM customer WHERE customer_email ='{$uname}';
EOF;
	
$retuser1 = pg_query($db, $sql2);
$Emailrow = pg_fetch_row($retuser1);
	
	
	if(($Emailrow[3] == $pass))
			{
				
				return true;
				
			
			}
		else
			{
				return false;
			}

	
}


function CheckVerified($uname,$db)
{

	$sql2 =<<<EOF
		SELECT * FROM customer WHERE customer_email ='{$uname}';
EOF;
	
$retuser1 = pg_query($db, $sql2);
$Emailrow = pg_fetch_row($retuser1);
	
	
	if(($Emailrow[17] == 'yes'))
			{
				
				return true;
				
			
			}
		else
			{
				return false;
			}

	
}


function type($uname,$db)
{
	$sql5 =<<<EOF
		SELECT * FROM customer WHERE customer_email ='{$uname}';
EOF;
	$result = pg_query($db,$sql5);
	$name = pg_fetch_row($result);
	$type = $name[16];
	return $type;	
}



function getname($uname,$db)
{
	
$sql5 =<<<EOF
		SELECT * FROM customer WHERE customer_email ='{$uname}';
EOF;
$result = pg_query($db,$sql5);
$name = pg_fetch_row($result);
$firstname = $name[0];
$lastname = $name[1];
$fullname = $firstname . ' ' . $lastname;
return $fullname;

}

function SetPersonalInfo($salutation,$gender,$mobile,$db)
{
	
	$sql2 ="
		UPDATE customer SET customer_salutation = '{$salutation}',customer_gender = '{$gender}', customer_cell = '{$mobile}' WHERE customer_id = '{$_SESSION['userSessionId']}';
";
		$ret2 = pg_query($db, $sql2);

		if((!$ret2)) {
			echo pg_last_error($db);
		} 
		else 
	
		{
			echo "
			<script>
			location.replace('index.php');
			</script>
			";
		} 

}


function getCustomerId($email,$db)
{
	
$sql1 =<<<EOF
				SELECT customer_id FROM customer WHERE customer_email ='{$email}';
EOF;
			$ret3 = pg_query($db, $sql1);
			$customer = pg_fetch_assoc($ret3);
			$id = $customer['customer_id'];
			return $id;

}


function getAgentId($email,$db)
{
	
	$id = getCustomerId($email,$db);
$sql1 =<<<EOF
				SELECT agent_id FROM agent WHERE customer_id ='{$id}';
EOF;
			$ret3 = pg_query($db, $sql1);
			$customer = pg_fetch_assoc($ret3);
			$id = $customer['agent_id'];
			return $id;

}

function getCorporateId($email,$db)
{
	
	$id = getCustomerId($email,$db);
$sql1 =<<<EOF
				SELECT corporate_id FROM corporate WHERE customer_id ='{$id}';
EOF;
			$ret3 = pg_query($db, $sql1);
			$customer = pg_fetch_assoc($ret3);
			$id = $customer['corporate_id'];
			return $id;

}




?>