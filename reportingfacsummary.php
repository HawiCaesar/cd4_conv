<?php

$year=$_GET['year'];
$month=$_GET['month'];
include("commodityapi.php");
$comm= new commodityapi("mine","cd4comm",1,$mfl);
$myarr=$comm->countydets($month,year);

//$myarr = json_encode($myarr);
//$myarr = stripslashes($myarr);



$myarr= json_encode($myarr);	
echo $myarr;
//echo "<pre>";
// var_dump($myarr);
//echo "</pre>";
?>