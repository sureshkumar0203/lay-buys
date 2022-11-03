@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Add Coupon Code</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-plus-square"></i> Add Coupon Code</h4> </div>
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
                    
                      {{ Form::open(array('url' => 'add-coupon-code', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_coupon_code', 'id' => 'frm_coupon_code','files'=>true, 'autocomplete' => 'off')) }} 
                       
                          <!--date picker-->
                          <link rel="stylesheet" href="{{ asset("public/datepicker/jquery-ui.css") }}" />
                          <script src="{{ asset("public/datepicker/jquery-ui.js") }}"></script>
                          <script type="text/javascript">
                          $(function() {
                          $(".datepick").datepicker({
                              dateFormat: 'yy-mm-dd',
                              changeMonth: true,
                              changeYear: true,
                              numberOfMonths: 1,
                              minDate: new Date(),
                              showWeek: true,
                              onClose: function( selectedDate ) {
                                  $( ".datepick1" ).datepicker( "option", "minDate", selectedDate );
                              }
                          });
                          });
                          $(function() {
                          $(".datepick1").datepicker({
                              dateFormat: 'yy-mm-dd',
                              changeMonth: true,
                              changeYear: true,
                              numberOfMonths: 1,
                              minDate: new Date(),
                              showWeek: true,
                          });
                          });
                          </script>
                          <!--date picker--> 
                      


                      <div class="form-group col-md-8">
                      <label>Coupon code*:</label> 
                     {!! Form::text('discount_code','',array('id' => 'discount_code','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Start Date*:</label> 
                     {!! Form::text('start_date','',array('id' => 'start_date','required','class'=>'form-control datepick','placeholder'=>'','readonly' => 'true')) !!}
                     </div>
                     
                     
                     <div class="form-group col-md-8">
                      <label>End Date*:</label> 
                     {!! Form::text('end_date','',array('id' => 'end_date','required','class'=>'form-control datepick1','placeholder'=>'','readonly' => 'true')) !!}
                     </div>
                     
                     <div class="form-group col-md-8">
                      <label>Discount [ % ]*:</label> 
                     {!! Form::text('discount_percentage','',array('id' => 'discount_percentage','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
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