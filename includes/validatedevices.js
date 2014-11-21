/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#customForm");
	var deviceNum = $("#deviceNum");
	var deviceNumInfo = $("#deviceNumInfo");
	var location = $("#location");
	var location1 = $("#location1");
	var location1Info = $("#location1Info");
	var locationInfo = $("#locationInfo");
	var criteria=$("#criteria");
	var criteriaInfo=$("#criteriaInfo");
	var duration=$("#duration");
	var durationInfo=$("#durationInfo");
			
			
	//On blur
	
	deviceNum.blur(validatedeviceNum);
	location1.blur(validatelocation1);
	location.blur(validatelocation);
	criteria.blur(validatecriteria);
	duration.blur(validateduration);
	//On key press
	
	deviceNum.keyup(validatedeviceNum);
	location1.keyup(validatelocation1);
	location.keyup(validatelocation);
	criteria.keyup(validatecriteria);
	duration.keyup(validateduration);
	
	//On Submitting
	form.submit(function(){
		if(validatedeviceNum()  & validatelocation()  )
			return true
		else
			return false;
	});
	
	
	//ensure lot no is not null
	function validatelocation(){
		//if it's NOT valid
		if(location.val().length < 1){
			location.addClass("error");
			locationInfo.text("Select the Device!!");
			locationInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			location.removeClass("error");
			locationInfo.text("");
			locationInfo.removeClass("error");
			return true;
		}
	}
	
	//ensure kit expiry not null
	function validatedeviceNum(){
		//if it's NOT valid
		if(deviceNum.val().length < 1){
			deviceNum.addClass("error");
			deviceNumInfo.text("Enter Device Number!");
			deviceNumInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			deviceNum.removeClass("error");
			deviceNumInfo.text("");
			deviceNumInfo.removeClass("error");
			return true;
		}
	}
		
	function validatelocation1(){
		if(location1.val().length < 1){
			location1.addClass("error");
			location1Info.text("Enter specific location!");
			location1Info.addClass("error");
			return false;
		}
		//if it's valid
		else{
			location1.removeClass("error");
			location1Info.text("");
			location1Info.removeClass("error");
			return true;
		}
	}
	
	//ensure criteria not null
	function validatecriteria(){
		
		//if it's NOT valid
		if(criteria.val()==0){
			criteria.addClass("error");
			criteriaInfo.text("Choose criteria to use!");
			criteriaInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			criteria.removeClass("error");
			criteriaInfo.text("");
			criteriaInfo.removeClass("error");
			return true;
		}
	}

//ensure Duration not null
	function validateduration(){
		
		//if it's NOT valid
		if(duration.val()==0){
			duration.addClass("error");
			durationInfo.text("Choose duration to report!");
			durationInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			duration.removeClass("error");
			durationInfo.text("");
			durationInfo.removeClass("error");
			return true;
		}
	}
		
	
});