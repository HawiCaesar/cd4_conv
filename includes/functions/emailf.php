<?php

//check validity of email  
	function isvalid($email){
 $sql="select count(userID) as exist,userName AS user from user where email='".$email."'";
		$query=mysql_query($sql)or die();
		while($res=mysql_fetch_array($query)){
			if($res['exist']==0){
				return $msg="That E-mail address was not found. Please enter the email address used at  registration";
				}
				else{
			 $arr=$res['user'];
			 return $arr;
		}
	  }
	}
	
  //function to generate new random password
	 function generator(){
		  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, strlen($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    return implode($pass);
		  }
	
	
	//sends email  
	  function smtpmail($to,$user) { 
		//generated password
	$pass=$this->generator();
	
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom('alupe.poc@gmail.com', 'POC Admin');
	$mail->Subject = "New login password";
	$mail->Body = "
Hello '".$user."';

Below is the requested login Information 

--------------------------
Your new password: ".$pass."

--
Thanks,
P.O.C System Administrator";
	$mail->AddAddress($to);
		
	if(!$mail->Send()) {
		$msg = 'Mail error: '.$mail->ErrorInfo; 
	} else {
		//reset password to new
	$this->resetPass($pass,$to);
		$msg="New password has been sent";
		
	}
	
	return $msg;
}
	
?>