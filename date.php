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


					<div class="section-title"><center>Upload Facility Results.</center></div>

				  <div class="post-date"></div>

					<div class="post-body">
				  </div>
				
				</div>
				<div class="post">
                  <div style="height:auto;" id="formbuttons">
                   <table width="200" border="1" class="data-table">
                     	<tr>
                        <td><input type="button" name="add" value="Add File" id="clonetrigger"/></td>
                        <td>&nbsp;</td>
                        </tr>
                    </table>
                  </div>
                   
                  <form name="frm" method="post" enctype="multipart/form-data" id="frm_1">
                  <div class="clonable form" > 
                     <table width="200" border="1" class="data-table">
                     	<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        </tr>
                        
             			
   							 <td>File to upload:</td>
   							 <td><input type="file" name="file_1" id="file_1" size="30"/></td>
 						 </tr>
 						 <tr>
  							  <td>&nbsp;</td>
   							  <td>&nbsp;</td>
  						 </tr>
  						 <tr>
   								<td>&nbsp;</td>
   								<td>&nbsp;</td>
  						 </tr>
  					
					</table>
                
               </div> 
                   <div style="background-color:#09F;border:medium;background-position:center;clear:none;max-width:50%; height:auto;">
                   <table width="200" border="1">
                     		 <tr>
    							<td><input type="reset" name="cancel"  id="cancel_1" value="Reload page" /></td>
    							<td><input name="btn_save" type="submit"   id="btn_save_1" value="Save" /></td>
  						</tr>
                    </table>
                  </div>
                   </form>
                </div>     
	
				<div class="content-separator"></div>
				
			

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