 <?php

require_once("includes/dbConf.php");
$db = new dbConf();
$patna=getPartner();

	
?>

<?php require_once("includes/admin.php"); ?>
<script>
$().ready(function(){
	

	
	
});
</script>
<p>&nbsp;</p><p>&nbsp;</p>
		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">
			  	<div class="section-title"><center><b><strong>View User Details</strong></b></center></div>
                 <center>
                   <form action="User.php" method="post" name="frmUsers" >
                   <div id="message">
                   
                   
                     <table width="350" height="269" border="1" class="data-table">
                        
                       	<tr>
                          <td><strong>Number</strong></td>
                          <td><strong>Name</strong></td>
                          <td><strong>Phone Number</strong></td>
                           <td><strong>Email Address</strong></td>
                           <td><strong>Add Details</strong></td>
                        </tr>
                        
                         <?php
							  //calls function with partners
							  $num=1;
                                foreach($patna as $myArr => $value){
							  ?>
 						 <tr class="even">
  							  <td> <?php echo $num; 
							  $num++;
							  ?></td>
                              <td> <?php echo $value['name']; ?></td>
                          	  <td> <?php echo $value['phoneNumber']; ?>
                              </td>
                              
                              
                              <td> <?php echo $value['email']; ?></td>
                               
                               
                              <td> <a class="editPatna" href="editpatna.php?id=<?php echo $value['ID']; ?>&email=<?php echo $value['email']; ?>&phone=<?php echo $value['phoneNumber']; ?>&name=<?php echo $value['name']; ?>">Edit Partner details</a></td>
  						 </tr>
                         <?php
								}
                         ?>
                              
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

