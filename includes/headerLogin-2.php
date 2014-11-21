<?php
session_start();
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true" && isset($_SESSION))){
  //to fully log out a visitor we need to clear the session varialbles
  session_destroy();
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="" />
  
	<title>CD4 LIMS</title>
    
    <!--the date picker formating code -->
    
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../js/reCopy.js"></script>
    <link rel="SHORTCUT ICON" href="img/favicon.ico">


<style type="text/css">

body, table,textarea, button{
	font:1em "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	line-height:1.5em;
	color:#444;
	}	
body{
	font-size:12px;
	background:#FFFFFF;		
	text-align:left;
	width:auto;
	}	
.center-wrapper {
	margin: 0 auto;
	text-align:center;
}

#rat{
background: #FFFFFF;	
}



</style>

<style type="text/css">

#broke {
float: left;
width: 50%;	
}

#sere {
clear: both;
}

#trans {
float: left;
width: 50%;	
}

#st {
float: left;
width: 47.5%;	
}
#site-title {
	font: normal 1.6em serif;
	border-bottom: 1px solid #CCC;
	padding-bottom: 4px;
}

</style>


    
    
</head>

<body id="top">

<div id="network">
	
	</div>
</div>

<div id="site">
	<div class="center-wrapper">

		<div id="header">
			
			

			<div id="site-title">

			  <div align="center"> <h1><img src="img/nascop.jpg" alt="" /></h1></div>
              </div>
			<div class="clearer">&nbsp;</div>
		

