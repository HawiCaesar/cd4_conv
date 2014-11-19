 <?php
require_once("includes/dbConf.php");

$db = new dbConf();
require_once("includes/programheader.php");
 $counties=selectedcounties();

 ?>


	 <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p>		  
			 <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
       <div class="section-title"><center>County Summary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="summarizedcounty.php">View Summary</a></center></div>          
		<table class="data-table" width="60%">
  <?php 
foreach ($counties as $k=>$a){
	?>
<tr> <th colspan="6"><center><small> <?php echo getCountyName($a[ID]); ?> </small></center></th></tr>
<tr class="oddrow"> <th><center><small>MFL Code</small></center></th><th><center><small>Facility Name</small></center></th>
<th><center><small>Distance</small></center></th><th><center><small>Total Patients</small></center></th>
 <th><center><small>Need Per day</small></center></th><th><center><small>Rank</small></center></th></tr>
<?php selectedfaccounties($a[ID]); ?>

<?php	
}
?>

</table>


</form> 

<!-- hidden inline form -->

</div>
				
				</div>


				
				
				
			</div>

			<?php  		include("includes/sideprogram.php"); ?>

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