 <?php
require_once("includes/dbConf.php");

$db = new dbConf();
require_once("includes/programheader.php");
 $counties=selectedcounties();

 ?>


			  
			 <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Selection Summary  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                 <a href="countysummary.php"><img src="img/back.gif" /></a>	</center></div>
                 <table border="1" width="50%" class="data-table">
                 	<tr><td width="40%"># of sites selected</td><td width="15%"><center><?php echo sitesSel(); ?></center></td>
                 		 <td rowspan="3" width="45%" style="vertical-align: top;"> <b>NB: Click to download Excel Summary of selected facilities</b><br />
                 		 	<center><a href="selectedfacexcel.php"><img src="img/excel.jpg" /></a></center>
                 		 </td></tr>
                 	<tr><td># of Devices</td><td><center>44</center></td></tr>
                 	<tr><td># of tests</td><td><center><?php echo patentloadSel(); ?></center></td></tr>
                 	</table>
       <div class="section-title"><center>County Summary</center></div>          
		<table class="data-table">
			<tr><th><center><small>County Name</small></center></th><th><center><small>Sites per County</small></center></th><th><center><small>Patients per County</small></center></th></tr>
  <?php 
foreach ($counties as $k=>$a){
	?>
<tr>
	 <td><center><small> <?php echo getCountyName($a[ID]); ?> </small></center></td>
	 <td><center><small> <?php selectedfaccountiesnum($a[ID]); ?> </small></center></td>
     <td><center><small> <?php patentloadSelCounty($a[ID]); ?> </small></center></td></tr>
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