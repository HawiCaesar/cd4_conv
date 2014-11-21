<?php
function conn(){
 $host="localhost";
		$user="root";
		$pass="";
		$db="cd4";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);
}
class dbConf{
	
	//connect to the db function
	function __Construct(){
			//send mail
@require_once('phpmailer/class.phpmailer.php');	

define('GUSER', 'alupe.poc@gmail.com'); // Gmail username
define('GPWD', 'pocpassword'); // Gmail password


		$host="localhost";
		$user="root";
		$pass="";
		$db="cd4";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);
		
		
		if (!$con)
  			{
  				die('Could not connect: ' . mysql_error());
  			}
			
			@session_start();
		}
	}
//include ("functions/errorsf.php");
include ("functions/uploadf.php");
include ("functions/loginf.php");
include ("functions/emailf.php");
include ("functions/devicef.php");
include ("functions/testf.php");
include ("functions/errorsf.php");
include ("functions/partnerf.php");
include ("functions/faciltyf.php");
include ("functions/reportsf.php");
include ("functions/accessf.php");
include ("functions/messagef.php");	
include ("functions/graphf.php");	
include ("functions/siteselection.php");	
include ("functions/equipment.php");	
include ("functions/commodityf.php");	
include ("functions/commodityrptf.php");
include ("functions/adminf.php");
	//function to close connection
	function closeConn(){
		mysql_close();
		}
		

?>