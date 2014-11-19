<?php
error_reporting(1);
require_once("../../includes/dbConf.php");

 //$db = new dbConf();
$usergroup = $_SESSION['userRights'];
$_SESSION['level']="equipment";

include ('../admin.php');


require_once("../../function.php");     
require_once("../../includes/paginator.php");


//get Equipment
		
		$equipQ=mysql_query("SELECT   `equipments`.`description` as equip,
							`equipmentcategories`.`description` as type
						FROM `equipments`
						LEFT JOIN `equipmentcategories`
							ON `equipments`.`category`=`equipmentcategories`.`ID`
							");
		$equiTypeQ=	mysql_query("SELECT * FROM `equipmentcategories`");
		$facQ 	=	mysql_query("SELECT * FROM `facility` ORDER BY `name` ASC");
		$facQAdd=	mysql_query("SELECT * FROM `facility` ORDER BY `name` ASC");


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
						 	"sScrollY": "330px",
						  	"bFilter": false,
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
                                	<tr >
                                    	<td class="">
                                        	<div >
                                              	<div class="section-title">
                                                	<center>
                                                      All Equipment				                 		
                                              		</center>
                                              	</div>
                                              	<table class="data-table" id="data-table">
                                              		<thead>
                                              			<th><center><small>#</small></center></th> 
                                              			<th><center><small>Equipment</small></center></th> 
                                              			<th><center><small>Type</small></center></th> 
                                              			<th><center><small>Action</small></center></th> 
                                              		</thead>
		                                            <?php
														$num=1;
														while($result=mysql_fetch_assoc($equipQ)){
		                                            ?>
		                                            <tr>
		                                            	<td> <center><small> <?php  echo $num; ?></small></center> </td>
		                                            	<td> <center><small> <?php  echo $result['equip']; ?></small></center> </td>
		                                            	<td> <center><small> <?php  echo $result['type']; ?></small></center> </td>
		                                            	<td class=" ">
															<a href="" title="Edit Equipment">
																<img src="../../img/edit.png">
															</a>
																|
															<a href="" title="Delete Equipment">
																<img src="../../img/delete.png">
															</a>
														</td>
		                                            </tr>
		                                            <?php 
		                                            	}
		                                            ?>
	                                           	</table>
                                          	</div>
                                        </td>
                                        <td class="fBig">
                                        	<div >
                                              	<div class="section-title">
                                                	<center>
                                                      Add Equipment				                 		
                                              		</center>
                                              	</div>
                                              	<form>
                                              		<ul style="list-style-type: none;">
                                              			<li>
                                              				Type:  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                              				<select style="width: 70%;">
                                              					<option value="-1" >*Select an Equipment Type*</option>
                                              					<?php
																	while($result=mysql_fetch_assoc($equiTypeQ)){
                                              					?>
                                              					<option value="<?php echo  $result['ID']; ?>"><?php echo  $result['description'];?></option>
                                              					<?php
                                              						}
                                              					?>
                                              				</select> 
                                              			</li>
                                              			<li>
                                              				Description: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                              				<input type="text" style="width: 67%;"/>
                                              			</li>
                                              			<li>
                                              				<input type="submit" value="Add Equipment" class="button" style="margin-left: 65%;"/>
                                              			</li>
                                              		</ul>
                                              </form>
                                          	</div>
                                        </td>
                                    </tr >                                    
                                	                         	                               	
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
