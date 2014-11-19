<?php
error_reporting(-1);

$db_host = 'localhost';
$db_username = 'root';
$db_pass = '';
$db_name = 'cd4';

mysql_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql"); 
mysql_select_db("$db_name") or die ("no database");
$counter=0;
if(isset($_POST['submit'])){

$facility=$_POST['facility'];
$equipment=$_POST['equiptype'];
$serialNum = mysql_real_escape_string($_POST['equipmentserial']);

$sql="INSERT INTO facilityequipments (facility,equipment,status,serialNum) VALUES (".$facility.",".$equipment.",1,'".$serialNum."')";


$insertequipdata= mysql_query($sql) or die(mysql_error());

header("location:facilityEquip.php");			
}


?>