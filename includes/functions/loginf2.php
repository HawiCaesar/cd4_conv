<?php

//login function
		function login($username,$password){
			$loginSql="select username,userID,userGroupID,partnerID,status,partnerID FROM user where username='$username' AND password='$password' LIMIT 1";
     		$login=mysql_query($loginSql) or die(mysql_error());
			$loginContent=mysql_fetch_row($login);
			/*echo "<br />";
			print_r($loginContent);*/
			//checks there is such a user
     		if($loginContent==""){
		$loginSql="select passChangeDate FROM user where username='$username' AND previousPass='$password' LIMIT 1";
     		$login=mysql_query($loginSql) or die(mysql_error());
			$loginContent1=mysql_fetch_row($login);
			if($loginContent1!=""){
			$date1 = date('Y-m-d');
			$date2 = $loginContent1['1'];
			$diff = abs(strtotime($date1) - strtotime($date2));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24*3));
			$days = floor($diff / (60*60*24));
			//printf("%d years, %d months, %d days\n", $years, $months, $days);
			echo "Password was changed ".$months." days ago";
			}else{
	 $output=false;
     echo "Username and/or Password incorrect ";
	 
	   }
			}
			
			
     		else if($loginContent!="" && $loginContent['4']=='1'){
				//die(var_dump($loginContent['username']));
			//sessions
        	$_SESSION['username']=$loginContent['0'];
			$_SESSION['userRights']=$loginContent['2'];
			$_SESSION['userNo']=$loginContent['1'];
			
			systemAccess($loginContent['0'],$loginContent['1'],"program");
			if($loginContent['3']!=0){
			$_SESSION['userID']=$loginContent['3'];
			
			}
			
//checks level of user and whether acount is active
			if( $loginContent['2']==1){
			$redirect="homepage.php";
			header("Location:".$redirect);
			}
			
			else if($loginContent['2']==2){
			$redirect="homeAdmin.php";	
			header("Location:".$redirect);
			}
						
			else if($loginContent['2']==4){
			$redirect="homeAdmin.php";	
			header("Location:".$redirect);
			}
						
			else if($loginContent['2']==3){
			$redirect="homeAdmin.php";	
			header("Location:".$redirect);
			}
			
			else if($loginContent['2']==5){
			$redirect="homeprogram.php";	
			header("Location:".$redirect);
			}
			$output=true;
	if($loginContent['1']!=""){
		addlog($loginContent['1']);
	 }

	 }
	 else if($loginContent!="" && $loginContent['4']=='0'){
		 echo "Account is disabled. Contact Administrator "; 
		 }
	 
	   return $output;
			
  }
  
  
//change password
			function changePassword($user,$newpass,$date,$pass){
		$sql="UPDATE user SET password='".$newpass."', previousPass='".$pass."'  WHERE  userID='".$_SESSION['userNo']."'  AND password='".$pass."' ";
			$execSql=mysql_query($sql) or die (mysql_error());	
			if(mysql_affected_rows()>0){
				$msg="2";
				}
			else{
				$msg="1";
				}
				return $msg;
			
				}

			
//check the partner's username to ensure it is unique
		function checkUsername($user){
			$sql="select count(userName) from user where userName='".$user."'";
			$executeSql=mysql_query($sql);
			$result=mysql_fetch_array($executeSql);
			return $result;
			
			
			}
			
			
//function to change status
			function changeStatus ($user, $currentStatus){
				$newStatus = 0;
				if($currentStatus==1){
					$newStatus=0;
				}
				else if($currentStatus==0){
					$newStatus=1;
					
				}
				$sql="UPDATE  `user` SET  `status` =  '".$newStatus."' WHERE  `user`.`userID` ='".$user."'";
				$executeUpdate=mysql_query($sql);
				
			}
			

//function to add last login
	function chkLogin($user,$pass){
	$mysqldate = date( 'Y-m-d');
	$query = "UPDATE user SET lastLogin = '".$mysqldate."' WHERE userName='".$user."' and password='".$user."'";
	mysql_query($query);
	return 0;	
		
		}
		
//gets the userlevels to be echoed during the partner registration
		function getUsergroup(){
			$sql="select * from usergroup";
			$result=mysql_query($sql);
		 	$res_array = array();
        	for($count = 0; @$row = mysql_fetch_array($result); $count++)  {   
            $res_array[$count] = $row;
        		}
       		 return $res_array;    
			
			}
				
//resets pssword
	function resetPass($pass1, $email){
	$pass=md5($pass1);
	$date=date('Y-m-d');
	$sql="UPDATE user SET password='".$pass."', passChangeDate='".$date."', WHERE email='".$email."'";	
	$query=mysql_query($sql) or die(mysql_error());
		
		}	

    function addlog($user){
    	$date2=date('Y-m-d');
    	$sql="INSERT INTO userlog(userID,date) VALUES('$user','$date2')";		
		$query=mysql_query($sql) or die();
    		
    	
    }	
	
	
	function systemAccess($username,$userID,$level){
	$sql="INSERT INTO accesslog(username,userID,logoutTime,`loginTime`,level) VALUES('$username',$userID,now(),now(),'$level')";			
	$query=mysql_query($sql) or die(mysql_error());		
		
	}	
	
	
	function getUserlog(){
	$sql="SELECT * FROM accesslog ORDER BY `loginTime` DESC LIMIT 10000";	
	$query=mysql_query($sql) or die(mysql_error());
	$myt="";
	$count=1;
	while($rs=mysql_fetch_array($query)){
	 $mytab='<tr>
	 <td>'.$count.'</td>
	 <td>'.$rs['username'].'</td>
	 <td>'.$rs['level'].'</td>
	 <td>'.$rs['loginTime'].'</td>
	 <td>'.$rs['logoutTime'].'</td>
	 </tr>';	
	$myt=$myt.$mytab;	
	$count++;
	}
	return $myt;		
		
	}					
?>