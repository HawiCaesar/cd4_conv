<?php
$mfl=$_GET['mfl'];
$month=$_GET['month'];
$year=$_GET['year'];
include("commodityapi.php");
$comm= new commodityapi("mine","cd4comm",1,$mfl);
$myarr=$comm->getdevices($mfl,$month,$year);

//$myarr = json_encode($myarr);
//$myarr = stripslashes($myarr);



$myarr= json_encode($myarr);	
echo $myarr;
//echo "<pre>";
// var_dump($myarr);
//echo "</pre>";
?>