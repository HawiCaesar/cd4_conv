<?php

error_reporting(0);

session_start();
 $currentyear=$_GET['mwaka']; 
 $currentmonth=$_GET['mwezi'];
 $filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
 $startmonth =  1; 
 $endmonth =  12; 
require('../connections/config.php');
function getTotalfromstart($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	
	if ($filter==0) //last submission
	  {
	  	$sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE YEAR(Date_Analyzed)='$currentyear'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
        $sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
        $sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE  Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'"; 	  }
	    elseif ($filter==4)//year only
	  {
	     $sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE  YEAR(Date_Analyzed)='$currentyear'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sql="SELECT count(`id`) as dt FROM  `exp_file_data` WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate'";
	  }
	
	//echo $sql;
	
	$query=mysql_query($sql) or die(mysql_error());
	$re=mysql_fetch_row($query);
	return $re[0];
}

function getTotalspecfromstart($status,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	if($status==1){
	if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE>2";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE>2";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE>2";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2";
	  }		
		
	}
	else if($status==0){
		if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE<=2";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE<=2";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE<=2";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2";
	  }
	}
//echo $sequel;
	
	$query=mysql_query($sequel) or die(mysql_error());
	$re=mysql_fetch_row($query);
	return $re[0];
}
?>
<chart palette="3" showborder='0' bgcolor='FFFFFF' showAboutMenuItem='1' showShadow='1' slicingDistance='15' showLegend='0' baseFontSize ='12' showPercentValues='1'  decimals='0' formatNumberScale='0' 
smartLineThickness='2' smartLineColor='333333' isSmartLineSlanted='0' enableSmartLabels="1" enableRotation="1" startingAngle="60">

<?php

 $totalchild=getTotalspecfromstart(0,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
 $totaladult=getTotalspecfromstart(1,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
 $totaltests=getTotalfromstart($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);

$adultpercent=round((($totaladult/$totaltests)*100),1);
$childpercent=round((($totalchild/$totaltests)*100),1);

?>
<set label=" % Paediatric Tested" value="<?php echo $childpercent;  ?>" color="0372AB" isSliced='0'  />
<set label="% Adults tested " value="<?php echo $adultpercent;  ?>" color="FF0000"  isSliced='1'  />
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