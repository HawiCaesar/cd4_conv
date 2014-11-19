<?php
include 'includes/dbConf.php';
$db=new dbConf();

 $sql="SELECT * FROM facilityequipments WHERE equipment =0 OR equipment=''";
$query=mysql_query($sql);
$mytable="";
while ($r=mysql_fetch_array($query)) {
$tab="<tr><td>".$r['facility']."</td><td>".$r['fname']."</td><td>".$r['equipment']."</td><td>".$r['equipmentname']."</td></tr>";
$mytable=$mytable.$tab;
}



?>
<html>
<head>
<title>Funnny MFL CODES </title>
</head>
<body>
<h1>Funnny MFL Codes with Zeros</h1>
<table border="1">
<thead>
<tr>
<th>facility Code</th><th>facility name</th><th>Equipment #</th><th>Equipment Name</th>
</tr></thead>
<tbody>
<?php
echo $mytable;
?>
</tbody>
</table>
</body>
</html>