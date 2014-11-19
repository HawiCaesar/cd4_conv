<?php



$host="localhost";
		$user="root";
		$pass="";
		$db="cd4";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);

require_once("excelreader/Excel/reader.php");
/** PHPExcel_IOFactory */
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel/Cell.php';

//upload
function uploadmfl($fac){
$sql="SELECT facilitycode from facilitys where facilityName like '%$fac%' limit 0,1";	
$q=mysql_query($sql);
while(@$rs=mysql_fetch_array($q)){
$a= $rs['facilitycode'];
}
return $a;
}

//function to get the district
function getDistrict($mfl){
	$sql="SELECT d.ID FROM facilitys f, `districts` d WHERE f.district = d.ID AND f.facilitycode ='$mfl'";
	$query=mysql_query($sql);
	$rs=mysql_fetch_row($query);
	return $rs[0];
}

function upload_file($mfl,$test,$beg,$rec,$dispe,$loss,$adj,$end,$unit,$moc,$dist,$county){
echo $sql="INSERT INTO `cd4`.`hcmp_stock_status` (`mflcode`, `test_type`, `beginningbal`, `received`,
`dispenced`, `losses`, `adjustments`, `endbal`, `unittests`, `moc`, `district`, `county`) 
VALUES($mfl,$test,$beg,$rec,$dispe,$loss,$adj,$end,$unit,$moc,$dist,$county)";	
//@$query=mysql_query($sql);
}
	


//function to get the county
function getCounty($mfl){
	$sql="SELECT d.county FROM facilitys f, `districts` d WHERE f.district = d.ID AND f.facilitycode ='$mfl'";
	$query=mysql_query($sql);
	$rs=mysql_fetch_row($query);
	return $rs[0];
}

//get test
function gettestname($test){
$sql="SELECT testId from hcmp_test where test_name like '%$test%' limit 0,1";	
$q=mysql_query($sql);
while($rs=mysql_fetch_array($q)){
$tst= $rs['testId'];
}
return $tst;
}
//function to upload excel file
function uploadExcel($file_1){
		ini_set("max_execution_time",'1000000');
		ini_set("memory_size",'512M');
			
$edata = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$edata->setOutputEncoding("CP1251");


$objPHPExcel = PHPExcel_IOFactory::load($file_1 );

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
   $worksheetTitle     = $worksheet->getTitle();
  $highestRow         = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();; 
  $highestColumn      = $worksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
   $arr=$worksheet->toArray(null,true, true, true); 
	$arr1=array();
	
	
	
    for ($row = 5; $row <=$highestRow; ++ $row) {
        
        for ($col = 1; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
			$arr[$row][$col]= $cell->getValue();
           // $val = $cell->getValue();
           // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
		}	
		if($arr[$row]["B"]!=""){
      $test=gettestname($arr[$row]["B"]);
	 //echo $test2=$arr[$row]["C"];
	 //echo $no=$arr[$row]["D"];
	 $begbal=$arr[$row]["F"];
	 $rec=$arr[$row]["G"];
	 $disp=$arr[$row]["H"];
	 $loss=$arr[$row]["I"];
	 $adj=$arr[$row]["J"];
	 $end=$arr[$row]["K"];
	 $mci=$arr[$row]["L"];
	 $moc=$arr[$row]["M"];
	 $fac=str_replace("'","",$arr[$row]["E"]);
	 
	 
	 
	 if (substr($arr[$row]["E"], 0, strpos($arr[$row]["E"], '-'))) {
		  $fac=substr($arr[$row]["E"], 0, strpos($arr[$row]["E"], '-')); 
		
		  }
	else{
		$fac=str_replace("'","",$arr[$row]["E"]);
		
	}
		 $r=uploadmfl($fac);
			if ($r!=""){
			echo $test."-".$fac."-".$r."-".$begbal."-".$rec."-".$disp."-".$loss."-".$adj."-".$end."-".$mci."-".$moc."=".getDistrict($r)."-".getCounty($r);
		    echo "<br />";
			upload_file($r,$test,$begbal,$rec,$disp,$loss,$adj,$end,$mci,$moc,getDistrict($r),getCounty($r));	
			}
			
		
	 	
	
	 
		
	}}
			
 }
}

?>

<?php
if(isset($_POST['savenLeave'])){
	if(!$_FILES['file_1']['tmp_name']){
echo $errormsg="Error Saving, No file was uploaded";	
	}
else{
	uploadExcel($_FILES['file_1']['tmp_name']);
}
}
?>
<html>
	<head><title>Excel service point upload</title></head>
	<body>
		
		 <form name="frm" method="post" enctype="multipart/form-data" id="frm_1">
                  <div class="clonable form" > 
                     <table width="200" border="1" class="data-table">
                     	<tr><br  />
             			
   							 <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>File to upload:</td>
   							 <td><input type="file" name="file_1" id="file_1" size="30"/></td>
                             <p>&nbsp;</p>
 						 </tr>
  						 
					</table>
                   
                  
                 </div> 
                   <div style="border:medium;background-position:center;c height:auto;">
                   <table width="200" border="1">
                     		 <tr>
    							<th colspan="2">
                                <div align="center">
                                <input name="savenLeave" type="submit"   id="btn_save_1" value="Save" class="button" />
                                <input type="reset" name="cancel"  id="cancel_1" value="Reload page" class="button" />
                                </div>
                                </th>
  						</tr>
                    </table>
                  </div>
                   </form>
		
	</body>
</html>

