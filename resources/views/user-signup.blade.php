@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="my-account-area pt-30">
  <div class="container">
    <div class="row">
      <div class="user-title">
        <div class="col-md-2">
          <h2><i class="fa fa-file-text"></i>User Registration</h2>
        </div>
        
        <div class="col-md-10">
          @if (Session::has('success'))
            <span style="color:#ff6a00; padding-left:80px">
              Thank you.You have registered successfully.
            </span>
          @endif
            
          @if (Session::has('email_exist'))
            <span class="error">This email address already exist.</span>
          @endif
          
          @if (Session::has('blank'))
            <span class="error">Please enter all * marked controls values.</span>
          @endif
          
          @if (Session::has('ship_blank'))
            <span class="error">Please enter shipping address.</span>
          @endif
        </div>
      	<div class="clearfix"></div>
      </div>
      
      <div class="account-form">
        {{ Form::open(array('url' => 'user-signup', 'role' => 'form', 'class' =>'', 'name' => 'user_frm', 'id' => 'user_frm','files'=>false, 'autocomplete' => 'off','onsubmit' => 'return validateUserSignup();')) }}
        <div class="col-md-12 col-sm-6">
          <div class="form-goroup col-md-6">
          <label>Name <sup>*</sup></label>
           {!! Form::text('full_name',old('full_name'), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>Contact Number<sup>*</sup></label>
          {!! Form::text('contact_no',old('contact_no'), array('id' => 'contact_no','maxlength' => 14,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>E-mail address<sup>*</sup></label>
          {!! Form::email('email',old('email'), array('id' => 'email','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>Password<sup>*</sup></label>
          {!! Form::password('password',array('id' => 'password','minlength' => 8,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters','onKeyUp' => '')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>Address1<sup>*</sup></label>
           {!! Form::text('address1',old('address1'), array('id' => 'address1','required','class'=>'form-control','placeholder'=>'Address Line1','autocomplete' => 'off')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>Address2</label>
          {!! Form::text('address2',old('address2'), array('id' => 'address2','class'=>'form-control','placeholder'=>'Address Line2','autocomplete' => 'off')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>Town<sup></sup></label>
           {!! Form::text('town',old('town'), array('id' => 'town','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>City<sup></sup></label>
           {!! Form::text('city',old('city'), array('id' => 'city','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
          </div>
          
          <div class="form-goroup col-md-6">
          <label>Postcode<sup>*</sup></label>
           {!! Form::text('post_code',old('post_code'), array('id' => 'post_code','maxlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
          </div>
          
          
          
          <div class="clearfix"></div>
          
          <div class="col-md-12">
            <h5 style="background: #cccccc2b; padding: 10px; color:#000"><strong>Ship to a different address?</strong>
            {!! Form::checkbox('same_for_billing', '1', false, array('id' => 'same_for_billing', 'class' => '', 'onclick'=>'showShippingAddress()' )) !!} 
            </h5>
                 
            <div class="row"  id="ship-box-info">
              <div class="form-goroup col-md-6">
                <label>Name <sup>*</sup></label>
                {!! Form::text('ship_full_name',old('ship_full_name'), array('id' => 'ship_full_name','maxlength' => '','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => '')) !!}
              </div>
            
              <div class="form-goroup col-md-6">
                <label>Contact Number<sup>*</sup></label>
                {!! Form::text('ship_contact_no',old('ship_contact_no'), array('id' => 'ship_contact_no','maxlength' => 14,'class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
              </div>
              
              <div class="form-goroup col-md-6">
                <label>Address1<sup>*</sup></label>
                {!! Form::text('ship_address1',old('ship_address1'), array('id' => 'ship_address1','class'=>'form-control','placeholder'=>'Address Line1','autocomplete' => 'off')) !!}
              </div>
              
              <div class="form-goroup col-md-6">
                <label>Address2</label>
                {!! Form::text('ship_address2',old('ship_address2'), array('id' => 'ship_address2','class'=>'form-control','placeholder'=>'Address Line2','autocomplete' => 'off')) !!}
              </div>
              
              <div class="form-goroup col-md-6">
                <label>Town<sup></sup></label>
                {!! Form::text('ship_town',old('ship_town'), array('id' => 'ship_town','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
              </div>
              
              <div class="form-goroup col-md-6">
                <label>City <sup></sup></label>
                {!! Form::text('ship_city',old('ship_city'), array('id' => 'ship_city','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
              </div>
              
              <div class="form-goroup col-md-6">
                <label>Postcode <sup>*</sup></label>
                {!! Form::text('ship_post_code',old('ship_post_code'), array('id' => 'ship_post_code','maxlength' => 7,'class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
              </div>
            </div>
          </div>
              
		  <script src='https://www.google.com/recaptcha/api.js'></script>
          <div class="col-md-12">
         
            <div  class="col-xs-12 col-sm-6" style="padding-top:15px;  padding-left:0px; margin-left:0px;">
            <input type="hidden" name="cr" id="cr" value="0"/>
            <div class="g-recaptcha" data-sitekey="6LeP9mgUAAAAADH__Q2TCUh-GxIoaMgyCKfiXxfT" data-callback="captchaCallback"></div>
            <div class="help-block" id="cap_error" style="color:#a94442;"></div>
            </div>
          </div>
          
          <div class="col-md-12" style="padding-bottom:15px;"> 
            <input type="checkbox" checked disabled style="float:left; height:inherit; margin-right:10px; "><a class="fancybox" href="javascript:void('0');"  onclick="showTremsConditions();" title="Terms and conditions"><span style="font-weight:600">Click here for Terms & Conditions</span></a>
          </div>
          
          <div  class="col-md-12" > 
          	{{ Form::submit('Submit', array('id'=>'btn_submit','class' => 'btn-login')) }}</div>
          </div>
        
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div> 


<style>
.list-group{
    z-index:10;display:none; 
	position:absolute; 
    color:red;
}
.msg
{
	position:absolute; 
    color:red;
}

</style>
@stop 

