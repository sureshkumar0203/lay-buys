@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
  <div class="logo">
     <!-- <br><img src="{{ asset('public/images/logo.jpg') }}" alt="logo" /><br>-->
      <strong>Admin</strong>Panel
  </div>
    <div class="box">
      <div class="content">
        <h3 class="form-title" style="margin:0;">Sign in to your account</h3>
        
        <span style="color:#F00;display:block;height:30px; padding-top:8px; font-size:11px;">
           @if(Session::has('invalid')) Invalid Username / Password. @endif	
        </span>
       {{ Form::open(array('url' => 'admin-login', 'role' => 'form', 'class' =>'form-vertical login-form', 'autocomplete' => 'off','onsubmit' => 'return validateAdminLogin();')) }}  
       
       <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                {!! Form::email('email', null, array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'Username*')) !!}
            </div>
        </div>               
        <div class="form-group" style="margin-bottom:0px;">

            <div class="input-icon">
              <i class="fa fa-key"></i>
               {!! Form::password('password',  array('id' => 'password','required', 'class'=>'form-control', 'placeholder' => 'Password*','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 10 or more characters')) !!}
            </div>

        </div>
       
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
        <div class="form-group" style="margin-bottom:0px;">       
          <div  class="" style="padding-top:15px;  padding-left:0px; margin-left:0px;">
          <input type="hidden" name="cr_adm" id="cr_adm" value="0"/>
          <div class="g-recaptcha" data-sitekey="6LeP9mgUAAAAADH__Q2TCUh-GxIoaMgyCKfiXxfT" data-callback="captchaCallbackAdmin"></div>
          <div class="help-block" id="cap_error_adm" style="color:#a94442;height:20px;"></div>
          </div>
        </div>
          
                    
        <div class="form-actions">
            <a href="{{ URL::to('administrator/forgot-psw-admin') }}">Forgot Password?</a>
            {{ Form::submit('Sign In', array('class' => 'btn submit btn btn-primary pull-right')) }}
        </div>
       {{ Form::close() }}
  
      </div>
    </div>
@stop