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
require_once("includes/admin.php");
require_once("includes/dbConf.php");
include("FusionCharts/FusionCharts.php");

$db = new dbConf();

?>
<p>&nbsp;</p>
	  <div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">


					<div class="section-title"><center>Administrator Navigation</center></div>

				  <div class="post-date"></div>

					<div class="post-body">
				  </div>
				
			  </div>
			  <div class="post">
                  <div style="border:medium;background-position:center;clear:nonew;max-width:100%; height:auto;">
                     <table width="100%" height="100" class="datas-table" border="0">
                     	<tr>
                     		<td width="60" height="45"><center><a href="device.php"><img src="img/pima.jpg" width="60" height="45"></a></center></td>
                     		<td width="60" height="45"><center><a href="users.php"><img src="img/users.jpg" width="60" height="45"></a></center></td>
                     		<td width="60" height="45"><center><a href="partner.php"><img src="img/user.jpg"  width="60" height="45"></a></center></td>
                            <td width="60" height="45"><center><a href="mapping.php"><img src="img/mapping.jpg" width="60" height="45"></a></center></td>
                            <td width="60" height="45"><center><a href="log.php"><img src="img/access.jpg" width="60" height="45"></a></center></td>
                        </tr>
                         
                       	<tr>
                          <td><center><a href="device.php">Devices</a></center></td>
                          <td><center><a href="partner.php">Users </a></center></td>
                          <td><center><a href="partner.php">Partners</a></center></td>
                          <td><center><a href="mapping.php">Mapping</a></center></td>
                          <td><center><a href="log.php">Access Log</a></center></td>
                        </tr> 

					<tr height="15px"><td align="center" height="15px" colspan="5"><center>
					
				<table style="width:340px; height:15px " border="0" ><form id=""  method="GET" action="" >
<tr>
		<td> 
			<?php
		
		  $myC = new tc_calendar("fromf", true, false);
		  $myC->setIcon("img/Calendar.gif");
		  $myC->setPath("./");
		   $myC->setYearInterval(2010, 2015);
		  $myC->setDateFormat('j F Y');
		  $myC->writeScript();
		  
		  ?></td> <td><center> - </center></td> 
		<td> <?php 
		  $myC = new tc_calendar("tof", true, false);
		  $myC->setIcon("img/Calendar.gif");
		  $myC->setYearInterval(2010, 2015);
		  $myC->setDateFormat('j F Y');
		  $myC->writeScript();
		  
		  ?></td><td>
		    <input type="submit" name="submitfrom" value="Filter" class="button"/></td>
			</tr></form></table>
			</center>
			</tr>
			</td>
			<tr><td colspan="5"><center>
			<div id="chartdivtrendds" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "100%", "350", "0", "0");
    myChart.setDataURL("xml/logtrend.php?date1=<?php echo $date1; ?>&data=<?php echo $date2;?>");
	myChart.render("chartdivtrendds");
   </script>		
				</center>
			</td></tr></table>
			</div></div>	<div class="content-separator"></div>
				
			</div>
            <?php  	
			
				include("includes/sideAdmin.php"); ?>

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
