<?php
require('../../Connections/config.php');
$id=$_GET['id'];
$name=$_GET['name'];
$status=$_GET['status'];
echo $sql="UPDATE facility SET rolloutstatus='$status' where AutoID='$id'";
$query=mysql_query($sql) or die(mysql_error());
echo mysql_affected_rows();
if (mysql_affected_rows() > 0) {
   echo  $msg= "Rollout Status of facility ". $name. " has been changed";
	echo "<script>";
    echo "window.location.href='index.php?successdel=$msg'";
	echo "</script>";
}
else {
 echo $msg="Rollout Status of facility  ". $name. " could not be changed";
	echo '<script type="text/javascript">';
	echo "window.location.href='index.php?errdel=$msg'";
	echo '</script>';
}

?>