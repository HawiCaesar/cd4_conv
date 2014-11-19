<?php
session_start();
	include("connections/config.php");
$q = strtolower($_GET["q"]);
 $partnerID=$_SESSION['userID'];
if (!$q) return;

$sql = "select facilityID,facilityName FROM facilitys
					WHERE facilityName LIKE '$q%' AND level=0 AND partner='".$partnerID."'";
					//ul need to add extra filter to ensure can search only for devices belonging  assinged to that patna
$rsd = mysql_query($sql)or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['facilityID'];
	$cname = $rs['facilityName'] ;
	echo "$cname|$cid\n";
	 
	
	
}
?>
