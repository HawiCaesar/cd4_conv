<?php
//get all the weighting criteria
function getWeighting(){
$sql="SELECT * FROM criteriaweighting ";	
 
$q=mysql_query($sql) or die();
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;	 
}
return $mya;
}


//get country settings
function getcountrysettings(){
$sql="SELECT * FROM countrytestingprofile";	
 
$q=mysql_query($sql) or die();
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;	 
}
return $mya;
}

//get facility with cd4 equipment
function getfacilitywithcd4($fac){
$sql="SELECT count(*) as counter FROM selects WHERE facility='$fac' AND category=1";	
$q=mysql_query($sql) or die(mysql_error());
$num=mysql_num_rows($q) or die();
$rs=mysql_fetch_array($q);
$mya=$rs[0];
return $mya;
}



//insert weighting
function updateWeighting($cd4art,$cdfpreart,$hr,$day,$access,$patients,$from,$to){
    $sql="UPDATE criteriaweighting SET access='$access', patients='$patients'  WHERE ID='1'";
mysql_query($sql) or die();	
updateCountry($cd4art,$cdfpreart,$hr,$day,$from,$to);
echo '<script type="text/javascript">';
echo "window.location.href='selectedFac.php'";
echo '</script>';
}
function updateCountry($cd4art,$cdfpreart,$hr,$day,$from,$to){
   $sql="UPDATE countrytestingprofile SET cd4art='$cd4art', cd4preart='$cdfpreart',hoursperday='$hr',hoursperyear='$day',rangefrom='2',rangeto='15' WHERE ID='1'";
mysql_query($sql) or die(mysql_error());
}

//max dist

function maxdistance(){
$from=rangefrom();
$to=rangeto();
$sql="SELECT max(`distance`) FROM `selects`  WHERE (
`need_per_day` >='$from'
AND  `need_per_day` <='$to'
)";
$mu=mysql_query($sql);
$a=mysql_fetch_row($mu);
return $a[0];	
}
//calculate need

function selectionNeed($rank){
$maxdist=maxdistance();
$from=rangefrom();
$to=rangeto();
if($rank==2){
$sql="SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c WHERE (`need_per_day` >='$from' AND  `need_per_day` <='$to') GROUP BY(MFLCode) order by rank desc";
}
else if($rank==1){
$sql="SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c WHERE (`need_per_day` >='$from' AND  `need_per_day` <='$to') GROUP BY(MFLCode) order by county ASC";
}
//echo $sql;
$q=mysql_query($sql) or die(mysql_error());
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}
return $mya;
}

//chosen facilities
function selectionNeed2($rank){
$maxdist=maxdistance();
$from=rangefrom();
$to=rangeto();
if($rank==2){
$sql="SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c,selectedfacilitiesforequipment sf WHERE (`need_per_day` >='$from' AND  `need_per_day` <='$to') AND s.MFLCode=sf.selectedmfl GROUP BY(MFLCode) order by rank desc";
}
else if($rank==1){
$sql="SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c,selectedfacilitiesforequipment sf WHERE (`need_per_day` >='$from' AND  `need_per_day` <='$to') AND s.MFLCode=sf.selectedmfl GROUP BY(MFLCode) order by county ASC";
}
//echo $sql;
$q=mysql_query($sql) or die(mysql_error());
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}
return $mya;
}



//insert selected facilities for equipment allocation
function selectedfacilitiesforequipment($mfl){
	$query=mysql_query("INSERT INTO selectedfacilitiesforequipment(selectedmfl) VALUES('$mfl')") or die(mysql_error());	
	echo "<script type='text/javascript'>";
	echo 'window.location.href="chosenFac.php"';
	echo "</script>";
	
}
//function to remove any record from facilities chosen for device
function truncateselectedfacilitiesforequipment(){
	$query=mysql_query("truncate selectedfacilitiesforequipment") or die(mysql_error());	
	
}

?>