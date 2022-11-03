@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Add Category</li>
      </ul>
    </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <h4><i class="fa fa-plus-square"></i> Add Category</h4>
          </div>
          <div class="widget-content">
            <div class="col-xs-12 col-sm-12">
              <div style="height:20px;"> @if (Session::has('success')) <span style="color:#090;">Records has been saved successfully.</span> @endif
                
                @if (Session::has('blank')) <span style="color:#F00;">Please enter all * marked controls values.</span> @endif
                
                @if (Session::has('exist')) <span style="color:#F00;">This category name already exist.</span> @endif
                
                @if (Session::has('invformat')) <span style="color:#F00;">Please upload correct file format.</span> @endif </div>
              {{ Form::open(array('url' => 'add-category', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_category', 'id' => 'frm_category','files'=>true, 'autocomplete' => 'off')) }}
              <div class="form-group col-md-8">
                <label>Category Name*:</label>
                {!! Form::text('category_name','',array('id' => 'category_name','required','class'=>'form-control','placeholder'=>'')) !!} </div>
              <div class="form-group col-md-8">
                <label>Category  Icon*:</label>
                {!! Form::file('category_icon', array('id' => 'category_icon','required', 'class'=>'','placeholder'=>'')) !!} <span style="color:#F00;"> Note : For better quality photo <strong>width = </strong> 36 & <strong>Height =</strong> 30<br>
                Upload only <strong>png,jpg,jpeg</strong> extension banner. </span> </div>
              <div class="form-group col-md-8">
                <label>Category  Photo*:</label>
                {!! Form::file('category_photo', array('id' => 'category_photo','required', 'class'=>'','placeholder'=>'')) !!} <span style="color:#F00;"> Note : For better quality photo <strong>width = </strong> 370 & <strong>Height =</strong> 240<br>
                Upload only <strong>png,jpg,jpeg</strong> extension banner. </span> </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12"> {{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                
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