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
            <li> Edit Shipping Price</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-pencil-square-o"></i> Edit Shipping Price</h4> </div>
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
                            <span style="color:#F00;">This shipping information already exist.</span>
                        @endif
                        
                       
                      </div>
                    
                      {{ Form::open(array('url' => 'update-shipping-price', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_shipping', 'id' => 'frm_shipping','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      
                      {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
                          
                      <div class="form-group col-md-8">
                      <label>Service*:</label> 
                      {!! Form::select('service_id',$service_det,$data[0]->service_id,array('id' => 'service_id','required','class'=>'form-control','default' => '')) !!}
                      
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Min. Weight*:</label> 
                     {!! Form::text('minimum_weight',$data[0]->minimum_weight,array('id' => 'minimum_weight','required','class'=>'form-control datepick','placeholder'=>'')) !!}
                     </div>
                     
                     
                     <div class="form-group col-md-8">
                      <label>Max Weight*:</label> 
                     {!! Form::text('maximum_weight',$data[0]->maximum_weight,array('id' => 'maximum_weight','required','class'=>'form-control datepick1','placeholder'=>'')) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Min. Price*:</label> 
                     {!! Form::text('minimum_total_amount',$data[0]->minimum_total_amount,array('id' => 'minimum_total_amount','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Max. Price*:</label> 
                     {!! Form::text('maximum_total_amount',$data[0]->maximum_total_amount,array('id' => 'maximum_total_amount','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Shipping Price*:</label> 
                     {!! Form::text('pp_price',$data[0]->pp_price,array('id' => 'pp_price','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                      
                      <div class="clearfix"></div>
                        
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-shipping-price') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
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