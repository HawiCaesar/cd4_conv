<?php
session_start();
require_once("includes/admin.php");
require_once("includes/dbConf.php");
$db = new dbConf();

//occurs on submission of the form
//$partnerid=$_SESSION['userID'];
$successsave=$_GET['successsave'];
$successallocation=$_GET['successallocation'];
$successdeletion=$_GET['successdeletion'];
?>
	<script type='text/javascript' src='includes/jquery.autocomplete.js'></script>

<link rel="stylesheet" type="text/css" href="includes/jquery.autocomplete.css" />
	 <script type="text/javascript">
$().ready(function() {
	
	$("#devicenumber").autocomplete("getdevices.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#devicenumber").result(function(event, data, formatted) {
		$("#deviceid").val(data[1]);
	});
});
</script>  
 
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.account.options[form.account.options.selectedIndex].value;
self.location='device.php?account=' + val ;
}

</script>

			  <p>&nbsp;</p><p>&nbsp;</p>
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>PIMA Devices</center></div>
		<?php if ($successsave !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successsave.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
            <?php if ($successallocation !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successallocation.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>


            <?php if ($successdeletion !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successdeletion.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
                <?php
@$displayperpage=$_GET['account']; // Use this line or below line if register_global is off
$orderBy = array('deviceNumber', 'location', 'dateAdded');
if (isset($displayperpage))
{
$rowsPerPage = $displayperpage; //number of rows to be displayed per page
}
else
{
$rowsPerPage = 10; //number of rows to be displayed per page
}
		// by default we show first page
		$pageNum = 1;
		
		// if $_GET['page'] defined, use it as page number
		if(isset($_GET['page']))
		{
		$pageNum = $_GET['page'];
		}
				// counting the offset
		$offset = ($pageNum - 1) * $rowsPerPage;
	

if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
	$ASCDESC = $_GET['njia'];
}
else
{
$order = 'dateAdded';
//$ASCDESC
}
if($_REQUEST['submitsearch'])
{	
$devicenumber = $_POST['devicenumber'];

if (!(isset($devicenumber)))
{
$devicenumber = $_POST['device'];
}

echo $query = "Select device.deviceID,device.deviceNumber,device.dateAdded,device.location,device.specLoc, partners.name FROM device,partners  where device.deviceNumber='$devicenumber' AND device.partnerID=partners.ID ";
$sql=mysql_query($query);
$sql2=mysql_query($query);
}
else
{
$query = "Select deviceID,deviceNumber,dateAdded,location,specLoc FROM device  ORDER BY ".$order  ." $ASCDESC  LIMIT $offset, $rowsPerPage";
$sql=mysql_query($query);
$sql2=mysql_query($query);
}

// retrieve and show the data :)
$numrows=mysql_num_rows($sql);
if ($numrows > 0 )
{


?>
<table>
<tr>
<td> Total Devices (<?php echo getalltotaldevices(); ?>)   </td>
<td><img src="img/search.png" ></td>
<td>  <form autocomplete="off" method="post" action="deviceslist.php">
					  
		  <input name="devicenumber" id="devicenumber" type="text" class="text" size="25" placeholder="Search Device" />
					    <input type="hidden" name="deviceid" id="deviceid" />&nbsp; 
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				
				
					
					
				</form>	</td>
			
				<td>
				 <form id="customForm"  method="get" action="" >
				 Per Page  <?php
				  $quer2=mysql_query("select * from pagination where name !='$rowsPerPage'");
		   		echo "<select name='account' id='account' onchange=\"reload(this.form)\"><option value='10'>10</option>";
while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['name']==@$displayperpage)
{echo "<option selected value='$noticia2[name]'>$noticia2[name] </option>"."<BR>";}
else
{echo  "<option value='$noticia2[name]'>$noticia2[name] </option>";}
}
echo "</select>";

		  	?>
				</form>
				</td>
				<td>
				 <?php 
		$numrows=gettotaldevices($partnerid); //get total no of batches
	
		// how many pages we have when using paging?
		$maxPage = ceil($numrows/$rowsPerPage);
		//echo " tt ".$rowsPerPage;
		// print the link to access each page
		$self = $_SERVER['PHP_SELF'];
		$nav  = '';

		for($page = 1; $page <= $maxPage; $page ++)
		{
		   if ($page == $pageNum)
		   {
			  $nav .= " $page "; // no need to create a link to current page
		   }
		   /*else
		   {
			  $nav .= " <a href=\"$self?page=$page\">$page</a> ";
		   }*/
		}
		
		// creating previous and next link
		// plus the link to go straight to
		// the first and last page
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?view=1&page=$page&displayperpage=$rowsPerPage\">Prev  |</a> ";
		
		   $first = " <a href=\"$self?view=1&page=1&displayperpage=$rowsPerPage\">First Page | </a> ";
		}
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?view=1&page=$page&displayperpage=$rowsPerPage\"> | Next | </a> ";
		
		   $last = " <a href=\"$self?view=1&page=$maxPage&displayperpage=$rowsPerPages\">  Last Page </a> ";
		}
		else
		{
		   $next = '&nbsp;'; // we're on the last page, don't print next link
		   $last = '&nbsp;'; // nor the last page link
		}
		
		// print the navigation link
		echo  $first . "  ". $prev  ." ". $nav . "  ". $next ."  ". $last ;
		?></td>
</tr>
 <form id="customForm"  method="post" action="" >
</table>
<table class="data-table">
<tr> 
<th><small> # </small></th><th><center><small> Device Number  <a href="deviceslist.php?orderBy=deviceNumber&njia=ASC"  title='Click to Sort Ascending'> <img src='img/asc.jpg' ></a> <a href="deviceslist.php?orderBy=deviceNumber&njia=DESC" title='Click to Sort Descending'> <img src='img/desc.jpg' ></a></small></center></th> <th><center><small> Location <a href="deviceslist.php?orderBy=location&njia=ASC"  title='Click to Sort Ascending'> <img src='img/asc.jpg' ></a> <a href="deviceslist.php?orderBy=location&njia=DESC" title='Click to Sort Descending'> <img src='img/desc.jpg' ></a> </small></center></th><th><center><small> Date Added <a href="deviceslist.php?orderBy=dateAdded&njia=ASC"  title='Click to Sort Ascending'> <img src='img/asc.jpg' ></a> <a href="deviceslist.php?orderBy=dateAdded&njia=DESC" title='Click to Sort Descending'> <img src='img/desc.jpg' ></a> </small></center></th>
<th><center><small> Facilities Tied to it   </small></center></th> 
<th><center><small> Performance   </small></center></th> 
<th><center><small> Partner Name  </small></center></th> 
</tr>

<?php
$i = 0; 
$num=1;
while(list($deviceID,$deviceNumber,$dateAdded,$location,$subLoc,$name)=mysql_fetch_array($sql))
{

$devicelocation=getdevicelocation($location);
$devicefacilitys=getfacilitiesperdevice($deviceID);
//$devicefacilitys=5;
if  (($dateAdded !="") && ($dateAdded !="1970-01-01") && ($dateAdded !="0000-00-00"))
{
$dateAdded  =date("d-M-Y",strtotime($dateAdded)); //convert to yy-mm-dd
}
else
{
$dateAdded  ="";
}


$editaction="<a href=\"" . "\" title='Click to Edit Device' ><img src='img/edit.png' >  </a>";

$deviceslinked=$devicefacilitys;

if ($transactiontype==1)//income
{
$icon="<img src='img/plus.png' >";
}
else //expense
{
$icon="<img src='img/minus.png' >";
}
?>


<tr class="even">
<td>  <?php  echo  $editaction;?> </td>
<td> <center><small> <?php echo $deviceNumber; ?></small></center></td>
<td><center><small> <?php if($devicelocation=='Other'){ echo $devicelocation."-".$subLoc; } else echo $devicelocation; ?></small></center></td>
<td><center><small> <?php echo $dateAdded ; ?></small></center></td>
<td><center> <small><?php echo $deviceslinked; ?></small></center></td>
<td>
<?php
$_SESSION['devices']=$deviceNumber;
?>
<a class="modalbox" href="#inline">View Performance</a>
<div id="inline">
<?php
$status=devPerformance($deviceNumber);
$_SESSION['device']=$status;
?>
	<h2>Device perfomance for <?php  echo $_SESSION['devices']; ?></h2>

	<table width="100%" >
    <tr class="even"><td>
                       <table class="data-table"> 
                       	<tr >
                        <td><strong>#</strong></td>
                          <td><strong>Last Upload</strong></td>
                          <td><strong>Errors</strong></td>
                          
                        </tr>
                        
                         <?php
						
						 $num=1;
							  //calls function with users
                                while($value=mysql_fetch_array($status)){									
							  ?>
 						 <tr class="even">
                         <td> <?php echo $num;  ?></td>
  							  <td> <?php echo $value['max'];  ?></td>
                              <td>  <?php echo $value['count']; ?></td>
                              </tr>
                              <?php } ?>
                         </table>
                         </td><td>
                         <div id="chartdivtrendddd" align="left"> </div>
		 <script type="text/javascript">
      var myChart = new FusionCharts("FusionCharts/Charts/Column2D.swf", "myChartId", "300", "200", "0", "0");
    myChart.setDataURL("xml/deviceerrors.php?dev=<?php  echo $_SESSION['devices']; ?>");
	myChart.render("chartdivtrendddd");
   </script>
					        
			
			
					</div>
                    
                         </td> 
                         </tr>  
					</table>
                    </div>
</td>
     <td><center> <small>
     	<?php echo $name; ?>
</small></center></td>
</tr>
<?php  

}
?>
</table>
</form>
<?php

}
else
{
echo " No Devices Added";
}
?>   
                
				  </div>
				
				</div>
				
				
				
			</div>

			<?php  		include("includes/sideAdmin.php"); ?>

			<div class="clearer">&nbsp;</div>

		</div>

		<div id="dashboard">

			<div class="column left" id="column-1">
				
				<div class="column-content">
				
			

				</div>

			</div>

			<div class="column left" id="column-2">

				<div class="column-content">
				
					

					
				</div>

			</div>

			<div class="column left" id="column-3">

				<div class="column-content">
				
					
				
				</div>

			</div>

		

			<div class="clearer">&nbsp;</div>

		</div>

	<?php
		include("includes/footer.php");
		?>	