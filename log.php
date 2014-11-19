 <?php
require_once("includes/dbConf.php");
$db = new dbConf();
//$user=getUser();
 $sta=$_GET['status'];
 $userID=$_GET['id'];
 $feedback="changes have been made";
$status=changeStatus($userID, $sta);
	
?>

<?php require_once("includes/admin.php"); ?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


 <link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
 <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
 <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
 <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                
                $(document).ready(function() {
					$('#table2').dataTable({
						"bJQueryUI":true,
						"aLengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
						
						"sScrollY": "100%"
						});
				});
                </script>
<script>
$().ready(function(){
	

	
	
});
</script>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">
			  	<div class="section-title"><center><b><strong>View System Access Details</strong></b></center></div>
                 <center>
                   <form action="User.php" method="post" name="frmUsers" >
                   <div id="message">
                   
                   
                     <table width="100%" class="display" id="table2" >
                        <thead>
                       	<tr class="even">
                        <td><strong> <center>#</center> </strong></td> 
                          <td><strong><center>Username</center></strong></td>                         
                           <td><strong><center>Level</center></strong></td>
                           <td><strong><center>Log In Time</center></strong></td>
                          <td><strong><center>Log Out Time</center></strong></td>

                        </tr>
                        </thead>
                        <tbody>
                         <?php
                         echo getUserlog();
                         
                         ?>
                       </tbody>       
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

