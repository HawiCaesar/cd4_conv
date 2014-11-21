<?php

@session_start();
if($_GET[doLogout]=="true"){
	
	 $logoutGoTo="homecommodity.php";
	 @header("Location: $logoutGoTo");
}
require('Connections/config.php');
include('function.php');
//include("FusionMaps/FusionMaps.php");
require_once('classes/tc_calendar.php');
// ** Logout the current user. **

$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true" && isset($_SESSION))){
	systemlastAccess($_SESSION['username'],$_SESSION['facility'],$_SESSION['log']);
  //to fully log out a visitor we need to clear the session varialbles
  session_destroy();
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "homecommodity.php";
  if ($logoutGoTo) {
    @header("Location: $logoutGoTo");
    exit;
  }
}

$mwaka = $_GET['year'];
$mwezi = $_GET['mwezi'];

if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	if ($filter == 1)//LAST 3 MONTHS
	{
		$todate = date("Y-m-d");
		// current date
		$fromdate = date('Y-m-d', strtotime('-3 month'));
		$displayfromdate = date("d-M-Y", strtotime($fromdate));
		$displaytodate = date("d-M-Y", strtotime($todate));
		$title = "Last 3 Months";
		$currentmonth = date("m");
		$currentyear = date("Y");
		$colspan = 3;
		$mapwidth = 540;

	} elseif ($filter == 7)//last 6 months
	{
		$todate = date("Y-m-d");
		// current date
		$fromdate = date('Y-m-d', strtotime('-6 month'));
		$displayfromdate = date("d-M-Y", strtotime($fromdate));
		$displaytodate = date("d-M-Y", strtotime($todate));
		$title = "Last 6 Months";
		$currentmonth = date("m");
		$currentyear = date("Y");
		$colspan = 6;
		$mapwidth = 540;
	} elseif ($filter == 0)//last submission
	{
		$filter = 0;
		$colspan = 6;
		$mapwidth = 540;
		$currentmonth = GetMaxMonthbasedonMaxYear($patna);
		$displaymonth = GetMonthName($currentmonth);
		$currentyear = GetMaxYear($patna);
		$title = "Last Upload:" . $displaymonth . ' - ' . $currentyear;
		//get current month and year
	} elseif ($filter == 3)//month/year
	{
		$displaymonth = GetMonthName($mwezi);
		$title = $displaymonth . ' - ' . $mwaka;
		//get current month and year
		$currentmonth = $mwezi;
		$currentyear = $mwaka;
		$colspan = 1;
		$mapwidth = 540;
	} elseif ($filter == 4)//year
	{
		$title = $mwaka;
		//get current month and year
		$currentmonth = "";
		//get current month and year
		$currentyear = $mwaka;
		$colspan = 12;
		$mapwidth = 400;
	}
} else {
	if ($_REQUEST['submitfrom']) {
		$filter = 2;
		$fromfilter = $_GET['fromfilter'];
		$tofilter = $_GET['tofilter'];
		$displayfromfilter = date("d-M-Y", strtotime($fromfilter));
		$displaytofilter = date("d-M-Y", strtotime($tofilter));
		$title = $displayfromfilter . "  to  " . $displaytofilter;
		$currentmonth = date("m");
		$currentyear = date("Y");
		$colspan = 1;
		$mapwidth = 540;
	} else {
		if (isset($mwaka)) {
			if (isset($mwezi)) {
				$filter = 3;
				$displaymonth = GetMonthName($mwezi);
				$title = $displaymonth . ' - ' . $mwaka;
				//get current month and year
				$currentmonth = $mwezi;
				$currentyear = $mwaka;
				$colspan = 1;
				$mapwidth = 540;
			} else {
				$filter = 4;
				$title = $mwaka;
				//get current month and year
				$currentmonth = "";
				//get current month and year
				$currentyear = $mwaka;
				$colspan = 12;
				$mapwidth = 400;
			}
		} else {	$filter = 0;
			$colspan = 6;
			$mapwidth = 540;

			$currentmonth = GetMaxMonthbasedonMaxYear($_SESSION['userID']);
			$displaymonth = GetMonthName($currentmonth);
			$currentyear = GetMaxYear($_SESSION['userID']);
			$title = "Last Upload:" . $displaymonth . ' - ' . $currentyear;
			//get current month and year
		}
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
	<link rel="stylesheet" type="text/css" href="style1.css" media="screen" />   
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
     <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
     <script type="text/javascript" src="js/jquery-ui.js"></script>
    <SCRIPT LANGUAGE="Javascript" SRC="FusionCharts/FusionCharts.js"></SCRIPT>
  <script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.0.6"></script>
  <script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="style2.css">
    <link rel="stylesheet" type="text/css" media="all" href="fancybox/jquery.fancybox.css">
	<title>CD4 LIMS</title>
     <link rel="SHORTCUT ICON" href="img/favicon.ico">
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
 
  	<script language="javascript" src="calendar.js"></script>
 <link rel="STYLESHEET" type="text/css" href="calendar.css">
   <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
   <link rel="stylesheet" href="prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
</head>

<body id="top" >

		<div class="clearer">&nbsp;</div>
<div id="site" >

		<div id="header">	
			<div id="network">

		<div class="left"><?php echo "<b>" . date("l, d F Y") . "</b>"; ?> <span class="text-separator">|</span> <span class="quiet">
        
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
				if (isset($_SESSION['facility'])) {

					echo "<li><a href='" . $logoutAction . "'>Log Out</a></li>";
				} 
				if(!isset($_SESSION['username'])){ 
						echo "<li><a href='facilitylogin.php'>Facility Login</a></li>";
					}
					 if(!isset($_SESSION['username'])){
						echo "<li><a href='login.php'>Admin Login</a></li>";
						}
					if(!isset($_SESSION['username'])){
						echo "<li><a href='http://www.nascop.org/cd4Poc/'>PIMA Login</a></li>";
						}
				else {
					
				}
		?>
			</ul>

			<div class="clearer">&nbsp;</div>
		
		</div>
		
		<div class="clearer">&nbsp;</div>

	
</div>	
			
			<div class="clearer">&nbsp;</div>

			<div id="site-title">

				<div align="center"> <h1><img src="img/nascop.jpg" alt="" /></h1></div>

			</div>

			<div id="navigation">
				
				<div id="main-nav">
<small>
					<ul class="tabbed">
						
						
						<?php if(!isset($_SESSION['username'])){ ?>
					  	<li class="current-tab"><a href="homecommodity.php">National Overview</a></li>
					  	<?php } ?>
					  	
					  	<?php if(isset($_SESSION['username'])){ ?>
					  	<li class="current-tab"><a href="facilitydashboard.php">Facility Dashboard</a></li>
					  	<?php } ?>
					  	<?php if(!isset($_SESSION['username'])){ ?>
                        <li> <a href="testingtrends.php">Regional View</a>
                        <?php } ?>
                        <?php if(!isset($_SESSION['username'])){ ?>
					 <li ><a href="homeprogram.php">Device Distribution</a></li>
						<li ><a href="equipment.php">Available Equipment</a></li>
						<li ><a href="mapping.php">HIV Mapping Matrix</a></li>
						<li ><a href="reportingCycle.php">Reporting Cycle</a></li>
						 <?php } ?>
						 <?php $day=date(d);
						 if($day<=30){
						  ?>
						<li><a href="cd4commodity.php">Submit Consumption Report</a></li>
						<?php }else{?>
						<li><a href="#" title="FCDRR Submission Deadline has passed" >Submit Consumption Report</a></li>	
							<?php } ?>
						<?php if($_SESSION['upload']==0){ ?>
						<li><a href="uploadfacsdata.php">Upload Calibur data</a></li>
						<?php } ?>
						<?php if($_SESSION['upload']==1){ ?>
						<li><a href="uploadfacsdatall.php">Upload Calibur data</a></li>
						<?php } ?>
						<?php if($_SESSION['upload']==2){ ?>
						<li><a href="uploadfacsdatallcode.php">Upload Calibur data</a></li>
						<?php } ?>
						
						<?php if($_SESSION['upload']==3){ ?>
						<li><a href="uploaddatamachackos.php">Upload Calibur data</a></li>
						<?php } ?>
						<?php if(isset($_SESSION['username'])){ ?>
						<li><a href="facscaliburresults.php">FACS Calibur Results</a></li>
						<?php } ?>
						
							<?php if(isset($_SESSION['username'])){ ?>
						<li><a href="FCDRRLists.php">FCDRR LIST</a></li>
						<?php } ?>
						
							
						<?php if(isset($_SESSION['facility'])){ ?>
						<li><a href="#mineModal_<?php echo $_SESSION['facility']; ?>" data-toggle="modal" class="menuitem submenuheader">Change Password</a></li>
						<?php } ?>
						<li><a target="_blank" href="commodityuserguide.pdf">User Manual</a></li>
						
						
						<!--<li><a href="<?php //echo $logoutAction; ?>>'"Log Out</a></li>-->
						
					</ul>
					</small>
<div class="content-separator"></div>
					

				</div>

			

			</div>

		</div>
    			
						<div id="mineModal_<?php echo $_SESSION['facility']; ?>" class="modal hide fade" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width; >
	<div class="modal-header">
	
	<center><b>Enter New Password Details</b></center>
		
	</div>
	
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
	<div class="modal-body">	
         <form name="frm" action="facchangepass.php" method="post" enctype="multipart/form-data" id="f1">
         	<input type="hidden" name="mfl" value="<?php  echo $_SESSION['facility']; ?>" />
		 <table width="100%">
		 <tr>
		 	<td> <b> Old Password:</b></td><td><input type="text" class="text" name="oldpass" style="border-color:#006699; " /></td>
		 </tr>	
		  <tr>
		 	<td> <b>New Password:</b></td><td><input type="text" class="text" name="newpass" style="border-color:#006699; "/></td>
		 </tr>	
		  <tr>
		 	<td> <b>Repeat Password:</b></td><td><input type="text" class="text" name="newpass2" style="border-color:#006699; " /></td>
		 </tr>	
		 </table>
		 <div style="display:block;margin-top:1em"><center>
		 <button class="btn btn-primary" input type="submit" name="submit" >
		submit
		</button>
		<button class="btn" input type="reset" name="cancel" aria-hidden="true" data-dismiss="modal">
		cancel
		</button>
		</center>
		</div>
       </form>
	</div>
	<div class="modal-footer">
	
	<div class="right">
			&copy <?php echo date('Y'); ?> NASCOP
		</div>
	</div>	</div>