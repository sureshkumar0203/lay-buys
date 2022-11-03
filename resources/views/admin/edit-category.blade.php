@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Edit Category</li>
      </ul>
    </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <h4><i class="fa fa-pencil-square-o"></i> Edit Category</h4>
          </div>
          <div class="widget-content">
            <div class="col-xs-12 col-sm-12">
              <div style="height:20px;"> @if (Session::has('success')) <span style="color:#090;">Records has been saved successfully.</span> @endif
                
                @if (Session::has('blank')) <span style="color:#F00;">Please enter all * marked controls values.</span> @endif
                
                @if (Session::has('exist')) <span style="color:#F00;">This category name already exist.</span> @endif
                
                @if (Session::has('invformat')) <span style="color:#F00;">Please upload correct file format.</span> @endif </div>
              {{ Form::open(array('url' => 'update-category', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_category', 'id' => 'frm_category','files'=>true, 'autocomplete' => 'off')) }}  
              
              
              {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
              <div class="form-group col-md-8">
                <label>Category Name*:</label>
                {!! Form::text('category_name',$data[0]->category_name,array('id' => 'category_name','required','class'=>'form-control','placeholder'=>'')) !!} </div>
              <div class="form-group col-md-8">
                <label>Category  Icon*:</label>
                {!! Form::file('category_icon', array('id' => 'category_icon','', 'class'=>'','placeholder'=>'')) !!} <span style="color:#F00;"> Note : For better quality photo <strong>width = </strong> 36 & <strong>Height =</strong> 30<br>
                Upload only <strong>png,jpg,jpeg</strong> extension banner. </span> </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-8"> @if($data[0]->category_icon) <img src="{{ asset('public/category-icon/'.$data[0]->category_icon) }}" alt="" style="width:5%;"/> @endif </div>
              <div class="form-group col-md-8">
                <label>Category  Photo:</label>
                {!! Form::file('category_photo', array('id' => 'category_photo','', 'class'=>'','placeholder'=>'')) !!} <span style="color:#F00;"> Note : For better quality photo <strong>width = </strong> 370 & <strong>Height =</strong> 240<br>
                Upload only <strong>png,jpg,jpeg</strong> extension banner. </span> </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-8"> @if($data[0]->category_photo) <img src="{{ asset('public/category-photo/thumb/'.$data[0]->category_photo) }}" alt="" style="width:10%;"/> @endif </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12"> {{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                
                &nbsp;&nbsp; <a href="{{ URL::to('administrator/manage-category') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a> </div>
              {{ Form::close() }} </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop