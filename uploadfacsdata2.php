<?php ob_start();
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>";
        echo "window.location.href='facilitylogin.php'";
    echo "</script>";
}

include("includes/commodityheader.php");
include("includes/dbConf.php");
$db=new dbConf();
$mine=$_SESSION['userID'];
?>
    <div class="main" id="main-two-columns" valign="top" class="xtop">
       <div class="left" id="main-left">
          <div class="post"></div>
            <div class="post-body"></div>
                <div class="section-title" ><center>Upload FACS CALIBUR results to the system</center></div>
                <?php   
				if(isset($_SESSION['success'])){
					echo $_SESSION['success'];
					
					unset($_SESSION['success']);
				}
				
				?>
                <link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
                <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
                <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
               <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                $(document).ready(function() {
					$('.data-table').dataTable({
						"sScrollY": "200px"
						});
				});
                </script>
               
          <?php
            if(isset($_POST['submit']) or isset($_POST['submit_1']))
               { 
                 //$p=0;
                 $file1 = $_FILES['file1']['name'];
                 move_uploaded_file($_FILES["file1"]["tmp_name"],"docs/" . $_FILES["file1"]["name"]);
                
                $click="";
               if(isset($_POST['submit_1'])){
                   $conf="";
                   //$file_name_new=$_POST['institution_name'];
                  
                    $file1 = $_POST['file_name'];
                    $file_temp_name = $_POST['file_temp_name'];
                    move_uploaded_file($file_temp_name,"docs/" . $_FILES["file1"]["name"]);
               }
               
     if  ($file1 =="") //if exp file is null
               {
                  
        echo"<table>
  <tr>
    <td style='width:auto' ><div class='error'> 
        
<strong><font color='#666600'><center>Please Select a FACS CALIBUR result file to upload</center></strong></font>
    </div><th>
  </tr>
</table>";
    }
     elseif ($file1 !="" ) {//if exp file is not null        
$file = fopen("docs/".$file1, "r") or exit("Unable to open file!");
$test=0;

 while(!feof($file))
  {
    
      if($test==0){
        //fgets($file);
          $data_=fgets($file);
          $data_array=explode( "\t",$data_);
          echo"
		
		<div style='margin-top:0px;'><table class='data-table' style='width:400px'>
		<thead>
        <tr><th width=50px>".$data_array[0]."</th>
        <th width=50px>".$data_array[1]."</th>
        <th width=50px>".$data_array[2]."</th>
        <th width=50px>".$data_array[3]."</th>
        <th width=100px>".$data_array[4]."</th>
        <th width=50px>".$data_array[5]."</th>
        <th width=100px>".$data_array[6]."</th>
        <th width=50px>".$data_array[7]."</th>
        <th width=50px>".$data_array[8]."</th>
        <th width=50px>".$data_array[9]."</th>
        <th width=50px>".$data_array[10]."</th>
        <th width=50px>".$data_array[11]."</th>
        <th width=50px>".$data_array[12]."</th>
		<th width=50px>".$data_array[13]."</th>
		</tr>
		</thead>
		<tbody>
		";
      }
      else{
          $p=0;
          $data_=fgets($file);
          $data_array=explode( "\t",$data_);
           $header="";
           $new_file_name="";
           $num=1;
         
          
             if($p==0){
                      $new_file_name=$data_array[0];
                      $_SESSION['institution_name']=$new_file_name;
                      //echo $_SESSION['institution_name'];
                      $p=1;
                  }
      
        echo "
        <tr><td width=50px>".$data_array[0]."</td>
        <td width=50px>".$data_array[1]."</td>
        <td width=50px>".$data_array[2]."</td>
        <td width=50px>".$data_array[3]."</td>
        <td width=100px>".$data_array[4]."</td>
        <td width=50px>".$data_array[5]."</td>
        <td width=100px>".$data_array[6]."</td>
        <td width=50px>".$data_array[7]."</td>
        <td width=50px>".$data_array[8]."</td>
        <td width=50px>".$data_array[9]."</td>
        <td width=50px>".$data_array[10]."</td>
        <td width=50px>".$data_array[11]."</td>
        <td width=50px>".$data_array[12]."</td>
		<td width=50px>".$data_array[13]."</td></tr>";
        
        $query="INSERT INTO           exp_file_data(Institution,Director,Operator,Sample_Name,Sample_ID,Case_Number,Date_Analyzed,AverageCD3_Lymph,AverageCD3_AbsCnt,AverageCD3_CD4_Lymph,AverageCD3_CD4_AbsCnt,CD45_AbsCnt,Age,serial_nos) values ('".$data_array[0]."','".$data_array[1]."','".$data_array[2]."','".$data_array[3]."','".$data_array[4]."','".$data_array[5]."','".$data_array[6]."','".$data_array[7]."','".$data_array[8]."','".$data_array[9]."','".$data_array[10]."','".$data_array[11]."','".$data_array[12]."','".$data_array[13]."')";
        if(isset($conf))
        {
        $insertexpdata = mysql_query($query) or die();
        //mysql_error();
        $num+=1;
        }
      }
  $test++;
  }
echo  "</tbody></table></div>";
fclose($file);

$_SESSION['success']='<div background-color:"#666600"><strong><font>UPLOAD WAS SUCCESSFUL!</font></strong></div>';
        }
   }
$msg="<strong><font color='#666600'>Upload was Successful!</font></strong>";
if (isset($_POST['submit_1']))
{
  
   header("location:uploadfacsdata.php");
    exit;

}
        ?>
         <div>       
      <form name="frms" method="post" enctype="multipart/form-data" id="frms">
                   <input type="hidden" name="file_name" value="<?php if( isset($click)){ echo $_FILES['file1']['name'];}?>"  />
                <input type="hidden" name="file_temp_name" value="<?php if( isset($click)){ echo $_FILES['file1']['tmp_name'];}?>"  />
                <?php if(!isset($test)){
                    ?><?php echo $_POST['msg'];?>
                     <table width="60%" border="1" class="data-table" id="data-tabular">
                         <tr><br  />
                         <td style="font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2" rowspan="2">
                                  <b>Upload an exp file<br />
                                  e.g. 030513.exp
                                  </b>
                                  </td>
                                  
                                <td>
                                    <b>Equipment:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> Facs Calibur<br />
                                    <b>Facility:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <?php echo $_SESSION['username'];?><br />
                                    <b>Enter Operator's Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <input name="name" placeholder="Enter Name" class="text"/><br />
                                    <b>Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <?php echo date("d F Y");?><br />
                                    <tr><td>
                                    <b><span class="mandatory">*</span>File to upload:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><input type="file" name="file1" id="file1" size="30"/></td>
                                   </td></tr>
                             <p>&nbsp;</p>
                          </tr>
                           
                    </table>
                   
                  
                 
                   <div style="border:medium;background-position:center;c height:auto;">
                   <table width="200" border="1">
                              <tr>
                                <th colspan="2">
                                <div align="center">
                                <p>&nbsp;
                                <input name="submit" type="submit"id="btn_save_1" value="View File" class="button" />
                                &nbsp;
                                <?php 
                                if(isset($user)){
                                    if($user>=2){
                                ?>
                                <?php
                                    }
                                }
                                ?>
                              &nbsp;
                                <input type="reset" name="cancel"  id="cancel_1" onClick="location.href='uploadfacsdata.php'" value="Reload page" class="button" />
                               &nbsp;</p> 

                                </div>
                                </th>
                          </tr>
                    </table>
                  </div>
                   
                   <?php
                    }
                    if(isset($test)){
                       ?>
                        <div id="confirm_div">       
     
                 
                   <div style="border:medium;background-position:center;c height:auto;">
                   <table width="100%" border="1">
                              <tr>
                                <th colspan="2">
                                <div align="center">
                                <input name="msg" type="hidden" value="<?php echo $msg;?>" />
                                
                                <p>&nbsp;&nbsp;
                                <input name="submit_1" type="submit"id="btn_save_1" value="Confirm and Upload" class="button" />
                                &nbsp;
                                <?php 
                                if(isset($user)){
                                    if($user>=2){
                                ?>
                                <?php
                                    }
                                }
                                ?>
                               &nbsp;
                               
                                <input type="reset" name="cancel"  id="cancel_1" onClick="location.href='uploadfacsdata.php'" value="Cancel and Reupload" class="button" />
                                &nbsp;</p>

                                </div>
                                </th>
                          </tr>
                    </table>
                  </div>
                  </div>
                  </form>
                </div>
                <?php } ?>
</div>
                <div class="content-separator"></div>
                
            </div>

            <?php      
            
                include("includes/sidecommodity.php"); ?>

            <div class="clearer">&nbsp;</div>

        </div>
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
    ob_end_flush();
        include("includes/footer.php");
        
        ?>