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
<script language="javascript" type="text/javascript">
<!--
var href=window.location.href;
$(document).ready(function(){
	

$('#county').change(function(){
	var val=$('#county').val();
		window.location.href="testingtrends.php?id="+val;
	
	
	
});		
<?php if(isset($_GET['id']) && isset($_GET['period']) ){ ?>
	$('#period').change(function(){
	var val=$('#period').val();
	var county=<?php echo $_GET['id']; ?>;
		window.location.href="testingtrends.php?id="+county+"&period="+val;
	
	
	
});	
<?php
}else if(isset($_GET['id']) && !isset($_GET['period']) ){ ?>
$('#period').change(function(){
	var val=$('#period').val();
		window.location.href=href+"&"+"period="+val;
	
	
	
});	
<?php
}   else if(!isset($_GET['id'])){ ?>
$('#period').change(function(){
	var val=$('#period').val();
		window.location.href="testingtrends.php?period="+val;
	
	
	
});	
<?php
}  ?>
});
function popitup(url) {
newwindow=window.open(url,'name','left=400,top=200,width=800,height=150,toolbar=0,resizable=0,scrollbars=no');

if (window.focus) {newwindow.focus()}
return false;
}

// -->
</script>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
                <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
                <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
               <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                $(document).ready(function() {
					$('.table2').dataTable({
						"bJQueryUI":true,
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
 	
<table width="90%"  class="table2" cellpadding="4" cellspacing="10">
	<thead> <tr>
		<th rowspan="2" nowrap="nowrap"><center>County</center></th>
		<th rowspan="2" nowrap="nowrap"><center>CD4 Device</center></th>
		<th colspan="2" nowrap="nowrap"><center> # CD4 Tests</center></th>
				<th colspan="3" nowrap="nowrap"><center>Adult Tests</center></th>
		<th colspan="3" nowrap="nowrap"><center>Paediatric Tests</center></th>
		<th rowspan="2" nowrap="nowrap"><center>Task</center></th>
    </tr>
    <tr>
    	<th nowrap="nowrap">Cumulative</th>
    	<th nowrap="nowrap"><center> <?php echo $title; ?></center></th>
    	<th nowrap="nowrap">Cumulative</th>
    	<th nowrap="nowrap"><?php echo date('M, Y',strtotime(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate))); ?></th>
    	<th nowrap="nowrap"><?php echo "# CD4 < 350"; ?></th>
    	<th nowrap="nowrap">Cumulative</th>
    	<th nowrap="nowrap"><?php echo date('M, Y',strtotime(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate))); ?></th>
    	<th nowrap="nowrap"><?php echo "# CD4 < 25%"; ?></th>
   </tr>
</thead>
 <tbody>
 	<?php
 	testingtrendtable($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
 	?>
 </tbody>
 
 
 
</table>
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

