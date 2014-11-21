<?php
include("../function.php");
require('../Connections/config.php');
$rec=0;
$handle = fopen ('Districts.csv', 'r');
$count=0;
		while (($data = fgetcsv($handle, 1000, ',', '"')) !== FALSE)
		{
			$rec++;
			if($rec==1)
			{
			continue;
			}
			else
			{
					$countyid= GetCountyID($data[1]); 
					$PROVID=GetProvinceID($data[0]);
					
					$countyname=mysql_real_escape_string($data[1]);
		$query = "INSERT INTO districts(name,county,countyname) VALUES ('$data[2]','$countyid','$countyname')";
			$import = mysql_query($query) or die(mysql_error());	
			
			if ($import) //districts successfully saved
			{
			$count=$count+1;
$import = mysql_query("update countys set province='$data[0]' , provid='$PROVID'  where name='$data[1]'") or die(mysql_error());	
					
			}//end if mother dones
		}//end if  if($rec==1)
		}//end while	
			if ($import) //mother successfully saved
			{
			echo $count . " Records Updated";
				
			}//e
			
		

?>