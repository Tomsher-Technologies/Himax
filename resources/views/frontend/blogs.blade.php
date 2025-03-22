@extends('frontend.layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ uploaded_asset($page->image1) }}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $page->getTranslation('title', $lang) }}
                    </h1>
                    <p id="service-dt-subtitle" class=" text-white wow fadeInUp" data-wow-delay=".4s">{{ $page->getTranslation('sub_title', $lang) }}</p>
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
                        Blogs
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Blog Listing Section -->
    <section id="blog-list">
        @if (!empty($blogs[0]))
            <div class="container">
                <div id="blog-list-grid">
                    @foreach ($blogs as $pkey => $blog)
                        <div class="blog-list-card">
                            <a href="{{ route('blog-detail',['slug' => $blog->slug]) }}">
                                <div class="blog-list-image">
                                    <img src="{{ uploaded_asset($blog->image) }}" alt="{{ $blog->name }}">
                                    <div class="blog-list-tags">
                                        @php
                                            $tags = explode(',', $blog->tags);
                                        @endphp
                                        @if (!empty($tags))
                                            @foreach ( $tags as $tag)
                                                <span class="blog-list-tag">{{$tag}}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <span class="blog-list-date">| {{ date('M d, Y', strtotime($blog->blog_date)) }}</span>
                                <h3 class="blog-list-title">{{ $blog->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="standard-pagination">
                    {{ $blogs->appends(request()->input())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="container text-center">
                <img src="{{ asset('assets/images/nodata.png') }}" class="w-25" alt="No Data Found">
            </div>
        @endif
    </section>


    <section id="service-dt-cta"  style="background: linear-gradient(rgba(34, 41, 87, 0.8), rgba(147, 28, 30, 0.8)), url('{{ uploaded_asset($page->image2) }}') no-repeat center center;">
        <div class="container text-center">
            <h2 class="animate__animated animate__fadeInDown">{{ $page->getTranslation('title2', $lang) }}</h2>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">{{ $page->getTranslation('title3', $lang) }}</p>
            <a href="{{ route('contact') }}" id="service-dt-cta-button"
                class="animate__animated animate__bounceIn animate__delay-2s">{{ $page->getTranslation('heading1', $lang) }}</a>
        </div>
    </section>
@endsection

@section('header')
<style>
    /* ===== Blog Listing Section ===== */
    #blog-list {
        background: #FCE5E2;
        padding: 80px 0;
    }

    /* Blog Header */
    #blog-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    #blog-list-sec-title {
        font-size: 40px;
        font-weight: bold;
        color: #000;
    }

    #blog-list-link {
        font-size: 16px;
        font-weight: bold;
        color: #000;
        text-decoration: none;
        transition: color 0.3s ease-in-out;
    }

    #blog-list-link:hover {
        color: #D23A3A;
    }

    /* Blog Grid */
    #blog-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    /* Blog Card */
    .blog-list-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .blog-list-card:hover {
        transform: translateY(-10px);
    }

    /* Blog Image */
    .blog-list-image {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .blog-list-image img {
        width: 100%;
        transition: transform 0.3s ease-in-out;
    }

    .blog-list-card:hover .blog-list-image img {
        transform: scale(1.05);
    }

    /* Blog Tags */
    .blog-list-tags {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        gap: 5px;
    }

    .blog-list-tag {
        background: #FEE1E1;
        color: #D23A3A;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 10px;
    }

    /* Blog Date */
    .blog-list-date {
        font-size: 14px;
        color: #D23A3A;
        font-weight: bold;
        margin-top: 10px;
        display: block;
    }

    /* Blog Title */
    .blog-list-title {
        font-size: 16px;
        font-weight: bold;
        color: #000;
        margin-top: 8px;
        transition: color 0.3s ease-in-out;
    }

    .blog-list-title:hover {
        color: #D23A3A;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        #blog-list-header {
            flex-direction: column;
            text-align: center;
        }

        #blog-list-link {
            margin-top: 10px;
        }
    }

    @media (max-width: 768px) {
        #blog-list-sec-title {
            font-size: 30px;
        }
    }
</style>
@endsection