<?php
session_start();
require_once ("../admin.php");
require_once ("../../includes/dbConf.php");
$_SESSION['page'] = "facility";
$_SESSION['autoid'] = $_GET['id'];
$autoid=$_SESSION['autoid'];
$myArr = getSpecFacility($autoid);

if($_REQUEST['addfacility'])
{	
$fname = mysql_real_escape_string(ucwords($_POST['fname']));
$fcode = $_POST['fcode'];
$ftype = $_POST['ftype'];
$dname = $_POST['dname'];
$level = $_POST['level'];
$distance = $_POST['distance'];
$centralsite = $_POST['centralfname'];
$ontreatment = $_POST['ontreatment'];
$oncare = $_POST['oncare'];


//update facility
$q="UPDATE facility SET MFLCode='$fcode',name='$fname',district='$dname',type='$ftype',centralsiteAutoID='$centralsite',level='$level',distance='$distance' WHERE AutoID='$autoid'";
echo $q; //exit;
$sql=mysql_query($q)
 or die (mysql_error());

if ($sql)
{
//get last facility to be added
$sql2=mysql_query("select AutoID from facility where MFLCode='$fcode' order by AutoID DESC LIMIT  0,1 ") or die(mysql_error());
$SQLARRAY=mysql_fetch_array($sql2);
$fautoID=$SQLARRAY['AutoID'];
$asodate='2012-10-31';
//insert into facility patients
 $exists=GetIfFacilityPatientsExists($fautoID);
	   if ($exists > 0)
	   {
		$sql22=mysql_query("update facilitypatients set ontreatment='$ontreatment', oncare='$oncare'  where facility='$fautoID' ") or die(mysql_error());
		}
		else
		{
		$sql22=mysql_query("insert into facilitypatients(facility,ontreatment,oncare,asofdate) values('$fautoID','$ontreatment','$oncare','$asodate') ") or die(mysql_error());
		}
		
		if ($sql22)
{
			echo $succes=$fname." Successfully Edited ";
			echo '<script type="text/javascript">' ;
			echo "window.location.href='index.php?success=$succes'";
			echo '</script>';
}
else
{
		$error="Failed Saving , try again ";
}//end if successful

}  //end if sql
else
{
		$error="Failed Saving , try again ";
}


}//end if

?>
<script>
	$().ready(function() {

	}); 
</script>

<script language="javascript" type="text/javascript">
	// Roshan's Ajax dropdown code with php
	// This notice must stay intact for legal use
	// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
	// If you have any problem contact me at http://roshanbh.com.np
	function getXMLHTTP() {//fuction to return the xml http object
		var xmlhttp = false;
		try {
			xmlhttp = new XMLHttpRequest();
		} catch(e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch(e1) {
					xmlhttp = false;
				}
			}
		}

		return xmlhttp;
	}

	function getSiteSpecs(level) {

		var strURL = "findSiteSpecs.php?level=" + level;
		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('statediv').innerHTML = req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
			req.open("GET", strURL, true);
			req.send(null);
		}
	}

</script>
<script>window.dhx_globalImgPath = "img/";</script>
<script src="dhtmlxcombo_extra.js"></script>
<link rel="STYLESHEET" type="text/css" href="dhtmlxcombo.css">
<script src="dhtmlxcommon.js"></script>
<script src="dhtmlxcombo.js"></script>
<link href="base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="jquery-ui.min.js"></script>
<div class="main" id="main-two-columns">

	<div class="left" id="main-left">

		<div class="post">
			<div class="section-title">
				Edit Facility Details
			</div>
			<form id="customForm" method="post" action="edit.php?id=<?php echo $autoid; ?>" autocomplete="Off">
				<center>
					<table  border="0" class="data-table">

						<tr class="even">
							<td><span class="mandatory">*</span>Facility Name</td>
							<td>
							<input type="text" name="fname" value="<?php echo $myArr[2] ?>" class="text" style='width:188px;'/>
							</td>
						</tr>
						<tr class="even">
							<td><span class="mandatory">*</span> MFL Code:</td>
							<td>
							<input name="fcode" type="text" value="<?php echo $myArr[1] ?>" class="text" style='width:188px;'/>
							</td>
						</tr>
						<tr class="even">
							<td><span class="mandatory">*</span> Type</td>
							<td><?php
							$fquery = "SELECT ID,initial FROM facilitytypes   order by ID asc";

							$fresult = mysql_query($fquery) or die('Error, query failed');
							//onchange='submitForm();'

							echo "
							<select name='ftype' id='ftype' style='width:188px;';>
								\n";
							//echo " <option value=''> Select One </option>";

							//Now fill the table with data
							while ($row = mysql_fetch_array($fresult)) {
								$ID = $row['ID'];
								$name = $row['initial'];
								if ($myArr[5] == $ID) {
									echo "<option selected='selected' value='$ID'> $name </option>\n";
								} else {
									echo "<option value='$ID'> $name </option>\n";
								}
							}
							echo "
							</select>\n";
							?></td>

						</tr>

						<tr class="even">
							<td><span class="mandatory">*</span> District Name</td>
							<td><?php
							$fquery = "SELECT ID,name FROM districts order by name asc";

							$fresult = mysql_query($fquery) or die('Error, query failed');
							//onchange='submitForm();'

							echo "
							<select name='dname' id='dname' style='width:188px;' ;>
								\n";
							// echo " <option value=''> Select District </option>";

							//Now fill the table with data
							while ($row = mysql_fetch_array($fresult)) {
								$ID = $row['ID'];
								$name = $row['name'];
								if ($myArr[3] == $ID) {
									echo "<option selected='selected' value='$ID'> $name </option>\n";
								} else {
									echo "<option value='$ID'> $name </option>\n";
								}

							}
							echo "
							</select>\n";
							?></td>

						</tr>
						<tr class="even">
							<td><span class="mandatory">*</span> Level </td>
							<td><?php

							echo "
							<select name='level' id='level' style='width:188px' ;>
								\n";
							//echo " <option value=''> Select One </option>";
							if ($myArr[9] == 0) {
								echo "<option selected='selected' value='0'>Central Site </option>\n";
								echo "<option value='1'> Referal Site </option>\n";
							} else {
								echo "<option  selected='selected' value='1'> Referal Site </option>\n";
								echo "<option value='0'>Central Site </option>\n";
							}
							echo "
							</select>\n";
							?></td>

						</tr>
						<tr class ="even">
							<td> If Referal Site, Please Select  Central Site Name <span class="mandatory">*</span></td>
							<td> <?php
							$facilityquery = "SELECT AutoID,name  FROM facility where  flag=1 and level=0 order by name ASC";
							$facilityresult = mysql_query($facilityquery) or die('Error, query failed');
							//onchange='submitForm();'
							?>
							<div>
								<select style='width:200px;'  id="centralfname" name="centralfname">
									<?php
									while ($row = mysql_fetch_array($facilityresult))
									{ $ID = $row['AutoID'];
									$name = $row['name'];
									
									if ($myArr[7] == $ID) {
									echo "<option selected='selected' value='$ID'> $name </option>\n";
								} else {echo "<option value='$ID'> $name </option>\n";
									echo "<option value='$ID'> $name </option>\n";
								}									}
									?>
								</select><span id="codeInfo"></span>
							</div>
							<script>
								var z = dhtmlXComboFromSelect("centralfname");
								z.enableFilteringMode(true);
							</script></td>
						</tr>

						<tr  class ="even">
							<td><span class="mandatory">*</span> Distance </td>
							<td>
							<input name="distance" type="text" class="text" value="<?php echo $myArr[10] ?>" style='width:188px;'/>
							</td>
						</tr>
						<tr>
							<th colspan="2">
							<div align="center">
								Patient Numbers
							</div></th>
						</tr>
						<tr class="even">
							<td><span class="mandatory">*</span> On Treatment</td>
							<td>
							<input name="ontreatment" type="text" class="text" value="<?php echo $myArr[22] ?>" style='width:188px;'/>
							</td>
						</tr>
						<tr class="even">
							<td><span class="mandatory">*</span> On Care</td>
							<td>
							<input name="oncare" type="text" class="text" style='width:188px;' value="<?php echo $myArr[23] ?>" />
							</td>
						</tr>

						<tr>
							<td colspan="2">
							<div align="center">
								<input type="submit" name="addfacility" value=" Update Facility Details " style='width:188px;' class="button" >
							</div></td>

						</tr>

					</table>
				</center>

				<div class="clearer">
					&nbsp;
				</div>

		</div>

		<div class="content-separator"></div>

	</div>

	<?php

	include ("../../includes/sideAdmin.php");
	?>

	<div class="clearer">
		&nbsp;
	</div>

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

	<div class="clearer">
		&nbsp;
	</div>

</div>

<?php

include ("../../includes/footer.php");
ob_end_flush();
?>
