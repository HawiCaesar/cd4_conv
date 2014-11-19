
		<?php
ob_start();
ini_set("max_execution_time",'1000000');
		ini_set("memory_size",'512M');

@include("includes/dbConf.php");
$db=new dbConf();
@require_once('phpmailer/class.phpmailer.php');	
@conn();
$site=$_GET['site'];

$prefix=$_GET['prefix'];
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
$mine=$_SESSION['calibur'];
?>
<html>
	<head></head>
	<body onLoad="javascript:window.print();">
<?php
$html = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style>'.caliburpdfheader($mine,$site,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate). 
wssummary($mine,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate).
caliburpdftableheader().
caliburwstablebody($mine,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) .
'</tbody></table>';
echo $html_data=$html;
?>

</body></html>


<?php



ob_end_flush();
?>