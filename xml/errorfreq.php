 <?php
@session_start();
include("../function.php");
require('../connections/config.php');
$patna=$_SESSION['userID'];
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
 
?>


<chart caption="" subcaption="" xAxisName="" yAxisName="# Reported" yAxisMinValue="0" numberPrefix="" showValues="1" alternateHGridColor="FCB541" alternateHGridAlpha="20" divLineColor="FCB541" divLineAlpha="50" canvasBorderColor="666666" baseFontColor="666666" lineColor="FCB541" bgColor='#FFFFFF' showBorder='0' formatNumberScale="0" useRoundEdges="1"  labelDisplay='rotate' slantLabels='1' clickURL='errors.php'>
   <styles>

      <definition>
         <style name='CanvasAnim' type='animation' param='_xScale' start='0' duration='1' />
      </definition>

      <application>
         <apply toObject='Canvas' styles='CanvasAnim' />
      </application>   

   </styles>
<?php
$sql=mysql_query("SELECT DISTINCT (error.errorID ), errorName FROM error, test WHERE test.errorID = error.errorID") or die(mysql_error());
while(list($errorID,$errorName)=mysql_fetch_array($sql))
{

$totalerrors=totalerrorbycategory2($errorID,$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
?>

<set label='<?php echo $errorName; ?>' value='<?php echo $totalerrors; ?>'/>
 <?php } ?>

</chart>