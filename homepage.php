<?php
session_start();
if(!isset($_SESSION['userID'])){
	 $logoutGoTo="index.php";
	 header("Location: $logoutGoTo");
	
	}
include("includes/header.php");
include ("includes/dbConf.php");
$db=new dbConf();
//We've included ../Includes/FusionCharts.php and ../Includes/DBConn.php, which contains
//functions to help us easily embed the charts and connect to a database.
include("FusionCharts/FusionCharts.php");
$partnerid=$_SESSION['userID'];
// $partnerid . '<br/>';
"Filter: " .$filter. " Month:". $currentmonth.' YYYY:'. $currentyear.' Customize: '.$fromfilter.' - '.$tofilter.' 6/3 Months: '.$fromdate.' - '.$todate;

$testedsamples=totalTests($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$LESS350CPML=CDreports($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totalerrors=totalErr($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$devicesreporting=devicesreporting($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$devicesinlab=gettotaldevicesperpartnerbylocation($partnerid,1); //lab
$devicesinpmtct=gettotaldevicesperpartnerbylocation($partnerid,2); //pmtct
$totaldevices=gettotaldevicesperpartner($partnerid);
$totalfacilities=gettotalfacilitiesperpartner($partnerid);
$status=cdCount350($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate); ?>

		<div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
    
    
   
   
    
    



<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr valign="top">
<td valign="top"  rowspan="2"> <div class="section-title"> Summaries of Test results for <?php echo $title; ?> </div>

 <div id="chartdiv2900" align="center">The chart will appear within this DIV. This text will be replaced by the chart.</div>
   <script type="text/javascript">

      var myChart2900 = new FusionCharts("FusionCharts/Charts/Pie2D.swf", "ChartId", "300", "350", "0", "0");
    myChart2900.setDataURL("xml/testoutcomespie.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>%26partnerid=<?php echo $partnerid;?>");      
      myChart2900.render("chartdiv2900");
   </script></td>
<td rowspan="1" valign="top"> 
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
  <tr>
  <td  valign="top" class="xtop" colspan="2"> <div class="section-title"> Reporting Rates for <?php echo$title; ?> </div>
<div id="chartdivtren2" align="center"> </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionWidgets/Charts/HLinearGauge.swf", "myChartId", "300", "80", "0", "0");
    myChart.setDataURL("xml/reportingrates.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>%26partnerid=<?php echo $partnerid;?>");
	myChart.render("chartdivtren2");
   </script>

</td>
  </tr>
    </table>
   
 </td>
</tr>
<tr>

<td rowspan="2" colspan="2" valign="top" class="xtop"> <div class="section-title">Errors Reported by Codes for <?php echo $title;?> </div>

					<div class="section-content">
 <div id="chartdivtrendddd" align="left"> </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/Column2D.swf", "myChartId", "680", "350", "0", "0");
    myChart.setDataURL("xml/errors.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>%26partnerid=<?php echo $partnerid;?>");
	myChart.render("chartdivtrendddd");
   </script>
					        
			
			
					</div>
</td>

</tr>
<tr>
<td valign="top"> <div class="section-title">Reporting Trend for <?php echo $currentyear; ?> </div>

  <div id="chartdivtrendd" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "500", "350", "0", "0");
    myChart.setDataURL("xml/yearlytrend.php?mwaka=<?php echo $currentyear; ?>%26partnerid=<?php echo $partnerid;?>s");
	myChart.render("chartdivtrendd");
   </script>	

</td></tr>
</table>
  
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