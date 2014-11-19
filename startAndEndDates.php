<?php
	/*$beg = date('Y-m-d',strtotime($_POST["DATE"]));	//Set the date to the first day of the month
	$num = date('t',strtotime($_POST["DATE"]));		//Get the num of days in the month
	$num--;											
	$modificationStr="+$num day";					
	$end=new DateTime($beg);
	date_modify($end,$modificationStr);*/
	
	echo date('Y-m-t',strtotime($_POST["DATE"]));
?>

<?php /*?><form method="post" action="startAndEndDates.php">
	<input type="text" name="DATE" id="DATE" />
    <input type="submit" value="Submit">
    
</form><?php */?>