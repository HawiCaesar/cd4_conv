<?php 
include ("includes/commodityheader.php");
require_once ("includes/dbConf.php");
$db = new dbConf();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$from = date('Y-m-d', strtotime($_POST['from']));
	$to = date('Y-m-d', strtotime($_POST['to']));
	
	updatecommodity(
		$_POST['fcdrrListID'],
		$_POST['mfl'],  
		$from, 
		$to, 
		$_POST['caliburtestsAdults'],
		$_POST['caliburtestsPead'], 
		$_POST['caliburs'], 
		$_POST['counttestsAdults'],
		$_POST['counttestsPead'], 
		$_POST['counts'], 
		$_POST['cyflowtestsAdults'], 
		$_POST['cyflowtestsPead'],
		$_POST['cyflows'], 
		$_POST['commodityID'],
		$_POST['beginningbal'], 
		$_POST['receivedqty'], 
		$_POST['receivedlot'], 
		$_POST['qtyused'], 
		$_POST['losses'], 
		$_POST['adjustmentplus'], 
		$_POST['adjustmentminus'], 
		$_POST['endbal'], 
		$_POST['requested'], 
		$_POST['namer']);

}


?>