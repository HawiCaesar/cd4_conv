<?php
ob_start();
include("includes/dbConf.php");
$db=new dbConf();
$partnerid=$_SESSION['userID'];
$year=$_GET['yrAnn'];
$month=$_GET['month'];
$quarter=$_GET['quarter'];
$biannual=$_GET['biAnn'];
$dev=$_GET['dev'];
$cat=$_GET['category'];
$num=1;

if($cat==1){
$sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND month(resultDate)='".$month."'  AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During ".$month. "-" .$year ." FOR " .$dev;
}
else if($cat==3){
	if($biannual==1){
$sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND month(resultDate)<7  AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During Jan to Jun-" .$year ." FOR " .$dev;
}
	if($quarter==2){
$sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND month(resultDate)>6 AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During Jul to Dec-" .$year ." FOR " .$dev;
}
}
else if($cat==2){
	if($quarter==1){
$sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND month(resultDate)<5  AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During Jan to Apr-" .$year ." FOR " .$dev;
}
	if($quarter==2){
$sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND month(resultDate)>4 AND month(resultDate)<9  AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During May to Aug-" .$year ." FOR " .$dev;
}
	if($quarter==3){
$sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND month(resultDate)>8 AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During Sept to Dec-" .$year ." FOR " .$dev;
}
}

else if($cat==4){
echo $sql="SELECT `deviceID`,`resultDate`,sampleNumber,errorName, `cdCount`,operatorId, uploadDate FROM error, test WHERE  test.partnerID ='".$partnerid."' AND year(resultDate)='".$year."' AND deviceID='".$dev."' AND test.errorID = error.errorID OR test.errorID = '0'";
$title=  " During the year of ".$year ." FOR " .$dev;
}
$query=mysql_query($sql) or die(mysql_error());


$filename="TEST OUTCOME REPORT FOR CD4 Count".strtoupper($title);
	$reportitle=" TEST OUTCOME REPORT FOR CD4 SAMPLES TESTED ";
//@header("Content-type: application/vnd.ms-excel");
//@header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
	
?>
				<table border="1"   class="data-table">
				
			<tr>
			<td colspan='9' align='center'>
			<b> <?php echo $reportitle; ?> </b>
			</td>
			</tr>	
	<tr spry:setrownumber="1">
	<th rowspan=2>#</th><th rowspan=2>Device Number</th><th rowspan=2>Sample Number</th>  <th rowspan=2>Error</th><th rowspan=2>CD Count </th><th rowspan=2>Operator Name </th><th rowspan=2>Result Date</th><th rowspan=2>Upload Date</th>
</tr>	
<tbody>
<tr>&nbsp;</tr>
<?php while($rs=mysql_fetch_array($query)){?>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rs['deviceID']; ?></td>
<td><?php echo $rs['sampleNumber']; ?></td>
<td><?php echo $rs['errorName']; ?></td>
<td><?php echo $rs['cdCount']; ?></td>
<td><?php echo $rs['operatorId']; ?></td>
<td><?php echo $rs['resultDate']; ?></td>
<td><?php echo $rs['uploadDate']; ?></td>
</tr>

<?php $num++; } ?>





</tbody></table>
<?php
ob_flush();
?>