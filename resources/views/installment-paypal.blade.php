@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-30">
  <div class="container">
    <div class="row paypal">
      <div class="col-md-12">
        <div class="page-title"><h2><i class="fa fa-paypal paypal-icon"></i> PayPal Processing</h2></div>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-20">
         <img src="{{ asset('public/images/ajax-loader.gif') }}">
         <h3 style="color:#0083c1;">
           Please Wait....<br />
           Please do not refresh the page while we're redirecting you to Paypal.<br />
         </h3>
         
          @php
          $payment_det = Helpers::getPaymentDetails();
          $business_email = $payment_det[0]->paypal_email;
          if($payment_det[0]->paypal_environment=='sandbox'){
              $paypal_red_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
          }else{
              $paypal_red_url = "https://www.paypal.com/cgi-bin/webscr";
          }
          
          
          $custom = Session::get('installment_id');
          $insta_dtls = DB::table('user_installments')
                  ->where('user_installments.insta_id', '=', $custom)
                  ->join('products', 'products.prd_id', '=', 'user_installments.prd_id')
                  ->select('user_installments.insta_amt','products.product_name')
                  ->first();
          //print_r($insta_dtls);exit;
          
          
          
          $item_number=$custom;
          $item_name=$insta_dtls->product_name;
          $amount = number_format($insta_dtls->insta_amt,2,'.','');
          
          $admin_det = Helpers::getAdminDetails(); 
          $notify = $admin_det[0]->site_url."api/installment-notify-paypal";
          $success = $admin_det[0]->site_url."installment-thank-you";
          $cancel = $admin_det[0]->site_url."installment-payment-failed";
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
<script type="text/javascript">
document.frm_paypal.submit();
</script>
@stop 

