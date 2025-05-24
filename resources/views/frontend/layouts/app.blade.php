<!DOCTYPE html>
<html lang="{{ getActiveLanguage() }}">
<!--<< Header Area >>-->

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Gramentheme">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <!-- ======== Page title ============ -->
    <title></title>
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!--<< Splitting.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/splitting.css') }}">
    <!--<< Magnific popup.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!--<< NiceSelect.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @yield('header')
    <style>
        li.active a {
            color: #fff !important;
            font-weight: 700 !important;
        }

        .sticky.header-3 .main-menu ul li a {
            color: #000 !important;
        }

        .brand-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Two columns */
            gap: 10px;
            /* Optional gap between items */
        }

        .brand-list li {
            list-style: none;
            /* Remove default list styles */
            padding: 5px 0;
        }

        @media (max-width: 768px) {
            .brand-list {
                grid-template-columns: 1fr;
                /* Single column on smaller screens */
            }
        }

        /* ===== MENU LAYOUT ===== */
        #product-menu .menu-container {
            display: flex;
            /* width: 800px; */
            /* background: white; */
            /* border-radius: 8px; */
            overflow: hidden;
            /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); */
        }

        /* ===== LEFT TAB MENU ===== */
        #product-menu .menu-tabs {
            width: 200px;
            background: #ffe6e6;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        #product-menu .menu-tab {
            background: transparent;
            border: none;
            font-size: 16px;
            font-weight: bold;
            color: #000;
            padding: 15px;
            cursor: pointer;
            text-align: left;
            transition: background 0.3s ease, color 0.3s ease;
        }

        #product-menu .menu-tab.active {
            background: #931c1e;
            color: white;
        }

        /* ===== RIGHT CONTENT AREA ===== */
        #product-menu .menu-content {
            flex-grow: 1;
            padding: 20px;
        }

        #product-menu .menu-category-content {
            display: none;
        }

        #product-menu .menu-category-content.active {
            display: block;
        }



        /* ===== ICT SECTION GRID ===== */
        #product-menu .ict-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        /* ===== MENU TITLES ===== */
        #product-menu .menu-title {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
            border-bottom: 2px solid #931c1e;
            padding-bottom: 5px;
        }

        /* ===== CATEGORY STYLES ===== */
        #product-menu .menu-category {
            margin-bottom: 15px;
        }

        #product-menu .menu-category h5 {
            font-size: 14px;
            font-weight: bold;
            color: #000;
            margin-bottom: 6px;
        }

        #product-menu .menu-category ul {
            list-style: none;
            padding: 0;
        }

        #product-menu .menu-category ul li {
            padding: 4px 0;
        }

        #product-menu .menu-category ul li a {
            font-size: 14px;
            color: #000;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        #product-menu .menu-category ul li a:hover {
            color: #931c1e;
        }



        #product-menu .submenu li a {
            color: #000;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 992px) {
            #product-menu .menu-container {
                flex-direction: column;
                width: 100%;
            }

            #product-menu .menu-tabs {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
            }

            #product-menu .menu-tab {
                flex-grow: 1;
                text-align: center;
            }

            #product-menu .ict-grid {
                grid-template-columns: 1fr;
            }
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #931c1e;
            border-color: #931c1e;
        }

        .page-link {
            color: #010c48;
        }
    </style>

</head>

<body>
    <!-- Mouse Cursor Start -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!-- Back To Top Start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    @include('frontend.parts.header')


    @yield('content')
    <!-- Footer Section    S T A R T -->

    @include('frontend.parts.footer')
    <!--<< All JS Plugins >>-->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--<< Bootstrap Js >>-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--<< Waypoints Js >>-->
    <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
    <!--<< Counterup Js >>-->
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <!--<< Viewport Js >>-->
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <!--<< Tilt Js >>-->
    <script src="{{ asset('assets/js/tilt.min.js') }}"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!--<< MeanMenu Js >>-->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <!--<< Magnific popup Js >>-->
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <!--<< Wow Animation Js >>-->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!--<< Splitting Animation Js >>-->
    <script src="{{ asset('assets/js/splitting.js') }}"></script>
    <!--<< NIce Select Js >>-->
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
    <!--<< Circle Progress Js >>-->
    <script src="{{ asset('assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>


    <!--<< Main.js >>-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9156b62abc2b792a',t:'MTc0MDE0MDY0OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".menu-tab");
            const contents = document.querySelectorAll(".menu-category-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    // Remove active class from all tabs and content
                    tabs.forEach(t => t.classList.remove("active"));
                    contents.forEach(c => c.classList.remove("active"));

                    // Add active class to clicked tab and corresponding content
                    this.classList.add("active");
                    document.getElementById(this.getAttribute("data-target")).classList.add(
                        "active");
                });
            });
        });
    </script>

    @yield('script')
</body>

</html>
