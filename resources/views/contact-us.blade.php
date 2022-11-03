@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="contact-area mt-50">
  <div class="container">
    <div class="row">	
      <div class="col-md-12">
        <div class="page-title">
            <h2>Contact 
             @if (Session::has('success'))
                  <span style="color:#ff6a00; padding-left:60px; font-size:16px">Your message has been send successfully.</span>
                  @endif

                  @if (Session::has('blank'))
                  <span style="color:#F00; padding-left:10px;">Please enter all * marked controls values.</span>
                  @endif
            </h2>
        </div>
      </div>
      
      <div class="col-md-12 pt-30">						
        <div class="row">                        
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="contact-form">
              <h3>Leave a Message</h3>            
              
              <div class="row">
                {{ Form::open(array('url' => 'contact-us', 'role' => 'form', 'class' =>'', 'name' => 'contact_form', 'id' => 'contact_form','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('full_name',old('full_name'), array('id' => 'full_name','required','class'=>'','placeholder'=>'Your Name (required)','autocomplete' => 'off')) !!}
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  	  {!! Form::email('user_email',old('user_email'), array('id' => 'user_email','required','class'=>'','placeholder'=>'Email (required)','autocomplete' => 'off')) !!}
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                       {!! Form::text('subject',old('subject'), array('id' => 'subject','required','class'=>'','placeholder'=>'Subject (required)','autocomplete' => 'off')) !!}
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  	  {!! Form::textarea('your_message','',array('id' => 'your_message','required','class'=>'contact-textarea','size' => '0x10','placeholder'=>'Message (required)')) !!}
                      
                     
                     {{ Form::submit('Send Message', array('id'=>'btn_submit','class' => '')) }}
                  </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="location">
                <h3>Location</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2356807.9070613864!2d-3.9015823!3d54.7699428!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d0a98a6c1ed5df%3A0xf4e19525332d8ea8!2sEngland%2C+UK!5e0!3m2!1sen!2sin!4v1531207297848" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
            
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="contact-info">
                <h3>Contact info</h3>
                <ul>
                    <li>
                        <i class="fa fa-map-marker"></i> <strong>Address:</strong>
                        {{ strip_tags($admin_det[0]->address) }}
                    </li>
                    
                    <li>
                        <i class="fa fa-phone"></i> <strong>Contact No.:</strong>
                        {{ $admin_det[0]->contact_no }}
                    </li>
                    
                    <li>
                        <i class="fa fa-mobile"></i> <strong>Mobile No.:</strong>
                        {{ $admin_det[0]->mobile_no }}
                    </li>
                    
                    <li>
                        <i class="fa fa-envelope"></i> <strong>Email:</strong>
                        {{ $admin_det[0]->alt_email }}
                    </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop