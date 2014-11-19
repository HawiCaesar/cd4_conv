<?php
require_once("includes/admin.php");
require_once("includes/dbConf.php");
$db = new dbConf();

//get devices on formload

getDevice();
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">


	  <div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">


					<div class="section-title"><center>Registered Facilities</center></div>
			  </div>
			  <div class="post">
                   <form action="facility.php" method="post" name="frmUser" >
                     <table  class="data-table">
                     
                     <tr >
                     <th>Facility Number</th>
                     <th>Facility Name</th>
                     <th>Date modified</th>
                     <th>Date Added</th>
                     <th>Modify</th>
                     </tr>
                          		  <?php
								$resulArr=getFacility();
                                foreach($resulArr as $myArr){
							  ?>                                               
                     <tr >
                     <td><?php echo $myArr['facilitycode']; ?></td>
    				 <td><?php echo $myArr['facilityName']; ?></td>
                     <td><?php echo $myArr['telephone2']; ?></td>
                     <td><?php echo $myArr['ftype']; ?></td>
                     <td><a href="editfacility.php/id?=<?php echo $myArr['facilityID']; ?>">Change facility details</a></td>
                     
  					 </tr>
						<?php } ?>
					</table>
                    </form>
                   
                 </div>
                    
					<div class="clearer">&nbsp;</div>


				<div class="content-separator"></div>
				
			</div>

			<?php  	
			
				include("includes/sideAdmin.php"); ?>

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
  ob_end_flush();
		?>	