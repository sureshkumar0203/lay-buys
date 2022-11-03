@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        <li> Manage Product</li>
      </ul>
      <a href="{{ asset('administrator/add-product') }}" class="btn btn-primary pull-right" style="display:inline-block; margin:4px 8px 0 0;">Add Product</a> </div>
    <div class="page-header"></div>
    <div class="row">
      <div class="col-md-12 dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="tbl_content">
          <thead>
            <tr>
              <th width="5%" style="text-align:center;"> Sl. </th>
              <th>Category Name</th>
              <th>Subcategory Name</th>
              <th>Product Name</th>
              <th>Model</th>
              <th>Price</th>
              <th width="12%" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
          
          @php $sl=1; @endphp
          @foreach ($data as $res)
          <tr>
            <td class="text-center" style="vertical-align:middle;">{{ $sl }} </td>
            <td style="vertical-align:middle;">{{ $res->category_name }}</td>
            <td style="vertical-align:middle;">{{ $res->sub_cat_name }}</td>
            <td style="vertical-align:middle;">{{ str_limit($res->product_name, 40) }}</td>
            <td style="vertical-align:middle;">{{ $res->product_model }}</td>
            <td style="vertical-align:middle;">&pound; <b>{{ $res->product_price }}</b></td>
            <td class="text-center" style="vertical-align:middle;">
              @if($res->active_status=='1')
              <div class="deactive_Status" id="Deactive_{{ $res->prd_id }}" onclick="return Deactive_Status({{ $res->prd_id }})" data-toggle="tooltip" title="Deactivte">
                <i class="fa fa-lock"></i>
              </div>
              @else
              <div class="active_Status" id="Active_{{ $res->prd_id }}" onclick="return Active_Status({{ $res->prd_id }})" data-toggle="tooltip" title="Activate">
                <i class="fa fa-unlock"></i>
              </div>
              @endif
              <a href="edit-product/{{ $res->prd_id }}/edit"><img src="{{ asset('public/images/edit-icon.png') }}" alt="Edit" /></a> &nbsp; 
              <a href="{{ URL::to('administrator') }}/manage-product/{{ $res->prd_id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><img src="{{ asset('public/images/delete-icon.png') }}" alt="Delete" /></a>
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