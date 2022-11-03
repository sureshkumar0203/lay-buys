@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div ><h3 class="page-title">Dashboard</h3></div>
      </div>
      
      <div class="col-md-12 col-sm-12 box_panel">
        <div class="entry-content pt-30">
          @if(count($order_info)>0)
          <div class="_title">Order History</div>
            <table class="order-history table-striped mb-50" id="no-more-tables">                 
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Order date</th>
                  <th>Cancel date</th>
                  <th>Returned money</th>
                  <th>Order expiry date</th>
                  <th>Total product cost</th>
                  <th>Order status</th>
                  <th>Details</th>
                </tr>
              </thead>
              
              <tbody>
                @foreach($order_info as $order_det)
                <tr>
                    <td style="vertical-align:middle; position:relative!important; text-align:center;" data-title="Order Id">{{ $order_det -> order_id }}</td>
                    <td data-title="Order Date">{{ date("jS M, Y",strtotime($order_det -> order_date)) }}</td>
                    <td data-title="Cancel Date" style="vertical-align:middle; position:relative!important; text-align:center;" class="@if($order_det->cancel_status==1) cancel_order @endif ">@if($order_det -> cancel_date!=null) {{ date("jS M, Y",strtotime($order_det -> cancel_date)) }} @else -- @endif <span></span></td>
                    
                    <td data-title="Returned Money" class="@if($order_det->cancel_trans_id!=null) money_returned @endif">@if($order_det -> cancel_trans_id!=null) &pound; {{ number_format($order_det -> cancel_amount,2,'.','') }} @else -- @endif <span></span></td>
                    
                    <td data-title="Installment Expiry Date">{{ date("jS M, Y",strtotime($order_det -> 	installment_exp_dt)) }} [ {{ $order_det -> installment_period. " Installment(s)" }} ]</td>
                    <td data-title="product Cost">&pound; {{ number_format($order_det -> total_amount,2,'.','') }}</td>
                    <td data-title="Order Status">{{ $order_det -> order_status }}</td>
                    <td align="center" data-title="Deatils">
                     <a href="order-details-{{ $order_det -> order_id }}" class="title">
                         <i class="fa fa-search" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach	  
              </tbody>
            </table>
          </div>
          @else
          <div style=" margin: 22px 0px 170px 0px;">
            <h3 class="page-title no_op">You have not placed any order yet.</h3>
          </div>
          @endif
      </div>
    </div>
  </div>
</div>
@stop