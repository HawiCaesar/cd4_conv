<?php
session_start();
require('../connections/config.php');

$year=$_GET['mwaka'];
 $graph=$_GET['graph'];
 $mfl=$_GET['mfl'];
$levels=$_GET['level'];
 if ($graph==1){
 	
 	$tit1="Adult tests";
	$tit2='Below 350';
	
 }
 else  if ($graph==0){
 	$tit1="Pead tests";
	$tit2='Below 25';
	
 }
 //echo $tit1.$tit2;
function getTotalspecfromstarter23($graph,$year,$levels,$mfl){
	
	
if($levels==0){
	if($graph==1){
	$seql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND year(Date_Analyzed)=$year";
	}
	else if($graph==0){
	$seql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND year(Date_Analyzed)=$year";
	}
}
else {
		if($graph==1){
	$seql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND year(Date_Analyzed)=$year AND SITE='$mfl'";
	}
	else if($graph==0){
	$seql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND year(Date_Analyzed)=$year AND SITE='$mfl'";
	}
}
	//echo $seql;
	$query=mysql_query($seql) or die(mysql_error());
	$re=mysql_fetch_row($query);
	return $re[0];
}

function getIndividualspecfromstart($status,$year,$level,$levels,$mfl){
	//echo $status.$level;
	if($levels==0){
	if($status==1 AND $level==1){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND year(Date_Analyzed)=$year" ;
	}
	else if($status==0 AND $level==1){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND year(Date_Analyzed)=$year";
	}else if($status==1 AND $level==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND year(Date_Analyzed)=$year AND  CD3CD4CD45TruCCD3CD4AbsCnt>350" ;
	}
	else if($status==0 AND $level==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND year(Date_Analyzed)=$year AND CD3CD4CD45TruCCD3CD4Lymph>25";
	}
	
	}
	else {
	if($status==1 AND $level==1){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND year(Date_Analyzed)=$year AND SITE='$mfl'" ;
	}
	else if($status==0 AND $level==1){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND year(Date_Analyzed)=$year AND SITE='$mfl'";
	}else if($status==1 AND $level==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND year(Date_Analyzed)=$year AND  CD3CD4CD45TruCCD3CD4AbsCnt>350 AND SITE='$mfl'" ;
	}
	else if($status==0 AND $level==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND year(Date_Analyzed)=$year AND CD3CD4CD45TruCCD3CD4Lymph>25 AND SITE='$mfl'";
	}	
	}
	//echo $sql;
	$query=mysql_query($sql);
	$re=mysql_fetch_row($query);
	return $re[0];
}



?>
<chart palette="3" showborder='0' bgcolor='FFFFFF' showShadow='1' slicingDistance='15' showLegend='0' baseFontSize ='12' showPercentValues='1' 
 decimals='0' formatNumberScale='0' smartLineThickness='2' smartLineColor='333333' isSmartLineSlanted='0' enableSmartLabels="1" enableRotation="1" startingAngle="60">

<?php

 $totalchild=getIndividualspecfromstart($graph,$year,1,$levels,$mfl);
$totaladult=getIndividualspecfromstart($graph,$year,2,$levels,$mfl);
$totaltests=getTotalspecfromstarter23($graph,$year,$levels,$mfl);
$adultpercent=round((($totaladult/$totaltests)*100),1);
$childpercent=round((($totalchild/$totaltests)*100),1);

?>
<set label="<?php echo $tit1;  ?>" value="<?php echo $childpercent;  ?>" color="0372AB" isSliced='0' />
<set label="<?php echo $tit2;  ?> " value="<?php echo $adultpercent;  ?>" color="FF0000" isSliced='1'  />
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