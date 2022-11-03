@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content') 
<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Edit Product</li>
      </ul>
    </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <h4><i class="fa fa-plus-square"></i> Edit Product</h4>
          </div>
          <div class="widget-content">
            <div class="col-xs-12 col-sm-12">
              <div style="height:20px;"> @if (Session::has('success')) <span style="color:#090;">Records has been saved successfully.</span> @endif
                
                @if (Session::has('blank')) <span style="color:#F00;">Please enter all * marked controls values.</span> @endif
                
                @if (Session::has('exist')) <span style="color:#F00;">This product name already exist.</span> @endif
                
                @if (Session::has('invformat')) <span style="color:#F00;">Please upload correct file format.</span> @endif </div>
              {{ Form::open(array('url' => 'edit-product', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_product', 'id' => 'frm_product','files'=>true, 'autocomplete' => 'off')) }}
              {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
              {!! Form::hidden('pip_count', 5-count($installment_periods), array('id' => 'pip_count')) !!}
              {!! Form::hidden('prd_photo_count', 5-count($prd_photo), array('id' => 'prd_photo_count')) !!}
              <div class="form-group col-md-8">
                <label>Select Category*:</label>
                {!! Form::select('prd_cat_id',$cat_det,$data->prd_cat_id,array('id' => 'prd_cat_id','required','class'=>'form-control','default' => '','onchange' => 'select_category(this.value)')) !!} 
              </div>
              <div class="col-md-2">
                  <div id="loading"><img src="{{ asset('public/admin/assets/img/loading.gif') }}" /></div>
              </div>
              <div class="form-group col-md-8" id="__subcategoty" style="display:block">
                <label>Select Subcategory*:</label>
              {{ Form::select('prd_sub_cat_id', $subcate_det, $data->prd_sub_cat_id,array('id' => 'prd_sub_cat_id','class'=>'form-control','required')) }}  
              </div>
              <div class="form-group col-md-8">
                <label>Product Name*:</label>
                {!! Form::text('product_name',$data->product_name,array('id' => 'product_name','required','class'=>'form-control','placeholder'=>'Product Name')) !!} </div>
              <div class="form-group col-md-8">
                <label>Product Model*:</label>
                {!! Form::text('product_model',$data->product_model,array('id' => 'product_model','required','class'=>'form-control','placeholder'=>'Product Model')) !!} </div>
              <div class="form-group col-md-8">
                <label>Product Price*:</label>
                {!! Form::text('product_price',$data->product_price,array('id' => 'product_price','required','class'=>'form-control','placeholder'=>'Product Price', 'onKeyUp' => 'validatePrice(this)', 'maxlength'=>'10')) !!} </div>
              <div class="form-group col-md-8">
                <label>Product Down Payment (%)*:</label>
                {!! Form::text('product_dp_per',$data->product_dp_per,array('id' => 'product_dp_per','required','class'=>'form-control','placeholder'=>'Product Down Payment', 'onKeyUp' => 'validatePrice(this)', 'maxlength'=>'10')) !!} </div>
              
              @if(count($prd_photo) < 5)
              <div class="form-group col-md-8 fileelement" id="file_1">
                <label>Multiple Product  Photo*:</label><div class="clearfix"></div>
                <div class="col-md-5" style="padding:0px;">
                {!! Form::file('product_photo[]', array('class'=>'btn','placeholder'=>'')) !!} 
                </div>
                <div class="col-md-1 text-right"><a href="javascript:void(0);" class="addfile"><i class="fa fa-plus"></i></a></div>
                </div>
                <div class="clearfix"></div>
                <span style="color:#F00;"> Note : For better quality photo <strong>width = </strong> 600 & <strong>Height =</strong> 600<br>
                Upload only <strong>png,jpg,jpeg</strong> extension banner. </span>
             @endif  
             
             
              <div class="clearfix"></div>
              <ul style="padding:10px 0px">
              @foreach ($prd_photo as $res_photo)
              	<li class="sp-title prdImg{{ $res_photo->prd_ph_id }}"><i class="fa fa-times sp-icon" onclick="removePrdimg({{ $res_photo->prd_ph_id }})"  title="Remove"></i><img src="{{ asset('public/product-photo') }}/{{ $res_photo->prd_photo }}" width="50" /></li>
              @endforeach
              </ul>
              
              
              <div class="form-group col-md-12">
                <label>Product Specification & Description*:</label>
                {!! Form::textarea('product_details',$data->product_details, array('id' => 'product_details','required', 'class'=>'ckeditor','placeholder'=>'Product Description')) !!} </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <label>Meta Title*:</label>
                {!! Form::text('prd_meta_title',$data->prd_meta_title,array('id' => 'prd_meta_title','required','class'=>'form-control','placeholder'=>'Meta Title')) !!} </div>
              <div class="form-group col-md-12">
                <label>Meta Keywords:</label>
                {!! Form::textarea('prd_meta_keywords',$data->prd_meta_keywords,array('id' => 'prd_meta_keywords','', 'class'=>'form-control','size' => '30x5','placeholder'=>'Meta Keywords')) !!} </div>
              <div class="form-group col-md-12">
                <label>Meta Description:</label>
                {!! Form::textarea('prd_meta_descriptions',$data->prd_meta_descriptions,array('id' => 'prd_meta_descriptions','', 'class'=>'form-control','size' => '30x5','placeholder'=>'Meta Description')) !!} </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-6 element" id="div_1">
              <label>Installment Periods*:</label><div class="clearfix"></div>
              <ul style="padding:0px">
              @foreach ($installment_periods as $res_installment)
              	<li class="sp-title pip{{ $res_installment->pip_id }}">{{ $res_installment->insta_period }} Weeks <i class="fa fa-times sp-icon" title="Remove" onclick="removepip({{ $res_installment->pip_id }})"></i></li>
              @endforeach
              </ul><div class="clearfix"></div>
              @if(count($installment_periods) < 5)
                <div class="col-md-9" style="padding:0px;">
                {!! Form::text('insta_period[]','',array('class'=>'form-control','placeholder'=>'', 'onKeyUp' => 'validatePrice(this)', 'maxlength'=>'4')) !!} 
                </div>
                <div class="col-md-2 weeks">Weeks</div>
                <div class="col-md-1 text-right"><a href="javascript:void(0);" class="add"><i class="fa fa-plus"></i></a></div>
              @endif
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12"> {{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                &nbsp;&nbsp; <a href="{{ URL::to('administrator/manage-product') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a> </div>
              {{ Form::close() }} </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop