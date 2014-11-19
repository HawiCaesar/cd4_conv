<?php 
		ob_start();
		include("includes/headerLogin-2.php");
		include("includes/dbConf.php");
		$db=new dbConf();

?>

<style>
.login{
margin:auto;
border:1.5px solid #999;	
padding:2%;
background:#DDD;
height: 13em;
width: 35em;
-moz-border-radius: 1em 4em 1em 4em;
border-radius: 1em 4em 1em 4em
	
}
.login input{
	width:75%;
	display:block;
	padding:2%;
	margin-bottom:1em;
	font-size:1.3em;
	outline:none;
	border:1.5px solid #999;
	
}
.login button{
	padding:1% 3% 1% 3%;
	width:40%;
	font-size:1.3em;
}

.login a{
	margin-top:2%;
display:block;	
}
.login text{
	text-align:left;
}
</style>
<script>
		window.dhx_globalImgPath="img/";
	</script>
<script src="dhtmlxcombo_extra.js"></script>
 <link rel="STYLESHEET" type="text/css" href="dhtmlxcombo.css"/>
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

<section class="login">
<fieldset >
<legend>&nbsp;&nbsp;&nbsp;Password change &nbsp;&nbsp;&nbsp;</legend>

    </th>
  </tr>
</table>

<form action="facresetpass.php" method="post" name="resetform">
<div align="center">
<select style='width:310px; height: 50px; display: block; padding: 6px 6px 6px 6px;'  id="fcode[]" name="fcode" placeholder="choose facility name">
 <option  style='placeholder="choose facility name"'value=''></option>
			  <?php
			  
			  $facilityquery = "SELECT * FROM `equipmentdetails` e, facility f WHERE e.category=1 AND e.fname IS NOT NULL AND f.rolloutstatus=1 AND f.AutoID=e.facility  GROUP BY e.MFLCode ORDER BY fname ASC";
              $facilityresult = mysql_query($facilityquery) or die('Error, query failed'); //onchange='submitForm();'
              
			   while ($row = mysql_fetch_array($facilityresult))
     	       {
     	       	 $ID = $row['AutoID'];
		         $facilitycode = $row['MFLCode'];
			     $name = $row['fname'];
			  ?>
              <option value="<?php echo  $facilitycode; ?>"><?php echo $name; ?></option>
			  <?php
			      }   
		      ?>
            </select><span id="codeInfo"></span>
			</div>
			<script>
var z = dhtmlXComboFromSelect("fcode[]");
z.enableFilteringMode(true);
</script>&nbsp;&nbsp;&nbsp;
<input type="hidden" name="newpass" value="123456">
<button type="submit" name="submit">Reset Password</button>
</form>
</fieldset>
</section>
<div class="clearer">&nbsp;</div>
	<div id="site-title">
</div>
	
		


<?php
		include("includes/footer.php");
		?>
