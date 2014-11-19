 <?php
require_once("includes/dbConf.php");
$db = new dbConf();
	if(isset($_GET['month']) || isset($_GET['year'])){
  $_SESSION['yearly']=$_GET['year'];
  $_SESSION['monthly']=$_GET['month'];
		}
	
	$month=$_SESSION['monthly'];
	$year=$_SESSION['yearly'];
	$partnerid=$_SESSION['userID'];
	
	if(isset($_GET['account'])){
		$numRws=$_GET['account'];
		}
		else{
			$numRws=10;
			}
		$rs1=monthlyReports($month,$year,$partnerid,$numRws);
?>

<?php require_once("includes/header.php"); ?>
 <script type="text/javascript">
$(document).ready(function(){
	
	
	
	
	
	
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
self.location='monthResult.php?account=' + val  ;
}

</script>



			  
			 <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>
                 Results upload for <?php
				 
				 $month1=date("M", mktime(0, 0, 0, $month, 1));
				   echo $month1." ". $_GET['year']; ?>
                 </center></div>
		


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
	

?>
<table>
<tr>
<td><img src="img/search.png" ></td>

<td>  <form autocomplete="off" method="post" action="qccc.php">
		  <input name="sampleNo" id="sampleNo" type="text" class="text" size="25" placeholder="Search Sample"/>
					    <input type="hidden" name="hide" id="hide" />&nbsp; 
					  <input name="submitsearch" type="submit" class="button" value="Go"/>
				
				</form>	
                </td>
                <td> <a href="resultList.php" ><img src="img/back.gif"></a></td>
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
                
			
				</tr></table>
<table class="data-table">
<tr> <th><center><small> # </small></center></th> 
<th><center><small>Device Number </small></center></th> <th><center><small>  Error </small></center></th>
<th><center><small> CD4 Count</small></center></th>
<th><center><small> Operator</small></center></th>
<th><center><small>Date of Upload  </small></center></th>

</tr>





 <?php  
$yrMnth=array();
$sql="SELECT MIN(  `resultDate` ) AS minMonth, MAX(  `resultDate` ) AS maxMonth FROM  `test` WHERE partnerID=".$partnerid;
			$yrMnth=array();
			$rs=mysql_query($sql);
			while($res=mysql_fetch_array($rs)){
			 $yrMnth[0]=$res['minMonth'];
			 $yrMnth[1]=$res['maxMonth'];
			}
			 $minYr=substr($yrMnth[0], -10, 4);
			 $minMonth=substr($yrMnth[0], -5, 2);
			$maxYr=substr($yrMnth[1], -10, 4);
			 $maxMonth=substr($yrMnth[1], -5, 2);
			

$num=1;
while($result=mysql_fetch_array($rs1)){
	?>
	<tr>
<td> <center><small> <?php  echo $num; ?></small></center> </td>
<td> <center><small> <?php  echo $result['deviceID']; ?></small></center> </td>
<td> <center><small> <?php  if( $result['errorID']==0){ echo "No Error";}else echo $result['errorID']; ?></small></center> </td>
<td> <center><small> <?php  echo $result['cdCount']; ?></small></center> </td>
<td> <center><small> <?php  echo $result['operatorId']; ?></small></center> </td>
<td> <center><small> <?php  echo date("d-M-Y",strtotime($result['uploadDate'])); ?></small></center> </td>

</tr>
<?php 
$num++;
}
?>
</table>


</form> 

<!-- hidden inline form -->

</div>
				
				</div>


				
				
				
			</div>

			<?php  		include("includes/sidebar.php"); ?>

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