<?php
session_start();
	include("connections/config.php");
$q = strtolower($_GET["q"]);
 $partnerID=$_SESSION['partnerID'];
if (!$q) return;

$sql = "select deviceID,deviceNumber FROM device
					WHERE deviceNumber LIKE '$q%'";
					//ul need to add extra filter to ensure can search only for devices belonging  assinged to that patna
$rsd = mysql_query($sql)or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['deviceID'];
	$cname = $rs['deviceNumber'] ;
	echo "$cname|$cid\n";
	
	
	
}
?>
