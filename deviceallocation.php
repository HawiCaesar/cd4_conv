<?php
session_start();
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
$deviceautoID=$_GET['ID'];
$deviceNumber=$_GET['deviceNumber'];
$partnerid=$_SESSION['userID'];
$successallocation=$_GET['successallocation'];

if ($_REQUEST['save'])
{

$deviceid= $_POST['deviceid'];
$deviceNumber= $_POST['deviceNumber'];

$fcode= $_POST['fcode'];
$fname= $_POST['fname'];
$checkbox= $_POST['checkbox'];
$count=0;
 foreach($_POST['checkbox'] as $j)
 {
if ($fcode[$j]  =="") 
{
$errormsg="Error Saving, Please Select Facility(s)";
}
else
{
 //echo "Fcode ". $fcode[$j] . '<br/>';

			//save allocation details
		$sql= mysql_query("insert into  deviceallocation(deviceid,facility,partner) values('$deviceid','$fcode[$j]','$partnerid')  ") or die(mysql_error());
		if ($sql) //check if all records entered
		{
		$count=$count+1;
		}
}
		
}
		
			if ($sql) //check if all records entered
		{
				$st= $count ." Facility(s) Successfully Assigned to Device Number : ".$deviceNumber;
				echo '<script type="text/javascript">' ;
				echo "window.location.href='deviceslist.php?successallocation=$st'";
				echo '</script>';
				
			

		}
		else
		{
				$st="Assigning Facilities has failed, please try again.";
		
		}
		

}
elseif ($_REQUEST['saveadd'])
{

$deviceid= $_POST['deviceid'];
$deviceNumber= $_POST['deviceNumber'];

$fcode= $_POST['fcode'];
$fname= $_POST['fname'];
$checkbox= $_POST['checkbox'];
$count=0;
 foreach($_POST['checkbox'] as $j)
 {
if ($fcode[$j]  =="") 
{
$errormsg="Error Saving, Please Select Facility(s)";
}
else
{

		//save allocation details
		$sql= mysql_query("insert into  deviceallocation(deviceid,facility,partner) values('$deviceid','$fcode[$j]','$partnerid')  ") or die(mysql_error());
		if ($sql) //check if all records entered
		{
		$count=$count+1;
		}
}
		
}
		
			if ($sql) //check if all records entered
		{
				$st= $count ." Facility(s) Successfully Assigned to Device Number : ".$deviceNumber;
				echo '<script type="text/javascript">' ;
				echo "window.location.href='deviceallocation.php?successallocation=$st&ID=$deviceid&deviceNumber=$deviceNumber'";
				echo '</script>';
				
			

		}
		else
		{
				$st="Assigning Facilities has failed, please try again.";
		
		}
		

}
?>
<script>
		window.dhx_globalImgPath="img/";
	</script>
<script src="dhtmlxcombo_extra.js"></script>
 <link rel="STYLESHEET" type="text/css" href="dhtmlxcombo.css">
  <script src="dhtmlxcommon.js"></script>
  <script src="dhtmlxcombo.js"></script>
<script>
function select(a) {
    var theForm = document.myForm;
    for (i=0; i<theForm.elements.length; i++) {
        if (theForm.elements[i].name=='checkbox[]')
            theForm.elements[i].checked = a;
    }
}
</script>
<style type="text/css">
select {
width: 250;}
</style>

	<script type="text/javascript" src="includes/validatedevices.js"></script>
<link rel="stylesheet" href="includes/validation.css" type="text/css" media="screen" />
  
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Allocate Facilities to PIMA Device Number <?php echo $deviceNumber; ?> </center></div><?php if ($successallocation !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successallocation.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
<?php if ($errormsg !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="error"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$errormsg.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
<?php if ($successsave !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successsave.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
               
				     <small>  <font color="#FF0000"> ** Allocation can be done for <b> 10 </b> Facilities at a time <br> , click </small>'<b><u>Save & Allocate More Facilities To this Device</u></b> ' <small> to continue allocating Facilites for same Device and <br> </small>'<b><u> Save & Complete  Allocation for this Device</u></b>' <small> when done allocating facilities to same Device and wish to allocate facilities to another Device ** </font> </small>
		  <form name="myForm" method="post" action="">
		 		  <table border="0" class="data-table" width="1070">
          	
            <tr class=even>
              <th colspan="2">Device Number </th>
              <th colspan="4"><input name="deviceid" type="hidden" id="deviceid" value="<?php echo $deviceautoID;?>" > 
<input name="deviceNumber" type="hidden" id="deviceNumber" value="<?php echo $deviceNumber;?>" ><b> <?php echo $deviceNumber; ?></b></th>
            </tr>
			
			
          			<tr >
            <td height="24"  colspan="10"><a href="javascript:select(1)">Check all</a> |
<a href="javascript:select(0)">Uncheck all</a></td>
		  </tr>
			
             <?php 
 //ORDER BY name ASC

  $qury = "SELECT facilityID
            FROM facilitys where partner='$partnerid' limit 0,10
			";			
			$result = mysql_query($qury) or die('Error, query failed');
			$no=mysql_num_rows($result);
if ($no !=0)
{
// print the districts info in table

 	 $k = 0;
	 $i = 0;
	$samplesPerRow = 2; 
	while(list($ID) = mysql_fetch_array($result))
	{  

	if ($k % $samplesPerRow == 0) {
            echo '<tr class=even>';
        }
	
	    ?> 

<td align="center" ><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $i++;?>" /></td>
<td align="center"><?php
	   $facilityquery = "SELECT  facilitys.facilityID,facilitys.facilitycode,facilitys.facilityName  FROM facilitys
WHERE  facilitys.partner='$partnerid' and  NOT EXISTS
        (
        SELECT deviceallocation.facility
        FROM   deviceallocation
        WHERE   deviceallocation.facility = facilitys.facilityID
        )
";
	   $facilityresult = mysql_query($facilityquery) or die('Error, query failed'); //onchange='submitForm();'
?>

<select style='width:350px;'  id="fcode[]" name="fcode[]">
 <option value=''></option>
			  <?php
			   while ($row = mysql_fetch_array($facilityresult))
     	 {		 $ID = $row['facilityID'];
		 $facilitycode = $row['facilitycode'];
			$name = $row['facilityName'];
			  ?>
              <option value="<?php echo  $ID; ?>"><?php echo $name   .' - '.$facilitycode; ?></option>
			<?php
			}?>
            </select><span id="codeInfo"></span>
			</div>
			<script>
var z = dhtmlXComboFromSelect("fcode[]");
z.enableFilteringMode(true);
</script></td>
	 
    
	  
<?php
	
	  if ($k % $samplesPerRow == $samplesPerRow - 1) {
            echo '</tr>';
        }
        
        $k += 1;
	}
	
	}
	?>
            <tr >
              <td></td>
              <td colspan="11" >
			  <div align="center">
			
		  	    <input name="save" type="submit" class="button" value="Save & Complete  Allocation for this Device  " /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="saveadd" type="submit" class="button" value="Save & Allocate More Facilities To this Device" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	  	    <input name="reset" type="reset" class="button" value="Reset" /> </div></td>
            </tr>
          </table>
		  </form>
                   
                
				  </div>
				
				</div>


				
				
				
			</div>

			<?php  		include("includes/sidebar.php"); ?>

			<div class="clearer">&nbsp;</div>

		</div>

		<div id="dashboard">

			<div class="column left" id="column-1">
				
				<div class="column-content">
				
			

				</div>

			</div>

			<div class="column left" id="column-2">

				<div class="column-content">
				
					

					
				</div>

			</div>

			<div class="column left" id="column-3">

				<div class="column-content">
				
					
				
				</div>

			</div>

		

			<div class="clearer">&nbsp;</div>

		</div>

	<?php
		include("includes/footer.php");
		?>	