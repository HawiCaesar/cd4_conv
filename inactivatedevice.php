<?php
require_once('Connections/config.php');


 $deviceAutoID= $_GET["deviceAutoID"];
$deviceNumber= $_GET["devicenumber"];
$act=$_GET["act"];
if($act=="patna"){
	$delrec = mysql_query("UPDATE device SET status=0  WHERE deviceID = '$deviceAutoID' ");
}
else if($act=="admin"){
	$delrec = mysql_query("UPDATE device SET flag=0  WHERE deviceID = '$deviceAutoID' ");
}
 if ( $delrec)
 {
 			$st=  " Device Number : ". $deviceNumber . " Successfully Deactivated";
			header("location:deviceslist.php?successdeletion=$st"); //direct to devices list
			exit();
			

 }
 
 ?>