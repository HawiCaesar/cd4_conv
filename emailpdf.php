<?php
include("includes/dbConf.php");
$mi=new dbConf();
$resultReport1=totallistingbycategory($ers,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);

?>