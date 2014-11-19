
		<?php
ob_start();
ini_set("max_execution_time",'1000000');
		ini_set("memory_size",'512M');

@include("includes/dbConf.php");
$db=new dbConf();
@require_once('phpmailer/class.phpmailer.php');	
@conn();
$site=$_GET['site'];

$prefix=$_GET['prefix'];
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
$mine=$_SESSION['calibur'];
?>
<html>
	<head></head>
	<body onLoad="javascript:window.print();">

<center>
<table class="data" width="80%" >
<?php


echo physicianrptattr($mine,$prefix,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
?>

</table></center>

</body></html>


<?php





ob_end_flush();
?>