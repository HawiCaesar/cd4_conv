<?php
require_once('Connections/config.php');
include("function.php");

$equipmentAutoID= $_GET['equipmentAutoID'];
$eqname=GetEquipmentName($equipmentAutoID);
$AutoFacility= $_GET['facility'];
$sitename=GetFacilityName($AutoFacility);
$level= $_GET['level'];
$centralsiteAutoID= $_GET['centralsiteAutoID'];
$delrec = mysql_query("delete from facilityequipments  WHERE facility = '$AutoFacility' AND equipment='$equipmentAutoID' ");
 if ( $delrec)
 {
 			$st=  " Equipment: ". $eqname . " Successfully Removed from " .$sitename;
			header("location: facilityequipments.php?facility=$AutoFacility&level=$level&centralsiteAutoID=$centralsiteAutoID &successdeletion=$st"); //direct to devices list
			exit();
			

 }

 ?>