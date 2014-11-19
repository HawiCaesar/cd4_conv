<?php

//echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
@session_start(); 
include('includes/commodityheader.php');
include("includes/dbConf.php");

$db=new dbConf();
$mine=$_SESSION['calibur'];

?>
 <div class="main" id="main-two-columns" valign="top" class="xtop">
 	<p>&nbsp;</p><br />
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
</form></div>

<div class="mydiv" style="margin:auto; width: 90%;">
	 <div class="section-title" style="width: 98.5%;"><center>Facs Calibur Results&nbsp;&nbsp;
	 	<?php 
	 	echo '<a  target=\'_blank\' href="caliburwsprint.php?site='.$_SESSION['username'].'&prefix='.$value['SITE'].'
&mwaka='. $currentyear.'&mwezi='.$currentmonth.'&filtertype='.$filter.'&fromfilter='.$fromfilter.'&tofilter='.$tofilter.'&fromdate='.$fromdate.'
&todate='.$todate.'"  title="Click to Print Individual results">Print Today\'s Worksheet <img src="img/print.png"/></a><center>';
	 	?>
	 	
	 	</center></div>	
                
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


 <link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
 <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
 <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
 <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                $(document).ready(function() {
					$('.table2').dataTable({
						"sScrollY": "100%"
						});
				});
                </script>

<?php

//echo "<br /><br /><br /><br /><br /><br /><br /><br /><br />";
//checkwhichequip($_SESSION['facility']);   


?>		

<?php
$msg=$_GET['successsave'];
 if ($msg !="")
        {
        ?> 
        <table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
        
echo  '<strong>'.' <font color="#666600">'.$msg.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
    
<table width="90%" class="table2" >
	<thead> 
	
		
     
    <tr>
        <th rowspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Facility&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th rowspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;CD4 Device&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th rowspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Total Tests Done&nbsp;&nbsp;&nbsp;&nbsp;</th>
        
        <th colspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<center>Adult Tests</center>&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="2" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<center>Paediatric Tests</center>&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="3" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<center>Tasks</center>&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>
    <tr>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Total Tests&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "# CD4 < 350cells/mm3"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Total Tests&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "# CD4 < 25%"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Facility Summary&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Individual Results&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
   
</thead>
 <tbody>
 <?php

     testingreportingtable($mine,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
?>
 </tbody>
 </table>

 



<?php
if(isset($_POST['submit_1']) && $_POST['format']="excel"){

header("Location:Classes/excel.php");
}
?>
<div>
  <form name="frm" method="post" enctype="multipart/form-data" id="frm_2">
                 
                   <div style="border:medium;background-position:center;c height:auto;">
                  </div>
                   </form>


	<?php
		include("includes/footer.php");
		?>