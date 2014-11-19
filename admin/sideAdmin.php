<?php
@session_start();
$flagged=flagDevicenum();
$errDet=flaggedDevList();
?>
    <script type="text/javascript">
        $(document).ready(function () {
            // create jqxtabs.
            $('#jqxtabs').jqxTabs({ width: 1200, height: 1000 });
            $('#jqxtabs').bind('selected', function (event) {
                var item = event.args.item;
                var title = $('#jqxtabs').jqxTabs('getTitleAt', item);
                
            });
        });
    </script>
	<script type="text/javascript" src="ddaccordion.js">

        /***********************************************
         * Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
         * Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
         * This notice must stay intact for legal use
         ***********************************************/

</script>


<script type="text/javascript">


        ddaccordion.init({
            headerclass: "submenuheader", //Shared CSS class name of headers group
            contentclass: "submenu", //Shared CSS class name of contents group
            revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
            mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
            collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
            defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
            onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
            animatedefault: false, //Should contents open by default be animated into view?
            persiststate: true, //persist state of opened contents within browser session?
            toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
            togglehtml: ["suffix", "<img src='img/plus.gif' class='statusicon' />", "<img src='img/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
            animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
            oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                //do nothing
            },
            onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                //do nothing
            }
        })


</script>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=500,width=1200');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<div class="right sidebar" id="sidebar">
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
	<div class="right"></div>
   <div id="inliner">
	<h2><center>Devices requesting Flagging</center></h2>

	<table width="95%" class="data-table" border="1">
                        
                       	<tr>
                        <td><strong>#</strong></td>
                          <td><strong>Device Number</strong></td>
                          <td><strong>Partner</strong></td>
                          <td><strong>Action</strong></td>
                        </tr>
                        
                         <?php
						 $num=1;
							  //calls function with users
							  while($resultArr=mysql_fetch_array($errDet)){
								 
							  ?>
 						 <tr>
                         <td> <?php echo $num;  ?></td>
  							  <td> <?php echo $resultArr['deviceNumber'];  ?></td>
                          
                              <td>  <?php echo $resultArr['name'];?></td>
                              <td>  <?php  echo $resultArr['deviceID']; ?></td>
                         </tr>
                         <?php
								$num+=1;	
								}
                         ?>
                             
					</table>
</div>
								<div class="clearer">&nbsp;</div>
							</li>
							
						<div class="section-content">
                        <ul class="nice-list">
								
							<li>
								<div class="left">
								<div class="notice">
                        	  <a class="modalbox" href="#inliner"> <?php echo '<img src="img/notify.jpg" width="15" height="15" align="bottom"/>'." ". $flagged."  "."Devices flagged inactive(Confirm)";  ?></a>
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

					<div class="section-title">

				<div class="section">

					<div class="section-title">Quick Menu</div>

					<div class="section-content">
<?php
if(isset($_SESSION['username'])){
?>
	
						<ul class="nice-list">
							<li><span class="quiet">1.</span> <a href="admin/users/">Users</a></li>
							<li><span class="quiet">2.</span> <a href="admin/facility/">Facility</a></li>
							<li><span class="quiet">3.</span> <a href="admin/equipment/">Equipment</a></li>
							<li><span class="quiet">4.</span> <a href="admin/reports/">Reports</a></li>
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

			</div>
    