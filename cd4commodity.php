<?php
 	
@session_start();

include ("includes/commodityheader1.php");
require_once ("includes/dbConf.php");
$db = new dbConf();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	

//	$from = date('Y-m-d', strtotime($_POST['from']));
//	$to = date('Y-m-d', strtotime($_POST['to']));
	
	// using specified month and year we ge the 1st date and the last date
	//$tarehefirst = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
	//$tarehelast = date("Y-m-d", mktime(0, 0, 0, date("m"), 0, date("Y")));

	$month = $_POST['month'];
	$year = $_POST['year'];
	$tarehefirst = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year)); 
	$tarehelast = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));
	$from = $tarehefirst;
	$to = $tarehelast;
	
	
	//$first = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year)); 
    //$last = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));
	
			
	submitcommodity($_POST['mfl'], $from, $to, $_POST['caliburtestsAdults'], $_POST['caliburtestsPead'], $_POST['caliburs'], $_POST['counttestsAdults'], $_POST['counttestsPead'], $_POST['counts'], $_POST['cyflowtestsAdults'], $_POST['cyflowtestsPead'], $_POST['cyflows'],$_POST['pimatests'],$_POST['pimas'], $_POST['beginningbal'], $_POST['receivedqty'], $_POST['receivedlot'], $_POST['qtyused'], $_POST['losses'], $_POST['adjustmentplus'], $_POST['adjustmentminus'], $_POST['endbal'], $_POST['requested'], $_POST['namer'], $_POST['comments']);

}

$arr = loadcommoditypage($_SESSION['facility']);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (isset($_GET["fcdrrlistID"])) {
		$fcdrrList = $_GET['fcdrrlistID'];
		$arr = loadPrevCommodityPage($fcdrrList);
	}
}
?>

<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
<link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="cd4CommodityCalculator.js"></script>

<script type="text/javascript"><?php ?>
	$(document).ready(function() {
		$('#data-table1').dataTable({
			"bJQueryUI" : true,
			"bSort" : false,
			"bPaginate" : false,
			"sScrollY" : "240px",
			"bFilter" : false,
			"bInfo" : false
		});
		
		$('#year').change(function(){
		year = $('#year').val();
		//alert(year);
if(year=='2013'){
	months='<option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>';
	$('#month').html(months);
}
else if(year=="2014"){
	months='<option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option<option value="06">June</option>
	$('#month').empty();
	$('#month').html(months);
}
	});
		
	}); 
<?php ?></script>

<script type="text/javascript">

	var startDate=new Date();
	startDate.setDate(0);
	var stopDate=new Date();
	stopDate.setDate(0);

	$(document).ready(function() {
		
	$("#from").val(startDate.format("Y-m-d"));
	$("#to").val(stopDate.format("Y-m-d"));

	<?php
	if ($_SERVER['REQUEST_METHOD']=='GET'){
	if(isset($_GET["fcdrrlistID"])){
	?>
		/*$("#from").attr("disabled",true);
		 $("#to").attr("disabled",true);*/
	<?php
	}
	}

	if(sizeof($arr)>0){
	?>

		$("#from").val("<?php echo date('Y-m-d', strtotime($arr[0]['fromdate'])); ?>");
		$("#to").val("	<?php echo $arr[0]['todate']; ?>		");
		$("#month").val("<?php echo date('m', strtotime($arr[0]['fromdate'])); ?>");
		$("#year").val("<?php echo date('Y', strtotime($arr[0]['fromdate'])); ?>");
		$("#counttestsAdults").val("<?php echo $arr[0]['counttestsAdults']; ?>	");
		$("#counttestsPead").val("<?php echo $arr[0]['counttestsPead']; ?>	");
		$("#caliburs").val("<?php echo $arr[0]['caliburs']; ?>");
		$("#counts").val("<?php echo $arr[0]['counts']; ?>	");
		$("#cyflows").val("	<?php echo $arr[0]['cyflows']; ?>");
		$("#caliburtestsAdults").val("	<?php echo $arr[0]['caliburtestsAdults']; ?>");
		$("#caliburtestsPead").val("<?php echo $arr[0]['caliburtestsPead']; ?>	");
		$("#counttests").val("<?php echo $arr[0]['counttests']; ?>	");
		$("#cyflowtestsAdults").val("<?php echo $arr[0]['cyflowtestsAdults']; ?>");
		$("#cyflowtestsPead").val("<?php echo $arr[0]['cyflowtestsPead']; ?>");
		$("#pimas").val("<?php echo $arr[0]['pimas']; ?>");
		$("#pimatests").val("<?php echo $arr[0]['pimatests']; ?>");
		$("#total").val("<?php echo $arr[0]["cyflowtestsAdults"] + $arr[0]["cyflowtestsPead"] + $arr[0]["counttestsAdults"] + $arr[0]["counttestsPead"] + $arr[0]["caliburtestsPead"] + $arr[0]["caliburtestsAdults"] + $arr[0]["pimatests"]; ?>");
		$("#comments").val("<?php echo $arr[0]['comments']; ?>");

	<?php
	}

	foreach($arr as $ar){
	?>var row_id =<?php echo $ar['reagentID']; ?>;

	$("input[name='beginningbal["+row_id+"]']").val("<?php echo $ar['beginningbal']; ?>");
		$("input[name='receivedqty["+row_id+"]']").val("<?php echo $ar['receivedqty']; ?>");
		$("input[name='receivedlot["+row_id+"]']").val("<?php echo $ar['receivedlot']; ?>");
		$("input[name='qtyused["+row_id+"]']").val("<?php echo $ar['qtyused']; ?>");
		$("input[name='losses["+row_id+"]']").val("<?php echo $ar['losses']; ?>");
		$("input[name='adjustmentplus["+row_id+"]']").val("<?php echo $ar['adjustmentplus'];?>");
		$("input[name='adjustmentminus["+row_id+"]']").val("<?php echo $ar['adjustmentminus']; ?>");
		$("input[name='endbal["+row_id+"]']").val("<?php echo $ar['endbal']; ?>");
		$("input[name='requested["+row_id+"]']").val("<?php echo $ar['requested']; ?>");
		$("input[name='commodityID["+row_id+"]']").val("<?php echo $ar['commodityID']; ?>");

	<?php
	}
	?>

			autoloadBegBal();

	//bind event
	$(".text").live("click keyup", function (event){
	var row_id=$(this).attr("test");

	var items="facility_code="+$('input[name=mfl]').val()
	+"&to="+$("#to").val()
	+"&from="+$("#from").val()
	+"&caliburs="+$("#caliburs").val()
	+"&caliburtestsAdults="+$("#caliburtestsAdults").val()
	+"&caliburtestsPead="+$("#caliburtestsPead").val()
	+"&counts="+$("#counts").val()
	+"&counttestsAdults="+$("#counttestsAdults").val()
	+"&counttestsPead="+$("#counttestsPead").val()
	+"&cyflows="+$("#cyflows").val()
	+"&cyflowtestsAdults="+$("#cyflowtestsAdults").val()
	+"&cyflowtestsPead="+$("#cyflowtestsPead").val()
	+"&pimas="+$("#pimas").val()
	+"&pimatests="+$("#pimatests").val()
	+"&drug_id="+$(document.getElementsByName("namer["+row_id+"]")).val()
	+"&beginning_bal="+$(document.getElementsByName("beginningbal["+row_id+"]")).val()
	+"&received_qty="+$(document.getElementsByName("receivedqty["+row_id+"]")).val()
	+"&received_lot="+$(document.getElementsByName("receivedlot["+row_id+"]")).val()
	+"&qty_used="+$(document.getElementsByName("qtyused["+row_id+"]")).val()
	+"&losses="+$(document.getElementsByName("losses["+row_id+"]")).val()
	+"&adjustmentplus="+$(document.getElementsByName("adjustmentplus["+row_id+"]")).val()
	+"&adjustmentminus="+$(document.getElementsByName("adjustmentminus["+row_id+"]")).val()
	+"&endbal="+$(document.getElementsByName("endbal["+row_id+"]")).val()
	+"&requested="+$(document.getElementsByName("requested["+row_id+"]")).val()
	+"&comments="+$("#comments").val();

	var url_ ='<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/cd4/test_ajax_post.php"; ?>
		';

		$.ajax({
		type:"POST",
		data:items,
		url:url_,
		beforeSend: function(){

		},
		success: function(msg){

		console.log(msg);
		}
		});
		});

		$("#facilities").change(function() {
		// alert($(this).val());
		var code = $("#facilities").val();

		var code_array = code.split("|");
		$('input:[name=mfl]').val(code_array[1]);
		$('input:[name=district]').val(code_array[3]);
		$('input:[name=county]').val(code_array[4]);

		switch (code_array[2]) {
		case 'MoH':
		$('#MoH').attr('checked', 'checked');
		break;
		case 'LA':
		$('#LA').attr('checked', 'checked');
		break;
		case 'FBO':
		$('#FBO').attr('checked', 'checked');
		break;
		case 'NGO':
		$('#NGO').attr('checked', 'checked');
		break;
		case 'Private':
		$('#private').attr('checked', 'checked');
		break;
		default:
		$('#others').attr('checked', 'checked');
		break;
		}
		});

		});

		function doOnSubmit(){
		return((isPrevSaved() || !ifFDRRExists())&&validateCommodity());

		}

		function ifFDRRExists(){
		$.ajax({
		type:"POST",
		async:false,
		data:"to="+$("#to").val()+"&from="+$("#from").val(),
		url:"<?php echo "http://".$_SERVER['SERVER_NAME']."/cd4/checkIfFCDRRExists_ajax.php"?>",
		success:function(data) {
		$("#exists").val(data);
		}
		});
		exists=$("#exists").val();

		if(exists==""){
		alert("This period has already been reported on!");
		return true;
		}else{

		return false;
		}
		}

		function isPrevSaved(){
		var status= false;

	<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_GET["fcdrrlistID"])) {
			echo "status=true;";
		}
	}
	?>
			if(status){
	var r= confirm("Do you want to commit changes to this FCDRR List?");
	if(r==true){

	$.post("<?php echo "http://".$_SERVER['SERVER_NAME']."/cd4/updatecommodities_ajax.php"?>
		",
		{
		fcdrrListID: "<?php echo $_GET["fcdrrlistID"] ?>",
		mflcode:"<?php echo $_SESSION['facility']; ?>",
		fromdate:$("#from").val(),
		$todate:$("#to").val(),
		caliburtestsAdults:$("#caliburtestsAdults").val(),
		caliburtestsPead:$("#caliburtestsPead").val(),
		caliburs:$("#caliburs").val(),
		counttestsAdults:$("#counttestsAdults").val(),
		counttestsPead:$("#caliburtestsPead").val(),
		counts:$("#counts").val(),
		cyflowtestsAdults:$("#cyflowtestsAdults").val(),
		cyflowtestsPead:$("#cyflowtestsPead").val(),
		cyflows:$("#cyflows").val(),
		pimatests:$("#pimatests").val(),
		pimas:$("#pimas").val(),
		commodityID:$("#commodityID").val(),
		beginningbal:$("#beginningbal").val(),
		receivedqty:$("#receivedqty").val(),
		receivedlot:$("#receivedlot").val(),
		qtyused:$("#qtyused").val(),
		losses:$("#losses").val(),
		adjustmentplus:$("#adjustmentplus").val(),
		adjustmentminus:$("#adjustmentminus").val(),
		endbal:$("#endbal").val(),
		requested:$("#requested").val(),
		reagent:$("#reagent").val(),
		comments:$("#comments").val()

		},
		function(data,status){
		$("#exists").val(data);
		});
		alert("saved");
		return false;
		}else{return false;}
		}else{ return false;}
		}
		function  validateCommodity(){
		return true;
		}

		function printCommodity(){
	<?php
	if ($_SERVER['REQUEST_METHOD']=='GET'){
	if(isset($_GET["fcdrrlistID"])){

	?>
	window.location.assign("<?php echo "http://".$_SERVER['SERVER_NAME']."/cd4/cd4commodityprint.php?fcdrrlistID=".$_GET['fcdrrlistID']?>");<?php
	}

	}else{
	?>
		alert("This List has not been saved yet!");

	<?php

	}
	?>
			}

	
		//Calculate Ending Bal

		function endingBal(reagent){

		var endBal =    parseInt(0+$("input[name='beginningbal["+reagent+"]']").val())+
		parseInt(0+$("input[name='receivedqty["+reagent+"]']").val())-
		parseInt(0+$("input[name='qtyused["+reagent+"]']").val())-
		parseInt(0+$("input[name='losses["+reagent+"]']").val())+
		parseInt(0+$("input[name='adjustmentplus["+reagent+"]']").val())-
		parseInt(0+$("input[name='adjustmentminus["+reagent+"]']").val());

		$("input[name='endbal["+reagent+"]']").val(endBal);

		}
		function clearTempData(){
		//$("#commodity")[0].reset();
		$("#commodity").trigger("reset");
		$.ajax({
		type:"POST",
		async:false,
		data:"MFLCode="+
	<?php echo $_SESSION['facility']; ?>
		,
		url:"<?php echo "http://".$_SERVER['SERVER_NAME']."/cd4/clearTempData.php"?>",
		success:function(data) {

		}
		});
		autoloadBegBal();
		}

		function autoloadBegBal(){
		//Aotoload previous month Ending balance as current month Beginning balance
	<?php
	if ($_SERVER['REQUEST_METHOD']=='GET'){
	if(!isset($_GET["fcdrrlistID"])){
	$prevBalArr = loadPrevBegBal($_SESSION['facility']);

	foreach($prevBalArr as $ar){
	?>var row_id =<?php echo $ar['reagentID']; ?>;

	$("input[name='beginningbal["+row_id+"]']").val("<?php echo $ar['endbal']; ?>
		");
		$("input[name='beginningbal["+row_id+"]']").attr("readonly","readonly");
	<?php
	}
	}
	}
?>}</script>

<?php
$mflcode = $_SESSION['facility'];
$sql = "SELECT * FROM `equipmentdetails` WHERE MFLCode='$mflcode' GROUP BY MFLCode";
$q = mysql_query($sql) or die(mysql_error());
$rs = mysql_fetch_row($q);
?>
<div class="main-2" id="main-two-columns">
	<h2 style="text-align:center; font-size: 20px;">FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>
	<form method="post" action="cd4commodity.php" id="commodity" onsubmit="return doOnSubmit()">

		<table class="data-table" >

			<thead>
				<td><b>Name of Facility:</b></td>
				<td colspan="1">
				<input name="fac" type="text" style="background-color:transparent;border:0px solid white;" class="texts" disabled value="<?php echo $_SESSION['username']; ?>" size="30"/>
				</td>
				<td><b>Facility Code:</b></td>
				<td>
				<input name="mfl" type="text" style="background-color:transparent;border:0px solid white;" class="texts"  value="<?php echo $_SESSION['facility']; ?>" readonly="readonly" disable />
				</td>
				<td><b>District:</b></td>
				<td>
				<input name="district" type="text" style="background-color:transparent;border:0px solid white;" class="texts" value="<?php echo $rs[14]; ?>" readonly="readonly" disable />
				</td>
				<td><b>Province/County:</b></td>
				<td>
				<input name="county" type="text"  style="background-color:transparent;border:0px solid white;" class="texts" value="<?php echo $rs[16]; ?>" readonly="readonly"  disable />
				</td>
				<td><b>Affiliation:</b></td>
				<td>
				<input name="affiliation" type="text" size="3" style="background-color:transparent;border:0px solid white;" class="texts" value="<?php echo $rs[8]; ?>" readonly="readonly" disable />
				</td>
			</thead>

			<tr>
				<td align="right"><b>REPORT FOR THE PERIOD:</b></td>
				<td align="right"><b> Year:</b></td>
				<td>
				<select name="year" id="year" required >
					<option value=""><i>Select A year</i></option>
					<?php
					$year = date('Y');

					echo "<option value=" . ((int)$year) . ">" . ((int)$year) . "</option>";

					?>
				</select></td>
				<td align="center"><b> Month:</b></td>
				<td>
				<select name="month" id="month" onchange="changeDate()" required >

					<option value="">Select A Month</option>
					<?php
				
				/*$month = date('m');
				$timestamp = mktime(0, 0, 0, $month-1, 10);
				$monthName = date("F", $timestamp);
					echo '<option value='.$month.'>'.$monthName.'</option>' ;
				*/
				?>
				   <?php 
					$month = date('m'); 
					for($month = 1;$month <= 12; $month++){ 
					    $monthName =  date("F", mktime(0, 0, 0, $month, 1)); 
					   echo '<option value='.$month.'>'.$monthName.'</option>' ;
					}  
					?>	
				</select></td>
				<td colspan="5" >
				<center style="visibility: hidden" >
					<b> from: </b>
					<input type="text"  name="from" id="from"  placeholder="DD/MM/YYYY" required value="" readonly="readonly"  />
					<b> to:</b>
					<input type="text" name="to" id="to"  placeholder="DD/MM/YYYY"  required value="" readonly="readonly" />
				</td>
				</center>
			</tr>
			<tr>
    <th colspan="1" rowspan ="1" align="left"><b>State the number of CD4 Tests conducted:-</b></th>
    <td colspan="2"><b> Calibur:</b>
    		<input placeholder="Pead Tests" name="caliburtestsPead" id="caliburtestsPead" class="texts" required value="<?php if(hasEquip($_SESSION['facility'],2)!=""){echo 0;} ?>"  size="6" <?php echo hasEquip($_SESSION['facility'],2); ?>/>&nbsp;&nbsp;
        	<input placeholder="Adult Tests" name="caliburtestsAdults" id="caliburtestsAdults" required value="<?php if(hasEquip($_SESSION['facility'],2)!=""){echo 0;} ?>"  class="texts"  size="6" <?php echo hasEquip($_SESSION['facility'],2); ?>/>&nbsp;&nbsp;
            <input type="hidden" placeholder="Equip No." name="caliburs"  id="caliburs" class="texts" size="6" required value="<?php echo equips($_SESSION['facility'],2);?>"  readonly /></td>
    <td colspan="2"><b> Count:</b>
    		<input placeholder="Pead Tests" name="counttestsPead" id="counttestsPead"  class="texts" required value="<?php if(hasEquip($_SESSION['facility'],1)!=""){echo 0;} ?>"  size="6"  <?php echo hasEquip($_SESSION['facility'],1); ?>/>&nbsp;&nbsp;
            <input placeholder="Adult Tests" name="counttestsAdults" id="counttestsAdults"  required value="<?php if(hasEquip($_SESSION['facility'],1)!=""){echo 0;} ?>"  class="texts" size="6" <?php echo hasEquip($_SESSION['facility'],1); ?> />&nbsp;&nbsp;
            <input type="hidden" placeholder="Equip No." name="counts" id="counts" class="texts" size="6" required value="<?php echo equips($_SESSION['facility'],1);?>" readonly /></td>
  
    <td colspan="2"><b>Cyflow Partec:</b> 
    		<input placeholder="Pead Tests" name="cyflowtestsPead" id="cyflowtestsPead" class="texts" size="6" required value="<?php if(hasEquip($_SESSION['facility'],3)!=""){echo 0;} ?>"  <?php echo hasEquip($_SESSION['facility'],3); ?> />&nbsp;&nbsp;
            <input placeholder="Adult Tests" name="cyflowtestsAdults" id="cyflowtestsAdults" class="texts" size="6" required value="<?php if(hasEquip($_SESSION['facility'],3)!=""){echo 0;} ?>"  <?php echo hasEquip($_SESSION['facility'],3); ?> />&nbsp;&nbsp;
            <input type="hidden" placeholder="Equip No." name="cyflows" id="cyflows" class="texts" size="6" required value="<?php echo equips($_SESSION['facility'],3);?>" readonly />
            <input type="hidden" name="totalsites"  id="totalsites" value="1"/>
    </td>    
    <td colspan="3"><b>Alere PIMA:</b> 
    		<input placeholder="Tests" name="pimatests" id="pimatests" class="texts" size="6" required value="<?php if(hasEquip($_SESSION['facility'],17)!=""){echo 0;} ?>"  <?php echo hasEquip($_SESSION['facility'],17); ?> />&nbsp;&nbsp;
            <input type="hidden" placeholder="Equip No." name="pimas" id="pimas" class="texts" size="6" required value="<?php echo equips($_SESSION['facility'],17);?>" readonly />
            <input type="hidden" name="totalsites"  id="totalsites" value="1"/>
    </td>
  </tr>
			<tr>
				<td colspan="6"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>
				<td colspan="5">
				<center>
					<input class="texts" name="total" id="total" type="text" readonly="readonly" value="" />
				</center></td>

			</tr>
		</table>

		<table width="100%" id="data-table1" >

			<thead>
				<tr>
					<td rowspan="2"><b>COMMODITY CODE</b></td>
					<td rowspan="2"><b>COMMODITY NAME</b></td>
					<td rowspan="2"><b>UNIT OF ISSUE</b></td>
					<td rowspan="2"><b>BEGINNING BALANCE</b></td>
					<td colspan="2"><b>QUANTITY RECEIVED FROM CENTRAL
					<br/>
					WAREHOUSE (e.g. KEMSA)</b></td>
					<td rowspan="2"><b>QUANTITY USED</b></td>
					<td rowspan="2"><b>LOSSES/WASTAGE</b></td>
					<td colspan="2"><b>ADJUSTMENTS
					<br/>
					<i>Indicate if (+) or (-)</i></b></td>
					<td rowspan="2"><b>ENDING BALANCE
					<br/>
					PHYSICAL COUNT at end of the Month</b></td>
					<td rowspan="2"><b>QUANTITY REQUESTED</b></td>
				</tr>

				<tr>
					<td>Quantity</td>
					<td>Lot No.</td>
					<td>Positive</td>
					<td>Negative</td>
				</tr>
			</thead>
			<tbody>
				<?php
				reagentCategory($_SESSION['facility']);
				?>
			</tbody>
		</table>

		<table class="data-table1" id="table">
			<tr>
				<td colspan="9"><textarea placeholder="FCDRR Comments" name="comments" id="comments" cols="150"></textarea></td>
			</tr>
			<tr>
				<td colspan="6">
				<input type="submit" name="submit" value="Submit Commodity Report" class="button" />
				<input type="hidden" value="true" name="exists" id="exists" />
				<input type="hidden" value="true" name="repeat" id="repeat" />
				&nbsp;
				<input type="button" value="Reset" class="button" onclick="clearTempData()"/>
				&nbsp;
				<input type="button" onclick="printCommodity()" name="print" value="Print" class="button"  />
				</td>
			</tr>
		</table>
	</form>
	<div class="clearer">
		&nbsp;
	</div>
</div>
<?php
include 'includes/footer.php';
?>