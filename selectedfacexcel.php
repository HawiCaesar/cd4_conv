<?php
SESSION_START();

//get range from
function rangefrom(){
$sql="SELECT rangefrom FROM countrytestingprofile";	
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
return $rs[0];	
}

//get range from
function rangeto(){
$sql="SELECT rangeto from countrytestingprofile";	
$q=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($q);	
return $rs[0];	
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
include('function.php');
require('Connections/config.php');
$ranker=2;	
 $facilities=selectionNeed($ranker);
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
$filename="Facility selection Report";
header("Content-type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="'.$filename.'.xls"');

$maxdist=maxdistance();
$eq=mysql_query("SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c WHERE (`need_per_day` >=8 AND  `need_per_day` <=15) order by rank desc") or die(mysql_error());

$num_categories=mysql_num_rows($eq);
?>
<table style="font-family:cambria; font-size:18px" class="data-table" border="1" >
<tr> <th><center><small> # </small></center></th> 
<th><center><small>MFL Code </small></center></th> 
<th><center><small>Facility</small></center></th>
<th><center><small>Total patients</small></center></th>
<th><center><small>Need Per Year</small></center></th>
<th><center><small>Need per Day</small></center></th>
<th><center><small>Distance</small></center></th>
<th><center><small>County</small></center></th>
<th><center><small>Score</small></center></th>
</tr>





 <?php 
$num=1;

foreach ($facilities as $b=>$result){
$counters=getfacilitywithcd4($result['facility']);
if($counters==0){
?>
<tr>
<td> <center><small> <?php  echo $num; ?></small></center> </td>
<td> <center><small> <?php  echo $result['MFLCode']; ?></small></center> </td>
<td><small> <?php  echo $result['fname']; ?></small></td>
<td> <center><small> <?php  echo $result['patients'];?></small></center> </td>
<td> <center><small> <?php  echo $result['need'];?></small></center> </td>
<td> <center><small> <?php  echo round($result['need_per_day'],2);?></small></center> </td>
<td> <center><small> <?php  echo $result['distance'];?></small></center> </td>
<td> <center><small> <?php  echo $result['county'];?></small></center> </td>
<td> <center><small> <?php  echo round($result['rank'],3);?></small></center> </td>
</tr>
<?php 
}
$num++;
}
?>
</table>