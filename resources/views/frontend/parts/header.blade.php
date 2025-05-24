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
                            <img src="{{ uploaded_asset(get_setting('header_logo')) ?? asset('assets/images/logo.svg') }}"
                                alt="logo-img">
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
                    foreach ($phones as $ph) {
                        $phone .= '<a href="tel:' . $ph . '">' . $ph . '</a><br>';
                    }

                    $working_hours = explode('/', $pagedata->getTranslation('content2', env('DEFAULT_LANGUAGE')));
                    $hours = '';
                    foreach ($working_hours as $wh) {
                        $hours .= $wh . '<br>';
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
                        <a href="{{ get_setting('facebook_link') }}" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ get_setting('instagram_link') }}" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i
                                class="fab fa-linkedin-in"></i></a>

                        {{-- <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas__overlay"></div>


<header class="header-section-3">
    <div class="container">
        <div id="header-sticky" class="header-3 mb-5">

            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="header-logo">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) ?? asset('assets/images/logo.svg') }}"
                                alt="logo-img">
                        </a>
                        <a href="{{ route('home') }}" class="header-logo-2">
                            <img src="{{ uploaded_asset(get_setting('header_logo')) ?? asset('assets/images/logo.svg') }}"
                                alt="logo-img">
                        </a>
                    </div>

                    <div class="header-center d-flex justify-content-end align-items-center">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>

                                        <li
                                            class="has-dropdown {{ areActiveRoutes(['services.index', 'service-detail']) }} menu-thumb">
                                            {{-- {{ route('services.index') }} --}}
                                            <a href="{{ route('services.index') }}">
                                                Services & Solutions

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
                                                                        <div class="solution-item"
                                                                            style="background-image: url({{ uploaded_asset($hserv->image) }});">
                                                                            {{-- {{ route('service-detail',['slug' => $hserv->slug]) }} --}}
                                                                            <a
                                                                                href="{{ route('service-detail', ['slug' => $hserv->slug]) }}">
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
                                        <li id="product-menu"
                                            class="has-dropdown {{ areActiveRoutes(['products.index', 'product-detail']) }} menu-thumb">
                                            <a href="{{ route('products.index') }}">
                                                Product Categories
                                                <i class="fa-regular fa-plus"></i>

                                            </a>
                                            {{-- {{ route('products.index') }} --}}
                                            <ul class="submenu has-homemenu">
                                                <li class="menu-container">
                                                    @php
                                                        $menus = getMenu();
                                                    @endphp
                                                    <!-- Left Tabs -->
                                                    <div class="menu-tabs">
                                                        @foreach ($menus as $index => $menu)
                                                            <button class="menu-tab {{ $index == 0 ? 'active' : '' }}"
                                                                data-target="menutab_{{ $index }}">{{ $menu->title }}</button>
                                                        @endforeach
                                                    </div>

                                                    <!-- Right Content -->
                                                    <div class="menu-content">
                                                        @foreach ($menus as $index => $menu)
                                                            <!-- SECURITY & SURVEILLANCE -->
                                                            <div id="menutab_{{ $index }}"
                                                                class="menu-category-content {{ $index == 0 ? 'active' : '' }}">
                                                                <h4 class="menu-title">{{ strtoupper($menu->title) }}
                                                                </h4>

                                                                <ul class="brand-list">
                                                                    @foreach ($menu->subMenus as $subM)
                                                                        <li><a
                                                                                href="{{ $subM->link ?? '#' }}">{{ $subM->title }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </li>
                                            </ul>
                                        </li>

                                        {{-- <li>
                                            <a href="{{ route('products.index') }}">Products</a>
                                        </li> --}}

                                        <li class="{{ areActiveRoutes(['about_us']) }}">

                                            <a href="{{ route('about_us') }}">About Us</a>
                                        </li>
                                        <li class="{{ areActiveRoutes(['contact']) }}">

                                            <a href="{{ route('contact') }}">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="header-right d-flex justify-content-end align-items-center">
                        <div class="header-button">

                            <a href="tel:{{ get_setting('main_contact_number') }}" class="theme-btn"><i
                                    class="fa-light fa-phone me-2"></i> {{ get_setting('main_contact_number') }}</a>
                            <!--    <a href="{{ route('contact') }}" class="theme-btn"><i-->
                            <!--class="fa-light fa-phone me-2"></i> {{ get_setting('main_contact_number') }}</a>-->
                        </div>
                        <!-- <div class="header__hamburger d-xl-block my-auto">
                            <div class="sidebar__toggle">
                                <div class="header-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div> -->
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
