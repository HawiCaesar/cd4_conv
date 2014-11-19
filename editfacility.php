<?php
session_start();
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
$successsave=$_GET['successsave'];

$facility= $_GET["facilityID"];
if (isset($deviceAutoID))
{
$getdevice=getDeviceDetails($deviceAutoID);
extract($getdevice);	
$dnumber=$deviceNumber;
$dautoid=$deviceID;
$dlocation=$location;
$dlocationdesc=getdevicelocation($dlocation);
}

//occurs on submission of the form
if ($_REQUEST['saveonly'])
{
$today=date('Y-m-d');
$deviceNum=mysql_real_escape_string(STRTOUPPER($_GET['code']));
$deviceautoNum=$_GET['deviceautoNum'];
$location=$_GET['location'];
$partnerid=$_SESSION['userID'];
//echo $deviceNum . "- ".$location . " - ".$partnerid;
$saved=mysql_query("update facilitys set facilityName='$deviceNum' , location='$location' ,telephone='$today' WHERE deviceID='$deviceautoNum'") or die(mysql_error());

if ($saved)
{				$msg="Device Number  ".$deviceNum." Successfully Edited ";
				echo '<script type="text/javascript">' ;
				echo "window.location.href='deviceslist.php?successsave=$msg'";
				echo '</script>';
}
elseif (($deviceNum =="") || ($location ==""))
{
$errormsg="Error Saving, Please enter Device Number and Location";
}
else
{
				$errormsg="Error Saving Device Number  ".$deviceNum.", Try Again ";
}

	
}


?>
<script language="javascript">
//<!---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
	$("#deviceNum").blur(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
		//check the username exists or not from ajax
		$.post("checkifdevice_exists.php",{ devicenum:$(this).val() } ,function(data)
        {
		  if(data !='') //if username not avaiable
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html(data).addClass('messageboxerror').fadeTo(900,1);
			});		
          }
		  else
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('This is a new Device  ').addClass('messageboxok').fadeTo(900,1);	
			});
		  }
				
        });
 
	});
});
</script>
<style type="text/css">
body {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;

}
.top {
margin-bottom: 15px;
}
.messagebox{
	position:absolute;
	width:100px;
	margin-left:30px;
	text-align:left;
	border:1px solid #c93;
	background:#ffc;
	padding:3px;
}
.messageboxok{
	position:absolute;
	width:auto;
	text-align:left;
	margin-left:30px;
	border:1px solid #349534;
	background:#C9FFCA;
	padding:3px;
	font-weight:bold;
	color:#008000;
	
}
.messageboxerror{
	position:absolute;
	width:auto;
	margin-left:30px;
	text-align:left;
	border:1px solid #FFD324;
	background:#FFF6BF;
	padding:3px;
	font-weight:bold;
	color:#514721;
	
}

</style>
	<script type="text/javascript" src="includes/validatedevices.js"></script>
<link rel="stylesheet" href="includes/validation.css" type="text/css" media="screen" />
  
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Edit PIMA Device Number <?php echo $deviceNumber; ?></center></div>
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
               
				    <form id="customForm" method="get" action="" autocomplete="Off">
                    <?php
					 $sql="Select * from facilitys where facilityID='$facility' AND facilitycode='".$_GET['code']."'";
					$q=mysql_query($sql);
					$rs=mysql_fetch_row($q);
					//print_r($rs);
					?>
                    <table style="width:700px"  border="0"  cellpadding="0" cellspacing="0" class="data-table"  >
                                             
                       	<tr >
                          <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>Facility Name</td>
                         <td   >
                          <div>   <input type="hidden" size="30"  name="deviceautoNum" id="deviceautoNum" class="text" value="<?php echo $rs[3];?>"/>
                            <input type="text" size="30"  name="deviceNum" id="deviceNum" class="text" value="<?php echo $rs['3']; ?>"/><span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span></div>
                         </td>
                        </tr>
                         <tr >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Contact Person</td>
   							<td  ><div><input type="text" size="30"  name="tel" id="tel" class="text" value="<?php echo $rs['11']; ?>"/><span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
  						 </tr>
                       
					  <tr >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Facility Type</td>
   							<td  ><div><input type="text" size="30"  name="ftype" id="ftypr" class="text" value="<?php echo $rs['5']; ?>"/><span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
  						 </tr>
                          
                          <tr >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Telephone</td>
   							<td  ><div><input type="text" size="30"  name="tel" id="tel" class="text" value="<?php echo $rs['7']; ?>"/><span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
  						 </tr>
  						<tr >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Branch Name</td>
   							<td  ><div><input type="text" size="30"  name="branch" id="branch" class="text" value="<?php echo $rs['28']; ?>"/><span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
  						 </tr>
                         <tr >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Location</td>
   							<td  ><div><input type="text" size="30"  name="location" id="location" class="text" value="<?php echo $rs['29']; ?>"/><span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
  						 </tr>
  						 <tr>
    							 <th colspan="2">  
								 <div align="center">
				 <input name="saveonly" id="saveonly" type="submit" class="button" value="Update Facility Details" />
		  	   <input name="btnCancel" type="button" id="btnCancel" value="Cancel Edit" onClick=window.location.href="facilityList.php" class="button"></div>
				</th>
    							
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