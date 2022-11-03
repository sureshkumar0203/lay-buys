@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title"><h2>Change Password</h2></div>
      </div>
      
      <div class="col-md-12" style="height:30px; margin-top:15px;">
        @if (Session::has('blank'))
            <div style="color:#F00;">Please enter all * marked controls values.</div>
        @endif
  
        @if (Session::has('conf_not_match'))
            <div style="color:#F00;">New password & confirm password missmatch.</div>
        @endif
  
        @if (Session::has('not_match'))
            <div style="color:#F00;">Old password mismatch.</div>
        @endif
  
        @if (Session::has('success'))
            <div style="color:#069e06;">Password changed successfully.</div>
        @endif
      </div>
   
      <div class="col-md-12 col-sm-12">
        {{ Form::open(array('url' => 'change-password', 'method'=>'post', 'role' => 'form', 'class' =>'', 'name' => 'frm_cp', 'id' => 'frm_cp','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
        <div class="container">
          <div class="row">
            <div class="col-md-12"> 
                <ul class="row passw pass-bdr">
                  <li class="col-md-3">
                    <label class="lbl-bl"> Old Password *
                      {!! Form::password('old_psw', array('id' => 'old_psw','minlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters')) !!}
                    </label>
                  </li>
                  
                  <li class="col-md-3">
                    <label class="lbl-bl">New Password *
                       {!! Form::password('new_psw',array('id' => 'new_psw','minlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters')) !!}
                    </label>
                  </li>
  
                  <li class="col-md-3">
                    <label class="lbl-bl">Confirm Password *
                      {!! Form::password('conf_psw',array('id' => 'conf_psw','minlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters',)) !!}
                    </label>
                  </li>
  
                  <li class="col-md-3 text-left">
                  <label style="padding-top:25px;">          
                    {{ Form::submit('Save', array('id'=>'btn_submit','class' => 'cbtn-round, btn btn2 fa fa-credit-card')) }}
                    </label>
                  </li>
                </ul>
            </div>
          </div>           
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@stop