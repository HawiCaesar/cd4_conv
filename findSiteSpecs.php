<?php 
require('connections/config.php');
//$level = intval($_GET['level']);
$level=1;
?>
<script>
		window.dhx_globalImgPath="img/";
	</script>
<script src="dhtmlxcombo_extra.js"></script>
 <link rel="STYLESHEET" type="text/css" href="dhtmlxcombo.css">
  <script src="dhtmlxcommon.js"></script>
  <script src="dhtmlxcombo.js"></script>
<link href="base/jquery-ui.css" rel="stylesheet" type="text/css"/>
 <script src="jquery-ui.min.js"></script>
<?php
//$level=1;
if ($level == 0)   //central
{
?>
<table>
		<tr>
<td><span class="mandatory">*</span> Distance </td>
<td><input name="distance" type="text" class="text"  style='width:188px;' /></td>				
</tr>		
	</table>
	<?php
}
elseif ($level == 1) // referall
{?>
<table>
<tr>
<td><span class="mandatory">*</span> Central Site Name </td>
 <td>
 <?php
	   $facilityquery = "SELECT AutoID,name  FROM facility where  flag=1 order by name ASC";
	   $facilityresult = mysql_query($facilityquery) or die('Error, query failed'); //onchange='submitForm();'
?>
<div>
<select style='width:188px;'  id="centralfname" name="centralfname">
 <option value=''></option>
			  <?php
			   while ($row = mysql_fetch_array($facilityresult))
     	 {		 $ID = $row['ID'];
			$name = $row['name'];
			  ?>
              <option value="<?php echo  $ID; ?>"><?php echo $name; ?></option>
			<?php
			}?>
            </select><span id="codeInfo"></span>
			</div>
			<script>
var z = dhtmlXComboFromSelect("centralfname");
z.enableFilteringMode(true);
</script>
 
 </td>	
</tr>

<tr>
<td><span class="mandatory">*</span> Distance </td>
<td><input name="distance" type="text" class="text"  style='width:188px;'/></td>		
</tr>
</table>
<?php

}

?>

