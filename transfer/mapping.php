<?php
session_start();
//include("FusionMaps/FusionMaps.php");
include("FusionCharts/FusionCharts.php");
$usergroup= $_SESSION['userRights'];
if ($usergroup !=2)
{
include("includes/programheader.php");
}
else
{
include("includes/admin.php");
}
if ($_REQUEST['Submit'])
{
$checkbox= $_POST['checkbox'];
//print_r($checkbox);
$fcode= $_POST['fcode'];
$fname= $_POST['fname'];
$ftype= $_POST['ftype'];
$mflcode= $_POST['mflcode'];
$distance= $_POST['distance'];
$ontreatment= $_POST['ontreatment'];
$oncare= $_POST['oncare'];

$asodate='2012-10-31';

foreach($checkbox as $a => $b)
 	{
	//echo ($fname[$checkbox[$a]-1]).'<br/>';
	 if (  $checkbox !=$checkbox[$a] )
     {
	
	$sql=mysql_query("update facility set MFLCode='".$mflcode[$checkbox[$a]-1]."', distance='".$distance[$checkbox[$a]-1]."', name='".$fname[$checkbox[$a]-1]."', type='".$ftype[$checkbox[$a]-1]."'  where AutoID='".$fcode[$checkbox[$a]-1]."'") or die(mysql_error());

	if ($sql)
	{
	   $exists=GetIfFacilityPatientsExists($fcode[$checkbox[$a]-1]);
	   if ($exists > 0)
	   {
		$sql2=mysql_query("update facilitypatients set ontreatment='".$ontreatment[$checkbox[$a]-1]."', oncare='".$oncare[$checkbox[$a]-1]."'  where facility='".$fcode[$checkbox[$a]-1]."' ") or die(mysql_error());
		}
		else
		{
		$sql2=mysql_query("insert into facilitypatients(facility,ontreatment,oncare,asofdate) values('".$fcode[$checkbox[$a]-1]."','".$ontreatment[$checkbox[$a]-1]."','".$oncare[$checkbox[$a]-1]."','$asodate') ") or die(mysql_error());
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
	
	
//ECHO  $checkbox[$a]-1  ."- ".$fcode[$checkbox[$a]-1] . " MFL: ".$mflcode[$checkbox[$a]-1] . " KM:". $distance[$checkbox[$a]-1] . " treament/care:". $ontreatment[$checkbox[$a]-1]."/".$oncare[$checkbox[$a]-1]. '<br/>';

		}//end if checkbox
		else
{
$error='<center>'.  'No Facility(s) Selected, Please Check the Facility (checkbox)then Proceed to Editing its Info.</center>';	
}
	}//end for


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
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {

	newwindow=window.open(url,'name','height=417,width=1200,left=70,top=110,scrollbars=yes');
	if (window.focus) {newwindow.focus()}
	return false;
}


// -->
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
<?php
if ($usergroup !=2)
{

}
else
{?>
<div class="section-title"> Facility Mapping   </div>
<?php
}?>
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
<a href="excelmapping.php" target="_blank"> <input type='image' img src='img/excel.jpg' title='Download Mapping Matrix in Excel'>   </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
<font color="#ABC">  
 <a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" title=" Click to Edit Equipment Allocation"> * Click Here to See Key for Facility Types </a>   
 
   </font>    

   <div class="mid" id="HiddenDiv" style="DISPLAY: none" >
   <table class="data-table" style="width:260px">
   <tr>
   <th> Initial</th> <th> Description </th>
   </tr>
   <?php 
   $sql=mysql_query("select initial,description from facilitytypes") or die (mysql_error());
   while(list($initial,$description)=mysql_fetch_array($sql))
   {
   ?>
   <tr class="even">
   		<td> <?php echo $initial; ?> </td>
		<td> <?php echo $description; ?> </td>
   </tr>
   <?php
   }
    ?>
	</table>
   </div>
<?php
if ($usergroup !=2)
{

}
else
{?>
<form id="customForm"  method="POST" action="" >

 <font color="#ABC"> * Patient Numbers , Distance , Site Code , Site Type , Site Name Can be Edited Below   </font> &nbsp;&nbsp; | &nbsp;&nbsp;<input type="submit" name="Submit" value="Update Changes" class="button" style="width:100px"> &nbsp;&nbsp; | &nbsp;&nbsp;
<?php
}?>
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
			<?php
if ($usergroup !=2)
{

}
else
{?><th rowspan=2> Check </th> <?php }?>

		<th rowspan=2> # </th><th rowspan=2> County </th><th rowspan=2> District </th> <th rowspan=2> Central site
 </th> <th rowspan=2> Referral sites
 </th><th rowspan=2> Site Code</th><th rowspan=2> Distance* (KM)</th><th rowspan=2> Type </th> <th colspan=3> <div align="center">Total Patients as of <?php echo getmaxasofdatepatientnos(); ?></div>  </th> 
			<th rowspan=2> <div align="center">Equipment</div>  </th> 
			</tr>
			<tr>
		<th > On Treatment </th><th > On Care </th><th > Load </th>
			
			</tr>
			
			<?php
  $sql2=mysql_query("SELECT facility.AutoID as fcode,facility.MFLCode ,facility.name as fname ,facility.district,facility.type,facility.distance,facility.level,facility.centralsiteAutoID from facility,districts where facility.district=districts.ID and districts.county='$countyid' order by facility.AutoID   ") or die(mysql_error());
 	$ffcount;
$totaltests=0;
$totalneedsmets=0;
$i = 0; 
$a=1;
  while(list($fcode,$mflcode,$fname,$district,$type,$distance,$level,$centralsiteAutoID)=mysql_fetch_array($sql2))
  {$ffcount=$ffcount+1;
 $totalequipments= GetTotalEquipmentsbyFacility($fcode);
$districtname= GetDistrictName($district);
$countyID=GetCountyfromDistrict($district);
$countyname=GetCountyName($countyID);
$facilityspercounty=GetFacilityperCounty($countyID);
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
$classs="even";
$centralsitename=GetFacilityName($centralsiteAutoID);
}
  ?>
			
			<?php
if ($usergroup !=2)
{?>
<tr class="<?php echo $classs; ?>">
	
			<td ><?php echo $ffcount ; ?>	 </td>
			<?php 
			if($a==1)
			{ ?>
			<td rowspan= <?php echo $facilityspercounty; ?>><?php echo $countyname ; ?>	 </td>
			
			<?php  } $a++; ?>
			
			<td><?php echo $districtname; ?>	 </td>
			<?php
			if ($level == 0)
			{
			?>
			<td><?php echo $fname; ?>	 </td>
			<td><div align="center">	</div> </td>
			<?php }else {
			
			?>
			<td > &nbsp; &nbsp;  &nbsp;  <?php echo $centralsitename; ?></td>
			<td><?php echo $fname; ?>	 </td>
			<?php } ?>
			<td><?php echo $mflcode; ?>	 </td>
			<td><div align="center"><?php echo $distance; ?>	</div> </td>
			<td><?php echo $typename; ?>	 </td>
			<td><div align="center"><?php echo $ontreatment; ?>	</div></td>
			<td><div align="center"><?php echo $oncare; ?>		</div> </td>
			<td><div align="center"><?php echo $pload; ?>	</div> </td>
			<td>
			<a href='javascript:void(null);' onClick="popitup('facilityequipments.php?facility=<?php echo $fcode;?>&level=<?php echo $level;?>&centralsiteAutoID=<?php echo $centralsiteAutoID ;?>')">View All (<?php echo $totalequipments;?> )</a>  
			
			</td>
			</tr>

<?php

}
else
{?>
			<tr class="<?php echo $classs; ?>">
			<td ><div align="center"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $ffcount;?>" />  </div></td>
			<td><input type="hidden" name="fcode[]" id="fcode[]"  value="<?php echo $fcode; ?>	" /><?php echo $ffcount; ?>	 </td>
			<?php 
			if($a==1)
			{ ?>
			<td rowspan= <?php echo $facilityspercounty; ?>><?php echo $countyname ; ?>	 </td>
			
			<?php  } $a++; ?>
			<td><?php echo $districtname; ?>	 </td>
			<?php
			if ($level == 0)
			{
			?>
			<td>
			<input type="text" name="fname[]" id="fname[]"  value="<?php echo $fname; ?>" class="text"  size="36" />
			 </td>
			<td><div align="center">	</div> </td>
			<?php }else {
			
			?>
			<td > &nbsp;  &nbsp;  &nbsp; <?php echo $centralsitename; ?></td>
			<td><input type="text" name="fname[]" id="fname[]"  value="<?php echo $fname; ?>"  class="text" size="36"/>	 </td>
			<?php } ?>
			<td><input type="text" name="mflcode[]" id="mflcode[]"  size="7" class="text" value="<?php echo $mflcode; ?>" />	 </td>
			<td><div align="center"><input type="text" name="distance[]" id="distance[]"  size="2" class="text" value="<?php echo $distance; ?>" />		</div> </td>
			<td><?php
	   $fquery = "SELECT ID,initial FROM facilitytypes WHERE ID !='$type'  order by ID asc";
			
			$fresult = mysql_query($fquery) or die('Error, query failed'); //onchange='submitForm();'
	
	   echo "<select name='ftype[]' id='ftype[]' ;>\n";
	    echo " <option value='$type'> $typename </option>";

      //Now fill the table with data
      while ($row = mysql_fetch_array($fresult))
      {
            $ID = $row['ID'];
			$name = $row['initial'];
							
        echo "<option value='$ID'> $name </option>\n";
      }
      echo "</select>\n";
	  ?></td>
			<td><div align="center"><input type="text" name="ontreatment[]" id="ontreatment[]"  size="2" class="text" value="<?php echo $ontreatment; ?>" />		</div></td>
			<td><div align="center"><input type="text" name="oncare[]" id="oncare[]"  size="2" class="text" value="<?php echo $oncare; ?>" />		</div> </td>
			<td><div align="center"><?php echo $pload; ?>	</div> </td>
			<td>
			<a href='javascript:void(null);' onClick="popitup('facilityequipments.php?facility=<?php echo $fcode;?>&level=<?php echo $level;?>&centralsiteAutoID=<?php echo $centralsiteAutoID ;?>')">View All (<?php echo $totalequipments;?> )</a>  
			
			</td>
			</tr>
			<?php } //end if useraccount admin?>
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