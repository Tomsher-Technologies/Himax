@php
    $lang = getActiveLanguage();
@endphp
<footer class="footer-section">
    <div class="footer-widgets-wrapper footer-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="{{ route('home') }}">
                                <img src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="logo-img">
                            </a>
                        </div>
                        <div class="footer-content">
                            <p>
                                {!! get_setting('about_us_description', null, $lang) !!}
                            </p>
                            <div class="social-icon d-flex align-items-center">
                                {{-- {{ get_setting('facebook_link') }}
                                {{ get_setting('instagram_link') }}
                                {{ get_setting('twitter_link') }}
                                {{ get_setting('linkedin_link') }}
                                {{ get_setting('youtube_link') }} --}}
                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Quick Links</h3>
                        </div>
                        <ul class="list-area">
                            <li>
                                {{-- {{ route('about_us') }} --}}
                                <a href="#">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    About Us
                                </a>
                            </li>
                            <li>
                                {{-- {{ route('services.index') }} --}}
                                <a href="#">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Our Services
                                </a>
                            </li>
                            <li>
                                {{-- {{ route('products.index') }} --}}
                                <a href="#">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Our Products
                                </a>
                            </li>
                            <li>
                                {{-- {{ route('blogs.index') }} --}}
                                <a href="#">
                                    <i class="fa-solid fa-chevron-right"></i>
                                     Blogs
                                </a>
                            </li>
                            {{-- <li>
                                <a href="faq.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    FAQ's
                                </a>
                            </li> --}}
                            <li>
                                {{-- {{ route('contact') }} --}}
                                <a href="#">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>{{ get_setting('footer_services_title') }}</h3>
                        </div>
                        @php
                            $footer_services = footerServices();
                        @endphp
                        <ul class="list-area">
                            @if (!empty($footer_services))
                                @foreach ($footer_services as $fserv)
                                    <li>
                                        {{-- {{ route('service-detail',['slug' => $fserv->slug]) }} --}}
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            {{ $fserv->getTranslation('name', $lang) }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>{{ get_setting('footer_products_title') }}</h3>
                        </div>
                        <ul class="list-area">
                            @php
                                $footer_categories = footerCategories();
                            @endphp

                            @if (!empty($footer_categories))
                                @foreach ($footer_categories as $fcat)
                                    <li>
                                        {{-- {{ route('products.index',['category' => $fcat->getTranslation('slug', $lang)]) }} --}}
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            {{ $fcat->getTranslation('name', $lang) }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-wrapper d-flex align-items-center justify-content-between">
                <p class="wow fadeInLeft color-2" data-wow-delay=".3s">
                    © {{date('Y')}} {!! get_setting('frontend_copyright_text', null, $lang) !!}
                </p>

                <p class="wow fadeInLeft color-2 fadeInRight" data-wow-delay=".3s">
                    Designed by <a href="tomsher.com">Tomsher</a>
                </p>

            </div>
        </div>
    </div>
</footer>
