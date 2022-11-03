@extends('includes.master')

@section('title') {{ $data->meta_title }} @stop
@section('keywords'){{ $data->meta_keyword }} @stop
@section('description'){{ $data->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title"><h2>{!! $data->page_title !!}</h2></div>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-30">{!! $data->content !!}</div>
      </div>
    </div>
  </div>
</div>
@stop 

