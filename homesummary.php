<?php
error_reporting(0);
session_start();
session_start();
if(!isset($_SESSION['userID'])){
	 $logoutGoTo="index.php";
	 header("Location: $logoutGoTo");
	
	}

$partnerid= $_SESSION['userID'];
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
include("includes/partnercommodityheader.php");

require_once("includes/dbConf.php");
include("FusionCharts/FusionCharts.php");

$db = new dbConf();
$current_year1 = date("Y");
$current_month1 = date("m");
?>

 
<div id="tabs" style="margin-top:210px; border-color:#FFF; margin-left:45px; margin-right:45px; overflow:auto; height:500px; width:auto;">
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

	
	
	
  <ul>
    <li><a href="#div1">SUMMARY</a></li>
    <li><a href="#div2">CALIBUR</a></li>
    <li><a href="#div3">PIMA</a></li>
  </ul>
 

<div id ="div1">
<table>
	<tr>
		<td style="vertical-align:top;">
<div class="section-title" style="width:350px; margin-left:40px;"><center>CD4 Tests for <?php echo $current_year1; ?></center></div> 

<div id="chartdivtrendd_1" style="width:300px;" align="right"> 
<script type="text/javascript">
var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "ChartId", "420", "250", "0", "0");
myChart.setDataURL("xml/yearlycommoditytestspat1.php?mwaka=<?php echo $current_year1; ?>&mwezi=<?php echo $current_month1;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");
myChart.render("chartdivtrendd_1");  
</script> 
</div>
</td>

   <td style="vertical-align:top;">
   <div class="section-title" style="margin-left:50px;"><center>% CD4 Tests for <?php echo $currentyear; ?> </center></div>
   <div id="chartdiv29001_a" style="margin-left:50px;">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">
   var myChart29002 = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "ChartId", "300", "200", "0", "0");
   myChart29002.setDataURL("xml/yearlycommoditytrendpatpie.php?graph=1 &mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");   
    myChart29002.render("chartdiv29001_a");
   </script>
  
    </td>
    
    
    <!------Cumulative Testing Statistics Table------------>
   <td style="vertical-align:top;" >
            <div class="section-title" style="width:335px; height:10px; margin-left:60px; "><center>CD4 Tests <350cell/mm3 for <?php echo $current_year1; ?></center></div>
            <table class="data-table" style="width:350px; height:180px; margin-left:60px;">
                    <tr class="even">
                        <th>&nbsp;</th>
                        <th><center>Tests</center></th>
                        <th nowrap="nowrap"><center><350</center></th>
                        <th nowrap="nowrap"><center><350</center></th>
                        
                    </tr>
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b><center>Total Tests</b></center></td>
                    <td><center><?php echo $totaltests=getcumulativedata1($currentyear) ?></center></td>
                    <td><center><?php echo $total350tests=getcumulativedata2($currentyear)  ?></center></td>
                    <td><center><?php echo round((($total350tests/$totaltests)*100),1)."%"?></center></td>
                    
                </tr>    
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b><center>Pima</b></center></td>
                    <td><center><?php echo $totaltests1=getcumulativedata3($currentyear)?></center></td>
                    <td><center><?php echo $total350pimatests=getcumulativedata4($currentyear)?></center></td>
                    <td><center><?php echo round((($total350pimatests/$totaltests1)*100),1)."%"?></center></td>
                   
                </tr>   
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b><center>Calibur</b></center></td>
                    <td><center><?php echo $totaltests2=getcumulativedata5($currentyear) ?></center></td>
                    <td><center><?php echo $total350caliburtests=getcumulativedata6($currentyear)?></center></td>
                    <td><center><?php echo round((($total350caliburtests/$totaltests2)*100),1)."%"?></center></td>
                    
                </tr> 
            </table>
            </td>

	</tr>
	
	       <tr>
  <td>
            <div class="section-title" style="width:350px; height:10px; margin-left:40px;" ><center>CD4 Tests <350 cells/mm3 For <?php echo $current_year1; ?> </center></div>
             <div id="chartdivtrendd_21" style="width:350px; align=right;">The chart will appear within this DIV. This text will be replaced by the chart. </div>
         <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId",  "450", "250", "0", "0");
    myChart.setDataURL("xml/yearlycommoditytestspat2.php?mwaka=<?php echo $current_year1; ?>&mwezi=<?php echo $current_month1;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>
    &tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");
    myChart.render("chartdivtrendd_21");
    </script>
    

</td>     

<td style="margin-left:55px; margin-top:60px; vertical-align:top;">
   <div class="section-title" style="margin-left:40px; width:80%;"> <center> % Tests For <?php echo date("F", mktime(0, 0, 0, $current_month1, 10));?> </center> </div>
   <div id="chartdiv29001_A" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">
   var myChart29002 = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "ChartId", "300", "150", "0", "0");
   myChart29002.setDataURL("xml/yearlycommoditytrendpatpie1.php?graph=1 &mwaka=<?php echo $current_year1; ?>&mwezi=<?php echo $current_month1;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");   
    myChart29002.render("chartdiv29001_A");
   </script>
    </td>
   
<td style="vertical-align:top;">
<div class="section-title" style="width:335px; height:10px; margin-left:60px; margin-top:0px;"><center>CD4 Tests <350cells/mm3 for  <?php echo date("F", mktime(0, 0, 0, $current_month1, 10));?></center></div>

            <table class="data-table" style="width:350px; height:180px; margin-left:60px;">
                    <tr class="even">
                        <th>&nbsp;</th>
                        <th><center>Tests</center></th>
                        <th nowrap="nowrap"><center><350</center></th>
                        <th nowrap="nowrap"><center><350</center></th>
                        
                    </tr>
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b><center>Total Tests</b></center></td>
                    <td><center><?php echo $totaltests1=getcurrentdata1($currentmonth)?></center></td>
                    <td><center><?php echo $total350tests1=getcurrentdata2($currentmonth) ?></center></td>
                    <td><center><?php echo round((($total350tests1/$totaltests1)*100),1)."%" ?></center></td>
                    
                </tr>    
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b><center>Pima</b></center></td>
                    <td><center><?php echo $totaltests2=getcurrentdata3($currentmonth)?></center></td>
                    <td><center><?php echo $total350tests2=getcurrentdata4($currentmonth) ?></center></td>
                    <td><center><?php echo round((($total350tests2/$totaltests2)*100),1)."%" ?></center></td>
                   
                </tr>   
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b><center>Calibur</b></center></td>
                    <td><center><?php echo $totaltests3=getcurrentdata5($currentmonth) ?></center></td>
                    <td><center><?php echo $total350tests3=getcurrentdata6($currentmonth)  ?></center></td>
                    <td><center><?php echo round((($total350tests3/$totaltests3)*100),1)."%"?></center></td>
                    
                </tr>                 
            </table>


</td>
</tr>
	
</table>
   
</div>






<!--Calibur div-->

<div id = "div2">
<table>
<table class="dataTable" width="100%">
    <tr>
        <td colspan="2" valign="top" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center>National Statistics</center></div>
            <div id='mapDiv' style="float: left; vertical-align: top; margin-top: -5px;">
The map will replace this text. If any users do not have Flash Player 8 (or above), they'll see this message.     </div>
<script type="text/javascript">
var map = new FusionMaps("FusionMaps/FCMap_KenyaCounty.swf", "KenyaMap", 500, 400, "0", "0");
map.setDataURL("xml/commoditymap.php");
map.render("mapDiv");
</script>
            
            </td>
        <td colspan="2" valign="top" class="xtop" style="vertical-align:top; ">           
<div class="section-title" ><center>% of Tests by Age</center></div>
            
  <div id="chartdiv2900_P" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

      var myChart2900 = new FusionCharts("FusionCharts/Charts/Doughnut2D.swf", "ChartId", "300", "250", "0", "0");
    myChart2900.setDataURL("xml/adultpaediatrictrendpie.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");  
      myChart2900.render("chartdiv2900_P");
   </script> 
</td>
        <td colspan="2" valign="top" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center>Testing Statistics</center></div>
            
            <p style="font-family:Georgia, 'Times New Roman', Times, serif ; font-size: 0.5;" colspan="4" ><span class="style8"><b>Cumulatively From <?php echo date('M, Y',strtotime(mindatecommodity())); ?> </b></span></p>
            <table class="data-table" width="80%">
                    <tr class="even">
                        <th>&nbsp;</th>
                        <th>Tests</th>
                        <th>Adults</th>
                        <th nowrap="nowrap">CD4 < 350</th>
                        <th>Paediatrics</th>
                        <th nowrap="nowrap">CD4 < 25%</th>
                        
                    </tr>
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b>Total Tests</b> </td>
                    <td><center><?php echo $tottest=getTotalspecfromstartscounty(2,""); ?></center></td>
                    <td><center><?php echo $adulttest=getTotalspecfromstartscounty(1,""); ?></center></td>
                    <td><center><?php echo $adultbel=getTotalspecfromstartscounty(1," AND CD3CD4CD45TruCCD3CD4AbsCnt<350" ); ?></center></td>
                    <td><center><?php echo $paedtest=getTotalspecfromstartscounty(0,""); ?></center></td>
                    <td><center><?php echo $paedbel=getTotalspecfromstartscounty(0," AND CD3CD4CD45TruCCD3CD4Lymph    <25 " ); ?></center></td>
                </tr>    
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b>Percentages</b> </td>
                    <td><center><?php echo " "; ?></center></td>
                    <td><center><?php echo round((($adulttest/$tottest)*100),1)."%"; ?></center></td>
                    <td><center><?php echo round((($adultbel/$adulttest)*100),1)."%"; ?></center></td>
                    <td><center><?php echo round((($paedtest/$tottest)*100),1)."%"; ?></center></td>
                    <td><center><?php echo round((($paedbel/$paedtest)*100),1)."%"; ?></center></td>
                </tr>                
            </table>
            <p style="font-family:Georgia, 'Times New Roman', Times, serif ; font-size: 0.5;" colspan="4" ><span class="style8"><b>Statistics For <?php echo $title; ?></b></span></p>
                    <table class="data-table" width="90%">
                <thead>
                    <tr class="even">
                        <th>&nbsp;</th>
                        <th>Tests</th>
                        <th>Adults</th>
                        <th nowrap="nowrap">CD4 < 350</th>
                        <th>Paediatrics</th>
                        <th nowrap="nowrap">CD4 < 25%</th>
                        
                    </tr>
                </thead>
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b>Total Tests</b> </td>
                    <td><center><?php echo $tottesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),2,"") ;?></center></td>
                    <td><center><?php echo $adultesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),1,"" ) ;?></center></td>
                    <td><center><?php echo $adultfail=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),1," AND CD3CD4CD45TruCCD3CD4AbsCnt<350" ) ;?></center></td>
                    <td><center><?php echo $childtesta=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0,""  ) ;?></center></td>
                    <td><center><?php echo $failchild=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0," AND CD3CD4CD45TruCCD3CD4Lymph    <25 "  ) ;?></center></td>
                </tr>    
                <tr>
                    <td style="background-color:#CCCCCC " nowrap="nowrap"><b>Percentages</b> </td>
                    <td><center><?php echo " "; ?></center></td>
                    <td><center><?php echo round((($adultesta/$tottesta)*100),1)."%"; ?></center></td>
                    <td><center><?php echo round((($adultfail/$adultesta)*100),1)."%"; ?></center></td>
                    <td><center><?php echo round((($childtesta/$tottesta)*100),1)."%"; ?></center></td>
                    <td><center><?php echo round((($failchild/$childtesta)*100),1)."%"; ?></center></td>
                </tr>    
                
            </table>
    
    
            </td>
    </tr>
    <tr>
        <td colspan="2" rowspan="2" valign="top" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center>Test Trends for Year <?php echo $currentyear; ?></center></div>
                  
  <div id="chartdivtrendd" > </div>
         <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "450", "250", "0", "0");
    myChart.setDataURL("xml/commoditytrend.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");
    myChart.render("chartdivtrendd");
    
   </script>        
   
       </td>
        <td colspan="2" rowspan="2" valign="top" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center>Tests < 350 cells/MM3 in Year <?php echo $currentyear; ?> </center></div>
             <div id="chartdivtrendd22" > </div>
         <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId",  "450", "250", "0", "0");
    myChart.setDataURL("xml/failedcommoditytrend.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");
    myChart.render("chartdivtrendd22");
    </script>

</td>
        <td colspan="2" valign="top" rowspan="1" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center>% Tests by Age in Year <?php echo $currentyear; ?> </center></div>
          <div id="chartdiv29001" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

       var myChart29002 = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "ChartId", "300", "150", "0", "0");
    myChart29002.setDataURL("xml/individualtrendpie.php?graph=1 &mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");   
      myChart29002.render("chartdiv29001");
   </script>
            
   
    </td>
    <tr>
            <td colspan="2" valign="top" class="xtop" style="vertical-align:top; ">
                
    <div id="chartdiv29000" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

       var myChart29002 = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "ChartId", "300", "150", "0", "0");
    myChart29002.setDataURL("xml/individualtrendpie.php?graph=0 & mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");   
      myChart29002.render("chartdiv29000");
   </script>
            
    </td>
    </tr>
    </tr>
    <tr>
        <td width="50%" colspan="3" valign="top" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center>Testing Trends between <?php  $tdoay=date('Y'); echo ($tdoay-2)."-".$tdoay;?></center></div>
             <center><div id="chartdivtrenddz1" > </div>
         <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "550", "250", "0", "0");
    myChart.setDataURL("xml/yearcommoditytrend.php?mwaka=<?php echo $currentyear; ?>");
    myChart.render("chartdivtrenddz1");
    
   </script>    </center>
            </td>
        <td width="50%"  colspan="3" valign="top" class="xtop" style="vertical-align:top; ">
            <div class="section-title" ><center><350 cells/mm3 Trends between <?php  $tdoay=date('Y'); echo ($tdoay-2)."-".$tdoay;?></center></div>
            <center> <div id="chartdivtrenddz2" > </div>
         <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "550", "250", "0", "0");
    myChart.setDataURL("xml/yearfailcommoditytrend.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>; ?>");
    myChart.render("chartdivtrenddz2");
    
   </script>    </center>
            </td>
    </tr>
</table>
</table>
</div>
<div id ="div3">
<?php
//include("includes/header.php"); 
$testedsamples=totalTests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$LESS350CPML=CDreports($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totalerrors=totalErr($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$devicesreporting=devicesreporting($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$devicesinlab=gettotaldevicesperpartnerbylocation($partnerid,1); //lab
$devicesinpmtct=gettotaldevicesperpartnerbylocation($partnerid,2); //pmtct
$totaldevices=gettotaldevicesperpartner($partnerid);
$totalfacilities=gettotalfacilitiesperpartner($partnerid);
$status=cdCount350($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate); ?>

<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr valign="top">
<td valign="top"  rowspan="1"  style="vertical-align: top;"> <div class="section-title"> Summaries of Test results for <?php echo $title; ?> </div>

 <div id="chartdiv29_C" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

      var myChart2900 = new FusionCharts("FusionCharts/Charts/Pie2D.swf", "ChartId", "300", "350", "0", "0");
    myChart2900.setDataURL("xml/testoutcomespie.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>%26partnerid=<?php echo $partnerid;?>");      
      myChart2900.render("chartdiv29_C");
   </script></td>
<td rowspan="1" valign="top"  style="vertical-align: top;"> 
<div class="section-title"> Statistics for <?php echo$title; ?> </div>  

<table style="width:340px"  border="0"  cellpadding="0" cellspacing="0" class="data-table">
    <tr class="even">
   
	<td ><small></small> # of CD4 Tests Performed </td>
	   <td  style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="style8">
         <?php 
	   
echo $testedsamples;
	   ?>
        </span>
</td>
	
  </tr>
  <tr class="even">
	<td >  CD4 Tests |< 350 cells/mm3  </td>
	   <td  style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="style8">
<a class="modalbox" href="#inline"> 	   <?php 
echo $LESS350CPML;
	   ?></a>
 <?php
 ?>
  
       <div id="inline">
	

	<table width="400" class="data-table">
                     <tr><th colspan="3" valign="middle"><center><h2>CD4 Count below 350</h2></center></th></tr>   
                       	<tr>
                        <td><strong>#</strong></td>
                          <td><strong>Facility Name</strong></td>
                          <td><strong>Samples</strong></td>
                        </tr>
                        
                         <?php
						 
						 printFacSamples($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
                         ?>
                            
					</table>
</div>
       
       </span>
</td>
	
  </tr>
 
    <tr class="even">
   
	<td >  # of Failed/error Tests  </td>
	   <td  style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="style8">
                <?php 
	   
echo $totalerrors;
	   ?>
       </span>
</td>
	
  </tr>


      <tr class="even">
   
	<td >  # of Devices Reporting  </td>
	   <td  style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="style8">
	   <a class="modalbox" href="#inline2"> <?php
	echo $devicesreporting;    
	$status1=deviceuploadpop($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);  
	   ?></a> /    <a class="modalbox" href="#inline1"> 	  <?php
	  $status=devicepop($partnerid);
	echo $totaldevices;
	  
	  ?></a>

       <div id="inline2">
	<h2><center>Devices Uploading</center></h2>

	<table width="400" class="data-table">
                        
                       	<tr>
                        <td><strong>#</strong></td>
                          <td><strong>Device No.</strong></td>
                          <td><strong>Last Upload</strong></td>
                          
                        </tr>
                        
                         <?php
						 $num=1;
                                while($value=mysql_fetch_array($status1)){
									
							  ?>
 						 <tr>
                         <td> <?php echo $num;  ?></td>
  							  <td> <?php echo $value['deviceID'];  ?></td>
                              <td> <?php  echo date("d-M-Y",strtotime(maxDateDev($value['deviceID']))); ?></td>
                             
                         </tr>
                         <?php
								$num+=1;	
								}
                         ?>
                              
					</table>
</div>
    
       <div id="inline1">
	<h2><center>Devices</center></h2>

	<table width="400" class="data-table">
                        
                       	<tr>
                        <td><strong>#</strong></td>
                          <td><strong>Device No.</strong></td>
                          <td><strong>Location</strong></td>
                          
                        </tr>
                        
                         <?php
						 $num=1;
                                while($value=mysql_fetch_array($status)){
									
							  ?>
 						 <tr>
                         <td> <?php echo $num;  ?></td>
  							  <td> <?php echo $value['deviceNumber'];  ?></td>
                              <td>  <?php if($value['location']==1){
								  echo " In Lab";
								  }
								  else
								   echo $value['specLoc'];
								  ?></td>
                             
                         </tr>
                         <?php
								$num+=1;	
								}
                         ?>
                              
					</table>
</div></span>
       
</td>
	
  </tr>   <tr class="even">
   
	<td >  % Reporting   </td>
	   <td  style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="style8">
        <?php 
$a=round(($devicesreporting/$totaldevices)*100,1);
echo $a." "."%";
	   ?>
       </span>
</td>
	
  </tr>
    </table>
   
 </td>
 
  <td  valign="top" class="xtop" colspan="2" style="vertical-align: top;"> <div class="section-title"> Reporting Rates for <?php echo$title; ?> </div>
<div id="chartdivtren_2" align="center"> </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionWidgets/Charts/HLinearGauge.swf", "myChartId", "500", "150", "0", "0");
    myChart.setDataURL("xml/reportingrates.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>%26partnerid=<?php echo $partnerid;?>");
	myChart.render("chartdivtren_2");
   </script>

</td>
</tr>
<tr>

<td rowspan="2" colspan="2" valign="top" class="xtop"> <div class="section-title">Errors Reported by Codes for <?php echo $title;?> </div>

					<div class="section-content">
 <div id="chartdiv_2" align="left"> </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/Column2D.swf", "myChartId", "680", "350", "0", "0");
    myChart.setDataURL("xml/errors.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>%26partnerid=<?php echo $partnerid;?>");
	myChart.render("chartdiv_2");
   </script>
					        
			
			
					</div>
</td>

</tr>
<tr>
<td valign="top"> <div class="section-title">Reporting Trend for <?php echo $currentyear; ?> </div>

  <div id="chartdivtrendd_3" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "500", "350", "0", "0");
    myChart.setDataURL("xml/yearlytrend.php?mwaka=<?php echo $currentyear; ?>%26partnerid=<?php echo $partnerid;?>s");
	myChart.render("chartdivtrendd_3");
   </script>	

</td></tr>
</table>
</div>

</div>
<?php
include 'includes/footer.php';
?>