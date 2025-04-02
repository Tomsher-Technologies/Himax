@extends('frontend.layouts.app')
@section('content')
    <section class="hero hero-section hero-1 fix">

        <div class="video-wrap">
            <video autoplay muted loop class="bg-video">
                <source src="{{ asset($page->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <!-- <div class="video-overlay"></div> -->

        <div class="hero-content m-auto">

            <h1 class="hero-title wow fadeInUp" data-wow-delay=".3s">
                <span class="hero-title-span">{{ $page->getTranslation('heading15') }}</span><br>
                <span class="hero-title-main">{{ $page->getTranslation('heading16') }}</span>
            </h1>
            <p class="hero-description wow fadeInUp" data-wow-delay=".3s">
                {!! $page->getTranslation('content6') !!}
            </p>
            {{-- {{ route('contact') }} --}}
            <a href="{{ route('contact') }}" class="btn">
                {{ $page->getTranslation('heading17') }}
            </a>
        </div>

        <div id="hero-service-slider-sec" class="slider-area">
            <div class="swiper hero-service-slider">
                <div class="swiper-wrapper">

                    @if (!empty($data['home_categories']))
                        @foreach ($data['home_categories'] as $home_categories)
                            <div class="swiper-slide">
                                <a href="{{ route('products.index',['category' =>$home_categories->getTranslation('slug', $lang)]) }}">
                                    <img src="{{ uploaded_asset($home_categories->getTranslation('icon', $lang)) }}" alt="{{ $home_categories->getTranslation('name', $lang) }}">
                                </a>
                            </div>
                        @endforeach
                    @endif
                
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>





    <!-- Why Choose Us Section S T A R T -->
    <div id="about-as" class="wcu-section section-padding fix pb-0">
        <div class="container">
            <div class="wcu-wrapper style3">
                <div class="row gy-5 gy-64 d-flex align-items-center">

                    <div class="col-xl-6 col-lg-6">
                        <div class="wcu-content">
                            <div class="section-title">
                                <span class="subtitle wow fadeInUp">{{ $page->getTranslation('title', $lang) }}</span>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ $page->getTranslation('sub_title', $lang) }}
                                </h2>
                            </div>

                            <p class="text  wow fadeInUp" data-wow-delay=".5s">
                                {!! $page->getTranslation('content', $lang) !!}
                            </p>

                            <div class="d-flex gap-4">
                                <div class="counter-box">
                                    <h2><span class="counter-number1"></span>{{ $page->getTranslation('title1', $lang) }}</h2>
                                    <p>{{ $page->getTranslation('title2', $lang) }}</p>
                                </div>

                                <div class="counter-box">
                                    <h2><span class="counter-number1"></span>{{ $page->getTranslation('title3', $lang) }}</h2>
                                    <p>{{ $page->getTranslation('heading1', $lang) }}</p>
                                </div>

                            </div>

                        </div>
                        
                        <a href="{{ route('contact') }}" class="btn">{{ $page->getTranslation('heading2', $lang) }} </a>
                    </div>


                    <div class="col-xl-6 col-lg-6">
                        <div class="wcu-thumb">
                            <div class="thumb1 bg-cover"><img src="{{ asset($page->image) }}" alt="thumb"
                                    class="wow img-custom-anim-left w-100"></div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <section id="features">
        <div class="container">
            <div class="features-content">
                @php
                    $img = $points = '';
                @endphp
                @foreach ($data['points'] as $key => $pnt)
                    @php
                        if($key == 0){
                            $active = 'active';
                            $img = uploaded_asset($pnt->image);
                        }else {
                            $active = '';
                        }

                        $points .= '<button class="tab '.$active.'" data-type="image" data-src="'.uploaded_asset($pnt->image).'">'.$pnt->title.'</button>';
                        
                    @endphp
                @endforeach
                <!-- Background Media -->
                <div class="tab-media">
                    {{-- <video id="features-video" autoplay loop muted>
                        <source src="assets/videos/cybersecurity.mp4" type="video/mp4">
                    </video> --}}
                    <img id="features-image" src="{{$img}}" alt="Feature Image" class="">
                    {{-- hidden --}}
                </div>

                <!-- Text Content with Overlay -->
                <div class="features-text-wrapper">
                    <div class="text-overlay"></div>
                    <div class="features-text">
                        <h3>{{ $page->getTranslation('heading18', $lang) }}</h3>
                        <h2>{{ $page->getTranslation('heading19', $lang) }}</h2>

                        <!-- Feature Tabs -->
                        <div class="features-tabs">
                           {!! $points !!}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section S T A R T -->
    <section class="testimonial-section-1 fix">
        <div class="container-fluid">
            <div class="testimonial-wrapper style1 margin-minus-bottom">
                <div class="">
                    <div class="">
                        
                    <div class="container">
    <div class="section-header text-start row">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <span class="section-subtitle">{{ $page->getTranslation('heading3', $lang) }}</span>
            <h2 class="section-title">{{ $page->getTranslation('heading4', $lang) }}</h2>
        </div>
        <div class="col-lg-2 d-none d-lg-block"></div> <!-- Empty column only on large screens -->
        <div class="col-lg-5 col-md-6 col-sm-12">
            <p>{{ $page->getTranslation('content1', $lang) }}</p>
        </div>
    </div>
</div>

                        
                        <div class="slider-area testimonialSliderOne">

                            <div class="swiper gt-slider" id="testimonialSliderOne" data-slider-options='{"loop": true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2}, "768":{"slidesPerView":2}, "992":{"slidesPerView":2}, "1200":{"slidesPerView":4}}}'>
                                <div class="swiper-wrapper">

                                    @if (!empty($data['featured_services']))
                                        @foreach ($data['featured_services'] as $fea_service)
                                            <div class="swiper-slide">
                                                <div id="services-card">
                                                    <a href="{{ route('service-detail',['slug' => $fea_service->slug]) }}" >
                                                        <img src="{{ uploaded_asset($fea_service->image) }}" alt="Managed IT Services" id="services-card-image">
                                                        <div id="services-card-content">
                                                            <div class="services-card-content-top">
                                                                <!-- Title -->
                                                                <h2 id="services-card-title">
                                                                    {{ $fea_service->getTranslation('name', $lang) }}
                                                                </h2>
                                                                <!-- Service List (Now below title and always visible) -->
                                                                <ul id="services-card-list">
                                                                    @foreach ($fea_service->points as $service_points)
                                                                        <li class="services-card-item">
                                                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                                height="16" viewBox="0 0 16 16" fill="none">
                                                                                <g clip-path="url(#clip0_97_177)">
                                                                                    <path d="M2.5 9L6 12.5L14 4.5" stroke="white"
                                                                                        stroke-width="2" stroke-linecap="round"
                                                                                        stroke-linejoin="round" />
                                                                                </g>
                                                                                <defs>
                                                                                    <clipPath id="clip0_97_177">
                                                                                        <rect width="16" height="16"
                                                                                            fill="white" />
                                                                                    </clipPath>
                                                                                </defs>
                                                                            </svg> -->





                                                                            <svg width="16"
                                                                            height="16" fill="white" version="1.1" id="fi_447147" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0
			c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7
			C514.5,101.703,514.499,85.494,504.502,75.496z"></path>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>


                                                                            {{ $service_points->title }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
            
                                                            <!-- Footer (Always Visible) -->
                                                            <div id="services-card-footer">
                                                                <span id="services-card-footer-text">{{ ucfirst($fea_service->type) }}</span>
                                                                <a href="#" id="services-card-arrow">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48"
                                                                        height="48" viewBox="0 0 48 48" fill="none">
                                                                        <path
                                                                            d="M37.0008 11.5V31C37.0008 31.3978 36.8428 31.7794 36.5615 32.0607C36.2802 32.342 35.8987 32.5 35.5008 32.5C35.103 32.5 34.7215 32.342 34.4402 32.0607C34.1589 31.7794 34.0008 31.3978 34.0008 31V15.1206L12.5621 36.5613C12.2806 36.8427 11.8989 37.0008 11.5008 37.0008C11.1028 37.0008 10.721 36.8427 10.4396 36.5613C10.1581 36.2798 10 35.898 10 35.5C10 35.102 10.1581 34.7202 10.4396 34.4387L31.8802 13H16.0008C15.603 13 15.2215 12.842 14.9402 12.5607C14.6589 12.2794 14.5008 11.8978 14.5008 11.5C14.5008 11.1022 14.6589 10.7206 14.9402 10.4393C15.2215 10.158 15.603 10 16.0008 10H35.5008C35.8987 10 36.2802 10.158 36.5615 10.4393C36.8428 10.7206 37.0008 11.1022 37.0008 11.5Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                
                                </div>
                                <div class="testimonial-content">
                                    <div class="arrow-btn text-end wow fadeInUp" data-wow-delay=".4s">
                                        <button data-slider-prev="#testimonialSliderOne"
                                            class="slider-arrow slider-prev"><i
                                                class="fa-sharp fa-regular fa-arrow-left-long"></i></button>
                                        <button data-slider-next="#testimonialSliderOne"
                                            class="slider-arrow slider-next"><i
                                                class="fa-regular fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="product-section">
        <div class="container">
            <div class="section-header text-start">
                <div class="">
                    <span class="section-subtitle">{{ $page->getTranslation('heading5', $lang) }}</span>
                    <h2 class="section-title">{{ $page->getTranslation('heading6', $lang) }}</h2>
                </div>
                <div class="swiper-navigation">

                    
                    <div class="swiper-button-prev product-custom-prev">
                        <!-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 19L8 12L15 5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg> -->
                    </div>

                    <div class="swiper-button-next product-custom-next">
                        <!-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 5L16 12L9 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg> -->
                    </div>

                </div>
            </div>
             
            
        </div>

        <div class="container-fluid">
            <div class="swiper product-slider">
                <div class="swiper-wrapper">
                    @if (!empty($data['featured_products']))
                        @foreach ($data['featured_products'] as $fea_products)
                            
                                <div class="swiper-slide product-card">
                                    <div class="product-header">
                                        <span class="category">{{ $fea_products->category->name }}</span>
                                        <span class="new-badge">NEW</span>
                                    </div>
                                    <div class="image-wrapper">
                                        <a href="{{ route('product-detail',['slug' => $fea_products->slug, 'sku' => $fea_products->sku]) }}">
                                            <img src="{{ asset($fea_products->thumbnail_img) }}" alt="2M Explosion-proof IR Camera">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <span class="model">{{ $fea_products->brand->name }}</span>
                                        <a href="{{ route('product-detail',['slug' => $fea_products->slug, 'sku' => $fea_products->sku]) }}">
                                            <h3 class="product-title">{{ $fea_products->getTranslation('name', $lang) }}</h3>
                                        </a>
                                    </div>
                                </div>
                           
                        @endforeach
                    @endif
                    <!-- Product Card 1 -->
                    
                    {{-- {{ $page->getTranslation('heading7', $lang) }} // Want to see more? --}}
                    {{-- {{ $page->getTranslation('heading8', $lang) }} // View all products --}}
                </div>
            </div>
        </div>
          <div class="container">
              
            <div class="row product_link pt-5 align-items-center ">
                  <div class="col-md-3"><h3>{{ $page->getTranslation('heading7', $lang) }}</h3> </div>
                  <div class="col-md-7"> <hr> </div>
                  <div class="col-md-2"><a href="{{ route('products.index') }}" class="btn">{{ $page->getTranslation('heading8', $lang) }}</a></div>
              </div>
          </div>

    </section>

    <section id="industries">
        <div class="container">
            <div class="industries-header">
                
                      <div class="">
                                         <h5>{{ $page->getTranslation('content2', $lang) }}</h5>
                <h2>{{ $page->getTranslation('content3', $lang) }}</h2>
                      </div>
                
 
                <p>{{ $page->getTranslation('content4', $lang) }}</p>
            </div>

            <div class="industries-content">
                <!-- Left Side - Tabs -->
                <div class="industries-tabs">
                    @php
                        $imageInd = $titleInd = $contentInd = '';
                    @endphp
                    @if (!empty($data['industries']))
                        @foreach ($data['industries'] as $ikey => $ind)
                            @php
                                if($ikey == 0){
                                    $imageInd = uploaded_asset($ind->image);
                                    $titleInd = $ind->title;
                                    $contentInd = $ind->content;
                                }
                            @endphp
                            <button class="industry-tab @if ($ikey == 0) active @endif" data-image="{{ uploaded_asset($ind->image) }}" data-title="{{ $ind->title }}" data-description="{{ $ind->content }}">
                                {{ $ind->name }}
                            </button>
                        @endforeach
                    @endif
                </div>


                <!-- Right Side - Content Display -->
                <div class="industries-display">
                    <div class="industries-bg">
                        <img id="industry-bg-image" src="{{$imageInd}}" alt="Industry Image">
                    </div>
                    <div class="industries-info">
                        <h3 id="industry-title">{{$titleInd}}</h3>
                        <p id="industry-description">{{$contentInd}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="partners">
        <div class="container">
            <div class="partners-content">
                <!-- Left Content -->
                <div class="partners-text animate__animated animate__fadeInLeft">
                    <span class="partners-subtitle">{{ $page->getTranslation('heading9', $lang) }}</span>
                    <h2 class="partners-title">
                        {{ $page->getTranslation('heading10', $lang) }}
                    </h2>
                    <p class="partners-description">
                        {{ $page->getTranslation('content5', $lang) }}
                    </p>
                </div>

                <!-- Right Video Section -->
                <div class="video-thumbnail animate__animated animate__fadeInRight">
                    <img src="{{ $page->image1 }}" alt="">
                    {{-- <button class="play-button" onclick="openVideoPopup()">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11" stroke="white" stroke-width="2" />
                            <polygon points="9,7 9,17 17,12" fill="white" />
                        </svg>
                    </button> --}}
                </div>
            </div>

            <!-- Video Modal Popup -->
            <div id="video-popup" class="video-modal animate__animated animate__fadeIn">
                <div class="video-container">
                    <span class="close-video" onclick="closeVideoPopup()">&times;</span>
                    <iframe id="video-frame" src="" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Clients Logo Slider -->
            <div class="client-logos">
                <div class="swiper client-slider animate__animated animate__fadeInUp">
                    <div class="swiper-wrapper">
                        @if (!empty($data['brands']))
                            @foreach ($data['brands'] as $brand)
                                <div class="swiper-slide"><img src="{{ uploaded_asset($brand->getTranslation('logo', $lang)) }}" alt="{{ $brand->getTranslation('name', $lang) }}"></div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <div class="blog-header">
                <h2 class="blog--sec-title">{{ $page->getTranslation('heading11', $lang) }}</h2>
                <a href="{{ route('blogs.index') }}" class="blog-link">
                    {{ $page->getTranslation('heading12', $lang) }} ↗
                </a>
            </div>

            <div class="blog-grid">
                @if (!empty($data['blogs']))
                    @foreach ($data['blogs'] as $blog)
                        <div class="blog-card">
                            <a href="{{ route('blog-detail',['slug' => $blog->slug]) }}">
                                <div class="blog-image">
                                    <img src="{{ uploaded_asset($blog->image) }}" alt="AI Prosthetics">
                                    <div class="blog-tags">
                                        @php
                                            $tags = explode(',', $blog->tags);
                                        @endphp
                                        @if (!empty($tags))
                                            @foreach ( $tags as $tag)
                                                <span class="tag">{{$tag}}</span>
                                            @endforeach
                                        @endif
                                        
                                    </div>
                                </div>
                                <span class="blog-date">| {{ date('M d, Y', strtotime($blog->blog_date)) }}</span>
                                <h3 class="blog-title">{{ $blog->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                @endif
                <!-- Blog Post 1 -->
                

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
                    {{ $page->getTranslation('heading13', $lang) }}
                </h2>
                {{-- {{ route('services.index') }} --}}
                <a href="{{ route('services.index') }}" class="cta-button animate__animated animate__fadeInUp animate__delay-1s">
                    {{ $page->getTranslation('heading14', $lang) }}
                </a>
            </div>
        </div>
    </section>
@endsection
