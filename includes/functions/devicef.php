<?php

	//function that gets devices for popup
	function devicepop($partnerid){
		
$sql="SELECT deviceNumber,location,specLoc FROM device WHERE partnerID='$partnerid'";
			 $rs=mysql_query($sql) or die();
			return $rs;
		
	}
	
		//function that gets devices for popup
	function deviceuploadpop($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate){
		  if ($filter==0) //last submission
	  {
		 $sql="SELECT distinct(deviceID)  from test where month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='".$patna."'";
	  }
	   elseif ($filter==1)//last 6 months $fromdate$todate
	  {
		   $sql="SELECT distinct(deviceID)  from test where resultDate BETWEEN '$fromdate' AND '$todate'  AND partnerID='".$patna."'";
	  }
	   elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
		   $sql="SELECT distinct(deviceID)  from test where resultDate BETWEEN '$fromfilter' AND '$tofilter'  AND partnerID='".$patna."'";
	  }
	    elseif ($filter==3)//month/year
	  {
		  
		   $sql="SELECT distinct(deviceID)  from test where month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'  AND partnerID='".$patna."'";
 	  }
	    elseif ($filter==4)//year only
	  {
		   $sql="SELECT distinct(deviceID) from test where YEAR(resultDate)='$currentyear'  AND partnerID='".$patna."'";

	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	  	  $sql="SELECT distinct(deviceID) from test where resultDate BETWEEN '$fromdate' AND '$todate'  AND partnerID='".$patna."'";
	  }
			 $rs=mysql_query($sql) or die();
			return $rs;
		
	}
	function maxDateDev($dev){
	$sql="SELECT max(resultDate) FROM test WHERE deviceID='$dev'";
	$rs=mysql_query($sql) or die();
	$r=mysql_fetch_row($rs);
	return $r[0];		 
		
	}
	
	//add device
		function addDevice($deviceNo,$facility,$location){
		$today = date('Y-m-d');	
		$sql="INSERT into device(deviceNumber,facilityID,dateAdded,dateModified,location ) values ('".$deviceNo."','".$facility."','".$today."','".$today."','".$location."')";
		$executeSql=mysql_query($sql);
		if($executeSql){
			echo "Device added successfully <br/>";
			
			}
			else{
				echo "Registration not done";
				}
		
		}
		
							
		//get devices
		function getDevice(){
			$sql="select * from device";
			$executeSql=mysql_query($sql);
			$deviceArr=array();
			for ($i=0;$result=mysql_fetch_assoc($executeSql); $i++){
				$deviceArr[$i]=$result;				
				}			
			return $deviceArr;
			}
			
			
				//get searched devices
		function getSearchDevice($dev){
			$sql="select * from device where deviceNumber = '".$dev."'";
			$executeSql=mysql_query($sql);
			$deviceArr=array();
			for ($i=0;$result=mysql_fetch_assoc($executeSql); $i++){
				$deviceArr[$i]=$result;				
				}			
			return $deviceArr;
			
			
			}
			
			
			  //get number of devices for user
	  function getSpecDevices($patna){
	   $sequel="SELECT COUNT(`deviceID`) AS dev FROM  `device` WHERE  `partnerID` ='".$patna."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		   $myArr['1']=$resultArr['dev'];
		  }
		 return $myArr['1']; 
	  }
	  
	    //get number of devices that are reporting
	  function totalReportingDev($patna){
	   $sequel="SELECT COUNT(DISTINCT deviceID) AS Rdev FROM  `test` WHERE partnerID='".$patna."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $myArr['1']=$resultArr['Rdev'];
		  }
	  }
	  
//check ownership of uploading device	
			function isMyDevice($device, $user){
				
			$sql1="SELECT COUNT(`deviceID`) as dev FROM  `device` WHERE deviceNumber='".$device."' AND partnerID='".$user."'";
				$query1=mysql_query($sql1);
				$result=mysql_fetch_row($query1);
					$myArr=$result['dev'];
				return $myArr;					
				}	
//function for devices uploaded in a month by this patna
	function deviceRptMonth($month,$year,$partner){
	 $sql="SELECT count(DISTINCT(deviceID)) as err FROM  `test` 
	 WHERE MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."'";
	  $cd=array();
	  $resultReport=mysql_query($sql);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  $cd['0']=$resultArr['err'];
		  }
		  
		  return $cd['0'];
		}
//function for percentage reported in a month	
	function percentageReport($month,$year,$patna){
		$totalDev=getSpecDevices($patna);
		$rptedDev=deviceRptMonth($month,$year,$patna);
	  $percent=round(($rptedDev/$totalDev)* 100, 2);
		
		return $percent;
			}
			
	function devPerformance($dev){
		$sql="SELECT MAX( resultDate ) as max, COUNT( errorID ) as count FROM test WHERE deviceID =  '$dev' AND errorID >0";
		$query=mysql_query($sql);
		return $query;
		}						
	function flagDevicenum(){
		$sql="SELECT count(*) FROM device WHERE status=0 AND flag=1";
		$q=mysql_query($sql);
		$res=mysql_fetch_row($q);
		return $res[0];
	}
	function flagDevAdmin($dev){
		$sql="UPDATE device SET status=0 WHERE deviceID='$dev'";
		$query=mysql_query($sql)or die(mysql_error());
	}
	function flaggedDevList(){
		$sql="SELECT * FROM  `device` , partners WHERE STATUS =0 AND flag =1 AND device.partnerID = partners.ID";
		$query=mysql_query($sql) or die();
		return $query;
	}			
?>