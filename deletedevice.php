<?php
require_once('Connections/config.php');


 $deviceAutoID= $_GET["deviceAutoID"];
$deviceNumber= $_GET["devicenumber"];
 $delrec = mysql_query("delete from device  WHERE deviceID = '$deviceAutoID' ");
 if ( $delrec)
 {
 			$st=  " Device Number : ". $deviceNumber . " Successfully Deleted";
			header("location:deviceslist.php?successdeletion=$st"); //direct to devices list
			exit();
			

 }
 
 ?>