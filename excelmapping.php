<?php
SESSION_START();
include('function.php');
require('Connections/config.php');
$filename="HIV LABORATORY EQUIPMENT MAP v5 1213 CHAI MSH USAID";
header("Content-type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="'.$filename.'.xls"');


$eq=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());

$num_categories=mysql_num_rows($eq);
?>
<TABLE style="font-family:cambria; font-size:11px" class="data-table" border="1" >
			<th colspan="13"> HIV Laboratory Mapping Matrix </th>
			<tr>
			
		<th rowspan=2> # </th><th rowspan=2> Auto ID </th><th rowspan=2> County </th><th rowspan=2> District </th> <th rowspan=2> Central site
 </th> <th rowspan=2> Referral sites
 </th><th rowspan=2> Site Code</th><th rowspan=2> Distance* (KM)</th><th rowspan=2> Type </th> <th colspan=3> <div align="center">Total Patients as of <?php echo getmaxasofdatepatientnos(); ?></div>  </th> 
			<th rowspan=2> <div align="center"> Total Equipment</div>  </th> 
			</tr>
			<tr>
		<th > On Treatment </th><th > On Care </th><th > Load </th>
			
			</tr>
			
			
			<?php
				$eq2=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
				$eq3=mysql_query("select ID,description from equipmentcategories where flag=1") or die(mysql_error());
  $sql2=mysql_query("SELECT facility.AutoID as fcode,facility.MFLCode ,facility.name as fname ,facility.district,facility.type,facility.distance,facility.level,facility.centralsiteAutoID from facility where facility.flag=1 order by facility.AutoID   ") or die(mysql_error());
 	$ffcount=0;
$totaltests=0;
$totalneedsmets=0;
$i = 0; 
$colcount=1;
  while(list($fcode,$mflcode,$fname,$district,$type,$distance,$level,$centralsiteAutoID)=mysql_fetch_array($sql2))
  {$ffcount=$ffcount+1;
 $totalequipments= GetTotalEquipmentsbyFacility($fcode);
$districtname= GetDistrictName($district);
$countyID=GetCountyfromDistrict($district);
$countyname=GetCountyName($countyID);

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

//echo $colcount;
	if ($colcount ==16)
			{
			echo '<tr class="even">';
			}
  ?>
			
			
			<tr class="<?php echo $classs; ?>">
			
			<td><?php echo $ffcount; ?>	 </td>
			<td><?php echo $fcode; ?>	 </td>
			<td><?php echo $countyname; ?>	 </td>
			<td><?php echo $districtname; ?>	 </td>
			<?php
			if ($level == 0)
			{
			?>
			<td><?php echo $fname; ?>	 </td>
			<td><div align="center">	</div> </td>
			<?php }else {
			
			?>
			<td > &nbsp;  &nbsp;  &nbsp; <?php echo $centralsitename; ?></td>
			<td><?php echo $fname; ?>	 </td>
			<?php } ?>
			<td><?php echo $mflcode; ?>	 </td>
			<td><div align="center"><?php echo $distance; ?>		</div> </td>
			<td><?php echo $typename; ?>	 </td>
			<td><div align="center"><?php echo $ontreatment; ?>		</div></td>
			<td><div align="center"><?php echo $oncare; ?>	</div> </td>
			<td><div align="center"><?php echo $pload; ?>	</div> </td>
			<td> <div align="center"><?php echo  $totalequipments; ?>	</div>  </td>
			
			
			
			
			
			
   

		
		
		
		
		
			</tr>
			
	<?php

		}//end while facilities in county
	?>		
			
			
			
			
			
			</table>