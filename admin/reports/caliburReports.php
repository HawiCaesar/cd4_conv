 <?php
error_reporting(1);
@session_start();
require_once("../../includes/dbConf.php");

$usergroup = $_SESSION['userRights'];
$_SESSION['level']="reports";

include ('../admin.php');


require_once("../../function.php");     
require_once("../../includes/paginator.php");
require_once ("../../includes/functions/fcdrrlistf.php");


		



?>
 				<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <script src="../../bootstrap/js/jquery.js"></script>
                <script src="../../bootstrap/js/bootstrap.min.js"></script>
                
				<link href="../../DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
                <link href="../../DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
               	<script type="text/javascript" src="../../DataTables/media/js/jquery.dataTables.js"></script>
               	<SCRIPT language=JavaScript>
               	$().ready(function() {
					$('#data-table').dataTable({
						 	"bJQueryUI":true,
							"aaSorting": [[ 1, "asc" ]],
							//"bSort":false,
						  	"bPaginate":false,
							//"sPaginationType":"full_numbers",
						 	"sScrollY": "130px",
						  	//"bFilter": false,
						  	//"bInfo": false
						  	
						
							});					
				});
				</script>
            	<style type="text/css">
            		.fBig{
            			height:210px;
            			vertical-align:top;
            			width: 55%;
            		}
            		.fSmall{
            			height:90px;
            			width: 45%;
            		}
            	</style>
				<div class="main" id="main-two-columns" valign="top" class="xtop">
				  	<div class="left" id="main-left">
				       	<div class="post">
				  			<div class="post-body">				     			
				                <!--  adding code here -->				              
				                <table width="90%" border="1" >	
				                	<tr>
				                		<td colspan="2">
				                			<div class="section-title">
		                                      	<center>
		                                         	Previously Submitted FCDRR				                 		
		                                  		</center>
		                                  	</div>
		                                  	<div>
		                                  		<table width="90%"  class="data-table" cellpadding="4" cellspacing="10">
											      	<thead>
											      		<tr>
											      			<th rowspan="2"> Facility Name</th>
											      			<th rowspan="2"> FCDRR Details</th>
											      			<th colspan="2"><center>Download Action </center></th>
											      		</tr>
											      		<tr>
											      			<th>Excel</th><th>PDF</th>
											      		</tr>
											      	</thead>
											      	<tbody>
											          <?php
											              echo fcdrrlistsAdmin();	
											          ?>
											        </tbody>
											     </table>
		                                  	</div>
				                		</td>
				                	</tr>
				                </table>
				            </div>
				        </div>
					</div>	
					<?php
						include("../../includes/sideAdmin.php"); 
					?>				
				</div>					
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
				include("../../includes/footer.php");
			?>	