<?php
include("../function.php");
require('../connections/config.php');
$currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
$partnerid=$_GET['partnerid'];
$filter=$_GET['filtertype'];
$fromfilter=$_GET['fromfilter'];
$tofilter=$_GET['tofilter'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];

$barcodepass=getbarcodeqaqc(1,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$barcodefail=getbarcodeqaqc(2,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$barcodeoveruled=getbarcodeqaqc(3,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totat1=$barcodepass+$barcodefail+$barcodeoveruled;

if ($totat1 !=0) 
{
$barcodepasspercent=round((($barcodepass/$totat1)*100),1);
$barcodefailpercent=round((($barcodefail/$totat1)*100),1);
$barcodeoveruledpercent=round((($barcodeoveruled/$totat1)*100),1);
}
else
{
$barcodepasspercent=0;
$barcodefailpercent=0;
$barcodeoveruledpercent=0;
}

$expirydatepass=getexpirydateqaqc(1,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$expirydatefail=getexpirydateqaqc(2,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$expirydateoveruled=getexpirydateqaqc(3,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$totat2=$expirydatepass+$expirydatefail+$expirydateoveruled;

if ($totat2 !=0) 
{
$expirydatepasspercent=round((($expirydatepass/$totat2)*100),1);
$expirydatefailpercent=round((($expirydatefail/$totat2)*100),1);
$expirydateoveruledpercent=round((($expirydateoveruled/$totat2)*100),1);
}
else
{
$expirydatepasspercent=0;
$expirydatefailpercent=0;
$expirydateoveruledpercent=0;
}

$volumepass=getvolumeqaqc(1,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$volumefail=getvolumeqaqc(2,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$volumeoveruled=getvolumeqaqc(3,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$total3=$volumepass+$volumefail+$volumeoveruled;

if ($total3 !=0) 
{
$volumepasspercent=round((($volumepass/$total3)*100),1);
$volumefailpercent=round((($volumefail/$total3)*100),1);
$volumeoveruledpercent=round((($volumeoveruled/$total3)*100),1);
}
else
{
$volumepasspercent=0;
$volumefailpercent=0;
$volumeoveruledpercent=0;
}

$devicepass=getdeviceqaqc(1,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$devicefail=getdeviceqaqc(2,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$deviceoveruled=getdeviceqaqc(3,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$total4=$devicepass+$devicefail+$deviceoveruled;

if ($total4 !=0) 
{
$devicepasspercent=round((($devicepass/$total4)*100),1);
$devicefailpercent=round((($devicefail/$total4)*100),1);
$deviceoveruledpercent=round((($deviceoveruled/$total4)*100),1);
}
else
{
$devicepasspercent=0;
$devicefailpercent=0;
$deviceoveruledpercent=0;
}

$reagentpass=getreagentqaqc(1,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$reagentfail=getreagentqaqc(2,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$reagentoveruled=getreagentqaqc(3,$partnerid,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$total5=$reagentpass+$reagentfail+$reagentoveruled;

if ($total5 !=0) 
{
$reagentpasspercent=round((($reagentpass/$total5)*100),1);
$reagentfailpercent=round((($reagentfail/$total5)*100),1);
$reagentoveruledpercent=round((($reagentoveruled/$total5)*100),1);
}
else
{
$reagentpasspercent=0;
$reagentfailpercent=0;
$reagentoveruledpercent=0;
}

?>
<chart lineThickness="1" showValues="0" formatNumberScale="0" anchorRadius="2" divLineAlpha="20" divLineColor="CC3300" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="0" numvdivlines="5" chartRightMargin="35"  bgAngle="270" bgAlpha="10,10" bgColor='#FFFFFF' showBorder='0' overlapColumns="0" useRoundEdges="1" showvalues='0'   showSum='0'>
<categories>
<category label='Barcode' />
<category label='Expiry Date' />
<category label='Volume' />
<category label='Device' />
<category label='Reagent' />
</categories>
<dataset seriesName='% Pass' color='AFD8F8' showValues='0'>
<set value='<?php echo  $barcodepasspercent; ?>' />
<set value='<?php echo  $expirydatepasspercent  ; ?>' />
<set value='<?php echo  $volumepasspercent  ; ?>' />
<set value='<?php echo   $devicepasspercent ; ?>' />
<set value='<?php echo   $reagentpasspercent ; ?>' /></dataset>
<dataset seriesName='% Fail' color='F6BD0F' showValues='0'>
<set value='<?php echo   $barcodefailpercent ; ?>' />
<set value='<?php echo   $expirydatefailpercent ; ?>' />
<set value='<?php echo   $volumefailpercent ; ?>' />
<set value='<?php echo  $devicefailpercent  ; ?>' />
<set value='<?php echo   $reagentfailpercent ; ?>' /></dataset>
<dataset seriesName='% Overuled'  showValues='0'>
<set value='<?php echo   $barcodeoveruledpercent ; ?>' />
<set value='<?php echo   $expirydateoveruledpercent ; ?>' />
<set value='<?php echo   $volumeoveruledpercent ; ?>' />
<set value='<?php echo  $deviceoveruledpercent  ; ?>' />
<set value='<?php echo   $reagentoveruledpercent ; ?>' /></dataset>
</chart>