@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i>  Transaction Failed  </li>
        </ul>
      </div>
      
      <div class="page-header">
        <div class="page-title">
            <h3>Transaction Failed</h3>
            
           <div class="col-md-12 col-sm-12">
              <div class="entry-content mt-20">
               <h2 style="color:#F00;">Sorry, Unable to process your payment.Please try again.</h2>
           </div>
            </div>
      
      
        </div>
      </div>
      
  </div>
</div>
<script type="text/javascript">
//document.frm_paypal.submit();
</script>
@stop