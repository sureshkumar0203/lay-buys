@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50 mb-50">
  <div class="container">
    <div class="row">
      <div>
        <div class="col-md-6"><h3 class="page-title">Order Details</h3></div>
        <div class="col-md-6 text-right">
          @if($user_dtls->paypal_email_user==null)
          	<span style="color:#F00;">
            <strong>Notes: To cancel this order set your PayPal email which is inside  "Account->Profile Settings"</strong>
            </span>
          @else
            @if($order_info->cancel_status==0 && $due>0 && $total_paid_still_now > $processing_fee)
            <a href="{{ url('/') }}/cancel-order-{{ $order_info -> order_id }}" class="btn btn2 cancel-btn2" onClick="return confirm('Are you sure you want to cancel this order ?')"><i class="fa fa-times" aria-hidden="true"></i> Cancel This Order</a>
            @endif
            
             @if($order_info->cancel_status==1 && $order_info->cancel_trans_id==NULL)
             <span class="btn btn2 cancel-btn">This Order is Cancelled</span>
             @endif
             
             @if($order_info->cancel_trans_id!=NULL)
             <span class="btn btn2 cancel-btn3">Money Returned To Your Account</span>
             @endif
           @endif
        </div>
      </div>

      <div class="col-md-12">
        <table width="100%" class="prod-desc ord-det" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td width="10%" align="left" valign="middle" class="ptb-10" >
            <img src="{{ asset('public/product-photo/'.$prd_dtls[0]->prd_photo) }}" height="50" alt="{{ $prd_dtls[0]->product_name }}" title="{{ $prd_dtls[0]->product_name }}" style="height:100px;">
            </td>
            <td width="45%" align="left" valign="middle">
            <h3>{{ $prd_dtls[0]->product_name }}</h3>
            <p>Model : {{ $prd_dtls[0]->product_model }}</p>
            <p><strong class="f-size14">Product Cost : &pound; {{ number_format($order_info -> total_amount,2,'.','') }}</strong></p>
            </td>
            <td width="45%" align="left" valign="middle">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="p-cost">
                <tr>
                  <td>Initial Payment ( {{ $order_info -> dp_per }} % ):</td>
                  <td align="right" valign="middle"><strong class="f-size14">&pound; {{ number_format($order_info -> dp_amount,2,'.','') }} </strong></td>
                </tr>
               <tr>
                  <td colspan="2" class="f-size9">[ Transaction ID : {{ $order_info -> transaction_id }} ]</td>
                  </tr>
                
                <tr>
                  <td>Total Installment :</td>
                  <td align="right" valign="middle"><strong class="f-size14">&pound; {{ number_format($total_installment,'2','.','') }}</strong></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td><strong class="f-size13">Due :</strong></td>
                  <td align="right" valign="middle"><strong class="f-size14">
                  @if($due<=0) <span style="color:#063; font-weight:bold;">(Cleared)</span> @endif   
                  &pound; {{ number_format($due,'2','.','') }}</strong></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
      
      <div class="col-md-12 col-sm-12 box_panel">
        <div class="entry-content pt-30">
          <div class="_title">Your Order Details</div>
          <table width="100%" class="mb-100 prod-desc ord-info">
            <tr>
              <td align="left" valign="middle" height="10"></td>
              <td align="left" valign="middle"></td>
              <td align="left" valign="middle"></td>
            </tr>
            <tr>                  
              <td align="left" valign="middle" class="pt-20">
                <h4><strong>Order Information</strong></h4>
                Order ID : {{ $order_info -> order_id }}<br />
                Order Date : {{ date("jS M,Y",strtotime($order_info -> order_date)) }}<br />
                
                <strong style="color:#F00;">Order Expiry Date : {{ date("jS M,Y",strtotime($order_info -> installment_exp_dt)) }}
                [ {{ $order_info -> installment_period. " Installment(s)" }} ] </strong>
                
                <br /> <br />
                
                
                @if($order_info->cancel_status==1 && $order_info->cancel_trans_id==NULL) 
                <strong style="color:#F00;">Total Paid Still Now : 
                &pound; {{ number_format($total_paid_still_now,2,'.','') }}  </strong>
                
                <br />
                
                <strong style="color:#F00;">Processing Fee : &pound; {{ $processing_fee  }}
                </strong>
                
                <br />
                
                <strong style="color:#F00;">Returning Amount : &pound; {{ $returning_amount }}
                </strong>
                @endif
                          
                          
                @if($order_info->cancel_trans_id!=NULL) 
                <strong style="color:#030;">Money Returned : &pound; {{ $returning_amount }}
                </strong><br />
                
                <strong style="color:#030;">Transaction ID : {{ $order_info->cancel_trans_id }}</strong>
                @endif
                          
                          
              </td>
            
              <td align="left" valign="middle" class="pt-20">
                <h4><strong>Billing Address</strong></h4>
                {{ $order_info -> bill_full_name }}<br />
                Contact No. : {{ $order_info -> bill_phone_number	 }}<br /><br />
                
                {{ $order_info -> bill_address1 }} 
                {{ ($order_info -> bill_address2)? ' ,'.$order_info -> bill_address2:'' }}
                <br />
                @if($order_info -> bill_town) Town: {{ $order_info -> bill_town }} &nbsp;&nbsp;  @endif
                @if($order_info -> bill_city) City: {{ $order_info -> bill_city }} &nbsp;&nbsp;  @endif
                Postcode:  {{ $order_info -> bill_post_code }}<br />
              </td>
                            
              <td align="left" valign="middle" class="pt-20">
                <h4><strong>Delivery Address</strong></h4>
                {{ $order_info -> ship_full_name }}<br />
                Contact No. : {{ $order_info -> ship_phone_number	 }}<br /><br />
                
                {{ $order_info -> ship_address1 }}
                {{ ($order_info -> ship_address2)? ' ,'.$order_info -> ship_address2:'' }}
                <br />                
                
                @if($order_info -> ship_town) Town: {{ $order_info -> ship_town }} &nbsp;&nbsp; @endif
                @if($order_info -> ship_city) City: {{ $order_info -> ship_city }} &nbsp;&nbsp; @endif
                Postcode:  {{ $order_info -> ship_post_code }}<br />
              </td>               
            </tr>
            <tr>
              <td height="10" align="left" valign="middle"></td>
              <td height="10" align="left" valign="middle"></td>
              <td height="10" align="left" valign="middle"></td>
            </tr>  
          </table>
        </div>
      </div>
      @if($due>0 && $order_info -> cancel_status==0)
	  {{ Form::open(array('url' => 'installment-process', 'role' => 'form', 'class' =>'', 'name' => 'frm_insta', 'id' => 'frm_insta','files'=>true, 'autocomplete' => 'off','onSubmit'=>'return validateInstallment();')) }}
      
       {{ Form::hidden('prd_id',$order_info -> order_prd_id, array('id' => 'prd_id')) }}
       {{ Form::hidden('ord_id',$order_info -> order_id, array('id' => 'ord_id')) }}
      
      <div class="col-md-12 checkbox-form mt-20">      
      <h4 class="page-title mb-10">Pay your installment  ( &pound; )</h4>
      <div class="pay-install">
        <div class="col-md-4">
          <div class="row">
            <div class="checkout-form-list">
             {!! Form::text('insta_amt','', array('id' => 'insta_amt','class'=>'','placeholder'=>'Installment Amount', 'onKeyUp' => 'validatePrice(this)','maxlength'=>'10','autocomplete' => 'off')) !!}
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
        {{ Form::submit('Pay Now', array('id'=>'pla_ord','class' => 'btn btn2 fa fa-credit-card','style' =>'')) }}
        <strong style="color:#F00; float:right; padding-top:10px;">Note : Installment Amount : &pound; {{ $weekly_paid }} </strong>
        
        </div> 
        </div>
        
      </div>
	  {{ Form::close() }}
	  @endif 
      
      
      <div class="col-md-12 mt-20">
        <h4 class="page-title">Installment Transaction Details</h4>
      	@if($total_installment >0)  
        <table width="100%" class="prod-desc trans-hist mt-20"  border="1" cellspacing="0" cellpadding="0">
          <tr>
            <th width="33%" align="left" valign="middle">Transaction Date</th>
            <th width="33%" align="left" valign="middle">Transaction ID</th>
            <th width="33%" align="left" valign="middle">Amount</th>
          </tr>
          
          @foreach($insta_dtls as $insta_det)
          <tr>
            <td width="33%" align="left" valign="middle">{{ date("jS M, Y",strtotime($insta_det->insta_date)) }}</td>
            <td width="33%" align="left" valign="middle">{{ $insta_det->trns_id }} </td>
            <td width="33%" align="left" valign="middle">&pound; {{ number_format($insta_det->insta_amt,2,'.','') }}</td>
          </tr>
          @endforeach
        </table><br />
        @else

         <div style="text-align:center; color:#F00; border:1px solid #000;">
              <h3>No installment paid at this time.</h3>
          </div>
        @endif
      </div>      
      <div class="col-md-12 mt-20">
      <a href="{{ url('/') }}/my-account" class="btn btn2 "> Go to my Account</a>
      </div>
    </div>
  </div>
</div>
@stop