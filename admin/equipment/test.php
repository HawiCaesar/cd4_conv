<?php
$dbhost = 'localhost';
$db_username = 'root';
$db_pass = '';
$db_name = 'cd4';
$data = " ";


mysql_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql"); 
mysql_select_db("$db_name") or die ("no database");

if(isset($_POST['id'])){
        	$id = $_POST['id'];
        	$data="";
			$sql = "SELECT equipments.description, equipments.ID
							FROM equipments, equipmentcategories
							WHERE equipments.category = equipmentcategories.ID
							AND equipments.category =$id";

        $Equiptype= mysql_query($sql);     
		
		if($Equiptype === FALSE) {
    die(mysql_error()); // TODO: better error handling
} 	       
        
				while($result=mysql_fetch_array($Equiptype)){					 
					$data.='<option value="'. $result['ID']. '"> '. $result['description'].'</option>';
					
				}
				echo $data;
        		}
        		?>