<?php
session_start();
$dw2=strtotime("-2 week");
if(isset($_GET['tof'])){
	$date2=$_GET['tof'];
}
else{
	$date2=date('Y-m-d');
}

if(isset($_GET['fromf'])){
	$date1=$_GET['fromf'];
}
else{
$date1=date('Y-m-d', $dw2);
}
if(!isset($session['username'])){
	//@header("location:login.php");
	
	}
require_once("includes/commodityheader.php");
require_once("includes/dbConf.php");
include("FusionCharts/FusionCharts.php");

$db = new dbConf();

?>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
                <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
                <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
               <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                $(document).ready(function() {
					$('.table2').dataTable({
						"sScrollY": "100%",
						"sScrollX": "100%"
						});
				});
                </script>
	 
<div class="main" id="main-two-columns">
<p>&nbsp;</p>
<form id="customForm"  method="GET" action="" >
<table>
<tr> 

<th colspan="2">Period: &nbsp;<U><B><font color="#0000CC"><?php echo $title; ?></font></B></U>   |<small>  
<?php

   if ($filter==1)//LAST 3 MONTHS
	{?>
	<a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a> |
    <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a> 
<?php
}
elseif ($filter==7)//LAST 6 MONTHS
{
?>
	<a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload</a>  |
   <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
<?php
}
elseif (($filter==2) || ($_REQUEST['submitfrom']))//customeized
{
?>
	<a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Uploadn </a>  |
    <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a> |
 <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
<?php
}
elseif (($filter==4) || ($filter==3)) //month/year filter
{
 ?><a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a> | <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a>  |
 <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
 <?php
	}
	elseif (($filter==0) ||($filter=='')) //Lst submitted
	{
?>
	  <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 3 months Statistics">   Last 6 Months </a>  | <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
	<?php
	}
?>|    <a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" title=" Click to Filter View based on Date Range you Specify"> Customize Dates</a>   | Month/Year Filters > </small></th>	<td width='70'><li> &nbsp;</li></td>
<td>	
				<li><?php

				$year = GetMaxYear($patna);
				$twoless = GetMinYear($patna);
				for ($year; $year >= $twoless; $year--) {

					echo "<a href=$D?year=$year&filter=4 title='Click to Filter View to $year'>   $year  | </a>";
				}
						?>&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 <?php //echo "<a href =$D?year=2010&mwezi=13>Jan-Sep 2010 </a>"; ?>
				
				</li></td>
					
				<td ><li><?php $year = $_GET['year'];
						if ($year == "") {
							$year = date('Y');
						}
						echo "<a href =$D?year=$year&mwezi=1&filter=3 title='Click to Filter View to Jan, $year'>Jan</a>";
					?> | <?php echo "<a href =$D?year=$year&mwezi=2&filter=3 title='Click to Filter View to Feb, $year'>Feb </a>"; ?>| <?php echo "<a href =$D?year=$year&mwezi=3&filter=3 title='Click to Filter View to Mar, $year'>Mar</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=4&filter=3 title='Click to Filter View to Apr, $year'>Apr</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=5&filter=3 title='Click to Filter View to May, $year'>May</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=6&filter=3 title='Click to Filter View to Jun, $year'>Jun</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=7&filter=3 title='Click to Filter View to Jul, $year'>Jul</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=8&filter=3 title='Click to Filter View to Aug, $year'>Aug</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=9&filter=3 title='Click to Filter View to Sept, $year'>Sept</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=10&filter=3 title='Click to Filter View to Oct, $year'>Oct</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=11&filter=3 title='Click to Filter View to Nov, $year'>Nov</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=12&filter=3 title='Click to Filter View to Dec, $year'>Dec</a>"; ?>  </li></td>

</tr>
<tr>
<th><div class="mid" id="HiddenDiv" style="DISPLAY: none" >
<table style="width:340px" >
<tr>
		<td> <?php
		$myCalendar = new tc_calendar("fromfilter", true, false);
		$myCalendar -> setIcon("img/Calendar.gif");
		$myCalendar -> setDate(date('d'), date('m'), date('Y'));
		$myCalendar -> setPath("./");
		$myCalendar -> setYearInterval($lowestdate, $currentdate);
		$myCalendar -> setDateFormat('j F Y');
		$myCalendar -> writeScript();
		  ?></td> <td> - </td> 
		<td> <?php
		$myCalendar = new tc_calendar("tofilter", true, false);
		$myCalendar -> setIcon("img/Calendar.gif");
		$myCalendar -> setDate(date('d'), date('m'), date('Y'));
		$myCalendar -> setPath("./");
		$myCalendar -> setYearInterval($lowestdate, $currentdate);

		$myCalendar -> setDateFormat('j F Y');
		$myCalendar -> writeScript();
		  ?></td>
		  <td>
		    <input type="submit" name="submitfrom" value="Filter" class="button"/></td>
			</tr></table>
</div></th>
</tr></table>
</form>
</div>

<div class="mydiv" style="margin:auto; width: 90%;">
<div class="section-title" style="width: 90%;"><center>National CD4 Testing Per County</center></div>
	
<div class="left" id="main-left">

 <div class="post">



 <div class="post-date"></div>

<div class="post-body">
	
 </div>
 </div>
 <div class="post">
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
<div class="content-separator"></div>
</div>
            <?php  	
//include("includes/sideprogram.php"); ?>

</div>


</div>


<div class="column left" id="column-3">


</div>


<div class="clearer">&nbsp;</div>

</div>

<?php
include("includes/footer.php");
  ob_end_flush();
?>	

