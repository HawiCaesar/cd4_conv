<?php 
	include 'includes/dbConf.php';
	$db=new dbConf();

?>
<table border="single" >
	<thead><th>#</th><th>Name</th><th>District</th><th>Central Site</th></thead>
<?php 
	$count=0;
	$sql= "SELECT * FROM facility WHERE MFLcode=0";
	$query =mysql_query($sql) or die("error". mysql_error());
	while($rs=mysql_fetch_assoc($query)){				
				echo "<tr><td>$count</td><td>".$rs['name']."</td><td>".$rs['districtname']."</td><td>".$rs['centralsitename']."</td></tr>";
				$count++;
	}			
	
?>
</table>