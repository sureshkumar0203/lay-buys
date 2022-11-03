@php $cms_det = Helpers::cmsPages();  @endphp
<div class="container-fluid">                
  <div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2">                
      <ul class="list-inline list-unstyled">
        <li class="text-center"><a href="{{ url('/') }}" ><strong>Home</strong></a></li>
        <li class="text-center"><a href="{{ url('/') }}/contact-us">Contact Us</a></li>
        @foreach ($cms_det as $pagename)
        <li class="text-center"><a href="{{ url('/') }}/cms/{{ $pagename->slug }}">{{ $pagename->page_title }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12 col-md-12 ">                
      <div class="text-center">
      <p>© {{ date('Y') }} Lay-Buys ( Address : {{ $admin_det[0]->address }}.  Email : {{ $admin_det[0]->alt_email }}. Contact No : {{ $admin_det[0]->contact_no }}. Mobile No : {{ $admin_det[0]->mobile_no }})</p>
      </div>
    </div>
  </div>
     
  <div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2">                
      <div class="text-center"><img src="{{ asset('public/img/logo/payment.png') }}" class="img-responsive center-block" alt="Verified"></div>
    </div>
  </div>
</div>

  
  
 