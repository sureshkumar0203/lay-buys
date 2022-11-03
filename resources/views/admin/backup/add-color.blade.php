@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Add Color</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-plus-square"></i> Add Color</h4> </div>
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
                            <span style="color:#F00;">This color name already exist.</span>
                        @endif
                        
                      </div>
                    
                      {{ Form::open(array('url' => 'add-color', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_color', 'id' => 'frm_color','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      <div class="form-group col-md-8">
                      <label>Color Name*:</label> 
                     {!! Form::text('color_name','',array('id' => 'color_name','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                     <script type="text/javascript" src="{{  asset('public/jscolor/jscolor.js') }}"></script>
                     <div class="form-group col-md-8">
                      <label>Select Color*:</label> 
                     {!! Form::text('color_code','',array('id' => 'color_code','required','class'=>'form-control color','placeholder'=>'','readonly' => 'true')) !!}
                     </div>
                     
                      
                      <div class="clearfix"></div>
                       
                     
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-color') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
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