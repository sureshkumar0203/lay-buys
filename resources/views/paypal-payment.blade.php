
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
          $business_email = 'sureshkumar02_biz@gmail.com';
          //$custom = rand();
          $paypal_red_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
          //$paypal_red_url = "https://www.paypal.com/cgi-bin/webscr";
          

          
          $item_number=rand();
          $item_name='STL Product - '.rand();
          $amount = '5.00';
          
          
          $notify = "http://localhost:8080/lay-buys/api/notify-paypal-stl";
          $success = "http://localhost:8080/lay-buys/thank-you-stl";
          $cancel = "http://localhost:8080/lay-buys/payment-failed-stl";
          @endphp
        
         {!! Form::open(['url' => $paypal_red_url,'method' => 'post','name'=>'frm_paypal','id'=>'frm_paypal']) !!}
            {{ Form::text('cmd','_xclick', array('id' => 'cmd')) }}
            {{ Form::text('business',$business_email, array('id' => 'business')) }}
            {{ Form::text('item_number',$item_number, array('id' => 'item_number')) }}
            {{ Form::text('item_name',$item_name, array('id' => 'item_name')) }}
            {{ Form::text('currency_code','GBP', array('id' => 'currency_code')) }}
         	  {{ Form::text('amount',$amount, array('id' => 'amount')) }}
            {{ Form::text('notify_url',$notify, array('id' => 'notify_url')) }}
            {{ Form::text('return',$success, array('id' => 'return')) }}            
            {{ Form::text('cancel_return',$cancel, array('id' => 'cancel_return')) }} 
            {{ Form::text('custom',$item_number, array('id' => 'custom')) }} 
		 {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
document.frm_paypal.submit();
</script>


