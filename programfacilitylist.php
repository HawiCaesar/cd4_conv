<?php
session_start();
$partnerid=1;
require_once("includes/programheader.php");
require_once("includes/dbConf.php");
$db = new dbConf();

//$partnerid=$_SESSION['userID'];


if(isset($_GET['id'])){
    $Search=$_GET['count'];
$numRws=1;
}
else{
header("Location:homeprogram.php");
}
$central=getCentralFacSites($_GET['id']);
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
newwindow=window.open(url,'name','height=500,width=1200');
if (window.focus) {newwindow.focus()}
return false;
}

// -->
</script>
<link rel="stylesheet" type="text/css" href="glossstyle.css" />
<script type='text/javascript' src='includes/jquery.autocomplete.js'></script>

<link rel="stylesheet" type="text/css" href="includes/jquery.autocomplete.css" />
<script type="text/javascript">
$().ready(function() {
$("#devicenumber").autocomplete("getFacility.php", {
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
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
newwindow=window.open(url,'name','left=400,top=200,width=800,height=150,toolbar=0,resizable=0,scrollbars=no');
if (window.focus) {newwindow.focus()}
return false;
}

// -->
</script>
 
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.account.options[form.account.options.selectedIndex].value;
self.location='facilityList.php?account=' + val ;
}

</script>

 
 <div class="main" id="main-two-columns" valign="top" class="xtop">

<div class="left" id="main-left">

<div class="post">
<div class="post-body">
                 <div class="section-title"><center>Equipment distribution in <?php echo getCountyName($Search); ?> County</center></div>
          

<table>
<tr>
<td><img src="img/search.png" ></td>
<td>  <form autocomplete="off" method="post" action="facilitylist.php">
 
 <input name="devicenumber" id="devicenumber" type="text" class="text" placeholder="Search Central Site"  size="25" />
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
</tr>

 <form id="customForm"  method="post" action="" >
</table>

<table class="data-table" cellpadding="0">
<tr> 
<th width="5%"><small>#</small></th>
<th width="20%"> <center><small> Central</small></center> </th>
 <th width="20%"> <center><small>Referral</small></center> </th>
 <th width="15%"><center><small>Distance(KM) </small></center></th>
<th width="25%"> <center><small>
 <table border="0">
 <tr>
 <th colspan="3" ><center><small>Patrient Care </small></center></th>
 </tr>
  <tr>
 <th><small>ART #</small></th>
<th><center><small> Care # </th>
 <th><center><small>Total Patients</th>
 </tr>
</table>
 </small></center></th> 
<th width="5%"><center><small>CD4</small> </center></th>
<th width="5%"><center><small>Haematology</small> </center></th>
<th width="5%"><center><small>Chemistry</small> </center></th>

</tr>
<div class="glossymenu" >
<?php
$num=1;
while($list=mysql_fetch_array($central)){
?>
<tr>
<td>  <center><small><?php echo $num; ?></small></center></td>
<td><a class="menuitem submenuheader" href="" style="width:1170px"><small> <?php echo $list['facility']; ?></small></a></td>
<td><center> <small>Total Referral Sites= <?php getTotalReferalSites($list['AutoID']); ?></small></center></td>
<td><center> <small><?php echo $list['distance']; ?></small></center></td>
<td><center><small> <table><tr><td><?php echo $list['ontreatment']; ?></td><td><?php echo $list['oncare']; ?></td><td><?php echo ($list['ontreatment'] +$list['oncare']); ?></td></tr></table></small></center></td>
<td> <center><?php if(getTotalFacEquipmentcat(1,1,$_GET['id'])!=0){
                     	?>
                     	<a href='javascript:void(null);'onClick="popitup('equipincentral.php?cat=<?php echo 1;?>&status=<?php echo 1;?>&fac=<?php echo $_GET['id']; ?>')">
                     	<?php echo getTotalFacEquipmentcat(1,1,$_GET['id']); ?></a>
<?php
                     	}else echo getTotalFacEquipmentcat(1,1,$_GET['id']);?></center>
                     	</td>
   <td> <center><?php if(getTotalFacEquipmentcat(3,1,$_GET['id'])!=0){
                     	?>
                     	<a href='javascript:void(null);'onClick="popitup('equipincentral.php?cat=<?php echo 1;?>&status=<?php echo 1;?>&fac=<?php echo $_GET['id']; ?>')">
                     	<?php echo getTotalFacEquipmentcat(3,1,$_GET['id']); ?></a>
<?php
                     	}else echo getTotalFacEquipmentcat(3,1,$_GET['id']);?></center>
                     	</td>                  	
                     	<td> <center><?php if(getTotalFacEquipmentcat(5,1,$_GET['id'])!=0){
                     	?>
                     	<a href='javascript:void(null);'onClick="popitup('equipincentral.php?cat=<?php echo 1;?>&status=<?php echo 1;?>&fac=<?php echo $_GET['id']; ?>')">
                     	<?php echo getTotalFacEquipmentcat(5,1,$_GET['id']); ?></a>
<?php
                     	}else echo getTotalFacEquipmentcat(5,1,$_GET['id']);?></center>
                     	</td>
</tr><tr><td colspan="8">
<div class="submenu">
<table class="" width="100%"">
<?php  getFacReferalSites($list['AutoID']); ?>
</table>
</div>
</td>

</tr>
<?php 
$num++;
}
?>
</div>
</table>
</form>

                
 </div>
</div>


</div>

<?php  	include("includes/sideprogram.php"); ?>

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