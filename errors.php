<?php
@session_start();
include("FusionCharts/FusionCharts.php");
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
$patna=$_SESSION['userID'];
?>  

	 <script type="text/javascript">
$(document).ready(function(){
	
	
	
	
	
	
	$("#devicenumber").autocomplete("getdevices.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#devicenumber").result(function(event, data, formatted) {
		$("#deviceid").val(data[1]);
	});
});
</script>  
 
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.account.options[form.account.options.selectedIndex].value;
self.location='resultList.php?account=' + val ;
}

</script>



			  
			 <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>PIMA Result Errors</center></div>
<table width="100%" class="data-table">	
<tr>	
<td width="60%">
<table class="data-table">
<tr> 
<th><center><small> # </small></center></th><th><center><small> Error code</small></center></th> <th><center><small> IQA/QC</small></center></th> <th><center><small>  Status  </small></center></th><th><center><small> Frequency</small></center></th>
</tr>





 <?php  
 $myErr=array();
 $errFreq=array();
	 $sequel="SELECT DISTINCT errorID FROM `test`  WHERE test.errorID !=0 AND partnerID='$patna'";
	  $resultReport=mysql_query($sequel);
	  $num=1;
	  while($rs=mysql_fetch_array($resultReport)){ 
	 $errs=$rs['errorID'];
	  $resultReport1=totallistingbycategory($errs,$patna,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
	 $resultArr=mysql_fetch_row($resultReport1);
	// print_r($resultArr);
	?>
    <tr>
    
    <td><center> <?php echo $num; ?></center></td>
    <td><center><?php echo $resultArr['0']; ?></center></td>
    <td><center><?php if($resultArr['3']!='1'){
			$err1='Volume';
		$error=$resultArr['3'];} 
		else if($resultArr['1']!='1'){
			$err1='Barcode';
		$error=$resultArr['1'];} 
		else if($resultArr['2']!='1'){
			$err1='Expiry date';
		$error=$resultArr['2'];} 
		else if($resultArr['4']!='1'){
			$err1='Reagent';
		$error=$resultArr['4'];} 
		else if($resultArr['5']!='1'){
			$err1='Device';
		$error=$resultArr['5'];} 
        echo $err1;
		?></center>
        </td>
   	<td><center><?php if($error='2'){
		echo "Fail";
		} 
		else if($error='3'){
		echo "Overruled";
		} ?></center></td>
    <td><center><?php echo $resultArr['6']; ?></center></td></tr>
    
    <?php
	  $myErr[$num]=$resultArr['0']; 
    $errFreq[$num]=$resultArr['6'];
	$num++;
		  }
		  $_SESSION['err']=$myErr;
		  $_SESSION['errFrq']=$errFreq;

	 ?>
</table>
</td><td width="40%">
<div id="chartdivtrendddd" align="left"> </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/Column2D.swf", "myChartId", "400", "250", "0", "0");
    myChart.setDataURL("xml/errorfreq.php?mwaka=<?php echo $currentyear; ?>%26mwezi=<?php echo $currentmonth;?>%26filtertype=<?php echo $filter;?>%26fromfilter=<?php echo $fromfilter;?>%26tofilter=<?php echo $tofilter;?>%26fromdate=<?php echo $fromdate;?>%26todate=<?php echo $todate;?>");
	myChart.render("chartdivtrendddd");
   </script>
</td></tr>
</table>

</form> 

<!-- hidden inline form -->

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