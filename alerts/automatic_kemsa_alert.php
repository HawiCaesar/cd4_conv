<?php
  	// @require_once('phpmailer/class.phpmailer.php');	
	//require_once("../includes/functions/commodityf.php");
	include("../pdf/mpdf/mpdf.php");
	require_once('../phpmailer/class.phpmailer.php');
	require('../pdf/mysql_table.php');

	$host="localhost";
	$user="root";
	$pass="";
	$db="cd4";
	//connect
	$con=mysql_connect($host,$user,$pass);
	//fetch db
	$getDb=mysql_select_db($db,$con);

	$previous_month=date('m')-1;
	$year=date('Y');

	$fromdate=$year.'-'.$previous_month.'-01';
	$num_of_days=cal_days_in_month(CAL_GREGORIAN, $previous_month,$year);
	$todate=$year.'-'.$previous_month.'-'.$num_of_days;

	$result_fcdrr_list="";
	$mflcode=0;

	$sql_fcdrr="SELECT * FROM fcdrrlists 
			LEFT JOIN facility ON fcdrrlists.mflcode=facility.MFLCode
			WHERE fromdate  BETWEEN '".$fromdate."' AND '".$todate."' AND todate BETWEEN '".$fromdate."' AND '".$todate."' GROUP BY fcdrrlists.mflcode";

	$query_fcdrr=mysql_query($sql_fcdrr,$con) or die(mysql_error());

	if($query_fcdrr)
	{
		while($result_fcdrr_list=mysql_fetch_assoc($query_fcdrr))
		{
			$mflcode=$result_fcdrr_list["mflcode"];
			$sql_equipment_details="SELECT * FROM `equipmentdetails` WHERE MFLCode='$mflcode' GROUP BY MFLCode";
			$query_equipment_details=mysql_query($sql_equipment_details) or die(mysql_error());
			$result_equipment_details=mysql_fetch_row($query_equipment_details);

			$header='<h2>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>';
			$mytable1='
			<table bordercolor="#000000" border="single" class="data-table" id="table">
						 <colgroup><col width="100">
					  	 <col width="50">	
						 </colgroup><tbody>
					<tr>
					    <td><b>Name of Facility:</b></td>
					    <td colspan="4">'.$result_fcdrr_list["name"].'<center></center></td>
					    <td><b>Facility Code:</b></td>
					    <td><center> '.$result_fcdrr_list["MFLCode"].'</center></td>
					    <td colspan="2"><b>District:</b></td>
					    <td><center> '.$result_equipment_details[14].'</center></td>
					    <td><b>Province/County:</b></td> 
					    <td colspan="2"><center> '.$result_equipment_details[16].'</center></td>
					    <td><b>Affiliation:</b></td> 
					    <td><center> '.$result_equipment_details[8].'</center></td>
				  	</tr>
			  
				  	<tr>
					    <td align="right" colspan="2"><b>REPORT FOR PERIOD:</b></td>
					    <td colspan="3"><b>BEGINNING:</b></td>
					    <td colspan="2">
					    <center id="from"> '.$result_fcdrr_list["fromdate"].'</center>
					    
					    </td>
					    <td colspan="3"><b>ENDING:<b></b></b></td>
					    <td colspan="3"><center id="to"> '. $result_fcdrr_list["todate"].'</center></td>
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
					    <td><label for="caliburesult_fcdrr_list" class="">Equip </label></td>
					    <td colspan="1" rowspan="2"><b>Cyflow Partec</b></td>
					    <td>
					    	<label for="caliburtestsPead" class="">Pead </label></td>
					    <td><label for="caliburtestsAdults4" class="">Adults</label></td>
					    <td><label for="caliburs4" class="">Equip </label></td>
					    <td rowspan="2">&nbsp;</td>
			  		</tr>
			 		 <tr>
					    <td><span id="caliburtestsPead"> '.$result_fcdrr_list["caliburtestsPead"].'</span></td>
					    <td><span id="caliburtestsAdults"> '. $result_fcdrr_list["caliburtestsAdults"].'</span></td>
					    <td><span id="caliburs"> '.$result_fcdrr_list["caliburs"].'</span></td>
					    <td> '.$result_fcdrr_list["counttestsPead"].'</td>
					    <td><span id="counttestsAdults"> '. $result_fcdrr_list["counttestsAdults"].'</span></td>
					    <td><span id="counts"> '. $result_fcdrr_list["counts"].'</span></td>
					    <td><span id="cyflowtestsPead"> '.$result_fcdrr_list["cyflowtestsPead"].'</span></td>
					    <td><span id="cyflowtestsAdults"> '.$result_fcdrr_list["cyflowtestsAdults"].'</span></td>
					    <td><span id="cyflows"> '. $result_fcdrr_list["cyflows"].'</span></td>
			  		</tr>';
			$mytab2='
					<tr>
					    <td colspan="7"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>
					    <td colspan="10"><center> '. $result_fcdrr_list["cyflowtestsAdults"]+$result_fcdrr_list["cyflowtestsPead"]+$result_fcdrr_list["counttestsAdults"]+$result_fcdrr_list["counttestsPead"]+$result_fcdrr_list["caliburtestsPead"]+$result_fcdrr_list["caliburtestsAdults"].'</center></td>
					    
					</tr>
					<tr>		 
						<td rowspan="2"><b>COMMODITY CODE</b></td>
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
			reagentCategoryPrinta($mflcode,$result_fcdrr_list['fcdrrlistID']).'

	            	<tr align="left">
	            		<td colspan="1"><b>FCDRR Comments</b></td>
				  		<td colspan="14"><span name="comments" id="comments" cols="250"> '. $result_fcdrr_list["comments"].'</span></td>
			  		</tr>

				</tbody>
			</table>';
			$mytable=$mytable1.$mytab2;
			$html = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
			table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
			table.data-table td, table th {padding: 4px;}
			table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
			.col5{background:#D8D8D8;}</style>'.$header.$mytable.'</tbody></table>';
			$html_data=$html;

			
			$mpdf=new mPDF(); 
			$mpdf->AddPage('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, ''); 
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
			try
			{
				$filename=$_SERVER['DOCUMENT_ROOT'].'/cd4/alerts/generated_fcdrr_reports/'.$result_fcdrr_list['name'].'.pdf';

				$mpdf->Output($filename,'F');
			}
			catch(exception $e)
			{
				$e->getMessage();
			}
		}
		$month_name=GetMonthName($previous_month);
		$mail             = new PHPMailer();
		$mail->IsSMTP(); 						   // telling the class to use SMTP
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		                                           // 1 = errors and messages
		                                           // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "ssl://smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "cd4system@gmail.com";  // GMAIL username
		$mail->Password   = "pocpassword";            // GMAIL password

		$mail->SetFrom('cd4system@gmail.com', 'CD4 Administrator');

		$mail->Subject    = "CD4 FCDRR Commodity Reports for ".$month_name." - ".$year." ";

		$Addresses=array('lab@kemsa.co.ke');
		$CC_addresses=array('omarabdi2@yahoo.com');
		$BCC_addresses=array('tngugi@clintonhealthaccess.org');

		$file_counter=0;
		$dir=$_SERVER['DOCUMENT_ROOT'].'/cd4/alerts/generated_fcdrr_reports/';
		$dh = opendir($dir);

        while ($file = readdir($dh) ) 
        {
        	if(!is_dir($file) && strpos($file, '.pdf')>0) { 

        		$mail->AddAttachment($dir.$file); // add fcdrr facility attachments
        		$file_counter++;
     		 }
        }
        closedir($dh);

  		// $Addresses=array('brianhawi92@gmail.com');
		// $CC_addresses=array('brian.odhiambo932@gmail.com','kanyonga.nicholas@gmail.com');
		// $BCC_addresses=array('tngugi@clintonhealthaccess.org','tngugi@gmail.com');

		foreach($Addresses as $ToAddress)
		{
			$mail->AddAddress($ToAddress);
		}
		foreach($CC_addresses as $ToCC)
		{
			$mail->AddCC($ToCC);
		}
		foreach($BCC_addresses as $ToBCC)
		{
			$mail->AddBCC($ToBCC);
		}

        $body_message="Dear KEMSA,<br />
						Find attached the ".$file_counter."  FCDRR Reports For ART Lab Monitoring Reagents for ".$month_name." ".$year.".<br />
						Regards.";
		$mail->MsgHTML($body_message);	

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  echo "Message sent!";
		}
    				
	}

?>

<?php	

//function to display the individual  Reagents and consumables

function reagentsPrinta($cat,$fcdrrList) {

	$host="localhost";
	$user="root";
	$pass="";
	$db="cd4";
	//connect
	$con=mysql_connect($host,$user,$pass);
	//fetch db
	$getDb=mysql_select_db($db,$con);

	$checker = 0;
	$sql = "SELECT * FROM reagents where categoryID='$cat'";
	$mytab="";
	$query = mysql_query($sql,$con) or die(mysql_error());
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

	$host="localhost";
	$user="root";
	$pass="";
	$db="cd4";
	//connect
	$con=mysql_connect($host,$user,$pass);
	//fetch db
	$getDb=mysql_select_db($db,$con);

	$val="";
	$sq4 = "SELECT * FROM commodity WHERE reagentID='$reagent' AND fcdrrlistID='$fcdrrList,'";
	$query4 = mysql_query($sq4,$con) or die(mysql_error());
	while ($rs4 = mysql_fetch_array($query4)){
		$val=$rs4[$field];
			
		}
	return $val;
	}

function reagentCategoryPrinta($mfl,$fcdrrList) {
	$host="localhost";
	$user="root";
	$pass="";
	$db="cd4";
	//connect
	$con=mysql_connect($host,$user,$pass);
	//fetch db
	$getDb=mysql_select_db($db,$con);

  $sql = "SELECT r.categoryID,r.name,r.equipmentType FROM reagentcategory r,  `equipmentdetails` e WHERE (r.equipmentType = e.`equipment` OR r.equipmentType=0 ) AND e.MFLCode ='$mfl' GROUP BY r.categoryID";
	$query = mysql_query($sql,$con) or die(mysql_error());
	$myt="";
	while ($rs = mysql_fetch_array($query)) {
		 $mytbl = '<tr><td colspan="15"><b>' . $rs['name'] . '</b></td></tr>';
		$mine=reagentsPrinta($rs['categoryID'],$fcdrrList);
		$myt=$myt.$mytbl.$mine;
	}
	return $myt;
}

function GetMonthName($month)
{
	$monthname="";

	 if ($month==1)
	 {
	     $monthname="January";
	 }
	  else if ($month==2)
	 {
	 	$monthname="February";
	 }else if ($month==3)
	 {
	     $monthname="March";
	 }else if ($month==4)
	 {
	     $monthname="April";
	 }else if ($month==5)
	 {
	     $monthname="May";
	 }else if ($month==6)
	 {
	     $monthname="June";
	 }else if ($month==7)
	 {
	     $monthname="July";
	 }else if ($month==8)
	 {
	     $monthname="August";
	 }else if ($month==9)
	 {
	     $monthname="September";
	 }else if ($month==10)
	 {
	     $monthname="October";
	 }else if ($month==11)
	 {
	     $monthname="November";
	 }
	  else if ($month==12)
	 {
	     $monthname="December";
	 }
	  else if ($month==13)
	 {
	     $monthname=" Jan - Sep  ";
	 }
	return $monthname;
}


?>