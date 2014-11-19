<?php
include 'includes/dbConf.php';
$db=new dbConf();
$old=md5($_POST['oldpass']);
$new=md5($_POST['newpass']);
$mfl=$_POST['mfl'];

 $sql="UPDATE facility SET password='$new' WHERE MFLCode='$mfl' AND password='$old'";
$query=mysql_query($sql) or die (mysql_error());
if(mysql_affected_rows()>0){
	$msg="Password has been updated";
	header("location:homecommodity.php?msg=$msg");
}
else {
	$err="Password Not Updated. Ensure you have entered correct details";
	header("location:homecommodity.php?err=$err");
}

?>