<?php
//admin side functions
function fcdrrdet(){
	//total facilities
	$sql1="select count(*) as total FROM facility f, facilityequipments fe, equipments e 
	       WHERE f.AutoID=fe.facility AND  fe.equipment=e.ID and e.category=1";
	$query1=mysql_query($sql1) or die(mysql_error());	 
	$total=mysql_fetch_row($query1);  
	
	
	//rolled out
	$sql2="select count(*) as rolled FROM facility f, facilityequipments fe, equipments e 
	       WHERE f.AutoID=fe.facility AND  fe.equipment=e.ID and e.category=1 AND f.rolloutstatus=1";
	$query2=mysql_query($sql2) or die(mysql_error());	 
	$rolled=mysql_fetch_row($query2);  
	
	//reported
	$sql3="select count(*) FROM facility f, facilityequipments fe, equipments e,fcdrrlists fc 
	       WHERE f.AutoID=fe.facility AND  fe.equipment=e.ID and e.category=1 AND fc.mflcode=f.MFLCode";
	$query3=mysql_query($sql3) or die(mysql_error());	 
	$reported=mysql_fetch_row($query3);  
	
	return '<tr><th># of CD4 Facilities</th><td>'.$total[0].'</td></tr>
	<tr><th># Rolled out Facilities</th><td>'.$rolled[0].'</td></tr>
	<tr><th># Reporting Facilities</th><td>'.$reported[0].'</td></tr>';
}



//function showing calibur details
function calibursummarized(){
	$sql="SELECT f.name, f.MFLCode, fe.`serialNum` FROM facilityequipments fe, facility f WHERE f.AutoID = fe.facility
               AND fe.serialNum <>  ''";
	$query=mysql_query($sql) or die(mysql_error());
	$mytab="";
	while ($rs=mysql_fetch_row($query)) {
		
		$mytab=$mytab."<tr><td>".$rs[0]."</td>
		             <td>".$rs[1]."</td>
		             <td>".$rs[2]."</td>
		             <td>".getlastcaliupload($rs[2])."</td></tr>";
	}	
	return $mytab;  
}

function getlastcaliupload($serial){
	$sql="SELECT max(Date_Analyzed) from  exp_file_data WHERE CytometerSerialNumber='$serial'";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_row($query);
	if ($rs[0]=="") {
		$rs[0]="Not Uploaded";
	}
	return $rs[0];
}



//function for PIMA summary
function getpimasum(){
    $sql="SELECT count(*) from  device";
	$query=mysql_query($sql) or die(mysql_error());	
	$rs=mysql_fetch_row($query);
	
	$sql1="SELECT count(DISTINCT deviceID) from  test";
	$query1=mysql_query($sql1) or die(mysql_error());	
	$rs1=mysql_fetch_row($query1);
	
	$sql2="SELECT count(DISTINCT deviceID) from  test WHERE errorID >0";
	$query2=mysql_query($sql2) or die(mysql_error());	
	$rs2=mysql_fetch_row($query2);
	
	$mytab='<tr><th>Total devices</th><td>'.$rs[0].'</tr>'
	.'<tr><th>Reported devices</th><td>'.$rs1[0].'</tr>'.
	'<tr><th>Total Errors</th><td>'.$rs2[0].'</tr>';
	
	return $mytab;

}
?>