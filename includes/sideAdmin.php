<?php
$flagged=flagDevicenum();
$errDet=flaggedDevList();
?>
    

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=500,width=1200');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<div class="right sidebar" id="sidebar" style="vertical-align: top;">
	<div class="section">

					<div class="section-title">				<div class="left">Notifications </div>
						<div class="right"><img src="../../img/icon-time.gif" width="14" height="14" alt="" /></div>

						<div class="clearer">&nbsp;</div>

					</div>

					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
	
?>
						<ul class="nice-list">							
						<div class="section-content">
                        <ul class="nice-list">
								
							<li>
								<div class="left">
								<div class="notice">
                        	  <a class="modalbox" href="#inliner"> <?php echo '<img src="../../img/notify.jpg" width="15" height="15" align="bottom"/>'." ". $flagged."  "."Devices flagged inactive(Confirm)";  ?></a>
                              </div>
                        </div>
                        </li>
                        
                        
						</ul>
                       </div>
                       <div class="clearer">&nbsp;</div>
<?php

}

?>
					</div>

				</div>

					
				<div class="section">

					<div class="section-title">Quick Menu</div>

					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
?>
	
						<ul class="nice-list">
							<li><span class="quiet">1.</span> <a href="../../admin/users/">Users</a></li>
							<li><span class="quiet">2.</span> <a href="../../admin/facility/">Facility</a></li>
							<li><span class="quiet">3.</span> <a href="../../admin/equipment/">Equipment</a></li>
							<li><span class="quiet">4.</span> <a href="../../admin/reports/">Reports</a></li>
											</ul>
				<?php
				
}
?>	

					</div>

				</div>
	<div class="section">

					<div class="section-title">Search </div>

		<form autocomplete="off" method="post" action="deviceslist.php">
					  
		  <input name="devicenumber" id="devicenumber" type="text" class="text" size="25" placeholder="Search System" />
					    <input type="hidden" name="deviceid" id="deviceid" />&nbsp; 
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				</form>	

			</div>
    