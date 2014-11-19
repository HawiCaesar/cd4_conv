 <?php

require_once("includes/dbConf.php");
$db = new dbConf();
 $sta=$_GET['status'];
 $userID=$_GET['id'];
 $feedback="changes have been made";
$status=changeStatus($userID, $sta);
	
?>

<?php require_once("includes/admin.php"); ?>
<script>
$().ready(function(){
	

	
	
});
</script>
<p>&nbsp;</p>
		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">
			  	<div class="section-title"><center><b><strong>View User Details</strong></b></center></div>
                 <center>
                   <form action="User.php" method="post" name="frmUsers" >
                   <div id="message">
                   
                   
                     <table width="350"  border="1" class="data-table">
                       	<tr >
                          <td><strong>Username</strong></td>
                          <td><strong>Phone Number</strong></td>
                          <td><strong>Partner</strong></td>
                           <td><strong>Set status</strong></td>
                           <td><strong>Change Password</strong></td>
                        </tr>
                        
                         <?php
							  //calls function with users
                                foreach(getUser() as $myArr => $value){
									
									$id=$value['userGroupID'];
									$pid=$value['partnerID'];
									if($id!=2){
							  ?>
 						 <tr class="even">
  							  <td> <?php echo $value['userName'];  ?></td>
                              <td>  <?php $phone=getSpecificPartner($pid); 
							  				echo $phone[2];
							  ?>
                              				
                              </td>
                              
                              
                              <td> <?php echo $phone[1]; ?>
                              </td>
                              
                              
                              <td> <?php 
							     if($value['status']==1){
								 ?>  <a class="changeStatus" href="users.php?id=<?php echo $value['userID']; ?> & status=1">Disable account</a>
                                 <?php
									 }
								 else{
								  ?> 
                                     <a class="changeStatus" href="users.php?id=<?php echo $value['userID']; ?> & status=0">Enable account</a>
                                  <?php } ?>
							   </td>
                               
                               
                              <td> <a class="changePassword" href="users.php?id='<?php echo $value['userID']; ?>'">change password</a></td>
  						 </tr>
                         <?php
									}
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

