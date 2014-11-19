<?php
ob_start();
session_start();
ini_set("max_execution_time",'1000000');
		ini_set("memory_size",'512M');

@include("includes/dbConf.php");
$db=new dbConf();
@require_once('phpmailer/class.phpmailer.php');	
@conn();
$site=$_POST['site'];
$filter=$_POST['filter'];
$currentmonth=$_POST['currentmonth'];
$currentyear=$_POST['currentyear'];
$fromfilter=$_POST['fromfilter'];
$tofilter=$_POST['tofilter'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$prefix=$_POST['prefix'];
$mfl=$_SESSION['calibur'];
$sender=$_POST['input_value'];
$html = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style>'.caliburpdfheader($mine,$site,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate). caliburpdftableheader().
caliburpdftablebody($mfl,$prefix,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate).
'</tbody></table>

';


$html_data=$html;

$html2='<table width="80%" ><thead></thead><tbody>'.
physicianrptattr($mfl,$prefix,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
.'</tbody></table>';

//==============================================================
//==============================================================
//==============================================================
include("pdf/mpdf/mpdf.php");
require('pdf/mysql_table.php');
$mpdf=new mPDF(); 
$mpdf1=new mPDF(); 
$mpdf1=new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, ''); 
$mpdf=new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, ''); 
$mpdf1->SetDisplayMode('fullpage');
$mpdf1->simpleTables = true;

$mpdf->SetDisplayMode('fullpage');
$mpdf->simpleTables = true;

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
$mpdf1->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
//Generate pdf using mpdf
               
                $mpdf ->SetWatermarkText("Nascop",-5);
                $mpdf ->watermark_font = "sans-serif";
                $mpdf ->showWatermarkText = true;
				$mpdf ->watermark_size="0.5";
				
				$mpdf1 ->SetWatermarkText("Nascop",-5);
                $mpdf1 ->watermark_font = "sans-serif";
                $mpdf1 ->showWatermarkText = true;
				$mpdf1 ->watermark_size="0.5";
// LOAD a stylesheet
//$stylesheet = file_get_contents('pdf/mpdf/examples/mpdfstyletables.css');
//$mpdf->WriteHTML($stylesheet);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html_data);
$mpdf1->WriteHTML($html2);
try{
$mpdf->Output('CD4 Test Report for '. $site.'.pdf','F');
$mpdf1->Output('Individual CD4 Physician Results for'. $site.'.pdf','F');
}
catch(exception $e){
	$e->getMessage();
}
//mail_attachment('CD4 Report.pdf','rickinyua@gmail.com','alupe.poc@gmail.com', 'CD4 Admin', 'alupe.poc@gmail.com', 'Report', 'Utahama lini Mbaus');

$reporttitle='CD4 Test Report for '. $site.'.pdf';
$reporttitle1='Individual CD4 Physician Results for '. $site.'.pdf';
$doc=$mpdf->Output('mpdf.pdf','S');
$doc1=$mpdf1->Output('mpdf.pdf','S');
$myname=$_SESSION['username'];
$subject="CD4 Test Report for ".$site;
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->FromName = $myname;
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'alupe.poc@gmail.com';
//$mail->$From='alupe.poc@gmail.com';
$mail->Password = 'pocpassword';
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465; 
$email="prickinyua@yahoo.com";
$ContactEmail="mwangikevinn@gmail.com";
$partner=facilitymail($prefix);
$mail->AddAddress($sender);
if($partner<> NULL){
	//echo $partner;
	//exit();
	$mail->AddCC($partner);
	
}
$mail->AddBCC($ContactEmail);
$mail->AddBCC($email);
$mail->Subject = $subject;
$mail->IsHTML(false);
$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
$mail->AddStringAttachment($doc1, $reporttitle1, 'base64', 'application/pdf');
$mail->Body = "
Please find attached CD4 Test Results.

Any pending results are still being processed and will be sent to you once they are ready.

Many Thanks.

--

CD4 Support.
"
;
if(!$mail->Send())
{
   $errorsending= $mail->ErrorInfo;
ECHO   $errorsending;
     
}
else
{ $msg='CD4 Calibur results for '.$site.' successfully sent';
	echo '<script type="text/javascript">';
	echo "window.location.href='facscaliburresults.php?successsave=$msg'";
	echo '</script>';
//ECHO "SUCCESS";
 
}


exit;
//==============================================================
//==============================================================
//==============================================================

ob_end_flush();
?>