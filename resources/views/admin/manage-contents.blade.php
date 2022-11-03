@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Manage Contents</li>
        </ul>
        <a href="{{ asset('administrator/add-content') }}" class="btn btn-primary pull-right" style="display:inline-block; margin:4px 8px 0 0;">Add Page</a>
      </div>
      
      <div class="page-header"></div>
      <div style="height:20px;">
          @if (Session::has('no_delete'))
              <span style="color: #d90023; font-weight: bold;">About Us page can't be deleted.</span>
          @endif
      </div>
      <div class="row">
          <div class="col-md-12 dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" id="tbl_content">
                  <thead>
                      <tr>
                          <th width="5%" style="text-align:center;"> Sl. </th>
                          <th>Page Title</th>
                          <th width="10%" class="text-center">Action</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      @php $sl=1; @endphp 
                      @foreach ($data as $res)
                      <tr>
                          <td class="text-center" style="vertical-align:middle;">{{ $sl }}</td>
                          <td style="vertical-align:middle;">{{ $res->page_title }}</td>
                          <td class="text-center" style="vertical-align:middle;">
                          <a href="edit-content/{{ $res->id }}/edit"><img src="{{ asset('public/images/edit-icon.png') }}" alt="Edit" title="Edit" /></a>
                          &nbsp;
                          @if($res->id!='1')
                            <a href="{{ URL::to('administrator') }}/manage-contents/{{ $res->id }}/delete"  onClick="return confirm('Are you sure you want to delete this page ?')"><img src="{{ asset('public/images/delete-icon.png') }}" alt="Delete" /></a>
                          @endif
                          </td>
                      </tr>
                       @php $sl+=1;  @endphp 
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