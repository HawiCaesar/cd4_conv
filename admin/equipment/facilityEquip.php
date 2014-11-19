<?php
require_once("../../includes/dbConf.php");
include ('../admin.php');


require_once("../../function.php");     
require_once("../../includes/paginator.php");




error_reporting(1);

 //$db = new dbConf();
$usergroup = $_SESSION['userRights'];
$_SESSION['level']="equipment";



//get Equipment	

		
		$equipQ=mysql_query("SELECT   `equipments`.`description` as equip,
							`equipmentcategories`.`description` as type
						FROM `equipments`
						LEFT JOIN `equipmentcategories`
							ON `equipments`.`category`=`equipmentcategories`.`ID`
							");
		$equiTypeQ=	mysql_query("SELECT * FROM `equipmentcategories`");
		$equiTypeQ1=mysql_query("SELECT * FROM `equipmentcategories`");
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
            	
 <script>
	$().ready(function() {
    	$("#equipment").hide();
    	$("#serialNm").hide();
    	$("#printerserial").hide();
    
    
     $('#category').change(function(){
		var val=$(this).val();
	
		$.post( "test.php", { id: val} ).done(function(data) {
			$('#equiptype').empty().append(data);
  });
			 
    	if(val==-1){
    		$("#equipment").hide();
    	    $("#serialNm").hide();
    	    $("#printerserial").hide();
		}else{
			$("#equipment").show();
		}
			
	
    	var options ='<option value="">*Select an Equipment Type*</option>';
    	for (i = 0; i < result.length; ++i) { 
    				
    		if(result[i]["id"]==val){
    			options += '<option value="'+result[i]["id"]+'">'+result[i]["desc"]+'</option>';
    		}
    		
		}
		$("#equiptype").load(options);
	
     });
     
      $('#equiptype').change(function(){
		var val=$(this).val();
		
		if(val==17){
    	    $("#serialNm").show(); 
		}else{
    	    $("#serialNm").hide();
		}
     });
     });
</script>

<script>
 
	$().ready(function() {
		$("#equipment1").hide();
		$("#equipmentserial1").hide();
    	
     $('#category1').change(function(){
		var val=$(this).val();
	
		$.post( "test.php", { id: val} ).done(function(data) {
			$('#equiptype1').empty().append(data);
  });
		
		if(val==-1){
    		$("#equipment1").hide();
    	   
		}else{
			$("#equipment1").show();
		} 
		
    	var options ='<option value="">*Select an Equipment Type*</option>';
    	for (i = 0; i < result.length; ++i) { 
    				
    		if(result[i]["id"]==val){
    			options += '<option value="'+result[i]["id"]+'">'+result[i]["desc"]+'</option>';
    		}
    		
		}
		$("#equiptype1").load(options);
	
     });
     $('#equiptype1').change(function(){
		var val=$(this).val();
		
		if(val==17){
    	    $("#equipmentserial1").show(); 
		}else{
    	    $("#equipmentserial1").hide();
		}
     });
     });
</script>
<!---$("#equipment").hide();
    	    $("#equipmentserial").hide();
    	    $("#printerserial").hide();
		}else{
			$("#equipment").show();
    	    $("#equipmentserial").show();
    	    $("#printerserial").show();
		}--->
				<div class="main" id="main-two-columns" valign="top" class="xtop">
				  	<div class="left" id="main-left">
				       	<div class="post">
				  			<div class="post-body">				     			
				                <!--  adding code here -->				              
				                <table width="90%" border="1" >
                                   	<tr >
                                   		<td class="fBig">
                                        	<div >
                                              	<div class="section-title">
                                                	<center>
                                                      Add Equipment To Facility				                 		
                                              		</center>
                                              	</div>                                              	
                                          	</div>
                                          	
                                          		<form action="insert.php" method="post">
	                                              		<ul style="list-style-type: none;">
	                                              			<div id="fac">
	                                              				Facility:  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                                              				<select id="facility" name="facility" style="width: 50%;">
	                                              					<option value="-1" >*Select a Facility to add *</option>
	                                              					<?php
																		while($resAddFac=mysql_fetch_assoc($facQAdd)){
	                                              					?>
	                                              					<option value="<?php echo  $resAddFac['MFLCode']; ?>"><?php echo  $resAddFac['name'];?></option>
	                                              					<?php
	                                              						}
	                                              					?>
	                                              				</select> 
	                                              			</div>
	                                              			
	                                              			<div id="cat">
	                                              				Equipment Category: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                                              				<select id="category" name="category" style="width: 50%;">
	                                              					<option value="-1" >*Select an Equipment Category*</option>
                                              					<?php
																	while($result=mysql_fetch_assoc($equiTypeQ)){
                                              					?>
                                              					<option value="<?php echo  $result['ID']; ?>"><?php echo  $result['description'];?></option>
                                              					<?php
                                              						}
                                              					?>
	                                              				</select>
	                                              			</div>
	                                              			
	                                              			<div id="equipment">
	                                              				Equipment Type: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                                              				<select  id="equiptype" name="equiptype" style="width: 50%;">
	                                              					
                                              					
	                                              				</select>
	                                              			</div>
	                                              			
	                                              			<div id="serialNm" class="input-group" style="width: 100%;padding:4px;">
							                                 <span class="input-group-addon" style="width: 50%;">Equipment Serial:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
							                                 <input name="equipmentserial" style="width: 45%;" class="textfield form-control" type="text" />
						                                    </div>
	                                              				
	                                              			<div id="printerserial" class="input-group" style="width: 100%;padding:4px;">
							                                 <span class="input-group-addon" style="width: 50%;">Printer Serial:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
							                                 <input name="printerserial" style="width: 56%;" class="textfield form-control" type="text" />
						                                    </div>
	                                              			
	                                              			<li>
	                                              				<input  name="submit" type="submit" value="Add" class="button" style="margin-left: 80%;"/>
	                                              			</li>
	                                              		</ul>
	                                             </form>
                                        </td>
                                        
                                        

                                    	<td class="fBig">
                                        	<div >
                                              	<div class="section-title">
                                                	<center>
                                                      Remove Equipment From Facility			                 		
                                              		</center>
                                              	</div>
                                              	<div>
                                              		<form action="delete.php" method="post">
	                                              		<ul style="list-style-type: none;">
	                                              			<li>
	                                              				Facility: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                                              				<select style="width: 50%;">
	                                              					<option value="-1" >*Select a Facility*</option>
	                                              					<?php
																		while($result=mysql_fetch_assoc($facQ)){
	                                              					?>
	                                              					<option value="<?php echo  $result['MFLCode']; ?>"><?php echo  $result['name'];?></option>
	                                              					<?php
	                                              						}
	                                              					?>
	                                              				</select> 
	                                              			</li>
	                                              			<li>
	                                              				Equipment Category: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                                              				<select id="category1" style="width: 50%;"name="category">
	                                              					<option value="-1" >*Select Equipment Category*</option>
                                              					<?php
																	while($result=mysql_fetch_assoc($equiTypeQ1)){
                                              					?>
                                              					<option value="<?php echo  $result['ID']; ?>"><?php echo  $result['description'];?></option>
                                              					<?php
                                              						}
                                              					?>
	                                              				</select>
	                                              			</li>
	                                              			<div id="equipment1">
	                                              			<li>
	                                              				Equipment Type: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                                              				<select required id="equiptype1" style="width: 50%;">
	                                              				
	                                              				</select>
	                                              			</li>
	                                              			</div>
	                                              			<div id="equipmentserial1" class="input-group" style="width: 100%;padding:4px;">
							                                 <span class="input-group-addon" style="width: 50%;">Equipment Serial:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
							                                 <input name="serial" style="width: 45%;" class="textfield form-control" type="text" />
						                                    </div>
	                                              			<li>
	                                              				<!-- <input type="submit" value="Detatch" class="button" style="margin-left: 60%;"/> -->
	                                              				<input type="submit" value="Remove" class="button" style="margin-left: 75%;"/>
	                                              			</li>
	                                              		</ul>
	                                            </form>
                                              	</div>
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