//local
var hostname = $(location).attr('origin')+"/yoruba";
//Server
//var hostname = $(location).attr('origin');


//This function is for phone number validation
//onKeyUp="validatephone(this);" 
function validatephone(ph) {
	var maintainplus = '';
 	var numval = ph.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curphonevar = numval.replace(/[\\A-Za-z!"£$%^&*+_={};:'@#~,.¦\/<>?|`¬\]\[]/g,'');
 	ph.value = maintainplus + curphonevar;
 	var maintainplus = '';
 	ph.focus;
}

//onKeyPress="return numbersonly(event);"
function numbersonly(e){
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
	if (unicode<48||unicode>57) //if not a number
		return false //disable key press
	}
}


function validatePrice(e) {
	var maintainplus = '';
 	var numval = e.value
 	curphonevar = numval.replace(/[\\A-Za-z!"£$%^&*+_={};:'@#~,¦\/<>?|`¬\]\[]/g,'');
 	e.value = maintainplus + curphonevar;
 	var maintainplus = '';
 	e.focus;
}
//This function is for username  validation.space special character not allowed
//onKeyUp="checkUserName(this);"
function checkUserName(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}

//This function is for password  validation.space some special character are not allowed
//onKeyUp="checkPassword(this);"
function checkPassword(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9!@#$]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}


function chk_xss(xss){
	var maintainplus = '';
	var numval = xss.value
	curphonevar = numval.replace(/[\\!"£$%^&*+_={};:'#~,.¦\/<>?|`¬\]\[]/g,'');
	xss.value = maintainplus + curphonevar;
	var maintainplus = '';
	xss.focus;
}


function contactValidation(){
 if($('#cr').val() =='0'){
	  $('#cap_error').html('This field is required.');
	  return false;
  }
}

function contactCaptchaCallback(response) {
  $('#cr').val(response);
}

function validateNewsletter(){
	//alert("validation");
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if($('#nl_email').val()==''){
		$('#nl_email').css('border-color', 'red');
		$('#nl_email').focus();
		return false;
	}
	if(!($("#nl_email").val()).match(emailExp)){
		$('#nl_email').css('border-color', 'red');
		$("#nl_email").focus();
		return false;
	}
	return true;
}              


function newsLetterSubmitForm(){
	var x=validateNewsletter();
	if(x){
		//alert("validate");
		var form_data=$('#frm_nl').serialize();
		$.ajax({
		  url: "save-nl-data",
		  type: "post",
		  data : form_data,
		  success: function(data){
			//alert(data);
			if(data=="nl_blank"){
			  $('#ll_msg_div').css('color', '#F00').html("Please enter email address.");
			}
			if(data=="nl_email"){
			  $('#ll_msg_div').css('color', '#F00').html("You have already subscribed.");
			}
			if(data=="nl_success"){
			  $('#ll_msg_div').css('color', '#FFF').html("You have subscribed successfully to our newsletter.");
			}
		  }
		});   
	}else{
		return false;
	}
}

function validateUser(){
  if($('#user_email').val()==''){
	$('#user_email').focus();
	return false;
  }
  if($('#user_password').val()==''){
	$('#user_password').focus();
	return false;
  }
  return true;
}

function submitLoginForm(){
  var x=validateUser();
  if(x){
	  var form_data=$('#frm_user_login').serialize();
	  $.ajax({
		  url: "user-login-process",
		  type: "post",
		  data : form_data,
		  success: function(data){
			  //alert(data);
			  if(data=="ep_blank"){
				$('#msgl_div').css('color', '#F00').html("Please enter email & password.");
			  }
			  if(data=="ep_invalid"){
				$('#msgl_div').css('color', '#F00').html("Invalid login credentials.");
			  }
			  if(data=="login_success"){
				window.location.href="my-account";
			  }
		}
	  });   
  }else{
	return false;
  }
}				  



function validateForgotPswMail(){
  if($('#user_email_fp').val()==''){
	$('#user_email_fp').focus();
	return false;
  }
  return true;
}


function submitForgotPswForm(){
  var x=validateForgotPswMail();
  if(x){
	  var form_data=$('#frm_user_fp').serialize();
	  $.ajax({
		  url: "user-forgot-password",
		  type: "post",
		  data : form_data,
		  success: function(data){
			  if(data=="fp_blank"){
				$('#fp_blank').css('color', '#F00').html("Please enter email address.");
			  }
			  if(data=="fp_fail"){
				$('#fp_fail').css('color', '#F00').html("Please enter correct email address.");
			  }
			  if(data=="fp_success"){
				$('#fp_success').css('color', '#006600').html("Password has been send to your email address.");
			  }
			  if(data=="fp_mail_fail"){
				$('#fp_mfail').css('color', '#006600').html("Message sending failed.");
			  }
			  
		}
	  });   
  }else{
	return false;
  }
}	