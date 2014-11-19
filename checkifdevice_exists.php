<?php
session_start();
require_once('function.php');
require_once("includes/dbConf.php");
$db = new dbConf();
//value got from the get metho
$devicenum=$_POST['devicenum'];
$partnerid=$_SESSION['userID'];
//$user_name="ffrrrr556";and samples.flag=1

$getrecords=@mysql_query("select deviceID,deviceNumber,location  from device where deviceNumber='$devicenum' and partnerID='$partnerid' ")or die(mysql_error());

$noofrecords=mysql_num_rows($getrecords);

//checking weather device num exists or not 

if ($noofrecords > 0 ) //existing
{
 while(list($deviceID,$deviceNumber,$location)=mysql_fetch_array($getrecords))
 {
$devicelocation=getdevicelocation($location);
 //device num  alredy exisiting
$d= "The Device Number ".'<U>'. $deviceNumber. '</U>'. " already exists" .'<br/>'
." Location:". '<U>'.$devicelocation . '</U>'.'<br/>'."Do not Proceed to Save the Device.";
echo $d .'<br/>';
}
}
else
{


  //patient doesnt exist
  //echo "yes";
}
?>