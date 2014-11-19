<?php
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
if(!isset($_POST['device'])){
	$logoutGoTo="homepage.php";
	 @header("Location: $logoutGoTo");

	
	}
	else{
//get devices searched
$dev=$_POST['device'];

getSearchDevice($dev);
	}
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">


	  <div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">


					<div class="section-title"><center>Registered Devices</center></div>

				  <div class="post-date"></div>

					<div class="post-body">
<h3>&nbsp;</h3>
				  </div>
				
			  </div>
			  <div class="post">
                 <center>
                   <form action="device.php" method="post" name="frmUser" >
                     <table width="100%" border="1" class="data-table">
                     
                     <tr>
                     <th>Device Number</th>
                     <th>Facility assigned</th>
                     <th>Date modified</th>
                     <th>Date Added</th>
                     <th>Modify</th>
                     </tr>
                          		  <?php
								$resulArr=getDevice();
                                foreach($resulArr as $myArr){
							  ?>                                               
                     <tr>
                     <td><?php echo $myArr['deviceNumber']; ?></td>
    				 <td><?php echo $myArr['facilityID']; ?></td>
                     <td><?php echo $myArr['dateModified']; ?></td>
                     <td><?php echo $myArr['dateAdded']; ?></td>
                     <td><a href="editDevice.php/id?=<?php echo $myArr['deviceID']; ?>">Change device details</a></td>
                     
  					 </tr>
						<?php } ?>
					</table>
                    </form>
                </center>
                    
					<div class="clearer">&nbsp;</div>

      </div>

				<div class="content-separator"></div>
				
			</div>

			<?php  	
			
				include("includes/sidebar.php"); ?>

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