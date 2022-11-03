@php
$about_cms_page = Helpers::aboutCmsPages();
//echo "<pre>";print_r($_SERVER);
@endphp
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keywords')">
<meta name="description" content="@yield('description')">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- favicon -->		
<link rel="shortcut icon" type="image/x-icon" href="img/logo/favicon.ico">
<!-- Google Fonts-->		
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
<!-- Bootstrap CSS -->		
<link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
<!-- Mean Menu CSS-->      
<link rel="stylesheet" href="{{ asset('public/css/meanmenu.min.css') }}">
<!-- owl.carousel CSS -->
<link rel="stylesheet" href="{{ asset('public/css/owl.carousel.css') }}">
<!-- nivo-slider css --> 
<link rel="stylesheet" href="{{ asset('public/css/nivo-slider.css') }}">
<!-- Simple Lence css --> 
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.simpleLens.css') }}">

<!-- style CSS -->
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">   
</head>

<body>

<header>
	@include('includes.header')
</header>

<div class="main-menu-area home-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-3">
            <div class="category-menu hidden-xs hidden-sm">
              <div class="category-menu-title">
                  <h2>All Products</h2>
              </div>
              
              <div class="categorie-list">
                <ul>
                  @foreach($top_cat_info as $top_cat_det)
                  <li><a href="{{ url('/') }}/category/{{ $top_cat_det->category_slug }}-{{ $top_cat_det->cat_id }}"><img src="{{ asset('public/category-icon/'.$top_cat_det->category_icon) }}" alt="">{{ $top_cat_det->category_name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          
          <div class="col-md-9">
            <div class="main-menu hidden-xs hidden-sm">
              <nav>
                <ul>
                  <li><a href="{{ url('/') }}" class="@if($req_file_name=="/")active @endif">Home</a></li>
                  <li><a href="{{ url('/') }}/cms/{{ $about_cms_page->slug }}" class="@if($req_file_name=="about-us")active @endif">{{ $about_cms_page->page_title }}</a></li>
                  <li><a href="{{ url('/') }}/contact-us" class="@if($req_file_name=="contact-us")active @endif">Contact Us</a></li>
                </ul>
              </nav>
            </div>
            
            <div class="mobile-menu hidden-md hidden-lg">
              <nav>
                <ul>
                 @foreach($top_cat_info as $top_cat_det)
                  <li><a href="{{ url('/') }}/{{ $top_cat_det->category_slug }}-{{ $top_cat_det->cat_id }}">{{ $top_cat_det->category_name }}</a></li>   @endforeach
                  <li><a href="{{ url('/') }}" class="@if($req_file_name=="/")active @endif">Home</a></li>
                  <li><a href="{{ url('/') }}/cms/{{ $about_cms_page->slug }}" class="@if($req_file_name=="about-us")active @endif">{{ $about_cms_page->page_title }}</a></li>
                  <li><a href="{{ url('/') }}/contact-us" class="@if($req_file_name=="contact-us")active @endif">Contact Us</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

              
@yield('content')

<footer>			
	@include('includes.footer')
</footer>

 
<!-- jquery -->		
<script src="{{ asset('public/js/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('public/js/lay-buys-validation.js') }}"></script>

<!-- Add fancyBox main JS and CSS files -->
<link rel="stylesheet" href="{{ asset('public/css/jquery.fancybox.css?v=2.2.2') }}">
<script src="{{ asset('public/js/jquery.fancybox.js?v=2.2.1') }}"></script> 



<script>
$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});
</script> 
      
<!-- bootstrap JS-->		
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>

<!-- nivo slider js --> 
<script src="{{ asset('public/js/jquery.nivo.slider.pack.js') }}"></script>

<!-- Mean Menu js-->         
<script src="{{ asset('public/js/jquery.meanmenu.min.js') }}"></script>

<!-- Simple Lence JS -->
<script type="text/javascript" src="{{ asset('public/js/jquery.simpleGallery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/jquery.simpleLens.min.js') }}"></script>	

<!-- owl.carousel JS-->		
<script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>

<!-- scrollUp JS -->		
<script src="{{ asset('public/js/jquery.scrollUp.min.js') }}"></script>

<!-- main JS -->		
<script src="{{ asset('public/js/main.js') }}"></script>

<script src="{{ asset('public/js/password-validation.js') }}"></script>
</body>
</html>