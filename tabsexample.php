<?php
include("includes/header.php");
include("FusionMaps/FusionMaps.php");
include("FusionCharts/FusionCharts.php");
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
$fcount=0;
 while(list($countyid,$countyname)=mysql_fetch_array($sss))
			   {
			   $fcount=$fcount=$fcount+1;?>
	<div class="glossymenu" >
		
			<a class="menuitem submenuheader" href="" style="width:1170px"> <?php echo $fcount;?> :  <?php echo $countyname ; ?> County    &nbsp;&nbsp;&nbsp;&nbsp;<small>  <font color="#ABC"> * Click Here to View Facilities Performance  </font> </small> </a>

	<div class="submenu">
			
			
			<TABLE style="font-family:cambria; font-size:11px" class="data-table">
			<tr>
		<th rowspan=2> # </th><th rowspan=2> District </th> <th rowspan=2> Central Site </th> <th rowspan=2> Referall </th><th rowspan=2> Site Code</th><th rowspan=2> Distnace(KM)</th><th rowspan=2> Type </th> <th colspan=3> <div align="center">Total Patients as of</div>  </th> 
			<th colspan=6> <div align="center">Equipment</div>  </th> 
			</tr>
			<tr>
		<th > On Treatment </th><th > On Care </th><th > Load </th>
			<?php
			$eq=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
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
			</tr>
			
			<?php
  $sql2=mysql_query("SELECT facility.AutoID as fcode,facility.MFLCode ,facility.name as fname ,facility.district,facility.type,facility.distance from facility,districts where facility.district=districts.ID and districts.county='$countyid' order by fname ASC") or die(mysql_error());
 	$ffcount=0;
$totaltests=0;
$totalneedsmets=0;
  while(list($fcode,$mflcode,$fname,$district,$type,$distance)=mysql_fetch_array($sql2))
  {$ffcount=$ffcount+1;
  
$districtname= GetDistrictName($district);
$typename=GetFacilityType($type);
list($ontreatment, $oncare)=getpatientsnumbers($fcode);
$pload=$ontreatment + $oncare;
  ?>
			
			
			<tr>
			<td><?php echo $ffcount; ?>	 </td>
			<td><?php echo $districtname; ?>	 </td>
			<td><?php echo $fname; ?>	 </td>
			<td><?php echo $referal; ?>	 </td>
			<td><?php echo $mflcode; ?>	 </td>
			<td><?php echo $distance; ?>	 </td>
			<td><?php echo $typename; ?>	 </td>
			<td><?php echo $ontreatment; ?>	 </td>
			<td><?php echo $oncare; ?>	 </td>
			<td><?php echo $pload; ?>	 </td>
			</tr>
			
	<?php
	}//end while facilities in county
	?>		
			
			
			
			
			
			</table>
			
			
			
			
			
			</div>
			
			</div>
		<?php }?>
		
		
		
		
		
		
		
		
			
			
</div>
      <?php } //end while provinces looop?>
   
   
   
   
   
   
   
   
   
   
   
   
    </div>
<?php
include("includes/footer.php");
?>