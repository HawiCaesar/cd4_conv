<?php

function fcdrrlist(){
		$mflcode=$_SESSION['facility'];
		$sql="SELECT * FROM fcdrrlists where mflcode='$mflcode'";
		$query=mysql_query($sql) or die(mysql_error());
		
		$data="";
		while($rs=mysql_fetch_assoc($query)){	
				$data.=
				"<tr>
					<td>
						<a href='http://".$_SERVER['SERVER_NAME']."/cd4/cd4commodity.php? fcdrrlistID=".$rs["fcdrrlistID"]."'>
						From ".$rs["fromdate"]." to ".$rs["todate"]."
						</a>
					</td>
					<td>
						<a href='http://".$_SERVER['SERVER_NAME']."/cd4/fcdrrexcel.php? fcdrrlistID=".$rs["fcdrrlistID"]."'>
							<img src='img/excel.jpg' alt='download excel'></img>
						</a>
						
						</td>
						<td>
						<a href=''>
							<img src='img/pdf.jpg' alt='download pdf'></img>
						</a>
					</td>
				</tr>";		
				
			}
			return $data;
	}


?>
