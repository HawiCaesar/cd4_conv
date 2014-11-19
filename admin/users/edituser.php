 <?php
 @session_start();
 $_SESSION['page']="users";
require_once("../../includes/dbConf.php");
$_SESSION['level']="user";

include ('../admin.php');
if(isset($_POST['submit'])){
	
}
?>
<div class="main" id="main-two-columns">
<?php
$user=$_GET['id'];
$arr=getspecificuser($user);
?>
		<div class="left" id="main-left">

			  	<div class="section-title" style="width: 100%;"><center><b><strong>Edit User Details</strong></b></center></div>
				    <form id="customForm" method="post" action="" autocomplete="Off">
                    <table style="width:100%"  border="0"  cellpadding="0" cellspacing="0" class="data-table"  >
                                             
                       	<tr>
                          <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>UserName</td>
                         <td>
                            <input type="text" size="30"  name="username" id="username" class="text" value="<?php echo $arr[0]; ?>"/>
                         </td>
                        </tr>
                         <tr>
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Phone Number</td>
   							<td><input type="text" name="phone" id="phone" size="30"  class="text" value="<?php echo $arr[3]; ?>" />
  						 </tr>
					    <tr>
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>Email Address</td>
   							<td><input type="text" name="email" id="email" size="30"  class="text" value="<?php echo $arr[4]; ?>" />
  						 </tr>
  						 
  				 <tr >
   							<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" ><span class="mandatory">*</span>User Level</td>
   							<td><select name="level">
   								<?php
   								$sql="SELECT * FROM  `usergroup` ";
								$quer=mysql_query($sql) or die();
							   while ($rs=mysql_fetch_array($quer)) {
								   if ($arr[1]==$rs['userGroupID']) {
									echo '<option value="'.$rs['userGroupID'].'" selected="selected>'.$rs['usergroupName'].'</option>';   
								   } else {
									echo '<option value="'.$rs['userGroupID'].'">'.$rs['usergroupName'].'</option>';   
								   }
								   
							   }
   								?>
   							</select>
   								
  						 </tr>		 
					   
  						
  						 <tr>
    							 <th colspan="2">  
								 <div align="center">
				 <input name="submit" id="saveonly" type="submit" class="button" value="Update User Details" />
		  	    		  	    <input name="btnCancel" type="button" id="btnCancel" value="Cancel Edit" onClick=window.location.href="index.php" class="button"></div>
				</th>
    							
  						</tr>
					</table>
                    </form>
                   
			<div class="clearer">&nbsp;</div>

      

				<div class="content-separator"></div>
				
			</div>

			<?php  	
			
				include("../../includes/sideAdmin.php"); ?>

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
  ob_end_flush();
		?>	