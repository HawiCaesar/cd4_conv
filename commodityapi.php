<?php

class commodityapi{
 
 //constructor
function _construct($username,$key,$searchType,$mfl){
//conn to DB

	
}	

//show reports	
function getdevices($mfl,$month,$year){
	$this->connectDb();
	//get all cd4 equipment by a facility
$sql="SELECT fa.MFLCode,f.fname,f.equipment,f.equipmentname FROM  facilityequipments f, facility fa, equipments e, fcdrrlists fc WHERE 
      fa.AutoID=f.facility AND fa.MFLCode='$mfl' AND e.ID=f.equipment AND e.category=1 AND fc.mflcode=fa.MFLCode and MONTH(fc.fromdate	)='$month' AND YEAR(fc.fromdate	)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$myarr=array();
$row = 0;
while ($rs=mysql_fetch_array($query)){
$myarr[$row]["mfl"]=$rs['MFLCode'];
$myarr[$row]["facility"]=$rs['fname'];
$myarr[$row]["device"]=array($rs['equipmentname'],"devices"=>$this->getreagents($rs['equipment']));

}
return $myarr;
}	
//reporting rates
function getreagents($reagentcat){
	$this->connectDb();
$sql ="SELECT r.reagentID,r.code,r.name,r.unit FROM  reagents r,reagentcategory rc WHERE rc.categoryID=r.categoryID AND (rc.equipmentType='$reagentcat' OR rc.equipmentType='0')";	
//echo $sql; exit;
$query=mysql_query($sql) or die(mysql_error());
$myarr=array();
//$rs=mysql_fetch_array($query);
$row = 0; 
$data_array="";
$commodity_array="";
while($rs=mysql_fetch_array($query)){
	$data_array =array("name"=>$rs['name'],"code"=>$rs['code'],"unit"=>$rs['unit'],"reagentID"=>$rs['reagentID'],'report'=>$this->getrpttrend($rs['reagentID']));
    $commodity_array[$row]=$data_array;
$row++;
}
return $commodity_array;
}

//reagents
function getrpttrend($reagentID){
	$this->connectDb();
	
	 $sql="SELECT qtyused,receivedqty,requested,endbal FROM  commodity WHERE reagentID='$reagentID'";	

	 
$query=mysql_query($sql) or die(mysql_error());
$myarr=array();
while($rs=mysql_fetch_array($query)){
$myarr["used"]=$rs['qtyused'];
$myarr["received"]=$rs['receivedqty'];
$myarr["requested"]=$rs['requested'];
$myarr["endbal"]=$rs['endbal'];	
}
return $myarr;		
}	

//connect to Db
function connectDb(){
 $host="localhost";
		$user="root";
		$pass="";//ensure of you transfer file to server you input the server password
		$db="cd4";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);	
}

//function to get all cd4 facilities per county
function cd4facilities($county,$month,$yr){
	 $sql="SELECT f.MFLCode, f.name FROM facility f, facilityequipments fe,equipments e,districts d where f.AutoID=fe.facility AND e.ID=fe.equipment AND e.category=1 AND f.district=d.ID AND d.county='$county' 
GROUP BY f.MFLCode";
	$query=mysql_query($sql) or die($mysql_error());
	$myarr=array();
	$count=0;
	while ($rs=mysql_fetch_array($query)) {
		$myarr[$count]['mfl']=$rs['MFLCode'];	
		$myarr[$count]['name']=	$rs['name'];
		$myarr[$count]['status']=$this->checkifreported($rs['MFLCode'],$month,$yr);
		$count++;
	}
	return $myarr;
 }
 function cd4totfacilities($county){
	$sql="SELECT COUNT( DISTINCT (AutoID) )as totals FROM facility f, facilityequipments fe,equipments e,districts d where f.AutoID=fe.facility AND e.ID=fe.equipment AND e.category=1 AND f.district=d.ID AND d.county='$county'";
	$query=mysql_query($sql) or die($mysql_error());
	$myarr=array();
	$count=0;
	$rs=mysql_fetch_row($query);
	return $rs[0];	
	
 }
 function cd4facilitysummary($county,$month,$yr){
 	$this->connectDb();
 	$myarr=array("total"=>$this->cd4totfacilities($county),"reported"=>$this->cd4facilityreported($county,$month,$yr),"particular"=>$this->cd4facilities($county,$month,$yr));
	return $myarr;
 }
 function cd4facilityreported($county,$month,$yr){
  $sql="SELECT count(*) FROM fcdrrlists f,facility fa,districts d  WHERE f.mflcode=fa.MFLCode AND fa.district=d.ID AND d.county='$county' AND month(fromdate)='$month' AND year(fromdate)='$yr'";	
 $query=mysql_query($sql) or die($mysql_error());
	$myarr=array();
	$count=0;
	$rs=mysql_fetch_row($query);
	return $rs[0];	
 }

function checkifreported($mfl,$month,$yr){
 $sql="SELECT count(*) FROM fcdrrlists f WHERE month(fromdate)='$month' AND year(fromdate)='$yr' AND mflcode='$mfl'";	
 $query=mysql_query($sql) or die($mysql_error());
	$rs=mysql_fetch_row($query);
	if( $rs[0]>0){
		$msg="Reported";
	}	
	else{
		$msg="Not Reported";
	}	
	return $msg;
 }

//gives all county details
function countydets($month,$yr){
	$this->connectDb();
	$sql="SELECT name,ID from countys";
	$query=mysql_query($sql) or die(mysql_error());
	$myarr=array();
	$count=0;
	while ($rs=mysql_fetch_array($query)) {
	$myarr[$count]['county']=$rs['ID'];	
		$myarr[$count]['name']=	$rs['name'];
		$myarr[$count]['particulars']=$this->cd4facilitysummary($rs['ID'],$month,$yr);	
	$count ++;	
	}
 return $myarr;	
}
}
?>
