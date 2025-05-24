@extends('frontend.layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ uploaded_asset($page->image1) }}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $page->getTranslation('title', $lang) }}</h1>
                </div>
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <i class="fa-regular fa-slash-forward"></i>
                    </li>
                    <li>
                        About Us
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section S T A R T -->
    <div class="wcu-section section-padding fix pb-40 sm-bg-sec-bl">
        <div class="container">
            <div class="wcu-wrapper style3">
                <div class="row gy-5 gy-64 d-flex align-items-center">

                    <div class="col-xl-6 col-lg-6">
                        <div class="wcu-content">
                            <div class="section-title">
                                <span class="subtitle wow fadeInUp">{{ $page->getTranslation('title1', $lang) }}</span>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    {{ $page->getTranslation('sub_title', $lang) }}</h2>
                            </div>

                            <p class="text fs-4 wow fadeInUp text-dark" data-wow-delay=".5s">
                                {!! $page->getTranslation('content', $lang) !!}
                            </p>

                            <div class="d-flex gap-4">
                                <div class="counter-box text-dark">
                                    <h2><span class="counter-numbers ">{{ $page->getTranslation('title2', $lang) }}</span>
                                    </h2>
                                    <p>{{ $page->getTranslation('title3', $lang) }}</p>
                                </div>

                                <div class="counter-box text-dark">
                                    <h2><span class="counter-numbers">{{ $page->getTranslation('heading1', $lang) }}</span>
                                    </h2>
                                    <p>{{ $page->getTranslation('heading2', $lang) }}</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="wcu-thumb">
                            <div class="thumb1 bg-cover">
                                <img src="{{ uploaded_asset($page->image2) }}" alt="thumb"
                                    class="wow w-100 img-custom-anim-left">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Service Section S T A R T -->
    <section class="service-section section-padding  fix sm-bg-sec-rd">
        <div class="service-container-wrapper style3">
            <div class="container">
                <div class="service-wrapper style3">
                    <div class="row g-4">
                        <div class="col-xl-5 col-lg-6">
                            <div class="service-content">
                                <div class="section-title">
                                    <span class="subtitle wow fadeInUp"><img
                                            src="{{ asset('assets/img/subTitleIcon.svg') }}"
                                            alt="icon">{{ $page->getTranslation('heading3', $lang) }}</span>
                                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                        {{ $page->getTranslation('heading4', $lang) }}
                                    </h2>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="service-cards-wrapper">
                                <div class="row gy-5 gx-60">
                                    <p class="text fs-4 wow fadeInUp text-dark" data-wow-delay=".5s">
                                        {!! $page->getTranslation('content1', $lang) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Video Section -->
    <section class="video-section fix sm-bg-sec">
        <div class="video-container-wrapper style4" data-bg-src="{{ uploaded_asset($page->image3) }}">
            <div class="container">
                <div class="video-wrapper style4">
                    <div class="video-wrap rounded-0">
                        <a href="{{ $page->getTranslation('heading6', $lang) }}" class="play-btn popup-video">
                            <i class="fa-duotone fa-play"></i>
                            <img class="playerImg" src="{{ asset('assets/img/videoPlayShape4_1.png') }}" alt="icon">
                        </a>
                    </div>
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ $page->getTranslation('heading5', $lang) }}</h2>
                </div>
            </div>
        </div>
    </section>


    <section id="partners">
        <div class="container">
            <div class="partners-content">
                <!-- Left Content -->
                <div class="partners-text animate__animated animate__fadeInLeft">
                    <span class="partners-subtitle">{{ $page->getTranslation('heading7', $lang) }}</span>
                    <h2 class="partners-title">
                        {!! $page->getTranslation('heading8', $lang) !!}
                    </h2>
                    <p class="partners-description">
                        {!! $page->getTranslation('content2', $lang) !!}
                    </p>
                </div>

                <!-- Right Video Section -->
                <div class="video-thumbnail animate__animated animate__fadeInRight">
                    <img src="{{ uploaded_asset($page->image4) }}" alt="Video Thumbnail">
                    <button class="play-button" onclick="openVideoPopup()">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11" stroke="white" stroke-width="2" />
                            <polygon points="9,7 9,17 17,12" fill="white" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Video Modal Popup -->
            <div id="video-popup" class="video-modal animate__animated animate__fadeIn">
                <div class="video-container">
                    <span class="close-video" onclick="closeVideoPopup()">&times;</span>
                    <iframe id="video-frame" src="{{ $page->getTranslation('heading9', $lang) }}" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Clients Logo Slider -->
            <div class="client-logos">
                <div class="swiper client-slider animate__animated animate__fadeInUp">
                    <div class="swiper-wrapper">
                        @if (!empty($brands))
                            @foreach ($brands as $brand)
                                <div class="swiper-slide"><img
                                        src="{{ uploaded_asset($brand->getTranslation('logo', $lang)) }}"
                                        alt="{{ $brand->getTranslation('name', $lang) }}"></div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section id="mission-vision" class="sm-bg-sec">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">{{ $page->getTranslation('heading10', $lang) }}</span>
                <h2 class="section-title">{{ $page->getTranslation('heading11', $lang) }}</h2>
            </div>

            <div class="row">
                <!-- Mission -->
                <div class="col-lg-6">
                    <div class="info-card wow fadeInLeft" data-wow-delay=".2s">
                        <div class="icon">
                            <img src="{{ asset('assets/images/mission.svg') }}" alt="Mission">
                        </div>
                        <h3 class="title">{{ $page->getTranslation('heading12', $lang) }}</h3>
                        <p class="text">
                            {!! $page->getTranslation('content3', $lang) !!}
                        </p>
                    </div>
                </div>

                <!-- Vision -->
                <div class="col-lg-6">
                    <div class="info-card wow fadeInRight" data-wow-delay=".4s">
                        <div class="icon">
                            <img src="{{ asset('assets/images/vision.svg') }}" alt="Vision">
                        </div>
                        <h3 class="title">{{ $page->getTranslation('heading13', $lang) }}</h3>
                        <p class="text">
                            {!! $page->getTranslation('content4', $lang) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="our-values" class="sm-bg-sec-bl">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">{{ $page->getTranslation('heading14', $lang) }}</span>
                <h2 class="section-title">{{ $page->getTranslation('heading15', $lang) }}</h2>
            </div>

            <div class="values-wrapper">
                @php
                    $content5 = $page->getTranslation('content5', $lang);
                    $points = $content5 != 'null' && $content5 != null ? json_decode($content5, true) : [];
                @endphp

                @for ($i = 0; $i < 5; $i++)
                    @php
                        if ($i == 0) {
                            $delay = '.2s';
                            $icon = 'fa-solid fa-lightbulb';
                        } elseif ($i == 1) {
                            $delay = '.4s';
                            $icon = 'fa-solid fa-check-circle';
                        } elseif ($i == 2) {
                            $delay = '.6s';
                            $icon = 'fa-solid fa-user';
                        } elseif ($i == 3) {
                            $delay = '.8s';
                            $icon = 'fa-solid fa-handshake';
                        } elseif ($i == 4) {
                            $delay = '1s';
                            $icon = 'fa-solid fa-lock';
                        }
                    @endphp
                    <div class="value-card wow fadeInUp" data-wow-delay="{{ $delay }}">
                        <div class="value-icon">
                            <i class="{{ $icon }}"></i>
                        </div>
                        <div class="value-content">
                            <h4>{!! $points[$i]['title'] ?? '' !!}</h4>
                            <p>{!! $points[$i]['sub_title'] ?? '' !!}</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <section id="cta-section">
        <div class="cta-container">
            <!-- Background Image -->
            <div class="cta-bg">
                <img src="{{ asset('assets/images/cta-background.jpg') }}" alt="CTA Background">
            </div>

            <!-- Text Content -->
            <div class="cta-content">
                <h2 class="animate__animated animate__fadeInDown">
                    {!! $page->getTranslation('heading16', $lang) !!}
                </h2>
                <a href="{{ route('services.index') }}"
                    class="cta-button animate__animated animate__fadeInUp animate__delay-1s">
                    {{ $page->getTranslation('heading17', $lang) }}
                </a>
            </div>
        </div>
    </section>
@endsection
