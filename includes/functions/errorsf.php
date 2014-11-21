<?php
//groups the errors of month,year and partner	
	  function uniqueErr($month,$year,$partner){
	  $sql="SELECT COUNT( DISTINCT (`errorID`) )  as err FROM  `test` WHERE MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."' AND errorID>0 ";
	  $cd=array();
	  $resultReport=mysql_query($sql);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  $cd['0']=$resultArr['err'];
		  }
		  
		  return $cd['0'];
			}
	
	//function to display details of the errors within the month
	//fetch the error IDs
	 function uniqueErrIds($month,$year,$partner){
	   $sql="SELECT  DISTINCT (`errorID`)  as err FROM  `test` WHERE MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."' AND errorID>0 ";
	  $cd=array();
	  $resultReport=mysql_query($sql);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  $cd['0']=$resultArr['err'];
		  }
		  
		  return $cd;
			}
			//function that gets error details from array and disply their dtails
	function uniqueErrDetails($month,$year,$partner){
			  $sql="SELECT DISTINCT `errorName` as num , `errorDetail` as dtail FROM error, test WHERE test.errorID = error.errorID
 				AND   MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."' AND test.errorID>0 ";
			 $rs=mysql_query($sql) or die();
			return $rs;
		
	}
	
	 //error in testlist
	 function uniqueErr1($month,$patna,$yr){
		echo $sequel="SELECT DISTINCT errorID FROM  `test`  WHERE test.errorID !=0 AND year(resultDate)='$yr' AND partnerID='$patna'";
	  $resultReport=mysql_query($sequel);
	  while($rs=mysql_fetch_array($resultReport)){ 
	  $errs=$rs['errorID'];
		periodErr($month,$patna,$yr,$errs);  
		  }
		 }
		 
		 //to display the errs
	  function periodErr($month,$patna,$yr,$err){
	 echo  $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
			  FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID !=0 AND year(resultDate)='$yr' AND 	              partnerID='$patna' AND test.errorID='$err'";
	  $resultReport=mysql_query($sequel);
	 
	 $resultArr=mysql_fetch_row($resultReport);
	 $erName=$resultArr['errorName'];
	 
		 echo '<tr><td>'.$erName.'</td></tr>';
		  
	  }	
			
			
			
			
			//get specific error details during upload
		function getError($err){
			$sql="select * from error where errorDetail='".$err."'";
			$executeSql=mysql_query($sql);
			$result=mysql_fetch_assoc($executeSql);
			return $result;
			
		}
		
		
			 
	 //function to get total error of given parameter
    function errorCount1($month,$patna,$errNo){
	 $sequel="SELECT COUNT( errorID ) AS err FROM  `test` WHERE ErrorID='".$errNo."' AND partnerID='".$patna."' And month(uploadDate)='".$month."' ";
      
	  $resultReport=mysql_query($sequel);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $resultArr['err'];
		 
		  }
  }
  
  //function giving number of errors by specific partner
			function getErrorId($err){
				//in the db empty tests are represented by a zero
				$sql1="SELECT errorID as zero FROM  `error` WHERE errorName='".$err."' LIMIT 1";
				$query1=mysql_query($sql1);
				$myArr=array();
				while($result=mysql_fetch_assoc($query1)){
					if($result!=""){
					$myArr['1']=$result['zero'];
					}
					else{
						$myArr['1']=0;
						
						}
				}
				return $myArr['1'];
				}
			
		
	//function giving number of errors by specific partner
			function getErr(){
				//in the db empty tests are represented by a zero
				$sql1="SELECT COUNT(`cdCount`) as zero FROM  `test` WHERE cdCount<1";
				$query1=mysql_query($sql1);
				$myArr=array();
				for($i;$result=mysql_fetch_assoc($query1);$i++){
					$myArr[$i]=$result;
					}
				return $myArr;
				}
			
					//function to check for an error number
		function checkErr($err){
			$query="select errorId From error where errorName='".$err."' LIMIT 1";
			$res=mysql_query($query);
			$myarr[]=array();
			while($result=mysql_fetch_array($res)){
				
			$myarr[1]=$result['errorId'];
			
			}
			
			return $myarr['1'];
			}		
				//get error details
		function getMyError(){
			$sql="select * from error";
			$executeSql=mysql_query($sql);
			$result=mysql_fetch_assoc($executeSql);
			return $result;
			
			
			}
			
//add errors to checkup table
		
		function adderr($errNo,$errDet){
			
		    $sql="INSERT INTO `poc`.`error` (`errorName` ,`errorDetail`) VALUES ('".$errNo."','".$errDet."')";
			$result=mysql_query($sql) or exit();
			
			
			}	
		
  //tests with error
	  function totalErr1($month,$patna){
	 $sequel="SELECT COUNT(testID) AS tot
              FROM  `test` WHERE cdCount = 0 AND  month(resultDate)='".$month."' AND partnerID='".$patna."' ";
      
	  $resultReport=mysql_query($sequel);
	  $myArr=array();
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo $myArr['1']=$resultArr['tot'];
		  }
	  }

//groups the errors of month,year and partner	
	  function totalMonthErr($month,$year,$partner){
	  $sql="SELECT COUNT(`errorID` )  as err FROM  `test` WHERE MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."' AND errorID>0 ";
	  $cd=array();
	  $resultReport=mysql_query($sql);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  $cd['0']=$resultArr['err'];
		  }
		  
		  return $cd['0'];
			}
			

	  
	  
	    function totallistingbycategory($errorid,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {

       if ($filter==0) //last submission
	  {
		 $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
		   FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID ='$errorid'  AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'"; 		  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
 $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
		   FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID ='$errorid' AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid'";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
 $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
		   FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID ='$errorid' AND resultDate BETWEEN '$fromfilter' AND '$tofilter' AND partnerID='$partnerid'";
	  }
	    elseif ($filter==3)//month/year
	  {
		 $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
		   FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID ='$errorid' AND month(resultDate)='$currentmonth' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'"; 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
		   FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID ='$errorid' AND YEAR(resultDate)='$currentyear' AND partnerID='$partnerid'";	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
		 $sequel="SELECT errorName,  `barcode` ,  `expiryDate` ,  `volume` ,  `reagent` ,  `device` , COUNT( test.errorID ) AS count
		   FROM  `test` , error WHERE test.errorID = error.errorID AND test.errorID ='$errorid' AND resultDate BETWEEN '$fromdate' AND '$todate' AND partnerID='$partnerid'";
	  }
	     //echo $sequel;
	  $resultReport=mysql_query($sequel) or die(mysql_error());
		
		return  $resultReport;

	  }
	  
	  		
	 
?>