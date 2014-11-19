<?php
include("../function.php");
require('../connections/config.php');
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$partnerid=$_GET['partnerid'];
$filter=3;
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
 $startmonth =  1; 
 $endmonth =  12; 
 $mfl=$_GET['mfl'];
$level=$_GET['level'];
?>
<chart caption="" subcaption=""  yAxisName="# of Tests"  lineThickness="2" showValues="0" formatNumberScale="0" anchorRadius="2" divLineAlpha="20" divLineColor="CC3300"
 divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="" numvdivlines="10" chartRightMargin="35" bgColor="FFFFFF" bgAngle="270" bgAlpha="10,10"  showBorder='0' formatNumberScale="0">
<categories >
<?php  

		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  $monthname=GetMonthName($startmonth);
		
?>
<category label='<?php echo $monthname ;?>' />
<?php
}
?>
</categories>
<dataset seriesName='Test Done' color='A666EDD'>
<?php   

$startmonth =  1; 
 $endmonth =  12; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totaltests=totalfailedcaliburtests($partnerid,$filter,$startmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl);
		
		
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>

<dataset seriesName='Adult Tests' color='F6BD0F'>
	<?php   $startmonth =  1; 
 $endmonth =  12; 
 $currentyear=$_GET['mwaka'];
		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  
		
		$totalerrors=totalfailedadults($partnerid,$filter,$startmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl);
?>

<set value='<?php echo $totalerrors; ?>' />
<?php
}
?>
</dataset>

<dataset seriesName='Paediatric Tests' color='FF0080'>
	<?php   $startmonth =  1; 
 $endmonth =  12; 
 $currentyear=$_GET['mwaka'];
		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  
		
		$totalerrors=totalfailedchildren($partnerid,$filter,$startmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl);
?>

<set value='<?php echo $totalerrors; ?>' />
<?php
}
?>
</dataset>
<styles>

<definition>
<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
<style name="DataShadow" type="Shadow" alpha="40"/>
</definition>
-
<application>
<apply toObject="DIVLINES" styles="Anim1"/>
<apply toObject="HGRID" styles="Anim2"/>
<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
</application>
</styles>


</chart>