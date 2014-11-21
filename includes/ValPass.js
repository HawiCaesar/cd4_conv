/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#customForm");
	var deviceNum = $("#oldPass");
	var deviceNumInfo = $("#deviceNumInfo");
	var location = $("#pass");
	var locationInfo = $("#locationInfo");
	var locate = $("#nwpass");
	var locateInfo = $("#locateInfo");
			
	//On blur
	
	deviceNum.blur(validatedeviceNum);
	location.blur(validatelocation);
	locate.blur(validatelocate);
	//On key press
	
	deviceNum.keyup(validatedeviceNum);
	location.keyup(validatelocation);
	locate.keyup(validatelocate);
	
	
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
			locationInfo.text("Enter New Password!");
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
	//ensure pass1=pass2
	function validatelocate(){
		//if it's NOT valid
		if(location.val()!=locate.val()){
			locate.addClass("error");
			locateInfo.text("Passwords dont Match!");
			locateInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			locate.removeClass("error");
			locateInfo.text("");
			locateInfo.removeClass("error");
			return true;
		}
	}
	//ensure kit expiry not null
	function validatedeviceNum(){
		//if it's NOT valid
		if(deviceNum.val().length < 1){
			deviceNum.addClass("error");
			deviceNumInfo.text("Enter Password!");
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
	
	
	
});