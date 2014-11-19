<?php 
	session_start();
	$dat=$_GET['date'];
	$date=date('M,Y',strtotime($dat));
	require_once("includes/dbConf.php");
	$db = new dbConf();
    @require_once('phpmailer/class.phpmailer.php');	
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
			//var_dump($rs2);
			
			
			
			}
		}
		$mflcode=$rs2["mflcode"];
		$sql="SELECT * FROM `equipmentdetails` WHERE MFLCode='$mflcode' GROUP BY MFLCode";
		$q=mysql_query($sql) or die(mysql_error());
		$rs=mysql_fetch_row($q);
		
	$header='<h2>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>';
	


$mytable1='
	<table bordercolor="#000000" border="single" class="data-table" id="table">
	 <colgroup><col width="100">
  	<col width="50">	
	</colgroup><tbody><tr>
    <td><b>Name of Facility:</b></td>
    <td colspan="4">'.$rs2["name"].'<center></center></td>
    <td><b>Facility Code:</b></td>
    <td><center> '.$rs2["MFLCode"].'</center></td>
    <td colspan="2"><b>District:</b></td>
    <td><center> '.$rs[14].'</center></td>
    <td><b>Province/County:</b></td> 
    <td colspan="2"><center> '.$rs[16].'</center></td>
    <td><b>Affiliation:</b></td> 
    <td><center> '.$rs[8].'</center></td>
  </tr>
  
  <tr>
    <td align="right" colspan="2"><b>REPORT FOR PERIOD:</b></td>
    <td colspan="3"><b>BEGINNING:</b></td>
    <td colspan="2">
    <center id="from"> '.$rs2["fromdate"].'</center>
    
    </td>
    <td colspan="3"><b>ENDING:<b></b></b></td>
    <td colspan="3"><center id="to"> '. $rs2["todate"].'</center></td>
    <td colspan="2"></td>    
  </tr>
  <tr>
    <td colspan="2" rowspan="2" align="left"><b>State the number of CD4 Tests conducted:-</b></td>
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
    	<span id="caliburtestsPead"> '.$rs2["caliburtestsPead"].'</span></td>
    <td><span id="caliburtestsAdults"> '. $rs2["caliburtestsAdults"].'</span></td>
    <td><span id="caliburs"> '.$rs2["caliburs"].'</span></td>
    <td> '.$rs2["counttestsPead"].'</td>
    <td><span id="counttestsAdults"> '. $rs2["counttestsAdults"].'</span></td>
    <td><span id="counts"> '. $rs2["counts"].'</span></td>
    <td><span id="cyflowtestsPead"> '.$rs2["cyflowtestsPead"].'</span></td>
    <td><span id="cyflowtestsAdults"> '.$rs2["cyflowtestsAdults"].'</span></td>
    <td><span id="cyflows"> '. $rs2["cyflows"].'
    </span></td>
  </tr>';
$mytab2='
  <tr>
    <td colspan="7"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>
    <td colspan="10"><center> '. $rs2["cyflowtestsAdults"]+$rs2["cyflowtestsPead"]+$rs2["counttestsAdults"]+$rs2["counttestsPead"]+$rs2["caliburtestsPead"]+$rs2["caliburtestsAdults"].'</center></td>
    
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
            </tr> '.
reagentCategoryPrinta($mflcode,$fcdrrList).'

            	<tr align="left"><td colspan="1"><b>FCDRR Comments</b></td>
			  	<td colspan="14"><span name="comments" id="comments" cols="250"> '. $rs2["comments"].'</span></td></tr>

</tbody></table>';
$mytable=$mytable1.$mytab2;
$html = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style>'.$header.$mytable.'</tbody></table>';
$html_data=$html;

include("pdf/mpdf/mpdf.php");
require('pdf/mysql_table.php');
$mpdf=new mPDF(); 
$mpdf=new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, ''); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->simpleTables = true;

$mpdf->SetDisplayMode('fullpage');
$mpdf->simpleTables = true;

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
//Generate pdf using mpdf
               
                $mpdf ->SetWatermarkText("Nascop",-5);
                $mpdf ->watermark_font = "sans-serif";
                $mpdf ->showWatermarkText = true;
				$mpdf ->watermark_size="0.5";
// LOAD a stylesheet
//$stylesheet = file_get_contents('pdf/mpdf/examples/mpdfstyletables.css');
//$mpdf->WriteHTML($stylesheet);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html_data);
try{
$mpdf->Output('FCDRR Summary.pdf','I');
}
catch(exception $e){
	$e->getMessage();
}



?>




<?php	

//function to display the individual  Reagents and consumables

function reagentsPrinta($cat,$fcdrrList) {
	$checker = 0;
	$sql = "SELECT * FROM reagents where categoryID='$cat'";
	$mytab="";
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_array($query)) {
		
		
	$mytbl = '<tr><td>' . $rs['code'] . '</td><td>' . $rs['name'] . '</td>
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
	$mytab=$mytab.$mytbl;		
			
		$checker++;
	}
return $mytab;
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

function reagentCategoryPrinta($mfl,$fcdrrList) {
  $sql = "SELECT r.categoryID,r.name,r.equipmentType FROM reagentcategory r,  `equipmentdetails` e WHERE (r.equipmentType = e.`equipment` OR r.equipmentType=0 ) AND e.MFLCode ='$mfl' GROUP BY r.categoryID";
	$query = mysql_query($sql) or die(mysql_error());
	$myt="";
	while ($rs = mysql_fetch_array($query)) {
		 $mytbl = '<tr><td colspan="15"><b>' . $rs['name'] . '</b></td></tr>';
		$mine=reagentsPrinta($rs['categoryID'],$fcdrrList);
		$myt=$myt.$mytbl.$mine;
	}
	return $myt;
}


?>