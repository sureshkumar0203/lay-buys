<?php 
if($_REQUEST['choice']=='login'){?>
<div class="login-sec" style="padding:10px;text-align:left; width:320px !important;">
	<h3 style="margin-bottom:5px;">Login to your Account</h3>
    {{ Form::open(array('url' => '','method' => 'post','role' => 'form', 'class' =>'', 'name' => 'frm_login', 'id' => 'frm_login','files'=>false, 'autocomplete' => 'off','onsubmit' => 'return validatefancyLogin()')) }}
    <div id="msg_div" style="color:#F00; height:25px; font-size:13px;"></div>
    <div class="regis_grup">
     <label>Email Address</label>
        {!! Form::email('login_email',old('login_email'), array('id' => 'login_email','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
        
        <label>Password</label>
        {!! Form::password('login_psw', array('id' => 'login_psw','minlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters')) !!}
        
        
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div class="form-group" style="margin-bottom:0px;">
       
          <div  class="" style="padding-top:15px;  padding-left:0px; margin-left:0px;">
          <input type="hidden" name="cr_usr" id="cr_usr" value="0"/>
          <div class="g-recaptcha" data-sitekey="6LeP9mgUAAAAADH__Q2TCUh-GxIoaMgyCKfiXxfT" data-callback="captchaCallbackUser"></div>
          <div class="help-block" id="cap_error_usr" style="color:#a94442;"></div>
          </div>
        </div>
        
        
        <p style="padding-top:10px">I lost my password. Please <a href="javascript:void(0);" onclick="showForgetControl();" style="color:#ff6a00">email it to me</a></p>
        <input type="button" value="Sign in" class="btn-login" onclick="submitForm();" />
    </div>
    {{ Form::close() }}
</div>

<?php  } else if($_REQUEST['choice']=='forgot'){ ?>
<div class="login-sec" style="padding:30px;text-align:left; width:320px !important;">
    <h5 style="margin-bottom:5px;">RECOVER YOUR PASSWORD</h5>
    <div id="msg_div" style="color:#F00;height:25px; font-size:13px;"></div>
     {{ Form::open(array('url' => '','method' => 'post','role' => 'form', 'class' =>'', 'name' => 'frm_forget', 'id' => 'frm_forget','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
    
      <div class="regis_grup">
       <label>Enter your Email*</label>
      {!! Form::email('forgot_email',old('forgot_email'), array('id' => 'forgot_email','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
       
       
      <p style="padding-top:10px">Click here to <a href="javascript:void(0);" onclick="showLogin();" style="color:#ff6a00">Login</a></p>
      <input type="button" value="Submit" class="btn-login"  onclick="submitForgetForm();" />
      </div>
       
   {{ Form::close() }}
</div>
<?php } ?>