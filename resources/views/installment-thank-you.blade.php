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
      
      <div class="col-md-12 col-sm-12 mt-35">
        <div class="entry-content">
           <h2 style="color:#060;">Thank You for your Installment.</h2>
           <a href="{{url('/')}}/my-account"><strong>Click here</strong> </a><strong> to view your transaction details in your account</strong>.<br /><br />
        </div>
      </div>
    </div>
  </div>
</div>
@stop 

