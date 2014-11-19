 <?php

require_once("includes/dbConf.php");
$db = new dbConf();
if(isset($_POST['submit'])){
	$name=$_POST['pname'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
addPatner($name,$phone,$email);
}
	
?>

<?php require_once("includes/admin.php"); ?>
<script>
$().ready(function(){
	

	
	
});
</script>

		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">
                 <center>
                   <form action="addPartner.php" method="post" name="frmUsers" >
                   <div id="message">
                   
                   
                     <table width="350" height="269" border="1" class="data-table">
                     	<tr style="font-size:16px">
                          <td  colspan="2">
						  <center><b><strong>Add Partners</strong></b></center>
                          </td>
                        </tr>
                        <tr class="">
                        <td>Partner Name:</td>
                        <td><input type="text" placeholder="Personal Names" name="pname" class="text"/></td>
                        </tr>
                        
                       	<tr class="">
                        <td>Phone Number:</td>
                        <td><input name="phone" type="text" placeholder="254711000000" class="text"/></td>
                         
  						 </tr>
                        
                       	<tr class="">
                        <td>Email Address:</td>
                        <td><input name="email" type="text" placeholder="info@mail.com"class="text" /></td>
                         
  						 </tr>
                         
                          <tr>
    							<td><input type="reset" name="cancel" value="Reload fields" /></td>
    							<td><input type="submit" name="submit" value="Register User" /></td>
  						</tr>
                        
					</table></div>
                    </form>
                </center>
                    
					<div class="clearer">&nbsp;</div>

      </div>

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

