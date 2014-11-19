<?php
session_start();
include("../function.php");
require('../connections/config.php');
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$partnerid=$_GET['partnerid'];
$filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];

$maxvalue=$childrenpercent+10;
?>
<chart palette="3" showborder='0' bgcolor='FFFFFF' baseFontSize ='12' showPercentValues='1'  decimals='0' formatNumberScale='0' smartLineThickness='2' smartLineColor='333333' isSmartLineSlanted='0' enableSmartLabels="1" enableRotation="1" startingAngle="60">

<?php

$totalerrors=totalErr($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totalsamples=totalTests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totaltests=$totalsamples-$totalerrors;
if ($totalsamples !=0) 
{
$testpercent=round((($totaltests/$totalsamples)*100),1);
}
else
{
$testpercent=0;
}

if ($totalsamples  !=0)
{
$errorspercent=round((($totalerrors/$totalsamples)*100),1);
}
else
{
$errorspercent=0;
}



?>
<set label=" % Tested" value="<?php echo $testpercent;  ?>" color="0372AB"  />
<set label="% Error " value="<?php echo $errorspercent;  ?>" color="FF0000"  />
<?php

?>
</chart>