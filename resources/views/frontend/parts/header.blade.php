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
                        <a href="index.html">
                            <img src="assets/img/logo/black-logo.svg" alt="logo-img">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <p class="text d-none d-xl-block">
                    Nullam dignissim, ante scelerisque the is euismod fermentum odio sem semper the is erat, a
                    feugiat leo urna eget eros. Duis Aenean a imperdiet risus.
                </p>
                <div class="mobile-menu fix mb-3"></div>
                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">Main Street, Melbourne, Australia</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="/cdn-cgi/l/email-protection#d9b0b7bfb699bca1b8b4a9b5bcf7bab6b4"><span
                                        class="mailto:info@example.com"><span class="__cf_email__"
                                            data-cfemail="b1d8dfd7def1d4c9d0dcc1ddd49fd2dedc">[email&#160;protected]</span></span></a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-clock"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">Mod-friday, 09am -05pm</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="tel:+11002345909">+11002345909</a>
                            </div>
                        </li>
                    </ul>
                    <div class="header-button mt-4">

                    </div>
                    <div class="main-button">
                        <a href="contact.html" class="theme-btn w-100 text-center">
                            Get Started <i class="fa-sharp fa-regular fa-arrow-up-right"></i>
                        </a>
                    </div>
                    <div class="social-icon d-flex align-items-center">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas__overlay"></div>





<!-- Header Section Start -->
<header class="header-section-3">
 
    <div id="header-sticky" class="header-3 mb-5">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="index.html" class="header-logo">
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo-img">
                        </a>
                        <a href="index.html" class="header-logo-2">
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo-img">
                        </a>
                    </div>

                    <div class="header-center d-flex justify-content-end align-items-center">
                        <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>

                                        <li class="has-dropdown active menu-thumb">
                                            <a href="#">
                                                SERVICES & SOLUTIONS

                                                <i class="fa-regular fa-plus"></i>
                                            </a>
                                            <ul class="submenu has-homemenu">
                                                <li>
                                                    <div class="homemenu-items">
                                                        <div class="solutions-grid">

                                                            <div class="solutions-wrapper">
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">IP Telephony & PABX System</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">IT Outsourcing</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Backup & Data Protection</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">IT Maintenance & Integration</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Software Licensing</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Anti-Virus & Anti-SPAM
                                                                        Solutions</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Network Solutions</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Data Center</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">On-Site Support</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Network Installation &
                                                                        Troubleshooting</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Managed IT Services</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Reliable IT Annual Maintenance
                                                                        Service</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">CCTV Surveillance</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Fire Fighting Equipment</a>
                                                                </div>
                                                                <div class="solution-item"
                                                                    style="background-image: url({{asset('assets/images/solutions/backup.webp')}});">
                                                                    <a href="#">Fire Fighting Maintenance</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="has-dropdown active d-xl-none">
                                            <a href="index.html" class="border-none">
                                                Home
                                            </a>
                                            <ul class="submenu">
                                                <li><a href="index.html">Home 01</a></li>
                                                <li><a href="index2.html">Home 02</a></li>
                                                <li><a href="index3.html">Home 03</a></li>
                                                <li><a href="index4.html">Home 04</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="products.html">Products</a>
                                        </li>



                                        <li>
                                            <a href="about.html">About Us</a>
                                        </li>



                                        <li>
                                            <a href="contact.html">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>

                    <div class="header-right d-flex justify-content-end align-items-center">

                        <div class="header-button">
                            <a href="contact.html" class="theme-btn"><i
                                    class="fa-sharp fa-regular fa-arrow-up-right"></i> +250-788-315-949 </a>
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
