<?php
session_start();

if (!isset($_SESSION['username'])) {
	$logoutGoTo = "index.php";
	@header("Location: $logoutGoTo");

} else {

	$patna = $_SESSION['userID'];
}

require ('Connections/config.php');
include ('function.php');
require_once ('classes/tc_calendar.php');
// ** Logout the current user. **

$logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
	$logoutAction .= "&" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true" && isset($_SESSION))) {
	//to fully log out a visitor we need to clear the session varialbles
	systemlastAccess($_SESSION['username'],$_SESSION['userNo'],$_SESSION['log']);
	session_destroy();
	$_SESSION['MM_Username'] = NULL;
	$_SESSION['MM_UserGroup'] = NULL;
	$_SESSION['PrevUrl'] = NULL;
	unset($_SESSION['MM_Username']);
	unset($_SESSION['MM_UserGroup']);
	unset($_SESSION['PrevUrl']);

	$logoutGoTo = "index.php";
	if ($logoutGoTo) {
		@header("Location: $logoutGoTo");
		exit ;
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

$D = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />   
     <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
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
	var tname = /^[A-Za-z0-9 ]{3,200}$/;
	var uname = /^[0-9 ]{3,20}$/;

	function validate() {

		var oname = document.getElementById('oname').value;
		var ename = document.getElementById('ename').value;
		var broker = document.getElementById('broker').value;
		var str1 = document.getElementById('date4').value;
		var str2 = document.getElementById('date5').value;

		var m1 = str1.substring(5, 7);
		var m2 = str2.substring(5, 7);
		var dt1 = str1.substring(8, 10);
		var dt2 = str2.substring(8, 10);
		var y1 = str1.substring(0, 4);
		var y2 = str2.substring(0, 4);

		var errors = [];
		var minlength = 6;

		if (dt2 > dt1) {
			alert("Date of Price Cannot be Greater than Date of Stamp");
			return false;

		}

		if (m2 > m1) {
			alert("Month of Price Cannot be Greater than Month of Stamp");
			return false;

		}

		if (y2 > y1) {
			alert("Year of Price Cannot be Greater than Year of Stamp");
			return false;

		}

		if (broker == "0") {
			alert("No Broker Name");
			return false;
		}

		if (str1 == "0000-00-00") {
			alert("No Date of Stamp");
			return false;

		}
		if (str2 == "0000-00-00") {
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

	function reportErrors(errors) {
		var msg = "Please Enter Valid Data...\n";
		for (var i = 0; i < errors.length; i++) {
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
		if (ele.style.display == "block") {
			ele.style.display = "none";
			YAP.style.display = "block";
			text.innerHTML = "SEARCH";
		} else {
			ele.style.display = "block";
			YAP.style.display = "none";
			text.innerHTML = "SEARCH";
		}
	} 
</script>
     <script language="JavaScript">
		function ShowHide(divId) {
			if (document.getElementById(divId).style.display == 'none') {
				document.getElementById(divId).style.display = 'block';
			} else {
				document.getElementById(divId).style.display = 'none';
			}
		}
</script>
 
  	<script language="javascript" src="calendar.js"></script>
 <link rel="STYLESHEET" type="text/css" href="calendar.css">
   
   <link rel="stylesheet" href="prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
</head>

<body id="top" >



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
				if (isset($_SESSION['username'])) {

					echo "<li><a href='" . $logoutAction . "'>Log Out</a></li>";
				} else {
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

				<div align="center"> <h1><img src="img/nascop.jpg" alt="" /></h1></div>

			</div>

			<div id="navigation">
				
				<div id="main-nav">
<small>
					<ul class="tabbed">
					
						<li class="current-tab"><a href="homesummary.php">Home Page</a></li>
						<li><a href="resultList.php">Result List</a></li>
							<li><a href="deviceslist.php">Devices </a></li>
						<li><a href="facilityList.php">CD4 Access</a></li>
                        <li> <a href="errors.php">Error List</a>
						<li><a href="reports.php">Reports</a></li>
						
						<!--<li><a href="<?php //echo $logoutAction; ?>>'"Log Out</a></li>-->
						
					</ul>
					</small>
<div class="content-separator"></div>
					

				</div>

			

			</div>

		</div>
		
			<div class="navigation" >
			<ul class="tabbed">
			
	
		
	<form id="customForm"  method="GET" action="" >
<table>
<tr> 

<th colspan="2">Period: &nbsp;<U><B><font color="#0000CC"><?php echo $title; ?></font></B></U>   |<small>  
<?php

   if ($filter==1)//LAST 3 MONTHS
	{?>
	<a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a> |
    <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a> 
<?php
}
elseif ($filter==7)//LAST 6 MONTHS
{
?>
	<a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload</a>  |
   <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
<?php
}
elseif (($filter==2) || ($_REQUEST['submitfrom']))//customeized
{
?>
	<a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Uploadn </a>  |
    <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a> |
 <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
<?php
}
elseif (($filter==4) || ($filter==3)) //month/year filter
{
 ?><a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a> | <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a>  |
 <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
 <?php
	}
	elseif (($filter==0) ||($filter=='')) //Lst submitted
	{
?>
	  <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 3 months Statistics">   Last 6 Months </a>  | <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
	<?php
	}
?>|    <a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" title=" Click to Filter View based on Date Range you Specify"> Customize Dates</a>   | Month/Year Filters > </small></th>	<td width='70'><li> &nbsp;</li></td>
<td>	
				<li><?php

				$year = GetMaxYear($patna);
				$twoless = GetMinYear($patna);
				for ($year; $year >= $twoless; $year--) {

					echo "<a href=$D?year=$year&filter=4 title='Click to Filter View to $year'>   $year  | </a>";
				}
						?>&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 <?php //echo "<a href =$D?year=2010&mwezi=13>Jan-Sep 2010 </a>"; ?>
				
				</li></td>
					
				<td ><li><?php $year = $_GET['year'];
						if ($year == "") {
							$year = date('Y');
						}
						echo "<a href =$D?year=$year&mwezi=1&filter=3 title='Click to Filter View to Jan, $year'>Jan</a>";
					?> | <?php echo "<a href =$D?year=$year&mwezi=2&filter=3 title='Click to Filter View to Feb, $year'>Feb </a>"; ?>| <?php echo "<a href =$D?year=$year&mwezi=3&filter=3 title='Click to Filter View to Mar, $year'>Mar</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=4&filter=3 title='Click to Filter View to Apr, $year'>Apr</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=5&filter=3 title='Click to Filter View to May, $year'>May</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=6&filter=3 title='Click to Filter View to Jun, $year'>Jun</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=7&filter=3 title='Click to Filter View to Jul, $year'>Jul</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=8&filter=3 title='Click to Filter View to Aug, $year'>Aug</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=9&filter=3 title='Click to Filter View to Sept, $year'>Sept</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=10&filter=3 title='Click to Filter View to Oct, $year'>Oct</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=11&filter=3 title='Click to Filter View to Nov, $year'>Nov</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=12&filter=3 title='Click to Filter View to Dec, $year'>Dec</a>"; ?>  </li></td>

</tr>
<tr>
<th><div class="mid" id="HiddenDiv" style="DISPLAY: none" >
<table style="width:340px" >
<tr>
		<td> <?php
		$myCalendar = new tc_calendar("fromfilter", true, false);
		$myCalendar -> setIcon("img/Calendar.gif");
		$myCalendar -> setDate(date('d'), date('m'), date('Y'));
		$myCalendar -> setPath("./");
		$myCalendar -> setYearInterval($lowestdate, $currentdate);
		$myCalendar -> setDateFormat('j F Y');
		$myCalendar -> writeScript();
		  ?></td> <td> - </td> 
		<td> <?php
		$myCalendar = new tc_calendar("tofilter", true, false);
		$myCalendar -> setIcon("img/Calendar.gif");
		$myCalendar -> setDate(date('d'), date('m'), date('Y'));
		$myCalendar -> setPath("./");
		$myCalendar -> setYearInterval($lowestdate, $currentdate);

		$myCalendar -> setDateFormat('j F Y');
		$myCalendar -> writeScript();
		  ?></td>
		  <td>
		    <input type="submit" name="submitfrom" value="Filter" class="button"/></td>
			</tr></table>
</div></th>
</tr></table>
</form>

	
	
			</ul>
		</div>
        
         <!-- basic fancybox setup -->
<script type="text/javascript">
	function validateEmail(email) {
		var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return reg.test(email);
	}


	$(document).ready(function() {
		$(".modalbox").fancybox();
		$("#contact").submit(function() {
			return false;
		});

		$("#send").on("click", function() {
			var emailval = $("#email").val();
			var msgval = $("#msg").val();
			var msglen = msgval.length;
			var mailvalid = validateEmail(emailval);

			if (mailvalid == false) {
				$("#email").addClass("error");
			} else if (mailvalid == true) {
				$("#email").removeClass("error");
			}

			if (msglen < 4) {
				$("#msg").addClass("error");
			} else if (msglen >= 4) {
				$("#msg").removeClass("error");
			}

			if (mailvalid == true && msglen >= 4) {
				// if both validate we attempt to send the e-mail
				// first we hide the submit btn so the user doesnt click twice
				$("#send").replaceWith("<em>sending...</em>");

				$.ajax({
					type : 'POST',
					url : 'sendmessage.php',
					data : $("#contact").serialize(),
					success : function(data) {
						if (data == "true") {
							$("#contact").fadeOut("fast", function() {
								$(this).before("<p><strong>Success! Your feedback has been sent, thanks :)</strong></p>");
								setTimeout("$.fancybox.close()", 1000);
							});
						}
					}
				});
			}
		});
	}); 
</script>


