@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row">
    <div class="col-md-12" style="height:50px;">
      <div style="display:inline-block;">
        <div ><h3 class="page-title">Profile Settings</h3></div>
      </div>
      
      <div  style="display:inline-block; padding-left:30px;">
        @if (Session::has('blank'))
            <div style="color:#F00; ">Please enter all * marked controls values.</div>
        @endif
        
        @if (Session::has('ship_blank'))
            <div style="color:#F00;">Please enter shipping address.</div>
        @endif
        
        
        @if (Session::has('success'))
            <div style="color:#069e06;">Record updated successfully.</div>
        @endif
      </div>
      
      </div>
      
      <div class="col-md-12 col-sm-12 box_panel">
        {{ Form::open(array('url' => 'profile-settings', 'method'=>'post', 'role' => 'form', 'class' =>'', 'name' => 'frm_ps', 'id' => 'frm_ps','files'=>false, 'autocomplete' => 'off','onsubmit' => 'return validateUserSignup()')) }}
      <div class="container profile-set">
        <div class="row">
          <div class="col-md-12 checkbox-form"> 
            <ul class="row">
              <li class="col-sm-4 checkout-form-list">
                <label> Name *
                  {!! Form::text('full_name',$data[0]->full_name, array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>Contact Number *
                   {!! Form::text('contact_no',$data[0]->contact_no, array('id' => 'contact_no','maxlength' => 14,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
                </label>
              </li>
            
              <li class="col-sm-4 checkout-form-list">
                <label>Address1 *
                   {!! Form::text('address1',$data[0]->address1, array('id' => 'address1','required','class'=>'form-control','placeholder'=>'Address Line1','autocomplete' => 'off')) !!}
                   </label>
              </li>
    
              <li class="col-sm-4 checkout-form-list">
                   <label>Address2 
                   {!! Form::text('address2',$data[0]->address2, array('id' => 'address2','','class'=>'form-control','placeholder'=>'Address Line2','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>Town  
                  {!! Form::text('town',$data[0]->town, array('id' => 'town','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>City 
                  {!! Form::text('city',$data[0]->city, array('id' => 'city','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>Postcode *
                  {!! Form::text('post_code',$data[0]->post_code, array('id' => 'post_code','maxlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
             
            </ul>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-5">
              <label>Set your PayPal email addrss :</label>
               {!! Form::email('paypal_email_user',$data[0]->paypal_email_user, array('id' => 'paypal_email_user','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
              
              
              <span style="color:#F00;">
              	Note : This is the paypal account we will use for payments & refunds.
              </span>
          </div> 
        </div>   
            
        <div class="row checkbox-form">
          <div class="col-md-12 ">
            <h5 style="background: #cccccc1a; padding: 10px; margin-top:20px; margin-bottom:20px; font-size:20px;">Ship to a different address?
            {!! Form::checkbox('same_for_billing', '1',($data[0]->same_for_billing==1)?true:false, array('id' => 'same_for_billing', 'class' => '', 'onclick'=>'showShippingAddress()' )) !!} 
            </h5>
              
            <ul class="row" id="ship-box-info" @if($data[0]->same_for_billing==1) style="display:block; @else style="display:none; @endif">
              <li class="col-sm-4 checkout-form-list">
                <label> Name *
                  {!! Form::text('ship_full_name',$data[0]->ship_full_name, array('id' => 'ship_full_name','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
      
              <li class="col-sm-4 checkout-form-list">
                <label>Contact Number *
                   {!! Form::text('ship_contact_no',$data[0]->ship_contact_no, array('id' => 'ship_contact_no','maxlength' => 14,'','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
                </label>
              </li>
      
              <li class="col-sm-4 checkout-form-list">
                <label>Address1 *
                   {!! Form::text('ship_address1',$data[0]->ship_address1, array('id' => 'ship_address1','','class'=>'form-control','placeholder'=>'Address Line1','autocomplete' => 'off')) !!}
                   </label>
              </li>
      
              <li class="col-sm-4 checkout-form-list">
                   <label>Address2 
                   {!! Form::text('ship_address2',$data[0]->ship_address2, array('id' => 'ship_address2','','class'=>'form-control','placeholder'=>'Address Line2','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>Town 
                  {!! Form::text('ship_town',$data[0]->ship_town, array('id' => 'ship_town','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>City 
                  {!! Form::text('ship_city',$data[0]->ship_city, array('id' => 'ship_city','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              <li class="col-sm-4 checkout-form-list">
                <label>Postcode  *
                  {!! Form::text('ship_post_code',$data[0]->ship_post_code, array('id' => 'ship_post_code','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                </label>
              </li>
              
              
            </ul>
          </div> 
      	</div>
        
        <div class="row">
          <div class="col-md-12">
        	{{ Form::submit('Update', array('id'=>'btn_submit','class' => 'cbtn-round, btn btn2 fa fa-credit-card')) }}
          </div>
        </div>
        
      </div>
      {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@stop