<?php
 session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT LANGUAGE="Javascript" SRC="FusionCharts/FusionCharts.js"></SCRIPT>
<title>CD4 COUNT</title>
</head>

<body>
<?php
include('includes/header.php');
include('function.php');
include("FusionCharts/FusionCharts.php");
db_connect();

$sql="SELECT COUNT( IF(  `resultDate` <350, NULL , 0 ) ) AS less, COUNT( IF(  `resultDate` >350, NULL , 0 ) ) AS more
      FROM  `test` WHERE resultDate <>0";
$sql1="SELECT COUNT(`resultDate`) as zero FROM  `test` WHERE resultDate <1";
$query=mysql_query($sql);
$query1=mysql_query($sql1);

@$numrows=mysql_num_rows($query);
@$numrows1=mysql_num_rows($query1);


if(!$numrows || !$numrows1){
echo "NO DATA";	
	
}
else{
    $chart=array();
    $chart[0]="less";
	$chart[1]="more";
	$chart[2]="zero";
$strXML = "<chart caption='CD4 count' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix='people'>";	
while($row=mysql_fetch_assoc($query)){

$row1=mysql_fetch_assoc($query1);	
	$charts[0]=$row['less'];
	$charts[1]=$row['more'];
	$charts[2]=$row1['zero'];
	
     for($i=0;$i<3;$i++){
		 
        $strXML .= "<set label='".$chart[$i]."' value='".$charts[$i]."' />";
	    
	 }
	
	
}
$strXML .= "</chart>";
echo renderChart("FusionCharts/Pie3D.swf", "", $strXML, "FactorySum", 600, 300, false, false);	
	
}


?>

</body>
</html>