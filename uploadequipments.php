<?php
session_start(); 
include('includes/header.php');
	
require_once ('Excel/reader.php');
//require_once('connection/config.php');
?>

<style type="text/css">
select {
width: 250;}
</style>	
<div  class="section">
		<div class="section-title">Upload Facility Equipments </div>
		<div class="xtop">
		

			<?php   
			
if(isset($_POST['submit']))
{    $file1  = $_FILES['filename']['name'];
	 if  ($file1 =="" )
	{
		$error='<center>'."Please Select a Results Excel".'</center>';
	
		?>
		<table   >
  <tr>
    <td style="width:auto" ><div class="error"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$error.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php 

      print "<form action='' method='post' enctype='multipart/form-data'>";

echo "<table border='0' class='data-table'>	

		
		<tr >
		<td colspan='1'>
		Locate Excel file name to import:		</td>
     		<td colspan='5'><input type=file name=filename></td>
		
		</tr>	
<tr >
		<td colspan='6'>
		<input type='submit' name='submit' value='submit' class='button'></td>
     		
		</tr>	
		</table>";

     

      print "</form>";

} 
	

		elseif ($file1 !="" ) //work sheet not null
		{
			 $work=$_POST['work'];
  			 $imagename = $_FILES['filename']['name'];
			  $source = $_FILES['filename']['tmp_name'];
              $target = "UploadedData/".$imagename;
              move_uploaded_file($source, $target);
			  $imagepath = $imagename;
				$file = "UploadedData/".$imagepath; //This is the original file 
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				$data->read($file);
$dateruncompleted = $data->sheets[0]["cells"][7][2];
$count=0;
for ($x = 5; $x <=235; $x++) 
		{
			//$zz=5;
			
			//for ($zz = 1; $zz <=8; $zz++) 
		//	{
			$columnno=$zz;
			//echo "COLUMN ".$leta.$columnno .'<BR/>' ;
			$consumption = $data->sheets[0]["cells"][$x][$zz];
			//$icod = $data->sheets[0]["cells"][$x][$zz+1];
			//ECHO  "COLUMN".$columnno.'dATA' .$hivod .  "<br/>";
			$districtname = mysql_real_escape_string($data->sheets[0]["cells"][$x][1]);
			if ($districtname !="")
			{ $districtID= GetDistrictIDfromName($districtname);}
			else {}		
			$centralsitename = mysql_real_escape_string($data->sheets[0]["cells"][$x][2]);
			$referalsitename = mysql_real_escape_string($data->sheets[0]["cells"][$x][3]);
			$sitecode = $data->sheets[0]["cells"][$x][4];
			$distance = $data->sheets[0]["cells"][$x][5];
			$ftype = $data->sheets[0]["cells"][$x][6];
			if ($ftype !="")
			{ $ftypeID= GetFacilityTypeID($ftype);			}
			else {}			
			
			$patontreatment = $data->sheets[0]["cells"][$x][7];
			$patoncare = $data->sheets[0]["cells"][$x][8];
			// echo  "Column No " . $columnno .  "<br/>";
			
			IF ($centralsitename =="") //referall
			{
			$level=1;
			$mothersitename=$centralsitename ;
			$facilityname=$referalsitename;
			}
			ELSE  // central sites
			{
			$level=0;
			$mothersitename="" ;
			$facilityname=$centralsitename;
			}
			
			IF ($districtname =="") // blank column
			{
			
			}
			else
			{ 
			$updatesampleresults = mysql_query(" insert into facility(MFLCode,name,district,districtname,type,typename,centralsitename,level,distance) values ('$sitecode','$facilityname','$districtID','$districtname','$ftypeID','$ftype','$mothersitename','$level','$distance')");
			}

	IF ($updatesampleresults)
	{
		IF ($districtname =="") // blank column
			{
			
			}
			else
			{ 
		$fcode=GetFacilityAutoID($facilityname);
		$updatesampleresults = mysql_query("insert into facilitypatients(facility,fname,ontreatment,oncare) values ('$fcode','$facilityname','$patontreatment','$patoncare')");
			}//end while
	
	}
			
			 $count ++;
			
			// $zz=$zz+1;
			 $yy=$yy+1;
			
			//}//ennd inn for
			  $leta++;
		}//end for


 if  (  $updatesampleresults    )
	 {
	 ECHO "Success";
	 }
						
	
unlink($file);		

							


} // end if filename not null
 
 }// end if submitted
   else //not submiited
   {





      print "<form action='' method='post' enctype='multipart/form-data'>";

echo "<table border='0' class='data-table'>	
		<tr >
		<td colspan='1'>
		Locate Excel file name to import:		</td>
     		<td colspan='5'><input type=file name=filename></td>
		
		</tr>	
<tr>
		<td colspan='6'>
		<input type='submit' name='submit' value='submit' class='button'></td>
     		
		</tr>	
		</table>";

     

      print "</form>";

   }
 
   ?>	
       
	
	
		</div>
		</div>
		
 <?php include('includes/footer.php');?>