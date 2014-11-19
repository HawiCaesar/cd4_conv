<?php
require('Connections/config.php');
/*
update mother fcode*/
/*$sql = "select facilitys.ID as 'FID',facilitys.facilitycode as 'mid' ,mothers.facility,mothers.fcode  from facilitys,mothers where facilitys.facilitycode=mothers.fcode AND mothers.facility IS NULL LIMIT 0,5000 " ;*/



$sql = "select facility.AutoID as 'newautoid',facility.MFLCode as 'newmflcode',facility.name as 'newfname', facility.centralsiteAutoID as 'newcentralsiteautoid',facility.level as 'newflevel', facilitys.facilityID as 'oldautoid',facilitys.facilitycode as 'oldmflcode', facilitys.facilityName as 'oldfname' from facility,facilitys where facility.name=facilitys.facilityName" ;

$result=  mysql_query($sql) or die(mysql_error()); 
$count=0;
while ($row=mysql_fetch_array($result))
{
$newautoid=$row['newautoid'];
$newmflcode=$row['newmflcode'];
$newfname=$row['newfname'];
$newcentralsiteautoid=$row['newcentralsiteautoid'];
$newflevel=$row['newflevel'];
$oldautoid=$row['oldautoid'];
$oldmflcode=$row['oldmflcode'];
$oldfname=$row['oldfname'];


if ($newflevel == 0)
{
$newflevel=2;
}
else
{
$newflevel=$newflevel;
}
/*
if ($newcentralsiteautoid >0)
{

$s=mysql_query("select facilityID  from facilitys where autofacility='$newcentralsiteautoid'")or die(mysql_error());
$ds=mysql_fetch_array($s);
$facilitycode=$ds['facilityID'];
$xs=mysql_query("update facilitys set centralsiteautoID='$facilitycode' where facilityName='$newfname' ")or die(mysql_error());
$count=$count+1;
}
else
{

}
*/
//$xs=mysql_query("update facility set MFLCode='$oldmflcode' where name='$oldfname'")or die(mysql_error());

//$xs=mysql_query("update mothers set facility='$d' where  fcode='$mid'")or die(mysql_error());
//echo $row['FID']."<br>";
$xs=mysql_query("update facilitys set level='$newflevel' where facilityName='$newfname' ")or die(mysql_error());
$count=$count+1;
 }
 if  ($xs)
{
echo $count. " Facilitys Updated";
}


/*$sql = "select  AutoID  from patients " ;

$result=  mysql_query($sql) or die(mysql_error());
$i=1;
while ($row=mysql_fetch_array($result))
{
$d=$row['AutoID'];
//echo $d . " ".$i;
$xs=mysql_query("update patients set mother='$i' where  AutoID='$d'")or die(mysql_error());
$i++;
//$xs=mysql_query("update mothers set facility='$d' where  fcode='$mid'")or die(mysql_error());
//echo $row['FID']."<br>";
 }
 if  ($xs)
{
echo "yes to alupe mum";
}*/
?>
