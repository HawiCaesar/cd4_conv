<?php
@session_start();
if(!isset($_SESSION['username'])){
	echo '<script type="text/javascript">' ;
				echo "window.location.href='index.php'";
				echo '</script>';
	
	}

else{
require('../../Connections/config.php');
include('../../function.php');
require_once('../../classes/tc_calendar.php');
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
	echo '<script type="text/javascript">' ;
	echo "window.location.href='index.php'";
	echo '</script>';
  
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
	<link rel="stylesheet" type="text/css" href="../../style1.css" media="screen" />   
	<link rel="stylesheet" type="text/css" href="../../js/jquery-ui.css">
     <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
	 <script type="text/javascript" src="../../js/jquery-ui.js"></script>
    <SCRIPT LANGUAGE="Javascript" SRC="../../FusionCharts/FusionCharts.js"></SCRIPT>
    <link rel="SHORTCUT ICON" href="../../img/favicon.ico">
	<title>CD4 LIMS</title>
    
    <!--the date picker formating code -->
     


<!--

   <link rel="stylesheet" href="../css/layout.css" type="text/css">
   <link rel="stylesheet" href="../css/awesomebuttons.css" type="text/css">
  
   


<style type="text/css">

body, table, input, textarea, select, button{
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

#rat{
background: #FFFFFF;	
}

</style>
 -->


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

</style>


<script type="text/javascript">
var tname =/^[A-Za-z0-9 ]{3,200}$/;
var uname =/^[0-9 ]{3,20}$/;

function validate(){
	
   var oname = document.getElementById('oname').value;
   var ename = document.getElementById('ename').value;
   var broker = document.getElementById('broker').value;
    var str1= document.getElementById('date4').value;
    var str2= document.getElementById('date5').value;
	
var m1=str1.substring(5,7); 
var m2=str2.substring(5,7); 
var dt1=str1.substring(8,10); 
var dt2=str2.substring(8,10); 
var y1=str1.substring(0,4);
var y2=str2.substring(0,4);


var errors = [];
var minlength=6;
	


if(dt2 > dt1){
alert("Date of Price Cannot be Greater than Date of Stamp");
return false;
	
}

if(m2 > m1){
alert("Month of Price Cannot be Greater than Month of Stamp");
return false;
	
}

if(y2 > y1){
alert("Year of Price Cannot be Greater than Year of Stamp");
return false;
	
}
	
	
 if(broker=="0"){
	 alert("No Broker Name");
	 return false;
	 }

   if(str1=="0000-00-00"){
	  alert("No Date of Stamp"); 
	return false; 
 
   } 
      if(str2=="0000-00-00"){
	  alert("No Date of Price"); 
	return false; 
 
   } 	
   
 if (!tname.test(oname)) {
  errors[errors.length] = "No / Invalid Transferor name .";
 } 
 if (!tname.test(ename)) {
  errors[errors.length] = "No / Invalid Transferee name .";
 } 
 
 if (errors.length > 0) {
  reportErrors(errors);
  return false;
 }

return true;
}

function reportErrors(errors){
 var msg = "Please Enter Valid Data...\n";
 for (var i = 0; i<errors.length; i++) {
 var numError = i + 1;
  msg += "\n" + numError + ". " + errors[i];
}
 alert(msg);
}
</script>
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	var YAP = document.getElementById("rat");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
			YAP.style.display = "block";
		text.innerHTML = "SEARCH";
  	}
	else {
		ele.style.display = "block";
		YAP.style.display = "none";
		text.innerHTML = "SEARCH";
	}
} 
</script>
     <script language="JavaScript">
function ShowHide(divId)
{
if(document.getElementById(divId).style.display == 'none')
{
document.getElementById(divId).style.display='block';
}
else
{
document.getElementById(divId).style.display = 'none';
}
}
</script>
 
  	<script language="javascript" src="../../calendar.js"></script>
 <link rel="STYLESHEET" type="text/css" href="../../calendar.css">
</head>

<body id="top">

<div id="site">
		<div id="header">
<div id="network">

		<div class="left"><?php echo "<b>". date("l, d F Y")."</b>";?> <span class="text-separator">|</span> <span class="quiet">
        
        <?php
		if(isset($_SESSION['username'])){
			
			echo "Welcome"." ".$_SESSION['username'];
		}
				else
				{
					echo "Hello guest. Login to view the site";
				
		?>
        
        
        <?php
		}
        ?> </span></div>
		<div class="right">

			<ul class="tabbed" id="network-tabs">
				<li class="current-tab"><a href="#">CD4 LIMS</a></li>
                 <?php
		if(isset($_SESSION['username'])){
			
			echo "<li><a href='".$logoutAction."'>Log Out</a></li>";
		}
				else
				{
					echo "<li><a href='index.php'>Login</a></li>";
				}
				
		?>
			</ul>

			<div class="clearer">&nbsp;</div>
		
		</div>
		
		<div class="clearer">&nbsp;</div>
</div>
		

			
			
			<div class="clearer">&nbsp;</div>

			<div id="site-title">

				<div align="center"> <h1><img src="../../img/nascop.jpg" alt="" /></h1></div>

			</div>

			<div id="navigation">
				
				<div id="main-nav">

					<ul class="tabbed">
						<?php if($_SESSION['page']=="home"){ ?>
						<li class="current-tab"><a href="../../admin/home/"><b>Home Page</b></a></li>
						<?php } else{ ?>
							<li><a href="../../admin/home/">Home Page</a></li>
							<?php } ?>
							
							<?php if($_SESSION['page']=="facility"){ ?>
                        <li class="current-tab"><a href="../../admin/facility/"><b> Facility List </b></a></li>
                        <?php }else{ ?> 
						<li><a href="../../admin/facility/">Facility List </a></li>
						<?php } ?>
								
							<?php if($_SESSION['page']=="users"){ ?>
                        <li class="current-tab"><a href="../../admin/users/"><b> User List</b></a></li>
                        <?php }else{ ?> 
                        	<li><a href="../../admin/users/">User List</a></li>
                        	<?php } ?>
							 
							 <?php if($_SESSION['page']=="equipment"){ ?>
							  <li class="current-tab"><a href="../../admin/equipment/"><b> Equipment List</b></a></li>	
							 	<?php }else { ?>
							
					    <li><a href="../../admin/equipment/">Equipment List</a></li>		 
								<?php } ?>
							 <?php if($_SESSION['page']=="reported"){ ?>
							 <li class="current-tab"><a href="../../admin/reports/"><b> Reported Facilities</b></a></li>		
							 	<?php }else { ?>
						<li><a href="../../admin/reports/">Reported Facilities</a></li>
						<?php } ?>
							 <?php if($_SESSION['page']=="access"){ ?>
							 <li class="current-tab"><a href="../../admin/reports/accessLog.php"><b> Access Log</b></a></li>		
							 	<?php }else { ?>
                        <li><a href="../../admin/reports/accessLog.php">Access Log</a></li>
						<?php } ?>	
							
							<?php if($_SESSION['level']=="user"){ ?>
                        <?php if($_SESSION['page']=="adduser"){ ?>	
                        <li class="current-tab"><a href="../../admin/users/add.php"> <b>Add User</b> </a></li>
                        <?php } else{ ?>
                        <li><a href="../../admin/users/add.php">Add User</a></li>
                        <?php } ?>
                        <?php } ?>
                        
                        <?php if($_SESSION['level']=="facility"){ ?>
                        	
                        	
							<?php if($_SESSION['page']=="mapping"){ ?>
						<li class="current-tab"><a href="../../mapping.php">Facility Mappings</a></li>
						s<?php } else{ ?>
							<li><a href="../../mapping.php">Facility Mappings</a></li>
                        	
                        	
							<?php } if($_SESSION['page']=="addfacility"){ ?>
						<li class="current-tab"><a href="../../admin/facility/add.php"><b>Add Facility</b> </a></li>
						 <?php }else{ ?>
						 	<li><a href="../../admin/facility/add.php">Add Facility</a></li>
						 <?php } ?>
						 <?php } ?>
						 
						 
						 
						 <?php if($_SESSION['level']=="equipment"){ ?>					    
					    <li><a href="../../admin/equipment/equip.php">Equipment</a></li>
					    <li><a href="../../admin/equipment/facilityEquip.php">Facility Equipment</a></li>
					     <?php } ?>
					     
					     
						
					</ul>

					<div class="clearer">&nbsp;</div>

				</div>

			

			</div>

		</div>
