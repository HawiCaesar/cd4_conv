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
<!--
<div class="right sidebar" id="sidebar" >

				<div class="section">

					<div class="section-title">				<div class="left">Notifications </div>
						<div class="right"><img src="img/icon-time.gif" width="14" height="14" alt="" /></div>

						<div class="clearer">&nbsp;</div>

					</div>

					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
	
?>
						<ul class="nice-list">
								
							<li>
								<div class="left">
								<div class="notice"><a href="">
								<?php 
								if(isset($user) && $user==1){
								echo '<img src="img/notify.jpg" width="15" height="15" align="bottom"/>'." "."Device Awaiting Results Upload.";
									}
									else if(isset($user) && $user>1){
								echo '<img src="img/notify.jpg" width="15" height="15" align="bottom"/>'." ". $user." "."Devices Awaiting Results Upload.";
									}
									if(isset($user) && $user==0){
								echo '<img src="img/notify.jpg" width="15" height="15" align="bottom"/>'." "."1 Equipment is defective.";
									}
								
								?></a></div></div>
	<div class="right"></div>
   								<div class="clearer">&nbsp;</div>
							</li>
							
						
                       <div class="clearer">&nbsp;</div>
<?php

}

?>
					</div>

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
							<li><span class="quiet">1.</span> <a href="adddevice.php">Add Equipment</a></li>
							<li><span class="quiet">2.</span> <a href="addfacility.php">Add New Facility</a></li>
							<li><span class="quiet">3.</span> <a href="changePass.php">Change Password</a></li>
							<li><span class="quiet">4.</span> <a href="includes/userGuide.pdf">Quick User Guide</a></li>
							
											</ul>
				<?php
				
}
?>	
					</div>

				</div>
	<div class="section">

					<div class="section-title"> <img src="img/search.png" > Device </div>

					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
?>
	
						<ul class="nice-list">
							<li><form autocomplete="off" method="post" action="deviceslist.php">
					  
		  <input name="device" id="device" type="text" class="text" placeholder="Search Device" size="35" />
					    <input type="hidden" name="deviceid" id="deviceid" />&nbsp; 
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				
				
					
					
				</form></li>
														
							
						</ul></div>
					        <?php
}
			?>	<!--<div class="section-title"> <img src="img/search.png" > Sample</div>

					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
?>
	
						<ul class="nice-list">
							<li><form autocomplete="off" method="post" action="searchsample.php">
					  
		  <input name="sample" id="sample" type="text" class="text" size="35" />
					    <input type="hidden" name="sampleid" id="sampleid" />&nbsp; 
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				
				
					
					
				</form></li>
							
							
							
						</ul>
					        <?php
}
			?>	
			
			
				</div>	</div>-->
				

			
    
				


				