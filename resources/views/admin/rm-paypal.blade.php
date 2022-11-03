@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i>  PayPal Processing  </li>
        </ul>
      </div>
      
      <div class="page-header">
        <div class="page-title">
            <h3>PayPal Processing</h3>
            
            <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-20">
         <img src="{{ asset('public/images/ajax-loader.gif') }}">
         <h3 style="color:#0083c1;">
           Please Wait....<br />
           Please do not refresh the page while we're redirecting you to Paypal.<br />
         </h3>
         
          @php
          $payment_det = Helpers::getPaymentDetails();

          
          
          if($payment_det[0]->paypal_environment=='sandbox'){
              $paypal_red_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
          }else{
              $paypal_red_url = "https://www.paypal.com/cgi-bin/webscr";
          }
          
          $custom = Session::get('order_id');
          $amount = Session::get('returning_amount');
          $business_email = Session::get('paypal_email_user');
          
          
          $item_number=$custom;
          $item_name="Return cancel product price";
          
          
          $admin_det = Helpers::getAdminDetails(); 
          $notify = $admin_det[0]->site_url."api/rm-notify-paypal";
          $success = $admin_det[0]->site_url."administrator/manage-orders";
          $cancel = $admin_det[0]->site_url."administrator/rm-payment-failed";
          @endphp
        
         {!! Form::open(['url' => $paypal_red_url,'method' => 'post','name'=>'frm_paypal','id'=>'frm_paypal']) !!}
            {{ Form::hidden('cmd','_xclick', array('id' => 'cmd')) }}
            {{ Form::hidden('business',$business_email, array('id' => 'business')) }}
            {{ Form::hidden('item_number',$item_number, array('id' => 'item_number')) }}
            {{ Form::hidden('item_name',$item_name, array('id' => 'item_name')) }}
            {{ Form::hidden('currency_code','GBP', array('id' => 'currency_code')) }}
         	{{ Form::hidden('amount',$amount, array('id' => 'amount')) }}
            {{ Form::hidden('notify_url',$notify, array('id' => 'notify_url')) }}
            {{ Form::hidden('return',$success, array('id' => 'return')) }}            
            {{ Form::hidden('cancel_return',$cancel, array('id' => 'cancel_return')) }} 
            {{ Form::hidden('custom',$item_number, array('id' => 'custom')) }} 
		 {!! Form::close() !!}  
        </div>
      </div>
        </div>
      </div>
      
  </div>
</div>
<script type="text/javascript">
document.frm_paypal.submit();
</script>
@stop