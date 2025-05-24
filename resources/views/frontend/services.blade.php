@extends('frontend.layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ uploaded_asset($page->image1) }}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $page->getTranslation('title', $lang) }}
                    </h1>

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
                        Services
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Service Listing Section -->
    <section id="services-listing">
        <div class="container">
            <div id="services-header">
                <h1 id="services-title">{{ $page->getTranslation('title1', $lang) }}</h1>
                <p id="services-subtitle">{{ $page->getTranslation('sub_title', $lang) }}</p>
            </div>

            <div class="row gy-4"> <!-- Added gy-4 for bottom gap -->

                @if (!empty($services[0]))
                    @foreach ($services as $pkey => $serv)
                        <!-- Service Cards -->
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card">
                                <a href="{{ route('service-detail', ['slug' => $serv->slug]) }}">
                                    <img src="{{ uploaded_asset($serv->image) }}" class="service-image"
                                        alt="{{ $serv->getTranslation('name', $lang) }}">
                                </a>
                                <div class="service-content">
                                    <h2 class="service-title">
                                        <a href="{{ route('service-detail', ['slug' => $serv->slug]) }}">
                                            {{ $serv->getTranslation('name', $lang) }}
                                        </a>
                                    </h2>
                                    <ul class="service-list">
                                        @foreach ($serv->points as $service_points)
                                            <li><i class="fas fa-check"></i> {{ $service_points->title }}</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('service-detail', ['slug' => $serv->slug]) }}"
                                        class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <section id="service-dt-cta"
        style="background: linear-gradient(rgba(34, 41, 87, 0.8), rgba(147, 28, 30, 0.8)), url('{{ uploaded_asset($page->image2) }}') no-repeat center center;">
        <div class="container text-center">
            <h2 class="animate__animated animate__fadeInDown">{{ $page->getTranslation('title2', $lang) }}</h2>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">{{ $page->getTranslation('title3', $lang) }}
            </p>
            <a href="{{ route('contact') }}" id="service-dt-cta-button"
                class="animate__animated animate__bounceIn animate__delay-2s">{{ $page->getTranslation('heading1', $lang) }}</a>
        </div>
    </section>

@endsection

@section('header')
    <style>
        /* ===== SERVICE LISTING PAGE ===== */

        #services-listing {
            padding: 80px 0;
            background: #f9f9f9;
        }

        #services-header {
            text-align: center;
            margin-bottom: 40px;
        }

        #services-title {
            font-size: 36px;
            font-weight: bold;
            color: #222;
        }

        #services-subtitle {
            font-size: 18px;
            color: #555;
            max-width: 700px;
            margin: 0 auto;
        }

        /* SERVICE CARD */
        .service-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .service-card:hover {
            transform: scale(1.02);
        }

        .service-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        .service-content {
            padding: 20px;
        }

        .service-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .service-list {
            list-style: none;
            padding: 0;
            margin: 0 0 15px;
        }

        .service-list li {
            font-size: 16px;
            color: #555;
            padding: 5px 0;
            display: flex;
            align-items: center;
        }

        .service-list li i {
            color: var(--secondary-color);
            margin-right: 8px;
        }

        .service-link {
            font-size: 16px;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .service-link i {
            margin-left: 5px;
        }

        .service-link:hover {
            color: var(--secondary-color);
        }
    </style>
@endsection
