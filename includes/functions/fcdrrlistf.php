<?php

function fcdrrlist(){
		$mflcode=$_SESSION['facility'];
		$sql="SELECT * FROM fcdrrlists where mflcode='$mflcode' order by todate desc";
		$query=mysql_query($sql) or die(mysql_error());
		
		$data="";
		while($rs=mysql_fetch_assoc($query)){	
				$data.=
				"<tr>
					<td>
						<a href='http://".$_SERVER['SERVER_NAME']."/cd4/cd4commodity.php? fcdrrlistID=".$rs["fcdrrlistID"]."'>
						<b>From ".date('jS F Y',strtotime($rs["fromdate"]))." to ".date('jS F Y',strtotime($rs["todate"]))."</b>
						</a>
					</td>
					<td><center>
							<a target=\"_blank\" href='http://".$_SERVER['SERVER_NAME']."/cd4/cd4commoditySheet.php? fcdrrlistID=".$rs["fcdrrlistID"]."&date=".$rs["fromdate"]."'>
								<img src='img/excel.png' alt='download excel'></img>
							</a>
						</center>
					</td>
					<td><center>
							<a target=\"_blank\"  href='cd4commoditypdf.php? fcdrrlistID=".$rs["fcdrrlistID"]."&date=".$rs["fromdate"]."'>
								<img src='img/pdf.png' alt='download pdf'></img>
							</a>
						</center>
					</td>
				</tr>";		
				
			}
			return $data;
	}


function fcdrrlists(){
		$sql="SELECT * FROM fcdrrlists ";
		$query=mysql_query($sql) or die(mysql_error());
		
		$data="";
		while($rs=mysql_fetch_assoc($query)){	
				$data.=
				"<tr>
				<td>".checkFacilitymfl($rs['mflcode'])."
						
					</td>
					<td>
						From ".date('d-F-Y',strtotime($rs["fromdate"]))." to ".date('d-F-Y',strtotime($rs["todate"]))."
					</td>
					<td>
						<a target=\"_blank\" href='http://".$_SERVER['SERVER_NAME']."/cd4/cd4commoditySheet.php? fcdrrlistID=".$rs["fcdrrlistID"]."&date=".$rs["fromdate"]."'>
							<img src='img/excel.jpg' alt='download excel'></img>
						</a>
						
						</td>
						<td>
						<a target=\"_blank\"  href='cd4commoditypdf.php? fcdrrlistID=".$rs["fcdrrlistID"]."&date=".$rs["fromdate"]."'>
							<img src='img/pdf.jpg' alt='download pdf'></img>
						</a>
					</td>
				</tr>";		
				
			}
			return $data;
	}
	function fcdrrlistsAdmin(){
		$sql="SELECT * FROM fcdrrlists ";
		$query=mysql_query($sql) or die(mysql_error());
		
		$data="";
		while($rs=mysql_fetch_assoc($query)){	
				$data.=
				"<tr>
				<td>".checkFacilitymfl($rs['mflcode'])."
						
					</td>
					<td>
						".date("Y-F-d", strtotime($rs["fromdate"]))."
					</td>						
					<td>
						".date("Y-F-d", strtotime($rs["todate"]))."
					</td>
					<td>
						<a target=\"_blank\" href='http://".$_SERVER['SERVER_NAME']."/cd4/cd4commoditySheet.php? fcdrrlistID=".$rs["fcdrrlistID"]."&date=".$rs["fromdate"]."'>
							<img src='../../img/excel.jpg' alt='download excel'></img>
						</a>
						
					</td>
					<td>
						<a target=\"_blank\"  href='../../cd4commoditypdf.php? fcdrrlistID=".$rs["fcdrrlistID"]."&date=".$rs["fromdate"]."'>
							<img src='../../img/pdf.jpg' alt='download pdf'></img>
						</a>
					</td>
				</tr>";		
				
			}
			return $data;
	}



?>
