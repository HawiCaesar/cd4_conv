<?php
include("../function.php");
require('../connections/config.php');
$currentyear=$_GET['mwaka'];
 $partnerID=$_SESSION['partnerID'];
?>
<chart palette="2" caption="" xAxisName="" yAxisName="Units" showValues="0" decimals="0" formatNumberScale="0" useRoundEdges="1" bgColor='#FFFFFF' showBorder='0'>
<set label='200' value='2' />
<set label='201' value='4' />
<set label='203' value='12' />
<set label='210' value='0' />
<set label='300-399' value='7' />
<set label='810' value='9' />
<set label='820' value='6' />
<set label='830' value='22' />
<set label='840' value='0' />
<set label='850' value='4' />
<set label='860' value='1' />
<set label='870' value='0' />
<set label='880' value='0' />
<set label='890' value='0' />
<set label='910' value='9' />
<set label='920' value='9' />
<set label='930' value='6' />
<set label='940' value='0' />
</chart>