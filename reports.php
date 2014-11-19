<?php
ob_start();
session_start();
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
$patna=$_SESSION['userID'];
if(isset($_POST['generate'])){
	if($_POST['criteria']==1){
	$fac=0;	
	$dev=$_POST['device'];
	$duration=$_POST['duration'];
	
	if($duration==4){
	$year=$_POST['yearannually'];
	$month=0;
	$quarter=0;
	$biAnn=0;
	$from=0;
	$to=0;
		
		}
	else if ($duration==1){
	
	$month=$_POST['monthly'];
	$year=$_POST['yearmonthly'];
	$quarter=0;
	$biAnn=0;
	$from=0;
	$to=0;
		
		}
	else if ($duration==2){
	
	$month=0;
	$quarter=$_POST['quartely'];
	$year=$_POST['yearquarterly'];
	$biAnn=0;
	$from=0;
	$to=0;
		
		}
	else if ($duration==3){
	$month=0;
	$quarter=0;
	$from=0;
	$to=0;
	$biAnn=$_POST['biannual'];
	$year=$_POST['yearbiannual'];
		
		}
	
	if($_POST['format']=="pdf"){
	
	header("Location:pdf/mpdf.php?yrAnn=$year & month=$month & quarter=$quarter & biAnn=$biAnn & dev=$dev & fac=$fac & id=$patna & category=$duration & from=$from, to=$to");
	
	}
	else if($_POST['format']=="excel"){
	
	header("Location:excelRpt.php?yrAnn=$year & month=$month & quarter=$quarter & biAnn=$biAnn & fac=$fac  & dev=$dev & id=$patna & category=$duration");
	
	}
 }


else if($_POST['criteria']==2){
	$fac=$_POST['location'];
	$dev=0;
	$duration=$_POST['duration'];
	
	if($duration==4){
	$year=$_POST['yearannually'];
	$month=0;
	$quarter=0;
	$biAnn=0;
	$from=0;
	$to=0;
		
		}
	else if ($duration==1){
	
	$month=$_POST['monthly'];
	$year=$_POST['yearmonthly'];
	$quarter=0;
	$biAnn=0;
	$from=0;
	$to=0;
		
		}
	else if ($duration==2){
	
	$month=0;
	$quarter=$_POST['quartely'];
	$year=$_POST['yearquarterly'];
	$biAnn=0;
	$from=0;
	$to=0;
		
		}
	else if ($duration==3){
	$month=0;
	$quarter=0;
	$from=0;
	$to=0;
	$biAnn=$_POST['biannual'];
	$year=$_POST['yearbiannual'];
		
		}
	
	if($_POST['format']=="pdf"){
	
	header("Location:pdf/mpdf.php?yrAnn=$year & month=$month & quarter=$quarter & biAnn=$biAnn & dev=$dev & fac=$fac & id=$patna & category=$duration & from=$from, to=$to");
	
	}
	else if($_POST['format']=="excel"){
	
	header("Location:excelRpt.php?yrAnn=$year & month=$month & quarter=$quarter & biAnn=$biAnn & dev=$dev  & fac=$fac & id=$patna & category=$duration");
	
	}
 }
}
	
	
if(isset($_POST['genEmail']) && $_POST['format']="excel"){

header("Location:Classes/excel.php");

	}
	
?>
<script type="text/javascript">
$(document).ready(function(){
  $(".eve").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==1){
			$('.eve').show();
		}else{
		 $(".eve").hide();	
		}
	
		//alert("me");
	});

  $(".eveDay").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==5){
			$('.eveDay').show();
		}else{
		 $(".eveDay").hide();	
		}
	
		//alert("me");
	});
});
$(document).ready(function(){
  $(".eve1").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==2){
			$('.eve1').show();
		}else{
		 $(".eve1").hide();	
		}
	
		//alert("me");
	});
});
$(document).ready(function(){
  $(".eve2").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==3){
			$('.eve2').show();
		}else{
		 $(".eve2").hide();	
		}
	
		//alert("me");
	});
});
$(document).ready(function(){
  $(".eve3").hide();
	$('#duration').change(function(){
		var k=$('#duration').val();
		if(k==4){
			$('.eve3').show();
		}else{
		 $(".eve3").hide();	
		}
	
		//alert("me");
	});
});
$(document).ready(function(){
  $(".eve5").hide();
	$('#criteria').change(function(){
		var k=$('#criteria').val();
		if(k==1){
			$('.eve5').show();
		}else{
		 $(".eve5").hide();	
		}
	
		//alert("me");
	});
});

$(document).ready(function(){
  $(".eve6").hide();
	$('#criteria').change(function(){
		var k=$('#criteria').val();
		if(k==2){
			$('.eve6').show();
		}else{
		 $(".eve6").hide();	
		}
	
		//alert("me");
	});
});

    </script>
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
			  $(this).html('Device to Report').addClass('messageboxok').fadeTo(900,1);	
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
                 <div class="section-title"><center>Generate Report</center></div>
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
               
				    <form id="customForm" method="post" action="reports.php" autocomplete="Off">
                    <table style="width:700px"  border="0"  cellpadding="0" cellspacing="0" class="data-table"  >
                    <tr>
                    <td style="font-family:Georgia, 'Times New Roman', Times, serif  ;background-color: #F2F2F2"><b><span class="mandatory">*</span>Criteria: </b></td> <td><select name="criteria" id="criteria">
                    <option selected="selected" value="0">Select criteria to use</option>
                    <option value="1">By Device</option>
                    <option value="2">By Facility</option>
                    </select><span id='criteriaInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
                    
                    </tr>                   
                       	<tr class="eve5">
                          <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2">Device Number</td>
                         <td   >
                          <div><?php
		   		 $groupquery = "SELECT deviceID	, deviceNumber FROM device where partnerID='".$_SESSION['userID']."' ORDER BY deviceNumber ASC";
				$result = mysql_query($groupquery) or die('Error, query failed'); 
			   echo "<select name='device' id='location' style='width:178px';>\n";
			  echo " <option value='' selected='selected'> Select Device </option>";
				  //Now fill the table with data
				  while ($row = mysql_fetch_array($result))
				  {
						 $ID = $row['deviceID'];
						$name = $row['deviceNumber'];
					echo "<option value='$name'> $name</option>\n";
				  }
				  echo "</select>\n";
		  	?><span id='locationInfo'></span></div>
                         </td>
                        </tr>
                         <tr class="eve6" >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" >Facility</td>
   							<td  style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><div><?php  
		   		 $groupquery = "SELECT facilityID,facilityName FROM facilitys where partner='".$_SESSION['userID']."' ORDER BY facilityName ASC";
				$result = mysql_query($groupquery) or die('Error, query failed'); 
			   echo "<select name='location' id='location' style='width:178px';>\n";
			  echo " <option value='' selected='selected'> Select Facility </option>";
				  //Now fill the table with data
				  getFacList($patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
				  echo "</select>\n";
		  	?><span id='locationInfo'></span></div></td>
  						 </tr>
                
                 <tr>
                    <td style="font-family:Georgia, 'Times New Roman', Times, serif  ;background-color: #F2F2F2" ><b><span class="mandatory">*</span>Duration: </b></td>
                    <td><select name="duration" id="duration">
                    <option selected="selected" value="0">Select Duration Criteria</option>
                    <option value="1">Monthly</option>
                    <option value="2">Quartely</option>
                    <option value="3">Bi-Annually</option>
                    <option value="4">Yearly</option>
                     <option value="5">Customize Dates</option>
                    </select><span id='durationInfo'></span><span id="msgbox" style="display:none" ></span></div></td>
                    </tr>        
					    <tr  class="eveDay" >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2">Customize Dates</td>
   							<td  >
                            
<table style="width:340px" >
<tr>
		<td> <?php
		
		  $myC = new tc_calendar("fromf", true, false);
		  $myC->setIcon("img/Calendar.gif");
		  //$myC->setDate(date('d'), date('m'), date('Y'));
		  $myC->setPath("./");
		  $myC->setYearInterval($lowestdate,$currentdate);
		  $myC->dateAllow('2008-05-13', '2015-03-01');
		  $myC->setDateFormat('j F Y');
		  $myC->writeScript();
		  
		  ?></td> <td> - </td> 
		<td> <?php 
		  $myC = new tc_calendar("tof", true, false);
		  $myC->setIcon("img/Calendar.gif");
		  //$myC->setDate(date('d'), date('m'), date('Y'));
		  $myC->setPath("./");
		  $myC->setYearInterval(1998, 2015);
		 // $myC->dateAllow('2008-05-13', '2015-03-01');
		  $myC->setDateFormat('j F Y');
		  $myC->writeScript();
		  
		  ?></td>
			</tr></table>

</td></tr>
                      <tr  class="eve" >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2">Monthly</td>
   							<td  ><div>
                            <select name="monthly">
                              <option selected="selected">Month</option>
                              <option value="1">Jan</option>
                              <option value="2">Feb</option>
                              <option value="3">Mar</option>
                              <option value="4">Apr</option>
                              <option value="5">May</option>
                              <option value="6">Jun</option>
                              <option value="7">Jul</option>
                              <option value="8">Aug</option>
                              <option value="9">Sep</option>
                              <option value="10">Oct</option>
                              <option value="11">Nov</option>
                              <option value="12">Dec</option>                            
                            </select>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="yearmonthly">
                              <option selected="selected">Year</option>
                              <?php
							  $yr=getyearsreported($_SESSION['userID']);
							  while($rs=mysql_fetch_array($yr)){
								 ?>
                                 <option value="<?php echo $rs['yr']; ?>"><?php echo $rs['yr']; ?></option>
								 
								 <?php
								 
								 
								  }
							  ?>
                            
                            
                            </select>
                            
                            </div></td>
  						 </tr>
                         
                         <tr class="eve1" >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2">Quarterly</td>
   							<td  ><div>
                            <select name="quartely">
                              <option selected="selected">Quarter</option>
                              <option value="1">Jan-Apr</option>
                              <option value="2">May-Aug</option>
                              <option value="3">Sep-Dec</option>                           
                            </select>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="yearquarterly">
                              <option selected="selected">Year</option>
                              <?php
							  $yr=getyearsreported($_SESSION['userID']);
							  while($rs=mysql_fetch_array($yr)){
								 ?>
                                 <option value="<?php echo $rs['yr']; ?>"><?php echo $rs['yr']; ?></option>
								 
								 <?php
								 
								 
								  }
							  ?>
                            
                            
                            </select>
                            
                            </div></td>
  						 </tr>
                         
                          <tr class="eve2" >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2">Bi-Annually</td>
   							<td  ><div>
                            <select name="biannual">
                              <option selected="selected">Bi-Annual</option>
                              <option value="1">Jan-Jun</option>
                              <option value="2">Jul-Dec</option>                            
                            </select>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="yearbiannual">
                              <option selected="selected">Year</option>
                              <?php
							  $yr=getyearsreported($_SESSION['userID']);
							  while($rs=mysql_fetch_array($yr)){
								 ?>
                                 <option value="<?php echo $rs['yr']; ?>"><?php echo $rs['yr']; ?></option>
								 
								 <?php
								 
								 
								  }
							  ?>
                            
                            
                            </select>
                            
                            </div></td>
  						 </tr>
                         
                          <tr class="eve3"  >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2">Annually</td>
   							<td  ><div>
                            <select name="yearannually">
                              <option selected="selected">Year</option>
                              <?php
							  $yr=getyearsreported($_SESSION['userID']);
							  while($rs=mysql_fetch_array($yr)){
								 ?>
                                 <option value="<?php echo $rs['yr']; ?>"><?php echo $rs['yr']; ?></option>
								 
								 <?php
								 
								 
								  }
							  ?>
                            
                            
                            </select>
                            
                            </div></td>
  						 </tr>
                         
                         
                          <tr>
                    <td style="font-family:Georgia, 'Times New Roman', Times, serif  ;background-color: #F2F2F2" colspan="2" >
                    <b><span class="mandatory">*</span>Format: </b></td>
                    
                    </tr>
                    <tr>
                    <td> <input type="radio" name="format" value="pdf">Summary in <img src="img/pdf.jpg" width="30" height="20" /></td>
                    <td><input type="radio" name="format" value="excel">Detailed in <img src="img/excel.jpg" width="30" height="20" /></td>
                    </tr>
  						
  						 <tr>
    							 <th colspan="2">  
								 <div align="center">
				 <input name="generate" id="generate" type="submit" class="button" value="Generate Report" />
		  	    <input name="genEmail" id="genEmail" type="submit" class="button" value="Generate and Email" />
		  	    <input name="reset" type="reset" class="button" value="Reset" /></div>
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
	ob_flush();
		include("includes/footer.php");
		?>	
		