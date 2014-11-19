<?php
session_start();
//connects to the db
function db_connect(){
include("includes/dbConf.php");
$db=new dbConf;

}
function systemlastAccess($username,$userID,$login){
	$sql="UPDATE accesslog SET logoutTime=now() WHERE username='$username' AND userID='$userID' AND `loginTime`='$login'";		
	$query=mysql_query($sql) or die(mysql_error());		
		
	}	
	
	
function GetFacilityperCounty($countyID)
{
$cquery=mysql_query("SELECT facility.AutoID
            FROM facility,districts
            WHERE  facility.district=districts.ID and districts.county='$countyID' "); 
			$noticia = mysql_num_rows($cquery);  
			return $noticia;
}

function getmaxasofdatepatientnos()
{
$strQuery=mysql_query("select max(asofdate) as maxdate from facilitypatients ")or die(mysql_error());
	$resultarray=mysql_fetch_array($strQuery);
	$maxdate=$resultarray['maxdate'];
	
	if ( $maxdate !='' && $maxdate !='1970-01-01' && $maxdate !='0000-00-00' )
	{
	$asofdate=date("d-M-Y",strtotime($maxdate));
	}
	else
	{
	$asofdate="N/A";
	}
	return $asofdate;
}
function GetTotalEquipmentsbyFacility($fcode)
{
$cquery=mysql_query("SELECT COUNT(ID) as fid
            FROM facilityequipments
            WHERE  facility='$fcode' and equipment !=0"); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			return $fid;
}
function GetTotalEquipmentsbyCategory($category)
{
$cquery=mysql_query("SELECT COUNT(ID) as fid
            FROM equipments
            WHERE  category='$category' "); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			return $fid;
}

function GetEquipmentIDfromName($eqname,$category)
{
$cquery=mysql_query("SELECT ID as eid
            FROM equipments
            WHERE  category='$category' AND description='$eqname' "); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['eid'];
			return $fid;
}
function GetEquipmentName($eqid)
{
$cquery=mysql_query("SELECT description as eqname
            FROM equipments
            WHERE  ID='$eqid' "); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['eqname'];
			return $fid;
}
function GetIfEquipmentsinFacility($fcode,$equipment)
{
$cquery=mysql_query("SELECT COUNT(ID) as fid
            FROM facilityequipments
            WHERE  facility='$fcode' and equipment='$equipment' "); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			if ($fid > 0)
			{
			$checked="checked";
			$cvalue=1;
			}
			else
			{
			$cvalue=0;
			}
			return array($cvalue,$checked);
}
function GetTotalReferalSitesPerCentral($fcode)
{
$cquery=mysql_query("SELECT COUNT(AutoID) as fid
            FROM facility
            WHERE  centralsiteAutoID='$fcode' and level=1"); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			return $fid;
}
function GetIfFacilityPatientsExists($fcode)
{
$cquery=mysql_query("SELECT COUNT(ID) as fid
            FROM facilitypatients
            WHERE  facility='$fcode' "); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			return $fid;
}
function getmaxitemsbycategory()
{
$cquery=mysql_query("select count(ID) as num from equipments  GROUP BY category  order by num DESC limit 0,1"); 
			$noticia = mysql_fetch_array($cquery);  
			$num=$noticia['num'];
			return $num; 
}
function getpatientsnumbers($fcode) 
{
$cquery=mysql_query("SELECT ontreatment,oncare
            FROM facilitypatients
            WHERE  facility='$fcode' order by asofdate desc limit 0,1"); 
			$noticia = mysql_fetch_array($cquery);  
			$ontreatment=$noticia['ontreatment'];
			$oncare=$noticia['oncare'];

return array($ontreatment, $oncare); 
}
function GetcentralsiteIDinistrict($districtname)
{
$cquery=mysql_query("SELECT AutoID as fid
            FROM facility
            WHERE  districtname='$districtname' and level=0"); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			return $fid;
}
function GetDistrictIDfromName($dname)
{
	$districtidquery=mysql_query("SELECT ID as distid
            FROM districts
            WHERE  name='$dname'"); 
			$noticia = mysql_fetch_array($districtidquery);  
			
			$distid=$noticia['distid'];
			return $distid;
}
function GetFacilityAutoIDfromName($fname)
{
	$districtidquery=mysql_query("SELECT AutoID as distid
            FROM facility
            WHERE  name='$fname'"); 
			$noticia = mysql_fetch_array($districtidquery);  
			
			$distid=$noticia['distid'];
			return $distid;
}
function GetCountyID($countyname)
{
	$cquery=mysql_query("SELECT ID as countyid
            FROM countys
            WHERE  name='$countyname'"); 
			$noticia = mysql_fetch_array($cquery);  
			$countyid=$noticia['countyid'];
			return $countyid;

}
function GetCountyName($countyid)
{
	$cquery=mysql_query("SELECT name as countyname
            FROM countys
            WHERE  ID='$countyid'"); 
			$noticia = mysql_fetch_array($cquery);  
			$countyname=$noticia['countyname'];
			return $countyname;

}
function GetFacilityAutoID($fname)
{
			$cquery=mysql_query("SELECT AutoID as fid
            FROM facility
            WHERE  name='$fname'"); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fid'];
			return $fid;
}
function GetFacilityName($fid)
{
			$cquery=mysql_query("SELECT name as fname
            FROM facility
            WHERE  AutoID='$fid'"); 
			$noticia = mysql_fetch_array($cquery);  
			$fid=$noticia['fname'];
			return $fid;
}
function GetCountyfromDistrict($district)
{
$provincenamequery=mysql_query("SELECT county as countyid
            FROM districts
            WHERE  ID='$district'"); 
			$provincename = mysql_fetch_array($provincenamequery);  
			$countyid=$provincename['countyid'];
			return $countyid;
			}
//get province ID
function GetProvinceID($provname)
{
$provincenamequery=mysql_query("SELECT ID as provid
            FROM provinces
            WHERE  name='$provname'"); 
			$provincename = mysql_fetch_array($provincenamequery);  
			$provid=$provincename['provid'];
			return $provid;
			}
	//get facility type id from its name		
function GetFacilityTypeID($typename)
{
	$cquery=mysql_query("SELECT ID as typeid
            FROM facilitytypes
            WHERE  initial='$typename'"); 
			$noticia = mysql_fetch_array($cquery);  
			$typeid=$noticia['typeid'];
			return $typeid;
}
//get facility type name from its ID	
function GetFacilityType($typeid)
{
	$cquery=mysql_query("SELECT initial as typename
            FROM facilitytypes
            WHERE  ID='$typeid'"); 
			$noticia = mysql_fetch_array($cquery);  
			$typename=$noticia['typename'];
			return $typename;
}

function GetDistrictID($facility)
{
	$districtidquery=mysql_query("SELECT district
            FROM facilitys
            WHERE  ID='$facility'"); 
			$noticia = mysql_fetch_array($districtidquery);  
			
			$distid=$noticia['district'];
			return $distid;

}
//get distrcit name
function GetDistrictName($distid)
{
$districtnamequery=mysql_query("SELECT name 
            FROM districts
            WHERE  ID='$distid'"); 
			$districtname = mysql_fetch_array($districtnamequery);  
			$distname=$districtname['name'];
		return $distname;
}
//get province id
function GetProvid($distid)
{
$districtnamequery=mysql_query("SELECT province
            FROM districts
            WHERE  ID='$distid'"); 
			$districtname = mysql_fetch_array($districtnamequery);  
			$provid=$districtname['province'];
			return $provid;
}
//get province name
function GetProvname($provid)
{
$provincenamequery=mysql_query("SELECT name 
            FROM provinces
            WHERE  ID='$provid'"); 
			$provincename = mysql_fetch_array($provincenamequery);  
			$provname=$provincename['name'];
			return $provname;
			}
function getfacilitycounty($facility)
{
$countyquery=mysql_query("select countys.name as countyname from countys, districts, facilitys where facilitys.facilityID = '$facility' and facilitys.district = districts.ID and districts.county = countys.ID"); 
		$countydets = mysql_fetch_array($countyquery);  
		$countyname = $countydets['countyname'];
return $countyname;
}
  //get number of tests done
	  function totalTests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE MONTH(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' ";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE resultDate BETWEEN '$fromfilter' AND '$tofilter' AND partnerID='$partnerid' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE MONTH(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE  YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
	  }
	  
	  
	  //total logs
	  	  function totallogs($fromdate,$todate,$user)
	  {
	  $sequel="SELECT COUNT(ID) AS tot FROM  userlog WHERE date BETWEEN '$fromdate' AND '$todate' AND userID='$user'";  
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
	  }
	  
	  
	  
	  
	  //get report count
	  function CDreports($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	        if ($filter==0) //last submission
	  {
	   $sequel="SELECT COUNT( IF(  `cdCount` <'350', NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  test WHERE cdCount <>0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' ";	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  	 $sequel="SELECT COUNT( IF(  `cdCount` <350, NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  test WHERE cdCount <>0 AND resultDate BETWEEN '$fromdate' AND '$todate'  AND partnerID='$partnerid' ";	
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	 $sequel="SELECT COUNT( IF(  `cdCount` <350, NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  test WHERE cdCount <>0 AND resultDate BETWEEN '$fromfilter' AND '$tofilter'  AND partnerID='$partnerid' ";	
	  }
	    elseif ($filter==3)//month/year
	  {
 $sequel="SELECT COUNT( IF(  `cdCount` <350, NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  test WHERE cdCount <>0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' ";

 	  }
	    elseif ($filter==4)//year only
	  {
 $sequel="SELECT COUNT( IF(  `cdCount` <350, NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  test WHERE cdCount <>0  AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	  	 $sequel="SELECT COUNT( IF(  `cdCount` <350, NULL , 0 ) ) AS less, COUNT( IF(  `cdCount` >350, NULL , 0 ) ) AS more
              FROM  test WHERE cdCount <>0 AND resultDate BETWEEN '$fromdate' AND '$todate'  AND partnerID='$partnerid' ";	  
	  }
	  
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
		  $LESS=$resultArr['less'];
		  $MORE=$resultArr['more'];
	return $LESS;
	  }
  
    //tests with error
	  function totalErr($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID > 0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'"; 		  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID > 0 AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID > 0 AND resultDate BETWEEN '$fromfilter' AND '$tofilter' AND partnerID='$partnerid'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID > 0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID > 0 AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID > 0 AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid'";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
 
	
	 
	  }
	  
	  
	  function totalErrDet($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT test.deviceID,error.errorName,error.errorDetail
              FROM  test, error WHERE test.errorID > 0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' AND error.errorID=test.errorID"; 		  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT test.deviceID,error.errorName,error.errorDetail
              FROM  test, error WHERE test.errorID > 0 AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' AND error.errorID=test.errorID";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT test.deviceID,error.errorName,error.errorDetail
              FROM  test, error WHERE test.errorID > 0 AND resultDate BETWEEN '$fromfilter' AND '$tofilter' AND partnerID='$partnerid' AND error.errorID=test.errorID";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT test.deviceID,error.errorName,error.errorDetail
              FROM  test, error WHERE test.errorID > 0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' AND error.errorID=test.errorID"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT test.deviceID,error.errorName,error.errorDetail
              FROM  test, error WHERE test.errorID > 0 AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid' AND error.errorID=test.errorID";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT test.deviceID,error.errorName,error.errorDetail
              FROM  test, error WHERE test.errorID > 0 AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid' AND error.errorID=test.errorID";
	  }
	  //echo $sequel;
	 
	     
	  $resultReport=mysql_query($sequel);
	  
		return  $resultReport;
	  }
	  
	  
	  
	  
			
	  function totalerrorbycategory($errorid,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID ='$errorid'  AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'"; 		  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID ='$errorid' AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID ='$errorid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' AND partnerID='$partnerid'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID ='$errorid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID ='$errorid' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(testID) AS tot
              FROM  test WHERE errorID ='$errorid' AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid'";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;

	  }
	  
	  
	  	  function totalerrorbycategory1($errorid,$dev)  {

		 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND deviceID='$dev'";
	  
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;

	  }
	  
	   function totalerrorbycategory2($errorid,$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)  {
 
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND partnerID='$patna' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 		  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND partnerID='$patna' AND resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND partnerID='$patna' AND resultDate BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND partnerID='$patna' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND partnerID='$patna' AND YEAR(resultDate)='$currentyear'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(testID) AS tot 
              FROM  test WHERE errorID ='$errorid' AND partnerID='$patna' AND resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;

	  }
	  
	  
	  
	  
	 function addnewDevice($deviceNo,$partnerid,$location){
		$today = date('Y-m-d');	
		$sql="INSERT into device(deviceNumber,partnerID,dateAdded,dateModified,location) values ('$deviceNo','$partnerid','$today','$today','$location')";
		$executeSql=mysql_query($sql);
		return $executeSql;
		
		}
	function addnewDevice1($deviceNo,$partnerid,$location,$location1){
		$today = date('Y-m-d');	
		 $sql="INSERT into device(deviceNumber,partnerID,dateAdded,dateModified,location,specLoc) values 		         ('$deviceNo','$partnerid','$today','$today','$location','$location1')";
		$executeSql=mysql_query($sql);
		return $executeSql;
		
		}	
		function getdevicelocation($location)
		{
		$sql=mysql_query("select name as location from devicelocation where ID='$location'")or die(mysql_error());
		$arr=mysql_fetch_array($sql);
		$devicelocation=$arr['location'];
		return $devicelocation;
		}
		function gettotaldevicesperpartner($partnerid)
		{
		$sql=mysql_query("select deviceNumber from device where partnerID='$partnerid'")or die(mysql_error());
		$numrows=mysql_num_rows($sql);
		return $numrows;
		}
		function getalltotaldevices()
		{
		$sql=mysql_query("select deviceNumber from device")or die(mysql_error());
		$numrows=mysql_num_rows($sql);
		return $numrows;
		}
		function gettotaldevicesperpartnerbylocation($partnerid,$location)
		{
		$sql=mysql_query("select deviceNumber from device where partnerID='$partnerid' and location='$location'")or die(mysql_error());
		$numrows=mysql_num_rows($sql);
		return $numrows;
		}
		function getfacilitiesperdevice($deviceID)
		{
		$sql=mysql_query("select ID from deviceallocation where deviceid='$deviceID' ")or die(mysql_error());
		$numrows=mysql_num_rows($sql);
		return $numrows;
		}
		function gettotalfacilitiesperpartner($partnerid)
		{
		$sql=mysql_query("select facilityID from facilitys where partner='$partnerid' ")or die(mysql_error());
		$numrows=mysql_num_rows($sql);
		return $numrows;
		}
		
	function devicesreporting($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
	$sequel="select distinct(device.deviceNumber) from device,test  where device.deviceNumber =test.deviceID and  test.partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 	
      }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	$sequel="select distinct(device.deviceNumber) from device,test  where device.deviceNumber =test.deviceID and  test.partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
		 $sequel="select distinct(device.deviceNumber) from device,test  where device.deviceNumber =test.deviceID and  test.partnerID='$partnerid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
				 $sequel="select distinct(device.deviceNumber) from device,test  where device.deviceNumber =test.deviceID and  test.partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 	 	  }
	    elseif ($filter==4)//year only
	  {
		 $sequel="select distinct(device.deviceNumber) from device,test  where device.deviceNumber =test.deviceID and  test.partnerID='$partnerid'  AND YEAR(resultDate)='$currentyear'"; 		  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="select distinct(device.deviceNumber) from device,test  where device.deviceNumber =test.deviceID and  test.partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate'"; 	
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $totaldevices=mysql_num_rows($resultReport);
	 return  $totaldevices;

	  }
	  
	  
	  function getbarcodeqaqc($qaqccontrol,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and barcode='$qaqccontrol'"; 	
      }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and barcode='$qaqccontrol'"; 	
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' and barcode='$qaqccontrol'"; 	
	  }
	    elseif ($filter==3)//month/year
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and barcode='$qaqccontrol'"; 		 	  }
	    elseif ($filter==4)//year only
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND YEAR(resultDate)='$currentyear' and barcode='$qaqccontrol'"; 		  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and barcode='$qaqccontrol'"; 	
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $totalrows=mysql_num_rows($resultReport);
	 return   $totalrows;
	  }
	  
	  	  function getexpirydateqaqc($qaqccontrol,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and expiryDate='$qaqccontrol'"; 	
      }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and expiryDate='$qaqccontrol'"; 	
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' and expiryDate='$qaqccontrol'"; 	
	  }
	    elseif ($filter==3)//month/year
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and expiryDate='$qaqccontrol'"; 		 	  }
	    elseif ($filter==4)//year only
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND YEAR(resultDate)='$currentyear' and expiryDate='$qaqccontrol'"; 		  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and expiryDate='$qaqccontrol'"; 	
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $totalrows=mysql_num_rows($resultReport);
	 return   $totalrows;
	  }
	  
	  	  	  function getvolumeqaqc($qaqccontrol,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and volume='$qaqccontrol'"; 	
      }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and volume='$qaqccontrol'"; 	
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' and volume='$qaqccontrol'"; 	
	  }
	    elseif ($filter==3)//month/year
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and volume='$qaqccontrol'"; 		 	  }
	    elseif ($filter==4)//year only
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND YEAR(resultDate)='$currentyear' and volume='$qaqccontrol'"; 		  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and volume='$qaqccontrol'"; 	
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $totalrows=mysql_num_rows($resultReport);
	 return   $totalrows;
	  }
	  
	  	  	  	  function getdeviceqaqc($qaqccontrol,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and device='$qaqccontrol'"; 	
      }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and device='$qaqccontrol'"; 	
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' and device='$qaqccontrol'"; 	
	  }
	    elseif ($filter==3)//month/year
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and device='$qaqccontrol'"; 		 	  }
	    elseif ($filter==4)//year only
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND YEAR(resultDate)='$currentyear' and device='$qaqccontrol'"; 		  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and device='$qaqccontrol'"; 	
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $totalrows=mysql_num_rows($resultReport);
	 return   $totalrows;
	  }
	  
	    function getreagentqaqc($qaqccontrol,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and reagent='$qaqccontrol'"; 	
      }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and reagent='$qaqccontrol'"; 	
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' and reagent='$qaqccontrol'"; 	
	  }
	    elseif ($filter==3)//month/year
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' and reagent='$qaqccontrol'"; 		 	  }
	    elseif ($filter==4)//year only
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND YEAR(resultDate)='$currentyear' and reagent='$qaqccontrol'"; 		  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	$sequel="select testID from test  where  partnerID='$partnerid' AND resultDate BETWEEN '$fromdate' AND '$todate' and reagent='$qaqccontrol'"; 	
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $totalrows=mysql_num_rows($resultReport);
	 return   $totalrows;
	  }
	 //function to get reporting devices
  function reportDevice($month,$patna){
	  echo $sequel1="SELECT count(device.deviceID) as dev FROM  device,facilitys WHERE device.facilityID = facilitys.facilitycode AND facilitys.partner = 
	  '".$patna."' GROUP BY device.deviceID ";
	  $resultReport=mysql_query($sequel1);
	  echo $sql2="SELECT COUNT(DISTINCT deviceID) AS devAll FROM  `test` WHERE partnerID =  '".$patna."' AND month(resultDate)='".$month."'";
	  $devAll=mysql_query($sql2);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $myArr['1']=$resultArr['dev']; 
		  
		  }
	 while($devAllRpt=mysql_fetch_array($devAll)){
		   echo $myArr['2']=$resultArr['devAll']; 
		  
		  }
		  return $myArr;
	  }



//function to get total tests by partner
function gettotaltestsbypartner($partnerID,$currentyear,$startmont){
	
	 echo $sequel="SELECT COUNT( testID ) AS err
              FROM  `test` WHERE month(resultDate)='".$startmont."' AND  year(resultDate)='".$currentyear."' AND partnerID='".$partnerID."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $myArr['0']=$resultArr['err'];
		  }
		  
		  return $myArr['0'];
	
	}

//total errors
function gettotalerrorsbypartner($partnerID,$currentyear,$startmont){
	 echo $sequel="SELECT COUNT(IF(  `errorID` >0, NULL , 0 ) ) AS err
              FROM  `test` WHERE month(resultDate)='".$startmont."' AND  year(resultDate)='".$currentyear."' AND partnerID='".$partnerID."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $myArr['0']=$resultArr['err'];
		  }
		  
		  return $myArr['0'];
	
	}
	 
//function to get total tests and errors.
  function reportTests($month,$patna){
	  echo $sequel="SELECT COUNT( IF(  `errorID` = 0, NULL , 0 ) ) AS err, COUNT( IF(  `errorID` >0, NULL , 0 ) ) AS noErr
              FROM  `test` WHERE month(resultDate)='".$month."' AND partnerID='".$patna."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		   $myArr['1']=$resultArr['noErr'];
		  $myArr['0']=$resultArr['err'];
		  }
		  
		  return $myArr;
	  }
	 
	 
	 
	 
	 
	 //function to get total error 200.
  function errorCount($month,$patna,$errNo){
	 $sequel="SELECT COUNT( errorID ) AS err
              FROM  `test` WHERE ErrorID='".$errNo."' AND partnerID='".$patna."' And month(resultDate)='".$month."' ";
      
	  $resultReport=mysql_query($sequel);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $resultArr['err'];
		 
		  }
  }
	 
	 
	 
	 
 
  
 //fnctions
 
 //get month names from ID
function GetMonthName($month)
{
 if ($month==1)
 {
     $monthname=" Jan ";
 }
else if ($month==2)
 {
     $monthname=" Feb ";
 }else if ($month==3)
 {
     $monthname=" Mar ";
 }else if ($month==4)
 {
     $monthname=" Apr ";
 }else if ($month==5)
 {
     $monthname=" May ";
 }else if ($month==6)
 {
     $monthname=" Jun ";
 }else if ($month==7)
 {
     $monthname=" Jul ";
 }else if ($month==8)
 {
     $monthname=" Aug ";
 }else if ($month==9)
 {
     $monthname=" Sep ";
 }else if ($month==10)
 {
     $monthname=" Oct ";
 }else if ($month==11)
 {
     $monthname=" Nov ";
 }
  else if ($month==12)
 {
     $monthname=" Dec ";
 }
  else if ($month==13)
 {
     $monthname=" Jan - Sep  ";
 }
return $monthname;
}

function GetMaxMonthbasedonMaxYear($patna)
{
	
	$getmaxyear = "SELECT month(max(resultDate)) AS maxmonth FROM test where partnerID='$patna'";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maxmonth'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('m');
	}
return $showyear;
}
function getDeviceDetails($deviceautoid)
{
    $qury = "SELECT *
            FROM device
            WHERE deviceID= '$deviceautoid'";
	$reslt = mysql_query($qury) or die(mysql_error());
  	$row    =mysql_fetch_assoc($reslt);
    return $row;            
} 	

function GetMaxYear($patna)
{
    $getmaxyear = "SELECT max(year(resultDate)) AS maximumyear FROM test where partnerID='$patna'";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maximumyear'];
	
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}

function GetMinYear($patna)
{
	$getmaxyear = "SELECT MIN(year(resultDate)) AS minimumyear FROM test where partnerID='$patna'";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['minimumyear'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}


function gettotaldevices($partner)
{

$getquery = "SELECT deviceNumber FROM device where flag=1 and partnerID='$partner' ";
$queryarray = mysql_query($getquery) or die(mysql_error());
	$numdevices=mysql_num_rows($queryarray);
return $numdevices;
}





//paediatric and adults for commodity graph
 function totalchildren($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {

if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE<=2";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE<=2";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2";
	  }
	  }
else {
	   if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2 AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE<=2 AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2 AND SITE='$mfl'";
	  }
}    
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
 
	
	 
	  }
	  
	  
	  function totalfailedchildren($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
	if($level==0){

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25";
	  }
	   
	   }
	   else {
		   if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph<25 AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph<25 AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph<25 AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph<25 AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph	<25 AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE<=2 AND CD3CD4CD45TruCCD3CD4Lymph<25 AND SITE='$mfl'";
	  }
	   }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
 
	
	 
	  }
	  
	  
	  
	  
	  function totaladults($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE>2";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE>2";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2";
	  }
	  }
else {
	 if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2 AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE>2 AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2 AND SITE='$mfl'";
	  }
}  
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
	 
	  }


 function totalfailedadults($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350";
	  }
	}
	
else
{
			     if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND AGE>2 AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mfl'";
	  }
		
	
}     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
	 
	  }


function totalcaliburtests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate'";
	  }
	  }
else {

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }	
}
	  //echo $sequel;
	  	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
 
	
	 
	  }
	
function totalfailedcaliburtests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) ";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) ";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) "; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph	<25 AND AGE<=2)) ";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) ";
	  }
	  }
	
else {
	 if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$currentyear' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph	<25 AND AGE<=2)) AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph<25 AND AGE<=2)) AND SITE='$mfl'";
	  }
}  
	  
	  //echo $sequel;
	  	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
 
	
	 
	  }	

function yearlytrendy1($current,$startmonth,$a)
	  {
    if($a=0){
	 $sequel="SELECT COUNT(id) AS tot FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$current' AND Month(Date_Analyzed)='$startmonth' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph	<25 AND AGE<=2))";
   }
   if($a=1){
	 $sequel="SELECT COUNT(id) AS tot FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$current' AND Month(Date_Analyzed)='$startmonth' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph	<25 AND AGE<=2))";
   }
   
   if($a=2){
	 $sequel="SELECT COUNT(id) AS tot FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$current' AND Month(Date_Analyzed)='$startmonth' AND ((CD3CD4CD45TruCCD3CD4AbsCnt<350 AND AGE>2) OR (CD3CD4CD45TruCCD3CD4Lymph	<25 AND AGE<=2))";
   }
   //echo $sequel;
	 $resultReport=mysql_query($sequel) or die($mysql_error());
	  $resultArr=mysql_fetch_array($resultReport);
	//  print_r( $resultArr);
	  $totaltests=$resultArr['tot'];
		echo $totaltests;
		
 
	
	 
	  }
	
function yearlytrendy($current,$startmonth,$a)
	  {
    if($a=0){
	 $sequel="SELECT COUNT(id) AS tot FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$current' AND Month(Date_Analyzed)='$startmonth'";
   }
   if($a=1){
	 $sequel="SELECT COUNT(id) AS tot FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$current' AND Month(Date_Analyzed)='$startmonth'";
   }
   
   if($a=2){
	 $sequel="SELECT COUNT(id) AS tot FROM  exp_file_data WHERE YEAR(Date_Analyzed)='$current' AND Month(Date_Analyzed)='$startmonth'";
   }
   //echo $sequel;
	 $resultReport=mysql_query($sequel) or die($mysql_error());
	  $resultArr=mysql_fetch_array($resultReport);
	//  print_r( $resultArr);
	  $totaltests=$resultArr['tot'];
		echo $totaltests;
		
 
	
	 
	  }
	  
	  //display central sites as drop down list
	  function displaycentral($chosen){
	  	$sql="select name,MFLCode,AutoID FROM facility where level=0";
		$query=mysql_query($sql) or die(mysql_error());
		$mycentrals="<select name='centrals'>";
		while ($rs=mysql_fetch_array($query)) {
			if($chosen==$rs['AutoID']){
		$opt="<option value=".$rs['AutoID']." selected='selected'> ".$rs['name']."</option>";	
			}
			else {
			$opt="<option value=".$rs['AutoID']."> ".$rs['name']."</option>";
			}
		$mycentrals=$mycentrals.$opt;	
			
		}
		$mycentrals=$mycentrals."</select>";
		return $mycentrals;
	  }
	//display districts as dropdown
	 function displaycentraldists($dist){
	  	$sql="select name,ID FROM districts";
		$query=mysql_query($sql) or die(mysql_error());
		$mycentrals="<select name='districts'>";
		while ($rs=mysql_fetch_array($query)) {
			if($chosen==$rs['ID']){
		$opt="<option value=".$rs['ID']." selected='selected'> ".$rs['name']."</option>";	
			}
			else {
			$opt="<option value=".$rs['ID']."> ".$rs['name']."</option>";
			}
		$mycentrals=$mycentrals.$opt;	
			
		}
		$mycentrals=$mycentrals."</select>";
		return $mycentrals;
	  }	  
	
//Generating the cumulative Statistics Table
	
function getcumulativedata1($currentyear){
	   	
		$col1_val1_sql = "SELECT (SELECT COUNT(*) from test where `testID`!=0 AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where `SampleID`!=0 AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";
		$query =mysql_query($col1_val1_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['Sumcount'];
		return $results;
}
function getcumulativedata2($currentyear){            
		$col1_val2_sql = "SELECT (SELECT COUNT(*) from test where cdCount<350 AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";
		$query =mysql_query($col1_val2_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['Sumcount'];
		return $results;
}

function getcumulativedata3($currentyear){
		$col2_val1_sql = "SELECT COUNT(*) as total from test where `testID`!=0 AND YEAR(resultDate)='$currentyear'";
		$query =mysql_query($col2_val1_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['total'];
		return $results;
}
function getcumulativedata4($currentyear){
		$col2_val2_sql = "SELECT COUNT(*) as total1 from test where cdCount<350 AND YEAR(resultDate)='$currentyear'";
		$query =mysql_query($col2_val2_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['total1'];
		return $results;
}
function getcumulativedata5($currentyear){
		$col3_val1_sql = "SELECT COUNT(*) as total2 from exp_file_data where `SampleID`!=0 AND YEAR(Date_Analyzed)='$currentyear'";
		$query =mysql_query($col3_val1_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['total2'];
	    return $results;
}
function getcumulativedata6($currentyear){
		$col3_val2_sql = "SELECT COUNT(*) as total3 from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND YEAR(Date_Analyzed)='$currentyear'";
		$query=mysql_query($col3_val2_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['total3'];
		return $results;
}

//Generating the Current Period Statistics Table
$currentyear = date("Y");
$currentmonth = date("m");	
function getcurrentdata1($currentmonth,$currentyear){
		$col_val1_sql = "SELECT (SELECT COUNT(*) from test where `testID`!=0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where `SampleID`!=0 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";
		$query =mysql_query($col_val1_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['Sumcount'];
		return $results;
}
function getcurrentdata2($currentmonth,$currentyear){            
		$col_val2_sql = "SELECT (SELECT COUNT(*) from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";
		$query =mysql_query($col_val2_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['Sumcount'];
		return $results;
}

function getcurrentdata3($currentmonth,$currentyear){
		$col2_val1_sql = "SELECT COUNT(*) as totala from test where `testID`!=0 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'";
		$query =mysql_query($col2_val1_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['totala'];
		return $results;
}
function getcurrentdata4($currentmonth,$currentyear){
		$col2_val2_sql = "SELECT COUNT(*) as totalb from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'";
		$query =mysql_query($col2_val2_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['totalb'];
		return $results;
}
function getcurrentdata5($currentmonth,$currentyear){
		$col3_val1_sql = "SELECT COUNT(*) as totalc from exp_file_data where `SampleID`!=0 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'";
		$query =mysql_query($col3_val1_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['totalc'];
		return $results;
}
function getcurrentdata6($currentmonth,$currentyear){
		$col3_val2_sql = "SELECT COUNT(*) as totald from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'";
		$query=mysql_query($col3_val2_sql) or die(mysql_error());
		$results = mysql_fetch_assoc($query);
		$results = $results['totald'];
		return $results;
}

//Generating the <350cell/mm3 Line Graph
//Calibur <350cell/mm3
function totalcaliburtests350_1($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
$query="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'"; 
	
	 $resultReport=mysql_query($query);
	 $resultArr=mysql_fetch_array($resultReport);
	 $totaltests=$resultArr['tot'];
	return  $totaltests;
	  }
//Pima <350cell/mm3
function totalpima350_1($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
$query="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 
	
	 $resultReport=mysql_query($query);
	 $resultArr=mysql_fetch_array($resultReport);
	 $totaltests=$resultArr['tot'];
	 return  $totaltests;
	  }	
//Total <350cell/mm3
function totalequiptests350_1($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
		 $query="SELECT (SELECT COUNT(*) from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";
		  
	 $resultReport=mysql_query($query);
	 $resultArr=mysql_fetch_array($resultReport);
	 $totaltests=$resultArr['Sumcount'];
	 return  $totaltests;
		 
		  }  
	  
//Total Calibur Tests <350cell/mm3
function totalcaliburtests350($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND YEAR(Date_Analyzed)='$currentyear'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate'";
	  }
	  }
else {

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE  CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT COUNT(id) AS tot
              FROM  exp_file_data WHERE CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }	
}
	  //echo $sequel;
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  $totaltests=$resultArr['tot'];
		
		return  $totaltests;
	  }

//Total Tests <35Ocells/mm3
function totalequiptests350($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate') AS Sumcount";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND resultDate BETWEEN '$fromfilter' AND '$tofilter')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter') AS Sumcount";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate') AS Sumcount";
	  }
	  }
else {

       if ($filter==0) //last submission
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl') AS Sumcount";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl') AS Sumcount";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND resultDate BETWEEN '$fromfilter' AND '$tofilter')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND SITE='$mfl') AS Sumcount";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl') AS Sumcount"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl') AS Sumcount";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where CD3CD4CD45TruCCD3CD4AbsCnt<350 AND Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl') AS Sumcount";
	  }	
}

	  $resultReport2=mysql_query($sequel2);
	  $resultArr2=mysql_fetch_array($resultReport2);
	  $totaltests2=$resultArr2['Sumcount'];
		
		return  $totaltests2;
	  }

	  
 function totalpimatests350($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND resultDate BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND YEAR(resultDate)='$currentyear'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  }
else {

       if ($filter==0) //last submission
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND resultDate BETWEEN '$fromfilter' AND '$tofilter' AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND YEAR(resultDate)='$currentyear' AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE cdCount<350 AND resultDate BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }	
}

	  $resultReport1=mysql_query($sequel1);
	  $resultArr1=mysql_fetch_array($resultReport1);
	  $totaltests1=$resultArr1['tot'];
	  return  $totaltests1; 
	  }		
		
		
	function totalequiptests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where Date_Analyzed BETWEEN '$fromdate' AND '$todate') AS Sumcount";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where resultDate BETWEEN '$fromfilter' AND '$tofilter')+(SELECT COUNT(*) from exp_file_data where Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter') AS Sumcount";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear') AS Sumcount"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel2="SELECT (SELECT COUNT(*) from test where YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where YEAR(Date_Analyzed)='$currentyear') AS Sumcount";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where Date_Analyzed BETWEEN '$fromdate' AND '$todate') AS Sumcount";
	  }
	  }
else {

       if ($filter==0) //last submission
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl') AS Sumcount";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl') AS Sumcount";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel2="SELECT (SELECT COUNT(*) from test where resultDate BETWEEN '$fromfilter' AND '$tofilter')+(SELECT COUNT(*) from exp_file_data where Date_Analyzed BETWEEN '$fromfilter' AND '$tofilter' AND SITE='$mfl') AS Sumcount";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where month(Date_Analyzed)='$currentmonth' AND YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl') AS Sumcount"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel2="SELECT (SELECT COUNT(*) from test where YEAR(resultDate)='$currentyear')+(SELECT COUNT(*) from exp_file_data where YEAR(Date_Analyzed)='$currentyear' AND SITE='$mfl') AS Sumcount";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel2="SELECT (SELECT COUNT(*) from test where resultDate BETWEEN '$fromdate' AND '$todate')+(SELECT COUNT(*) from exp_file_data where Date_Analyzed BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl') AS Sumcount";
	  }	
}

	  $resultReport2=mysql_query($sequel2);
	  $resultArr2=mysql_fetch_array($resultReport2);
	  $totaltests2=$resultArr2['Sumcount'];
		
		return  $totaltests2;
	  }	

function totalpimatests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate,$level,$mfl)
	  {
if($level==0){
       if ($filter==0) //last submission
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE  resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE resultDate BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE YEAR(resultDate)='$currentyear'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE resultDate BETWEEN '$fromdate' AND '$todate'";
	  }
	  }
else {

       if ($filter==0) //last submission
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND SITE='$mfl'";  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE  resultDate BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE resultDate BETWEEN '$fromfilter' AND '$tofilter' AND SITE='$mfl'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND SITE='$mfl'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE YEAR(resultDate)='$currentyear' AND SITE='$mfl'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel1="SELECT COUNT(testID) AS tot
              FROM test WHERE resultDate BETWEEN '$fromdate' AND '$todate' AND SITE='$mfl'";
	  }	
}

	  $resultReport1=mysql_query($sequel1);
	  $resultArr1=mysql_fetch_array($resultReport1);
	  $totaltests1=$resultArr1['tot'];
		
		return  $totaltests1;
 
 }
	function commReportingExpected($year,$month,$county){
	$d= date('Y-m-01', strtotime("$year-$month-1"));
	
	if( ($county=="")||($county==0)){
		$sql="SELECT COUNT(*) as exp 
			FROM `facility` 
			WHERE rolloutstatus=1 
			AND `facility`.`rolloutDate`<='$d'
			";
	}else{	
		$sql= "SELECT COUNT(*) as exp 
			FROM `facility`
				RIGHT JOIN `districts`
						ON `districts`.`ID`=`facility`.`district`
						RIGHT JOIN `countys`
							ON `districts`.`county`=`countys`.`ID`						 
			WHERE rolloutstatus=1 
			AND `countys`.`ID`='".$county."'
			AND `facility`.`rolloutDate`<='$d'
			";
		}
	$resultReport=mysql_query($sql) or die($mysql_error());
	$expArr=mysql_fetch_assoc($resultReport);

	return $expArr['exp'] ;
}
function commReported($year,$month,$county){
	
	$dt=date('t',strtotime("$year-$month-1"));
	
	if( ($county=="")||($county==0)){
		$sql= "SELECT COUNT(*) as exp 
				FROM `fcdrrlists` 
				WHERE `fromdate`='".$year."-".$month."-1' 
				OR `todate`='".$year."-".$month."-$dt'";
	}else{
		$sql="SELECT COUNT(*) as exp 
				FROM `fcdrrlists` 
				RIGHT JOIN `facility`
					ON `fcdrrlists`.`MFLCode`=`facility`.`MFLCode`
					RIGHT JOIN `districts`
						ON `districts`.`ID`=`facility`.`district`
						RIGHT JOIN `countys`
							ON `districts`.`county`=`countys`.`ID`
				WHERE (`fromdate`='".$year."-".$month."-1' 
				OR `todate`='".$year."-".$month."-$dt')
				AND `countys`.`ID`='".$county."'
				";
	}
	$resultReport=mysql_query($sql) or die($mysql_error());
	$expArr=mysql_fetch_assoc($resultReport);

	return $expArr['exp'] ;
	
}
function commAllocated($year,$month,$county){
	$jsondata = file_get_contents("http://41.222.14.10:85/HCMP/cd4_management/allocated_totals/$year/$month");
	$allocated = json_decode($jsondata);
	
	$i=0;
	foreach($allocated as $all){
		$i++;
	}
	return $i;	
}

function reportingCounties($mfl){
	$sql="SELECT * FROM `countys`";
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_assoc($query)) {
		if($rs['ID']==$mfl){
			echo "<option value=".$rs['ID']." selected >".$rs['name']."</option>";
		}
		else{
			echo "<option value=".$rs['ID'].">".$rs['name']."</option>";
		}
	}

}
function topReporting($county){
	
	if( ($county=="")||($county==0)){
	$sql="SELECT `name`, COUNT( * ) AS total
				FROM `fcdrrlists`
				LEFT JOIN `facility`
						ON `fcdrrlists`.`mflcode`=`facility`.`MFLCode`
				GROUP BY `name`				
				ORDER BY total DESC ";
	}else{
		$sql="SELECT `facility`.`name`, COUNT( * ) AS total
				FROM `fcdrrlists`
				LEFT JOIN `facility`
					ON `fcdrrlists`.`mflcode`=`facility`.`MFLCode`
					LEFT JOIN `districts`
						ON `districts`.`ID`=`facility`.`district`
						LEFT JOIN `countys`
							ON `districts`.`county`=`countys`.`ID`
				WHERE `countys`.`ID`='".$county."'
				GROUP BY `facility`.`name`				
				ORDER BY total DESC ";
	
	}
	$i=0;
	$query = mysql_query($sql) or die(mysql_error());
	while ($rs = mysql_fetch_assoc($query)) {
		if($i<5){
		echo "<li>".$rs['name']."&nbsp;"."</li>";
		$i++;
		}
	}
	
	}
?>