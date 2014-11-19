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
while($rs=mysql_fetch_array($q)){
echo $rs['facilitycode'];
}
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
  $highestRow         = $objPHPExcel->setActiveSheetIndex(2)->getHighestRow();; 
  $highestColumn      = $worksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
   $arr=$worksheet->toArray(null,true, true, true); 
	$arr1=array();
	
	
	
    for ($row = 7; $row <=$highestRow; ++ $row) {
        
        for ($col = 14; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
			$arr[$row][$col]= $cell->getValue();
           // $val = $cell->getValue();
           // $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
		}	
		if($arr[$row]["O"]!=""){
      $fac=$arr[$row]["O"];
	 echo $fac."-";
	//regex to get the facility number from splitting the sampleNumber
	if (substr($arr[$row]["O"], 0, strpos($arr[$row]["O"], '-'))) {
		  $fac=substr($arr[$row]["O"], 0, strpos($arr[$row]["O"], '-')); 
		
		  }
	else{
		$fac=$arr[$row]["O"];
		
	}
			uploadmfl($fac);
			echo "<br />";
		}
	}
			
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

