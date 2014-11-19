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
height: 19em;
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
	width:60%;
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

<section class="login">
	<p> <div class="error" style="width: 100%;">During your First login you are required to change your password</div></p>
<fieldset >
<legend>&nbsp;&nbsp;&nbsp;CD4 Change Facility Password &nbsp;&nbsp;&nbsp;</legend>
<form action="facchangepass.php" method="post" name="frmLogin">
<div align="center"> 
<input type="hidden" placeholder="Current password" name="oldpass" value="123456">
<input type="password" placeholder="New password" name="newpass">
<input type="password" placeholder="Re-enter Password" name="password1">
<input type="hidden" name="mfl" value="<?php  echo $_SESSION['facility']; ?>" />
</div>
<button type="submit" name="submit">Change Password</button>
</form>
</fieldset>
</section>
<div class="clearer">&nbsp;</div>
	<div id="site-title">
</div>

	<?php
		include("includes/footer.php");
		?>	