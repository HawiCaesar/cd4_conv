// JavaScript Document


	$(document).ready(function(){
		
		$('#caliburtestsPead').keyup(function() {
			calcTotals();
			calibursCalc();	
			commonReagentCalc();		
			});
		$('#caliburtestsAdults').keyup(function() {
			calcTotals();
			calibursCalc();
			commonReagentCalc();
			});
		$('#counttestsPead').keyup(function() {
			calcTotals();
			countsCalc();
			commonReagentCalc()
			});
		$('#counttestsAdults').keyup(function() {
			calcTotals();
			countsCalc();
			commonReagentCalc()
			});
		// $('#cyflowtestsPead').keyup(function() {			
		// 	calcTotals();
		// 	cyflowCalc();
		// 	commonReagentCalc()
		// 	});
		// $('#cyflowtestsAdults').keyup(function() {			
		// 	calcTotals();
		// 	cyflowCalc();
		// 	commonReagentCalc()		
		// 	});		
		});
	
	function countsCalc(){
		
		var counttestsAdults = parseInt($("#counttestsAdults").val());
		var counttestsPead = parseInt($("#counttestsPead").val());
		var counts= parseInt($("#counts").val());	
		
			if(isNaN(counttestsAdults)){
					counttestsAdults=0;
				}
			if(isNaN(counttestsPead)){
					counttestsPead=0;
				}
				
		$('#22').val(Math.ceil((counts).toFixed(2)));
		$('#24').val(Math.ceil((counts/3).toFixed(2)));
		$('#25').val(Math.ceil((counts/3).toFixed(2)));			
		
		$('#29').val(Math.ceil(counttestsPead / 50).toFixed(0));
			
		$('#21').val(Math.ceil((counttestsAdults / 50).toFixed(2)));
		$('#23').val(Math.ceil((counttestsAdults / 500).toFixed(2)));
		$('#26').val(Math.ceil(((counttestsAdults / 100)/5).toFixed(2)));
							
		}
		
	function calibursCalc(){
		
		var caliburtestsPead =parseInt($("#caliburtestsPead").val());
		var caliburtestsAdults =parseInt($("#caliburtestsAdults").val());
		var caliburs= parseInt($("#caliburs").val());
		
			if(isNaN(caliburtestsAdults)){
					caliburtestsAdults=0;
				}
			if(isNaN(caliburtestsPead)){
					caliburtestsPead=0;
				}
				
		$('#2').val(Math.ceil((caliburs).toFixed(2)));
		$('#4').val(Math.ceil((caliburs/3).toFixed(2)));
		$('#5').val(Math.ceil((caliburs/3).toFixed(2)));
		$('#8').val(Math.ceil((caliburs).toFixed(2)));
		$('#9').val(Math.ceil((caliburs).toFixed(2)));		
		
		$('#1').val(Math.ceil((caliburtestsAdults / 50).toFixed(2)));
		$('#3').val(Math.ceil((caliburtestsAdults / 2000).toFixed(2)));
		$('#6').val(Math.ceil((caliburtestsAdults / 500).toFixed(2)));
		
		}
	function cyflowCalc(){
			
		var cyflowtestsAdult = parseInt($("#cyflowtestsAdults").val());
		var counttestsAdult = parseInt($("#counttestsAdults").val());
		var caliburtestsAdult = parseInt($("#caliburtestsAdults").val());
		
			if(isNaN(cyflowtestsAdult)){
					cyflowtestsAdult=0;
				}
			if(isNaN(counttestsAdult)){
					counttestsAdult=0;
				}
			if(isNaN(caliburtestsAdult)){
					caliburtestsAdult=0;
				}
			
				
				
		var totAdults=(cyflowtestsAdult)+(counttestsAdult)+(caliburtestsAdult);
		
		var totalSites = $("#totalsites").val();	
			
			if(isNaN(totalSites)){
					totalSites=0;
				}
			
		$('#12').val((Math.ceil(((cyflowtestsAdult / 100) /totalSites)).toFixed(2))*cyflowtestsAdult);
		$('#13').val(Math.ceil((totAdults*6).toFixed(2)));
		
		
		
		
		}
		
	function commonReagentCalc(){
		
		var cyflowtestsPead = parseInt($("#cyflowtestsPead").val());
		var counttestsPead = parseInt($("#counttestsPead").val());
		var caliburtestsPead = parseInt($("#caliburtestsPead").val());
		
		var cyflowtestsAdult = parseInt($("#cyflowtestsAdults").val());
		var counttestsAdult = parseInt($("#counttestsAdults").val());
		var caliburtestsAdult = parseInt($("#caliburtestsAdults").val());
			if(isNaN(cyflowtestsPead)){
					cyflowtestsPead=0;
				}
			if(isNaN(counttestsPead)){
					counttestsPead=0;
				}
			if(isNaN(caliburtestsPead)){
					caliburtestsPead=0;
				}
			if(isNaN(cyflowtestsAdult)){
					cyflowtestsAdult=0;
				}
			if(isNaN(counttestsAdult)){
					counttestsAdult=0;
				}
			if(isNaN(caliburtestsAdult)){
					caliburtestsAdult=0;
				}
		
		var totPaed=((cyflowtestsPead)+(counttestsPead)+(caliburtestsPead));
		var totAdults=((cyflowtestsAdult)+(counttestsAdult)+(caliburtestsAdult));
		var totTests=totPaed+totAdults;
		
		var totalSites = $("#totalsites").val();
		
		$('#30').val(Math.ceil((totPaed/200).toFixed(2)));
		$('#31').val(Math.ceil((totAdults/ 2000).toFixed(2)));	
		$('#27').val(Math.ceil((totAdults/ 100).toFixed(2)));
		$('#28').val(Math.ceil((totAdults/ 48).toFixed(2)));
		$('#33').val(Math.ceil((tottests).toFixed(2)));
		}
	
	function calcTotals(){
		
		var total = parseInt(0+$('#caliburtestsAdults').val())+ 
					parseInt(0+$('#caliburtestsPead').val())+
					parseInt(0+$('#counttestsAdults').val())+
					parseInt(0+$('#counttestsPead').val())+
					parseInt(0+$('#cyflowtestsAdults').val())+
					parseInt(0+$('#cyflowtestsPead').val());
					
		$('#total').val(total);	
		}
	//Calculate Ending Bal
	function endingBal(reagent){
			
		var endBal =parseInt(0+$("input[name='beginningbal["+reagent+"]']").val())+
					parseInt(0+$("input[name='receivedqty["+reagent+"]']").val())-
					parseInt(0+$("input[name='qtyused["+reagent+"]']").val())-
					parseInt(0+$("input[name='losses["+reagent+"]']").val())+
					parseInt(0+$("input[name='adjustmentplus["+reagent+"]']").val())-
					parseInt(0+$("input[name='adjustmentminus["+reagent+"]']").val());
					
			$("input[name='endbal["+reagent+"]']").val(endBal);
			
		}