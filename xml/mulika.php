<?php
error_reporting(1);
include("../function.php");
require('../connections/config.php');

$year=2013;
$month=10;
?>
<chart  caption="<?php echo date('M, Y');?>" 
        manageResize="1" 
        bgColor="FFFFFF" 
        bgAlpha="0" 
        showBorder="0" 
        upperLimit="<?php echo date('t');?>" 
        lowerLimit="1" 
        gaugeRoundRadius="5" 
        chartBottomMargin="10" 
        ticksBelowGauge="0" 
        showGaugeLabels="1" 
        valueAbovePointer="0" 
        pointerOnTop="1" 
        pointerRadius="9" 
        numberPrefix="Day ">
        <?php 
			$good="8BBA00";
			$bad= "F6BD0F";
			$ugly="FF654F";
			
			$reportedCode="678000";
			$reportedFac=0;
			$reportedFac=(commReported($year,$month,0)/commReportingExpected($year,$month,0));
			if($reportedFac<=(0.3333)){
				$reportedCode=$ugly;
			}else if($reportedFac<=(0.66666) ){
				$reportedCode=$bad;
			}else if($reportedFac>(0.66666) ){
				$reportedCode=$good;
			}
            
            $allocatedCode="678000";
            $allocatedFac=0;
            $allocatedFac=(commAllocated($year,$month,0) /((int) commReportingExpected($year,$month,0)));
            if($allocatedFac<=(0.3333)){
                $allocatedCode=$ugly;
            }else if($allocatedFac<=(0.66666) ){
                $allocatedCode=$bad;
            }else if($allocatedFac>(0.66666) ){
                $allocatedCode=$good;
            }
		?>
    <colorRange>
        <color minValue="1" maxValue="7" label="Facility Reporting: <?php echo "".commReported($year,$month,0)." of ";?><?php echo commReportingExpected($year,$month,0)?>"  code="<?php echo $reportedCode; ?>"/>
        <color minValue="7" maxValue="15" label="Commodities Allocation: <?php echo "".commAllocated($year,$month,0)." of ";?><?php echo commReportingExpected($year,$month,0)?>"  code="<?php echo $allocatedCode; ?>" />
        <color minValue="15" maxValue="21" label="Commodities Distribution: " code="A666EDD" />
        <color minValue="21" maxValue="<?php echo date('t');?>" label="Facility Entry: <?php echo "".commReported($year,$month,0)." of ";?><?php echo commReportingExpected($year,$month,0)?>"  code="<?php echo $reportedCode; ?>" />
    </colorRange>
        <pointers>
                <pointer value="<?php echo date('d');?>"/>
        </pointers>
    <styles>
        <definition>
            <style name="ValueFont" type="Font" bgColor="333333" size="10" color="FFFFFF"/>
        </definition>
        <application>
            <apply toObject="VALUE" styles="valueFont"/>
        </application>
    </styles>
</chart>