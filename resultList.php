<?php
session_start();
require_once("includes/header.php");
require_once("includes/dbConf.php");
$db = new dbConf();
$partnerid=$_SESSION['userID'];
?>

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
self.location='resultList.php?account=' + val ;
}

</script>



			  
			 <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Uploaded Resultlist</center></div>
		


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
	$yrs=getyearsreported($partnerid);

?>
<table>
<tr>
<td>    </td>
<td><img src="img/search.png" ></td>
<td>  <form autocomplete="off" method="get" action="resultList.php">
			<select name="months">
            <option selected="selected" value="0">Select month</option>
            <option value="1">Jan</option>
            <option value="2">Feb</option>
            <option value="3">Mar</option>
            <option value="4">Apr</option>
            <option value="5">May</option>
            <option value="6">Jun</option>
            <option value="7">Jul</option>
            <option value="8">Aug</option>
            <option value="9">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
            </select>
            
					  
				<select name="yrs">
                <option selected="selected" value="0">select year</option>
				<?php
				while($rs=mysql_fetch_array($yrs)){
					
					?>
                    <option value="<?php echo $rs['yr']; ?>"><?php echo $rs['yr']; ?></option>
                    
                    <?php
					} 
				?>
					</select>
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
			
				</tr></table>
<table class="data-table">
<tr> 
<th><small> Month/Year </small></th>
<th><center><small> Date of Upload  </small></center></th> 
<th><center><small>  Error Number </small></center></th> 
<th><center><small>  Error Categories </small></center></th>
<th><center><small>  Devices Reported </small></center></th>
<th><center><small>% Reporting </small></center></th>
<th><center><small> Action </small></center></th> 
</tr>





 <?php  
$yrMnth=array();
if(isset($_GET['months'])){
$sql="SELECT MIN(  `resultDate` ) AS minMonth, MAX(  `resultDate` ) AS maxMonth FROM  `test` WHERE year(resultDate)='".$_GET['yrs']."' AND  partnerID=".$partnerid  ;
	}
	else
 $sql="SELECT MIN(  `resultDate` ) AS minMonth, MAX(  `resultDate` ) AS maxMonth FROM  `test` WHERE partnerID=".$partnerid;
			$yrMnth=array();
			$rs=mysql_query($sql);
			while($res=mysql_fetch_array($rs)){
			 $yrMnth[0]=$res['minMonth'];
			 $yrMnth[1]=$res['maxMonth'];
			}
			 $minYr=substr($yrMnth[0], -10, 4);
			//echo $minYr."<br />";
			$minMonth=substr($yrMnth[0], -5, 2);
				//echo $minMonth."<br />";
			 $maxYr=substr($yrMnth[1], -10, 4);
			 //echo $maxYr."<br />";
			$maxMonth=substr($yrMnth[1], -5, 2);
			//echo $maxMonth."<br />";
			if(isset($_GET['months']) && isset($_GET['yrs'])){
				$minYr=$_GET['yrs'];	
				$maxYr=$_GET['yrs'];
				$maxMonth=$_GET['months'];
				$minMonth=$_GET['months'];
				
			}
			else{
				$minMonth=1;
				$maxMonth=12;
			}

for($i=$maxYr;$i>=$minYr;$i--){
for($j=$maxMonth;$j>=$minMonth;$j--){
if(ifreported($j, $i, $partnerid)>0){
	?><tr>
<td> <a href="monthResult.php?month=<?php echo $j; ?>& year=<?php echo $i; ?> "> <?php echo date("F", mktime(0, 0, 0, $j, 3)).",".$i;?> </a> </td>

<td> <center><small> <?php  uploadDay($j,$i,$partnerid); ?></small></center></td>
<td><center><small><?php 

if($devicelocation=totalMonthErr($j,$i,$partnerid)!=0){echo $devicelocation=totalMonthErr($j,$i,$partnerid);
}
else
echo "No errors";
?></small></center></td>
<td><center><small>
<?php if($devicelocation=uniqueErr($j,$i,$partnerid)!=0){   ?>
 <a class="modalbox" href="#inline1"> <?php echo $devicelocation=uniqueErr($j,$i,$partnerid); ?> </a> </small></center>
<?php $status=uniqueErrDetails($j,$i,$partnerid); ?>
<div id="inline1">
	<center><h2>Errors Received</h2></center>

	<table width="300" class="data-table">
                        
                       	<tr>
                        <td><strong>#</strong></td>
                        <td><strong>Number</strong></td>
                          <td><strong>Detail</strong></td>
                          
                        </tr>
                        
                         <?php
						 $num=1;
							  //calls function with users
                                while($value=mysql_fetch_array($status)){
									
							  ?>
 						 <tr>
                         <td> <?php echo $num;  ?></td>
  							  <td> <?php echo $value['num'];  ?></td>
                              <td>  <?php echo $value['dtail'];?></td>
                         </tr>
                         <?php
								$num+=1;	
								}
                         ?>
                              
					</table>
</div>
<?php
}
else
echo "No errors";
?>
</td>
<td><center><small> <?php echo  $dateAdded=deviceRptMonth($j,$i,$partnerid); ?></small></center></td>
<td><center> <small><?php echo percentageReport($j,$i,$partnerid)." "."%"; ?></small></center></td>
<td><a href="monthResult.php?month=<?php echo $j; ?>& year=<?php echo $i; ?> ">View details</a></td>

</tr>

<?php } 
 }
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