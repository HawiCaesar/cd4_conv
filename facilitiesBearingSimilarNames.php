<?php 
	include 'includes/dbConf.php';
	$db=new dbConf();

?>
<table border="single" >
	<thead><th>#</th><th>Name</th><th>Count</th></thead>
<?php 
	$count=1;
	$sql= "SELECT name, COUNT( * ) AS total
				FROM facility
				GROUP BY name
				HAVING COUNT( * ) >1
				ORDER BY total DESC ";
	$query =mysql_query($sql) or die("error". mysql_error());
	while($rs=mysql_fetch_assoc($query)){				
				echo "<tr><td>$count</td><td>".$rs['name']."</td><td>".$rs['total']."</td></tr>
				";
				$count++;
	}			
	
?>
</table>