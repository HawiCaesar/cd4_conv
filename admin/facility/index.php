 <?php
 @session_start();
 $_SESSION['page']="facility";
require_once("../../includes/dbConf.php");
$_SESSION['level']="facility";
//$db = new dbConf();
include ('../admin.php');
?>
<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="../../bootstrap/js/jquery.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>


 <link href="../../DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
 <link href="../../DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
 <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
 <script type="text/javascript" src="../../DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                
                $(document).ready(function() {
					$('.data-table').dataTable({
						"bJQueryUI":true,				
		                 "bProcessing": true,
		                 "bServerSide": true,
		                 "sAjaxSource": "facility.php",
						"sScrollY": "100%"
						});
				});
                </script>
		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
	<?php
$msg=$_GET['successdel'];
 if ($msg !="")
        {
        ?> 
        <table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
        
echo  '<strong>'.' <font color="#666600">'.$msg.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>

	<?php
$msg1=$_GET['success'];
 if ($msg1 !="")
        {
        ?> 
        <table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
        
echo  '<strong>'.' <font color="#666600">'.$msg1.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
<?php
$err=$_GET['errdel'];
 if ($err !="")
        {
        ?> 
        <table   >
  <tr>
    <td style="width:auto" ><div class="error"><?php 
        
echo  '<strong>'.' <font color="#666600">'.$err.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
			  	<div class="section-title" style="width: 100%;"><center><b><strong>Facility Details</strong></b></center></div>
                 <center>
                   <form action="User.php" method="post" name="frmUsers" >
                     <table width="100%"  border="1" class="data-table">
                     	<thead>
                       	<tr >
                       	 <th nowrap><center><strong>#</strong></center></th>
                          <th nowrap><center><strong>MFL Code</strong></center></th>
                          <th nowrap><center><strong>Facility Name</strong></center></th>
                          <th nowrap><center><strong>District</strong></center></th>
                           <th nowrap><center><strong>County</strong></center></th>
                          <th nowrap><center><strong>Level</strong></center></th>
                          <th nowrap><center><strong>Central Site</strong></center></th>
                          <th nowrap><center><strong>Distance</strong></center></th>
                          <th nowrap><center><strong>Type</strong></center></th>
                          <th nowrap><center><strong>Partner</strong></center></th>
                          <th nowrap><center><strong>Reset Pass</strong></center></th>
                          <th nowrap bSortable="false"><center><strong>Rollout status</strong></center></th>
                           <th nowrap bSortable="false"><center><strong>Action</strong></center></th>
                        </tr>
                        </thead>  
                        <tbody>
                        	
                        </tbody>    
					</table>
                    </form>
                </center>
                    
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