@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Manage users</li>
        </ul>
        
        <!--<a href="{{ asset('administrator/add-coupon-code') }}" class="btn btn-primary pull-right" style="display:inline-block; margin:4px 8px 0 0;">Add Coupon Code</a>-->
        
      </div>
      
      <div class="page-header"></div>
      
      <div class="row">
          <div class="col-md-12 dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" id="tbl_content">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;"> Sl. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @php $sl=1; @endphp
                    @foreach ($data as $res)
                    <tr>
                        <td class="text-center" style="vertical-align:middle;">{{ $sl }} </td>
                         <td style="vertical-align:middle;">{{ $res->full_name }}</td>
                         <td style="vertical-align:middle;">{{ $res->email }}</td>
                         <td style="vertical-align:middle;">{{ $res->contact_no }}</td>
                         <td class="text-center" style="vertical-align:middle;">
                         <a href="user-details/{{ $res->user_id }}/details"><img src="{{ asset('public/images/view.png') }}" alt="Edit" /></a>
                          &nbsp;
                          @if($res->user_status==1)
                          <a href="{{ URL::to('administrator') }}/manage-users/{{ $res->user_id }}/unblock" class="linktext"><img src="{{ asset('public/images/red-circle.png') }}" width="20" height="20" border="0" title="Inactive User"></a>
                          @else
                          <a href="{{ URL::to('administrator') }}/manage-users/{{ $res->user_id }}/block" class="linktext" onClick="return confirm('Are you sure you want to block this user?')"><img src="{{ asset('public/images/circle-green.png') }}" width="18" height="18" border="0" title="Active User"></a>
                          @endif 
                        &nbsp;
                        <a href="{{ URL::to('administrator') }}/manage-users/{{ $res->user_id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><img src="{{ asset('public/images/delete-icon.png') }}" alt="Delete" /></a>
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