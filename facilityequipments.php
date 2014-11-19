<?php
//include("includes/Admin.php");
session_start();
$usergroup= $_SESSION['userRights'];
include('function.php');
require('Connections/config.php');
$AutoFacility= $_GET['facility'];
$level= $_GET['level'];
$centralsiteAutoID= $_GET['centralsiteAutoID'];
$successdeletion=$_GET['successdeletion'];
$successallocation=$_GET['successallocation'];
if (isset($AutoFacility))
{
$facilityname=GetFacilityName($AutoFacility);
$pagetitle=  " Equipment";

if ($level==0) //central sites
{
$totalreferalsites=GetTotalReferalSitesPerCentral($AutoFacility);
$ftype="Central Site";
}
else
{
$ftype="Referral Site";
if (isset($centralsiteAutoID))
{
$centralsitename=GetFacilityName($centralsiteAutoID);
}

}//end if site type
}


if ($_REQUEST['Submit'])
{
$checkbox= $_POST['checkbox'];
$allocated= $_POST['allocated'];
$facility= $_POST['facility'];
$currentchecked= $_POST['currentchecked'];
$equipmentid= $_POST['equipmentid'];
//foreach($checkbox as $a => $b)
foreach($_POST['allocated'] as $eq_id => $allocated) 
 	{
	//.. " - ". $currentchecked[$a]
	
	$currentselection=$currentchecked[$eq_id-1];
	$equipment=$equipmentid[$eq_id-1];
	echo   $equipment ."   old:  ".$currentselection . " <> ". $allocated   . '<br/>';
/*
	if ($currentselection ==0  && $allocated==1) //asssign equipment to facility
	{
	
	$sql=mysql_query("insert into facilityequipments(facility,equipment) values('$facility','$equipment')") or die(mysql_error());
if ($sql)
		{
		$success='<center>'.  'Successfully Updated Facility Equipment Allocation Details.</center>';	
		}
		else
		{
		$error='<center>'.  'Failed Updating Details, Try Again Below.</center>';	
		}
	
	}
	elseif($currentselection ==0  && $allocated==0) //do nothing
	{ //echo "No change". '<br/>'; 
	}
	elseif($currentselection ==1  && $allocated==0) //unassign equipment frm facility
	{
	//echo " unassign ". $allocated[$a] . " - ".$equipmentid[$a] . '<br/>';
	$sql=mysql_query("delete from facilityequipments where facility= '$facility' AND equipment='$equipment'") or die(mysql_error());
if ($sql)
		{
		$success='<center>'.  'Successfully Updated Facility Equipment Allocation Details.</center>';	
		}
		else
		{
		$error='<center>'.  'Failed Updating Details, Try Again Below.</center>';	
		}
	}
	elseif($currentselection ==1  && $allocated==1) //do nothing
	{
	//echo "No change". '<br/>';
	}
		*/
	
	
	}//end for

}//end if request

?>





   
    <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxtabs.js"></script>
	<SCRIPT LANGUAGE="Javascript" SRC="FusionMaps/JSClass/FusionMaps.js"></SCRIPT>
<SCRIPT LANGUAGE="Javascript" SRC="FusionCharts/FusionCharts.js"></SCRIPT>
<script language="JavaScript" src="FusionWidgets/FusionCharts.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // create jqxtabs.
            $('#jqxtabs').jqxTabs({ width: 1200, height: 1000 });
            $('#jqxtabs').bind('selected', function (event) {
                var item = event.args.item;
                var title = $('#jqxtabs').jqxTabs('getTitleAt', item);
                
            });
        });
    </script>
	<script type="text/javascript" src="ddaccordion.js">

        /***********************************************
         * Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
         * Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
         * This notice must stay intact for legal use
         ***********************************************/

</script>


<script type="text/javascript">


        ddaccordion.init({
            headerclass: "submenuheader", //Shared CSS class name of headers group
            contentclass: "submenu", //Shared CSS class name of contents group
            revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
            mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
            collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
            defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
            onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
            animatedefault: false, //Should contents open by default be animated into view?
            persiststate: true, //persist state of opened contents within browser session?
            toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
            togglehtml: ["suffix", "<img src='img/plus.gif' class='statusicon' />", "<img src='img/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
            animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
            oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                //do nothing
            },
            onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                //do nothing
            }
        })


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
<link rel="stylesheet" type="text/css" href="glossstyle.css" />
<link rel="stylesheet" type="text/css" href="style.css" />

 <?php if ($successallocation !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.$successallocation.'</strong>';

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
		
echo  '<strong>'.$successdeletion.'</strong>';

?></div></th>
  </tr>
</table>
<?php } ?>
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
		
echo  '<strong>'.$error.'</strong>';

?></div></th>
  </tr>
</table>
<?php } ?>
<?php
if ($usergroup !=2)
{

}
else
{?>
 <form id="customForm"  method="POST" action="" >
	
| &nbsp;&nbsp;
 <font color="#ABC">  
 <a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" title=" Click to Edit Equipment Allocation"> * Click Here to Edit Equipment Allocation</a>   
 
   </font> &nbsp;&nbsp; |  
   <br>
   <br>
   
   <div class="mid" id="HiddenDiv" style="DISPLAY: none" >
        <TABLE style="font-family:cambria; font-size:11px ; width:1150px" class="data-table" >
<?php
			$eq=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			$eq2=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			?>
<tr class="even">
<th > Facility </th>

 <?php
//echo  getmaxitemsbycategory();
 while(list($eqID,$description)=mysql_fetch_array($eq))
 { 
 ?>
 <th > <?php echo $description;?> </th> 
  <?php
 }
	echo '</tr>';?>


<tr class="even">
			<?php
				list($ontreatment, $oncare)=getpatientsnumbers($AutoFacility);
		$pload=$ontreatment + $oncare;?>
			<td valign="top" class="xtop" style="vertical-align: top"><?php echo  $facilityname ;?></td>
		
			<?php
			$fcount=0;
 while(list($eqID,$description)=mysql_fetch_array($eq2))
 {  	$fcount=$fcount+1;
		$totaleqbycat=GetTotalEquipmentsbyCategory($eqID);
        ?>
 
		 <?php 
		 //get equipments
 			$eqq=mysql_query("select ID,description from equipments where flag=1 and category='$eqID'") or die(mysql_error());
     		if (mysql_num_rows($eqq) > 0)
			{?>
			<td valign="top"  height="1" style="vertical-align: top">
			<table class="data-table"  style="height: 50px">
			
			<?php	
			while(list($eqqID,$edescription)=mysql_fetch_array($eqq))
			{
			
		list($cvalue,$checked)=GetIfEquipmentsinFacility($AutoFacility,$eqqID);
		
			
			?>
			
		<tr class="even">
			
			<td style="vertical-align: top">
              	
			<input type="hidden" name="facility" id="facility"  value="<?php echo $AutoFacility; ?>	" />
			<input type="hidden" name="equipmentid[]" id="equipmentid[]"  value="<?php echo $eqqID; ?>	" />
	<?php 
				if ($cvalue==1)
				{
				?>
			<input type="checkbox" name="allocated" id="allocated"  value="1" checked disabled  />
			
			<?php echo $edescription;?>&nbsp;
		<?php echo " <a href=\"deallocatequipment.php" ."?equipmentAutoID=$eqqID&facility=$AutoFacility&level=$level&centralsiteAutoID=$centralsiteAutoID" . "\" title='Click to Remove Equipment from $facilityname '  OnClick=\"return confirm('Are you sure you want to Remove Equipment from $facilityname ');\" ><img src='img/delete.png' >  </a>"; ?>
<?php } 
else
{?>
	
	<?php echo $edescription;?>&nbsp;
		<?php echo " <a href=\"allocatequipment.php" ."?equipmentAutoID=$eqqID&facility=$AutoFacility&level=$level&centralsiteAutoID=$centralsiteAutoID" . "\" title='Click to Allocate this Equipment to $facilityname '  OnClick=\"return confirm('Are you sure you want to Allocate Equipment to $facilityname ');\" ><img src='img/add.png' >  </a>"; ?>
<?php } ?>
			</td>
			
			</tr>
			
		<?php
			}//end while $eqq equipments
			
			echo '</table>		
			</td>				';
			
			}//end num rows
			else
			{?>
			<td>
			<div class="notice" align="center" style="width:100px">
			<?php 		
echo  '<strong>'. 'None!'.'</strong>';?></div></td>
			
			<?php
			}
			?>
			
			

 <?php
} //end while equipment categories
 ?>
 </tr>
  
   </table>
</div>
   </form>
   <?php } ?>
   
<table border='1' style='font-size:10px; border-bottom:thin; border-bottom-color:#CCCCCC' >
<tr>
<th width='800'><div align='left'>
Health Facility&nbsp;&nbsp;: <?php echo $facilityname; ?></div>
</th>
</tr>
<tr>
<th width='330'><div align='left'>
Type &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $ftype;?></div>
</th><th width='330'><div align='left'>
<?php if ($level==0)
{?>
Referral Sites Associated With&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $totalreferalsites; ?>
<?php
}else{?>
Central Site Associated to&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $centralsitename;?>
<?php } ?>

</div>
</th>
	</tr></table>


<br>
        <TABLE style="font-family:cambria; font-size:11px ; width:1150px" class="data-table" align="center">
<?php
			$eq=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			$eq2=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			?>
<tr >
<th rowspan=2> Facility </th>
<th colspan=3> <div align="center">Total Patients as of <?php echo getmaxasofdatepatientnos(); ?></div>  </th>
 <?php
//echo  getmaxitemsbycategory();
 while(list($eqID,$description)=mysql_fetch_array($eq))
 { 
 ?>
 <th rowspan=2> <?php echo $description;?> </th> 
  <?php
 }
	echo '</tr>';?>
<tr>
<th > On Treatment </th><th > On Care </th><th > Load </th>
</tr>

<tr class="even" >
			<?php
				list($ontreatment, $oncare)=getpatientsnumbers($AutoFacility);
		$pload=$ontreatment + $oncare;?>
			<td valign="top" class="xtop" ><?php echo  $facilityname ;?></td>
			<td valign="top" class="xtop"> <?php echo $ontreatment;?> </td>
			<td valign="top" class="xtop"><?php  echo $oncare;?></td>
			<td valign="top" class="xtop"><?php  echo $pload ;?></td>
			<?php
			$fcount=0;
 while(list($eqID,$description)=mysql_fetch_array($eq2))
 {  	$fcount=$fcount+1;
		$totaleqbycat=GetTotalEquipmentsbyCategory($eqID);
        ?>
 
		 <?php 
		 //get equipments
 			$eqq=mysql_query("select equipments.ID,equipments.description from equipments,facilityequipments where equipments.ID=facilityequipments.equipment and facilityequipments.facility='$AutoFacility' and equipments.flag=1 and equipments.category='$eqID'") or die(mysql_error());
     		if (mysql_num_rows($eqq) > 0)
			{?>
			<td valign="top"  height="1" style="vertical-align: top" >
			<table class="data-table"  style="height: 50px">
			
			<?php	
			while(list($eqqID,$edescription)=mysql_fetch_array($eqq))
			{
			
		//list($cvalue,$checked)=GetIfEquipmentsinFacility($AutoFacility,$eqqID);
		
			
			?>
			
		<tr class="even">
			
			<td style="vertical-align: top">
              	
			<input type="hidden" name="facility" id="facility"  value="<?php echo $AutoFacility; ?>	" />
			<input type="hidden" name="equipmentid[]" id="equipmentid[]"  value="<?php echo $eqqID; ?>	" />
	
			<input type="checkbox" name="allocated" id="allocated"  value="1" checked disabled  />
			
			<?php echo $edescription;?>&nbsp;
		

			</td>
			
			</tr>
			
		<?php
			}//end while $eqq equipments
			
			echo '</table>		
			</td>				';
			
			}//end num rows
			else
			{?>
			<td>
			<div class="notice" align="center" style="width:100px">
			<?php 		
echo  '<strong>'. 'None!'.'</strong>';?></div></td>
			
			<?php
			}
			?>
			
			

 <?php
} //end while equipment categories
 ?>
 </tr>
  
   </table>
   
   
  
   
   
   
   
 
<?php
//include("includes/footer.php");
?>