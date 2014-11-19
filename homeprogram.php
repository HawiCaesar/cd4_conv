<?php
session_start();
$eqipmentStatus=2;
$dw2=strtotime("-2 week");
if(isset($_GET['tof'])){
$date2=$_GET['tof'];
}
else{
$date2=date('Y-m-d');
}

if(isset($_GET['fromf'])){
$date1=$_GET['fromf'];
}
else{
$date1=date('Y-m-d', $dw2);
}
if(!isset($_SESSION['userRights'])){
require_once("includes/commodityheader.php");
}
else {
	require_once("includes/programheader.php");
}

require_once("includes/dbConf.php");
include("FusionCharts/FusionCharts.php");

$db = new dbConf();

?>

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
newwindow=window.open(url,'name','left=400,top=200,width=800,height=150,toolbar=0,resizable=0,scrollbars=no');
if (window.focus) {newwindow.focus()}
return false;
}

// -->
</script>
 <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p>
 <div class="main" id="main-two-columns">

<div class="left" id="main-left">

 <div class="post">



 <div class="post-date"></div>

<div class="post-body">
 </div>
 </div>
 <div class="post">
<table width="100%" class="" border="0">
  <tr>
    <td width="30%" valign="top" class="xtop" style="vertical-align:top; ">
    <p><div class="section-title"><center>CD4 Equipment</center></div>
<!-- Devices and their details  from the national view-!-->	
<table width="100%" class="data-table" >	
                     	<tr> <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
                                                    </tr>
                     	<?php
                     	$cd4=getcd4Equipment();
                     	?>
                     	<?php
                     	foreach ($cd4 as $key => $value) {
                     	?> <tr class="even">
<td><?php echo $value['description']; ?></td>
<td><?php getTotalEquipment($value['ID']); ?></td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],1); ?></td>
                     	<td><?php if(getTotalEquipmentcat($value['ID'],2)==0){?>
<?php echo getTotalEquipmentcat($value['ID'],2);
}else{?>	
<a href='javascript:void(null);' onClick="popitup('faultyequipment.php?cat=<?php echo 1;?>&status=<?php echo $eqipmentStatus;?>')">
<?php echo    getTotalEquipmentcat($value['ID'],2); ?></a><?php } ?> </td>
<td><?php  echo getTotalEquipmentcat($value['ID'],3); ?></td></tr>
<?php }?>
                     	<tr class="even">
                     	<td><b>Total</b></td>
                     	<td><?php getEquipmentTotals(1,0); ?></td>
                     	<td><?php getEquipmentTotals(1,1); ?></td>
                     	<td><?php getEquipmentTotals(1,2); ?></td>
                     	<td><?php getEquipmentTotals(1,3); ?></td>
                     	
                     	</tr>
                     	</table>	</p>
                     	<p>
                     	<!-- Hermatology  -->
                     	<div class="section-title"><center>Haematology Equipment</center></div>
                     	<!-- Devices and their details  from the national view-!-->	
                     	<table width="100%" class="data-table">
                     	
                     	<tr>                     <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
                     	</tr>
                     	<?php
                     	$cd4=gethermEquipment();
                     	?>
                     	<?php
                     	foreach ($cd4 as $key => $value) {
                     	?>
<tr class="even">
<td><?php echo $value['description']; ?></td>
<td><?php getTotalEquipment($value['ID']); ?></td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],1); ?></td>
                     	<td><?php if(getTotalEquipmentcat($value['ID'],2)==0){?>
<?php echo getTotalEquipmentcat($value['ID'],2);
}else{?>
<a href='javascript:void(null);' onClick="popitup('faultyequipment.php?cat=<?php echo 1;?>&status=<?php echo $eqipmentStatus;?>')"><?php echo getTotalEquipmentcat($value['ID'],2); ?></a>
<?php } ?>
                     	
                     	</td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],3); ?></td>
</tr>
<?php
}
?>
                     	<tr class="even">
                     	<td><b>Total</b></td>
                     	<td><?php getEquipmentTotals(3,0); ?></td>
                     	<td><?php getEquipmentTotals(3,1); ?></td>
                     	<td><?php getEquipmentTotals(3,2); ?></td>
                     	<td><?php getEquipmentTotals(3,3); ?></td>
                     	
                     	</tr>
                     	</table></p>
                     	<p> <!-- Chemistry-->
                     	<!-- Devices and their details  from the national view-!-->	
                     	<table width="100%" class="data-table">
                     	
                     	<tr>                     <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Device</small> </center></th>
                     	<th><center><small>Total</small> </center></th>
                     	<th><center><small>Functional</small> </center></th>
                     	<th><center><small>Broken Down</small> </center></th>
                     	<th><center><small>Obsolete</small> </center></th>
                     	</thead>
                     	</tr>
                     	<?php
                     	$cd4=getchemEquipment();
                     	?>
                     	<?php
                     	foreach ($cd4 as $key => $value) {
                     	?>
<tr class="even">
<td><?php echo $value['description']; ?></td>
<td><?php getTotalEquipment($value['ID']); ?></td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],1); ?></td>
                     	<td><?php if(getTotalEquipmentcat($value['ID'],2)==0){?>
<?php echo getTotalEquipmentcat($value['ID'],2);
}else{?>
<a href='javascript:void(null);' onClick="popitup('faultyequipment.php?cat=<?php echo 1;?>&status=<?php echo $eqipmentStatus;?>')"><?php echo getTotalEquipmentcat($value['ID'],2); ?></a>
<?php } ?>
                     	
                     	</td>
                     	<td><?php echo getTotalEquipmentcat($value['ID'],3); ?></td>
</tr>
<?php
}
?>
                     	<tr class="even">
                     	<td><b>Total</b></td>
                     	<td><?php getEquipmentTotals(5,0); ?></td>
                     	<td><?php getEquipmentTotals(5,1); ?></td>
                     	<td><?php getEquipmentTotals(5,2); ?></td>
                     	<td><?php getEquipmentTotals(5,3); ?></td>
                     	
                     	</tr>
                     	</table>	
                     	</p>
    
    </td>
    <td width="50%" valign="top" class="xtop" style="vertical-align:top; ">
    <p><div class="section-title"><center>Device Distribution By County</center></div>
                     	<!-- County map with popup to allow one to view county details -->
                       	
                     	<table width="100%" class="data-table">
                     	
                     	<tr class="even">
                     	<!--Kenyan Map to choose county -->
                     	<td>
     
<div id='mapDiv' style="float: left; vertical-align: top; margin-top: -5px;">
The map will replace this text. If any users do not have Flash Player 8 (or above), they'll see this message.	 </div>
<script type="text/javascript">
var map = new FusionMaps("FusionMaps/FCMap_KenyaCounty.swf", "KenyaMap", 800, 700, "0", "0");
map.setDataURL("xml/map2.php");
map.render("mapDiv");
</script></p>
<div class="success"><center>
    <?php	echo '<img src="img/notify.jpg" width="15" height="15" align="bottom"/>'." "."The Data used in this system is from PEPFAR Partners dated ".getmaxasofdatepatientnos();
	?>	</center>	
						</div>	   
<?php 
if(isset($_GET['id'])){
$Search=$_GET['id'];
} 
else
$Search=41;
?>
<div class="section-title"><center>Device Distribution for <?php echo getCountyName($Search); ?> County</center></div>
<p><b>Select County to Report:&nbsp;&nbsp;&nbsp; </b>
<select name="county" id="county"> 
<option selected="selected">Select county</option>
<?php $a=getCountys();
foreach ($a as $key => $value) {
?>
<option value="<?php echo $value['ID']; ?>"> <?php echo $value['name']; ?></option>";
<?php

}
 ?></select></p>
<table width="100%" class="data-table"  style="margin:auto; ">
                     	
                     	<tr>                     <!--CD4 platform -->
                     	<thead>
                     	<th><center><small>Central Site</small> </center></th>
                     	<th><center><small>Type</small> </center></th>
                     	<th><center><small>MFL Code</small> </center></th>
                     	<th><center><small>ART #</small> </center></th>
                     	<th><center><small>Care #</small> </center></th>
                     	<th><center><small>Total Patients</small> </center></th>
                      <th><center><small>CD4</small> </center></th>
                     	<th><center><small>Haematology</small> </center></th>
                     	<th><center><small>Chemistry</small> </center></th>
                     	</thead>
                     	</tr>
                     	<?php
                     	$cd4=facilityPerCounty($Search,0,14);
                     	?>
                     	<?php 
                     	foreach ($cd4 as $key => $value) {
                     	?>
<tr class="even">
<td><a href="programfacilitylist.php?id=<?php echo $value['AutoID']; ?>&count=<?php echo $Search; ?>" target="_blank" ><?php echo $value['facility']; ?></a></td>
<td><center><?php echo $value['typename']; ?></center></td><td><center><?php echo $value['MFLCode']; ?></center></td>
                     	<td><center><?php echo $value['ontreatment']; ?></center></td>
                     	<td><center><?php echo $value['oncare']; ?></center></td>
                     	<td><?php echo ($value['ontreatment']+$value['oncare']); ?></td>
                     	<td> <center><?php if(getTotalFacEquipmentcat(1,1,$value['AutoID'])!=0){
                     	?>
                     	<a href='javascript:void(null);'onClick="popitup('equipincentral.php?cat=<?php echo 1;?>&status=<?php echo 1;?>&fac=<?php echo $value['AutoID']; ?>')">
                     	<?php echo getTotalFacEquipmentcat(1,1,$value['AutoID']); ?></a>
<?php
                     	}else echo getTotalFacEquipmentcat(1,1,$value['AutoID']);?></center>
                     	</td>	
                     	<td><center>
                     	<?php if(getTotalFacEquipmentcat(3,1,$value['AutoID'])!=0){?>
                     	
                     	<a href='javascript:void(null);'
                     	onClick="popitup('equipincentral.php?cat=<?php echo 3;?>&status=<?php echo 1;?>&fac=<?php echo $value['AutoID']; ?>')">
                     	<?php echo getTotalFacEquipmentcat(3,1,$value['AutoID']); ?></a>
                     	
                     	<?php } else echo getTotalFacEquipmentcat(3,1,$value['AutoID']); ?></center></td>
                     	<td><center>	<?php if(getTotalFacEquipmentcat(5,1,$value['AutoID'])!=0){ ?>
                     	<a href='javascript:void(null);' 
                     	onClick="popitup('equipincentral.php?cat=<?php echo 5;?>&status=<?php echo 1;?>&fac=<?php echo $value['AutoID']; ?>')">
                     	<?php echo getTotalFacEquipmentcat(5,1,$value['AutoID']); ?></a>
                     	<?php } else echo getTotalFacEquipmentcat(5,1,$value['AutoID']); ?>
                     	</center>
                     	</td>
</tr>
<?php
}
?>
                     	</table>
</p>
    </td>
    
  </tr>
</table>	
</div>	
<div class="content-separator"></div>
</div>
            <?php  	
//include("includes/sideprogram.php"); ?>

</div>


</div>


<div class="column left" id="column-3">


</div>


<div class="clearer">&nbsp;</div>

</div>

<?php
include("includes/footer.php");
  ob_end_flush();
?>	

