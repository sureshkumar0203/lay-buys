@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')                                       
<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];

$total_paid_still_now=number_format($total_installment + $order_info[0] -> dp_amount,'2','.',''); 
$processing_fee = number_format($payment_det->processing_cost,'2','.','');
$returning_amount = number_format(($total_paid_still_now -$processing_fee),'2','.','');
?>

<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> 
        	<i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a>
        </li>
        <li> Order Details</li>
      </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
      <div class="col-md-12">
        <div class="widget box">
          <div class="widget-header">
            <div class="row">
              <div class="col-md-9">
                <h4><i class="fa fa-pencil-square-o"></i> Order Details</h4> 
              </div>
              
              <div class="col-md-3 text-right ord-fo" style="padding-right:4px; margin-top: -2px;">
                <a href="{{ asset('administrator/print-order-details/'.$order_info[0]->order_id) }}" class="btn btn-warning" target="_blank">Print</a>
        
                @if($order_info[0]->cancel_status==1 && $order_info[0]->cancel_trans_id==null)  
                       
                {{ Form::open(array('url' => 'return-money-process', 'role' => 'form', 'class' =>'order-fo', 'name' => 'frm_rmp', 'id' => 'frm_rmp','files'=>true, 'autocomplete' => 'off','onSubmit'=>'')) }}
                
                {{ Form::hidden('prd_id',$order_info[0] -> order_prd_id, array('id' => 'prd_id')) }}
                {{ Form::hidden('ord_id',$order_info[0] -> order_id, array('id' => 'ord_id')) }}
                {{ Form::hidden('returning_amount',$returning_amount, array('id' => 'returning_amount')) }}
                {{ Form::hidden('paypal_email_user',$user_dtls->paypal_email_user, array('id' => 'paypal_email_user')) }}
                
                {{ Form::submit('Return Money', array('id'=>'pla_ord','class' => 'btn btn-info','style' =>'','onClick'=> "return confirm('Are you sure you want to return money to this customer ?')")) }}
                
                {{ Form::close() }}
                
                @endif
              </div>
            </div>
          </div>
            
          <div class="widget-content">
            <div class="row">
              <div class="col-md-12">
                <div class="widget-content" style="font-size:12px!important;">
                  <div class="form-group">
                    <div class="row">
                      <div class="form-group col-xs-4">
                        <strong> Order Information</strong><br /><br />
                        <strong>Order ID :</strong>  {{ $order_info[0] -> order_id }} <br />
                        <strong>Order Date :</strong> {{ date("jS M,Y",strtotime($order_info[0] -> order_date)) }} <br />
                        <strong>Order Expiry Date:</strong> {{ date("jS M,Y",strtotime($order_info[0] -> installment_exp_dt)) }}<br /><br />
                      
                      
                      @if($order_info[0]->cancel_status==1 && $order_info[0]->cancel_trans_id==NULL) 
                      <strong style="color:#F00;">Total Paid Still Now : 
                      &pound; {{ $total_paid_still_now }}  </strong>
                      
                      <br />
                      
                      <strong style="color:#F00;">Processing Fee : &pound; {{ $processing_fee  }}
                      </strong>
                      
                      <br />
                      
                      <strong style="color:#F00;">Returning Amount : &pound; {{ $returning_amount }}
                      </strong>
                      @endif
                      
                      @if($order_info[0]->cancel_trans_id!=NULL) 
                      <strong style="color:#030;">Returning Amount : &pound; {{ $returning_amount }}
                      </strong><br />
                      
                      <strong style="color:#030;">Transaction ID : {{ $order_info[0]->cancel_trans_id }}                          </strong>
                      
                      @endif
                      </div>
                         
                      <div class="form-group col-xs-4">
                        <strong> Billing Address</strong><br /><br />
                        {{ $order_info[0]->bill_full_name }} <br />
                        <strong>Contact Number :</strong> {{ $order_info[0]->bill_phone_number }}<br /><br />
                        
                        {{ $order_info[0]->bill_address1 }} <br /> 
                        @if($order_info[0]->bill_address2!='') {{ $order_info[0]->bill_address2 }} <br /> @endif
                        @if($order_info[0]->bill_town!='')  
                        <strong>Town :</strong> {{ $order_info[0]->bill_town }} <br /> @endif
                        
                        @if($order_info[0]->bill_city!='')  
                        <strong>City :</strong> {{ $order_info[0]->bill_city }} <br /> @endif
                        
                        
                        <strong>Postcode : </strong>{{ $order_info[0]->bill_post_code }} <br />
                      </div>
                          
                      <div class="form-group col-xs-4">
                        <strong> Delivery Address</strong><br /><br />
                        {{ $order_info[0]->ship_full_name }} <br />
                        <strong>Contact Number :</strong> {{ $order_info[0]->ship_phone_number }}<br /><br />
                        
                        
                        {{ $order_info[0]->ship_address1 }} <br /> 
                        @if($order_info[0]->ship_address2!='') 
                        {{ $order_info[0]->ship_address2 }} <br /> @endif
                        
                        @if($order_info[0]->ship_town!='')
                        <strong>Town :</strong> {{ $order_info[0]->ship_town }} <br /> @endif
                        
                        @if($order_info[0]->ship_city!='')
                        <strong>City :</strong> {{ $order_info[0]->ship_city }} <br /> @endif
                        
                        <strong>Postcode : </strong>{{ $order_info[0]->ship_post_code }} <br />
                      </div>
                    </div>
                    <div class="clearfix"></div>
                        
                    <div class="row">
                      <table class="table table-striped print-ord tbl-bdr">
                        <tr>
                          <td width="10%" align="left" valign="middle" class="ptb-10" style="background:#fff; border-top:solid 1px #000; border-bottom:solid 1px #000;" >
                          <img src="{{ asset('public/product-photo/'.$prd_dtls[0]->prd_photo) }}" height="50" alt="{{ $prd_dtls[0]->product_name }}" title="{{ $prd_dtls[0]->product_name }}" style="height:100px;">
                          </td>
                          
                          <td width="45%" align="left" valign="middle" style="background:#fff; border-top:solid 1px #000; border-bottom:solid 1px #000;">
                          <h3>{{ $prd_dtls[0]->product_name }}</h3>
                          <p>Model : {{ $prd_dtls[0]->product_model }}</p>
                          <p style="font-weight:bold;">Product Cost : &pound; {{ number_format($order_info[0] -> total_amount,2,'.','') }} </p>
                          </td>
                          
                          <td width="45%" align="left" valign="middle" style="background:#fff; border-top:solid 1px #000; border-bottom:solid 1px #000;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="p-cost" style="margin-top:20px;">
                         
                          <tr>
                            <td style="background:#fff;">
                            Initial Payment ( {{ $order_info[0] -> dp_per }} % ) :<br>
        
                            <span style="font-size:9px;">[ Transaction ID : {{ $order_info[0] -> transaction_id }} ]</span>
                            </td>
                            <td align="right" valign="middle" style="background:#fff;"><strong class="f-size14">&pound; {{ number_format($order_info[0] -> dp_amount,2,'.','') }} </strong></td>
                          </tr>
                         
                          <tr>
                            <td>&nbsp;</td>
                            <td align="right" valign="middle">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td style="background:#fff;"><strong class="f-size13">Due :</strong></td>
                            <td align="right" valign="middle" style="background:#fff;"> 
                            @if($due<=0) <span style="color:#063; font-weight:bold;">(Cleared)</span> @endif 
                            <strong class="f-size14">&pound; {{ number_format($due,'2','.','') }}</strong></td>
                          </tr>
                        </table>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="clearfix"></div>
                      
                    <div class="row">
                      <h4>Installment Transaction Details</h4> 
                      @if($total_installment >0)  
                      <table class="table table-striped trans-det">
                        <thead>
                          <tr>
                              <th style="border-bottom:solid 1px #000; border-top:solid 1px #000;">Transaction Date</th>
                              <th style="border-bottom:solid 1px #000; border-top:solid 1px #000;">Transaction ID</th>
                              <th style="border-bottom:solid 1px #000; border-top:solid 1px #000;">Amount</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @foreach($insta_dtls as $insta_det)
                          <tr>
                             <td>{{ date("jS M, Y",strtotime($insta_det->insta_date)) }}</td>
                             <td>{{ $insta_det->trns_id }}</td>
                             <td>&pound; {{ number_format($insta_det->insta_amt,2,'.','') }}</td>
                          </tr>
                          @endforeach
                              
                          <tr>
                             <td>&nbsp;</td>
                             <td class="bdr-top" style="border-bottom:solid 1px #000; border-top:solid 1px #000;"><strong>Total Installment :</strong>	</td>
                             <td class="bdr-top" style="border-bottom:solid 1px #000; border-top:solid 1px #000;">&pound; {{ number_format($total_installment,'2','.','') }}</td>
                          </tr>  			  
                        </tbody>
                      </table>  
                      @else
                      <div style="text-align:center;color:#F00;border:1px solid #000;padding-bottom:10px;">
                          <h2>No installment given still now...</h2>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          
            <div class="form-group col-xs-12">
              <div class="clearfix"></div>
              {{ Form::open(array('url' => 'update-order-status', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_od', 'id' => 'frm_od','files'=>true, 'autocomplete' => 'off')) }} 
            
             {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!} 
                  
              <div class="col-lg-12 row">
                <label for="Order Status" class="col-sm-3 row">Change Order status : </label>
                <div class="col-sm-6">
                <select name="order_status" id="order_status" <?php if($order_info[0]->order_status=='Shipped'){ echo  'disabled'; } ?>>
                  <option value="Not yet shipped" @if($order_info[0] -> order_status =='Not yet shipped') {{ 'selected' }} @endif >Not yet shipped</option>
                  <option value="Shipped" @if($order_info[0] -> order_status =='Shipped') {{ 'selected' }} @endif >Shipped</option>
                </select>
                </div>
                <div class="clearfix"></div>
                
                @if (Session::has('success'))
                    <span style="color:#090;">Order status has been changed successfully.</span>
                @endif
                
                @if (Session::has('cos'))
                    <span style="color:#F00;">Please change order status.</span>
                @endif
              </div>
              
              <div class="col-lg-12 row"><br /><br /></div>
                  
              <div class="col-sm-12 row">
                @if($order_info[0] -> order_status =='Not yet shipped')
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                @endif
                <a href="{{  URL::to('administrator/manage-orders') }}" class="btn btn-danger">Back to Manage Orders</a>
              </div>
              <div class="col-lg-12 row"><br /><br /></div>
                  
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