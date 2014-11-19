<?php
include("includes/admin.php");
include("FusionMaps/FusionMaps.php");
include("FusionCharts/FusionCharts.php");

if ($_REQUEST['Submit'])
{
$checkbox= $_POST['checkbox'];

$fcode= $_POST['fcode'];
$mflcode= $_POST['mflcode'];
$distance= $_POST['distance'];
$ontreatment= $_POST['ontreatment'];
$oncare= $_POST['oncare'];
if (  $checkbox !="" )
{
$asodate='2012-10-31';
foreach($checkbox as $a => $b)
 	{
	
	$sql=mysql_query("update facility set MFLCode='$mflcode[$a]', distance='$distance[$a]'  where AutoID='$fcode[$a] '") or die(mysql_error());

	if ($sql)
	{
	   $exists=GetIfFacilityPatientsExists($fcode[$a]);
	   if ($exists > 0)
	   {
		$sql2=mysql_query("update facilitypatients set ontreatment='$ontreatment[$a]', oncare='$oncare[$a]'  where facility='$fcode[$a]'") or die(mysql_error());
		}
		else
		{
		$sql2=mysql_query("insert into facilitypatients(facility,ontreatment,oncare,asofdate) values('$fcode[$a]','$ontreatment[$a]','$oncare[$a]','$asodate') ") or die(mysql_error());
		}
		if ($sql2)
		{}else
		{
		$error='<center>'.  'Failed Updating Details, Try Again Below.</center>';	
		}
	}
	else
	{
	$error='<center>'.  'Failed Updating Details, Try Again Below.</center>';	
	}
//ECHO $fcode[$a] . " MFL: ".$mflcode[$a] . " KM:". $distance[$a] . " treament/care:". $ontreatment[$a]."/".$oncare[$a]. '<br/>';
	}//end for
}//end if checkbox
else
{
$error='<center>'.  'No Facility(s) Selected, Please Check the Facility (checkbox)then Proceed to Editing its Info.</center>';	
}
}//end if request submit

if ($sql2)
	{
	$success='<center>'.  'Successfully Updated Facility Details.</center>';	
	}
	

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
<div class="section-title"> Facility Mapping   </div>

<body class='default'>
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

		
<form id="customForm"  method="POST" action="" >
 <font color="#ABC"> * Patient Numbers , Distance , Site Code Can be Edited Below   </font> &nbsp;&nbsp; | &nbsp;&nbsp;<input type="submit" name="Submit" value="Update Changes" class="button" style="width:100px"> &nbsp;&nbsp; | &nbsp;&nbsp;
<br><br>
    <div id='jqxtabs'>
	
        <ul style='margin-left: 20px;'>
		
		<?php
		$ss=mysql_query("select ID,name from provinces order by name ASC") or die(mysql_error());
		while(list($provid,$provname)=mysql_fetch_array($ss))
		{?>
            <li> <?php echo $provname; ?></li>
        <?php
		}
		   //end while prov?>
          
        </ul>
		
        <?php
		$ss2=mysql_query("select ID,name from provinces order by name ASC") or die(mysql_error());
		while(list($provid,$provname)=mysql_fetch_array($ss2))
		{ //start inner looop for provinces?>
<div>
	
	
	
	<?php
			   $sss=mysql_query("SELECT countys.ID as countyid ,countys.name as countyname from countys where countys.province='$provid' order by countyname ASC") or die(mysql_error());
			 
			   ?>
	<?php
$sfcount=0;
 while(list($countyid,$countyname)=mysql_fetch_array($sss))
			   {
			   $sfcount=$sfcount=$sfcount+1;?>
	<div class="glossymenu" >
		
			<a class="menuitem submenuheader" href="" style="width:1170px"> <?php echo $sfcount;?> :  <?php echo $countyname ; ?> County    &nbsp;&nbsp;&nbsp;&nbsp;<small>  <font color="#ABC"> * Click Here to View Facilities   </font> </small> </a>

	<div class="submenu">
			
			
			<TABLE style="font-family:cambria; font-size:11px" class="data-table">
			<tr>
			<th rowspan=2> Check </th>
		<th rowspan=2> # </th><th rowspan=2> District </th> <th rowspan=2> Central site
 </th> <th rowspan=2> Referral sites
 </th><th rowspan=2> Site Code</th><th rowspan=2> Distance* (KM)</th><th rowspan=2> Type </th> <th colspan=3> <div align="center">Total Patients as of <?php echo getmaxasofdatepatientnos(); ?></div>  </th> 
			<th rowspan=2> <div align="center">Equipment</div>  </th> 
			</tr>
			<tr>
		<th > On Treatment </th><th > On Care </th><th > Load </th>
			
			</tr>
			
			<?php
  $sql2=mysql_query("SELECT facility.AutoID as fcode,facility.MFLCode ,facility.name as fname ,facility.district,facility.type,facility.distance,facility.level,facility.centralsiteAutoID from facility,districts where facility.district=districts.ID and districts.county='$countyid' order by facility.AutoID   ") or die(mysql_error());
 	$ffcount=0;
$totaltests=0;
$totalneedsmets=0;
$i = 0; 
  while(list($fcode,$mflcode,$fname,$district,$type,$distance,$level,$centralsiteAutoID)=mysql_fetch_array($sql2))
  {$ffcount=$ffcount+1;
 $totalequipments= GetTotalEquipmentsbyFacility($fcode);
$districtname= GetDistrictName($district);
$typename=GetFacilityType($type);
$totalreferalsites=GetTotalReferalSitesPerCentral($fcode);
list($ontreatment, $oncare)=getpatientsnumbers($fcode);
$pload=$ontreatment + $oncare;

if ($level==0)
{
$classs="even";
}
else
{
$classs="";
$centralsitename=GetFacilityName($centralsiteAutoID);
}
  ?>
			
			
			<tr class="<?php echo $classs; ?>">
			<td ><div align="center"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $i++;?>" />  </div></td>
			<td><input type="hidden" name="fcode[]" id="fcode[]"  value="<?php echo $fcode; ?>	" /><?php echo $ffcount; ?>	 </td>
			<td><?php echo $districtname; ?>	 </td>
			<?php
			if ($level == 0)
			{
			?>
			<td><?php echo $fname; ?>	 </td>
			<td><div align="center">	</div> </td>
			<?php }else {
			
			?>
			<td > &nbsp; <?php echo $centralsitename; ?></td>
			<td><?php echo $fname; ?>	 </td>
			<?php } ?>
			<td><input type="text" name="mflcode[]" id="mflcode[]"  size="6" class="text" value="<?php echo $mflcode; ?>" />	 </td>
			<td><div align="center"><input type="text" name="distance[]" id="distance[]"  size="6" class="text" value="<?php echo $distance; ?>" />		</div> </td>
			<td><?php echo $typename; ?>	 </td>
			<td><div align="center"><input type="text" name="ontreatment[]" id="ontreatment[]"  size="4" class="text" value="<?php echo $ontreatment; ?>" />		</div></td>
			<td><div align="center"><input type="text" name="oncare[]" id="oncare[]"  size="4" class="text" value="<?php echo $oncare; ?>" />		</div> </td>
			<td><div align="center"><?php echo $pload; ?>	</div> </td>
			<td>
			<a href="facilityequipments.php?facility=<?php echo $fcode;?>&level=<?php echo $level;?>&centralsiteAutoID=<?php echo $centralsiteAutoID ;?>" target="_blank"> View All (<?php echo $totalequipments;?> ) </a>
			<a class="modalbox" href="#inline"> 	Modal  </a>
				<div id="inline">
			  
			<?php echo $fcode;?>
			  
			  <table border='1' style='font-size:10px; border-bottom:thin; border-bottom-color:#CCCCCC ;width:1200px' >
<tr>
<th width='800'><div align='left'>
Health Facility&nbsp;&nbsp;: <?php echo $fname; ?></div>
</th>
</tr>
<tr>
<th width='330'><div align='left'>
Type &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $typename;?></div>
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
	
 &nbsp;&nbsp; | &nbsp;&nbsp;
 <font color="#ABC"> * Equipment Allocation Details *  </font> &nbsp;&nbsp; | &nbsp;&nbsp;
<br><br>
        <TABLE style="font-family:cambria; font-size:11px; width:1200px" class="data-table" >
<?php
			$eq=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			$eq2=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
			?>
<tr>
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

<tr >
			<?php
				//list($ontreatment, $oncare)=getpatientsnumbers($fcode);
		//$pload=$ontreatment + $oncare;?>
			<td valign="top" class="xtop" ><?php echo  $fname ;?></td>
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
 			$eqq=mysql_query("select equipments.ID,equipments.description from equipments,facilityequipments where equipments.ID=facilityequipments.equipment and facilityequipments.facility='$fcode' and equipments.flag=1 and equipments.category='$eqID'") or die(mysql_error());
     		if (mysql_num_rows($eqq) > 0)
			{?>
			<td valign="top"  height="1" >
			<table class="data-table"  style="height: 50px">
			
			<?php	
			while(list($eqqID,$edescription)=mysql_fetch_array($eqq))
			{
			
		//list($cvalue,$checked)=GetIfEquipmentsinFacility($AutoFacility,$eqqID);
		
			
			?>
			
		<tr>
			
			<td>
              	
			<input type="hidden" name="facility" id="facility"  value="<?php echo $fcode; ?>	" />
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
			<div class="notice" align="center">
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
			</td>
			</tr>
			
	<?php
	}//end while facilities in county
	?>		
			
			
			
			
			
			</table>
			
			 </form>
			
			
			
			</div>
			
			</div>
		<?php }?>
		
		
		
		
		
		
		
		
			
			
</div>
      <?php } //end while provinces looop?>
   
   
   
   
   
 
       
   
   
   
   
   
    </div>
	  

<?php
include("includes/footer.php");
?>