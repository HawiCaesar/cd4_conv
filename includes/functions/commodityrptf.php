<?php

function physicianrptattr($mfl,$siteprefix,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	 $maxdate=maxdatecommodityfac($mfl);
   	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT SampleID,CaseNumber FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed='$maxdate'" ;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sql = "SELECT SampleID,CaseNumber  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' ";  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT SampleID,CaseNumber  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' ";	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT SampleID,CaseNumber  FROM  `exp_file_data` where SITE='$siteprefix' AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' ";	
 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT SampleID,CaseNumber  FROM  `exp_file_data` where SITE='$siteprefix' AND YEAR(Date_Analyzed)='$currentyear' ";	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT SampleID,CaseNumber  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'  ";	
	  	}
    $query=mysql_query($sql) or die(mysql_error());
    $mytable="";
    $footer='
    <tr><td colspan="4" bgcolor="000000"></td></tr>
    <tr><td align="left"><b>Multi-Tube QC</b></td><td></td><td></td><td></td></tr>
    <tr><td>T Helper/Suppressor Ratio:</td><td>0.00</td><td></td><td></td></tr>
    <tr><td colspan="4" bgcolor="000000"></td></tr>
    <tr><td align="left">Comments</td><td></td><td></td><td></td></tr>
    <tr><td colspan="4"><hr width="100%" size="2" noshade></td></tr>
    <tr><td colspan="4"><hr width="100%" size="2" noshade></td></tr>
    <tr><td colspan="4"><hr width="100%" size="2" noshade></td></tr>
    <tr><td colspan="4"><hr width="100%" size="2" noshade></td></tr>';
	while ($rs=mysql_fetch_array($query)) {
		
	$mytable=$mytable.physicianrpt($rs['SampleID'],$rs['CaseNumber']).$footer;	
	}
return $mytable;
	
}


function physicianrpt($sampleno,$case){
$sql="SELECT * FROM exp_file_data WHERE SampleID='$sampleno' AND CaseNumber='$case'";
$query=mysql_query($sql) or die(mysql_error());
$mytable="";
while ($rs=mysql_fetch_array($query)) {
	
	//graph1
	$cd45=$rs['CD3CD4CD45TruCCD3Lymph'];
	$graph1="";
	if($cd45<55){
			
	$graph1='<img src="img/marker.png" width="12" height="10"/>  55%-------------84%'	;
	}
   else if($cd45>=55 && $cd45<=60.9){
			
	$graph1='55%-<img src="img/marker.png" width="12" height="10"/>------------84%'	;
	}
	else if($cd45>=61 && $cd45<=63.9){
			
	$graph1='55%---<img src="img/marker.png" width="12" height="10"/>----------84%'	;
	}
   else if($cd45>=64 && $cd45<=67.9){
			
	$graph1='55%-----<img src="img/marker.png" width="12" height="10"/>--------84%'	;
	}
	else if($cd45>=68 && $cd45<=70.9){
			
	$graph1='55%-------<img src="img/marker.png" width="12" height="10"/>------84%'	;
	}
	else if($cd45>=71 && $cd45<=74.9){
			
	$graph1='55%--------<img src="img/marker.png" width="12" height="10"/>-----84%'	;
	}
    else if($cd45>=75 && $cd45<=77.9){
			
	$graph1='55%--------<img src="img/marker.png" width="12" height="10"/>-----84%'	;
	}
	else if($cd45>=78 && $cd45<=80.9){
			
	$graph1='55%---------<img src="img/marker.png" width="12" height="10"/>----84%'	;
	}
	else if($cd45>=81 && $cd45<=82.9){
			
	$graph1='55%-----------<img src="img/marker.png" width="12" height="10"/>--84%'	;
	}
	else if($cd45>=83 && $cd45<=84){
			
	$graph1='55%------------<img src="img/marker.png" width="12" height="10"/>-84%'	;
	}
	else if($cd45>84){
			
	$graph1='55%-------------84%  <img src="img/marker.png" width="12" height="10"/>'	;
	}
	
	
	//graph2
	$cd3=$rs['CD3CD4CD45TruCCD3AbsCnt'];
	$graph2="";
	if($cd3<690){
			
	$graph2='<img src="img/marker.png" width="12" height="10"/>  690-------------2540'	;
	}
    else if($cd3>=690 && $cd3<=895.9){
			
	$graph2='690-<img src="img/marker.png" width="12" height="10"/>------------2540'	;
	}
	else if($cd3>=896 && $cd3<=1102.9){
			
	$graph2='690--<img src="img/marker.png" width="12" height="10"/>----------2540'	;
	}
   else if($cd3>=1103 && $cd3<=1308.9){
			
	$graph2='690-----<img src="img/marker.png" width="12" height="10"/>--------2540'	;
	}
	else if($cd3>=1309 && $cd3<=1514.9){
			
	$graph2='690-------<img src="img/marker.png" width="12" height="10"/>------2540'	;
	}
	else if($cd3>=1515 && $cd3<=1720.9){
			
	$graph2='690--------<img src="img/marker.png" width="12" height="10"/>-----2540'	;
	}
    else if($cd3>=1721 && $cd3<=1926.9){
			
	$graph2='690--------<img src="img/marker.png" width="12" height="10"/>-----2540'	;
	}
	else if($cd3>=1927 && $cd3<=2132.9){
			
	$graph2='690---------<img src="img/marker.png" width="12" height="10"/>----2540'	;
	}
	else if($cd3>=2133 && $cd3<=2335.9){
			
	$graph2='690-----------<img src="img/marker.png" width="12" height="10"/>--2540'	;
	}
	else if($cd3>=2336 && $cd3<=2540){
			
	$graph2='690------------<img src="img/marker.png" width="12" height="10"/>-2540'	;
	}
	else if( $cd3>2540){
			
	$graph2='690-------------2540  <img src="img/marker.png" width="12" height="10"/>'	;
	}
	
	
	
	//graph3
	$cd3cd4=$rs['CD3CD4CD45TruCCD3CD4Lymph'];
	$graph3="";
	if($cd3cd4<31){
			
	$graph3='<img src="img/marker.png" width="12" height="10"/>  31%-------------60%'	;
	}
   else if($cd3cd4>=31 && $cd3cd4<=34.9){
			
	$graph3='31%-<img src="img/marker.png" width="12" height="10"/>------------60%'	;
	}
	else if($cd3cd4>=35 && $cd3cd4<=38.9){
			
	$graph3='31%--<img src="img/marker.png" width="12" height="10"/>----------60%'	;
	}
   else if($cd3cd4>=39 && $cd3cd4<=40.9){
			
	$graph3='31%-----<img src="img/marker.png" width="12" height="10"/>--------60%'	;
	}
	else if($cd3cd4>=41 && $cd3cd4<=44.9){
			
	$graph3='31%-------<img src="img/marker.png" width="12" height="10"/>------60%'	;
	}
	else if($cd3cd4>=45 && $cd3cd4<=48.9){
			
	$graph3='31%--------<img src="img/marker.png" width="12" height="10"/>-----60%'	;
	}
    else if($cd3cd4>=49 && $cd3cd4<=51.9){
			
	$graph3='31%--------<img src="img/marker.png" width="12" height="10"/>-----60%'	;
	}
	else if($cd3cd4>=52 && $cd3cd4<=54.9){
			
	$graph3='31%---------<img src="img/marker.png" width="12" height="10"/>----60%'	;
	}
	else if($cd3cd4>=55 && $cd3cd4<=57.9){
			
	$graph3='31%-----------<img src="img/marker.png" width="12" height="10"/>--60%'	;
	}
	else if($cd3cd4>=58 && $cd3cd4<=60){
			
	$graph3='31%------------<img src="img/marker.png" width="12" height="10"/>-60%'	;
	}
	else if( $cd3cd4>60){
			
	$graph3='31%-------------60%  <img src="img/marker.png" width="12" height="10"/>'	;
	}
	
	//graph4
	$cd4=$rs['CD3CD4CD45TruCCD3CD4AbsCnt'];
	$graph4="";
	if($cd4<410){
			
	$graph4='<img src="img/marker.png" width="12" height="10"/>  410-------------1590'	;
	}
   else if($cd4>=410 && $cd4<=541.9){
			
	$graph4='410-<img src="img/marker.png" width="12" height="10"/>------------1590'	;
	}
	else if($cd4>=542 && $cd4<=673.9){
			
	$graph4='410--<img src="img/marker.png" width="12" height="10"/>----------1590'	;
	}
   else if($cd4>=674 && $cd4<=805.9){
			
	$graph4='410-----<img src="img/marker.png" width="12" height="10"/>--------1590'	;
	}
	else if($cd4>=806 && $cd4<=937.9){
			
	$graph4='410-------<img src="img/marker.png" width="12" height="10"/>------1590'	;
	}
	else if($cd4>=938 && $cd4<=1069.9){
			
	$graph4='410--------<img src="img/marker.png" width="12" height="10"/>-----1590'	;
	}
    else if($cd4>=1070 && $cd4<=1101.9){
			
	$graph4='410--------<img src="img/marker.png" width="12" height="10"/>-----1590'	;
	}
	else if($cd4>=1102 && $cd4<=1233.9){
			
	$graph4='410---------<img src="img/marker.png" width="12" height="10"/>----1590'	;
	}
	else if($cd4>=1234 && $cd4<=1365.9){
			
	$graph4='410-----------<img src="img/marker.png" width="12" height="10"/>--1590'	;
	}
	else if($cd4>=1366 && $cd4<=1590){
			
	$graph4='410------------<img src="img/marker.png" width="12" height="10"/>-1590'	;
	}
	else if( $cd4>1590){
			
	$graph4='410-------------1590  <img src="img/marker.png" width="12" height="10"/>'	;
	}
	
	$mytable=$mytable.
	'
	<tr><td colspan=2><center><b>'.$rs['Institution'].'</b></center></td></tr>
    <tr><td colspan=2><center><b>MULTISET<sup><font size="1">TM</font></sup> Physician Report</b> </center></td></tr>
	<tr>
	<td width="50%">
	<table width="90%" class="abc">
	<thead></thead>
	<tbody>
	<tr><td nowrap>Director</td><td nowrap>'.$rs['Director']. '</td></tr>
	<tr><td nowrap>Operator</td><td nowrap>'.$rs['Operator']. '</td></tr>
	<tr><td nowrap>Sample Name</td><td nowrap>'.$rs['SampleName']. '</td></tr>
	<tr><td nowrap>Sample ID</td><td nowrap>'.$rs['SampleID']. '</td></tr>
	<tr><td nowrap>Case Number</td><td nowrap>'.$rs['CaseNumber']. '</td></tr>
	<tr><td nowrap>AGE</td><td nowrap>'.$rs['AGE']. '</td></tr>
	<tr><td nowrap>SEX</td><td nowrap>'.$rs['SEX']. '</td></tr>
	</tbody>
	</table>
	
	</td>
	<td width="50%" style="valign:top;" class="abc" >
	<table width="90%" >
	<thead></thead>
	<tbody>
	<tr><td nowrap>SITE</td><td nowrap>'.$rs['SITE'].'</td></tr>
	<tr><td nowrap>Panel Name</td><td nowrap>'.$rs['PanelName']. '</td></tr>
	<tr><td nowrap>Software</td><td nowrap>'.$rs['SwVersion']. '</td></tr>
	<tr><td nowrap>Cytometer</td><td nowrap>'.$rs['Cytometer']. '</td></tr>
	<tr><td nowrap>Date Acquired</td><td nowrap>'.$rs['Date_Analyzed']. '</td></tr>
	<tr><td nowrap>Date Analyzed</td><td nowrap>'.$rs['Date_Analyzed']. '</td></tr>
	<tr><td nowrap>Reference Range Type</td><td nowrap>'.$rs['RefRange']. '</td></tr>
	</tbody>
	</table>
	
	</td>
	</tr>
	<tr><td colspan="2" width="100%">
	<table width="100%" class="data-table" cellpadding="7" cellspacing="7">
	<thead>
	<tr>
	<th nowrap align="left">Result Name</th>
	<th nowrap>% Ratio</th>
	<th nowrap>Abs Cnt (cells/mm<sup>3</sup>)</th>
	<th nowrap>  Reference Range    </th>
	</tr>

	</thead>
	<tbody>
		
	<tr>
	<td>T Lymphs % of Lymphs(CD3+/CD45+)</td>
	<td><center>'.$rs['CD3CD4CD45TruCCD3Lymph'].'</center></td>
	<td></td>
	<td nowrap><center>'.$graph1.'</center></td>
	</tr>
		<tr>
	<td>T Lymphs(CD3+)Abs Cnt</td>
	<td></td>
	<td><center>'.$rs['CD3CD4CD45TruCCD3AbsCnt'].'</center></td>
	<td nowrap><center>'.$graph2.'</center></td>
	</tr>
		<tr>
	<td>T Helper % of Lymphs(CD3+CD4+)Abs Cnt</td>
	<td><center>'.$rs['CD3CD4CD45TruCCD3CD4Lymph'].'</center></td>
	<td></td>
	<td nowrap><center>'.$graph3.'</center></td>
	</tr>
		<tr>
	<td>T Helper Lymphs(CD3+CD4+/CD45+)</td>
	<td></td>
	<td><center>'.$rs['CD3CD4CD45TruCCD3CD4AbsCnt'].'</center></td>
	<td nowrap><center>'.$graph4.'</center></td>
	</tr>
	<tr>
	<td > Lymphocyte (CD45+)Abs Cnt*</td>
	<td></td>
	<tdn nowrap><center>'.$rs['CD3CD4CD45TruCCD45AbsCnt'].'</center></td>
	<td></td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	
	';
}
return $mytable;
	
}	


function facilitymail($mfl){
	$sql="SELECT email from facility where MFLCode='$mfl'";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_row($query);
	return $rs[0];
	
}
?>
