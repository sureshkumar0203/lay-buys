@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Manage Coupon Code</li>
        </ul>
        
        <a href="{{ asset('administrator/add-coupon-code') }}" class="btn btn-primary pull-right" style="display:inline-block; margin:4px 8px 0 0;">Add Coupon Code</a>
        
      </div>
      
      <div class="page-header"></div>
      
      <div class="row">
          <div class="col-md-12 dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" id="tbl_content">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;"> Sl. </th>
                        <th>Coupon code</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Discount [ % ]</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @php $sl=1; @endphp
                    @foreach ($data as $res)
                    <tr>
                        <td class="text-center" style="vertical-align:middle;">{{ $sl }} </td>
                         <td style="vertical-align:middle;">{{ $res->discount_code }}</td>
                         <td style="vertical-align:middle;">{{ date("jS M, Y",strtotime($res->start_date)) }}</td>
                         <td style="vertical-align:middle;">{{ date("jS M, Y",strtotime($res->end_date)) }}</td>
                         <td style="vertical-align:middle;">{{ $res->discount_percentage }}</td>
                         <td class="text-center" style="vertical-align:middle;">
                         <a href="edit-coupon-code/{{ $res->cc_id }}/edit"><img src="{{ asset('public/images/edit-icon.png') }}" alt="Edit" /></a>
                          @if($res->discount_code_status==0)
                          <a href="{{ URL::to('administrator') }}/manage-coupon-code/{{ $res->cc_id }}/unblock" class="linktext"><img src="{{ asset('public/images/red-circle.png') }}" width="20" height="20" border="0" title="Active User"></a>
                          @else
                          <a href="{{ URL::to('administrator') }}/manage-coupon-code/{{ $res->cc_id }}/block" class="linktext" onClick="return confirm('Are you sure you want to block this coupon code?')"><img src="{{ asset('public/images/circle-green.png') }}" width="18" height="18" border="0" title="Inactive User"></a>
                          @endif 
                    
                    
                        &nbsp;
                        <a href="{{ URL::to('administrator') }}/manage-coupon-code/{{ $res->cc_id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><img src="{{ asset('public/images/delete-icon.png') }}" alt="Delete" /></a>
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
        /* Disable sorting columns */
        'aoColumnDefs': [{'bSortable': true,'aTargets': [1]}]
    });
});
</script>


@stop