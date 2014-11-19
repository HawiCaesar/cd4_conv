<?php
include("Connections/config.php");

 $rec=0;
$handle = fopen ('HIVLABORATORYEQUIPMENTMAPv6.csv', 'r');

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

						 
						   $import = mysql_query("UPDATE facility
              SET MFLCode='$data[6]' ,typename='$data[8]',distance='$data[7]'
			  			   WHERE (AutoID= '$data[1]'  ) ");
						   $count=$count+1;
						   
						
			
			}
		}
		
		if ($import)
		{
		echo $count . " Facilitys Updated";
		}
		

?>