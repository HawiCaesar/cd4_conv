<?php
@session_start();
if(!isset($_SESSION['username'])){
echo "<script>";
echo "window.location.href='facilitylogin.php'";
echo "</script>";
}
include ("includes/commodityheader1.php");
require_once ("includes/dbConf.php");
$db = new dbConf();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$from = date('Y-m-d', strtotime($_POST['from']));
$to = date('Y-m-d', strtotime($_POST['to']));
submitcommodity($_POST['mfl'], $from, $to, $_POST['caliburtestsAdults'],$_POST['caliburtestsPead'], $_POST['caliburs'], $_POST['counttestsAdults'],$_POST['counttestsPead'], $_POST['counts'], $_POST['cyflowtestsAdults'], $_POST['cyflowtestsPead'],$_POST['cyflows'], $_POST['beginningbal'], $_POST['receivedqty'], $_POST['receivedlot'], $_POST['qtyused'], $_POST['losses'], $_POST['adjustmentplus'], $_POST['adjustmentminus'], $_POST['endbal'], $_POST['requested'], $_POST['namer']);

}

$arr=loadcommoditypage($_SESSION['facility']);


if ($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET["fcdrrlistID"])){
$fcdrrList=$_GET['fcdrrlistID'];
$arr=loadPrevCommodityPage($fcdrrList);	
}
}
?>


<link href="DataTables/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
                <link href="DataTables/media/css/demo_table.css" rel="stylesheet" media="screen">
               <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
              
                <script type="text/javascript">
                $(document).ready(function() {
$('#data-table1').dataTable({
   "bJQueryUI":true,
   "bSort":false,
"bPaginate":false,
"sScrollY": "500px",
"bFilter": false,
"bInfo": false
});
});
                </script>


<script type="text/javascript">
$(document).ready(function() {
<?php if(sizeof($arr)>0){
?>
$("#from").val("<?php echo date('Y-m-d',strtotime($arr[0]['fromdate'])); ?>");
$("#to").val("<?php echo $arr[0]['todate']; ?>");
$("#counttestsAdults").val("<?php echo $arr[0]['counttestsAdults']; ?>");
$("#counttestsPead").val("<?php echo $arr[0]['counttestsPead']; ?>");
$("#caliburs").val("<?php echo $arr[0]['caliburs']; ?>");
$("#counts").val("<?php echo $arr[0]['counts']; ?>");
$("#cyflows").val("<?php echo $arr[0]['cyflows']; ?>");
$("#caliburtestsAdults").val("<?php echo $arr[0]['caliburtestsAdults']; ?>");
$("#caliburtestsPead").val("<?php echo $arr[0]['caliburtestsPead']; ?>");
$("#counttests").val("<?php echo $arr[0]['counttests']; ?>");
$("#cyflowtestsAdults").val("<?php echo $arr[0]['cyflowtestsAdults']; ?>");
$("#cyflowtestsPead").val("<?php echo $arr[0]['cyflowtestsPead']; ?>");
<?php 
}
 foreach($arr as $ar){
?>
 var row_id=<?php echo $ar['reagentID']; ?>; 
 	
 
 
 $("input[name='beginningbal["+row_id+"]']").val("<?php echo $ar['beginningbal'];?>");
 $("input[name='receivedqty["+row_id+"]']").val("<?php echo $ar['receivedqty'];?>");
 $("input[name='receivedlot["+row_id+"]']").val("<?php echo $ar['receivedlot'];?>");
 $("input[name='qtyused["+row_id+"]']").val("<?php echo $ar['qtyused'];?>");
 $("input[name='losses["+row_id+"]']").val("<?php echo $ar['losses'];?>");
 $("input[name='adjustmentplus["+row_id+"]']").val("<?php echo $ar['adjustmentplus'];?>");
 $("input[name='adjustmentminus["+row_id+"]']").val("<?php echo $ar['adjustmentminus'];?>");
 $("input[name='endbal["+row_id+"]']").val("<?php echo $ar['endbal'];?>");
 $("input[name='requested["+row_id+"]']").val("<?php echo $ar['requested'];?>");
 
 
<?php
 }
?>
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
+"&drug_id="+$(document.getElementsByName("namer["+row_id+"]")).val()
+"&beginning_bal="+$(document.getElementsByName("beginningbal["+row_id+"]")).val()
+"&received_qty="+$(document.getElementsByName("receivedqty["+row_id+"]")).val()
+"&received_lot="+$(document.getElementsByName("receivedlot["+row_id+"]")).val()
+"&qty_used="+$(document.getElementsByName("qtyused["+row_id+"]")).val()
+"&losses="+$(document.getElementsByName("losses["+row_id+"]")).val()
+"&adjustmentplus="+$(document.getElementsByName("adjustmentplus["+row_id+"]")).val()
+"&adjustmentminus="+$(document.getElementsByName("adjustmentminus["+row_id+"]")).val()
+"&endbal="+$(document.getElementsByName("endbal["+row_id+"]")).val()
+"&requested="+$(document.getElementsByName("requested["+row_id+"]")).val();
 
var url_ ='<?php echo "http://".$_SERVER['SERVER_NAME']."/cd4/test_ajax_post.php"; ?>';
 
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
$("#to").datepicker({
yearRange : "-120:+0",
maxDate : "0D",
dateFormat : $.datepicker.ATOM,
changeMonth : true,
changeYear : true
});
$("#from").datepicker({
yearRange : "-120:+0",
maxDate : "0D",
dateFormat : $.datepicker.ATOM,
changeMonth : true,
changeYear : true
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

$('#caliburtestsAdults').keyup(function() {
var code = $("#caliburtestsAdults").val();
$('#1').val(Math.ceil((code / 50).toFixed(2)));
$('#3').val(Math.ceil((code / 2000).toFixed(2)));
$('#6').val(Math.ceil((code / 500).toFixed(2)));

});
$('#counttestsPead').keyup(function() {
var code = $("#counttestsPead").val();
$('#29').val(code / 50);

});
$('#caliburs').keyup(function() {
var code= $("#caliburs").val();
//var code1 = ($("#to").val() - $("#from").val());
$("#to").datepicker({
dateFormat : 'mm/dd/yy'
});
//var month=$("#to").val();
//var month2 = $("#from").val();
var date = $('#to').datepicker('getDate');
var today = $('#from').datepicker('getDate');
var diff = Math.floor(((date - today) / (1000 * 60 * 60 * 24)/28));
$('#2').val(Math.ceil((diff*code).toFixed(2)));
$('#4').val(Math.ceil((diff*code/3).toFixed(2)));
$('#5').val(Math.ceil((diff*code/3).toFixed(2)));
$('#8').val(Math.ceil((diff*code).toFixed(2)));
$('#9').val(Math.ceil((diff*code).toFixed(2)));
});


$('#counttestsAdults').keyup(function() {
var code = $("#counttestsAdults").val();
$('#21').val(Math.ceil((code / 50).toFixed(2)));
$('#23').val(Math.ceil((code / 500).toFixed(2)));
$('#26').val(Math.ceil(((code / 100)/5).toFixed(2)));

});
$('#counts').keyup(function() {
var code= $("#counts").val();
//var code1 = ($("#to").val() - $("#from").val());
$("#to").datepicker({
dateFormat : 'mm/dd/yy'
});
//var month=$("#to").val();
var month2 = $("#from").val();
var date = $('#to').datepicker('getDate');
var today = $('#from').datepicker('getDate');
var diff = Math.floor(((date - today) / (1000 * 60 * 60 * 24)/28));
$('#22').val(Math.ceil((diff*code).toFixed(2)));
$('#24').val(Math.ceil((diff*code/3).toFixed(2)));
$('#25').val(Math.ceil((diff*code/3).toFixed(2)));
});


$('#cyflowtestsAdults').keyup(function() {
var code = parseInt($("#cyflowtestsAdults").val());
var coder = parseInt($("#counttestsAdults").val());
var coded = parseInt($("#caliburtestsAdults").val());
var code1 = parseInt($("#cyflowtestsPead").val());
var coder1 = parseInt($("#counttestsPead").val());
var coded1 = parseInt($("#caliburtestsPead").val());
var totAdults=((code)+(coder)+(coded));
var tottests=((code)+(coder)+(coded)+(code1)+(coder1)+(coded1));
//alert(totAdults);
var code2 = $("#totalsites").val();
$('#12').val((Math.ceil(((code / 100)/code2)).toFixed(2))*code);
$('#13').val(Math.ceil((totAdults*6).toFixed(2)));
$('#27').val(Math.ceil((totAdults/ 100).toFixed(2)));
$('#28').val(Math.ceil((totAdults/ 48).toFixed(2)));
$('#33').val(Math.ceil((tottests).toFixed(2)));
//$('#26').val((code / 100)/5);

});
$('#cyflowtestsPead').keyup(function() {
var code = parseInt($("#cyflowtestsPead").val());
var coder = parseInt($("#counttestsPead").val());
var coded = parseInt($("#caliburtestsPead").val());
var totpaed=((code)+(coder)+(coded));
//alert(totAdults);
var code2 = $("#totalsites").val();
$('#30').val(Math.ceil((totpaed/200).toFixed(2)));
$('#31').val(Math.ceil((totAdults/ 2000).toFixed(2)));
//$('#26').val((code / 100)/5);

});

});

</script>

<?php
$mflcode=$_SESSION['facility'];
$sql="SELECT * FROM `equipmentdetails` WHERE MFLCode='$mflcode' GROUP BY MFLCode";
$q=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($q);

?>
<div class="main-2" id="main-two-columns">
 <p> <h2 style="text-align:center; font-size: 20px;">FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>
  </p>
<form method="post" action="cd4commodity.php">

<table class="data-table" width="80%">
<tr>
    <th><b>Name of Facility:</b></th>
    <td colspan="3"><input name="fac" type="input" class="texts" disabled value="<?php echo $_SESSION['username'];?>" size="35"/></td>
    <th><b>Facility Code:</b></th>
    <td><input type="text" name="mfl"  class="texts"  value="<?php echo $_SESSION['facility'];?>" disable /></td>
    <th><b>District:</b></th>
    <td><input type="text" name="district"  class="texts" disable value="<?php echo $rs[14];?>" /></td>
    <th><b>Province/County:</b></th> 
    <td><input type="text" name="county" class="texts"  disable value="<?php echo  $rs[16];?>" /> </td>
    <th><b>Affiliation:</b></th> 
    <td><input type="text"  class="texts" name="affiliation" disable value="<?php echo  $rs[8];?>" /> </td>
  </tr>
  
  <tr>
    <th align="right" colspan="2"><b>REPORT FOR PERIOD:</b></th>
    <th colspan="2"><b>BEGINNING:</b></th>
    <td colspan="2"><input type="text" name="from" id="from" class="texts" placeholder="DD/MM/YYYY" required value=""  /></td>
    <th colspan="2"><b>ENDING:<b></th>
    <td colspan="2"><input type="text" name="to" id="to" class="texts" placeholder="DD/MM/YYYY"  required value="" /></td>
    <td colspan="2"></td>    
  </tr>
  <tr>
    <th colspan="2" align="left"><b>State the number of CD4 Tests conducted:-</b></th>
    <td colspan="3"><b> Calibur:</b><input placeholder="Pead Tests" name="caliburtestsPead" id="caliburtestsPead" class="texts" required value=""  size="6"/>&nbsp;&nbsp;<input placeholder="Adult Tests" name="caliburtestsAdults" id="caliburtestsAdults" required value=""  class="texts"  size="6"/>&nbsp;&nbsp;<input placeholder="Equip No." name="caliburs"  id="caliburs" class="texts" size="6" required value="" /></td>
    <td colspan="3"><b> Count:</b><input placeholder="Pead Tests" name="counttestsPead" id="counttestsPead"  class="texts" required value=""  size="6" />&nbsp;&nbsp;<input placeholder="Adult Tests" name="counttestsAdults" id="counttestsAdults"  required value=""  class="texts" size="6" />&nbsp;&nbsp;<input placeholder="Equip No." name="counts" id="counts" class="texts" size="6" required value="" /></td>
    <td colspan="4"><b>Cyflow Partec:</b> <input placeholder="Pead Tests" name="cyflowtestsPead" id="cyflowtestsPead" class="texts" size="6" required value=""  />&nbsp;&nbsp;<input placeholder="Adult Tests" name="cyflowtestsAdults" id="cyflowtestsAdults" class="texts" size="6" required value=""  />&nbsp;&nbsp;<input placeholder="Equip No." name="cyflows" id="cyflows" class="texts" size="6" required value="" /><input type="hidden" name="totalsites"  id="totalsites" value="1"/></td>    
  </tr>
  <tr>
    <th colspan="6"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></th>
    <td colspan="8">&nbsp;</td>
  </tr>
</table>
<table width="100%" id="data-table1" id="data-table"">

    <thead>	
<tr>	<th rowspan="2"><b>COMMODITY CODE</b></th>
<th rowspan="2"><b>COMMODITY NAME</b></th>
            <th rowspan="2"><b>UNIT OF ISSUE</b></th>
            <th rowspan="2"><b>BEGINNING BALANCE</b></th>
            <th colspan="2"><b>QUANTITY RECEIVED FROM CENTRAL<br/> WAREHOUSE (e.g. KEMSA)</b></th>             
            <th rowspan="2"><b>QUANTITY USED</b></th>
            <th rowspan="2"><b>LOSSES/WASTAGE</b></th>
            <th colspan="2"><b>ADJUSTMENTS<br/><i>Indicate if (+) or (-)</i></b></th>
            <th rowspan="2"><b>ENDING BALANCE <br/>PYSICAL COUNT at end of the Month</b></th>
            <th rowspan="2"><b>QUANTITY REQUESTED</b></th>
            </tr>
            
            
            <tr>      
             <th>Quantity</th>
            <th>Lot No.</th>
            <th>Positive</th>
            <th>Negative</th>    
            </tr>
    </thead>	    
    <tbody>  
            
            
<?php
reagentCategory31($_SESSION['facility']);
?>
 	

</tbody></table>

<table class="data-table" width="80%">
<tr><td colspan="12"><textarea placeholder="FCDRR Comments" name="comments" cols="250"></textarea></td></tr>
<tr><td colspan="6"><center><input type="submit" name="submit" value="Submit Commodity Report" class="button" /></center></td>
<td colspan="6"><center><input type="submit" name="print" value="Print FCDRR Copy" class="button" /></center></td></tr>
</table>
</table>

</form>
 </div>
<?php
include 'includes/footer.php';
?>