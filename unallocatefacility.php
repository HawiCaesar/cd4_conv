<?php
require_once('Connections/config.php');

 $facilityID= $_GET["facilityID"];
 $deviceAutoID= $_GET["deviceAutoID"];
 $fname= $_GET["fname"];
$deviceNumber= $_GET["devicenumber"];
 $delrec = mysql_query("delete from deviceallocation  WHERE facility = '$facilityID' and deviceid=' $deviceAutoID'");
 if ( $delrec)
 {
 			$st=  $fname. " Has been Unallocacted from Device Number : ". $deviceNumber;
			header("location:deviceperfacility.php?ID=$deviceAutoID&deviceNumber=$deviceNumber&successunallocation=$st"); //direct to devices list
			exit();
			

 }
 
 ?>