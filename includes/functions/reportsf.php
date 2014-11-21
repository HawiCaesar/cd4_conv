<?php
//reports
	function reports($criteria,$duration,$patna,$selectedCriteria,$year,$month){
		//criteria 1=pima device and 2=facility
		if($criteria=1){
			//duraion 1=monthly
		 if($duration=1){
		 $sql="SELECT * FROM test Where deviceID='".$selectedCriteria."' AND year(resultDate)='".$year."' AND month(resultDate)='".$month."'";
			}
		//duraion 2=Quarterly
		 else if($duration=2){
		 $sql="SELECT * FROM test Where deviceID='".$selectedCriteria."' AND year(resultDate)='".$year."' AND month(resultDate)>'".$month."' AND month(resultDate)>'".$month."'";
			}
		
			//duraion 2=biannually
		 else if($duration=3){
		 $sql="SELECT * FROM test Where deviceID='".$selectedCriteria."' AND year(resultDate)='".$year."' AND month(resultDate)>'".$month."' AND month(resultDate)>'".$month."'";
			}
			//yearly
			
			else
		 $sql="SELECT * FROM test Where deviceID='".$selectedCriteria."' AND year(resultDate)='".$year."'";
		
		}
		$query=mysql_query($sql);
			
	return $query();
	}
	
	//funcjtion whether month reported
	function ifreported($month, $yr, $patna){
		$sql="SELECT count(testID) FROM test WHERE month(resultDate)='$month' AND year(resultDate)='$yr' AND partnerID='$patna'";
		$query=mysql_query($sql) or die();
		$rs=mysql_fetch_row($query);
		return $rs[0];
		}
		
		
		
//function that gets total reports below 350 for popup
	function cdCount350($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
		
		if($filter==0){
$sql="SELECT deviceID,sampleNumber,cdCount,resultDate FROM test WHERE MONTH(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' AND cdCount<'350' AND cdCount<>0";
		}
		else if($filter==1){
			  $sql="SELECT deviceID,sampleNumber,cdCount,resultDate FROM test WHERE resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' AND cdCount<'350' AND cdCount<>0";
		}
		else if($filter==2){
			  $sql="SELECT deviceID,sampleNumber,cdCount,resultDate FROM test WHERE resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' AND cdCount<'350' AND cdCount<>0";
		}
		else if($filter==3){
			  $sql="SELECT deviceID,sampleNumber,cdCount,resultDate FROM test WHERE MONTH(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' AND cdCount<'350' AND cdCount<>0";
		}
		
		else if($filter==4){
$sql="SELECT deviceID,sampleNumber,cdCount,resultDate FROM test WHERE  YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' AND cdCount<'350' AND cdCount<>0 ";
		}
		
		else if($filter==7){
$sql="SELECT deviceID,sampleNumber,cdCount,resultDate FROM test WHERE  cdCount <>0 AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' AND cdCount<'350' AND cdCount<>0";
		}
			 $rs=mysql_query($sql) or die();
			return $rs;
		
	}


//function for monthly uploads in monthlyReports.php
		function monthlyReports($month,$year,$partner,$num){
			$sql="SELECT * FROM  test WHERE  MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."' ORDER BY  					            `test`.`testNO` ASC limit 0," .$num;
			 $rs=mysql_query($sql) or die();
			return $rs;
			
			}

//years reported		
	function getyearsreported($partnerid){
		$sql="SELECT DISTINCT YEAR( resultDate ) as yr FROM test where partnerID='".$partnerid."'";
		$query=mysql_query($sql) or mysql_error();
		return $query;
			
			}

//function to retrieve info
  function reportCD4($month){
	  
	  $sequel="SELECT COUNT( IF(  `cdCount` <350, NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  `test` WHERE resultDate <>0 AND month(resultDate)='".$month."' ";
    
	$cd=array();
	  $resultReport=mysql_query($sequel);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  $cd['0']=$resultArr['less'];
		  $cd['1']=$resultArr['more'];
		  }
		  
		  return $cd;
	  }


//pdf reporting
//header design.
function header1($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
	if($duration==4){
		$title="CD4 Test Results for ".$year;
		}
	else if($duration==1){
		$title="CD4 Test Results for ".$monthName = date("F", mktime(0, 0, 0, $month, 10))." ".$year;
	  }	
	else if($duration==2){
		$title="CD4 Test Results for Quarter: ".$quarter." of ".$year;
	}
	else if($duration==3){
		$title="CD4 Test Results for Half: ".$biAnn." of ".$year;
	}
	else if($duration==5){
		$title="CD4 Test Results for ".$from."-".$to;
	}
		
	
	return '<table width="100%" border="0">
<tr>
<td rowspan="2"><img style="vertical-align: top" src="naslogo.jpg"/></td>
<td style="vertical-align:middle"><font size="+5"><strong><b><u>CD4 Consumption Summary For Device '.$dev .'<u></b></strong></font></td>
<tr><td><font size="+4"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$title.'</b></font></td></tr>
</tr>
</table>';
	}

function headings($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
	if($duration==4){
		$heading='<table width="100%" border="1"><tr>
		<th  valign="middle">#</th>
		<td>
		<table border="0"><tr><th colspan="12"  align="center">Year '.$year.'</th></tr>
		<tr><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th>
		<th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th></tr>
		</table>
		</td>
		<th valign="middle">Errors</th>
		<th valign="middle"><350</th>
		</tr>';
		}
	else if($duration==1){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><th align="center">'.$monthName = date("F", mktime(0, 0, 0, $month, 10)).'-'.$year.'</th><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
	  }	
	else if($duration==2){
		if($quarter==1){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><td><table><tr><th colspan="4"  align="center">Year '.$year.'</th></tr>
		<tr><th width="100px" align="center">Jan</th><th width="100px" align="center">Feb</th><th width="100px" align="center">Mar</th><th width="100px" align="center">Apr</th></tr></table></th><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
		}
		if($quarter==2){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><td><table><tr><th colspan="4"  align="center">Year '.$year.'</th></tr>
		<tr><th width="100px" align="center">May</th><th width="100px" align="center">Jun</th><th width="100px" align="center">Jul</th><th width="100px" align="center">Aug</th></tr></table></th><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
		}
		if($quarter==3){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><td><table><tr><th colspan="4"  align="center">Year '.$year.'</th></tr>
		<tr><th width="100px" align="center">Sep</th><th width="100px" align="center">Oct</th><th width="100px" align="center">Nov</th><th width="100px" align="center">Dec</th></tr></table></th><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
		}
	}
	else if($duration==3){
		if($biAnn==1){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><td><table><tr><th colspan="6" align="center">Year '.$year.'</th></tr>
		<tr><th width="72px" align="center">Jan</th><th width="72px" align="center">Feb</th><th width="72px" align="center">Mar</th><th width="72px" align="center">Apr</th><th width="72px" align="center">May</th><th align="center" width="72px">Jun</th></tr></table></td><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
		}
		else if($biAnn==2){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><td><table><tr><th colspan="6" align="center">Year '.$year.'</th></tr>
		<tr><th width="72px" align="center">Jul</th><th width="72px" align="center">Aug</th><th width="72px" align="center">Sep</th><th width="72px" align="center">Oct</th><th width="72px" align="center">Nov</th><th align="center" width="72px">Dec</th></tr></table></td><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
		}
	}
	else if($duration==5){
		$heading='<table width="100%" border="1"><tr>
		<th align="center">#</th><th align="center">'.$from.'-'.$to.'</th><th align="center">Errors</th><th align="center"><350</th>
		</tr>';
	}
	 return $heading;	
	
	}	

	
	function monthlyErrs($month,$yr,$dev,$patna,$quarter,$biAnn,$duration,$from,$to){
	if($duration==1){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)='$month' AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	}	
	if($duration==2){
	if($quarter==1){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)<5 AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	 }
	if($quarter==2){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)<9 AND month(resultDate)>4  AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	 }
	if($quarter==3){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)>8  AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	 }
	}
	if($duration==3){
	if($quarter==1){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)<7 AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	 }
	if($quarter==2){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)>6  AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	 }
	}
	if($duration==4){
	$sql="SELECT count(*) FROM test WHERE year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	}
	
	if($duration==5){
	$sql="SELECT count(*) FROM test WHERE resultDate BETWEEN '".$from."' AND '".$to."'AND partnerID='$patna' AND deviceID='$dev' AND errorID>0 ";
	}
	$result=mysql_query($sql);
	$a=mysql_fetch_row($result);
	return $a[0];
}	
	function monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to){
	if($duration==1){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)='$month' AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0";
	}	
	if($duration==2){
	if($quarter==1){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)<5 AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0 ";
	 }
	if($quarter==2){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)<9 AND month(resultDate)>4  AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0 ";
	 }
	if($quarter==3){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)>8  AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0 ";
	 }
	}
	if($duration==3){
	if($quarter==1){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)<7 AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0 ";
	 }
	if($quarter==2){
	$sql="SELECT count(*) FROM test WHERE month(resultDate)>6  AND year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0 ";
	 }
	}
	if($duration==4){
	$sql="SELECT count(*) FROM test WHERE year(resultDate)='$yr' AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0 ";
	}
	
	if($duration==5){
	$sql="SELECT count(*) FROM test WHERE resultDate BETWEEN '".$from."' AND '".$to."'AND partnerID='$patna' AND deviceID='$dev' AND cdCount<350 AND cdCount<>0";
	}
	$result=mysql_query($sql);
	$a=mysql_fetch_row($result);
	return $a[0];
}
	function pdfContent($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
			if($duration==4){
	 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS  'Feb',          IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr', IF( MONTH(          resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun', IF( MONTH( resultDate )          =07, COUNT( testID ) ,  '0' ) AS  'Jul', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Aug', IF( MONTH( resultDate ) =09, COUNT(          testID ) ,  '0' ) AS  'Sep', IF( MONTH( resultDate ) = 10 , COUNT( testID ) ,  '0' ) AS  'Oct', IF( MONTH( resultDate ) =11, COUNT( testID ) ,          '0' ) AS  'Nov', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Dec', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td valign="middle">'.$num.'</td>
	<td valign="middle"><table  border="0"><tr>
	<td align="center" width="36px">'.$rs["Jan"].'</td>
	<td align="center" width="36px">'.$rs["Feb"].'</td>
	<td align="center" width="36px">'.$rs["Mar"].'</td>
	<td align="center" width="36px">'.$rs["Apr"].'</td>
	<td align="center" width="36px">'.$rs["May"].'</td>
	<td align="center" width="36px">'.$rs["Jun"].'</td>
	<td align="center" width="36px">'.$rs["Jul"].'</td>
	<td align="center" width="36px">'.$rs["Aug"].'</td>
	<td align="center" width="36px">'.$rs["Sep"].'</td>
	<td align="center" width="36px">'.$rs["Oct"].'</td>
	<td align="center" width="36px">'.$rs["Nov"].'</td>
	<td align="center" width="36px">'.$rs["Dec"].'</td>
	</tr></table></td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	}
		}
	else if($duration==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =".$month.", COUNT( `testID` ) ,  '0' ) AS  'Jan', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle">'.$rs["Jan"].'</td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	}
	  }	
	else if($duration==2){
		if($quarter==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle"><table  border="0"><tr>
	<td align="center" width="100px">'.$rs["Jan"].'</td>
	<td align="center" width="100px">'.$rs["Feb"].'</td>
	<td align="center" width="100px">'.$rs["Mar"].'</td>
	<td align="center" width="100px">'.$rs["Apr"].'</td>
	</tr></table></td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	  }
		}
	  else if($quarter==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =05, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =07, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle"><table  border="0"><tr>
	<td align="center" width="100px">'.$rs["Jan"].'</td>
	<td align="center" width="100px">'.$rs["Feb"].'</td>
	<td align="center" width="100px">'.$rs["Mar"].'</td>
	<td align="center" width="100px">'.$rs["Apr"].'</td>
	</tr></table></td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	  }
	 }
	 if($quarter==3){
		 $sql="SELECT IF( MONTH( `resultDate` ) =09, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle"><table  border="0"><tr>
	<td align="center" width="100px">'.$rs["Jan"].'</td>
	<td align="center" width="100px">'.$rs["Feb"].'</td>
	<td align="center" width="100px">'.$rs["Mar"].'</td>
	<td align="center" width="100px">'.$rs["Apr"].'</td>
	</tr></table></td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	   }
	  }
	}
	else if($duration==3){
		if($biAnn==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle"><table  border="0"><tr>
	<td align="center" width="72px">'.$rs["Jan"].'</td>
	<td align="center" width="72px">'.$rs["Feb"].'</td>
	<td align="center" width="72px">'.$rs["Mar"].'</td>
	<td align="center" width="72px">'.$rs["Apr"].'</td>
	<td align="center" width="72px">'.$rs["May"].'</td>
	<td align="center" width="72px">'.$rs["Jun"].'</td>
	</tr></table></td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	 }
	}
	else if($biAnn==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =07, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =09, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT(               IF( `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle"><table  border="0"><tr>
	<td align="center" width="72px">'.$rs["Jan"].'</td>
	<td align="center" width="72px">'.$rs["Feb"].'</td>
	<td align="center" width="72px">'.$rs["Mar"].'</td>
	<td align="center" width="72px">'.$rs["Apr"].'</td>
	<td align="center" width="72px">'.$rs["May"].'</td>
	<td align="center" width="72px">'.$rs["Jun"].'</td>
	</tr></table></td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	  }
	 }
	}
	else if($duration==5){
		 $sql="SELECT  COUNT( `testID` ) AS  'Jan', COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS 'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS              '<350' FROM  `test` WHERE partnerID ='".$patna."' AND resultDate BETWEEN '".$from."' AND '".$to."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	$num=1;
	while($rs=mysql_fetch_array($query)){
	$mycontent='<tr>
	<td align="center" valign="middle">'.$num.'</td>
	<td align="center" valign="middle">'.$rs["Jan"].'</td>
	<td align="center" valign="middle">'.monthlyErrs($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	<td align="center" valign="middle">'.monthlylesscdcount($month,$year,$dev,$patna,$quarter,$biAnn,$duration,$from,$to).'</td>
	</tr>';
	$num++;
	}
	}
		return $mycontent;
		}
				
				
				

	//function that does the actual sending and design of the pdf
	function email_sender($report_name) {
		@include("../../pdf/mpdf/mpdf.php");
@$mpdf=new mPDF(); 
/*		setting the connection variables
		$content = chunk_split(base64_encode($content));
$mailto = 'rickinyua@gmail.com';
$from_name = 'CD4 Mailer';
$from_mail = 'alupe.poc@gmail.com';
$replyto = 'alupe.poc@gmail.com';
$uid = md5(uniqid(time())); 
$subject = 'Your e-mail subject here';
$message = 'Your e-mail message here';
$filename = $report_name;

$header = "From: ".$from_name." <".$from_mail.">\r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
$header .= "This is a multi-part message in MIME format.\r\n";
$header .= "--".$uid."\r\n";
$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$header .= $message."\r\n\r\n";
$header .= "--".$uid."\r\n";
$header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
$header .= "Content-Transfer-Encoding: base64\r\n";
$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
$header .= $content."\r\n\r\n";
$header .= "--".$uid."--";
echo $is_sent = @mail($mailto, $subject, "", $header);

 You can now optionally also send it to the browser
Output();*/


		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = stripslashes('CD4 Mailer alupe.poc@gmail.com');
		$config['smtp_pass'] = stripslashes('pocpassword');
		ini_set("SMTP", "ssl://smtp.gmail.com");
		ini_set("smtp_port", "465");
	//	ini_set("max_execution_time", "50000");
		
			//$emails = "patrick.ndwiga@strathmore.edu";
		
		//pulling emails from the DB

		$mpdf -> library('email', $config);
		$path = $_SERVER["DOCUMENT_ROOT"];
		$file = $path . "pdf/" . $report_name;
		//puts the path where the pdf's are stored
	
            $mpdf -> email -> attach($file);
			$address = "rickinyua@gmail.com";
			$mpdf -> email -> set_newline("\r\n");

			$mpdf -> email -> from('alupe.poc@gmail.com', "pocpassword");
			//user variable displays current user logged in from sessions
			$mpdf -> email -> to("$address");
			$mpdf -> email -> subject('MONTHLY REPORT FOR');
			$mpdf -> email -> message('Please find the Report Attached ');

			//success message else show the error
			if ($mpdf -> email -> send()) {
				echo 'Your email was sent, successfully to ' . $address . '<br/>';
				//unlink($file);
				$mpdf -> email -> clear(TRUE);

			} else {
				show_error($mpdf -> email -> print_debugger());
			}

	
	unlink($file);
	ob_end_flush();
		
		//delete the attachment after sending to avoid clog up of pdf's
	}
	
function mail_attachment($filename,$mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($mailto, $subject, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}	
		
	?>
