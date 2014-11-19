<?php
$objConnect = mysql_connect("localhost", "root", "p@55w0rddv1"); 
$objDB=mysql_select_db("CD4") or die("Could not select database");
//'./spreadsheet.xls
 $rec=0;
$handle = fopen ('cd4newsitescontatcs.csv', 'r');

		while (($data = fgetcsv($handle, 1000, ',', '"')) !== FALSE)
		{
			$rec++;
			if($rec==1)
			{
			continue;
			}
			else
			{


			
			
			//$query = "INSERT INTO patients(ID,mother) VALUES ('$data[1]','$data[2]')";

					$query = "INSERT INTO facilityusers(names,email,mfl,phone) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
			$import = mysql_query($query) or die(mysql_error());
			
	  $count=$count+1;
			
			}
		}
		
		if ($import)
		{
		echo $count ." cd4 cONTACTS Updated";
		}
		

?>