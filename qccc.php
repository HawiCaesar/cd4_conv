<?php
session_start();
require_once("includes/header.php");
require_once("includes/dbConf.php");
$partnerid=$_SESSION['userID'];
$db = new dbConf();
if($_GET['orderBy']){
	$order=$_GET['orderBy'];
	$sample=$_GET['sample'];
	}
	else{
	$order='DESC';
	$sample=$_POST['sampleNo'];

		}
$query=ccc($sample,$partnerid,$order);
?>
	<script type="text/javascript" src="includes/validatedevices.js"></script>
<link rel="stylesheet" href="includes/validation.css" type="text/css" media="screen" />
  
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Test results for sample # <?php echo $sample; ?> </center></div>

               
				    <table width="100%" class="data-table">
                    <tr> 
<th><small># </small></th><th><center><small> Sample Number  </small></center></th> <th><center><small> Date of Test <a href="qccc.php?orderBy=ASC&sample=<?php echo $sample; ?>"  title='Click to Sort Ascending'> <img src='img/asc.jpg' ></a> <a href="qccc.php?orderBy=DESC&sample=<?php echo $sample; ?>" title='Click to Sort Descending'> <img src='img/desc.jpg' ></a> </small></center></th><th><center><small> Result (cells/mm3) </small></center></th>
<th><center><small>Test performed by </small></center></th> <th><center><small>Action</small></center></th> 
</tr>

 <?php 
 $num=1;
 while($rs=mysql_fetch_array($query)){
 ?>                   
  <tr>
  <td><?php echo $num; ?></td>
  <td><?php echo $rs['sampleNumber']; ?></td>
  <td><?php echo date('Y M d', strtotime($rs['resultDate'])); ?></td>    
  <td><?php echo $rs['cdCount']; ?></td>  
  <td><?php echo $rs['operatorId']; ?></td>
   <td><a target='_blank' href="printout.php?id=<?php echo $sample; ?>&auto=<?php echo $rs['testID']; ?>" title="Print QCC"><img src="img/print.jpg" alt="print" width="25" height="25"/></a></td>             
   </tr>             
 <?php
 $num++;
 }
 ?></table>
                   
                
				  </div>
				
				</div>


				
				
				
			</div>

			<?php  		include("includes/sidebar.php"); ?>

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