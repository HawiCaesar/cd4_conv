<?php
session_start();
if(!isset($_SESSION['username'])){
	echo "<script>";
		echo "window.location.href='facilitylogin.php'";
	echo "</script>";
}
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
if(!isset($session['username'])){
	//@header("location:login.php");
	
	}
require_once("includes/commodityheader.php");
require_once("includes/dbConf.php");
include("FusionCharts/FusionCharts.php");

$db = new dbConf();

if(isset($_POST['submit'])){
	//echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
	//var_dump($_POST['rejected']);
	//exit;
	$arr1=array();
	$arr2=array();
	foreach ($_POST['reagent'] as $key => $value) {
	if(isset($_POST['rejected'][$key])){
		$arr1[$key]=1;
		$arr2[$key]=0;
		
	}	
	else {
		$arr1[$key]=0;
		$arr2[$key]=1;
	}
	}
	
saveorderdet($_POST['reagent'],$_POST['endbal'],$_POST['required'],$_POST['allocated'],date('Y-m-d',strtotime($_POST['dod'])),$arr2,
$arr1,$_POST['comment'],$_POST['enddate'],$_POST['fromdate'],$_SESSION['facility']);	
}
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
	 
 <div class="main" id="main-two-columns">
 	<div class="section-title" style="width: 1100px;"><center>Commodity Orders</center>
<div class="left" id="main-left">

 <div class="post">



 <div class="post-date"></div>

<div class="post-body">
	
 </div>
 </div>
 <div class="post">
 	<form action="vieworders.php" method="post">
<table width="100%" class="data-table" cellpadding="4" cellspacing="5">
<thead>
	<tr>
		<th nowrap><center>Reagent</center></th>
		<th nowrap><center>End Balance</center></th>
		<th nowrap><center>Required</center></th>
		<th nowrap><center>Allocation (Rate)</center></th>
		<th nowrap><center>Expected Date of Delivery</center></th>
		<th nowrap><center>Received</center></th>
		<th nowrap><center>Rejected</center></th>
		<th nowrap><center>Comments</center></th>
	</tr>
</thead>
<tbody>
	<?php
	vieworderstable();
	?>
</tbody>
</table>
<div style="float: left"><input type="submit" class="button" name="submit" value="Save Details" /></div>
</form>

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

