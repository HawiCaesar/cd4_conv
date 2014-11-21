<?php
//require_once("dbConf.php");
session_start();
$D=$_SERVER['PHP_SELF'];
$partnerid=$_SESSION['userID'];
//$db = new dbConf();
$user=LastUpload($partnerid);
$today=date('Y-m-d');

$totalerrors=totalErr($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$errDet=totalErrDet($partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
?>
<script type='text/javascript' src='includes/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="includes/jquery.autocomplete.css" />
<script type="text/javascript">
$().ready(function() {
	
	$("#sample").autocomplete("getFacility.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#sample").result(function(event, data, formatted) {
		$("#sampleid").val(data[1]);
	});
	
			$("#to").datepicker({
			yearRange : "-120:+0",
			maxDate : "0D",
			dateFormat : $.datepicker.ATOM,
			changeMonth : true,
			changeYear : true
		});
		$("#from").datepicker({
			yearRange : "-120:+0",
			maxDate : "0D",
			dateFormat : $.datepicker.ATOM,
			changeMonth : true,
			changeYear : true
		});
		
});
</script>


<script type="text/javascript">

$().ready(function() {
	
	$("#device").autocomplete("getdevices.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#device").result(function(event, data, formatted) {
		$("#deviceid").val(data[1]);
	});
});
</script>	
<div class="right sidebar" id="sidebar" >

				<div class="section">

					<div class="section-title">				<div class="left">Notifications </div>
						<div class="right"><img src="img/icon-time.gif" width="14" height="14" alt="" /></div>

						<div class="clearer">&nbsp;</div>

					</div>

					<div class="section-content">&nbsp;	</div>

				</div>


		
				<div class="section">

					<div class="section-title">
					<div class="left">Quick Menu</div>
<div class="right"><img src="img/Note-icon.png" width="14" height="14" alt="" /></div>
<div class="clearer">&nbsp;</div>
</div>
					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
?>
	
						<ul class="nice-list">
							<li><span class="quiet">1.</span> <a href="uploadfacsdata.php">Upload Calibur data</a></li>
							
											</ul>
				<?php
				
}
?>	
					</div>

				</div>
	<div class="section">

					<div class="section-title"> <img src="img/search.png" > Sample </div>

					<div class="section-content">

	
						<ul class="nice-list">
							<li><form autocomplete="off" method="post" action="">
					  
		  <input name="device" id="device" type="text" class="text" placeholder="Search Sample" size="35" />
					    <input type="hidden" name="deviceid" id="deviceid" />&nbsp; 
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				
				
					
					
				</form></li>
														
							
						</ul></div>
			<div class="section-title"> <img src="img/search.png" > FCDRR Form</div>

					<div class="section-content">
			
						<ul class="nice-list">
							<li><form method="post" action="">
		<input type="text" name="from" id="from" class="texts" placeholder="DD/MM/YYYY" required value=""  />&nbsp;<b>-</b>&nbsp;
		<input type="text" name="to" id="to" class="texts" placeholder="DD/MM/YYYY" required value=""  />
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				
				
					
					
				</form></li>
														
							
						</ul>
			
				</div>	</div>
				

			
    
				


				