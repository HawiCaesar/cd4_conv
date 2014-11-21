<?php
//check for facility from ID
		function checkFacility($id){
			$sql="select facilityName FROM facilitys where facilityID='".$id."'";
			$querySql=mysql_query($sql);
			$result=mysql_fetch_array($querySql);
			$myFacArr=array();
			for($i=0;$result;$i++){
				
				$myFacArr[$i]=$result;
				}
			return $myFacArr;
			
			}	

//get facility name given mfl
		function checkFacilitymfls($mfl){
			$sql="select name FROM facility where MFLCode='".$mfl."'";
			$querySql=mysql_query($sql);
			$result=mysql_fetch_row($querySql);
			return $result[0];
			
			}	
		
		function checkFacilitypass($mfl){
			$sql="select password FROM facility where MFLCode='".$mfl."'";
			$querySql=mysql_query($sql);
			$result=mysql_fetch_row($querySql);
			return $result[0];
			
			}	

	  
//get number of facilities by partner
	  function totalFacilitys($patna){
	   $sequel="SELECT COUNT(facilityID) AS fac
              FROM  `facilitys` WHERE facilitys.partner='".$patna."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $myArr['1']=$resultArr['fac'];
		  }
	  }
	  
//facility details by certain partner
	function gettotalfac($patna){
		$sql="SELECT count(*) as fac FROM  `facilitys` WHERE  `partner` ='".$patna."' ";
		$query=mysql_query($sql);
		while($rs=mysql_fetch_array($query)){
			$total=$rs['fac'];
			}
		return $total;
		}	
	
	function reportFacility($patna,$num){
		$sql="SELECT * FROM  `facilitys` WHERE  `partner` ='".$patna."' LIMIT 0 ," .$num;
		$query=mysql_query($sql);
		return $query;
		
		}
	function getSpecFacility($num){
		echo $sql="SELECT * FROM  `facility`f, facilitypatients fp WHERE  f.`AutoID` ='$num' AND fp.facility=f.AutoID " ;
		$query=mysql_query($sql);
		$myarr=mysql_fetch_row($query);
		return $myarr;
		}
			  			
	
//get  all the facilities and their details	
		function getFacility(){
			$sql="select * from facility f, facilitypatients fp, districts d WHERE f.district=d.ID AND f.AutoID=fp.facility ORDER BY f.name asc";
			$executeSql=mysql_query($sql) or die(mysql_error());
			$mytab="";
			while($row = mysql_fetch_array($executeSql))  {
				
				if($row['level']==1){
				$type="Satellite";	
				} 
				else{
					$type="Central";
					} 
                if($row['rolloutstatus']==1){
                	$state=0;
                	$status="Rolled Out &nbsp;".'<a href="rollout.php?id='.$row['AutoID'].'& name='.$row['fname'].'& status='.$state.'"><img src="../../img/close.gif" width="15" height="15"></a>';
                }
				else {
					$state=1;
					$status="Not Rolled &nbsp;".'<a href="rollout.php?id='.$row['AutoID'].'& name='.$row['fname'].'& status='.$state.'"><img src="../../img/msg-ok.gif" width="15" height="15"></a>';
				}
				$page_to= "' Are you sure you want to delete Facility " .$row['fname']."'"; 	
				$patna=getSpecificPartner($row['partnerID']);	 
            $mytab=$mytab.'<tr>
            <td><center>'.$row['AutoID'].'</center></td>
            <td><center>'.$row['MFLCode'].'</center></td>
            <td><center>'.$row['fname'].'</center></td>
            <td><center>'.$row['districtname'].'</center></td>
            <td><center>'.$row['countyname'].'</center></td>
            <td><center>'.$type.'</center></td>
            <td><center>'.$row['centralsitename'].'</center></td>
            <td><center>'.$row['distance'].'</center></td>
            <td><center>'.$row['typename'].'</center></td>
            <td><center>'.$patna[1].'</center></td>
            <td><center>'.$status.'</center></td>
            
            <td><center><a href="edit.php?id='.$row['AutoID'].'" title="Edit User"><img src="../../img/edit.png"/></a>|<a href="delete.php?id='.$row['AutoID'].'& name='.$row['fname'].'"  onclick="return confirm('.$page_to.');" title="Delete User"><img src="../../img/delete.png"/></a></center></td>
            </tr>';
				}
			return $mytab;
			}
			
function getSpecDistrict($district){
		$sql="SELECT name as name FROM  `districts` WHERE  `ID` ='".$district."'";
		$query=mysql_query($sql);
		while($rs=mysql_fetch_array($query)){
			$name=$rs['name'];
			}
		echo $name;
		
		}
function patientspercentral($site,$level){
	if ($level==1){
	$sql="SELECT sum(`ontreatment` ) FROM `facilitywithpatients`WHERE (AutoID ='$site' OR centralsiteAutoID ='$site')";
	}
	else if ($level==2){
	$sql="SELECT sum(`oncare` ) FROM `facilitywithpatients`WHERE (AutoID ='$site' OR centralsiteAutoID ='$site')";
	}
	else {
	$sql="SELECT (sum(`ontreatment` )+sum(`oncare` )) FROM `facilitywithpatients`WHERE (AutoID ='$site' OR centralsiteAutoID ='$site')";
	}
    $query=mysql_query($sql) or die (mysql_error());
	$re=mysql_fetch_row($query);
	return $re[0];
}

//facility name
function GetFacilityName1($fid)
{
			$cquery=mysql_query("SELECT name as fname FROM facility  WHERE  AutoID='$fid'") or die(mysql_error()); 
			$noticia = mysql_fetch_row($cquery);  
			$fid=$noticia[0];
			return $fid;
}
	
//facility service used
function facilityservices($facility){
	$sql="SELECT ANC,PMTCT FROM facilitys where facilitycode='$facility'";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_row($query);
	echo '<td><div align="center">'.$rs[0].' </div></td> <td><div align="center">'.$rs[1].'</div></td> ';
}			
?>