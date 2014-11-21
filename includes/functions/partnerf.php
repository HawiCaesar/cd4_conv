<?php
//get specific partner 
		function getSpecificPartner($p){
			$sql="select * from partners where ID='".$p."'";
			$executeSql=mysql_query($sql);
			$result=mysql_fetch_array($executeSql);
			$row=array();
			$row[1] = $result['name'];
			$row[2] = $result['phoneNumber'];
			
			return $row;
			
			
			}

function getspecificuser($user){
	$sql="select userName,userGroupID,partnerID,phone,email from user where userID=$user";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	return $row;
	
}

//get all partners 
		function getPartner(){
			$sql="select * from partners";
			$executeSql=mysql_query($sql);
			//$result=mysql_fetch_array($executeSql);
			$myresult=array();
			
			for($i=0;@$result=mysql_fetch_array($executeSql);$i++){
			$myresult[$i]=$result;
				}
			return $myresult;
			
			
			}	

//get next partnerID for login in users table.
		function getNextPartnerId(){
			$sql="select count(ID) from partners";
			$executeSql=mysql_query($sql);
			$result=mysql_fetch_array($executeSql);
			return $result;
			
			}	
			
	
//gets the users in the db
		function getUser(){
			$sql="select * from user, usergroup WHERE user.userGroupID=usergroup.userGroupID";
			$result=mysql_query($sql) or die(mysql_error());
		 	$mytab="";
        	while($rs= mysql_fetch_array($result)){
        		$patna=getSpecificPartner($rs['partnerID']);
         if($rs['status']==1){
	 $status='<a class="changeStatus" title="Disable Account" href="status.php?id='.$rs['userID'].'& name='.$rs['userName'].'& status=0"><img src="../../img/delete.png" /></a>' ;
           	 } else{
					 			 
    $status='<a class="changeStatus" title="Enable Account" href="status.php?id='.$rs['userID'].'& name='.$rs['userName'].'& status=1"><img src="../../img/enable.jpg" width="15" height="15"/>' ;     
			 }
         $mytab=$mytab.'
         <tr>
         <td><center>'.$rs['userName'].'</center></td>
         <td><center>'.$rs['phone'].'</center></td>
         <td><center>'.$rs['email'].'</center></td>
         <td><center>'.$rs['usergroupName'].'</center></td>
         <td><center>'.$patna[1].'</center></td>
         <td><center>'.$status.'</center></td>
         <td><center><a href="" id="Submit" title="Reset Password"><img src="../../img/reset.jpeg"  width="25" height="15" /></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="" id="Submit" title="Change Password"><img src="../../img/changePass.jpg"  width="25" height="15" /></a></center></td>
         <td><center><a href="edituser.php?id='.$rs['userID'].'" title="Edit User"><img src="../../img/edit.png" /></a></center></td>
         </tr>
         ';   

        		}
       		 return $mytab;                                   
			
			}
	

//add user and set his status to 1( active) and if the user is a partner then partnerID is specified
	function addUser($username,$password,$type,$partnerID,$email){
		if($partnerID!=0){
		$sql="INSERT into user(userName,password,userGroupID,partnerID, status,previousPass,email) values ('".$username."','".$password."','".$type."','".$partnerID."','1','".$password."','".$email."')";
		$executeSql=mysql_query($sql);
		if($executeSql){
			echo "success";
			
			}
			else{
				echo "Registration not done";
				}
		}
		else{
		$sql="INSERT into user(userName,password,userGroupID,partnerID,status) values ('".$username."','".$password."','".$type."','0','1')";
		$executeSql=mysql_query($sql);
		if($executeSql){
			echo "success";
			
			}
			else{
				echo "Registration not done";
				}
		}
	}
	
	

		
//add partner
	function addPatner($name,$phone,$email){
		$sql="INSERT into partners(name,phoneNumber,email) values ('".$name."','".$phone."','".$email."')";
		$executeSql=mysql_query($sql);
		if($executeSql){
			echo "success";
			
			}
			else{
				echo "Registration not done";
				}
		
		}
	function edituser($email,$phone,$level,$username,$userID){
		$sql="UPDATE user SET phone='$phone',email='$email',usergroup='$level',username='$username' WHERE userID='$userID'";
		$query=mysql_query($sql) or die(mysql_error());
	}						
?>