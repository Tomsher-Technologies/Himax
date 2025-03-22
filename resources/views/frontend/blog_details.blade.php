@extends('frontend.layouts.app')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ uploaded_asset($page->image1) }}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $blog->name }}
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
                        <a href="{{ route('blogs.index') }}">
                            Blogs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Blog Content -->
    <section id="blog-details-content">
        <div class="container">
            <div class="row">
                <!-- Blog Main Content -->
                <div class="col-lg-8">

                    <div id="blog-details-featured-image">
                        <img src="{{ uploaded_asset($blog->image) }}" alt="The Future of AI">
                    </div>

                    <article id="blog-details-article">
                        <span class="mb-2" style="color: #202857">| {{ date('M d, Y', strtotime($blog->blog_date)) }}</span><br>
                        <div class="mt-3">
                            {!! $blog->description !!}
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside id="blog-details-sidebar">
                       

                        <!-- Recent Posts -->
                        <div id="blog-details-recent-posts">
                            <h3 id="blog-details-sidebar-title">{{ $page->getTranslation('heading2', $lang) }}</h3>
                            <ul id="blog-details-recent-list">
                                @if (!empty($recentBlogs[0]))
                                    @foreach ($recentBlogs as $rblog)
                                        <li><a href="{{ route('blog-detail',['slug' => $rblog->slug]) }}">{{ $rblog->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <br>
                        <!-- Social Links -->
                        <div id="blog-details-social">
                            <h3 id="blog-details-sidebar-title">{{ $page->getTranslation('heading3', $lang) }}</h3>
                            <div id="blog-details-social-links">
                                <a href="{{ get_setting('facebook_link') }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a href="{{ get_setting('instagram_link') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
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
