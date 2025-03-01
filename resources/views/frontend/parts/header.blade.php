@php
    $lang = getActiveLanguage();
@endphp


<!-- Offcanvas Area Start -->
<div class="fix-area">
    <div class="offcanvas__info">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) ?? asset('assets/images/logo.svg') }}" alt="logo-img">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                @php
                    $pagedata = getPageData('contact_us');

                    $phones = explode('/', $pagedata->getTranslation('content1', env('DEFAULT_LANGUAGE')));
                    $phone = '';
                    foreach($phones as $ph){
                        $phone .= '<a href="tel:'.$ph.'">'.$ph .'</a><br>';
                    }

                    $working_hours = explode('/', $pagedata->getTranslation('content2', env('DEFAULT_LANGUAGE')));
                    $hours = '';
                    foreach($working_hours as $wh){
                        $hours .= $wh .'<br>';
                    }
                @endphp

                <div class="mobile-menu fix mb-3"></div>
                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">{!! $pagedata->getTranslation('content', env('DEFAULT_LANGUAGE')) !!}</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="mailto:{{ $pagedata->getTranslation('heading1', env('DEFAULT_LANGUAGE')) }}">
                                    <span class="">
                                        <span class="__cf_email__" data-cfemail="b1d8dfd7def1d4c9d0dcc1ddd49fd2dedc">
                                            {{ $pagedata->getTranslation('heading1', env('DEFAULT_LANGUAGE')) }}
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-clock"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">{!! $hours !!}</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                {!! $phone !!}
                            </div>
                        </li>
                    </ul>
                    <div class="header-button mt-4">

                    </div>
                    {{-- <div class="main-button">
                        <a href="contact.html" class="theme-btn w-100 text-center">
                            Get Started <i class="fa-sharp fa-regular fa-arrow-up-right"></i>
                        </a>
                    </div> --}}
                    <div class="social-icon d-flex align-items-center">
                        {{-- <a href="{{ get_setting('facebook_link') }}" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ get_setting('instagram_link') }}" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i
                                class="fab fa-linkedin-in"></i></a> --}}

                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas__overlay"></div>


<header class="header-section-3">
    <div id="header-sticky" class="header-3 mb-5">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="header-logo">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) ?? asset('assets/images/logo.svg') }}" alt="logo-img">
                        </a>
                        <a href="{{ route('home') }}" class="header-logo-2">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) ?? asset('assets/images/logo.svg') }}" alt="logo-img">
                        </a>
                    </div>

                    <div class="header-center d-flex justify-content-end align-items-center">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>

                                        <li class="has-dropdown active menu-thumb">
                                            {{-- {{ route('services.index') }} --}}
                                            <a href="#">
                                                SERVICES & SOLUTIONS

                                                <i class="fa-regular fa-plus"></i>
                                            </a>
                                            <ul class="submenu has-homemenu">
                                                <li>
                                                    <div class="homemenu-items">
                                                        <div class="solutions-grid">

                                                            <div class="solutions-wrapper">
                                                                @php
                                                                    $header_services = headerServices();
                                                                @endphp

                                                                @if (!empty($header_services))
                                                                    @foreach ($header_services as $hserv)
                                                    
                                                                        <div class="solution-item" style="background-image: url({{ uploaded_asset($hserv->image) }});">
                                                                            {{-- {{ route('service-detail',['slug' => $hserv->slug]) }} --}}
                                                                            <a href="#">
                                                                                {{ $hserv->getTranslation('name', env('DEFAULT_LANGUAGE')) }}
                                                                            </a>
                                                                        </div>

                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                        <!-- Mega Menu -->
                                        <li id="product-menu" class="has-dropdown active menu-thumb">
                                            <a href="#">PRODUCT CATEGORIES</a>
                                            {{-- {{ route('products.index') }} --}}
                                            <ul class="submenu has-homemenu">
                                                <li class="menu-container">

                                                    <!-- Left Tabs -->
                                                    <div class="menu-tabs">
                                                        <button class="menu-tab active" data-target="ict">ICT</button>
                                                        <button class="menu-tab"
                                                            data-target="networking">NETWORKING</button>
                                                        <button class="menu-tab" data-target="security">SECURITY &
                                                            SURVEILLANCE</button>
                                                        <button class="menu-tab" data-target="fire">FIRE
                                                            SAFETY</button>
                                                        <button class="menu-tab"
                                                            data-target="electronics">ELECTRONICS</button>
                                                    </div>

                                                    <!-- Right Content -->
                                                    <div class="menu-content">

                                                        <!-- ICT Section (Grid Layout) -->
                                                        <div id="ict" class="menu-category-content active">
                                                            {{-- <a href="{{ route('products.index',['category' =>'ict']) }}"> --}}
                                                                <h4 class="menu-title"> ICT </h4>
                                                            {{-- </a> --}}

                                                            <div class="ict-grid">
                                                                <div class="menu-category">
                                                                    {{-- <a href="{{ route('products.index',['category' =>'telecommunication']) }}"> --}}
                                                                        <h5>Telecommunication</h5>
                                                                    {{-- </a> --}}
                                                                    <ul>
                                                                        {{-- {{ route('products.index',['brand' =>'grandstream']) }} --}}
                                                                        <li><a href="#">Grandstream</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'avaya']) }} --}}
                                                                        <li><a href="#">Avaya</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'logitech']) }} --}}
                                                                        <li><a href="#">Logitech</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'yealink']) }} --}}
                                                                        <li><a href="#">Yealink</a></li>
                                                                    </ul>
                                                                </div>

                                                                <div class="menu-category">
                                                                    {{-- {{ route('products.index',['category' =>'computer-hardware']) }} --}}
                                                                    <a href="#">
                                                                        <h5>Computer & Hardware</h5>
                                                                    </a>
                                                                    <ul>
                                                                        {{-- {{ route('products.index',['brand' =>'dell']) }} --}}
                                                                        <li><a href="#">Dell</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'hp']) }} --}}
                                                                        <li><a href="#">HP</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'lenovo']) }} --}}
                                                                        <li><a href="#">Lenovo</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'epson']) }} --}}
                                                                        <li><a href="#">Epson</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'canon']) }} --}}
                                                                        <li><a href="#">Canon</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'toshiba']) }} --}}
                                                                        <li><a href="#">Toshiba</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'logitech']) }} --}}
                                                                        <li><a href="#">Logitech</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'hpe']) }} --}}
                                                                        <li><a href="#">HPE</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'dell-emc']) }} --}}
                                                                        <li><a href="#">Dell EMC</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'wd']) }} --}}
                                                                        <li><a href="#">WD</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'dseagate']) }} --}}
                                                                        <li><a href="#">Dseagate</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'qnap']) }} --}}
                                                                        <li><a href="#">Qnap</a></li>
                                                                    </ul>
                                                                </div>

                                                                <div class="menu-category">
                                                                    {{-- {{ route('products.index',['category' =>'software']) }} --}}
                                                                    <a href="#">
                                                                        <h5>Software</h5>
                                                                    </a>
                                                                   
                                                                    <ul>
                                                                        {{-- {{ route('products.index',['brand' =>'microsoft']) }} --}}
                                                                        <li><a href="#">Microsoft</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'kaspersky']) }} --}}
                                                                        <li><a href="#">Kaspersky</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'sophos']) }} --}}
                                                                        <li><a href="#">Sophos</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'adobe']) }} --}}
                                                                        <li><a href="#">Adobe</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'vmware']) }} --}}
                                                                        <li><a href="#">VMware</a></li>
                                                                        {{-- {{ route('products.index',['brand' =>'esset']) }} --}}
                                                                        <li><a href="#">Esset</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- NETWORKING Section -->
                                                        <div id="networking" class="menu-category-content">
                                                            {{-- {{ route('products.index',['category' =>'networking']) }} --}}
                                                            <a href="#">
                                                                <h4 class="menu-title">NETWORKING</h4>
                                                            </a>
                                                            <ul class="brand-list">
                                                                {{-- {{ route('products.index',['brand' =>'cisco']) }} --}}
                                                                <li><a href="#">Cisco</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'sophos']) }} --}}
                                                                <li><a href="#">Sophos</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'fortigate']) }} --}}
                                                                <li><a href="#">Fortigate</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'tp-link']) }} --}}
                                                                <li><a href="#">TP-Link</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'juniper']) }} --}}
                                                                <li><a href="#">Juniper</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'aruba']) }} --}}
                                                                <li><a href="#">Aruba</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'huawei']) }} --}}
                                                                <li><a href="#">Huawei</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'ubiquiti']) }} --}}
                                                                <li><a href="#">Ubiquiti</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'mikrotik']) }} --}}
                                                                <li><a href="#">Mikrotik</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'ruckus']) }} --}}
                                                                <li><a href="#">Ruckus</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'sonicwall']) }} --}}
                                                                <li><a href="#">Sonicwall</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'Watchguard']) }} --}}
                                                                <li><a href="#">watchguard</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'Grandstream']) }} --}}
                                                                <li><a href="#">grandstream</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'hikvision']) }} --}}
                                                                <li><a href="#">Hikvision</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'d-link']) }} --}}
                                                                <li><a href="#">D Link</a></li>
                                                            </ul>
                                                        </div>

                                                        <!-- SECURITY & SURVEILLANCE -->
                                                        <div id="security" class="menu-category-content">
                                                            {{-- {{ route('products.index',['category' =>'security-surveillance']) }} --}}
                                                            <a href="#">
                                                                <h4 class="menu-title">SECURITY & SURVEILLANCE</h4>
                                                            </a>
                                                            <ul class="brand-list">
                                                                {{-- {{ route('products.index',['brand' =>'hikvision']) }} --}}
                                                                <li><a href="#">Hikvision</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'ajax']) }} --}}
                                                                <li><a href="#">Ajax</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'ezviz']) }} --}}
                                                                <li><a href="#">EZVIZ</a></li>
                                                            </ul>
                                                        </div>

                                                        <!-- FIRE SAFETY -->
                                                        <div id="fire" class="menu-category-content">
                                                            {{-- {{ route('products.index',['category' =>'fire-safety']) }} --}}
                                                            <a href="#">
                                                                <h4 class="menu-title">FIRE SAFETY</h4>
                                                            </a>
                                                            <ul class="brand-list">
                                                                {{-- {{ route('products.index',['brand' =>'asenware']) }} --}}
                                                                <li><a href="#">Asenware</a></li>
                                                                {{-- {{ route('products.index',['brand' =>'fireX']) }} --}}
                                                                <li><a href="#">FireX</a></li>
                                                            </ul>
                                                        </div>

                                                        <!-- ELECTRONICS -->
                                                        <div id="electronics" class="menu-category-content">
                                                            {{-- {{ route('products.index',['category' =>'electronics']) }} --}}
                                                            <a href="#">
                                                                <h4 class="menu-title">ELECTRONICS</h4>
                                                            </a>
                                                            <ul class="brand-list">
                                                                {{-- {{ route('products.index',['category' =>'mobile-phones']) }} --}}
                                                                <li><a href="#">Mobile Phones</a></li>
                                                                {{-- {{ route('products.index',['category' =>'tablets']) }} --}}
                                                                <li><a href="#">Tablets</a></li>
                                                                {{-- {{ route('products.index',['category' =>'tv']) }} --}}
                                                                <li><a href="#">TV</a></li>
                                                                {{-- {{ route('products.index',['category' =>'projectors']) }} --}}
                                                                <li><a href="#">Projectors</a></li>
                                                                {{-- {{ route('products.index',['category' =>'headsets-speakers']) }} --}}
                                                                <li><a href="#">Headsets & Speakers</a></li>
                                                                {{-- {{ route('products.index',['category' =>'soundbars']) }} --}}
                                                                <li><a href="#">Soundbars</a></li>
                                                                {{-- {{ route('products.index',['category' =>'streaming-devices']) }} --}}
                                                                <li><a href="#">Streaming Devices</a></li>
                                                                {{-- {{ route('products.index',['category' =>'gaming-consoles']) }} --}}
                                                                <li><a href="#">Gaming Consoles</a></li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </li>
                                            </ul>
                                        </li>

                                        {{-- <li>
                                            <a href="{{ route('products.index') }}">Products</a>
                                        </li> --}}

                                        <li>
                                            {{-- {{ route('about_us') }} --}}
                                            <a href="#">About Us</a>
                                        </li>
                                        <li>
                                            {{-- {{ route('contact') }} --}}
                                            <a href="#">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>

                    <div class="header-right d-flex justify-content-end align-items-center">

                        <div class="header-button">
                            {{-- {{ route('contact') }} --}}
                            <a href="#" class="theme-btn"><i
                                    class="fa-sharp fa-regular fa-arrow-up-right"></i> {{ get_setting('main_contact_number') }}</a>
                        </div>

                        <div class="header__hamburger d-xl-block my-auto">
                            <div class="sidebar__toggle">
                                <div class="header-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Search Area Start -->
<div class="search-wrap">
    <div class="search-inner">
        <i class="fas fa-times search-close" id="search-close"></i>
        <div class="search-cell">
            <form method="get">
                <div class="search-field-holder">
                    <input type="search" class="main-search-input" placeholder="Search...">
                </div>
            </form>
        </div>
    </div>
</div>
