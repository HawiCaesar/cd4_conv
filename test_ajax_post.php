<?php
include 'includes/dbConf.php';
$db=new dbConf();

function checkifrowexists($mfl,$drug){
	$sql="SELECT count(commodityID) FROM commoditytemp where mflcode='$mfl' AND reagentID='$drug'";
	$q=mysql_query($sql) or die();
	$rs=mysql_fetch_row($q);
	return $rs[0];
}

if(isset($_POST['facility_code'])){
$facility_code=$_POST['facility_code'];
$drug_id=$_POST['drug_id'];
$beg_bal=$_POST['beginning_bal'];
$received_qty=$_POST['received_qty'];
$received_lot=$_POST['received_lot'];
$qty_used=$_POST['qty_used'];
$losses=$_POST['losses'];
$adjustmentplus=$_POST['adjustmentplus'];
$adjustmentminus=$_POST['adjustmentminus'];
$endbal=$_POST['endbal'];
$requested=$_POST['requested'];
$to=date('Y-m-d', strtotime($_POST['to']));
$from=date('Y-m-d', strtotime($_POST['from']));
$caliburtestsAdults=$_POST['caliburtestsAdults'];
$caliburtestsPead=$_POST['caliburtestsPead'];
$caliburs=$_POST['caliburs'];
$counttestsAdults=$_POST['counttestsAdults'];
$counttestsPead=$_POST['counttestsPead'];
$counts=$_POST['counts'];
$cyflowtestsAdults=$_POST['cyflowtestsAdults'];
$cyflowtestsPead=$_POST['cyflowtestsPead'];
$cyflows=$_POST['cyflows'];
$comments=$_POST['comments'];


//echo "This what you have post facility= $facility_code $to $from $caliburtests $caliburs $counttests $counts $cyflowtests $cyflows $drug_id $beg_bal $received_qty $received_lot $qty_used $losses $adjustmentplus $adjustmentminus $endbal $requested";
$count=checkifrowexists($facility_code,$drug_id);
if($count>0){
$sql="UPDATE  `commoditytemp` SET  `fromdate` =  '$from', `todate` =  '$to',`caliburtestsAdults`='$caliburtestsAdults',`caliburtestsPead`='$caliburtestsPead',`caliburs`='$caliburs',`counttestsAdults`='$counttestsAdults', `counttestsPead`='$counttestsPead',`counts`='$counts', `cyflowtestsAdults`='$cyflowtestsAdults',`cyflowtestsPead`='$cyflowtestsPead',`cyflows`='$cyflows', `beginningbal`='$beg_bal', `receivedqty`='$received_qty', `receivedlot`='$received_lot', `qtyused`='$qty_used', `losses`= '$losses', `adjustmentplus`='$adjustmentplus', `adjustmentminus`='$adjustmentminus', `endbal`='$endbal', `requested`='$requested',`comments`='$comments'
  WHERE  `mflcode` =  '$facility_code' AND  `reagentID`='$drug_id'";
}
else if($count==0) {
$sql="INSERT INTO `commoditytemp` (`mflcode`, `fromdate`, `todate`, `caliburtestsAdults`,`caliburtestsPead`, `caliburs`, `counttestsAdults`,`counttestsPead`, `counts`, `cyflowtestsAdults`,`cyflowtestsPead`, `cyflows`, `beginningbal`,
 `receivedqty`, `receivedlot`, `qtyused`, `losses`, `adjustmentplus`, `adjustmentminus`, `endbal`, `requested`, `reagentID`,`comments`)
  VALUES ('$facility_code', '$from', '$to', '$caliburtestsAdults','$caliburtestsPead', '$caliburs', 
  '$counttestsAdults', '$counttestsPead', '$counts', '$cyflowtestsAdults','$cyflowtestsPead', '$cyflows', '$beg_bal', '$received_qty', '$received_lot', '$qty_used', '$losses', '$adjustmentplus', '$adjustmentminus', '$endbal', '$requested', '$drug_id','$comments');";
}
echo $sql;
$query=mysql_query($sql) or die(mysql_error());
}
?>

