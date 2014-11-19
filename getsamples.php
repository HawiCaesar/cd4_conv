<?php
session_start();
	include("connections/config.php");
$q = strtolower($_GET["q"]);
 $partnerID=$_SESSION['partnerID'];
if (!$q) return;

$sql = "select testID,sampleNumber FROM test
					WHERE sampleNumber LIKE '$q%'";
					//ul need to add extra filter to ensure can search only for samples belonging to the facilities/devices assinged to that patna
$rsd = mysql_query($sql)or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['testID'];
	$cname = $rs['sampleNumber'] ;
	echo "$cname|$cid\n";
	
	
	
}
?>
