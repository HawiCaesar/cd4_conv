<?php
function getcd4Equipment(){
$sql="SELECT * FROM equipments WHERE category =1";
$q=mysql_query($sql) or die();
$myarr=array();
for($i=0;@$r=mysql_fetch_array($q);$i++){
$myarr[$i]=$r;
//$myarr[1]=$r['ID'];
}
return $myarr;
}


function getchemEquipment(){
$sql="SELECT * FROM equipments WHERE category =5";
$q=mysql_query($sql) or die();
$myarr=array();
for($i=0;@$r=mysql_fetch_array($q);$i++){
$myarr[$i]=$r;
//$myarr[1]=$r['ID'];
}
return $myarr;
}

function gethermEquipment(){
$sql="SELECT * FROM equipments WHERE category =3";
$q=mysql_query($sql) or die();
$myarr=array();
for($i=0;@$r=mysql_fetch_array($q);$i++){
$myarr[$i]=$r;
//$myarr[1]=$r['ID'];
}
return $myarr;
}


function mapit(){
// Internal IDs of continents & respective population 
$dataArray[0][1]="01"; // Asia
$dataArray[0][2]="3779000000"; // Population 
$dataArray[1][1]="02"; // Europe
$dataArray[1][2]="727000000";// Population
$dataArray[2][1]="03"; // Africa
$dataArray[2][2]="877500000";// Population
$dataArray[3][1]="04"; // North America
$dataArray[3][2]="421500000";// Population
$dataArray[4][1]="05"; // South America
$dataArray[4][2]="379500000";// Population
$dataArray[5][1]="06"; // Central America
$dataArray[5][2]="80200000";// Population
$dataArray[6][1]="07"; // Oceania
$dataArray[6][2]="32000000";// Population
$dataArray[7][1]="08"; // Middle East
$dataArray[7][2]="179000000";// Population

// Declare $strXML to store dataXML of the map 
$strXML="";

// Opening MAP element
$strXML = "<map showLabels='1' includeNameInLabels='1' borderColor='FFFFFF' fillAlpha='80' showBevel='0' legendPosition='Bottom' >";

// Setting Color ranges : 4 color ranges for population ranges
$strXML .= "<colorRange>";
$strXML .= "<color minValue='1' maxValue='100000000' displayValue='Population : Below 100 M' color='CC0001' />";
$strXML .= "<color minValue='100000000' maxValue='500000000' displayValue='Population :100 - 500 M' color='FFD33A' />";
$strXML .= "<color minValue='500000000' maxValue='1000000000' displayValue='Population :500 - 1000 M' color='069F06' />";
$strXML .= "<color minValue='1000000000' maxValue='5000000000' displayValue='Population : Above 1000 M' color='ABF456' />";
$strXML .= "</colorRange><data>";

// Opening data element that will store map data
// Using Data from array for each entity 
for($i=0;$i<=7;$i++){
$strXML .= "<entity id='" . $dataArray[$i][1] . "' value='" . $dataArray[$i][2] . "' />";
}
// closing data element 
$strXML .= "</data>";

// closing map element
$strXML .= "</map>";

// Finally Rendering the World8 Maps with renderMap() php function present in FusionMaps.php (that we have inlcuded already) 
// Since we're using dataXML method, we provide a "" value for dataURL here

return $strXML;	
}

//equipment in category
function getTotalEquipmentcat($equipment,$status){
$sql="SELECT count(ID) FROM `equipmentdetails` WHERE equipment='$equipment' AND status='$status'";	
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
return  $rs[0];	
}

//total equipment
function getTotalEquipment($equipment){
$sql="SELECT count(ID) FROM `equipmentdetails` WHERE equipment='$equipment'";	
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
echo $rs[0];	
}


function getCentralFacSites($county){
$sql="SELECT * from facilitycounty WHERE AutoID='$county'";	

$query=mysql_query($sql) or die(mysql_error());
return $query;
}


function getFacReferalSites($id){
$num=1;
$sql="SELECT * FROM  facilitycounty WHERE centralsiteAutoID='".$id."'";
 $query=mysql_query($sql) or die(mysql_error());
 $num=1;
 while($rs=mysql_fetch_array($query)){
echo $mytbl='<tr>
<td width="2%"><small><center>'.$num.'</center></small></td>
<td width="17%"><small><center>&nbsp;</center></small></td>
<td width="18%"><small><center>'.$rs['facility'].'</center></small></td>
<td width="13%"><small><center>'.$rs['distance'].'</center></small></td>
<td width="25%"><table><tr><td><small><center>'.$rs['ontreatment'].'</center></small></td>
<td ><small><center>'.$rs['oncare'].'</center></small></td>
<td><small><center>'.($rs['ontreatment']+$rs["oncare"]).'</center></small></td>
</tr></table></td>
<td width="6%"><small><center>'.getTotalFacEquipmentcat(1,1,$rs['AutoID']).'</center></small></td>
<td width="10%"><small><center>'.getTotalFacEquipmentcat(3,1,$rs['AutoID']).'</center></small></td>
<td width="7%"><small><center>'.getTotalFacEquipmentcat(5,1,$rs['AutoID']).'</center></small></td>
</tr>';
$num++;
}
// return $mytbl;
}

function getEquipmentTotals($cat,$status){
if ($status==0){
$sql="SELECT COUNT(*) FROM  `equipmentdetails` WHERE category ='$cat'";
}
else{
$sql="SELECT COUNT(*) FROM  `equipmentdetails` WHERE category ='$cat' AND status='$status'";
}
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
echo $rs[0];
}


//get countys
function getCountys(){
$sql="SELECT * FROM countys ORDER BY name ASC ";	
$q=mysql_query($sql) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}	
return $mya;
}

function getperiods(){
	$sql="SELECT distinct(Date_Analyzed) FROM  `exp_file_data`";	
$q=mysql_query($sql) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}	
return $mya;
}
//get equipment
function getEquiped(){
$sql="SELECT * FROM equipmentcategories WHERE description NOT LIKE  '%placement%' ORDER BY description ASC  ";	
$q=mysql_query($sql) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
}	
return $mya;
}

//get spec equipment
function getSpecEquiped($cat){
$sql="SELECT description,  equipments.ID FROM  `equipments`,facilityequipments WHERE  `category` ='$cat' AND facilityequipments.equipment = equipments.ID Group BY description";	
$q=mysql_query($sql) or die();
$num=1;
while($rs=mysql_fetch_array($q)){
echo "<option value=".$rs['ID'].">"."&nbsp;&nbsp;".$num.". ".$rs['description']."</option>";
$num++;
}	
}



function facilityPerCounty($county,$start,$stop){
$sql="SELECT * FROM facilitycounty WHERE countyID ='$county' AND level=0 GROUP BY(AutoID) ";
$q=mysql_query($sql) or die();
$num=mysql_num_rows($q) or die();
$mya=array();
$mya2=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;
//$mya2[]=$rs;	
}	
//$response=array('found'=>$num,'facilities'=>$mya2);
//cho json_encode($response);
return $mya;	 
}

//equipment in category
function getTotalFacEquipmentcat($equipment,$status,$fac){
//echo $sql="SELECT count(ID) FROM facilityequipments WHERE equipment='$equipment' AND status='$status' AND facility='$fac'";	
 $sql="SELECT COUNT( ID ) FROM  `equipmentdetails` WHERE  `facility` ='$fac' AND  `category` ='$equipment' ";
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
//echo $rs[0];	
return $rs[0];	
}

//Get county name
function getCountyNames($county){
$sql="SELECT name FROM `countys` WHERE ID='$county'";	
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
echo $rs[0];	
}

//function to display broken down devices pop up
function getEquipmentStatus($status,$type){
$sql="SELECT * FROM  `countys` , facilityequipments, facility, districts,facilitypatients, equipments WHERE districts.county = countys.ID
      AND facility.district = districts.ID AND facilityequipments.facility = facility.AutoID AND facilitypatients.facility = facility.AutoID
      AND  equipments.ID=facilityequipments.equipment AND equipments.category='$type'
      AND facilityequipments.status='$status'";	
 
$q=mysql_query($sql) or die();
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;	 
}
return $mya;
}

//function to display devices present
function getAvailableEquipment($fac,$equip){
$sql="SELECT * FROM   facilityequipments,equipments WHERE facilityequipments.facility = '$fac' AND facilityequipments.equipment=equipments.ID AND equipments.category='$equip'";	
$q=mysql_query($sql) or die();
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;	 
}
return $mya;
}

//sites selected
function sitesSel(){
$rangefrom=rangefrom();
$rangeto=rangeto();
$sql="SELECT facility FROM  `selects` WHERE (`need_per_day` >='$rangefrom' AND `need_per_day` <='$rangeto')";	
$q=mysql_query($sql) or die();
$num=0;
for($i=0;@$rs=mysql_fetch_row($q);$i++){
$counters=getfacilitywithcd4($rs['facility']);
if($counters==0){
$num++;
}
else{$num+=0;}
}	
echo $num;	
}
//total patient load

//sites selected
function patentloadSel(){
$rangefrom=rangefrom();
$rangeto=rangeto();
$sql="SELECT sum(patients) FROM  `selects`  WHERE (`need_per_day` >='$rangefrom' AND `need_per_day` <='$rangeto')";	
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
echo $rs[0];	
}

//sites selected county
function patentloadSelCounty($county){
$rangefrom=rangefrom();
$rangeto=rangeto();
$sql="SELECT sum(patients) FROM  `selects`  WHERE (`need_per_day` >='$rangefrom' AND `need_per_day` <='$rangeto' AND countyID='$county')";	
$q=mysql_query($sql) or die();
$rs=mysql_fetch_row($q);	
echo $rs[0];	
}


//get all selected counties
function selectedcounties(){
$sql="SELECT distinct(countyID) as ID  FROM selectedCounties";	
$q=mysql_query($sql) or die();
$num=mysql_num_rows($q) or die();
$mya=array();
for($i=0;@$rs=mysql_fetch_array($q);$i++){
$mya[$i]=$rs;	 
}
return $mya;	
}

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

//Facilities within the selected counties
function selectedfaccounties($county){
$maxdist=maxdistance();
 $from=rangefrom();
 $to=rangeto();
$sql="SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c
 WHERE (`need_per_day` >='$from' AND  `need_per_day` <='$to') AND countyID='$county' GROUP BY(MFLCode) order by rank desc";
$q=mysql_query($sql) or die();
while($rs=mysql_fetch_array($q)){
$counters=getfacilitywithcd4($rs['facility']);
if($counters==0){
echo "<tr><td><center>".$rs['MFLCode']."</center></td><td><center>".$rs['fname']."</center></td><td><center>".$rs['distance']."</center></td><td><center>".$rs['patients']."</center></td><td><center>".round($rs['need_per_day'],0)."</center></td><td><center>".round($rs['rank'],2)."</center></td></tr>";	 
   }
 }
}

//total Facilities within the selected counties
function selectedfaccountiesnum($county){
$maxdist=maxdistance();
$from=rangefrom();
$to=rangeto();
$sql="SELECT s.need,s.need_per_day,s.facility,s.fname,s.distance,s.MFLCode,s.patients,s.county,((s.distance*c.patients)/$maxdist) as dist,
(((((s.distance*5)/$maxdist)*.c.access)/100)+ (((need_per_day/3)*.c.patients)/100)) as rank FROM  `selects` s,criteriaweighting c
 WHERE (`need_per_day` >='$from' AND  `need_per_day` <='$to') AND countyID='$county' GROUP BY(MFLCode) order by rank desc";
$q=mysql_query($sql) or die();
while($rs=mysql_fetch_array($q)){
$counters=getfacilitywithcd4($rs['facility']);
if($counters==0){
$num++;
  }
 }
 echo $num;
}


?>