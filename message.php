<?php
$date=date('d');
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
		if(durationsincelastupload($myarr[$c])!=0){
		$mymsg[$myarr[$c]]="Pending consumption for ".$mydevs[$c]." devices belonging to ".$get[1]." For ".durationsincelastupload($myarr[$c]).        " months";
		}
		else {
			$mymsg[$myarr[$c]]="Pending consumption for ".$mydevs[$c]." devices belonging to ".$get[1]." ";
		
		}
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
 $smsmsent=file_get_contents("http://41.57.109.238:13000/cgi-bin/sendsms?username=clinton&password=ch41sms&to=$phoneNo&text=Alert!+$message.");
if ($smsmsent)
{
echo "success";
}
else
{
echo "Fail";
	}		
}

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
		
		//function to get the last upload
			function LastUploaded($userId,$device){
				$sql="SELECT MAX( MONTH( resultDate ) ) AS MONTH , MAX( YEAR(  `resultDate` ) ) AS year FROM test WHERE partnerID = '".$userId."' AND deviceID =  '".$device."'";
				$query=mysql_query($sql) or die(mysql_error());
				$myarr[]=array();
				while($res=mysql_fetch_array($query)){
					$myarr['1']=$res['MONTH'];
					$myarr['2']=$res['year'];
					
					$today=(date(m)-1);
					$yr=date("Y");
					if($myarr['1']==$today && $myarr['2']==date('Y')){
						$mynum=0;
						}
						else{
							$mynum=1;
							}
						}
					return $mynum;
				
				}
		
		//confrim last
	  		function LastUpload($userid){
				$dev=0;
				$sql="SELECT deviceNumber from device where partnerID='".$userid."'";
				$query=mysql_query($sql) or die(mysql_error());
				$myarr[]=array();
				while($res=mysql_fetch_array($query)){
					 $device=$res['deviceNumber'];
					 $result=LastUploaded($userid,$device);
					$dev+=$result;
					
			}
					return $dev;
				
				}
//function to get last upload
	function durationsincelastupload($patna){
		$sql="SELECT MIN( resultDate ) FROM test WHERE partnerID='".$patna."'";
		$query=mysql_query($sql) or die(mysql_error());
		$dat=mysql_fetch_row($query);
		if(isset($dat[0])){
		$lastDate=$dat[0];
		}
		else{
			$lastDate="2012-01-01";
			}
		$today=date(Y-m-d);
		$diff = abs(strtotime($today) - strtotime($lastDate));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	    return $months;	
		}
//connect to db
function conn(){
 $host="localhost";
		$user="root";
		$pass="";
		$db="cd4";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);
}
if($date>=1 && $date<=30){
conn();
devicependingupload();
}

/*$phoneNo ='254711279778';// from database, ensure its in format 2547********
$message=urlencode("hello world"); // write what we ag=reed, use urlencode($message) to cater for spaces as over shortcode spaces nt recongised.



echo $smsmsent=file_get_contents("http://41.215.78.124:13000/cgi-bin/sendsms?username=clinton&password=ch41sms&to=$phoneNo&text=ff+$message.");


if ($smsmsent)
{
echo "success";
}
else
{
echo "Fail";
}*/

?>  