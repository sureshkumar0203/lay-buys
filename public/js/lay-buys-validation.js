//local
var hostname = $(location).attr('origin')+"/lay-buys";
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
	if (unicode<48||unicode>57){ //if not a number
		return false //disable key press
	}
}


function validatePrice(e) {
	var val = e.value;
	var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
	var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
	
	val = re1.exec(val);
	if (val) {
		e.value = val[0];
	} else {
		e.value = "";
	}
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


/*function passwordPatternValidation(evt) {
    var password = evt.value;
	alert('i m here');
	if(password==''){
		$("#password").focus();
		return false;
	}
    if (password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@%!])[0-9a-zA-Z@%!]{8,}$/)){
		alert('i m');
        return true;
	}else{
		$("#password").focus();
        return false;
	}
	
}*/

	
	
function showLogin(){
	var url = hostname + "/login-page";
	$('#login-loading-image').show();
	$.ajax({
	  type: "GET",
	  cache: false,
	  url: url,
	  data: {'choice':'login'},
	  success: function (data) {
		  $.fancybox(data);
	  },
	  complete: function(){
        $('#login-loading-image').hide();
      }
   });
}

function submitForm(){
	var validate=validatefancyLogin();
	if(validate){
		var frm_data=$('#frm_login').serialize();
		//console.log(frm_data);
		var url = hostname + "/user-login";
		$.ajax({
			type: "POST",
			cache: false,
			url: url, // success.php
			data : frm_data,
			success: function (data) {
				//console.log(data);
				if(data=="blank"){
				  $('#msg_div').html("Please enter your login credentials.");
				}
				if(data=="invalid"){
				  $('#msg_div').html("Sorry,Invalid login credentials.");
				}
				if(data=="notconfirmed"){
				  $('#msg_div').html("Please verify your email address.");
				}
				if(data=="blocked"){
				  $('#msg_div').html("Your account has been blocked by admin.");
				}
				if(data=="success"){
					$.fancybox.close();
					parent.location.reload(true);
				}
			}
		});
 
	}else{
		return false;
	}
}

//Validate Login form
function validatefancyLogin(){
    var formname=document.frm_login;
	if($('#login_email').val()==''){
		$("#login_email").addClass('error_class');
		$('#login_email').focus();
		return false;
	}else {
		$("#login_email").removeClass('error_class');
	}
	if($('#login_psw').val()==''){
		$("#login_psw").addClass('error_class');
		$('#login_psw').focus();
		return false;
	}else {
		$("#login_psw").removeClass('error_class');
	}
	if($('#cr_usr').val() =='0'){
	  $('#cap_error_usr').html('This field is required.');
	  return false;
	}else{
		return true;
	}
}


function captchaCallbackUser(response) {
	$('#cr_usr').val(response);
}



function showForgetControl(){
	var url = hostname + "/login-page";
	$.ajax({
	  type: "GET",
	  cache: false,
	  url: url,
	  data: {'choice':'forgot'},
	  success: function (data) {
		  //console.log(data);
		  $.fancybox(data);
	  }
   });
}

function submitForgetForm(){
	var validate=validateFancyForget();
	if(validate){
		var frm_data=$('#frm_forget').serialize();
		//console.log(frm_data);
		var url = hostname + "/user-forgot-password";
		$.ajax({
			type: "POST",
			cache: false,
			url: url, // success.php
			data : frm_data,
			success: function (data) {
				//console.log(data);
				if(data=="fp_blank"){
				  $('#msg_div').html("Please enter * marked controls value.");
				}
				if(data=="fp_fail"){
				  $('#msg_div').html("Sorry,Invalid email address.");
				}
				if(data=="fp_notconfirmed"){
				  $('#msg_div').html("Please verify your email address.");
				}
				if(data=="fp_blocked"){
				  $('#msg_div').html("Your account has been blocked by admin.");
				}
				if(data=="fp_success"){
					$('#forgot_email').val('');
					$('#msg_div').css("color", "Green").html("Password Sent to your email successfully");
					//$.fancybox.close();
				}
			}
		});
	}
}

function validateFancyForget(){
	var formname=document.forget_cont;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	$('#msg_div').html('');
	
	if($('#forgot_email').val()==''){
		$("#forgot_email").addClass('error_class');
		$('#forgot_email').focus();
		return false;
	}else {
		$("#forgot_email").removeClass('error_class');
	}
	if(!($('#forgot_email').val()).match(emailExp)){
		$("#forgot_email").addClass('error_class');
		$('#forgot_email').focus();
		return false;
	}else{
		$("#forgot_email").removeClass('error_class');
		return true;
	}
}


function showShippingAddress(){
  $('#ship-box-info' ).slideToggle('fast');
}

function validateUserSignup(){
  if($("#password").val()==''){
	  $("#password").focus();
	  return false;
  }
  if (!$("#password").val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@%!])[0-9a-zA-Z@%!]{7,}$/)){
	   $('#password').focus();
	   return false;
  }
  
  if($('#cr').val() =='0'){
	  $('#cap_error').html('This field is required.');
	  return false;
  }
	
  if($("#same_for_billing").prop('checked') == true){
	  if($('#ship_full_name').val()==''){
		  $('#ship_full_name').addClass('error_class');
		  $('#ship_full_name').focus();
		  return false;
	  }
	  if($('#ship_contact_no').val()==''){
		  $('#ship_contact_no').addClass('error_class');
		  $('#ship_contact_no').focus();
		  return false;
	  }
	  if($('#ship_address1').val()==''){
		  $('#ship_address1').addClass('error_class');
		  $('#ship_address1').focus();
		  return false;
	  }
	  if($('#ship_post_code').val()==''){
		  $('#ship_post_code').addClass('error_class');
		  $('#ship_post_code').focus();
		  return false;
	  }
  }else{
	  return true;
  }
  
}

function showTremsConditions(){
	var url = hostname + "/popup-terms-cond";
	$.ajax({
	  type: "GET",
	  cache: false,
	  url: url,
	  data: {'choice':'terms_cond'},
	  success: function (data) {
		  $.fancybox(data);
	  }
   });
}


function validatePlaceOrder(){
	if($('#full_name').val()==''){
		$('#full_name').focus();
		return false;
	}
	if($('#email').val()==''){
		$('#email').focus();
		return false;
	}
	if($('#contact_no').val()==''){
		$('#contact_no').focus();
		return false;
	}
	if($('#address1').val()==''){
		$('#address1').focus();
		return false;
	}
	
	if($('#post_code').val()==''){
		$('#post_code').focus();
		return false;
	}
	
	if($('input[id=same_for_billing]').is(':checked')){
		if($('#ship_full_name').val()==''){
			$('#ship_full_name').focus();
			return false;
		}
		if($('#ship_contact_no').val()==''){
			$('#ship_contact_no').focus();
			return false;
		}
		if($('#ship_address1').val()==''){
			$('#ship_address1').focus();
			return false;
		}
		if($('#ship_post_code').val()==''){
			$('#ship_post_code').focus();
			return false;
		}
	}
	//return true;
}


function validateInstallment(){
	if($('#insta_amt').val()==''){
		$('#insta_amt').addClass('error_class');
		$('#insta_amt').focus();
		return false;
	}else{
		return true;
	}
}

function validateProductDetails(){
	if($('#ips').val()==''){
		$("#ips").addClass('error_class');
		$('#ips').focus();
		return false;
	}
	
	if($('#prd_id').val()==''){
		$("#ips").addClass('error_class');
		$('#ips').focus();
		return false;
	}
	
	if($('#prd_slug').val()==''){
		$("#ips").addClass('error_class');
		$('#ips').focus();
		return false;
	}
	
	if($('#prd_price_week_calc').val()==''){
		$("#ips").addClass('error_class');
		$('#ips').focus();
		return false;
	}
	
	if($('#dp_week_calc').val()==''){
		$("#ips").addClass('error_class');
		$('#ips').focus();
		return false;
	}
}

function showWeeklyPrice(){
	var inst_week = $('#ips').val();
	var prd_price = $('#prd_price_week_calc').val();
	var dp_week_calc = $('#dp_week_calc').val();
	
	if(inst_week){
	  var url = hostname + "/weekly-payment-calc";
	  $.ajax({
		  type: "POST",
		  cache: false,
		  url: url, // success.php
		  data : {'inst_week':inst_week,'prd_price':prd_price,'dp_week_calc':dp_week_calc},
		  success: function (data) {
			  //console.log(data);
			  $('#weekly_paid_app').val(data);
			  $('#wee_paid').html("Installment Amount &pound; "+data);
		  }
	  });
	}else{
		$('#weekly_paid_app').val('');
		$('#wee_paid').html('');
	}

}

function captchaCallback(response) {
	$('#cr').val(response);
}