@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('{{ uploaded_asset($page->image1) }}');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $page->getTranslation('title', $lang) }} </h1>
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
                        Products
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section id="products-page">
        <div class="container">
            <div id="products-header">
                <h2 id="products-title">{{ $page->getTranslation('title1', $lang) }} </h2>
                <p id="products-description">{{ $page->getTranslation('sub_title', $lang) }} </p>
            </div>

            <!-- Filters Section -->
            <form action="" id="productfilters" method="GET">
                <div id="products-filters">
                    <div class="filter-group">
                        <select id="products-category-filter" name="category">
                            <option value="">All Categories</option>
                            @if (!empty($categories))
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->getTranslation('slug', $lang) }}" @if($category == $cat->getTranslation('slug', $lang)) selected @endif>{{ $cat->getTranslation('name', $lang)}}</option>
                                @endforeach
                            @endif
                        </select>

                        <select id="products-brand-filter" name="brand">
                            <option value="">All Brands</option>
                            @if (!empty($brands))
                                @foreach ($brands as $brnd)
                                    <option value="{{ $brnd->getTranslation('slug', $lang) }}"  @if($brand == $brnd->getTranslation('slug', $lang)) selected @endif>{{ $brnd->getTranslation('name', $lang)}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <input type="text" id="products-search-box" name="search" value="{{ $sort_search }}" placeholder="Search for a product...">
                
                </div>
            </form>
            <!-- Product Grid -->
            <div id="products-grid">

                @if (!empty($products[0]))
                    @foreach ($products as $pkey => $prod)
                        <div class="product-card">
                            <a href="{{ route('product-detail',['slug' => $prod->slug, 'sku' => $prod->sku]) }}">
                                <div class="product-header">
                                    <span class="category">{{ $prod->category->getTranslation('name', $lang) }}</span>
                                    <span class="new-badge">NEW</span>
                                </div>
                                <div class="image-wrapper">
                                    <img src="{{ get_product_image($prod->thumbnail_img, '300') }}" alt="{{ $prod->getTranslation('name', $lang) }}">
                                </div>
                                <div class="product-info">
                                    <span class="model">{{ $prod->brand->getTranslation('name', $lang) }}</span>
                                    <h3 class="product-title">{{ $prod->getTranslation('name', $lang) }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <img src="{{ asset('assets/images/no-product.png') }}" class="w-25" alt="No Products Found">
                @endif
                
            </div>
            <div class="standard-pagination">
                {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('select').niceSelect();

            if (window.location.search.match(/(brand|category|search|page)/)) {
                // Scroll to the specific div (replace '#yourDiv' with your actual div ID)
                $('html, body').animate({
                    scrollTop: $('#products-page').offset().top
                }, 1000); // Adjust scroll speed (1000ms = 1s)
            }


            function filterProducts() {
               $('#productfilters').submit();
            }

            $("#products-category-filter, #products-brand-filter").on("change", filterProducts);
            
        });
    </script>
@endsection
