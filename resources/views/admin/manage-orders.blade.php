@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> 
        <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a>
        </li>
        <li>Manage Orders</li>
      </ul>
      <!--<a href="{{ asset('administrator/add-coupon-code') }}" class="btn btn-primary pull-right" style="display:inline-block; margin:4px 8px 0 0;">Add Coupon Code</a>-->
    </div>
    <div class="page-header"></div>  
        
    <div class="row">
      <div class="col-md-12 dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="tbl_content">
          <thead>
            <tr>
              <th>Order ID </th>
              <th>Order Date</th>
              <th>Name</th>
              <th>Contact No.</th>
              <th>Product Cost</th>
              <th width="20%">Total Paid =  Initial Payment + Total Installment</th>
              <th>Due Amount</th>
              <th>Order Status</th>
              <th width="5%" class="text-center">Action</th>
            </tr>
          </thead>
          
          <tbody>
            @php $sl=1; @endphp
            
            @foreach ($data as $res)
            
            @php
            $total_installment = DB::table('user_installments')
            ->where('ord_id', '=' ,$res->order_id)
            ->where('trns_id', '!=' ,null)
            ->where('intsa_status', '=' ,'Paid')
            ->orderBy('insta_id', '=' ,'DESC')
            ->sum('insta_amt');
            
           
            $total_paid_still_now = $res->dp_amount+$total_installment;
            $due = $res->total_amount - $total_paid_still_now;
            @endphp
            <tr>
               <td style="vertical-align:middle; position:relative!important; text-align:center; @if($due<=0) background-color:#093;  @endif" title="@if($due<=0) Orders ready to dispatch @endif" class="@if($res->cancel_status==1) cancel_order  @endif @if($res->cancel_trans_id!=null) money_returned @endif cancel_order_text">{{ $res->order_id }}<span></span></td>
               <td style="vertical-align:middle;">{{ date("jS M,Y",strtotime($res->order_date)) }}</td>
               <td style="vertical-align:middle;">{{ $res->bill_full_name }}</td>
               <td style="vertical-align:middle;">{{ $res->bill_phone_number }}</td>
               <td style="vertical-align:middle;">&pound; {{ number_format($res->total_amount,2,'.','') }}</td>
               <td style="vertical-align:middle;">
               <b>&pound; {{ number_format($total_paid_still_now,2,'.','')}} </b> =
               {{ number_format($res->dp_amount,2,'.','') }} +  
               {{ number_format($total_installment,2,'.','') }} 
               </td>
               <td style="vertical-align:middle;">&pound; {{ number_format($due,2,'.','') }}</td>
               <td style="vertical-align:middle;">
                @if($res->order_status=='Shipped')
                  <span class="btn btn-success btn-xs">{{ $res->order_status }}</span>
                @else
                  {{ $res->order_status }}
                @endif
               </td>
              
              
               <td class="text-center" style="vertical-align:middle;">
               <a href="order-details/{{ $res->order_id }}/details"><img src="{{ asset('public/images/view.png') }}" alt="Edit" /></a>
               
              &nbsp;
             <!-- <a href="{{ URL::to('administrator') }}/manage-orders/{{ $res->order_id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><img src="{{ asset('public/images/delete-icon.png') }}" alt="Delete" /></a>-->
              </td>
            </tr>
            @php $sl+=1; @endphp
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#tbl_content').DataTable({
        responsive: true,
        /* Disable initial sort */
        "aaSorting": [],
        /*Stay in same page*/
        "stateSave": true,
		"lengthMenu": [[25, 50,100, -1], [25, 50,100, "All"]],
        /* Disable sorting columns */
        'aoColumnDefs': [{'bSortable': true,'aTargets': [1]}]
    });
});
</script>
@stop