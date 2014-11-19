 <?php
error_reporting(1);
require_once("../../includes/dbConf.php");
$usergroup = $_SESSION['userRights'];
$_SESSION['level']="report";

include ('../admin.php');


require_once("../../function.php");     
require_once("../../includes/paginator.php");



		$facQ=	mysql_query("SELECT * FROM `facility` ORDER BY `name` ASC");



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
		                                          Facility Equipment				                 		
		                                  		</center>
		                                  	</div>
		                                  	<div style="width:45%;margin-left: 30%;">
		                                  		<form name="edit_equip">
		                                  			
			                                  			<ul style="list-style-type: none;">
			                                  				<li>
			                                  					<span>Equipment Type:</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			                                  					<select>
			                                  					</select>
			                                  				</li>
			                                  				<li>
			                                  					<span>Equipment Description:</span>
			                                  					<select>
			                                  					</select>
			                                  				</li>
			                                  				<li>
			                                  					<span>Facility:</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			                                  					<select>
			                                  						<option value="-1" >*Select a Facility to add *</option>
	                                              					<?php
																		while($fac=mysql_fetch_assoc($facQ)){
	                                              					?>
	                                              					<option value="<?php echo  $fac['MFLCode']; ?>"><?php echo  $fac['name'];?></option>
	                                              					<?php
	                                              						}
	                                              					?>
			                                  					</select>
			                                  				</li>
			                                  				<li>
			                                  					<span>Serial Number:</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			                                  					<input type="text"/>
			                                  				</li>
			                                  				<li>
			                                  					<span>Status:</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			                                  					<select>
			                                  					</select>
			                                  				</li>
			                                  				<li>
			                                  					<span>Reason:</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			                                  					<input type="text"/>
			                                  				</li>
			                                  				<li>
			                                  					<input type="submit" value="Save" class="button" style="margin-left:67%;"/>
			                                  				</li>
			                                  			</ul>
		                                  		
		                                  		</form>
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