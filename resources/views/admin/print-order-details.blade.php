<!DOCTYPE html>
<html lang="en" ng-app="yorubaModule">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Order Details</title>

<link href="{{ asset('public/admin/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
<style type="text/css" media="all">

body{
	font-size:12px; 
	background:#f1f1f1;
	}

hr {
	border-top:solid 1px #504e4e52!important;
	margin-top: 10px !important;
	margin-bottom: 10px !important;
}

.page-header {
    padding-bottom: 9px;
    margin: 40px 0 20px;
    border-bottom: 1px solid #000!important;
}
.table-striped>tbody>tr:nth-child(odd)>td{
	background:inherit;
	}
.table>thead>tr>th{
	border-bottom: 1px solid #000; 
	border-top: 1px solid #000 !important;
	}



.print-ord{}
.print-ord td{ 
	background:#fff!important;
}
.table>tbody>tr>td{ 
	border-top:none;
}
.tbl-bdr{
	border-top:solid 1px #000000!important; 
	border-bottom:solid 1px #000000!important;
	}

.trans-det td{
	background:#00000008; 
	padding:3px !important; 
	font-size:12px!important;     
	border-top: solid 1px #0000001c!important;
	}

.container{
	width:1000px;
	background:#fff;
	padding:20px;
	box-shadow: #0000001f 0px 2px 20px 0px;
	}
	
.row{
	margin-left:0px; 
	margin-right:0px;
	}

h3{font-size:20px;}	

.trans-det td.bdr-top{ 
	border-top:solid 1px #000000!important;
	border-bottom:solid 1px #000000!important;
	}

</style> 
</head>

<body>
<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>   
<div id="content">
  <div class="container">
    <div class="row">
    <div class=col-md-12>
      <div style="width:400px;float:left;">
        <b>Lay Buys</b><br>
        {{ $admin_det[0]->address }}<br>
      </div>
      
      <div style="float:right;">
      Contact No. : {{ $admin_det[0]->mobile_no }} /  {{ $admin_det[0]->contact_no }} <br>
        Email : {{ $admin_det[0]->alt_email }}
      <!--<img src="{{ URL::asset('public/img/logo/logo.png') }}" style="height:80px" alt="logo"/>--></div>
      
    </div>
    </div>
    
    <div class="row page-header" style="margin-top:12px;"></div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="widget-content">
                    <div class="form-group">
                    <div class="row">
                    
                          <div class="form-group col-xs-4">
                            <strong>Order Information</strong><br /><br />
                            <strong>Order ID :</strong>  {{ $order_info[0] -> order_id }} <br />
                            <strong>Order Date :</strong> {{ date("jS M,Y",strtotime($order_info[0] -> order_date)) }} <br />
                            <strong>Order Expiry Date:</strong> {{ date("jS M,Y",strtotime($order_info[0] -> installment_exp_dt)) }}<br /><br />
                            
                            
                          </div>
                         
                          <div class="form-group col-xs-4">
                          <strong> Billing Address</strong><br /><br />
                          {{ $order_info[0]->bill_full_name }} <br />
                          <strong>Contact Number :</strong> {{ $order_info[0]->bill_phone_number }}<br /><br />
                          
                          {{ $order_info[0]->bill_address1 }} <br /> 
                          @if($order_info[0]->bill_address2!='') {{ $order_info[0]->bill_address2 }} 
                          <br /> @endif
                          
                          @if($order_info[0]->bill_town!='') 
                          <strong>Town :</strong> {{ $order_info[0]->bill_town }} <br /> @endif
                          
                         @if($order_info[0]->bill_city!='') <strong>City :</strong> 
                         {{ $order_info[0]->bill_city }} <br /> @endif
                           
                          <strong>Postcode : </strong>{{ $order_info[0]->bill_post_code }} <br />

                          </div>
                          
                          <div class="form-group col-xs-4">
                          <strong> Delivery Address</strong><br /><br />
                          {{ $order_info[0]->ship_full_name }} <br />
                          <strong>Contact Number :</strong> {{ $order_info[0]->ship_phone_number }}<br /><br />
                          
                          
                          {{ $order_info[0]->ship_address1 }} <br /> 
                          
                          @if($order_info[0]->ship_address2!='') {{ $order_info[0]->ship_address2 }} 
                          <br /> @endif
                          
                          @if($order_info[0]->ship_town!='')
                          <strong>Town :</strong> {{ $order_info[0]->ship_town }}  <br /> @endif
                          
                          @if($order_info[0]->ship_city!='')
                          <strong>City :</strong> {{ $order_info[0]->ship_city }}  <br /> @endif 
                          
                          
                          <strong>Postcode : </strong>{{ $order_info[0]->ship_post_code }} <br />
                          
                          </div>
                          </div>
                          
                          
                          <div class="clearfix"></div>
                          
                          <div class="row">
                          
                          <table class="table table-striped print-ord tbl-bdr">
                            <tr>
                              <td width="10%" align="left" valign="middle" class="ptb-10" >
                              <img src="{{ asset('public/product-photo/'.$prd_dtls[0]->prd_photo) }}" height="50" alt="{{ $prd_dtls[0]->product_name }}" title="{{ $prd_dtls[0]->product_name }}" style="height:100px;">
                              </td>
                              
                              <td width="45%" align="left" valign="middle">
                              <h3>{{ $prd_dtls[0]->product_name }}</h3>
                              <p>Model : {{ $prd_dtls[0]->product_model }}</p>
                              <p style="font-weight:bold;">Product Cost : &pound; {{ number_format($order_info[0] -> total_amount,2,'.','') }} </p>
                              </td>
                              
                              <td width="45%" align="left" valign="middle">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="p-cost" style="margin-top:20px;">
                           
                            <tr>
                              <td>
                              Initial Payment ( {{ $order_info[0] -> dp_per }} % ) :<br>

                              <span style="font-size:9px;">[ Transaction ID : {{ $order_info[0] -> transaction_id }} ]</span>
                              </td>
                              <td align="right" valign="middle"><strong class="f-size14">&pound; {{ number_format($order_info[0] -> dp_amount,2,'.','') }} </strong></td>
                            </tr>
                           
                            
                            
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td align="right" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><!--<strong class="f-size13">Due :</strong>--></td>
                              <td align="right" valign="middle"><!--<strong class="f-size14">  &pound; {{ number_format($due,'2','.','') }}</strong>--></td>
                            </tr>
                          </table>
                              </td>
                              
                              
                            </tr>
                          </table>
                          
                        </div>
      
      
      
                          <div class="clearfix"></div>
                          
                      <div class="row"><h4>Installment Transaction Details</h4> 
                          <table class="table table-striped trans-det">
                                <thead>
                                    <tr>
                                        <th>Transaction Date</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
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
                                       <td class="bdr-top">Total Installment :	</td>
                                       <td class="bdr-top">&pound; {{ number_format($total_installment,'2','.','') }}</td>
                                    </tr>  			  
                                </tbody>
                            </table>  
          		
</div>
          </div>
                    <div class="clearfix"></div>
                </div>
      	<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
window.print();
</script>
 </body>
</html>