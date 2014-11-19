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
    <div class="main" id="main-two-columns" valign="top" class="xtop" >
    	<p>&nbsp;</p>
       <div class="mydiv" style="margin:auto; width: 100%;">
                <div class="section-title" style="margin:auto; width: 100%;" ><center>Upload FACS CALIBUR results to the system</center></div>
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
						"sScrollY": "200px",
						"sScrollX": "100%"
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
                  
                    $file1 = $_POST['file_name'];
                    $file_temp_name = $_POST['file_temp_name'];
                    move_uploaded_file($file_temp_name,"docs/" . $_FILES["file1"]["name"]);
               }
               
     if  ($file1 =="") //if exp file is null
               {
                  
        echo"<table>
  <tr>
    <td style='width:auto' ><div class='error'> 
        
<strong><font color='#666600'>$error<center>Please Select a FACS CALIBUR result file to upload</center></strong></font>
    </div><th>
  </tr>
</table>";
    }
     elseif ($file1 !="" ) {//if exp file is not null        
$file = fopen("docs/".$file1, "r") or exit("Unable to open file!");
$test=0;
$counter=0;
 while(!feof($file))
  {
    
      if($test==0){
         // fgets($file);
		 
          $data_=fgets($file);
          $data_array=explode("\t",$data_);
		  
		  $temp_str=trim(str_replace("\"","",$data_array[13]));
		  $temp_str=date('Y-m-d',strtotime($temp_str));
	
          echo"
		<div style='margin-top:0px;'><table class='data-table' style='width:40%'>
		<thead>
        <tr><th colspan='1'>".$data_array[0]."</th>
        <th colspan='1'>".$data_array[1]."</th>
        <th colspan='1'>".$data_array[2]."</th>
        <th colspan='1'>".$data_array[3]."</th>
        <th colspan='1'>".$data_array[4]."</th>
        <th colspan='1'>".$data_array[5]."</th>
        <th colspan='1'>".$data_array[6]."</th>
        <th colspan='1'>".$data_array[7]."</th>
        <th colspan='1'>".$data_array[8]."</th>
        <th colspan='1'>".$data_array[9]."</th>
        <th colspan='1'>".$data_array[10]."</th>
        <th colspan='1'>".$data_array[11]."</th>
        <th colspan='1'>".$data_array[12]."</th>
		<th colspan='1'>".$data_array[13]."</th>
		<th colspan='1'>".$data_array[14]."</th>
		<th colspan='1'>".$data_array[15]."</th>
		<th colspan='1'>".$data_array[16]."</th>
		<th colspan='1'>".$data_array[17]."</th>
		<th colspan='1'>".$data_array[18]."</th>
		<th colspan='1'>".$data_array[19]."</th>
		<th colspan='1'>".$data_array[20]."</th>
		<th colspan='1'>".$data_array[21]."</th>
		<th colspan='1'>".$data_array[22]."</th>
		<th colspan='1'>".$data_array[23]."</th>
		<th colspan='1'>".$data_array[24]."</th>";
		
		if(count($data_array)>24){
		
		 $data1=str_split($data_array[25],31);
		echo "<th colspan='1'>".$data1[0]."</th></tr>
		</thead>
		<tbody>
		";	
		}
		else{
		
		
		echo "<th colspan='1'>".$data_array[25]."</th></tr>
		</thead>
		<tbody>
		";		
		}
		
		$checker=false;
		$data_to_insert="";
		for($i=25;$i<count($data_array)-1; $i+=25){
			
			
			
			if($i==25){
				$data_to_insert .='"'.$data1[1].'",';
				
				echo "<tr><td colspan='1'>".$data1[1]."</td>";	
			}
			else{
				
				if($checker){
				}
				else{
							echo "<tr>";
				}
				
		
			}
			
			
		for($j=1;$j<=25;$j++){
			$checker=false;
			if($j==25){
				
				$data1=preg_split("/[\s,]+/",$data_array[$j+$i]);
				
				$checker=true;
			
	

				echo "<td colspan='1'>".$data1[0]."</td></tr>";
				$data_to_insert .=$data1[0].',';
				//$data_to_insert .=$data1[1].",".$data_to_insert;
				
				//echo substr($data_to_insert,0,-1)."<br>";
							
				 $query="INSERT INTO exp_file_data(Institution,Director,Operator,Cytometer,CytometerSerialNumber,SwVersion	
,SampleName,SampleID,CaseNumber,AGE,SEX,SITE,PanelName,Date_Analyzed,LabReportFileName,PhysiciansReportFileName,RefRange,Comments,CD3CD4CD45TruCFCSFileName,CD3CD4CD45TruCLotID,CD3CD4CD45TruCErrorCodes,CD3CD4CD45TruCCD3Lymph,CD3CD4CD45TruCCD3AbsCnt,CD3CD4CD45TruCCD3CD4Lymph,CD3CD4CD45TruCCD3CD4AbsCnt,CD3CD4CD45TruCCD45AbsCnt) values (".substr($data_to_insert,0,-1).") ON DUPLICATE KEY UPDATE SampleID=SampleID ";
	if(isset($conf))
        {
		 $insertexpdata = mysql_query($query) or die(mysql_error());
		}
				
				if($data1[1]!=NULL){
					$data_to_insert="";
					echo "<tr><td colspan='1'>".$data1[1]."</td>";
					$data_to_insert .='"'.$data1[1].'",';
					
					
				}
				
				
					
			}
			elseif($j==13){
					   $temp_str=date('Y-m-d',strtotime($data_array[$j+$i]));
					 
					  echo "<td colspan='1'>".$temp_str."</td>";
					$data_to_insert .="'$temp_str',";
				}
				else{
			$checker=false;	
			$data_to_insert .='"'.$data_array[$j+$i].'",';
				echo "<td colspan='1'>".$data_array[$j+$i]."</td>";	
			}
		
		}
		if($checker==true){
		}
		else{
			echo "</tr>";
		}
		
     
		
		
		}
      }
      else{
		  
          $p=0;
          $data_=fgets($file);
          $data_array=explode("\t",$data_);
		  
           $header="";
           $new_file_name="";
           $num=1;
         
          
             if($p==0){
                      $new_file_name=$data_array[0];
                      $_SESSION['institution_name']=$new_file_name;
                      //echo $_SESSION['institution_name'];
                      $p=1;
                  }
				  else{
				  }
					  
				  $temp_str=trim(str_replace("\"","",$data_array[13]));
				  $temp_str=date('Y-m-d',strtotime($temp_str));
                 
        echo "
        <tr><td colspan='1'>".$data_array[0]."</td>
        <td colspan='1'>".$data_array[1]."</td>
        <td colspan='1'>".$data_array[2]."</td>
        <td colspan='1'>".$data_array[3]."</td>
        <td colspan='1'>".$data_array[4]."</td>
        <td colspan='1'>".$data_array[5]."</td>
        <td colspan='1'>".$data_array[6]."</td>
        <td colspan='1'>".$data_array[7]."</td>
        <td colspan='1'>".$data_array[8]."</td>
        <td colspan='1'>".$data_array[9]."</td>
        <td colspan='1'>".$data_array[10]."</td>
        <td colspan='1'>".$data_array[11]."</td>
        <td colspan='1'>".$data_array[12]."</td>
		<td colspan='1'>".$temp_str."</td>
		<td colspan='1'>".$data_array[14]."</td>
		<td colspan='1'>".$data_array[15]."</td>
		<td colspan='1'>".$data_array[16]."</td>
		<td colspan='1'>".$data_array[17]."</td>
		<td colspan='1'>".$data_array[18]."</td>
		<td colspan='1'>".$data_array[19]."</td>
		<td colspan='1'>".$data_array[20]."</td>
		<td colspan='1'>".$data_array[21]."</td>
		<td colspan='1'>".$data_array[22]."</td>
		<td colspan='1'>".$data_array[23]."</td>
		<td colspan='1'>".$data_array[24]."</td>
		<td colspan='1'>".$data_array[25]."</td>
		</tr>";
		
	 $query="INSERT INTO exp_file_data(Institution,Director,Operator,Cytometer,CytometerSerialNumber,SwVersion	
,SampleName,SampleID,CaseNumber,AGE,SEX,SITE,PanelName,Date_Analyzed,LabReportFileName,PhysiciansReportFileName,RefRange,Comments,CD3CD4CD45TruCFCSFileName,CD3CD4CD45TruCLotID,CD3CD4CD45TruCErrorCodes,CD3CD4CD45TruCCD3Lymph,CD3CD4CD45TruCCD3AbsCnt,CD3CD4CD45TruCCD3CD4Lymph,CD3CD4CD45TruCCD3CD4AbsCnt,CD3CD4CD45TruCCD45AbsCnt) values ('".$data_array[0]."','".$data_array[1]."','".$data_array[2]."','".$data_array[3]."','".$data_array[4]."','".$data_array[5]."','".$data_array[6]."','".$data_array[7]."','".$data_array[8]."','".$data_array[9]."','".$data_array[10]."','".$data_array[11]."','".$data_array[12]."','".$temp_str."','".$data_array[14]."','".$data_array[15]."','".$data_array[16]."','".$data_array[17]."','".$data_array[18]."','".$data_array[19]."','".$data_array[20]."','".$data_array[21]."','".$data_array[22]."','".$data_array[23]."','".$data_array[24]."','".$data_array[25]."') ON DUPLICATE KEY UPDATE SampleID=SampleID ";
        if(isset($conf))
        {
        $insertexpdata = mysql_query($query);
        $num+=1;
        }	
			  
	}
  $test++;
  }
echo  "</tbody></table></div>";
fclose($file);
        }
   }

if (isset($_POST['submit_1']))
{
	//If all rows were inserted!
	if(($test-1)==$counter){
		$_SESSION['success']='<div class="success"><center> FACS CALIBUR Results UPLOAD WAS SUCCESSFUL</center></div>';
	}
	
	//No rows were inserted
	else if($counter==0){
		//$_SESSION['success']='<div class="error"><strong><font><center>THE FILE ALREADY EXISTS</center></font></strong></div>';
        $_SESSION['success']='<div class="success"><center> FACS CALIBUR Results UPLOAD WAS SUCCESSFUL</center></div>';
	}
	
	//echo $counter."<br>";die();
  
  header("location:uploadfacsdata.php");
  exit;

}

        ?>
        </div>
         <div>       
      <form name="frm" method="post" enctype="multipart/form-data" id="frm_1">
                   <input type="hidden" name="file_name" value="<?php if( isset($click)){ echo $_FILES['file1']['name'];}?>"  />
                <input type="hidden" name="file_temp_name" value="<?php if( isset($click)){ echo $_FILES['file1']['tmp_name'];}?>"  />
                <?php if(!isset($test)){
                    ?><?php echo $_POST['msg'];?>
                 <div class="clonable form"> 
                  	
                  	
                  	<table>
                  		<tr>
                  			<td style="padding-left: 5%" width="30%">
                  				
                  				<div class="notice" style="padding: 5%;border:1;  " >
                                  <b>Upload an exp file<br />
                                  <b>The Calibur result File must be an exp file<br />	
                                 <font color="red" size="+1"> e.g. 030513.exp</font>
                                  </b>
                                  
                  		
                  	</div>
                  				
                  				
                  			</td>
                  			
                  			<td width="70%">
                  			  	
                   <table width="60%" border="1" class="data-table" id="data-tabular">
                         <tr>
                        
                                  
                                <td><b>Equipment Type:</b> </td><td>Facs Calibur</td>
                               </tr>
                                <tr><td> <b>Facility Name:</b></td><td> <?php echo $_SESSION['username'];?></td>
                                </tr><tr><td><b>Enter Operator's Name:</b> </td><td><input name="name" placeholder="Enter Name" class="text"/></td>
                                 </tr><tr><td><b>Date of Upload:</b></td><td> <?php echo date("d F Y");?></td>   
                                   </tr> <tr><td>
                                    <b><span class="mandatory">*</span>File to upload:</b></td><td><input type="file" name="file1" id="file1" size="30"/></td>
                                   </td></tr>
                             <p>&nbsp;</p>
                           
                    </table>	
                  				<div style="border:medium;margin:auto;height:auto;">
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
                   
                  				
                  				
                  				
                  			</td>
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
            
                include("includes/sideprogram.php"); ?>

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
    ob_end_flush();
        include("includes/footer.php");
        
        ?>