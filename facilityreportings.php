
<?php
@session_start();
if(!isset($_SESSION['username'])){
	echo "<script>";
		echo "window.location.href='facilitylogin.php'";
	echo "</script>";
}
include ("includes/admin.php");
require_once ("includes/dbConf.php");
require_once ("includes/functions/fcdrrlistf.php");
$db = new dbConf();
?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
<link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">
                $(document).ready(function() {
					$('.table211').dataTable({
						"sScrollY": "100%",
						"sScrollX": "100%"
						});
				});
</script>
	 
<p>&nbsp;</p>
<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
				<div class="post">
					<p>&nbsp;</p>
					<?php
$msg=$_GET['success'];
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
			  	<div class="section-title"><center><b><strong>Previously Submitted FCDRR Lists</strong></b></center></div>
      <table width="90%"  class="data-table" cellpadding="4" cellspacing="10">
      	<thead>
      		<tr>
      			<th rowspan="2"> Facility Name</th>
      			<th rowspan="2"> FCDRR Details</th>
      			<th colspan="2"><center>Download Action </center></th>
      		</tr>
      		<tr>
      			<th>Excel</th><th>PDF</th>
      		</tr>
      	</thead>
      	<tbody>
          <?php
              echo fcdrrlists();	
          ?>
          </tbody>
      </table>
  
					<div class="clearer">&nbsp;</div>

      </div>

				<div class="content-separator"></div>
				
			</div>

			<?php  	
			echo "<br />";
			
				include("includes/sideadmin.php"); ?>

			<div class="clearer">&nbsp;</div>

  
   </div>   

</div>
<div class="clearer">&nbsp;</div>

<?php
    
        include("includes/footer.php");
        
        ?>