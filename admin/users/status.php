<?php
require('../../Connections/config.php');
$id=$_GET['id'];
$name=$_GET['name'];
$status=$_GET['status'];
$sql="UPDATE user SET 	status='$status' where 	userID='$id'";
$query=mysql_query($sql) or die(mysql_error());
echo mysql_affected_rows();
if (mysql_affected_rows() > 0) {
   echo  $msg= "Status of user ". $name. " has been changed";
	echo "<script>";
    echo "window.location.href='index.php?successdel=$msg'";
	echo "</script>";
}
else {
 echo $msg="Status of user  ". $name. " could not be changed";
	echo '<script type="text/javascript">';
	echo "window.location.href='index.php?errdel=$msg'";
	echo '</script>';
}

?>