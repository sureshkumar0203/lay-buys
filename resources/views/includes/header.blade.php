<div class="header-area">
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-top-bar">
            <div class="row">
              <div class="col-md-5">
                <div class="header-top-left">
                  <!--<div class="call-header">
                  	<p><i class="fa fa-phone"></i>Call us toll free: <span> {{ $admin_det[0]->contact_no }}
                    </span></p>
                  </div>-->
                  
                  @if(Session::get('user_id')=="")
                  <div class="header-login">
                  <a class="fancybox" href="javascript:void('0');"  onclick="showLogin();" title="User Login">Login</a></div>
                  <div class="header-register"><span class="spp">/</span></div>
                  <div class="header-register"><a href="{{url('/')}}/user-signup">Register</a></div>
                  @endif
                </div>
              </div>
              
              <div class="col-md-7">
                <div class="header-top-right">
                  <div class="header-link-area">
                    <div class="header-link">
                      @if(Session::get('user_id')!="")
                      <ul>
                        <li>
                          <a class="account" href="{{ url('/')}}/my-account">Account<i class="fa fa-angle-down"></i></a>
                          <ul>
                            <li><a href="{{ url('/')}}/my-account">My Account</a></li>
                            <li><a href="{{ url('/')}}/profile-settings">Profile Settings</a></li>
                            <li><a href="{{ url('/')}}/change-password">Change Password</a></li>
                            <li><a href="{{url('/')}}/user-logout">Logout</a></li>
                          </ul>
                        </li>
                      </ul>
                      @endif
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
  
  <div class="header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-bottom-inner">
            <div class="row">
              <div class="col-md-3">
                <div class="header-logo"><a href="{{url('/')}}"><img src="{{ asset('public/img/logo/logo.png') }}" alt="logo"></a></div>
              </div>
              
              <div class="col-md-9">
                <div class="header-bottom-right">
                  <div class="social-footer">
                    <ul class="link-follow">
                      
                      @if($admin_det[0]->facebook_url!='')  
                      <li class="first"><a href="{{ $admin_det[0]->facebook_url }}" class="facebook fa fa-facebook" target="_blank"></a></li>
                      @endif
                      
                      @if($admin_det[0]->twitter_url!='')                   
                      <li><a href="{{ $admin_det[0]->twitter_url }}" class="twitter fa fa-twitter" target="_blank"></a></li>
                      @endif
                      
                      @if($admin_det[0]->linkedin_url!='')
                      <li><a href="{{ $admin_det[0]->linkedin_url }}" class="instagram fa fa-instagram" target="_blank"></a></li>
                      @endif
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