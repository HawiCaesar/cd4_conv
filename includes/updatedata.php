<?php
include("../function.php");
require('../Connections/config.php');

 $sql=mysql_query("select AutoID,centralsitename from facility where level=1 and centralsiteAutoID is null OR centralsiteAutoID=0") or die(mysql_error());
 $numrows=mysql_num_rows($sql);		
 
 if  ($numrows > 0)
 {
 $count=0;
 while(list($AutoID,$centralsitename)=mysql_fetch_array($sql))
 {
 $centralsiteID=GetFacilityAutoIDfromName($centralsitename);
 $up=mysql_query("update facility set centralsiteAutoID='$centralsiteID' where AutoID='$AutoID' AND centralsitename='$centralsitename' ") or die(mysql_error());
	if($up)
	{
	$count=$count+1;
	} 
 }//end while
 }
 else
 {
 echo "No New Records for Update";
 }
		
		if ($up)
		{
		echo $count . " Facilitys Updated";
		}
		

?>