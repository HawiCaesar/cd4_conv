<?php
session_start();
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
$deviceautoID=$_GET['ID'];
$deviceNumber=$_GET['deviceNumber'];
$partnerid=$_SESSION['userID'];
$successunallocation=$_GET['successunallocation'];


?>
<script>
		window.dhx_globalImgPath="img/";
	</script>
<script src="dhtmlxcombo_extra.js"></script>
 <link rel="STYLESHEET" type="text/css" href="dhtmlxcombo.css">
  <script src="dhtmlxcommon.js"></script>
  <script src="dhtmlxcombo.js"></script>
<script>
function select(a) {
    var theForm = document.myForm;
    for (i=0; i<theForm.elements.length; i++) {
        if (theForm.elements[i].name=='checkbox[]')
            theForm.elements[i].checked = a;
    }
}
</script>
<style type="text/css">
select {
width: 250;}
</style>

	<script type="text/javascript" src="includes/validatedevices.js"></script>
<link rel="stylesheet" href="includes/validation.css" type="text/css" media="screen" />
  
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Facilities Allocated to PIMA Device Number <?php echo $deviceNumber; ?> </center></div>
              <?php if ($successunallocation !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successunallocation.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>     
                <?php
					$showfacility = "SELECT facilitys.facilityID,facilitys.facilitycode,facilitys.facilityname,facilitys.district,facilitys.telephone,facilitys.telephone2,facilitys.email,facilitys.contactperson,facilitys.PostalAddress FROM facilitys,deviceallocation WHERE deviceallocation.facility=facilitys.facilityID AND deviceallocation.deviceid='$deviceautoID' and facilitys.flag = 1 ";
			
			$displayfacilities = @mysql_query($showfacility) or die(mysql_error());
			$facilitycount = mysql_num_rows($displayfacilities);
		
if ($facilitycount != 0)
{		
	$rowsPerPage = 100; //number of rows to be displayed per page

		// by default we show first page
		$pageNum = 1;
		
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
		$pageNum = $_GET['page'];
		}
		
		// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;
		

			
			//display normal view
			echo "<table border=0 class='data-table' width='80%'>
				
				
	<tr ><th rowspan=2><small>MFL </small></th><th rowspan=2><small>Facility Name</small></th><th rowspan=2><small>County</small></th><th rowspan=2><small>District</small></th><th colspan=3><small><center>Contact Details</center></small><th rowspan=2><small>Task</small></th> </tr>
<tr>

<th><small>Email </small></th>
 <th><small>Contact Phone </small></th> <th><small>Contact Email </small></th></tr>";
				
			$showfacility =  "SELECT facilitys.facilityID,facilitys.facilitycode,facilitys.facilityname,facilitys.district,facilitys.telephone,facilitys.telephone2,facilitys.email,facilitys.contactperson,facilitys.PostalAddress FROM facilitys,deviceallocation WHERE deviceallocation.facility=facilitys.facilityID AND deviceallocation.deviceid='$deviceautoID' and facilitys.flag = 1 LIMIT $offset, $rowsPerPage";
			
			$displayfacilities = @mysql_query($showfacility) or die(mysql_error());
			
			//list the variables that you would like to get
			while(list($facilityID,$facilitycode,$facilityname,$district,$telephone,$telephone2,$email,$contactperson,$PostalAddress,$contacttelephone,$contacttelephone2,$ContactEmail,$partner,$smsprinterphoneno,$G4Sbranchname,$G4Slocation ) = mysql_fetch_array($displayfacilities))
			{  //get select district name and province id	
		$distname=GetDistrictName($district);
		//get province ID
		$provid=GetProvid($district);
			//get province name	
		$provname=GetProvname($provid);
		
		$countyname=getfacilitycounty($facilityID);
        $fname=urlencode($facilityname);
				echo "<tr >
						<td ><small>$facilitycode</small></td>
						<td ><small>$facilityname</small></td> 
						<td ><small>$countyname</small></td>
						<td ><small>$distname</small></td> 
						<td ><small>$email</small></td> 
						<td ><small>$contacttelephone</small></td>
						<td><a href='mailto:$ContactEmail'>$ContactEmail </a></td>
						<td ><center><small><a href=\"unallocatefacility.php" ."?facilityID=$facilityID&deviceAutoID=$deviceautoID&fname=$fname&devicenumber=$deviceNumber" . "\" title='Click to view Facilities ' OnClick=\"return confirm('Are you sure you want to Unallocate $facilityname from Device Number $deviceNumber');\" >Unallocate Facility</a></center> </small>
				</td>		
											
					</tr>";
			}echo "</table>";
		
			$numrows=getfacilitiesperdevice($deviceautoID); //get total no of batches
			
				// how many pages we have when using paging?
				$maxPage = ceil($numrows/$rowsPerPage);
			
			// print the link to access each page
			$self = $_SERVER['PHP_SELF'];
			$nav  = '';
			for($page = 1; $page <= $maxPage; $page++)
			{
			   if ($page == $pageNum)
			   {
				  $nav .= " $page "; // no need to create a link to current page
			   }
			   else
			   {
				  $nav .= " <a href=\"$self?page=$page\">$page</a> ";
			   }
			}
			
			// creating previous and next link
			// plus the link to go straight to
			// the first and last page
			
			if ($pageNum > 1)
			{
			   $page  = $pageNum - 1;
			   $prev  = " <a href=\"$self?page=$page\"> | Prev </a> ";
			
			   $first = " <a href=\"$self?page=1\"> First Page </a> ";
			}
			else
			{
			   $prev  = '&nbsp;'; // we're on page one, don't print previous link
			   $first = '&nbsp;'; // nor the first page link
			}
			
			if ($pageNum < $maxPage)
			{
			   $page = $pageNum + 1;
			   $next = " <a href=\"$self?page=$page\"> | Next |</a> ";
			
			   $last = " <a href=\"$self?page=$maxPage\">Last Page</a> ";
			}
			else
			{
			   $next = '&nbsp;'; // we're on the last page, don't print next link
			   $last = '&nbsp;'; // nor the last page link
			}
			
			// print the navigation link
			echo '<center>'. $first . $prev . $next . $last .'</center>';
	
		
	
}
else if ($facilitycount == 0)
{
	echo "</strong><center>There are no facility allocated to this device.</center></strong>";
}
	?>
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