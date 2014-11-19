<?php
require_once("includes/dbConf.php");

$db = new dbConf();
require_once("includes/programheader.php");
if(isset($_GET['id'])){
$ranker=$_GET['id'];
}
else{
$ranker=2;	
}
 $facilities=selectionNeed2($ranker);

 ?>


  <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p>
<div class="main" id="main-two-columns" valign="top" class="xtop">

<div class="left" id="main-left">

<div class="post">
<div class="post-body">
                 <div class="section-title"><center>Facilities selected for Equipment allocation
                 	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="chosenFacexcel.php"><img src="img/excel.jpg" title="Download in Excel" width="18" height="18" /></a></center></div>
                  <?php 
  $maxdist=0;
foreach ($facilities as $k=>$a){
if ($a['distance']>$maxdist){ $maxdist=$a['distance']; } 
}
?>

<table class="data-table">
<tr> <th><center><small> # </small></center></th> 
<th><center><small>MFL Code </small></center></th> 
<th><center><small>Facility</small></center></th>
<th><center><small>Total patients</small></center></th>
<th><center><small>Need Per Year</small></center></th>
<th><center><small>Need per Day</small></center></th>
<th><center><small>Distance</small></center></th>
<th><center><small>County<a href="chosenFac.php?id=1"><img src="img/rank.jpg" title="Rank by county" width="15" height="15" /></a></small></center></th>
<th><center><small>Score<a href="chosenFac.php?id=2"><img src="img/rank.jpg" title="Rank by Score" width="15" height="15" /></a></small></center></th>
</tr>





 <?php 
$num=1;

foreach ($facilities as $b=>$result){
$counters=getfacilitywithcd4($result['facility']);
if($counters==0){
?>
<tr>
<td> <center><small> <?php  echo $num; ?></small></center> </td>
<td> <center><small> <?php  echo $result['MFLCode']; ?></small></center> </td>
<td><small> <?php  echo $result['fname']; ?></small></td>
<td> <center><small> <?php  echo $result['patients'];?></small></center> </td>
<td> <center><small> <?php  echo $result['need'];?></small></center> </td>
<td> <center><small> <?php  echo round($result['need_per_day'],2);?></small></center> </td>
<td> <center><small> <?php  echo $result['distance'];?></small></center> </td>
<td> <center><small> <?php  echo $result['county'];?></small></center> </td>
<td> <center><small> <?php  echo round($result['rank'],3);?></small></center> </td>
</tr>
<?php 
}
$num++;
}
?>
</table>

<!-- hidden inline form -->

</div>
</div>


</div>

<?php  	include("includes/sideprogram.php"); ?>

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