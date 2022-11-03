@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row thank-you">
      <div class="col-md-12">
        <div class="page-title"><h2><i class="fa fa-times close-icon"></i><br />
 Transaction Failed</h2></div>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <div class="entry-content mt-20">
         <h2 style="color:#F00;">Sorry, Unable to process your payment.Please try again.</h2>
     </div>
      </div>
    </div>
  </div>
</div>
@stop 

