<?php
function getCentralSites($patna,$rows,$dev){
	if($dev!=""){
	 $sql="SELECT * FROM facilitys, facilitypatients, facility WHERE facilitys.facilityName='".$dev."' AND facilitys.level='0' AND facilitys.partner='".$patna."' AND facility.AutoID = facilitys.autofacility
AND facility.AutoID = facilitypatients.facility LIMIT 0,$rows";		
		}
		else{
	 $sql="SELECT * FROM facilitys, facilitypatients, facility WHERE facilitys.level='0' AND facilitys.partner='".$patna."' AND facility.AutoID = facilitys.autofacility
AND facility.AutoID = facilitypatients.facility LIMIT 0,$rows";
		}
	$query=mysql_query($sql) or die(mysql_error());
	return $query;
	
	}
	
	function getReferalSites($id){
		$num=1;
		 $sql="SELECT * FROM facility, facilitypatients, facilitys WHERE facilitys.level='1'AND facility.AutoID = facilitys.autofacility
AND facility.AutoID = facilitypatients.facility AND facility.centralsiteAutoID='".$id."'";
 $query=mysql_query($sql) or die(mysql_error());
 while($rs=mysql_fetch_array($query)){
	echo $mytbl='<tr><td width="5%"><small><center>'.$num.'</center></small></td><td width="25%"><small><center>'.$rs["facilityName"].'</center></small></td><td width="25%"><table><tr><td colspan="3" ><small><center>'.$rs['ontreatment'].'</center></small></td><td ><small><center>'.$rs['oncare'].'</center></small></td><td><small><center>'.($rs['ontreatment']+$rs["oncare"]).'</center></small></td></tr></table></td><td  width="20%"><small><center>'.$rs['ontreatment'].'</center></small></td></tr>';
	 $num++;
	 }
	// return $mytbl;
		
		}
	
	//get total referal sites to a certain central site
	
	function getTotalReferalSites($id){
		
		 $sql="SELECT count(*) FROM  facilitycounty WHERE centralsiteAutoID='".$id."'";
 $query=mysql_query($sql) or die(mysql_error());
 $rs=mysql_fetch_row($query);
 echo $rs[0];

	}	
		
	function getTotalReferalSites2($id){
		
		 $sql="SELECT count(*) FROM facility WHERE facility.AutoID ='$id' OR facility.centralsiteAutoID='$id'";
 $query=mysql_query($sql) or die(mysql_error());
 $rs=mysql_fetch_row($query);
return $rs[0];

	}	
	
?>
