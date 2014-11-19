<?php
include("includes/header.php");
include("FusionMaps/FusionMaps.php");
include("FusionCharts/FusionCharts.php");
$AutoFacility= $_GET['facility'];
$level= $_GET['level'];
$centralsiteAutoID= $_GET['centralsiteAutoID'];
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
	//echo  $allocated ."old:".$currentselection . " <> ". $equipment   . '<br/>';

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
<link rel="stylesheet" type="text/css" href="glossstyle.css" />
<div class="section-title"> <?php echo $pagetitle;?>   </div>
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


<table border='1' style='font-size:10px; border-bottom:thin; border-bottom-color:#CCCCCC'>
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
	<form id="customForm"  method="POST" action="" >
 <font color="#ABC"> * Equipment Allocation can be Edited Below   </font> &nbsp;&nbsp; | &nbsp;&nbsp;<input type="submit" name="Submit" value="Update Allocations" class="button" style="width:100px"> &nbsp;&nbsp; | &nbsp;&nbsp;
<br><br>
        <TABLE style="font-family:cambria; font-size:11px" class="data-table">
<?php
			$eq=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			$eq2=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			if (mysql_num_rows($eq) > 0)
			{
			while(list($eqID,$description)=mysql_fetch_array($eq))
			{
			?>
			<th> <?php echo $description;?> </th>
			<?php } //end while 
			}
			else
			{?>
			<th> No Equipments Placed </th>
			<?php
			}//endif ?>
   
<?php

	
 while(list($eqID,$description)=mysql_fetch_array($eq2))
 {  

        ?>
		  
		 <?php 
 $eqq=mysql_query("select ID,description from equipments where flag=1 and category='$eqID'") or die(mysql_error());
     		if (mysql_num_rows($eqq) > 0)
			
			{?><?php
			echo '<tr >';
			echo '<td> '. $description .'</td>';
			$fcount=0;
			$totaleqbycat=GetTotalEquipmentsbyCategory($eqID);
			while(list($eqqID,$edescription)=mysql_fetch_array($eqq))
			{
			
		list($cvalue,$checked)=GetIfEquipmentsinFacility($AutoFacility,$eqqID);
		if ($fcount % $totaleqbycat == 0) {
            echo '<td >';
        }
			
			?>
			
		
			
			<td>
              	<input type="hidden" name="checkbox[]" id="checkbox[]"  value="<?php echo $fcount; ?>	" />
			<input type="hidden" name="facility" id="facility"  value="<?php echo $AutoFacility; ?>	" />
			<input type="hidden" name="equipmentid[]" id="equipmentid[]"  value="<?php echo $eqqID; ?>	" />
			<input type="hidden" name="currentchecked[]" id="currentchecked[]"  value="<?php echo $cvalue; ?>	" /> 
			<?php echo "{ ".$eqID."}". $fcount. " / ".$totaleqbycat;
				if ($cvalue==1)
				{
				?>
	<input name="allocated[<?php echo $eqqID; ?>]" id="allocated[<?php echo $eqqID; ?>]" type="radio" value="1" CHECKED/>  Y&nbsp;
	<input name="allocated[<?php echo $eqqID; ?>]" id="allocated[<?php echo $eqqID; ?>]" type="radio" value="0" /> N
			<?php }
			elseif ($cvalue==0) {?>
	<input name="allocated[<?php echo $eqqID; ?>]" id="allocated[<?php echo $eqqID; ?>]" type="radio" value="1" />  Y&nbsp;
	<input name="allocated[<?php echo $eqqID; ?>]"  id="allocated[<?php echo $eqqID; ?>]" type="radio" value="0" CHECKED /> N
			<?php }?>&nbsp;&nbsp;&nbsp;
			<?php echo $edescription;?>
			
			</td>
			


			<?php
			
			 if ( $fcount % $totaleqbycat == $totaleqbycat - $fcount) {
			// $fcount=$fcount+1;
			 echo '</td> ';
	        }
			 $fcount+= 1;
			?>
			
			
			<?php
				
			}//end while $eqq
			
	
			
			?><?php
			}//end num rows
			 echo '</tr>	';?>



 <?php
} //end while 
 ?>
  
   </table>
   
   
   </form>
   
   
   
   
   
   
 
<?php
include("includes/footer.php");
?>