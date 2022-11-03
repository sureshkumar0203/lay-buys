@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row thank-you">
      <div class="col-md-12">
        <div class="page-title"><h2><i class="fa fa-check-square thank-icon"></i> Thank You</h2></div>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-30">
          <span style="color:#060; font-size:18px; line-height:35px">
          Your registration completed successfully.<br />
          Please verify your email address to activate your account.<br /><br />
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@stop 

