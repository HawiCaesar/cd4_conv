<?php 
session_start();
require_once("includes/admin.php");
require_once("includes/dbConf.php");


$success = $_GET['success'];
//echo "age in months ".$ageinmonths;
if($_REQUEST['adddistrict'])
{	
$dname = mysql_real_escape_string(ucwords($_GET['dname']));
$cname = $_GET['cname'];




//insert into facility
$sql=mysql_query("INSERT INTO districts(name,county) VALUES ('$dname','$cname')") or die (mysql_error());

if ($sql)
{
$succes=$dname." Successfully Added ";
			echo '<script type="text/javascript">' ;
			echo "window.location.href='adddistrict.php?success=$succes'";
			echo '</script>';
}  //end if sql
else
{
		$error="Failed Saving , try again ";
}


}//end if

?>
<script>
$().ready(function(){
	

	
	
});
</script>

  <script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getSiteSpecs(level) {		
		
		var strURL="findSiteSpecs.php?level="+level;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
</script>
<script>
		window.dhx_globalImgPath="img/";
	</script>
<script src="dhtmlxcombo_extra.js"></script>
 <link rel="STYLESHEET" type="text/css" href="dhtmlxcombo.css">
  <script src="dhtmlxcommon.js"></script>
  <script src="dhtmlxcombo.js"></script>
<link href="base/jquery-ui.css" rel="stylesheet" type="text/css"/>
 <script src="jquery-ui.min.js"></script>
		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">
                 	<div class="section-title">ADD DISTRICT</div>
					<?php if ($success !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$success.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
<?php if ($error !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="error"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$error.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
                   <form id="customForm" method="get" action="" autocomplete="Off">
				   <center>
				    <tr>
              <td colspan="4" width="414">The fields indicated asterix (<span class="mandatory">*</span>) are mandatory.</td>
            </tr>
<table  border="0" class="data-table">
                 
                        <tr class="even">
                        <td> <span class="mandatory">*</span>District Name</td>
                        <td><input type="text" name="dname" class="text" style='width:188px;'/></td>
                     
                         	
						
                       	<tr class="even">
                        <td><span class="mandatory">*</span> County</td>
                        <td>
	  
	  <?php
	   $dquery = "SELECT ID,name FROM countys order by name asc";
	   $dresult = mysql_query($dquery) or die('Error, query failed'); //onchange='submitForm();'
?>
<div>
<select style='width:200px;'  id="cname" name="cname">
 <option value=''></option>
			  <?php
			   while ($row = mysql_fetch_array($dresult))
     	 {		 $ID = $row['ID'];
			$name = $row['name'];
			  ?>
              <option value="<?php echo  $ID; ?>"><?php echo $name; ?></option>
			<?php
			}?>
            </select><span id="codeInfo"></span>
			</div>
			<script>
var z = dhtmlXComboFromSelect("cname");
z.enableFilteringMode(true);
</script>
	  
	  
	  </td>
                         
  						 </tr>
                      
						  
                          <tr>
    							<td colspan="2"> <div align="center"> <input type="submit" name="adddistrict" value=" Save District " style='width:188px;' class="button" > </div> </td>
    						
  						</tr>
                        
					</table>
                    </center>
                    
					<div class="clearer">&nbsp;</div>

      </div>

				<div class="content-separator"></div>
				
			</div>

			<?php  	
			
				include("includes/sideAdmin.php"); ?>

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
  ob_end_flush();
		?>	

