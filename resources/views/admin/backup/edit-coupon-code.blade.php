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
            <li> Edit Size</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-pencil-square-o"></i> Edit Size</h4> </div>
                <div class="widget-content">
                    <div class="col-xs-12 col-sm-12">
                      <div style="height:20px;">
                        @if (Session::has('success'))
                            <span style="color:#090;">Records has been saved successfully.</span>
                        @endif
                        
                        @if (Session::has('blank'))
                            <span style="color:#F00;">Please enter all * marked controls values.</span>
                        @endif
                        
                         @if (Session::has('exist'))
                            <span style="color:#F00;">This coupon code already exist.</span>
                        @endif
                        
                       
                      </div>
                    
                      {{ Form::open(array('url' => 'update-coupon-code', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_coupon_code', 'id' => 'frm_coupon_code','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      
                      {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
                          
                     <div class="form-group col-md-8">
                      <label>Coupon code*:</label> 
                     {!! Form::text('discount_code',$data[0]->discount_code,array('id' => 'discount_code','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Start Date*:</label> 
                     {!! Form::text('start_date',$data[0]->start_date,array('id' => 'start_date','required','class'=>'form-control','placeholder'=>'','readonly'=>true)) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>End Date*:</label> 
                     {!! Form::text('end_date',$data[0]->end_date,array('id' => 'end_date','required','class'=>'form-control','placeholder'=>'','readonly'=>true)) !!}
                     </div>
                     
                      <div class="form-group col-md-8">
                      <label>Coupon code*:</label> 
                     {!! Form::text('discount_percentage',$data[0]->discount_percentage,array('id' => 'discount_percentage','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                      
                      <div class="clearfix"></div>
                        
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-coupon-code') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
                      </div>
                              
                      {{ Form::close() }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@stop