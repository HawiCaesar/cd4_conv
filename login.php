<?php 
		ob_start();
		include("includes/headerLogin-2.php");
		include("includes/dbConf.php");
		$db=new dbConf();

?>



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
	padding:2%;
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
</style>
<?php	
		if(isset($_POST['submit'])){
?>
<div class="error">
<?php	
		
		$user=$_POST['username'];
	    $pass=md5($_POST['password']);
		chkLogin($user,$pass);
		login($user,$pass);
		
		
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
<legend>&nbsp;&nbsp;&nbsp;ADMIN LOG IN &nbsp;&nbsp;&nbsp;</legend>
<form action="login.php" method="post" name="frmLogin">
<div align="center"> 
<input type="text" placeholder="Username" name="username">
<input type="password" placeholder="Password" name="password"></div>
<button type="submit" name="submit">LOG IN</button>
<a href="forgot.php">Forgot Password</a>
</form>
</fieldset>
</section>
<div class="clearer">&nbsp;</div>
	<div id="site-title">
</div>

	<?php
		include("includes/footer.php");
		?>	