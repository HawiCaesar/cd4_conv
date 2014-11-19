<?php
error_reporting(0);
/*@session_start();
if(!isset($_SESSION['username'])){
	echo "<script>";
	echo "window.location.href='facilitylogin.php'";
	echo "</script>";
}*/



include ("includes/commodityheader.php");
require_once ("includes/dbConf.php");
$db = new dbConf();

$mfl=0;
	if(isset($_GET['county'])){
			$mfl=$_GET['county'];
			$sql="SELECT * FROM `countys` WHERE ID= $mfl";
			$query = mysql_query($sql) or die(mysql_error());
			while ($rs = mysql_fetch_assoc($query)) {
				$countyName=$rs['name'];
				}
		}else{
			$mfl=1;
			}


?>
<div >
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

</div>
<div  class="mydiv" style="margin:auto; width: 94%;">
	<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
    <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="cd4CommodityCalculator.js"></script>
  

  <table  class="dataTable">
      <thead>
          <tr>
              <td colspan="2"><center><h4>FACILITIES COMMODITY REPORTING TRENDS</h4></center></td>
          </tr>
          
      </thead>
     <tbody>
      	<tr>
        	<td colspan="1" width= "41%"> 
            <div class="section-title" ><center>National</center></div>
            	<table >
                <tr>
                <td >
            	 
                    <center>
                    	<div id="nationalTrends" > </div>
                        <script type="text/javascript">
                                var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "390", "250", "0", "0");
                                myChart.setDataURL("xml/commodityReporting.php?mwaka=<?php echo $currentyear; ?>");
                                myChart.render("nationalTrends");        
                        </script>    
                    </center>  
                 </td>
                  <td width="25%"> 
                      <div style="margin-bottom: 0px;">
                    	<h5>Top Reporting</h5>
                        	
                    	   <ol>
                        	 <?php echo topReporting(0);?>
                          </ol>
                      </div>
                    </td>
                 
                 </tr>
                 </table>        
            </td> 
                      
            <td colspan="1"> 
            <div class="section-title" ><center>County <?php if(isset($_GET['county'])){echo ": ".$countyName;	}?></center></div>
            	<table >
                <tr>
                <td>            	
                <div style="margin-bottom: 162px;">
                	<form action"commodityReporting.php" method="get" >
                    	<select name='county' style=" width: 140px;" >
                        	 <?php 
								              echo reportingCounties($mfl);
							             ?>
                      </select><br/>
                          
                      <input type="submit" value="Load Chart" />
                   </form>
                </div>
            		</td>
                    <td> 
                    	<div id="countyTrends" > </div>
						<script type="text/javascript">
                              var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "390", "255", "0", "0");
                              myChart.setDataURL("xml/commodityReporting.php?county=<?php echo $mfl;  ?>");
                              myChart.render("countyTrends");					  
                        </script>    
                	 
                    </td>
                    <td width="20%"> 
                      <div style="/* margin-bottom: 162px; */">
                    	<h5>Top Reporting</h5>
                    	   <ol>
                        	  <?php echo topReporting($mfl);?>
                          
                          </ol>
                      </div>
                    </td>
                    </tr>
                 </table>        
            </td>
        </tr>
        <tr>
        	<td colspan="2">
            
        		<div class="section-title"><center>Commodity Timeline</center></div>
                <center>
                <div id="mulika" > </div>
                </center>
						<script type="text/javascript">
                              var myChart = new FusionCharts("FusionWidgets/HLinearGauge.swf", "myChartId", "950", "110", "0", "0");
                              myChart.setDataURL("xml/mulika.php");
                              myChart.render("mulika");					  
                        </script>  
            </td>
        </tr>
     </tbody>
  </table>
</div>
<?php
include 'includes/footer.php';s
?>