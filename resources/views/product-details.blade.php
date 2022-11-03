@extends('includes.master')

@section('title') {{ $prd_det->prd_meta_title }} @stop
@section('keywords'){{ $prd_det->prd_meta_keywords	}} @stop
@section('description'){{ $prd_det->prd_meta_descriptions }} @stop

@section('content')
<div class="single-product-detaisl-area pt-30">
  <div class="single-product-view-area">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="single-procuct-view">
            <div class="simpleLens-gallery-container" id="p-view">
              <div class="simpleLens-container tab-content">
                @php $ph_lp = 1; @endphp
                @foreach($prd_ph_det as $prd_ph_data)
                <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="p-view-{{ $ph_lp }}">
                  <div class="simpleLens-big-image-container">
                    <a class="simpleLens-lens-image"><img src="{{ asset('public/product-photo/'.$prd_ph_data->prd_photo) }}" class="simpleLens-big-image" alt="productd"></a>
                  </div>
                </div>
                @php $ph_lp = $ph_lp+1; @endphp
                @endforeach
              </div>
              
              <div class="simpleLens-thumbnails-container">
                <div id="single-product" class="owl-carousel custom-carousel">
                  <ul class="nav nav-tabs" role="tablist">
                  @php $ph_lp = 1; @endphp
                  @foreach($prd_ph_det as $prd_ph_data)
                      <li class="{{ $loop->first ? 'active' : '' }}">
                          <a href="#p-view-{{ $ph_lp }}" role="tab" data-toggle="tab">
                          <img src="{{ asset('public/product-photo/'.$prd_ph_data->prd_photo) }}" class="product-thumb-img" alt="productd"></a>
                      </li>
                   @php $ph_lp = $ph_lp+1; @endphp
                  @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="single-product-content-view">
            <div class="product-info">
              <h1>{{ $prd_det->product_name }}</h1>
              <p class="rating-links"><b>Model</b> : {{ $prd_det->product_model }}</p>
              <div class="quick-desc">{!! $prd_det->product_details !!}</div>
              
              <div class="price-box">
                  <p class="price"><span class="special-price"><span class="amount">&pound; {{ number_format($prd_det->product_price,2,'.','') }}</span></span></p>
              </div>
            </div>
            
           {{ Form::open(array('url' => 'order-process', 'role' => 'form', 'class' =>'cart', 'name' => 'frm_prd_dtls', 'id' => 'frm_prd_dtls','files'=>false, 'autocomplete' => 'off','onsubmit' => 'return validateProductDetails();')) }}
           
            {!! Form::hidden('prd_id',$prd_det->prd_id, array('id' => 'prd_id')) !!}
            {!! Form::hidden('prd_slug',$prd_det->prd_slug_name, array('id' => 'prd_slug')) !!}
            {!! Form::hidden('weekly_paid_app','', array('id' => 'weekly_paid_app')) !!}
            
            {!! Form::hidden('prd_price_week_calc',number_format($prd_det->product_price,2,'.',''), array('id' => 'prd_price_week_calc')) !!}
            
            {!! Form::hidden('dp_week_calc',number_format($down_payment,2,'.',''), array('id' => 'dp_week_calc')) !!}
            
            <div class="">
              <div class="product-select product-color">
                <h2>Number of Installments<sup>*</sup></h2>
                {!! Form::select('ips',$prd_ips_det,old('ips'),array('id' => 'ips','','class'=>'form-control','default' => '','onchange' => 'showWeeklyPrice()')) !!}
              </div>
              
              <span class="product-installment" id="wee_paid"></span>
                  
              <div class="product-select product-color">
                <h2>Initial Payment ( {{ $prd_det->product_dp_per }} % ) :
                <span class="down-payment">&pound; {{ $down_payment }}</span></h2>
              </div>
                  
              <div class="quick-add-to-cart">
                <div class="product-actions">
                  @if(Session::get('user_id')!="")
                  {{ Form::submit('Check Out', array('id'=>'btn_submit','class' => 'btn btn2 fa fa-credit-card')) }}
                  @endif
                  
                  @if(Session::get('user_id')=="")
                  <a class="fancybox btn btn2" href="javascript:void('0');"  onclick="showLogin();" title="User Login"><i class="fa fa-sign-in"></i> Login to Buy This Product</a>
                  @endif
                </div>
              </div>
            </div>
            {{ Form:: close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="login-loading-image" class="load-img"><img src="{{ asset('public/images/ajax-loader.gif') }}"></div>
@stop 

