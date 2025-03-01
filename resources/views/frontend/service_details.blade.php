@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ uploaded_asset($page->image1) }}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $service->getTranslation('name', $lang) }}</h1>
                    <div id="service-dt-subtitle" class=" text-white wow fadeInUp" data-wow-delay=".4s">
                        {!! $service->getTranslation('short_description', $lang) !!}
                    </div>
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
                        <a href="{{ route('services.index') }}">
                            Services
                        </a>
                    </li>
                    <li>
                        <i class="fa-regular fa-slash-forward"></i>
                    </li>
                    <li>
                        {{ $service->getTranslation('name', $lang) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Service Overview -->
    <section id="service-dt-overview">
        <div class="container">
            <div class="row align-items-center gy-5">
                <!-- Image Column -->
                <div class="col-lg-6 order-lg-1 order-2">
                    <div id="service-dt-image-wrapper">
                        <img src="{{ uploaded_asset($service->image) }}" id="service-dt-featured-image"
                            alt="{{ $service->getTranslation('name', $lang) }}" loading="lazy">
                        <div id="service-dt-image-shape"></div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col-lg-6 order-lg-2 order-1">
                    <div id="service-dt-content-wrapper">
                        <h2 id="service-dt-title">{{ $service->getTranslation('name', $lang) }}</h2>
                        <div id="service-dt-description">
                            <p>{!! $service->getTranslation('description', $lang) !!}</p>
                        </div>
                        {{-- <div id="service-dt-feature-list">
                            <ul class="service-list">
                                @foreach ($service->points as $service_points)
                                    <li><i class="fas fa-check"></i> {{ $service_points->title }}</li>
                                    
                                @endforeach
                            </ul>
                        </div> <!-- Feature List End --> --}}
                    </div> <!-- Content Wrapper End -->
                </div> <!-- Column End -->
            </div> <!-- Row End -->
        </div> <!-- Container End -->
    </section>

    <section id="service-dt-cta"  style="background: linear-gradient(rgba(34, 41, 87, 0.8), rgba(147, 28, 30, 0.8)), url('{{ uploaded_asset($page->image2) }}') no-repeat center center;">
        <div class="container text-center">
            <h2 class="animate__animated animate__fadeInDown">{{ $page->getTranslation('title2', $lang) }}</h2>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">{{ $page->getTranslation('title3', $lang) }}</p>
            <a href="{{ route('contact') }}" id="service-dt-cta-button" class="animate__animated animate__bounceIn animate__delay-2s">{{ $page->getTranslation('heading1', $lang) }}</a>
        </div>
    </section>
@endsection
