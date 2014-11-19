 <?php

require_once("includes/dbConf.php");
if($_GET['doLogout']){
	echo '<script type="text/javascript">' ;
				echo "window.location.href='index.php'";
				echo '</script>';
	
	}
$db = new dbConf();
$user=$_SESSION['userID'];
if(isset($_POST['submit'])){
 if($_POST['pass']!=$_POST['nwpass']){
$errormsg="Error Saving, Passwords don't match";
	}
	else{
$pass=md5($_POST['pass']);	
$pass2=md5($_POST['oldPass']);	
$today=date(Y-M-D);
$msg=changePassword($user, $pass,$today,$pass2);
if($msg="2"){
	session_destroy();
	$msg="Password correctly changed, login to test";
	echo '<script type="text/javascript">' ;
	echo "window.location.href='index.php?successsave=$msg'";
	echo '</script>';
}
if($msg="1"){
	$errormsg="Password not correctly changed, try again.";}

else 
$errormsg="Current password incorrect, try again";
}
}
?>

<?php require_once("includes/header.php"); ?>
<script language="javascript">
$(document).ready(function()
{
	$("#oldPass").blur(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
		//check the username exists or not from ajax
		$.post("checkifcorrect_pass.php",{ oldPass:$(this).val() } ,function(data)
        {
			console.log(data);
		  if(data !='') //if username not avaiable
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html(data).addClass('messageboxerror').fadeTo(900,1);
			});		
          }
		  else
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Change Password ').addClass('messageboxok').fadeTo(900,1);	
			});
		  }
				
        });
 
	});
});
</script>
<style type="text/css">
body {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;

}
.top {
margin-bottom: 15px;
}
.messagebox{
	position:absolute;
	width:100px;
	margin-left:30px;
	text-align:left;
	border:1px solid #c93;
	background:#ffc;
	padding:3px;
}
.messageboxok{
	position:absolute;
	width:auto;
	text-align:left;
	margin-left:30px;
	border:1px solid #349534;
	background:#C9FFCA;
	padding:3px;
	font-weight:bold;
	color:#008000;
	
}
.messageboxerror{
	position:absolute;
	width:auto;
	margin-left:30px;
	text-align:left;
	border:1px solid #FFD324;
	background:#FFF6BF;
	padding:3px;
	font-weight:bold;
	color:#514721;
	
}

</style>
	<script type="text/javascript" src="includes/ValPass.js"></script>
<link rel="stylesheet" href="includes/validation.css" type="text/css" media="screen" />
  
			  <div class="main" id="main-two-columns" valign="top" class="xtop">

			<div class="left" id="main-left">

				<div class="post">
					<div class="post-body">
                 <div class="section-title"><center>Change login password to the system</center></div>
<?php if ($errormsg !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="error"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$errormsg.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
<?php if ($successsave !="")
		{
		?> 
		<table   >
  <tr>
    <td style="width:auto" ><div class="success"><?php 
		
echo  '<strong>'.' <font color="#666600">'.$successsave.'</strong>'.' </font>';

?></div></th>
  </tr>
</table>
<?php } ?>
               
                   <form action="changePass.php" method="post" name="frmUsers" >
                   <div id="message">
                   
                   
                     <table width="60%" height="269" border="1" class="data-table">                   
                       <tr>
                        <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>Current Password:
                       </td>
                        <td>
                          <input name="oldPass" id="oldPass" type="password" class="text"/>
                          <span id='deviceNumInfo'></span><span id="msgbox" style="display:none" ></span>
                          </td>
                          
                         </tr>
                        
                       	<tr>
                        <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>New Password:
                       </td>
                        <td>
                          <input name="pass" id="pass" type="password" class="text"/>
                          <span id='locationInfo'></span><span id="msgbox" style="display:none" ></span></td>
                          
                         </tr>
                         <tr>
                        <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>
                         Confirm password</td>
                        <td><input name="nwpass" id="nwpass" type="password" class="text"/>
                        <span id='locateInfo'></span><span id="msgbox" style="display:none" ></span></td>
                          
                         </tr>
                         
                         <tr>
    							<th colspan="2">
                                <div align="center">
                                <input type="reset" name="cancel" value="Reset" class="button" />
                                <input type="submit" name="submit" value="Change Password" class="button"  />
                                </div>
                                </th>
  						</tr>
                        
					</table></div>
                    </form>
                </center></div>
                    
					<div class="clearer">&nbsp;</div>

      </div>

				<div class="content-separator"></div>
				
			</div>

			<?php  	
			
				include("includes/sidebar.php"); ?>

			<div class="clearer">&nbsp;</div>

		</div>

		<div id="dashboard">

			<div class="column left" id="column-1">
				
				<div class="column-content">
				
			

				</div>

			</div>

			<div class="column left" id="column-2">

				<div class="column-content">
				
					

					
				</div>

			</div>

			<div class="column left" id="column-3">

				<div class="column-content">
				
					
				
				</div>

			</div>

		

			<div class="clearer">&nbsp;</div>

		</div>

	<?php
	
		include("includes/footer.php");
  ob_end_flush();
		?>	

