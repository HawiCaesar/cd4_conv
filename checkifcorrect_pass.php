<?php
session_start();
require_once('function.php');
require_once("includes/dbConf.php");
$db = new dbConf();
//value got from the get metho
$password=md5($_POST['oldPass']);
//$user_name="ffrrrr556";and samples.flag=1
$sql="select count(userID) as user from user where userID='".$_SESSION['userNo']."' and password='$password' ";
$getrecords=@mysql_query($sql)or die(mysql_error());

$noofrecords=mysql_fetch_row($getrecords);

//checking weather device num exists or not 

if ($noofrecords['0'] ==0 ) //existing
{
 
 //wrong initial password
$d= "Wrong Password entered .";
echo $d .'<br/>';

}
else
{
}
?>