<?php
require_once('Connections/config.php');
include("function.php");

$equipmentAutoID= $_GET['equipmentAutoID'];
$eqname=GetEquipmentName($equipmentAutoID);
$AutoFacility= $_GET['facility'];
$sitename=GetFacilityName($AutoFacility);
$level= $_GET['level'];
$centralsiteAutoID= $_GET['centralsiteAutoID'];
$sql=mysql_query("select ID  from  facilityequipments where facility='$AutoFacility' and equipment='$equipmentAutoID'");
$numrows=mysql_num_rows($sql);
if ($numrows > 0)
{
$st=  " Equipment: ". $eqname . " Had Already been Allocated to " .$sitename;
			header("location: facilityequipments.php?facility=$AutoFacility&level=$level&centralsiteAutoID=$centralsiteAutoID &successallocation=$st"); //direct to devices list
			exit();
}
else
{
$addrec = mysql_query("insert into facilityequipments (facility,equipment)  values('$AutoFacility','$equipmentAutoID') ") or die(mysql_error());
 if ( $addrec)
 {
 			$st=  " Equipment: ". $eqname . " Successfully Allocated to " .$sitename;
			header("location: facilityequipments.php?facility=$AutoFacility&level=$level&centralsiteAutoID=$centralsiteAutoID &successallocation=$st"); //direct to devices list
			exit();
 }
}

 ?>