<?php

//function to upload excel file
function uploadExcel($file_1,$date,$patna){
		
			
$edata = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$edata->setOutputEncoding("CP1251");


if($_FILES[$file_1]['tmp_name'])
{
$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
$excelReader->setReadDataOnly(true);
$objPHPExcel = PHPExcel_IOFactory::load($_FILES[$file_1]['tmp_name']);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));


 }

$objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xlsx', __FILE__) );

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
   $worksheetTitle     = $worksheet->getTitle();
  $highestRow         = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();; 
  $highestColumn      = $worksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
   $arr=$worksheet->toArray(null,true, true, true); 
	$arr1=array();
	
	
	
    for ($row = 2; $row <=$highestRow; ++ $row) {
        
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
			$arr[$row][$col]= $cell->getValue();
           // $val = $cell->getValue();
           // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
		}	
     $test=$arr[$row]["A"];
	 $deviceNo=$arr[$row]["B"];
	 $assay=$arr[$row]["C"];
	 $sample=$arr[$row]["E"];
	 $cd=$arr[$row]["F"];
	 $rdate=$arr[$row]["I"];
	 $resultDate=date('Y-m-d',strtotime($arr[$row]["I"]));
	//$resultDate=convertresultdate($arr[$row]["I"]);
	$resultTime=convertresulttime(time($arr[$row]["J"]));
	 $operator=$arr[$row]["H"];
	 $barcode=checkQAQC($arr[$row]["K"]);
	 $expire=checkQAQC($arr[$row]["L"]);
	 $volume=checkQAQC($arr[$row]["M"]);
	 $device=checkQAQC($arr[$row]["N"]);
	 $reagent=checkQAQC($arr[$row]["O"]);
	$error=getErrorId(substr($arr[$row]["G"],-3)); 
	//echo $test."<br />";
	
	//regex to get the facility number from splitting the sampleNumber
	if (preg_match('/(\d{1,100})[a-zA-Z]/', $sample, $matches)) {
		  $facilityNum[0]=$matches[1]; 
		  }
	
	 if($test!=""){
  $sequel="SELECT count(testID) as num FROM test WHERE testNO='".$test."' AND deviceID='".$deviceNo."' AND partnerID='".$patna."' AND sampleNumber='".$sample."'";	
	  $qeryCount=mysql_query($sequel);
	   while($resulltCount=mysql_fetch_array($qeryCount)){
		 $num=$resulltCount['num']; 
	  if($num==0){
            $addsql = "INSERT INTO `test` (`testNO`,`deviceID`, `asayID`, `sampleNumber`, `errorID`, `cdCount`,
            `resultDate`, `resultTime`, `operatorId`, `barcode`, `expiryDate`, `volume`, `uploadDate`, `device`, `reagent`, `partnerID`,facility)
             VALUES ('".$test."','".$deviceNo."','".$assay."','".$sample."','".$error."','".$cd."',
             '".$resultDate."','".$resultTime."','".$operator."','".$barcode."','".$expire."','".$volume."',
             '".$date."','".$device."','".$reagent."','".$patna."','".$facilityNum[0]."')";
   	         $executeSql=mysql_query($addsql);
		     $message = 'Upload was successfully done';
			 echo '<script type="text/javascript">' ;
	echo "window.location.href='excel_upload.php?successsave=$message'";
	echo '</script>';
	  	 } 
	   }
      
		  
   }
 }
}
	return $message;
      }	
			

	
	
	//function for date format in xlsx upload
	
	function formatresultdate($resultdate)
{
list($m, $d, $y) = preg_split('/\//', $resultdate);
$strippedresultdate= sprintf('%4d-%02d-%02d', $y, $m, $d);
$dateofresult = strtotime ( '-0 day' , strtotime ( $strippedresultdate) ) ;
$dateofresult = date ( 'Y-m-j' , $dateofresult ); //convert date to yyy-mm-dd format
$newDta=substr($dateofresult,0,11);
return $dateofresult;
}
 

 //converts excel date format to nomalcy
function convertresultdate($datefromexcel)
                {
                $DayDifference = 25569; //Day difference between 1 January 1900 to 1 January 1970
    $Day2Seconds = 86400; // no. of seconds in a day
    $ExcelTime= $datefromexcel ; //integer value stored in the Excel column
               
    $UnixTime = ($ExcelTime - $DayDifference)*$Day2Seconds; //convert it to unit time
                $converteddate= date("Y-m-d", $UnixTime);
                $dateofresult = strtotime ( '-0 day' , strtotime ( $converteddate) ) ;
               $dateofresult = date ( 'Y-m-j' , $dateofresult ); //convert date to yyy-mm-dd format
                return $dateofresult ;
                }
 	
	 //converts excel date format to nomalcy
function convertresulttime($timefromexcel)
                {
    $DayDifference = 25569; //Day difference between 1 January 1900 to 1 January 1970
    $Day2Seconds = 3600; // no. of seconds in a day
    $ExcelTime= $timefromexcel ; //integer value stored in the Excel column
               
    $UnixTime = ($ExcelTime)*$Day2Seconds; //convert it to unit time
                $converteddate= date("H:i:s", $UnixTime);
                $dateofresult = strtotime ( '-0 day' , strtotime ( $converteddate) ) ;
               $dateofresult = date ( "H:i:s" , $dateofresult ); //convert date to yyy-mm-dd format
                return $dateofresult ;
                }
 	
			
			
			//function to get the last upload
			function LastUploaded($userId,$device){
				$sql="SELECT MAX( MONTH( resultDate ) ) AS MONTH , MAX( YEAR(  `resultDate` ) ) AS year FROM test WHERE partnerID = '".$userId."' AND deviceID =  '".$device."'";
				$query=mysql_query($sql) or die(mysql_error());
				$myarr[]=array();
				while($res=mysql_fetch_array($query)){
					$myarr['1']=$res['MONTH'];
					$myarr['2']=$res['year'];
					
					$today=(date(m)-1);
					$yr=date("Y");
					if($myarr['1']==$today && $myarr['2']==date('Y')){
						$mynum=0;
						}
						else{
							$mynum=1;
							}
						}
					return $mynum;
				
				}
		
//confrim last
	  		function LastUpload($userid){
				$dev=0;
				$sql="SELECT deviceNumber from device where partnerID='".$userid."'";
				$query=mysql_query($sql) or die(mysql_error());
				$myarr[]=array();
				while($res=mysql_fetch_array($query)){
					 $device=$res['deviceNumber'];
					 $result=LastUploaded($userid,$device);
					$dev+=$result;
					
			}
					return $dev;
				
				}
	//function to get last upload
	function durationsincelastupload($patna){
		$sql="SELECT MIN( resultDate ) FROM test WHERE partnerID='".$patna."'";
		$query=mysql_query($sql) or die(mysql_error());
		$dat=mysql_fetch_row($query);
		if(isset($dat[0])){
		$lastDate=$dat[0];
		}
		else{
			$lastDate="2012-01-01";
			}
		$today=date(Y-m-d);
		$diff = abs(strtotime($today) - strtotime($lastDate));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	    return $months;	
		}
	    
  function notifyUpload($patna){
	  $today=date('Y-m-d');
	  //if date is greater than 25 it shud be direct
	 $sql="SELECT DISTINCT deviceID FROM test WHERE partnerID =  '1' AND MONTH( se ) < MONTH( 2012 -10 -24 ) LIMIT 0 , 30";
	 
	 //if not then 
	  }
	 
//function to get date for month upload
		function uploadDay($month,$year,$partner){
	 $sql="SELECT DISTINCT(uploadDate) as err FROM  `test` 
	 WHERE MONTH(`resultDate`) ='".$month."' AND year(`resultDate`) ='".$year."' AND `partnerID` ='".$partner."'";
	  $resultReport=mysql_query($sql);
	  while($resultArr=mysql_fetch_array($resultReport)){
		  echo date('d-M-Y' , strtotime ($resultArr['err']));
		  }
			}
?>