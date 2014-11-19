<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$host="localhost";
		$user="root";
		$pass="";
		$db="cd4";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);

?>