<?php
error_reporting(0);
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



        <script type="text/javascript">
        $(document).ready(function () {
            // create jqxtabs.
            $('#jqxtabs').jqxTabs({ width: 1200, height: 1000 });
            $('#jqxtabs').bind('selected', function (event) {
                var item = event.args.item;
                var title = $('#jqxtabs').jqxTabs('getTitleAt', item);
                
            });
        });
    </script>
<script type="text/javascript" src="ddaccordion.js">

        /***********************************************
         * Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
         * Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
         * This notice must stay intact for legal use
         ***********************************************/

</script>

<script language="javascript" type="text/javascript">

<!--
function popitup(url) {
newwindow=window.open(url,'name','left=400,top=200,width=800,height=150,toolbar=0,resizable=0,scrollbars=no');
if (window.focus) {newwindow.focus()}
return false;
}

// -->
</script>
<script type="text/javascript">


        ddaccordion.init({
            headerclass: "submenuheader", //Shared CSS class name of headers group
            contentclass: "submenu", //Shared CSS class name of contents group
            revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
            mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
            collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
            defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
            onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
            animatedefault: false, //Should contents open by default be animated into view?
            persiststate: true, //persist state of opened contents within browser session?
            toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
            togglehtml: ["suffix", "<img src='img/plus.gif' class='statusicon' />", "<img src='img/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
            animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
            oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                //do nothing
            },
            onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                //do nothing
            }
        })


</script>
	 <p>&nbsp;</p>
	 
 <div class="main" id="main-two-columns">
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

				$year = GetMaxYear($patna)-1;
				$twoless = GetMinYear($patna);
				for ($year; $year <= $twoless; $year++) {

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
<?php
$errormsg=$_GET['err'];

 if ($errormsg !="")
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
<?php
$msg=$_GET['msg'];
 if ($msg !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$msg.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>

<table class="dataTable" width="100%">
	<tr>
		<td colspan="2" valign="top" class="xtop" style="vertical-align:top; ">
			<div class="section-title" ><center>National Statistics</center></div>
			<div id='mapDiv' style="float: left; vertical-align: top; margin-top: -5px;">
The map will replace this text. If any users do not have Flash Player 8 (or above), they'll see this message.	 </div>
<script type="text/javascript">
var map = new FusionMaps("FusionMaps/FCMap_KenyaCounty.swf", "KenyaMap", 500, 400, "0", "0");
map.setDataURL("xml/commoditymap.php");
map.render("mapDiv");
</script>
			
			</td>
		<td colspan="2" valign="top" class="xtop" style="vertical-align:top; ">
			<div class="section-title" ><center>Equipment Types</center></div>
			<table width="100%" class="data-table">
				<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
				<tr><td><b><a href="#myModal_1" data-toggle="modal" class="menuitem submenuheader">CD4 Equipment</a></b></td>
                <td><center><?php getEquipmentTotals(1,0); ?></center></td>
                     	<td><center><?php getEquipmentTotals(1,1); ?></center></td>
                     	<td><center><?php getEquipmentTotals(1,2); ?></center></td>
                     	<td><center><?php getEquipmentTotals(1,3); ?></center>
                     		
                     		
                     		
                     		
                     	<div id="myModal_1" class="modal hide fade" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width; >
	<div class="modal-header">
                     	<div class="section-title"><center>CD4 Equipment</center></div>
                     	
                     	</div>
	<div class="modal-body">	
<!-- Devices and their details  from the national view-!-->	
<table width="100%" class="data-table" >	
                     	<tr> <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
                     	
                     	
                     	
                     	
                                                    </tr>
                     	<?php
                     	$cd4=getcd4Equipment();
                     	?>
                     	<?php
                     	foreach ($cd4 as $key => $value) {
                     	?> <tr class="even">
<td><?php echo $value['description']; ?></td>
<td><?php getTotalEquipment($value['ID']); ?></td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],1); ?></td>
                     	<td><?php if(getTotalEquipmentcat($value['ID'],2)==0){?>
<?php echo getTotalEquipmentcat($value['ID'],2);
}else{?>	
<a href='javascript:void(null);' onClick="popitup('faultyequipment.php?cat=<?php echo 1;?>&status=<?php echo $eqipmentStatus;?>')">
<?php echo    getTotalEquipmentcat($value['ID'],2); ?></a><?php } ?> </td>
<td><?php  echo getTotalEquipmentcat($value['ID'],3); ?></td></tr>
<?php }?>
                     	<tr class="even">
                     	<td><b>Total</b></td>
                     	<td><?php getEquipmentTotals(1,0); ?></td>
                     	<td><?php getEquipmentTotals(1,1); ?></td>
                     	<td><?php getEquipmentTotals(1,2); ?></td>
                     	<td><?php getEquipmentTotals(1,3); ?></td>
                     	
                     	</tr>
                     	</table>	
                     	
                   </div>  	
                     	
                   	<div class="modal-footer">
	
	<div class="right">
			<?php echo "@"." ".date('Y')." "."NASCOP" ?>
		</div>
	</div>
</div>	
                     		
                     		
                     		
                     		
                     		
                     		                     		
                     	</td>
                </tr>
				<tr>
					<td><b><a href="#myModal_2" data-toggle="modal" class="menuitem submenuheader">Chemistry Equipment</a></b></td>
					<td><center><?php getEquipmentTotals(5,0); ?></center></td>
                     	<td><center><?php getEquipmentTotals(5,1); ?></center></td>
                     	<td><center><?php getEquipmentTotals(5,2); ?></center></td>
                     	<td><center><?php getEquipmentTotals(5,3); ?></center>
                     		
                     		
                     		
                     	  		
                     		
                     	<div id="myModal_2" class="modal hide fade" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width; >
	<div class="modal-header">
                     	<div class="section-title"><center>Chemistry Equipment</center></div>
                     	
                     	</div>
	<div class="modal-body">	
<!-- Devices and their details  from the national view-!-->	
<table width="100%" class="data-table" >	
                     	<tr> <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
                     	
                     	
                     	
                     	
                                                    </tr>
                     	<?php
                     	$cd4=getchemEquipment();
                     	?>
                     	<?php
                     	foreach ($cd4 as $key => $value) {
                     	?>
<tr class="even">
<td><?php echo $value['description']; ?></td>
<td><?php getTotalEquipment($value['ID']); ?></td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],1); ?></td>
                     	<td><?php if(getTotalEquipmentcat($value['ID'],2)==0){?>
<?php echo getTotalEquipmentcat($value['ID'],2);
}else{?>
<a href='javascript:void(null);' onClick="popitup('faultyequipment.php?cat=<?php echo 1;?>&status=<?php echo $eqipmentStatus;?>')"><?php echo getTotalEquipmentcat($value['ID'],2); ?></a>
<?php } ?>
                     	
                     	</td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],3); ?></td>
</tr>
<?php
}
?>
                     	<tr class="even">
                     	<td><b>Total</b></td>
                     	<td><?php getEquipmentTotals(5,0); ?></td>
                     	<td><?php getEquipmentTotals(5,1); ?></td>
                     	<td><?php getEquipmentTotals(5,2); ?></td>
                     	<td><?php getEquipmentTotals(5,3); ?></td>
                     	
                     	
                     	</tr>
                     	</table>	
                     	
                   </div>  	
                     	
                   	<div class="modal-footer">
	
	<div class="right">
			<?php echo "@"." ".date('Y')." "."NASCOP" ?>
		</div>
	</div>
</div>		
                     		
                     		
                     		
                     		
                     	</td>
                     	</tr>
				<tr>
					<td><b><a href="#myModal_3" data-toggle="modal" class="menuitem submenuheader">Haematology Equipment</a></b></td>
					<td><center><?php getEquipmentTotals(3,0); ?></center></td>
                     	<td><center><?php getEquipmentTotals(3,1); ?></center></td>
                     	<td><center><?php getEquipmentTotals(3,2); ?></center></td>
                     	<td><center><?php getEquipmentTotals(3,3); ?></center>
                     		
                     		
                     		
                     		
                     		<div id="myModal_3" class="modal hide fade" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width; >
	<div class="modal-header">
                     	<div class="section-title"><center>Haematology Equipment</center></div>
                     	
                     	</div>
	<div class="modal-body">	
<!-- Devices and their details  from the national view-!-->	
<table width="100%" class="data-table" >	
                     	<tr> <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
                     	
                     	
                     	
                     	
                                                    </tr>
                     	<?php
                     	$cd4=gethermEquipment();
                     	?>
                     	<?php
                     	foreach ($cd4 as $key => $value) {
                     	?>
<tr class="even">
<td><?php echo $value['description']; ?></td>
<td><?php getTotalEquipment($value['ID']); ?></td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],1); ?></td>
                     	<td><?php if(getTotalEquipmentcat($value['ID'],2)==0){?>
<?php echo getTotalEquipmentcat($value['ID'],2);
}else{?>
<a href='javascript:void(null);' onClick="popitup('faultyequipment.php?cat=<?php echo 1;?>&status=<?php echo $eqipmentStatus;?>')"><?php echo getTotalEquipmentcat($value['ID'],2); ?></a>
<?php } ?>
                     	
                     	</td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],3); ?></td>
</tr>
<?php
}
?>
                     	<tr class="even">
                     	<td><b>Total</b></td>
                     	<td><?php getEquipmentTotals(3,0); ?></td>
                     	<td><?php getEquipmentTotals(3,1); ?></td>
                     	<td><?php getEquipmentTotals(3,2); ?></td>
                     	<td><?php getEquipmentTotals(3,3); ?></td>
                     	
                     	
                     	</tr>
                     	</table>	
                     	
                   </div>  	
                     	
                   	<div class="modal-footer">
	
	<div class="right">
			<?php echo "@"." ".date('Y')." "."NASCOP" ?>
		</div>
	</div>
</div>	
                     		
                     		
                     		
                     	</td>
                     	
                     	
                     	</tr>
			</table>
			
			
			
			
			
			






<div class="section-title" ><center>% of Tests by Age</center></div>
			
  <div id="chartdiv2900" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

      var myChart2900 = new FusionCharts("FusionCharts/Charts/Doughnut2D.swf", "ChartId", "300", "250", "0", "0");
    myChart2900.setDataURL("xml/adultpaediatrictrendpie.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&level=0&mfl=0");  
      myChart2900.render("chartdiv2900");
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
					<td><center><?php echo $paedbel=getTotalspecfromstartscounty(0," AND CD3CD4CD45TruCCD3CD4Lymph	<25 " ); ?></center></td>
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
					<td><center><?php echo $failchild=getTotalspecthismonth(maxdatecommodity($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate),0," AND CD3CD4CD45TruCCD3CD4Lymph	<25 "  ) ;?></center></td>
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
	
   </script>	</center>
			</td>
		<td width="50%"  colspan="3" valign="top" class="xtop" style="vertical-align:top; ">
			<div class="section-title" ><center><350 cells/mm3 Trends between <?php  $tdoay=date('Y'); echo ($tdoay-2)."-".$tdoay;?></center></div>
			<center> <div id="chartdivtrenddz2" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "550", "250", "0", "0");
    myChart.setDataURL("xml/yearfailcommoditytrend.php?mwaka=<?php echo $currentyear; ?>&mwezi=<?php echo $currentmonth;?>&filtertype=<?php echo $filter;?>&fromfilter=<?php echo $fromfilter;?>&tofilter=<?php echo $tofilter;?>&fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>; ?>");
	myChart.render("chartdivtrenddz2");
	
   </script>	</center>
			</td>
	</tr>
</table>

<div class="content-separator"></div>
</div>





<div class="column left" id="column-3">


</div>


<div class="clearer">&nbsp;</div>

</div>

<?php
include("includes/footer.php");
  ob_end_flush();
?>	

