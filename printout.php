<?php
session_start();
require_once("includes/dbConf.php");
$partnerid=$_SESSION['userID'];
$db = new dbConf();
$id=$_GET['id'];
$test=$_GET['auto'];
$q=mysql_query("SELECT * FROM test WHERE partnerID='$partnerid' AND sampleNumber='$id' AND testID='$test'");
$rs=mysql_fetch_row($q);
?>	
<html>
	<head></head>
	<body onLoad="javascript:window.print();">
		<table height="348" width="517" style="font:"Franklin Gothic Medium Cond"; font-weight:4">
			<thead>
				<tr><td colspan="1">
					<center>PIMA TEST RESULTS</center>
					
				</td></tr>
				<tr><td colspan="1">
					<center> <font +2>PIMA CD4</font> </center>
					
				</td></tr>
			</thead>
			<tbody>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td>Sample:</td>
					<td><?php echo $rs[3]; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td>CD3+ CD4+:</td>
					<td><?php echo $rs[5]; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td>Result Date:</td>
					<td><?php echo $rs[6]; ?></td>
				</tr>
				<tr>
					<td>Result Time:</td>
					<td><?php echo $rs[7]; ?></td>
				</tr>
				<tr>
					<td>Operator:</td>
					<td><?php echo $rs[8]; ?></td>
				</tr>
				
				<tr>
					<td>Test ID:</td>
					<td><?php echo $rs[16]; ?></td>
				</tr>
				<tr>
					<td>Device:</td>
					<td><?php echo $rs[1]; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td>QC</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Barcode</td>
					<td><?php if($rs[10]==1){
						 echo "Pass";
					} else if($rs[10]==2){
						 echo "Fail";
					} if($rs[10]==3){
						 echo "Overruled";
					}  ?></td>
				</tr>
				<tr>
					<td>Expiry Date:</td>
					<td><?php if($rs[11]==1){
						 echo "Pass";
					} else if($rs[11]==2){
						 echo "Fail";
					} if($rs[11]==3){
						 echo "Overruled";
					}  ?></td>
				</tr>
				<tr>
					<td>Volume:</td>
					<td><?php if($rs[12]==1){
						 echo "Pass";
					} else if($rs[12]==2){
						 echo "Fail";
					} if($rs[12]==3){
						 echo "Overruled";
					}  ?></td>
				</tr>
				<tr>
					<td>Device:</td>
					<td><?php if($rs[14]==1){
						 echo "Pass";
					} else if($rs[14]==2){
						 echo "Fail";
					} if($rs[14]==3){
						 echo "Overruled";
					}  ?></td>
				</tr>
				<tr>
					<td>Reagent:</td>
					<td><?php if($rs[15]==1){
						 echo "Pass";
					} else if($rs[15]==2){
						 echo "Fail";
					} if($rs[15]==3){
						 echo "Overruled";
					}  ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td colspan="2">------------------------------------------------------------</td></tr>
				<tr><td>&nbsp;</td><td align="center">Signature</td></tr>
			</tbody>
		</table>
		
		
		
		
	</body>
</html>