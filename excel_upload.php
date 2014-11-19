<?php 
session_start();
require_once("excelreader/Excel/reader.php");
include("includes/header.php");
include("includes/dbConf.php");
/** PHPExcel_IOFactory */
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel/Cell.php';
$date = date('Y-m-d');
$db=new dbConf();
$mine=$_SESSION['userID'];
$user=LastUpload($mine);

if ($_POST['btn_save']){
//check whether upload made
if(!$_FILES['file_1']['tmp_name']){
$errormsg="Error Saving, No file was uploaded";	
	}
else{	
$errormsg1=uploadExcel('file_1',$date,$mine);
@header("location:homepage.php");
 }
}


else if ($_POST['savenLeave']){
//check whether upload made
if(!$_FILES['file_1']['tmp_name']){
$errormsg="Error Saving, No file was uploaded";	
	}
else{
$errormsg=uploadExcel('file_1',$date,$mine);
}
}


?>
  
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Upload PIMA results to the system</center></div>
<?php if ($errormsg !="")
		{
		?> <div class="error"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$errormsg.'</strong>'.' </font>';

?></div>
<?php } ?>
<?php if (isset($_GET['successsave']))
		{
		?> 
		<div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$_GET['successsave'].'</strong>'.' </font>';

?></div>
<?php } ?>
             
                   
                 <form name="frm" method="post" enctype="multipart/form-data" id="frm_1">
                  <div class="clonable form" > 
                     <table width="200" border="1" class="data-table">
                     	<tr><br  />
             			
   							 <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>File to upload:</td>
   							 <td><input type="file" name="file_1" id="file_1" size="30"/></td>
                             <p>&nbsp;</p>
 						 </tr>
  						 
					</table>
                   
                  
                 </div> 
                   <div style="border:medium;background-position:center;c height:auto;">
                   <table width="200" border="1">
                     		 <tr>
    							<th colspan="2">
                                <div align="center">
                                <input name="savenLeave" type="submit"   id="btn_save_1" value="Save" class="button" />
                                <?php 
								if(isset($user)){
									if($user>=2){
								?>
    							<input name="btn_save" type="submit"   id="btn_save_1" value="Save & continue" class="button" />
								<?php
									}
								}
								?>
                                <input type="reset" name="cancel"  id="cancel_1" value="Reload page" class="button" />
                                </div>
                                </th>
  						</tr>
                    </table>
                  </div>
                   </form>
                </div>
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
		?>	
