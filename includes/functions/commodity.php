<?php
//function to display reagent categories
function reagentCategory($mfl) {
  $sql = "SELECT r.categoryID,r.name,r.equipmentType FROM reagentcategory r,  `equipmentdetails` e WHERE (r.equipmentType = e.`equipment` OR r.equipmentType=0 ) AND e.MFLCode ='$mfl' GROUP BY r.categoryID";
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_array($query)) {
		echo $mytbl = '<tr><td><b>' . $rs['name'] . '</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
		reagents($rs['categoryID']);
	}
}

//function to display the individual  Reaaents and consumables

function reagents($cat) {
	$checker = 0;
	$sql = "SELECT * FROM reagents where categoryID='$cat'";
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_array($query)) {
		echo $mytbl = '<tr><td>' . $rs['code'] . '</td><td>' . $rs['name'] . '</td>
<td>' . $rs['unit'] . '<input name="namer[' . $rs['reagentID'] . ']"  id="namer[' . $rs['reagentID'] . ']" type="hidden" test= "' . $rs['reagentID'] . '" value="' . $rs['reagentID'] . '"></td>
<td><input name="beginningbal[' . $rs['reagentID'] . ']" test= "' . $rs['reagentID'] . '" size="5" type="text" class="text" /></td>
<td><input name="receivedqty[' . $rs['reagentID'] . ']" id="receivedqty[' . $rs['reagentID'] . ']" test= "' . $rs['reagentID'] . '" size="5" type="text" class="text" /></td>
<td><input name="receivedlot[' . $rs['reagentID'] . ']" id="receivedlot[' . $rs['reagentID'] . ']" test= "' . $rs['reagentID'] . '" size="5" type="text" class="text" /></td>
<td><input name="qtyused[' . $rs['reagentID'] . ']" id="' . $rs['reagentID'] . '" size="5" test= "' . $rs['reagentID'] . '" type="text" class="text" /></td>
<td><input name="losses[' . $rs['reagentID'] . ']" id="losses[' . $rs['reagentID'] . ']" size="5" test= "' . $rs['reagentID'] . '" type="text" class="text" /></td>
<td><input name="adjustmentplus[' . $rs['reagentID'] . ']" id="adjustmentplus[' . $rs['reagentID'] . ']" test= "' . $rs['reagentID'] . '" size="5" type="text" class="text" /></td>
<td><input name="adjustmentminus[' . $rs['reagentID'] . ']" id="adjustmentminus[' . $rs['reagentID'] . ']" test= "' . $rs['reagentID'] . '" size="5" type="text" class="text" /></td>
<td><input name="endbal[' . $rs['reagentID'] . ']" id="endbal[' . $rs['reagentID'] . ']" size="5" test= "' . $rs['reagentID'] . '" type="text" class="text" /></td>
<td><input name="requested[' . $rs['reagentID'] . ']" id="requested[' . $rs['reagentID'] . ']" test= "' . $rs['reagentID'] . '" size="5" type="text" class="text" /></td>
</tr>';

		$checher++;
	}
}



function submitcommodity($mflcode, $fromdate, $todate, $caliburtestsAdults,$caliburtestsPead, $caliburs, $counttestsAdults,$counttestsPead, $counts, $cyflowtestsAdults,$cyflowtestsPead, $cyflows, $beginningbal, $receivedqty, $receivedlot, $qtyused, $losses, $adjustmentplus, $adjustmentminus, $endbal, $requested, $reagent,$comments) {
		$sql1="INSERT INTO fcdrrlists SET
		mflcode='$mflcode',
		fromdate='$fromdate', 
		todate='$todate', 
		caliburtestsAdults='$caliburtestsAdults',
		caliburtestsPead='$caliburtestsPead', 
		caliburs='$caliburs', 
		counttestsAdults='$counttestsAdults',
		counttestsPead='$counttestsPead',
		counts='$counts',
		cyflowtestsAdults= '$cyflowtestsAdults',
		cyflowtestsPead= '$cyflowtestsPead',
		cyflows='$cyflows',
		comments='$comments' 
		";
		mysql_query($sql1) or die(mysql_error());
		
		$fcdrrlistID= getPostedFCDRRLIST($mflcode,$fromdate,$todate);
			
	foreach ($beginningbal as $key => $value) {
		$sql2 = "insert into commodity set
		fcdrrlistID='$fcdrrlistID', 		
		beginningbal='$value',		 
		receivedqty='$receivedqty[$key]', 
		receivedlot='$receivedlot[$key]',
		qtyused='$qtyused[$key]',
		losses='$losses[$key]', 
		adjustmentplus='$adjustmentplus[$key]',
		adjustmentminus='$adjustmentminus[$key]',
		endbal='$endbal[$key]', 
		requested='$requested[$key]',
		reagentID='$reagent[$key]'";
		
		if(($value!=NULL)||($receivedqty[$key]!=NULL)||($receivedlot[$key]!=NULL)||
		($qtyused[$key]!=NULL)||($losses[$key]!=NULL)||($adjustmentplus[$key])!=NULL||
		($adjustmentminus[$key]!=NULL)||($endbal[$key]!=NULL)||($requested[$key]!=NULL)/*||($reagent[$key]!=NULL)*/){
		  $query = mysql_query($sql2) or die(mysql_error());
		}
	}
	deleteCommodityTemp($mflcode);
	echo "<script>";
	echo 'window.location.href="FCDRRLists.php?success=FCDRR List Sent To allocation Team"';
	echo "</script>";
}


function getPostedFCDRRList($mflcode,$fromdate,$todate){
		$sql="SELECT * FROM fcdrrlists WHERE mflcode= '$mflcode' AND fromdate='$fromdate'";
		$query=mysql_query($sql) or die("error". mysql_error());
		$fcdrrListID="";		
		while($rs=mysql_fetch_assoc($query)){
				$fcdrrListID=$rs["fcdrrlistID"];				
			}
			
			return $fcdrrListID;
	}

function deleteCommodityTemp($mflcode){
		$sql2="delete from commoditytemp where mflcode='$mflcode'";
		mysql_query($sql2) or die("error". mysql_error());	
	}

function mindatecommodity() {
	$sql = "SELECT MIN(`Date_Analyzed`) as dt FROM  `exp_file_data` WHERE SITE<>0 AND Date_Analyzed>'2000-01-01'";
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}

function maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	 	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data`";
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	 $sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data` where Date_Analyzed BETWEEN '$fromdate' AND '$todate' ";
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data` where Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' ";	
	  			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data` where month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' ";	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data` where YEAR(Date_Analyzed)='$currentyear' ";	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data` where  AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'  ";	
	  	
	  		
	  	}
	
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}



function maxdatecommodityfac($calibur) {
	$sql = "SELECT MAX(`Date_Analyzed`) as dt FROM  `exp_file_data` WHERE CytometerSerialNumber='$calibur' ";
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}

function getTotalfromstart() {
	$sql = "SELECT count(`id`) as dt FROM  `exp_file_data`";
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}

function getTotalthismonth($date) {
	$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` where Date_Analyzed='$date'";
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}

function getTotalspecfromstarts($status,$sql) {
	if ($status == 1) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2".$sql;
	} else if ($status == 0) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2".$sql;
	}
	
	else if($status==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data`".$sql;
	}
	
	
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}


function getTotalspecfromstartscounty($status,$sql) {
	if ($status == 1) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2".$sql;
	} else if ($status == 0) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2".$sql;
	}
	
	else if($status==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data`".$sql;
	}
	
	
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}



function getTotalspecfromstartsfacility($status,$sql) {
	if ($status == 1) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2".$sql;
	} else if ($status == 0) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2".$sql;
	}
	
	else if($status==2){
	$sql="SELECT count(`id`) as dt FROM  `exp_file_data`".$sql;
	}
	
	
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}



function getTotalspecthismonth($date, $status,$sql) {
	if ($status == 1) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND Date_Analyzed='$date'".$sql;
	} else if ($status == 0) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND Date_Analyzed='$date'".$sql;
	}
	
	else if ($status == 2) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE Date_Analyzed='$date'".$sql;
	}
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}

function getTotallowcd4($status) {
	if ($status == 1) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE>2 AND AverageCD3_CD4_AbsCnt<350";
	} else if ($status == 0) {
		$sql = "SELECT count(`id`) as dt FROM  `exp_file_data` WHERE AGE<=2 AND AverageCD3_CD4_Lymph<25";
	}
	$query = mysql_query($sql) or die(mysql_error());
	$re = mysql_fetch_row($query);
	return $re[0];
}

function getfacilityreporting() {
	$sql = "SELECT e.SITE,f.county ,f.countyID, e.Institution FROM `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 GROUP BY f.countyID";
	$q = mysql_query($sql) or die();
	$mya = array();
	for ($i = 0; @$rs = mysql_fetch_array($q); $i++) {
		$mya[$i] = $rs;
	}
	return $mya;
}


function getfacilityreporting3($county) {
	$sql = "SELECT e.SITE,f.facility ,f.countyID, e.Institution FROM `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND f.countyID='$county' GROUP BY e.SITE";
	$q = mysql_query($sql) or die();
	$mya = array();
	for ($i = 0; @$rs = mysql_fetch_array($q); $i++) {
		$mya[$i] = $rs;
	}
	return $mya;
}

//function to know which tests belong where
function extractfacilitytests($siteprefix, $sql) {

	$sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND f.countyID='$siteprefix'" . $sql;
	$query = mysql_query($sql) or die(mysql_error());
	//echo $sql;

	$re = mysql_fetch_row($query);
	return $re[0];
}


function extractfacilitytests2($siteprefix, $sql) {

	$sql = "SELECT count(*)  FROM  `exp_file_data` e WHERE e.SITE='$siteprefix'" . $sql;
	$query = mysql_query($sql) or die(mysql_error());
	//echo $sql;

	$re = mysql_fetch_row($query);
	return $re[0];
}

//function to know which tests belong where
function extractequipmentname($siteprefix, $sql) {

	$sql = "SELECT Sample_ID, Institution, serial_nos FROM  `exp_file_data` " . $sql;
	$query = mysql_query($sql) or die(mysql_error());
	$num ="Facs Calibur";
	while ($re = mysql_fetch_array($query)) {
		$pos = @strpos($re['Sample_ID'], $siteprefix);
		if ($pos === false) {
		//echo $num = "Facs Calibur";
		} else {
		 $num=$re['Institution']." - ".$re['serial_nos'];
		}
	}
	return $num;
}

function testingtrendtable($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	$arr = getfacilityreporting();
	$maxdate=maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	
	foreach ($arr as $key => $value) {
		echo $mytable = '<tr><td nowrap><a href="consumptionreporting.php?id=' .$value['countyID'] . '">' . $value['county'] . '</a></td>
<td nowrap>' . $value['Institution'] . ' Calibur</td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], "") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND Date_Analyzed='$maxdate'") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND AGE>2") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND Date_Analyzed='$maxdate' AND AGE>2") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND Date_Analyzed='$maxdate' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND AGE<=2") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND Date_Analyzed='$maxdate' AND AGE<=2") . '<center></td>
<td nowrap><center>' . extractfacilitytests($value['countyID'], " AND Date_Analyzed='$maxdate' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25") . '<center></td>
<td nowrap><center><a href="consumptionreporting.php?id=' .$value['countyID'] . '">View Details</a></center></td>
</tr>';
	}
	}

//facility
function testingtrendtable3($county,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	$arr = getfacilityreporting3($county);
	$maxdate=maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	
	foreach ($arr as $key => $value) {
		echo $mytable = '<tr><td nowrap>' . $value['facility'] . '</td>
<td nowrap>' . $value['Institution'] . ' Calibur</td>
<td nowrap><center>' . extractfacilitytests2($value['SITE'], "") . '<center></td>
<td nowrap><center>' . extractfacilitytests2($value['SITE'], " AND Date_Analyzed='$maxdate'") . '<center></td>
<td nowrap><center>' . extractfacilitytests2($value['SITE'], " AND AGE>2") . '<center></td>
<td nowrap><center>' . extractfacilitytests2($value['SITE'], " AND AGE<=2") . '<center></td>
<td nowrap><center><a href="facilitydashboard.php?id=' .$value['SITE'] . '">View Details</a></center></td>
</tr>';
	}
	}


function getreportedreagents() {
	$sql = "SELECT * FROM commodity c,reagents r WHERE c.reagentID=r.reagentID group by c.reagentID HAVING max(c.todate)";
	$q = mysql_query($sql) or die();
	$mya = array();
	for ($i = 0; @$rs = mysql_fetch_array($q); $i++) {
		$mya[$i] = $rs;
	}
	return $mya;
}

function vieworderstable() {
	$arr = getreportedreagents();
	foreach ($arr as $key => $value) {
		echo $mytable = '<tr><td nowrap>' . $value['name'] . '<input type="hidden" name="reagent[]" value="' . $value['reagentID'] . '"/>
                                                <input type="hidden" name="enddate[]" value="' . $value['fromdate'] . '"/></td>		
                                                <input type="hidden" name="fromdate[]" value="' . $value['todate'] . '"/></td>
<td nowrap>' . $value['endbal'] . '<input type="hidden" name="endbal[]" value="' . $value['endbal'] . '"/></td>
<td nowrap>' . $value['requested'] . '<input type="hidden" name="required[]" value="' . $value['requested'] . '"/></td>
<td nowrap><center><input name="allocated[]" value="0" type="text" class="text" size="5" disabled/></center></td>
<td nowrap><center><input name="dod[]" value="2013-07-01" type="date" class="text"  size="5" disabled/></center></td>
<td nowrap><input type="checkbox" name="received[]" value="1"></td>
<td nowrap><input type="checkbox" name="rejected[]" value="1"></td>
<td nowrap><textarea  name="comment[]" rows="1" cols="30"> </textarea></td></tr>';
	}
}

function saveorderdet($reagent, $endbal, $required, $allocated, $dod, $received, $rejected, $comment, $enddate, $fromdate, $facility) {
	foreach ($reagent as $key => $value) {
		$sql = "INSERT INTO `commodityorders` (`reagentID`, `endbalance`, `required`, `allocationrate`, `dod`, `received`,
 `rejected`, `comment`, `enddate`, `fromdate`, `facility`) VALUES ('$value', '$endbal[$key]', '$required[$key]', '$allocated[$key]', '$dod[$key]', '$received[$key]', '$rejected[$key]',
  '$comment[$key]', '$enddate[$key]', '$fromdate[$key]','$facility')";

		$query = mysql_query($sql) or die(mysql_error());
	}
}

function loadcommoditypage($mfl) {
	$sql = "SELECT * FROM `commoditytemp`  WHERE mflcode=$mfl";
	$query = mysql_query($sql) or die(mysql_error());
	$res_array = array();
	for ($count = 0; @$row = mysql_fetch_array($query); $count++) {
		$res_array[$count] = $row;
	}
	return $res_array;
}
function loadPrevBegBal($mfl){
	//Beginning balance is the ending balance for the previous month
	$sql="SELECT    `commodity`.`endbal`,
					`commodity`.`reagentID` 
				FROM `fcdrrlists` 
				LEFT JOIN `commodity` 
					ON `fcdrrlists`.`fcdrrlistID`=`commodity`.`fcdrrlistID` 
				WHERE `fcdrrlists`.`mflcode`= '$mfl' 
				AND  `commodity`.`fcdrrlistID` IN 
						(SELECT 	MAX(`commodity`.`fcdrrlistID` ) 
							From `fcdrrlists`
							LEFT JOIN `commodity` 
								ON `fcdrrlists`.`fcdrrlistID`=`commodity`.`fcdrrlistID`
							WHERE `fcdrrlists`.`mflcode`= '$mfl'
							 )";
	$query = mysql_query($sql) or die(mysql_error());
	$res_array = array();
	for ($count = 0; @$row = mysql_fetch_array($query); $count++) {
		$res_array[$count] = $row;
	}
	return $res_array;
	
	}

function loadPrevCommodityPage($fcdrrListId){
		$sql="SELECT * FROM fcdrrlists LEFT JOIN commodity ON commodity.fcdrrlistID=fcdrrlists.fcdrrlistID WHERE fcdrrlists.fcdrrlistID='$fcdrrListId'";
		$query = mysql_query($sql) or die(mysql_error());		
		$res_array=array();
		for($count= 0; @$row = mysql_fetch_array($query); $count++){
				$res_array[$count]=$row;	
						
			}
		return $res_array;
	}



function getserials($mfl){
	$sql="SELECT DISTINCT serial_nos FROM `exp_file_data`";
	$q=mysql_query($sql) or die();
	while($rs=mysql_fetch_array($q)){
		$rs['serial_nos'];
	}
	
}

function checkwhichequip($mfl){
 $sql="SELECT fe.serialNum  FROM facilityequipments fe, facility f WHERE f.MFLCode =  '$mfl'
AND f.AutoID = fe.facility AND fe.serialNum <>  \"\"";
	$q=mysql_query($sql) or die();
	$rs=mysql_fetch_row($q);
	if($rs[0]!=""){return $rs[0];}
	else {
	return "0";
	}
	
}


function checkwhichupload($mfl){
 $sql="SELECT fe.uploadtype  FROM facilityequipments fe, facility f WHERE f.MFLCode =  '$mfl'
AND f.AutoID = fe.facility AND fe.serialNum <>  \"\"";
	$q=mysql_query($sql) or die();
	$rs=mysql_fetch_row($q);
	if($rs[0]!=""){return $rs[0];}
	else {
	return "0";
	}
	
}


//generate pdf to be mailed
function caliburpdfheader($mfl,$value,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	 $maxdate=maxdatecommodityfac($mfl);
	
	if ($filter==0) //last submission
	  {
	  	$sql = "<tr><td><center><b>Detailed Facs Calibur Results for ".$value." For ".$maxdate."</b></center></td></tr>" ;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  		$sql = "<tr><td><center><b>Detailed Facs Calibur Results for" .$value." For Period Between ".$fromdate. " AND " .$todate. " </b></center></td></tr>" ;
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {	
	  $sql = "<tr><td><center><b>Detailed Facs Calibur Results for ".$value. " For Period Between ".$fromfilter." AND ".$tofilter."</b></center></td></tr>" ;			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  $sql = "<tr><td><center><b>Detailed Facs Calibur Results for".$value." For " .date('M,Y',$currentmonth."-".$currentyear). " </b></center></td></tr>" ;	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "<tr><td><center><b>Detailed Facs Calibur Results for ".$value. "For Year: ".$currentyear."</b></center></td></tr>" ;
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  		$sql = "<tr><td><center><b>Detailed Facs Calibur Results for ".$value." For Period Between "  .$fromdate. "AND " .$todate. "</b></center></td></tr>" ;	
	  	
	  		
	  	}

	
	
 return '<table width="100%">
 <tr><td><center><img style="vertical-align: top" src="img/naslogo.jpg"/></center></td></tr>
 <tr><td><center>Ministry of Health</center></td></tr>
<tr><td><center>National Aids and STD Control Program (NASCOP)</center></td></tr>
'.$sql.'

 </table><br />';	
	
}
function caliburpdftableheader(){
	return '<table class="data-table">	<thead style="background=:#9EB3E8;">
		<tr>
		<th>Director</th>
		<th>Operator</th>
		<th>Sample Name</th>
		<th>Sample ID</th>
		<th>Case Number</th>
		<th>Sex</th>
		<th>Age</th>
		<th>Date Analyzed</th>
		<th>(Average) CD3+ %Lymph</th>
		<th>(Average) CD3+ Abs Cnt</th>
		<th>(Average) CD3+CD4+ %Lymph</th>
		<th>(Average) CD3+CD4+ Abs Cnt</th></tr>
		</thead><tbody>';
}
function caliburpdftablebody($mfl,$siteprefix,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	 $maxdate=maxdatecommodityfac($mfl);
   	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed='$maxdate'" ;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' ";
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' ";	
	  			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' ";	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND YEAR(Date_Analyzed)='$currentyear' ";	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'  ";	
	  	
	  		
	  	}
	// echo $sql;
    $query=mysql_query($sql) or die(mysql_error());
    $num="";
	$mytable="";
    while($re=mysql_fetch_array($query)){
            $num='<tr>
<td nowrap><center>'.$re['Director'].'<center></td>
<td nowrap><center>'.$re['Operator'].'<center></td>
<td nowrap><center>'.$re['SampleName'].'<center></td>
<td nowrap><center>'.$re['SampleID'].'<center></td>
<td nowrap><center>'.$re['CaseNumber'].'<center></td>
<td nowrap><center>'.$re['SEX'].'<center></td>
<td nowrap><center>'.$re['AGE'].'<center></td>
<td nowrap><center>'.$re['Date_Analyzed'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3Lymph'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3AbsCnt'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3CD4Lymph'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3CD4AbsCnt'].'<center></td>
</tr>';
        
		 $mytable= $mytable.$num;   
    }
    return $mytable;    
}


//print full worksheet
function caliburwstablebody($mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) {
	 $maxdate=maxdatecommodityfac($mfl);
   	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where Date_Analyzed='$maxdate' AND CytometerSerialNumber='$mfl' " ;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sql = "SELECT *  FROM  `exp_file_data` where Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND CytometerSerialNumber='$mfl'  ";
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT *  FROM  `exp_file_data` where Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND CytometerSerialNumber='$mfl'  ";	
	  			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND CytometerSerialNumber='$mfl'  ";	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT *  FROM  `exp_file_data` where YEAR(Date_Analyzed)='$currentyear' AND CytometerSerialNumber='$mfl'  ";	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where Date_Analyzed BETWEEN '$fromdate' AND '$todate'  AND CytometerSerialNumber='$mfl'  ";	
	  	
	  		
	  	}
	// echo $sql;
    $query=mysql_query($sql) or die(mysql_error());
    $num="";
	$mytable="";
    while($re=mysql_fetch_array($query)){
            $num='<tr>
<td nowrap><center>'.$re['Director'].'<center></td>
<td nowrap><center>'.$re['Operator'].'<center></td>
<td nowrap><center>'.$re['SampleName'].'<center></td>
<td nowrap><center>'.$re['SampleID'].'<center></td>
<td nowrap><center>'.$re['CaseNumber'].'<center></td>
<td nowrap><center>'.$re['SEX'].'<center></td>
<td nowrap><center>'.$re['AGE'].'<center></td>
<td nowrap><center>'.$re['Date_Analyzed'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3Lymph'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3AbsCnt'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3CD4Lymph'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3CD4AbsCnt'].'<center></td>
</tr>';
        
		 $mytable= $mytable.$num;   
    }
    return $mytable;    
}




function getreportingfacility($mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
     $maxdate=maxdatecommodityfac($mfl);
	        if ($filter==0) //last submission
	  {
	   $sequel="SELECT * FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.CytometerSerialNumber='$mfl'
	    AND Date_Analyzed='$maxdate' GROUP BY e.SITE";	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  	$sequel="SELECT * FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.CytometerSerialNumber='$mfl'
	    AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' GROUP BY e.SITE";
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  			$sequel="SELECT * FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.CytometerSerialNumber='$mfl'
	    AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' GROUP BY e.SITE";
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  		$sequel="SELECT * FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.CytometerSerialNumber='$mfl'
	   AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' GROUP BY e.SITE";

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sequel="SELECT * FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.CytometerSerialNumber='$mfl'
	   AND YEAR(Date_Analyzed)='$currentyear' GROUP BY e.SITE";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  		$sequel="SELECT * FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.CytometerSerialNumber='$mfl'
	   AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' GROUP BY e.SITE";
	  	}
   
   //echo $sequel;
   
   
    $q=mysql_query($sequel) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}    
return $mya;
}


function extractfactests($mfl,$siteprefix, $sql, $filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
     $maxdate=maxdatecommodityfac($mfl);
   	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.SITE='$siteprefix' AND Date_Analyzed='$maxdate'" . $sql;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' " . $sql;
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' " . $sql;	
	  			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.SITE='$siteprefix' AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' " . $sql;	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.SITE='$siteprefix' AND YEAR(Date_Analyzed)='$currentyear' " . $sql;	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT count(*)  FROM  `exp_file_data` e,facilitycounty f WHERE e.SITE=F.MFLCode AND e.SITE<>0 AND e.SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'  " . $sql;	
	  	
	  		
	  	}
   //echo $sql;
	
	$query = mysql_query($sql) or die(mysql_error());
	//echo $sql;

	$re = mysql_fetch_row($query);
	return $re[0];
}


///summary for print today worksheet
function extractwstests($calibur, $sql, $filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
     $maxdate=maxdatecommodityfac($calibur);
   	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT count(*)  FROM  `exp_file_data`  WHERE CytometerSerialNumber='$calibur' AND Date_Analyzed='$maxdate'" . $sql;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sql = "SELECT count(*)  FROM  `exp_file_data` WHERE CytometerSerialNumber='$calibur' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' " . $sql;
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT count(*)  FROM  `exp_file_data` WHERE CytometerSerialNumber='$calibur' AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' " . $sql;	
	  			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT count(*)  FROM  `exp_file_data`  WHERE CytometerSerialNumber='$calibur' AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' " . $sql;	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT count(*)  FROM  `exp_file_data`  WHERE CytometerSerialNumber='$calibur' AND YEAR(Date_Analyzed)='$currentyear' " . $sql;	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT count(*)  FROM  `exp_file_data`  WHERE CytometerSerialNumber='$calibur' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'  " . $sql;	
	  	
	  		
	  	}
   //echo $sql;
	
	$query = mysql_query($sql) or die(mysql_error());
	//echo $sql;

	$re = mysql_fetch_row($query);
	return $re[0];
}





///function to get popup coontent
function extractexpfacilitytests($siteprefix,$mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
    //echo $siteprefix;
     $maxdate=maxdatecommodityfac($mfl);
   	        if ($filter==0) //last submission
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed='$maxdate'" ;
	    }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' ";
	  	 
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  $sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' ";	
	  			
	  	
	  	
	  }
	    elseif ($filter==3)//month/year
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' ";	
	  	

 	  }
	    elseif ($filter==4)//year only
	  {
	  		$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND YEAR(Date_Analyzed)='$currentyear' ";	
	  	
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	$sql = "SELECT *  FROM  `exp_file_data` where SITE='$siteprefix' AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'  ";	
	  	
	  		
	  	}
    $query=mysql_query($sql) or die(mysql_error());
    $num="";
	$mytable="";
    while($re=mysql_fetch_array($query)){
            $num='<tr>
<td nowrap><center>'.$re['Director'].'<center></td>
<td nowrap><center>'.$re['Operator'].'<center></td>
<td nowrap><center>'.$re['SampleName'].'<center></td>
<td nowrap><center>'.$re['SampleID'].'<center></td>
<td nowrap><center>'.$re['CaseNumber'].'<center></td>
<td nowrap><center>'.$re['SEX'].'<center></td>
<td nowrap><center>'.$re['AGE'].'<center></td>
<td nowrap><center>'.$re['Date_Analyzed'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3Lymph'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3AbsCnt'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3CD4Lymph'].'<center></td>
<td nowrap><center>'.$re['CD3CD4CD45TruCCD3CD4AbsCnt'].'<center></td>
</tr>';
        
		 $mytable= $mytable.$num;   
    }
    return $mytable;    
}






function testingreportingtable($mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	$arr = getreportingfacility($mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	$maxdate=maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	
	foreach ($arr as $key => $value) {
		$tabular=extractexpfacilitytests($value['SITE'],$mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
		echo $mytable = '<tr><td nowrap><a href="#myModal_'.$value['SITE'].$mfl.'" data-toggle="modal" class="menuitem submenuheader">' . $value['facility'] . '</a></td>
<td nowrap>' . $value['Institution'] . ' Calibur</td>
<td nowrap><center>' . extractfactests($mfl,$value['SITE'], "",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center>' . extractfactests($mfl,$value['SITE'], " AND AGE>2",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate). '<center></td>
<td nowrap><center>' . extractfactests($mfl,$value['SITE'], " AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center>' . extractfactests($mfl,$value['SITE'], " AND AGE<=2",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center>' . extractfactests($mfl,$value['SITE'], " AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center><a  target=\'_blank\' href="caliburpdfprint.php?site='.$value['facility'].'&prefix='.$value['SITE'].'
&mwaka='. $currentyear.'&mwezi='.$currentmonth.'&filtertype='.$filter.'&fromfilter='.$fromfilter.'&tofilter='.$tofilter.'&fromdate='.$fromdate.'
&todate='.$todate.'"  title="Click to Print Summary results"><img src="img/print.png"/></a><center></td>
<td nowrap><center><a  target=\'_blank\' href="caliburindivprint.php?site='.$value['facility'].'&prefix='.$value['SITE'].'
&mwaka='. $currentyear.'&mwezi='.$currentmonth.'&filtertype='.$filter.'&fromfilter='.$fromfilter.'&tofilter='.$tofilter.'&fromdate='.$fromdate.'
&todate='.$todate.'"  title="Click to Print Individual results"><img src="img/print.png"/></a><center></td>	
<td nowrap><center><a href="#myModal_'.$value['SITE'].'" data-toggle="modal" class="menuitem submenuheader"><img src="img/email.png" title="Click to Email"></a><center>
<center></center>
<div id="myModal_'.$value['SITE'].$mfl.'" class="modal hide fade" style="left:20%;" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width; >
	<div class="modal-header">
	
	<div class="section-title"><center>Test Results for &nbsp;'.$value['facility'].'</center></div>
		
	</div>
	<div class="modal-body">	
         <table class="data-table">
	<thead>
		<tr>
		<th>Director</th>
		<th>Operator</th>
		<th>Sample Name</th>
		<th>Sample ID</th>
		<th>Case Number</th>
		<th>Sex</th>
		<th>Age</th>
		<th>Date Analyzed</th>
		<th>(Average) CD3+ %Lymph</th>
		<th>(Average) CD3+ Abs Cnt</th>
		<th>(Average) CD3+CD4+ %Lymph</th>
		<th>(Average) CD3+CD4+ Abs Cnt</th></tr>
		</thead>
	'.$tabular.'
	</table>

	</div>
	<div class="modal-footer">
	
	<div class="right">
			&copy;'.date('Y').' NASCOP
		</div>
	</div>
</div><div id="myModal_'.$value['SITE'].'" class="modal hide fade" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width; >
	<div class="modal-header">
	
	<center>Please enter an email address to send the facs calibur results for-&nbsp;<u>'.$value['facility'].'</u></center>&nbsp;&nbsp;
		
	</div>
	<div class="modal-body">	
         <form name="frm" action="caliburpdfmail.php" method="post" enctype="multipart/form-data" id="f1">
		 <input type="text" name="input_value" required>
		 <input type="hidden" name="site" value="'.$value['facility'].'">
		 <input  type="hidden" name="prefix" value="'.$value['SITE'].'">
		  <input  type="hidden" name="filter" value="'.$filter.'">
		  <input  type="hidden" name="currentmonth" value="'.$currentmonth.'">
		   <input  type="hidden" name="currentyear" value="'.$currentyear.'">
		   <input  type="hidden" name="fromfilter" value="'.$fromfilter.'">
		   <input  type="hidden" name="tofilter" value="'.$tofilter.'">
		   <input  type="hidden" name="fromdate" value="'.$fromdate.'">
		   <input  type="hidden" name="todate" value="'.$todate.'">
		 <div style="display:block;margin-top:1em">
		 <button class="btn btn-primary" input type="submit" name="submit" >
		submit
		</button>
		<button class="btn" input type="reset" name="cancel" aria-hidden="true" data-dismiss="modal">
		cancel
		</button>
		</div>
       </form>
	</div>
	<div class="modal-footer">
	
	<div class="right">
			&copy;'.date('Y').' NASCOP
		</div>
	</div>
</div><center></center></td>
</tr>
';
	}
	}
  
//function  to put summary in todays worksheet

function wssummary($mfl,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
	$tbl="";
	return '<ecnter><table width="100%" class="data-table">
	<thead>
	<tr>
	  <th rowspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Total Tests Done&nbsp;&nbsp;&nbsp;&nbsp;</th>
        
        <th colspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<center>Adult Tests</center>&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<center>Paediatric Tests</center>&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>
    <tr>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Total Tests&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;# CD4 < 350cells/mm3&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Total Tests&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;# CD4 < 25%&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
	
	</thead>
<tbody><tr>
<td nowrap><center>' . extractwstests($mfl,"",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center>' . extractwstests($mfl," AND AGE>2",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate). '<center></td>
<td nowrap><center>' . extractwstests($mfl," AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center>' . extractwstests($mfl," AND AGE<=2",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>
<td nowrap><center>' . extractwstests($mfl," AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25",$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) . '<center></td>

</tr></tbody>
	</table></center>';
	
}

function updatecommodity(	$fcdrrListID,
							$mflcode, 
							$fromdate, 
							$todate, 
							$caliburtestsAdults,
							$caliburtestsPead, 
							$caliburs, 
							$counttestsAdults,
							$counttestsPead, 
							$counts, 
							$cyflowtestsAdults,
							$cyflowtestsPead, 
							$cyflows,
							$comments, 
							$commodityID,
							$beginningbal, 
							$receivedqty, 
							$receivedlot, 
							$qtyused, 
							$losses, 
							$adjustmentplus, 
							$adjustmentminus, 
							$endbal, 
							$requested, 
							$reagent) {
	
	$sql="UPDATE fcdrrlists SET 
		mflcode='$mflcode',
		fromdate='$fromdate',
		todate='$todate',
		caliburtestsAdults='$caliburtestsAdults',
		caliburtestsPead='$caliburtestsPead',
		caliburs='$caliburs',
		counttestsAdults='$counttestsAdults',
		counttestsPead='$counttestsPead',
		counts='$counts',
		comments='$comments',
		cyflowtestsAdults='$counttestsAdults',
		cyflowtestsPead='$counttestsPead',
		cyflows='$cyflows' WHERE fcdrrlistID='$fcdrrListID'";

		mysql_query($sql) or die(mysql_error());
		
		foreach ($beginningbal as $key => $value) {
		$sql2 = "UPDATE commodity SET		 		
		beginningbal='$value',		 
		receivedqty='$receivedqty[$key]', 
		receivedlot='$receivedlot[$key]',
		qtyused='$qtyused[$key]',
		losses='$losses[$key]', 
		adjustmentplus='$adjustmentplus[$key]',
		adjustmentminus='$adjustmentminus[$key]',
		endbal='$endbal[$key]', 
		requested='$requested[$key]',
		reagentID='$reagent[$key]' 
		WHERE commodityID = 'commodityID[$key]'";
		
		if(($value!=NULL)||($receivedqty[$key]!=NULL)||($receivedlot[$key]!=NULL)||
		($qtyused[$key]!=NULL)||($losses[$key]!=NULL)||($adjustmentplus[$key])!=NULL||
		($adjustmentminus[$key]!=NULL)||($endbal[$key]!=NULL)||($requested[$key]!=NULL)/*||($reagent[$key]!=NULL)*/){
		  $query = mysql_query($sql2) or die(mysql_error());
		}
	}

}


?>