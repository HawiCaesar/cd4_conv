<?php
include("../function.php");
require('../connections/config.php');
$date2=date('Y-m-d');
$startmonth =  1; 
?>
<chart caption="" subcaption=""  yAxisName="Access Times"  xAxisName="Users" lineThickness="1" showValues="0" formatNumberScale="0" anchorRadius="2" divLineAlpha="20" divLineColor="CC3300" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="" numvdivlines="5" chartRightMargin="35" bgColor="FFFFFF" bgAngle="270" bgAlpha="10,10"  showBorder='0' formatNumberScale="0">
<categories >
<?php  

		for ( $startmonth;  $startmonth<=12;  $startmonth++)
  		{  $monthname=GetMonthName($startmonth);
		
?>
<category label='<?php echo $monthname ;?>' />
<?php
}
?>
</categories>
<dataset seriesName='Facility' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>
<?php   


		for ( $startmonth=1;$startmonth<12;  $startmonth++)
  		{  
		
		$totaltests=totallogs(0,$startmonth);
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>
<dataset seriesName='Partner' color='81F781' anchorBorderColor='81F781' anchorBgColor='81F781'>
<?php   


		for ( $startmonth=1;$startmonth<12;  $startmonth++)
  		{  
		
		$totaltests=totallogs(1,$startmonth);
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>
<dataset seriesName='Admin' color='FA0068' anchorBorderColor='FA0068' anchorBgColor='FA0068'>
<?php   


		for ( $startmonth=1;$startmonth<12;  $startmonth++)
  		{  
		
		$totaltests=totallogs(2,$startmonth);
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>
<dataset seriesName='Program' color='62286E' anchorBorderColor='62286E' anchorBgColor='62286E'>
<?php   


		for ( $startmonth=1;$startmonth<12;  $startmonth++)
  		{  
		
		$totaltests=totallogs(5,$startmonth);
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>	
	
</chart>