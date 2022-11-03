@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Add Subcategory</li>
      </ul>
    </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <h4><i class="fa fa-plus-square"></i> Add Subcategory</h4>
          </div>
          <div class="widget-content">
            <div class="col-xs-12 col-sm-12">
              <div style="height:20px;"> 
              @if (Session::has('success')) <span style="color:#090;">Records has been saved successfully.</span> @endif
                
                @if (Session::has('blank')) <span style="color:#F00;">Please enter all * marked controls values.</span> @endif
                
                @if (Session::has('exist')) <span style="color:#F00;">This Subcategory name already exist.</span> @endif
                
                @if (Session::has('invformat')) <span style="color:#F00;">Please upload correct file format.</span> @endif </div>
              {{ Form::open(array('url' => 'add-subcategory', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_category', 'id' => 'frm_category','files'=>true, 'autocomplete' => 'off')) }}
              <div class="form-group col-md-8">
                <label>Category Name*:</label>
                {{ Form::select('cat_id', $data, null, ['id' => 'cat_id','class'=>'form-control','required']) }}
              </div>
              <div class="form-group col-md-8">
                <label>Subcategory Name*:</label>
                {!! Form::text('sub_cat_name','',array('id' => 'sub_cat_name','required','class'=>'form-control','placeholder'=>'')) !!} 
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12"> {{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                
                &nbsp;&nbsp; <a href="{{ URL::to('administrator/manage-subcategory') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a> </div>
              {{ Form::close() }} </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop