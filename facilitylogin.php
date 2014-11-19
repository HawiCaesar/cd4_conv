<?php 
		ob_start();
		include("includes/headerLogin-2.php");
		include("includes/dbConf.php");
		$db=new dbConf();

?>


	<script type="text/javascript" src="includes/validatedevices.js"></script>
<link rel="stylesheet" href="includes/validation.css" type="text/css" media="screen" />
<style>
.error{
	border: 1px solid #DDD;
	margin-bottom: 1em;
	padding: 0.6em 0.8em;
	margin:auto;
	height:auto;
	width:30%;
}

.error {background: #FBE3E4; color: #8A1F11; border-color: #FBC2C4;}
.error a {color: #8A1F11;}
.login{
margin:auto;
border:1.5px solid #999;	
padding:2%;
background:#DDD;
height: 18em;
width: 35em;
-moz-border-radius: 1em 4em 1em 4em;
border-radius: 1em 4em 1em 4em
	
}
.login input{
	width:75%;
	display:block;
	margin-bottom:1em;
	font-size:1.3em;
	outline:none;
	border:1.5px solid #999;
	
}
.login button{
	padding:1% 3% 1% 3%;
	width:30%;
	font-size:1.3em;
}

.login a{
	margin-top:2%;
display:block;	
}
.login text{
	text-align:left;
}

select {
    
    -moz-box-sizing: content-box;
    -webkit-box-sizing:content-box;
    box-sizing:content-box;
    height: 22px;
}
</style>
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


<?php	
		if(isset($_POST['submit'])){
?>
<div class="error">
<?php	
		$md5=md5($_POST['password']);
		$pass=checkFacilitypass($_POST['fcode']);
		if($md5==$pass){
			
			$_SESSION['facility']=$_POST['fcode'];
			$_SESSION['username']=checkFacilitymfls($_POST['fcode']);
			$_SESSION['calibur']=checkwhichequip($_SESSION['facility']);
			$_SESSION['upload']=checkwhichupload($_SESSION['facility']);
			$mfl=$_SESSION['facility'];
			$_SESSION['log']=systemAccess($_SESSION['username'],$_SESSION['facility'],"facility");
			if($_POST['password']=="123456"){
			header('Location:changefcpass.php');	
			}
			else {
				header('Location:facilitydashboard.php?id='.$mfl);
			}
			
		}
		else{
			echo "Wrong Password";			
		}	
		
?></div><?php
echo "<br  />";
}?>

<?php	
		if(isset($_GET['successsave'])){
?>
<div class="error">
<?php	
	echo $_GET['successsave'];		
?></div><?php
echo "<br  />";
}?>
<section class="login">
<fieldset >
<legend>&nbsp;&nbsp;&nbsp;Commodity Reporting LOG IN &nbsp;&nbsp;&nbsp;</legend>
<form action="facilitylogin.php" method="post" name="frmLogin">
<div align="center"> 
	<p align="left">
		
		<?php
	   $facilityquery = "SELECT * FROM `equipmentdetails` e, facility f WHERE e.category=1 AND e.fname IS NOT NULL AND f.rolloutstatus=1 AND f.AutoID=e.facility  GROUP BY e.MFLCode ORDER BY fname ASC";
	   $facilityresult = mysql_query($facilityquery) or die('Error, query failed'); //onchange='submitForm();'
?>

<select style='width:310px; height: 50px; display: block; padding: 6px 6px 6px 6px;'  id="fcode[]" name="fcode">
 <option value=''></option>
			  <?php
			   while ($row = mysql_fetch_array($facilityresult))
     	 {		 $ID = $row['AutoID'];
		 $facilitycode = $row['MFLCode'];
			$name = $row['fname'];
			  ?>
              <option value="<?php echo  $facilitycode; ?>"><?php echo $name; ?></option>
			<?php
			}?>
            </select><span id="codeInfo"></span>
			</div>
			<script>
var z = dhtmlXComboFromSelect("fcode[]");
z.enableFilteringMode(true);
</script>

		
		
<input type="password" placeholder="Password" name="password" style="padding:2%;">

<a href="forgot.php">Forgot Password</a>
<button type="submit" name="submit">LOG IN</button></p
</div>
</form>
</fieldset>
</section>
<div class="clearer">&nbsp;</div>
	<div id="site-title">
</div>

	<?php
		include("includes/footer.php");
		?>	