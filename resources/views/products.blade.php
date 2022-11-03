@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="shop-product-area mt-50">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        @include('includes.product-lp')
      </div>
      
      <div class="col-md-9 col-sm-12">
        <div class="shop-product-view">
          <div class="product-tab-area">
            <div class="tab-content">
              <div class="tab-pane active">
                <div class="tab-single-product">
                  <ul class="product-page">
                    @foreach($prd_det as $prd_dtls)
                    <li class="singel-product single-product-col">
                      <div class="single-product-img">
                          <a href="{{ url('/') }}/product-details/{{ $prd_dtls->prd_slug_name }}-{{ $prd_dtls->prd_id }}"><img src="{{ asset('public/product-photo/'.$prd_dtls->prd_photo) }}" alt="{{ $prd_dtls->product_name }}"></a>
                      </div>
                      
                      <div class="single-product-content">
                        <h2 class="product-name">{{ str_limit(strip_tags($prd_dtls->product_name), 40) }}</h2>
                        <p class="product-model">{{ $prd_dtls->product_model }}</p>
                        <div class="product-price">
                            <p>&pound; {{ number_format($prd_dtls->product_price,2,'.','') }}</p>
                        </div>
                         <div class="product-actions">
                         
                       <button class="button btn-cart" onclick="window.location.href='{{ url('/') }}/product-details/{{ $prd_dtls->prd_slug_name }}-{{ $prd_dtls->prd_id }}'" title="View Product Details" type="button">
                       <span>View Details</span>
                       </button>
                        </div>
                      </div>
                    </li>
                    @endforeach
                    </ul>
                </div>
               </div>
            </div>
            
            
            <nav aria-label="Page navigation example">
              <ul class="pagination pull-right">
              	<?php //echo $prd_dtls->links(); ?>
                <?php echo $prd_det->appends(request()->input())->render(); ?>
              </ul>
            </nav>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop 

