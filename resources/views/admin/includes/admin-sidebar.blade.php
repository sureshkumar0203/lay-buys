<div id="sidebar" class="sidebar-fixed">
	<div id="sidebar-content">
      <ul id="nav">
        <li class="current">
            <a href="javascript:void(0);"> <i class="fa fa-text-width"></i> CMS </a>
            <ul class="sub-menu">
              <li><a href="{{ URL::to('administrator/manage-contents') }}" style="margin-left:3px;"> <i class="fa fa-file-text"></i> Manage Contents </a></li>
              
               <li><a href="{{ URL::to('administrator/manage-banners') }}" style="margin-left:3px;"> <i class="fa fa-picture-o"></i> Manage Banners </a></li>
            </ul>
        </li>
        
         <li class="current">
            <a href="javascript:void(0);"> <i class="fa fa-product-hunt"></i> Product Management </a>
            <ul class="sub-menu">
              <li><a href="{{ URL::to('administrator/manage-category') }}" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Category </a></li>
              <li><a href="{{ URL::to('administrator/manage-subcategory') }}" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Subcategory </a></li>
              <li><a href="{{ URL::to('administrator/manage-product') }}" style="margin-left:3px;"> <i class="fa fa-product-hunt"></i> Manage Product </a></li>
              
            <!--  <li><a href="{{ URL::to('administrator/manage-coupon-code') }}" style="margin-left:3px;"> <i class="fa fa-connectdevelop"></i> Manage Coupon Code </a></li>
              
               <li><a href="{{ URL::to('administrator/manage-shipping-price') }}" style="margin-left:3px;"> <i class="fa fa-connectdevelop"></i> Manage Shipping Price </a></li>
              
              <li><a href="{{ URL::to('administrator/manage-products') }}" style="margin-left:3px;"> <i class="fa fa-connectdevelop"></i> Manage Products </a></li>-->

            </ul>
        </li>
        
       <li class="current">
            <a href="javascript:void(0);"> <i class="fa fa-product-hunt"></i> Customer Management </a>
            <ul class="sub-menu">
              <li><a href="{{ URL::to('administrator/manage-users') }}" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Users </a></li>
               <li><a href="{{ URL::to('administrator/manage-orders') }}" style="margin-left:3px;"> <i class="fa fa-connectdevelop"></i> Manage Orders </a></li> 
            </ul>
        </li>
        
        <li class="current">
          <a href="javascript:void(0);"> <i class="fa fa-cog"></i> Settings  </a>
          <ul class="sub-menu">
              <li><a href="{{ URL::to('administrator/my-account') }}"> <i class="fa fa-user"></i>&nbsp;My Accounts </a></li>
              <li><a href="{{ URL::to('administrator/change-password-admin') }}"><i class="fa fa-key"></i>Change Password </a></li>
               <li><a href="{{ URL::to('administrator/manage-seo') }}"> <i class="fa fa-search"></i>&nbsp;Manage Seo </a></li>
               <li><a href="{{ URL::to('administrator/payment-setting') }}"> <i class="fa fa-money"></i>&nbsp;Payment Settings </a></li>
              <li><a href="{{ URL::to('administrator/logout') }}"> <i class="fa fa-sign-out"></i> Logout </a></li>
          </ul>
        </li>
        
      </ul>
    </div>
    <div id="divider" class="resizeable"></div>
</div>