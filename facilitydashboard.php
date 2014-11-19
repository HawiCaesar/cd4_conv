<?php
error_reporting(0);
session_start();
$mine=$_SESSION['calibur'];
if(isset($_GET['id'])){
$mymfl=$_GET['id'];	
}
else {
	$mymfl=$_SESSION['facility'];
}

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

<div class="left" id="main-left">

 <div class="post">
 	
<table width="100%" class="" cellpadding="4" cellspacing="10">
<tr>
	<td valign="top" class="xtop" style="vertical-align:top; ">
				
	<div class="section-title" ><center>Test Trends for Year <?php echo $currentyear; ?></center></div>
			      
  <div id="chartdivtrendd" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "450", "250", "0", "0");
    myChart.setDataURL("xml/commoditytrend.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=1&mfl=<?php echo $mymfl;?>");
	myChart.render("chartdivtrendd");
	
   </script>		
   
  </td>
  
  
  <td valign="top" class="xtop" style="vertical-align:top; ">
	<div class="section-title" ><center>% Testing</center></div>			
  <div id="chartdiv2900" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

      var myChart2900 = new FusionCharts("FusionCharts/Charts/Doughnut2D.swf", "ChartId", "300", "250", "0", "0");
    myChart2900.setDataURL("xml/adultpaediatrictrendpie.php");      
      myChart2900.render("chartdiv2900");
   </script>	
   
  </td>

<td valign="top" class="xtop" style="vertical-align:top; ">
<div class="section-title" ><center>Statistics For <?php echo date('M, Y',strtotime(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate))); ?></center></div>
					<table class="data-table" width="90%">
				<thead>
					<tr class="even">
						<th>&nbsp;</th>
						<th>Tests</th>
						<th>Adults</th>
						<th nowrap="nowrap">CD4 < 350cells/mm3</th>
						<th>Paediatrics</th>
						<th nowrap="nowrap">CD4 < 25%</th>
						
					</tr>
				</thead>
					<tr>
					<td style="background-color:#CCCCCC " nowrap="nowrap"><b>Total Tests</b> </td>
					<td><center><?php echo $tottesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),2,"AND SITE='$mymfl'") ;?></center></td>
					<td><center><?php echo $adultesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),1,"AND SITE='$mymfl'" ) ;?></center></td>
					<td><center><?php echo $adultfail=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),1," AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mymfl'" ) ;?></center></td>
					<td><center><?php echo $childtesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0,"AND SITE='$mymfl'"  ) ;?></center></td>
					<td><center><?php echo $failchild=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0," AND CD3CD4CD45TruCCD3CD4Lymph	<25 AND SITE='$mymfl'"  ) ;?></center></td>
				</tr>	
				<tr>
					<td style="background-color:#CCCCCC " nowrap="nowrap"><b>Percentages</b> </td>
					<td><center><?php echo " "; ?></center></td>
					<td><center><?php echo round((($adultesta/$tottesta)*100),1)."%"; ?></center></td>
					<td><center><?php echo round((($adultfail/$adultesta)*100),1)."%"; ?></center></td>
					<td><center><?php echo round((($paedtest/$tottesta)*100),1)."%"; ?></center></td>
					<td><center><?php echo round((($failchild/$childtesta)*100),1)."%"; ?></center></td>
				</tr>	
				
			</table>
  	
  </td>
  
   </tr>
 <tr>
   <td valign="top" class="xtop" style="vertical-align:top; ">
   
   <div class="section-title" ><center>Tests < 350 in Year <?php echo $currentyear; ?> </center></div>
			 <div id="chartdivtrendd22" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId",  "450", "250", "0", "0");
    myChart.setDataURL("xml/failedcommoditytrend.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=1&mfl=<?php echo $mymfl;?>");
	myChart.render("chartdivtrendd22");
	
   </script>
		
	</td>
	
	<td valign="top" class="xtop" style="vertical-align:top; ">
		<div class="section-title" ><center>Paediatric Tests in Year <?php echo $currentyear; ?> </center></div>
	<div id="chartdiv29000" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

       var myChart29002 = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "ChartId", "300", "150", "0", "0");
    myChart29002.setDataURL("xml/individualtrendpie.php?graph=0 & mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=1&mfl=<?php echo $mymfl;?>");   
      myChart29002.render("chartdiv29000");
   </script>
				
			<div class="section-title" ><center>Adult Tests in Year <?php echo $currentyear; ?> </center></div>
		  <div id="chartdiv29001" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

       var myChart29002 = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "ChartId", "300", "150", "0", "0");
    myChart29002.setDataURL("xml/individualtrendpie.php?graph=1 &mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=1&mfl=<?php echo $mymfl;?>");   
      myChart29002.render("chartdiv29001");
   </script>
			
	</td>
	
	
	
	<td valign="top" class="xtop" style="vertical-align:top; ">
		
			<div class="section-title" ><center>Statistics For <?php echo $title; ?></center></div>
		<table class="data-table" width="90%">
				<thead>
					<tr class="even">
						<th>&nbsp;</th>
						<th>Tests</th>
						<th>Adults</th>
						<th nowrap="nowrap">CD4 < 350cells/mm3</th>
						<th>Paediatrics</th>
						<th nowrap="nowrap">CD4 < 25%</th>
						
					</tr>
				</thead>
				<tr>
					<td style="background-color:#CCCCCC " nowrap="nowrap"><b>Total Tests</b> </td>
					<td><center><?php echo $tottesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),2,"AND SITE='$mymfl'") ;?></center></td>
					<td><center><?php echo $adultesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),1,"AND SITE='$mymfl'" ) ;?></center></td>
					<td><center><?php echo $adultfail=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),1," AND CD3CD4CD45TruCCD3CD4AbsCnt<350 AND SITE='$mymfl'" ) ;?></center></td>
					<td><center><?php echo $childtesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0,"AND SITE='$mymfl'"  ) ;?></center></td>
					<td><center><?php echo $failchild=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0," AND CD3CD4CD45TruCCD3CD4Lymph<25 AND SITE='$mymfl'"  ) ;?></center></td>
				</tr>	
				<tr>
					<td style="background-color:#CCCCCC " nowrap="nowrap"><b>Percentages</b> </td>
					<td><center><?php echo " "; ?></center></td>
					<td><center><?php echo round((($adultesta/$tottesta)*100),1)."%"; ?></center></td>
					<td><center><?php echo round((($adultfail/$adultesta)*100),1)."%"; ?></center></td>
					<td><center><?php echo round((($paedtest/$tottesta)*100),1)."%"; ?></center></td>
					<td><center><?php echo round((($failchild/$childtesta)*100),1)."%"; ?></center></td>
				</tr>	
				
			</table>
		
	</td>
	
	
</tr>
 
</table>
</div>	
<div class="content-separator"></div>
</div>
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

