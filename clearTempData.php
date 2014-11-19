<?php 
	include 'includes/dbConf.php';
	$db=new dbConf();
	if(isset($_POST['MFLCode'])){
		$mfl=$_POST['MFLCode'];
		$sql="DELETE FROM `commoditytemp` WHERE `commoditytemp`.`mflcode`=$mfl";
		mysql_query($sql) or die(mysql_error());
	}
?>