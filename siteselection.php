<?php
include("includes/dbConf.php");
$db=new dbConf();
require_once("includes/programheader.php"); 
$select=getWeighting();
$country=getcountrysettings();
if(isset($_POST['proceed'])){
updateWeighting($_POST['cd4art'],$_POST['pre'],$_POST['hr'],$_POST['mwaka'],$_POST['access'],$_POST['patients'],$_POST['from'],$_POST['to']);
 	
}
?>

<script>
$().ready(function(){

});
</script>
 <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p>
<div class="main" id="main-two-columns">

<div class="left" id="main-left">

 <div class="post">
                 <div class="section-title"><center>Equipment Location Selection Criteria</center></div>
                   <form action="siteselection.php" method="post" name="frmUsers" ><center>
<table width="100%">
                 <tr>
                 	<td width="50%" style="vertical-align:top; "><!--Weingting-->
                 	<div class="section-title"><center>Weighting</center></div>
                 	<table class="data-table">
                 	
                 	<?php 
                 	$num=1;
                 	foreach ($select as $key => $values) {
                 	echo "<tr><td width='60%'> <b> Patient coverage</b></td> <td><input class='text' style='width:50px;' name='patients' type='text' value='".$values['patients']."'/>  in % </td></tr>";
    echo "<tr><td width='60%'> <b> Distance from Central Site </b></td> <td><input class='text' style='width:50px;' name='access' type='text' value='".$values['access']."'/>  in % </td></tr>";
$num++;
}
                 	?>
                 	<tr><td><b>Maximum devices per site</b></td><td><input class='text' style='width:50px;' name='weighting' type='text' value='1'/></td></tr>
                       	</table>
                 	
                 	
                 	</td>
                 	<td width="50%" style="vertical-align:top;">
                 	<div class="section-title"><center>Country profile</center></div>
                 	<table class="data-table">
                 	<?php foreach ($country as $key => $value) {
                 	echo "<tr><td width='60%'> <b># of CD4 for ART per year</b></td> <td><input class='text' style='width:60px;' name='cd4art' type='text' value='".$value['cd4art']."'/></td></tr>
                 	      <tr><td width='60%'> <b># of CD4 for pre-ART per year</b></td> <td><input class='text' style='width:60px;' name='pre' type='text' value='".$value['cd4preart']."'/></td></tr>
                 	      <tr><td width='60%'> <b>Work hours per day</b></td> <td><input class='text' style='width:60px;' name='hr' type='text' value='".$value['hoursperday']."'/></td></tr>
                 	      <tr><td width='60%'> <b>Work days per year</b></td> <td><input class='text' style='width:60px;' name='mwaka' type='text' value='".$value['hoursperyear']."'/></td></tr>
                 	 
                 	</tr>";
}
                 	?>
                 	
                 	</table>
                 	</td>
                 	
                 	
                 	
                 </tr>    	
                 <tr>
                 	<!-- Continue -->
                 	<td colspan="2">
                 	<center><input type="submit" class="button" name="proceed" value="Proceed to view selected site"/></center>
                 	</td>
                 </tr>    
</table>
                    </center>
                    
<div class="clearer">&nbsp;</div>

      </div>

<div class="content-separator"></div>
</div>

<?php  	
include("includes/sideprogram.php"); ?>

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