 <?php

require_once("includes/dbConf.php");
$db = new dbConf();

//occurs on submission of the form
if(isset($_POST['saveLeave'])){
$username=$_POST['username'];
$pass1=$username."123";
$pass=md5($pass1);
$userLevel=$_POST['users'];
$names=ucwords($_POST['name']);
$email=$_POST['email'];
$phone=$_POST['phone'];

//check whether it is a patner being registered. if so assign a patnerID if not partnerID=0
if($_POST['partnerID']==2){
$partner=$_POST['partnerID'];
}
else{
	$partner=0;
	}
$user=checkUsername($username);
foreach($user as $a=>$num){
	
	}
if($num!=0){
	
echo "The user already exists";
	}
	else{
addUser($username,$pass,$userLevel,$partner,$email);
//addPatner($names,$phone,$email);
@header("location:users.php");
	}
}

if(isset($_POST['saveAdd'])){
$username=$_POST['username'];
$pass1=$username."123";
$pass=md5($pass1);
$userLevel=$_POST['users'];
$names=ucwords($_POST['name']);
$email=$_POST['email'];
$phone=$_POST['phone'];

//check whether it is a patner being registered. if so assign a patnerID if not partnerID=0
if($_POST['partnerID']==2){
$partner=$_POST['partnerID'];
}
else{
	$partner=0;
	}
$user=checkUsername($username);
foreach($user as $a=>$num){
	
	}
if($num!=0){
	
echo "The user already exists";
	}
	else{
addUser($username,$pass,$userLevel,$partner);
//addPatner($names,$phone,$email);
	}
}
?>

<?php require_once("includes/admin.php"); ?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<style type="text/css">

</style>

		<div class="main" id="main-two-columns">

			<div class="left" id="main-left">

			  <div class="post">
                 <center>
                   <form action="addUser.php" method="post" name="frmLogin" >
                     <table width="350" height="269" border="1" class="data-table">
                     	<tr style="font-size:16px">
                          <td  colspan="2">
						  <center><b><strong>Add User</strong></b></center>
						  
						  
						  <?php
						  //calculates the next partnerID then assigns it to hidden field
                           $resulArr=getNextPartnerId();
						  foreach ($resulArr as $key=>$value){
						  $value +=1;
						  }
						 // echo $value;
						  ?>
                          <input type="hidden" value="<?php echo $value; ?>" name="partnerID" class="text" />
                          
                          </td>
                        </tr>
                        
                       	<tr>
                          <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>
                          <strong>Names:</strong></td>
                          <td><span id="sprytextfield1">
                          <label for="names"></label>
                          <input type="text" name="name" id="name" class="text">
                          <span class="textfieldRequiredMsg">Names required.</span></span></td>
                        </tr>
                        
                     	<tr style="font-size:16px" class="even">
                          <td  colspan="2">
						  <center><b><strong>Contact Details</strong></b></center>

                        </td></tr>
                       	<tr>
                          <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>
                          <strong>Phone Number:</strong></td>
                           <td><span id="sprytextfield2">
                             <label for="phone"></label>
                             <input type="text" name="phone" id="phone" class="text" placeholder="254722222222">
                           <span class="textfieldRequiredMsg">phone Number required.</span></span></td>
                        </tr>
                        
                        <tr>
                          <td><strong>Alternative Phone Number:</strong></td>
                           <td><input name="alternativePhone" type="text"  maxlength="12" class="text" /></td>
                        </tr>
                        
  						<tr>
   							 <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>
                             <strong>Email:</strong></td>
   							 <td><span id="sprytextfield4">
                             <label for="email"></label>
                             <input type="text" name="email" id="email" class="text">
                             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
 						 </tr>
                        
                     	<tr style="font-size:16px"  class="even">
                          <td  colspan="2">
						  <center><b><strong>Account Details</strong></b></center>

                        </td></tr>
					   <tr>
    						<td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>
                            <strong>Username:</strong></td>
    						<td><span id="sprytextfield3">
    						  <label for="name"></label>
    						  <input type="text" name="username" id="username2" class="text">
   						    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  						</tr>
 						 <tr >
  							 <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2"><span class="mandatory">*</span>
                             <strong>Userlevel:</strong></td>
   							  <td>
                              <select name="users" id="users" class="text">
                              <option value="0" selected="selected"> select user Level</option>
							  <?php
							  //calls function with usergroup array
								$cnt = getUsergroup();
                                foreach($cnt as $myArr){
							  ?>
                              <option value="<?php echo $myArr['userGroupID'];  ?>"><?php echo $myArr['usergroupName'];  ?></option>
							  <?php
									}
								?>
                              </select>
                              
                              </td>
  						 </tr>
                         
                         <tr class="eve">
                         
   								<td>Partner:</td>
   								<td><select name="partner">
                                <option value="0" selected="selected">Select partner</option>
                                <?php
							  //calls function with usergroup array
								$cnt = getPartner();
                                foreach($cnt as $myArr){
							  ?>
                              <option value="<?php echo $myArr['ID'];  ?>"><?php echo $myArr['name'];  ?></option>
							  <?php
									}
								?>
                        
                                </select></td>
  						 </tr>
  						 <tr>
                         <th colspan="2">
                          <div align="center">
    							<input type="submit" name="saveLeave" value="Save and Leave Page" class="button"/>
    							<input type="submit" name="saveAdd" value="Save and Add" class="button"/>
                                <input type="reset" name="cancel" value="Reset Page" class="button"/>
                              </div>
                           </th>
  						</tr>
					</table>
                    </form>
                </center>
                    
					<div class="clearer">&nbsp;</div>

      </div>

				<div class="content-separator"></div>
				
			</div>

			<?php  	
			
				include("includes/sideAdmin.php"); ?>

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
	<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");


$(document).ready(function(){
	 $(".eve").hide();
	$('#users').live('change', function(){
		var k=$('#users').val();
		if(k==1){
			$('.eve').show();
		}else{
		 $(".eve").hide();	
		}
	
		//alert("me");
	});
});
    </script>
