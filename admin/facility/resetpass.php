<?php
require('../../Connections/config.php');
$id=$_GET['id'];
$name=$_GET['name'];
$md5=md5("123456");
echo $sql="UPDATE facility SET password='$md5' where AutoID='$id'";
$query=mysql_query($sql) or die(mysql_error());
echo mysql_affected_rows();
if (mysql_affected_rows() > 0) {
   echo  $msg= "Facility ". $name. "Password changed to 123456";
	echo "<script>";
    echo "window.location.href='index.php?successdel=$msg'";
	echo "</script>";
}
else {
 echo $msg="Facility ". $name. " Password is already 123456";
	echo '<script type="text/javascript">';
	echo "window.location.href='index.php?errdel=$msg'";
	echo '</script>';
}

?>