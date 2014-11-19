<?php 
	include 'includes/dbConf.php';
	$db=new dbConf();
	
	if(isset($_POST['from'])){
		$fromdate=date('Y-m-d', strtotime($_POST['from']));
		$todate=date('Y-m-d', strtotime($_POST['to']));		
		if(checkIfFCDRRExists($fromdate,$todate)){
				
				echo "true";				 	
			}else{
				echo "false";				
			}			
		}
	function checkIfFCDRRExists($fromdate,$todate){
	
		$exists = false;
		$sql = "SELECT * FROM fcdrrlists WHERE fromdate>='$fromdate' AND todate<='$todate' AND mflcode = ".$_SESSION['facility'];
		$query =mysql_query($sql) or die("error". mysql_error());
		while($rs=mysql_fetch_array($query)){				
				$exists=true;
			}			
			return $exists;
	}
?>