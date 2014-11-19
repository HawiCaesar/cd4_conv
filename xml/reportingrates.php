<?php
@session_start();
include("../function.php");
include("../includes/dbConf.php");
require('../connections/config.php');
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$partnerid=$_GET['partnerid'];
$filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
	
$devicesreporting=devicesreporting($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totaldevices=gettotaldevicesperpartner($partnerid);
$notreportingdevices=$totaldevices-$devicesreporting;
if ($totaldevices !=0) 
{
$devicesreportingpercent=round((($devicesreporting/$totaldevices)*100),1);
}
else
{
$devicesreportingpercent=0;
}

if ($totaldevices !=0) 
{
$notreportingdevicespercent=round((($notreportingdevices/$totaldevices)*100),1);
}
else
{
$notreportingdevicespercent=0;
}

//if ($devicesreportingpercent==0)
?>
<chart lowerLimit='0' upperLimit='100' lowerLimitDisplay='0' upperLimitDisplay='100' palette='1' numberSuffix='%' chartRightMargin='20' bgColor='#FFFFFF' showBorder='0'>
   <colorRange>
      <color minValue='0' maxValue='<?php echo $devicesreportingpercent; ?>' code='8BBA00' label='Reporting-<?php echo $devicesreportingpercent . "%"; ?>'/>
      <color minValue='<?php echo $devicesreportingpercent; ?>' maxValue='<?php echo $notreportingdevicespercent; ?>' code='F6BD0F' label='Not Reporting-<?php echo $notreportingdevicespercent . "%"; ?>'/>
   
   </colorRange>
  </chart>
  
