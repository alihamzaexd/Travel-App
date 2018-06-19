<?php



class EmailHandler{

/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
	function encrypt_decrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'TravelSolutionsSecretKey';
		$secret_iv = 'TravelSolutionsSecretIv';
		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}

	
	function email($recipientEmail,$recipientName,$userId){	
		$encryptedUserId = $this->encrypt_decrypt("encrypt", $userId); 
		echo "<script> alert('email sending');</script>";
		echo "<script> window.open('http://www.exdnow.com/accaregistrationportal/email/travel_solution_email.php?recipientEmail=".$recipientEmail."&recipientName=".$recipientName."&encryptedUserId=".$encryptedUserId."', '_blank');</script>";
		
	} // end of send email function

} //end of class

	
	
?>