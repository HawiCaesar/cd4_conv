<?php
//function to check for an error number
		function checkQAQC($err){
			$query="select qaId as qaId From qaqc where value='".$err."' LIMIT 1";
			$res=mysql_query($query);
			$myarr[]=array();
			while($result=mysql_fetch_array($res)){
			
			$myarr[1]=$result['qaId'];
			
			}
			
			return $myarr['1'];
			}
			
//function to get minimum dates and maximum dates	
		function uniqueDates($patna){
			$sql="SELECT MIN( MONTH(`resultDate`)) as minMonth , MIN( YEAR(`resultDate`)) as minyr, MAX( MONTH(`resultDate`)) as maxMonth , 
			      MAX( YEAR(`resultDate`)) as maxyr FROM  `test` WHERE partnerID ='".$patna."'";
			$yrMnth=array();
			$rs=mysql_query($sql);
			while($res=mysql_fetch_array($rs)){
			$yrMnth[0]=$res['minMonth'];
			$yrMnth[1]=$res['minyr'];
			$yrMnth[2]=$res['maxMonth'];
			$yrMnth[3]=$res['maxyr'];	
				}
				return $yrMnth;
			}	
			
//function to search for CCC number	
function ccc($sample,$patna,$arrange){
$sql="SELECT testID, `sampleNumber`,`cdCount`,`resultDate`,`operatorId` FROM  `test` WHERE sampleNumber =  '$sample' AND partnerID ='$patna' ORDER BY testID  $arrange ";
	$query=mysql_query($sql);
	return $query;	
	}
	
	
	//function to get the facility numbers from samples
	function getFacilityTested($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
		  if ($filter==0) //last submission
	  {
		 $sql="SELECT sampleNumber from test where cdCount <>0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='".$patna."' AND cdCount<350 ";
	  }
	   elseif ($filter==1)//last 6 months $fromdate$todate
	  {
		   $sql="SELECT sampleNumber from test where cdCount <>0 AND  resultDate BETWEEN '$fromdate' AND '$todate'  AND partnerID='".$patna."' AND cdCount<350 ";
	  }
	   elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
		   $sql="SELECT sampleNumber from test where cdCount <>0 AND  resultDate BETWEEN '$fromfilter' AND '$tofilter'  AND partnerID='".$patna."' AND cdCount<350 ";
	  }
	    elseif ($filter==3)//month/year
	  {
		  
		   $sql="SELECT sampleNumber from test where cdCount <>0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'  AND partnerID='".$patna."' AND cdCount<350 ";
 	  }
	    elseif ($filter==4)//year only
	  {
		   $sql="SELECT sampleNumber from test where cdCount <>0 AND YEAR(resultDate)='$currentyear'  AND partnerID='".$patna."' AND cdCount<350 ";

	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	  	  $sql="SELECT sampleNumber from test where cdCount <>0 AND  resultDate BETWEEN '$fromdate' AND '$todate'  AND partnerID='".$patna."' AND cdCount<350 ";
	  }
		$query=mysql_query($sql) or die(mysql_query());
		$myarr=array();
		$finalArr=array();
		$num=0;
		while($rs=mysql_fetch_array($query)){
		if (preg_match('/(\d{1,100})[a-zA-Z]/', $rs['sampleNumber'], $matches)) {
      $myarr[$num] = $matches[1];
		}
			
		 $num++;	
			}
		
		//ensures array has unique nos only
		$finalArr = array_unique($myarr);
		return $finalArr;
}
  function tblFacSamples($num,$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	 // if(!isset){}
  if ($filter==0) //last submission
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND month(test.resultDate)='$currentmonth' AND YEAR(test.resultDate)='$currentyear' AND test.partnerID='".$patna."' AND test.cdCount<350";

	  }
	   elseif ($filter==1)//last 6 months $fromdate$todate
	  { $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND test.resultDate BETWEEN '$fromdate' AND '$todate'   AND test.partnerID='".$patna."' AND test.cdCount<350";

		  
	  }
	   elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND test.resultDateBETWEEN '$fromfilter' AND '$tofilter' AND test.partnerID='".$patna."' AND test.cdCount<350";
		  
	  }
	    elseif ($filter==3)//month/year
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND month(test.resultDate)='$currentmonth' AND YEAR(test.resultDate)='$currentyear' AND test.partnerID='".$patna."' AND test.cdCount<350";
		  
 	  }
	    elseif ($filter==4)//year only
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND YEAR(test.resultDate)='$currentyear' AND test.partnerID='".$patna."' AND test.cdCount<350";
		   
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		  	  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND test.resultDate BETWEEN '$fromdate' AND '$todate'   AND test.partnerID='".$patna."' AND test.cdCount<350";
	  }
	  
	  
	 $query=mysql_query($sql) or die(mysql_query());
		$myarr=array();
		$numb=1;
		while($rs=mysql_fetch_array($query)){
		if (preg_match('/(\d{1,100})[a-zA-Z]/', $rs['sampleNumber'], $matches)) {
      if($matches[1]==$num){
		  $myarr[$numb]=$matches[1]; 
		  $numb++;
		  }
		}
		  $fac=$rs['facilityName'];			 
	  }
	 return '<td>'.$fac.'</td><td>'.$numb.'</td>';
	  
  }
  
  ///tables tested for report.php
  function tblFacRpt($num,$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	 // if(!isset){}
  if ($filter==0) //last submission
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND month(test.resultDate)='$currentmonth' AND YEAR(test.resultDate)='$currentyear' AND test.partnerID='".$patna."' AND test.cdCount<350";

	  }
	   elseif ($filter==1)//last 6 months $fromdate$todate
	  { $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND test.resultDate BETWEEN '$fromdate' AND '$todate'   AND test.partnerID='".$patna."' AND test.cdCount<350";

		  
	  }
	   elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND test.resultDateBETWEEN '$fromfilter' AND '$tofilter' AND test.partnerID='".$patna."' AND test.cdCount<350";
		  
	  }
	    elseif ($filter==3)//month/year
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND month(test.resultDate)='$currentmonth' AND YEAR(test.resultDate)='$currentyear' AND test.partnerID='".$patna."' AND test.cdCount<350";
		  
 	  }
	    elseif ($filter==4)//year only
	  {
		  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND YEAR(test.resultDate)='$currentyear' AND test.partnerID='".$patna."' AND test.cdCount<350";
		   
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		  	  $sql="SELECT test.sampleNumber,facilitys.facilityName from test, facilitys WHERE facilitys.siteprefix='$num' AND test.cdCount <>0 AND test.resultDate BETWEEN '$fromdate' AND '$todate'   AND test.partnerID='".$patna."' AND test.cdCount<350";
	  }
	  
	  
	 $query=mysql_query($sql) or die(mysql_query());
		$myarr=array();
		$numb=1;
		while($rs=mysql_fetch_array($query)){
		if (preg_match('/(\d{1,100})[a-zA-Z]/', $rs['sampleNumber'], $matches)) {
      if($matches[1]==$num){
		  $myarr[$numb]=$matches[1]; 
		  $numb++;
		  }
		}
		  $fac=$rs['facilityName'];			 
	  }
	 return '<option value="'.$numb.'">'.$fac.'</option>\n';
	  
  } 
  
  
//function to create the facility|sample table
function printFacSamples($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	$arr=getFacilityTested($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	 $az=array_pop(array_keys($arr));
	 $no=1;
	for($num=0;$num<=$az;$num++){
		if(isset($arr[$num])){
		echo '<tr><td>'.$no.'</td>'.tblFacSamples($arr[$num],$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate).'</tr>';
		$no++;
		}
		}
	}
	
	//function to create the facility|sample table
function getFacList($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	$arr=getFacilityTested($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	 $az=array_pop(array_keys($arr));
	 $no=1;
	for($num=0;$num<=$az;$num++){
		if(isset($arr[$num])){
		echo tblFacRpt($arr[$num],$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
		$no++;
		}
		}
	}
//function to display the test details
function commoditytesting(){
	//$sql="";
	//$query=mysql_query($sql) or die();
	//while ($rs=mysql_fetch_array($query)){}
	$mytable_header= '<table width="100%" class="data-table">';
	$mytable_body="<tr><td><b># of Patients Tested:</b></td><td>50</td></tr>
	<tr><td><b># of Tests Performed:</b></td><td>55</td></tr>
	<tr><td><b># of Controls:</b></td><td>5</td></tr>
	<tr><td><b>CD4 < 350:</b></td><td>5</td></tr>
	<tr><td><b>CD4 < 25%:</b></td><td>4</td></tr>
	<tr><td><b># of Repeat Tests:</b></td><td>3</td></tr>
	<tr><td colspan='2'><b><center>1/4 Caliburs Reported:</center></b></td></tr>";
	$mytable_footer="</table";
	$mytable=$mytable_header.$mytable_body.$mytable_footer;
	return $mytable;
	
	
	
}
?>