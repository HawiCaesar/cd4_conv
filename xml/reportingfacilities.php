<?php
include("../function.php");
require('../connections/config.php');

 $startmonth =  1; 
 $endmonth =  12; 
 
 
 function getfacilitysreporting(){
	$sql="SELECT * FROM facility WHERE siteprefix IS NOT NULL ";
	$q=mysql_query($sql) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}	
return $mya;
}
 
function extractfacilitystests($siteprefix,$sql){
	
	$sql="SELECT count(Sample_ID)  FROM  `exp_file_data` where month(Date_Analyzed)='$siteprefix'".$sql;
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_row($query);
	$num=$rs[0];
	return $num;	
} 
?>
<chart caption="Tests done through the year" subcaption=""  yAxisName="# of Tests"  lineThickness="1" showValues="0" formatNumberScale="0" anchorRadius="2" divLineAlpha="20" divLineColor="CC3300" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="" numvdivlines="5" chartRightMargin="35" bgColor="FFFFFF" bgAngle="270" bgAlpha="10,10"  showBorder='0' formatNumberScale="0">
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
<dataset seriesName='Test Done ' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>
<?php   
for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totaltests=extractfacilitystests($startmonth,"");
		
		
?>
<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>

<dataset seriesName='Adult Tests ' color='F1683C' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>
<?php   

for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totaltests=extractfacilitystests($startmonth," AND age>2");
		
		
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
	</dataset>

<dataset seriesName='Paediatric Tests ' color='#00FF00' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>
<?php   

for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totaltests=extractfacilitystests($startmonth," AND age<=2");
		
		
?>

<set value='<?php echo $totaltests; ?>' />
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