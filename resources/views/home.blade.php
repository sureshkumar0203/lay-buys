@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-slider-area home-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="main-slider">
          <div class="slider">
            <div id="mainSlider" class="nivoSlider slider-image">
              <?php //print_r($seo_info);exit;?>
              @foreach($banner_data as $banner_det)
              <img src="{{ asset('public/banners/'.$banner_det->banner_photo) }}" alt="">
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
              

<div class="top-banner-area">
  <div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="head-title"><p><a href="#">Latest Categories</a></p></div>
    </div>
     @foreach($latest_cat_data as $latest_cat_det)
      <div class="col-md-4 col-sm-4 mb35">
          <div class="single-banner">
            <a href="{{ url('/') }}/category/{{ $latest_cat_det->category_slug }}-{{ $latest_cat_det->cat_id }}"><img src="{{ asset('public/category-photo/thumb/'.$latest_cat_det->category_photo) }}" alt=""></a>
             <span  class="cat-title">{{ $latest_cat_det->category_name }}</span>
            <!-- <span  class="shop-now-btn"><i class="fa fa-sort-up shop-arrow" aria-hidden="true"></i> SHOP NOW</span>-->
          </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="product-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="product-view-area fix">
          <div class="single-product-category">
            <div class="head-title"><p><a href="#">Latest Products</a></p></div>
            <div class="shop-product-view">
              <div class="product-tab-area">
                <div class="tab-content">
                  <div class="tab-pane active" id="shop-product">
                    <div class="tab-single-product">
                      <ul>
                      @foreach($latest_prd_data as $latest_prd_det)
                      <li class="singel-product single-product-col">
                        <div class="single-product-img">
                        <a href="{{ url('/') }}/product-details/{{ $latest_prd_det->prd_slug_name }}-{{ $latest_prd_det->prd_id }}"><img src="{{ asset('public/product-photo/'.$latest_prd_det->prd_photo) }}" alt="{{ $latest_prd_det->product_name }}"></a>
                        </div>
                        
                        <div class="single-product-content">
                          <h2 class="product-name"><a title="Proin lectus ipsum" href="{{ url('/') }}/product-details-1">{{ str_limit(strip_tags($latest_prd_det->product_name), 48) }}</a></h2> 
                           
                          <div class="product-price"><p>&pound; {{ number_format($latest_prd_det->product_price,2,'.','') }}</p></div>
                          
                          <div class="product-actions">
                            <button class="button btn-cart" onClick="window.location.href='{{ url('/') }}/product-details/{{ $latest_prd_det->prd_slug_name }}-{{ $latest_prd_det->prd_id }}'" title="View Product Details" type="button">
                            
                            <span>View Details</span></button>
                          </div>
                        </div>
                      </li> 
                      @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop 

