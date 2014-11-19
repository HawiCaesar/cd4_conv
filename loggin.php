<?php 
		ob_start();
		include("includes/headerLogin-2.php");
		include("includes/dbConf.php");
		$db=new dbConf();
		
		if(isset($_POST['submit'])){
		$user=$_POST['username'];
		$pass=$_POST['password'];
		echo $user . " ".$pass;
		login($user,$pass);
		chkLogin($user,$pass);
		}
?>


<html>

<head>
<style>
.login{
	margin:auto;
width:35%;
height:25%;
border:1.5px solid #999;	
padding:2%;
background:#CCC;
	
}
.login input{
	width:100%;
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

</head>

<body>

<section class="login">
<form action="login.php" method="post" name="frmLogin">
<input type="text" placeholder="Username" name="username">
<input type="password" placeholder="Password" name="password">
<button type="submit" name="submit">Submit</button>
<button type="reset" style = "float:right">Cancel</button>
<a href="#">Forgotten Password</a>
</form>
</section>

</body>
</html>