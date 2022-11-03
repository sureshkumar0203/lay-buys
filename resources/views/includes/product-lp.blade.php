<div class="left-sidebar">
  <div class="shop-layout">
    <div class="layout-title">
        <h2>{{ $cat_det[0]->category_name }} </h2>
        <?php //echo "<pre>";print_r($sub_cat_det); exit;?>
    </div>
    <div class="layout-list">
        <ul>
        	@foreach($sub_cat_det as $sub_cat_dtls)
            <li class="@if($sub_cat_id_selected==$sub_cat_dtls->sub_cat_id) product-active @endif"><a href="{{ url('/') }}/subcategory/{{ $sub_cat_dtls->category_slug }}-{{ $sub_cat_dtls->cat_id }}/{{ $sub_cat_dtls->sub_cat_slug }}-{{ $sub_cat_dtls->sub_cat_id }}">{{ $sub_cat_dtls->sub_cat_name }} </a></li>
            @endforeach
        </ul>
    </div>
  </div>
</div>