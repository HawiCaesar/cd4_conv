 <?php
require_once("includes/dbConf.php");
$db = new dbConf();
 $usergroup = $_SESSION['userRights'];
if ($_SESSION['userRights']=='5')
{		
		include("includes/programheader.php");
	
}
else if ($_SESSION['userRights']=='2')
{			
		include("includes/admin.php");
		//echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
}
else if ($_SESSION['userRights']=='1')
{			
		include("includes/header.php");
}
else {
		include("includes/commodityheader.php");
			
}



require_once("function.php");     
require_once("includes/paginator.php");







//change equipment status

if ($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST["equipment"])){
			$equipment=$_POST['equipment'];
			$status=$_POST['Functionality'];
			
			$sqlEq="Update `facilityequipments` SET `status`=$status where `ID`=$equipment";
			
			mysql_query($sqlEq);
			
			}
		}



$q=mysql_query("SELECT  `facilityequipments`.`ID` as equipment,
						`facilityequipments`.`status`,
						`facility`.`MFLCode`,
						`facility`.`name`,
						`equipments`.`description`,
						`countys`.`name` AS countyName, 
						`equipmentcategories`.`description` AS category
				From `facilityequipments` 
				LEFT JOIN facility ON 
						`facilityequipments`.`facility`=`facility`.`AutoID`
				LEFT JOIN `equipments` ON
						`facilityequipments`.`equipment`=`equipments`.`ID`
					LEFT JOIN `districts` ON
							`facility`.`district`=`districts`.`ID`
						LEFT JOIN `countys` ON 
								`districts`.`county`=`countys`.`ID`
					LEFT JOIN `equipmentcategories` ON
							`equipments`.`category`=`equipmentcategories`.`ID`
				
 				ORDER BY `countys`.`name` ASC");


 
?>
 				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <script src="bootstrap/js/jquery.js"></script>
                <script src="bootstrap/js/bootstrap.min.js"></script>
                
				<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
                <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
               <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
                
               
 
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.account.options[form.account.options.selectedIndex].value;
self.location='equipment.php?account=' + val  ;
}

$().ready(function() {
	$('#data-table').dataTable({
		 	"bJQueryUI":true,
			"aaSorting": [[ 1, "asc" ]],
			//"bSort":false,
		  	//"bPaginate":false,
			//"sPaginationType":"full_numbers",
		 	"sScrollY": "250px",
		  	//"bFilter": false,
		  	//"bInfo": false
			});
	
	$("#sampleNo").autocomplete("getequipment.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#equipmentname").result(function(event, data, formatted) {
		$("#ID").val(data[1]);
	});
	
});
</script>



			  
			 <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="center" id="main-center">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>
                 Equipment List
                 </center></div>
                 <table class="data-table" id="data-table">
  <thead> <th><center><small> # </small></center></th> 
	<th><center><small>County</small></center></th> 
<th><center><small>MFLCode</small></center></th> 
<th><center><small>Facility </small></center></th> 
<th><center><small>Equipment</small></center></th>
<th><center><small>Equipment Type</small></center></th>
<th><center><small>Status</small></center></th>
<th></th>

</thead>





 <?php  
$num=1;

while($result=mysql_fetch_assoc($q)){
	?>
	<tr>
<td> <center><small> <?php  echo $num; ?></small></center> </td>
<td> <center><small> <?php  echo $result['countyName']; ?></small></center> </td>
<td> <center><small> <?php  echo $result['MFLCode']; ?></small></center> </td>
<td> <center><small> <?php if($result['name']!=""){ echo $result['name'];} else{ 
	$fac=mysql_query("SELECT * FROM facility where AutoID='".$result['facility']."'");
	while($rsFac=mysql_fetch_assoc($fac)){
		echo $rsFac['name'];		
		}
} ?></small></center> </td>
<td> <center><small> <?php if($result['description']!=""){  echo $result['description'];} else{ echo $result['description'];}?></small></center> </td>
<td> <center><small> <?php  
		echo $result['category']; 
		
		?></small></center> </td>
<td> 
	<center>
		<small> 
			<?php  	if( $result['status']==1){ echo "Functional";}
					if( $result['status']==2){ echo "Boken Down";}
					if( $result['status']==3){ echo "Obsolete";}
			 ?>            
            <?php 
				if($_SESSION['userRights'] == 5||$_SESSION['userRights']==2||$_SESSION['userRights']==1){
			echo '<a href="#edit_'.$result['equipment'].'" data-toggle="modal" class="menuitem submenuheader" style="width:1170px"> <img src="img/edit.png"></img>Edit</a>';
			
				}
			?>
        </small>
   	</center>
                         
</td>
<td>
	<div style="margin-right:1%" style="height:50px" align="center" id="edit_<?php echo $result['equipment'] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:70%">
		<div class="modal-header" style="background:#FCFCFC" >
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        	<br/>
            <br/>
            <b>Device:</b><?php echo $result['description'];?> &nbsp;&nbsp;&nbsp;&nbsp; <b>Facility:</b><?php 
				if($result['name']!=""){ echo $result['name'];} else{ 
					$fac=mysql_query("SELECT * FROM facility where AutoID='".$result['facility']."'");
					while($rsFac=mysql_fetch_assoc($fac)){
						echo $rsFac['name'];		
						}
					}
			?>  
        </div>  
        <div class="modal-body">
        	<form name="Activation_<?php echo $result['equipment'] ?>" method="post" action="equipment.php">
            	<div class="left" style="margin-left:12%"><input type="radio" <?php  if( $result['status']==1){ echo "Checked";} ?> name="Functionality" value="1"> Functional</input></div>
                <br />
                <br />
                <div class="left" style="margin-left:12%"><input type="radio" <?php  if( ($result['status']==2)){ echo "Checked";} ?> name="Functionality" value="2"> Broken Down</input></div>
                <br />
                <input type="hidden" name="equipment" value="<?php echo $result['equipment']; ?>"/>
                <br />
                <div class="left" style="margin-left:12%"><input type="radio" <?php  if( ($result['status']==3)){ echo "Checked";} ?> name="Functionality" value="3"> Obsolete</input></div>
                
                <div class="right" style="margin-right:12%"><input type="submit" name="submit" value="Commit" class="button" style="height:25px" /></div>
            </form>
        
        </div>
        <div class="modal-footer">
<div class="right"> &copy; <?php echo date('Y');?> NASCOP </div>
<div class="clearer">&nbsp;</div>
</div>

</div>

</div>      
    </div>
</td>
</tr>
<?php 
$num++;
}
?>
</table>


</form> 

<!-- hidden inline form -->

</div>
				
				</div>


				
				
				
			</div>

			<?php  		include("includes/sideprogram.php"); ?>

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