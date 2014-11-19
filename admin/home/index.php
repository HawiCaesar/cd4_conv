 <?php
 @session_start();
 $_SESSION['page']="home";
require_once("../../includes/dbConf.php");
$_SESSION['levels']="start";
//$db = new dbConf();
include ('../admin.php');
?>
<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="../../bootstrap/js/jquery.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>


 <link href="../../DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
 <link href="../../DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
 <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
 <script type="text/javascript" src="../../DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                
                $(document).ready(function() {
					$('#data-table').dataTable({
						"bJQueryUI":true,
						"sScrollY": "100%"
						});
				});
                </script>
		<div class="main" id="main-two-columns" style="width: 90%; margin: auto;">

			<div class="left" id="main-left" style="width: 100%;">
				
				

				  <div class="post-date"></div>

					<div class="post-body">
				  </div>
				
			  </div>
			  <div class="post">
                  <div style="border:medium;background-position:center;clear:none;max-width:100%; height:auto;">
                     <table width="100%" class="datas-table" border="0">
                     	<tr>
                     		<td style="vertical-align: top;" width="34%">
                     			<div class="section-title"><center>Administrator Navigation</center></div>	
                     			<table>
                     				<tr>
                     		<td><center><a href="../equipment/"><img src="../../img/pima.jpg" width="60" height="45"></a></center></td>
                     		<td><center><a href="../users/"><img src="../../img/users.jpg" width="60" height="45"></a></center></td>
                     		<td><center><a href="partner.php"><img src="../../img/user.jpg"  width="60" height="45"></a></center></td>
                            <td><center><a href="../facility/"><img src="../../img/mapping.jpg" width="60" height="45"></a></center></td>
                            <td><center><a href="../reports/"><img src="../../img/access.jpg" width="60" height="45"></a></center></td>
                        </tr>
                         
                       	<tr>
                          <td><center><a href="../equipment/">Equipment</a></center></td>
                          <td><center><a href="../users/">Users </a></center></td>
                          <td><center><a href="partner.php">Partners</a></center></td>
                          <td><center><a href="../facility/">Facility</a></center></td>
                          <td><center><a href="../reports/">Access Log</a></center></td>
                        </tr>
                     			</table>
                     		</td>
                     		<td style="vertical-align: top;" width="33%">
                     			<div class="section-title"><center>Access Log for <?php echo date('Y'); ?></center></div>	
                     			
                     			<center>
			<div id="chartdivtrendds" > </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("../../FusionCharts/Charts/MSLine.swf", "myChartId", "100%", "270", "0", "0");
    myChart.setDataURL("../../xml/logtrend.php");
	myChart.render("chartdivtrendds");
   </script>		
				</center>
                     			
                     		</td>
                     		<td style="vertical-align: top;" width="33%">
                     			<div class="section-title"><center>Reporting Rate</center></div>	
                     			<center>
                    	<div id="nationalTrends" > </div>
                        <script type="text/javascript">
                                var myChart = new FusionCharts("../../FusionCharts/Charts/MSLine.swf", "myChartId", "100%", "270", "0", "0");
                                myChart.setDataURL("../../xml/commodityReporting.php?mwaka=<?php echo $currentyear; ?>");
                                myChart.render("nationalTrends");        
                        </script>    
                    </center>  
                     		</td>
                     	</tr>
                     	
                     <tr>
                     	<td style="vertical-align: top;">
                     		<div class="section-title"><center>FCDRR Reporting Summary</center></div>	
                     		<table class="data-table" width="80%">
                     		  	<?php echo fcdrrdet(); ?>
                     		</table>
                     		
                     	</td>
                     
                     	<td style="vertical-align: top;">
                     		<div class="section-title"><center>Calibur Upload summary</center></div>	
                     		<table class="data-table" id="data-table">
                     			<thead>
                     				<tr>
                     					<th>Facility</th>
                     					<th>MFL Code</th>
                     					<th>Calibur S/N</th>
                     					<th>Last Upload</th>
                     				</tr>
                     			</thead>
                     			<tbody>
                     				<?php echo calibursummarized(); ?>
                     			</tbody>
                     		</table>
                     	</td>
                     
                     	<td style="vertical-align: top;">
                     		<div class="section-title"><center>PIMA Upload summary</center></div>	
                     		<table class="data-table" width="80%">
                     			<?php echo getpimasum(); ?>
                     		</table>
                     	</td>
                     </tr>	
                     	
                     	
                        </table>
                        </div>
				</div>
				
				
				
				
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
	
		include("../../includes/footer.php");
  ob_end_flush();
		?>	