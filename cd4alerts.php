<?php
$host="localhost";
$user="root";
$pass="p@55w0rddv1";
$db="cd4";
//connect
$con=mysql_connect($host,$user,$pass);
//fetch db
$getDb=mysql_select_db($db,$con);

function checkFacilitymfl($mfl){
$sql="select name FROM facility where MFLCode='".$mfl."'";
$querySql=mysql_query($sql);
$result=mysql_fetch_row($querySql);
return $result[0];
}

//check last upload and return difference in days
Function lastcaliburupload($calibur){
	$sql="SELECT max(Date_Analyzed) from  exp_file_data WHERE CytometerSerialNumber='$calibur'";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_row($query);
	$lastupload=$rs[0];
	
	return $lastupload;
	
}

//function to get all registered caliburs and facility information
function facilitycalioburinfo(){
	$sql='SELECT fe.fname, fe.facility, f.MFLCode, f.email, f.partnerID, fe.serialNum FROM facility f, facilityequipments fe
          WHERE f.AutoID = fe.facility AND fe.equipment =2 AND fe.serialNum <> ""';
	$query=mysql_query($sql) or die(mysql_error());
	while ($rs=mysql_fetch_array($query)) {
		//send mails
		sendalertmail($rs['serialNum'],$rs['email'],$rs['MFLCode'],$rs['fname'],$rs['partnerID']);
		
		//echo $rs['MFLCode']." ".$rs['serialNum']."<br />";
	}
}
//message to be sent for calibur upload
function sendcaliburalert($serial,$fac){
	$lastupload=lastcaliburupload($serial);
	$today=date('Y-m-d');
	$diff=((strtotime($today)-strtotime($lastupload))/(60*60*24));
	
	$msg="";
	if(strtotime($lastupload)<strtotime("2012-01-01")){
	$msg="Hello ".$fac.",
	
".$fac." has never done a FACS Calibur upload.
Please upload tests performed as of ".$today .
              "

              Many Thanks,
CD4 Support.";	
	}
	else{
	if($diff>3){
		$today=date('F j, Y',strtotime($today));
		$msg="Hello ".$fac.",

The last upload from ".$fac." for the FACS Calibur was on ".date('F j, Y',strtotime($lastupload))."
Please upload tests performed from ".date('F j, Y',strtotime($lastupload))." to " .$today .
              "              
Many Thanks,
CD4 Support.";
	}
}
	return $msg;
	
}


//message to be sent for fcddr
function sendfcdrralert($mfl){
	$fac=checkFacilitymfl($mfl);
	$msg="";
	if(date(d)> 09 && date(d)<15  ){
	$msg=
	"Hello ".$fac.",
	
The CD4 consumption reporting deadline is 10th of ".date(F).", ".date(Y)." . You have not submitted this month’s report. 
Please submit your report as soon as possible.  

Thank you,
CD4 Support.";	
	
}
	return $msg;
	
}

//get email groups
function getadmins(){
$sql="SELECT * from user where userGroupID=2 AND status=1 AND email IS NOT NULL";		
$query=mysql_query($sql) or die(mysql_error());
$mymails=array();
$count=0;
while ($rs=mysql_fetch_array($query)) {
	$mymails[$count]=$rs['email'];
	$count++;
}


return $mymails;
}
//partner
function getpartnermails($partnerId){
$sql="SELECT * from user where partnerID='$partnerId' AND status=1 AND userGroupID=1 AND email IS NOT NULL";		
$query=mysql_query($sql) or die(mysql_error());
$mymails=array();
$count=0;
while ($rs=mysql_fetch_array($query)) {
	$mymails[$count]=$rs['email'];
	$count++;
}


return $mymails;
}

//get facility users to send to
function getfacilitymails($mfl){
$sql="SELECT * from  facilityusers WHERE mfl='$mfl'";		
$query=mysql_query($sql) or die(mysql_error());
$mymails=array();
$count=0;
while ($rs=mysql_fetch_array($query)) {
	$mymails[$count]=$rs['email'];
	$count++;
}


return $mymails;
}

//Nascop
function getnascopmails(){
$sql="SELECT * from user where status=1 AND userGroupID=4 AND email IS NOT NULL";		
$query=mysql_query($sql) or die(mysql_error());
$mymails=array();
$count=0;
while ($rs=mysql_fetch_array($query)) {
	$mymails[$count]=$rs['email'];
	$count++;
}


return $mymails;
}

function sendalertmail($serial,$sender,$prefix,$fac,$patna){
$msg=	sendcaliburalert($serial,$fac);
	
@require_once('phpmailer/class.phpmailer.php');	
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->FromName = $myname;
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'cd4system@gmail.com';
//$mail->$From='alupe.poc@gmail.com';
$mail->Password = 'pocpassword';
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465;  
$senders=getfacilitymails($prefix);
foreach($senders as $key=> $value0){
$mail->AddAddress($value0);
}
$partner=getpartnermails($patna);
$nascop=getnascopmails();	
foreach($partner as $key=> $value)
{
	
   $mail->AddCC($value);
   
}

foreach($nascop as $key=> $value2)
{
	
   $mail->AddCC($value2);
   
}
	
$admins=getadmins();
foreach($admins as $key=> $value3)
{
	
   $mail->AddBCC($value3);
   
}

$mail->Subject = "Calibur Result Upload alerts for ".$fac;
$mail->IsHTML(false);
$mail->Body =$msg;
if(!$mail->Send())
{
   $errorsending= $mail->ErrorInfo;
ECHO   $errorsending;
     
}
else
{ 
ECHO "SUCCESS";
 
}


//exit;
	
}


//send alerts on fcdrr upload
function sendfcdrralertmail($mfl,$patna,$sender){
$msg=	sendfcdrralert($mfl);
@require_once('phpmailer/class.phpmailer.php');	
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->FromName = $myname;
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'cd4system@gmail.com';
//$mail->$From='alupe.poc@gmail.com';
$mail->Password = 'pocpassword';
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465;  
$senders=getfacilitymails($mfl);
foreach($senders as $key=> $value0){
$mail->AddAddress($value0);
}
$partner=getpartnermails($patna);
$nascop=getnascopmails();	
foreach($partner as $key=> $value)
{
	
   $mail->AddCC($value);
   
}

foreach($nascop as $key=> $value2)
{
	
   $mail->AddCC($value2);
   
}
	
$admins=getadmins();
foreach($admins as $key=> $value3)
{
	
   $mail->AddBCC($value3);
   
}
$fac=checkFacilitymfl($mfl);
$mail->Subject = "Commodity Reporting Upload alerts for ".$fac;
$mail->IsHTML(false);
$mail->Body =$msg;
if(!$mail->Send())
{
   $errorsending= $mail->ErrorInfo;
ECHO   $errorsending;
     
}
else
{ 
ECHO "SUCCESS";
 
}


//exit;
	
}


//send messages about commodity reporting
	function lateFDRRsubmission(){
	//$date	
	$sql="SELECT * FROM facility where `rolloutstatus`=1";
	$query=mysql_query($sql) or die(mysql_error());
	while ($rs=mysql_fetch_array($query)) {
		//check mfl and send messageh
		checkforupload($rs['MFLCode'],$rs['partnerID'],$rs['email']);
	}
	}

//function to check whether facility has submitted report before the 10th deadline
function checkforupload($mfl,$patna,$mail){
	$year=date(Y);
	$day=date(d);
	$month=date(m)-1;
	$sql="SELECT count(*) from fcdrrlists where mflcode='$mfl' AND month(todate)=$month AND year(todate)=$year";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_row($query);
	if($rs[0]==0 && $day<=15){
		//didnt report
	 sendfcdrralertmail($mfl,$patna,$mail);	
	//echo 'upload done';	
	}
	else {
		echo "result upload made";
	}	 
	
}

//facilitycalioburinfo();
//send messages about commodity reporting
	function updatefacilitywithpartners(){
	$sql="SELECT facilitys.facilityid,facilitys.facilitycode,facilitys.facilityname,facilitys.partner,facility.MFLCode from facilitys,facility where facilitys.facilitycode=facility.MFLCode and facility.mflcode > 0";
	$query=mysql_query($sql) or die(mysql_error());
	while ($rs=mysql_fetch_array($query)) {
		 uploaddetpatner($rs['partner'],$rs['MFLCode']);
	}
	
	}
	function uploaddetpatner($partner,$mfl){
	$sql="update facility SET partnerID='$partner' WHERE MFLCode='$mfl' ";	
	$query=mysql_query($sql) or die(mysql_error());
	}
//if( (date(m)==12&&date(d)<20)||(date(m)==1&&date(d)>5)||date(m)<1 ||date(m)>1){
if( date(m)>0){
lateFDRRsubmission();
facilitycalioburinfo();

}
//checkforupload(11289);
?>
