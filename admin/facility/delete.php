<?php
require('../../Connections/config.php');
$id=$_GET['id'];
$name=$_GET['name'];
echo $sql="DELETE FROM facility where AutoID='$id'";
$query=mysql_query($sql) or die(mysql_error());
echo mysql_affected_rows();
if (mysql_affected_rows() > 0) {
   echo  $msg= "Facility ". $name. " and all associated equipment and patients have been successfully Deleted";
	echo "<script>";
    echo "window.location.href='index.php?successdel=$msg'";
	echo "</script>";
}
else {
 echo $msg="Facility ". $name. " could not be deleted";
	echo '<script type="text/javascript">';
	echo "window.location.href='index.php?errdel=$msg'";
	echo '</script>';
}

?>