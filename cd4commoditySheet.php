<?php 
	session_start();
	$dat=$_GET['date'];
	$date=date('M,Y',strtotime($dat));
$filename="FCDRR LIST FOR ".$_SESSION['username']." Dated ".$date;
	$reportitle="FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) LIST FOR ".$_SESSION['username']." Dated ".$date;
@header("Content-type: application/vnd.ms-excel");
@header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
	require_once ("includes/dbConf.php");
	$db = new dbConf();
	
	require_once("includes/functions/commodityf.php");
	$arr="";
	
	$rs2="";
	$rs2="";
	$query3="";
	$mflcode=10000000000000000000000000000000000000000000000000000000000;
	if ($_SERVER['REQUEST_METHOD']=='GET'){
		if(isset($_GET["fcdrrlistID"])){
			$fcdrrList=$_GET['fcdrrlistID'];
			$sql2="SELECT * FROM fcdrrlists 
			LEFT JOIN facility ON fcdrrlists.mflcode=facility.MFLCode 			
			WHERE fcdrrlists.fcdrrlistID ='".$_GET['fcdrrlistID']."'";
			
			$sql3="SELECT * FROM commodity
				WHERE  fcdrrlistID ='".$_GET['fcdrrlistID']."'";
			
			$query2=mysql_query($sql2) or die(mysql_error());
			$query3=mysql_query($sql3) or die(mysql_error());
			
			$rs2=mysql_fetch_assoc($query2);
			
			
			
			
			}
		}
		$mflcode=$rs2["mflcode"];
		$sql="SELECT * FROM `equipmentdetails` WHERE MFLCode='$mflcode' GROUP BY MFLCode";
		$q=mysql_query($sql) or die(mysql_error());
		$rs=mysql_fetch_row($q);
		
		

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<h2>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>



	<table bordercolor="#000000" border="single" class="" id="table">
	 <colgroup><col width="100">
  	<col width="50">	
	</colgroup><tbody><tr>
    <td><b>Name of Facility:</b></td>
    <td colspan="4"><?php echo $rs2["name"];?><center></center></td>
    <td><b>Facility Code:</b></td>
    <td><center><?php echo $rs2["MFLCode"];?></center></td>
    <td colspan="2"><b>District:</b></td>
    <td><center><?php echo $rs[14];?></center></td>
    <td><b>Province/County:</b></td> 
    <td colspan="2"><center><?php echo  $rs[16];?></center></td>
    <td><b>Affiliation:</b></td> 
    <td><center><?php echo  $rs[8];?></center></td>
  </tr>
  
  <tr>
    <td align="right" colspan="2"><b>REPORT FOR PERIOD:</b></td>
    <td colspan="3"><b>BEGINNING:</b></td>
    <td colspan="2">
    
    <!--<input type="text" name="from" id="from" class="textsprint" placeholder="DD/MM/YYYY" required value="" readonly="readonly" />-->
    <center id="from"><?php echo $rs2["fromdate"];?></center>
    
    </td>
    <td colspan="3"><b>ENDING:<b></b></b></td>
    <td colspan="3"><center id="to"><?php echo $rs2["todate"];?></center></td>
    <td colspan="2"></td>    
  </tr>
  <tr>
    <th colspan="2" rowspan="2" align="left"><b>State the number of CD4 Tests conducted:-</b></th>
    <td colspan="1" rowspan="2"><b> Calibur:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    
    <td>
    	<label for="caliburtestsPead" class="">Pead </label></td>
    <td><label for="caliburtestsAdults3" class="">Adults</label></td>
    <td><label for="caliburs3" class="">Equip </label></td>
    <td colspan="1" rowspan="2"><b> Count:</b></td>
    <td>
    	<label for="caliburtestsPead" class="">Pead </label></td>
    <td><label for="caliburtestsAdults2" class="">Adults</label></td>
    <td><label for="caliburs2" class="">Equip </label></td>
    <td colspan="1" rowspan="2"><b>Cyflow Partec</b></td>
    <td>
    	<label for="caliburtestsPead" class="">Pead </label></td>
    <td><label for="caliburtestsAdults4" class="">Adults</label></td>
    <td><label for="caliburs4" class="">Equip </label></td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>
    	<span id="caliburtestsPead"><?php echo $rs2["caliburtestsPead"]; ?></span></td>
    <td><span id="caliburtestsAdults"><?php echo $rs2["caliburtestsAdults"]; ?></span></td>
    <td><span id="caliburs"><?php echo $rs2["caliburs"]; ?></span></td>
    <td><?php echo $rs2["counttestsPead"]; ?></td>
    <td><span id="counttestsAdults"><?php echo $rs2["counttestsAdults"]; ?></span></td>
    <td><span id="counts"><?php echo $rs2["counts"]; ?></span></td>
    <td><span id="cyflowtestsPead"><?php echo $rs2["cyflowtestsPead"]; ?></span></td>
    <td><span id="cyflowtestsAdults"><?php echo $rs2["cyflowtestsAdults"]; ?></span></td>
    <td><span id="cyflows"><?php echo $rs2["cyflows"]; ?>
      <input type="hidden" name="totalsites" id="totalsites" value="1">
    </span></td>
  </tr>
  <tr>
    <td colspan="7"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>
    <td colspan="10"><center><?php echo $rs2["cyflowtestsAdults"]+$rs2["cyflowtestsPead"]+$rs2["counttestsAdults"]+$rs2["counttestsPead"]+$rs2["caliburtestsPead"]+$rs2["caliburtestsAdults"];?></center></td>
    
  </tr>


<tr>		 <td rowspan="2"><b>COMMODITY CODE</b></td>
			<td rowspan="2"><b>COMMODITY NAME</b></td>
            <td rowspan="2"><b>UNIT OF ISSUE</b></td>
            <td colspan="2" rowspan="2"><b>BEGINNING BALANCE</b></td>
            <td colspan="2"><b>QUANTITY RECEIVED FROM CENTRAL<br> WAREHOUSE (e.g. KEMSA)</b></td>             
            <td colspan="2" rowspan="2"><b>QUANTITY USED</b></td>
            <td rowspan="2"><b>LOSSES/WASTAGE</b></td>
            <td colspan="3"><b>ADJUSTMENTS<br><i>Indicate if (+) or (-)</i></b></td>
            <td rowspan="2"><b>ENDING BALANCE <br>PYSICAL COUNT at end of the Month</b></td>
            <td rowspan="2"><b>QUANTITY REQUESTED</b></td>
            </tr>
            
            
            <tr>      
             <td>Quantity</td>
            <td>Lot No.</td>
            <td>Positive</td>
            <td colspan="2">Negative</td>    
            </tr>
            <?php
reagentCategoryPrint($mflcode,$fcdrrList);
			?>

            	<td colspan="1"><b>FCDRR Comments</b></td>
			  	<td colspan="14"><span name="comments" id="comments" cols="250"><?php echo $rs2["comments"];?></span></td></tr>

</tbody></table>


</body>
</html>

<?php
	
 
	function reagentCategoryPrint($mfl,$fcdrrList) {
  $sql = "SELECT r.categoryID,r.name,r.equipmentType FROM reagentcategory r,  `equipmentdetails` e WHERE (r.equipmentType = e.`equipment` OR r.equipmentType=0 ) AND e.MFLCode ='$mfl' GROUP BY r.categoryID";
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_array($query)) {
		echo $mytbl = '<tr><td colspan="15"><b>' . $rs['name'] . '</b></td></tr>';
		reagentsPrint($rs['categoryID'],$fcdrrList);
	}
}

//function to display the individual  Reagents and consumables

function reagentsPrint($cat,$fcdrrList) {
	$checker = 0;
	$sql = "SELECT * FROM reagents where categoryID='$cat'";
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_array($query)) {
		
		
		echo $mytbl = '<tr><td>' . $rs['code'] . '</td><td>' . $rs['name'] . '</td>
<td >' . $rs['unit'] . '<input  name="namer[' . $rs['reagentID'] . ']"  id="namer[' . $rs['reagentID'] . ']" type="hidden" test= "' . $rs['reagentID'] . '" value="' . $rs['reagentID'] . '"></td>
<td colspan="2"><center id="beginningbal' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'beginningbal').'</center></td>
<td><center id="receivedqty' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'receivedqty').'</center></td>
<td><center id="receivedlot' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'receivedlot').'</center></td>
<td colspan="2"><center id="qtyused' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'qtyused').'</center></td>
<td><center id="losses' . $rs['reagentID'] . '" >'.getValues($fcdrrList,$rs['reagentID'],'losses').'</center></td>
<td><center id="adjustmentplus' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'adjustmentplus').'</center></td>
<td colspan="2"><center id="adjustmentminus' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'adjustmentminus').'</center></td>
<td><center id="endbal' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'endbal').'</center></td>
<td><center id="requested' . $rs['reagentID'] . '">'.getValues($fcdrrList,$rs['reagentID'],'requested').'</center></td>
</tr>';
			
			
		$checker++;
	}
}

function getValues($fcdrrList,$reagent,$field){
	$val="";
	$sq4 = "SELECT * FROM commodity WHERE reagentID='$reagent' AND fcdrrlistID='$fcdrrList,'";
	$query4 = mysql_query($sq4) or die(mysql_error());
	while ($rs4 = mysql_fetch_array($query4)){
		$val=$rs4[$field];
			
		}
	return $val;
	}


?>