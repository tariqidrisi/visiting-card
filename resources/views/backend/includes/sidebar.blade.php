{{--{{ getCompany()  }}--}}
<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('img/logo-small.png') }}">
            </div>
            <!-- <p>CT</p> -->
        </a>
        <a href="/" class="simple-text logo-normal">
            Administrator
            <!-- <div class="logo-image-big">
              <img src="../assets/img/logo-big.png">
            </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="@if(Route::is('dashboard') ) active @endif">
                <a href="{{ url("/dashboard")  }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="@if(Route::is('company') || Route::is('new-company') ||
                    (strpos(Route::currentRouteName(), 'view-company') === 0) ) active @endif">
                <a href="{{ url('/company') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Company / Entity</p>
                </a>
            </li>
            <li class="@if(Route::is('customer-information') || Route::is('new-customer-info') ||
                    (strpos(Route::currentRouteName(), 'view-customer') === 0) || (strpos(Route::currentRouteName(), 'update-customer') === 0) ) active @endif">
                <a href="{{ url('/customer-information') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Add Information</p>
                </a>
            </li>

            <li class="@if(Route::is('social-media') ) active @endif" id="social-media">
                <a href="{{ url('/social-media') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Social Media</p>
                </a>
            </li>

            <li class="@if(Route::is('embed-video') ) active @endif" id="embed-video">
                <a href="{{ url('/embed-video') }}">
                    <i class="nc-icon nc-button-play"></i>
                    <p>Embed Video</p>
                </a>
            </li>
{{--            <li class="active-pro">--}}
{{--                <a href="{{ url('/logout') }}">--}}
{{--                    <i class="nc-icon nc-spaceship"></i>--}}
{{--                    <p>Log Out</p>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
