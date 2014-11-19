<?php
session_start();
require('../connections/config.php');

$currentyear= date("Y");
$currentmonth = date("m");
$year=$_GET['mwaka'];
$graph=$_GET['graph'];
$mfl=$_GET['mfl'];
$levels=$_GET['level'];
//$db = new dbConf();

	$tit1="Calibur";
	$tit2="Pima";

 
 //echo $tit1.$tit2;
	function gettotal($currentyear){
	$total="SELECT (SELECT COUNT(*) from test where `testID`!=0 AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where `SampleID`!=0 AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";
	$query=mysql_query($total) or die(mysql_error());
	$result=mysql_fetch_row($query);
	return $result[0];	
	}
	function getpimatotal($currentyear){
	$pimatotal="SELECT COUNT(*) as dt from test where `testID`!=0 AND YEAR(resultDate)='$currentyear'";
	$query=mysql_query($pimatotal) or die(mysql_error());
	$result=mysql_fetch_row($query);
	return $result[0];	
	}
	function getcaliburtotal($currentyear){
	$pimatotal="SELECT COUNT(*) as dt from exp_file_data where `SampleID`!=0 AND YEAR(Date_Analyzed)='$currentyear'";
	$query=mysql_query($pimatotal) or die(mysql_error());
	$result=mysql_fetch_row($query);
	return $result[0];	
	}


?>
<chart palette="3" showborder='0' bgcolor='FFFFFF' showShadow='1' slicingDistance='15' showLegend='0' baseFontSize ='12' showPercentValues='1' 
 decimals='0' formatNumberScale='0' smartLineThickness='2' smartLineColor='333333' isSmartLineSlanted='0' enableSmartLabels="1" enableRotation="1" startingAngle="60">

<?php

 $totaltests=gettotal($currentyear);
 $totalpima=getpimatotal($currentyear);
 $totalcalibur=getcaliburtotal($currentyear);
 $pimapercent=round((($totalpima/$totaltests)*100),1);
 $caliburpercent=round((($totalcalibur/$totaltests)*100),1);

?>
<set label="<?php echo $tit1;  ?>" value="<?php echo $caliburpercent; ?>" color="0372AB" isSliced='0' />
<set label="<?php echo $tit2;  ?> " value="<?php echo $pimapercent;?>" color="FF0000" isSliced='1'  />
<?php

?>
 <styles>
        <definition>
          <style name="Font_0" type="font" font="Calibri" size="14" bold="1" bgcolor="FFFFFF" bordercolor="FFFFFF" isHTML="0"/>
          <style name="Font_1" type="font" size="15" color="000080" bgcolor="FFFFFF" bordercolor="FFFFFF" isHTML="0"/>
          <style name="Glow_0" type="Glow" color="0080FF" alpha="43" quality="3"/>
        </definition>
        <application>
          <apply toObject="DATALABELS" styles="Font_0"/>
          <apply toObject="CAPTION" styles="Font_1"/>
          <apply toObject="DATAPLOT" styles="Glow_0"/>
        </application>
        </styles>
</chart>