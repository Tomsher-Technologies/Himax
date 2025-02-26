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
                            <a href="index.html">
                                <img src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="logo-img">
                            </a>
                        </div>
                        <div class="footer-content">
                            <p>
                                {!! get_setting('about_us_description', null, $lang) !!}
                            </p>
                            <div class="social-icon d-flex align-items-center">
                                <a href="{{ get_setting('facebook_link') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
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
                                <a href="about.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="service.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Our Services
                                </a>
                            </li>
                            <li>
                                <a href="blog.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Our Blogs
                                </a>
                            </li>
                            <li>
                                <a href="faq.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    FAQ's
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
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
                            <h3>Services</h3>
                        </div>
                        <ul class="list-area">
                            <li>
                                <a href="about.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Cloud Solutions
                                </a>
                            </li>
                            <li>
                                <a href="service.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Managed IT Services
                                </a>
                            </li>
                            <li>
                                <a href="blog.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Cybersecurity
                                </a>
                            </li>
                            <li>
                                <a href="faq.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    IT Consulting
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Industries We Serve</h3>
                        </div>
                        <ul class="list-area">
                            <li>
                                <a href="about.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Banking & Finance
                                </a>
                            </li>
                            <li>
                                <a href="service.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Healthcare
                                </a>
                            </li>
                            <li>
                                <a href="blog.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Education
                                </a>
                            </li>
                            <li>
                                <a href="faq.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Government
                                </a>
                            </li>

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
                    Designed by <a href="tomsher.com">tomsher</a>
                </p>

            </div>
        </div>
    </div>
</footer>
