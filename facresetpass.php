<?php
include 'includes/dbConf.php';
$db=new dbConf();
$new=md5($_POST['newpass']);
$mfl=$facilitycode;

$sql="UPDATE facility SET password='$new' WHERE MFLCode='$mfl'";
$query=mysql_query($sql) or die (mysql_error());

if(mysql_affected_rows()>0){
	$msg="Your password has been reset to 123456";
	header("location:facilitylogin.php?msg=$msg");
}
else {
	$err="Password Not Updated. Ensure you have entered the correct facility name";
	header("location:forgot.php?err=$err");
}
?>