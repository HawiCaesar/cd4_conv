<?php
//find all registered users with partners to send them upload prompts
function getUserstoMessage(){
	$sql="SELECT DISTINCT  `partnerID` FROM  `user` WHERE partnerID <>0";
	$myarr=array();
	$counter=0;
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
		$myarr[$counter]=$rs['partnerID'];
		$counter++;
		}
		return $myarr;
	}
//check number of devices pending upload
function devicependingupload(){
	//array to hold users
	$myarr=getUserstoMessage();
	//array to hold messages to be sent. Its index is partner ID
	$mymsg=array();
	//array having specific devices wainting consumption
	$mydevs=array();
	for($c=0;$c<sizeof($myarr);$c++){
		$get=getSpecificPartner($myarr[$c]);
		$mydevs[$c]=LastUpload($myarr[$c]);
		if($mydevs[$c]!=0){
			//message.
		$mymsg[$myarr[$c]]="Pending consumption for ".$mydevs[$c]." devices belonging to ".$get[1]." For ".durationsincelastupload($myarr[$c]).        " months";
		$phone=sendsmsto("uploads",$mymsg[$myarr[$c]],$myarr[$c]);
			}
		}
	}

//specifies the group you are sending messages to	
function sendsmsto($type,$msg,$patna){
	if($type=="uploads"){
	 $sql="SELECT phone FROM `user` WHERE userGroupID =2 OR partnerID ='$patna' OR userGroupID =5";
	}
	if($type=="admin"){
	$sql="SELECT phone FROM  `user` WHERE userGroupID =2 OR userGroupID =5";	
		}
	$q=mysql_query($sql);
	while($rs=mysql_fetch_array($q)){
		if($rs['phone']!=""){
		sendMsg($rs['phone'],$msg);
		}
		}
		//return $arr;
	}
	//function to send message
function sendMsg($phoneNo,$msg){
$message=urlencode($msg); // write what we agreed, use urlencode($message) to cater for spaces as over shortcode spaces nt recongised.
 $smsmsent=file_get_contents("http://41.57.109.238:13000/cgi-bin/sendsms?username=clinton&password=ch41sms&to=$phoneNo&text=ff+$message.");
if ($smsmsent)
{
echo "success";
}
else
{
echo "Fail";
	}		
}
?>