<footer class="modern-footer collection-footer">
    @php
        $pageData = getPageData('home');
        $lang = getActiveLanguage();
    @endphp
    
    <!-- Newsletter -->
    <div class="blog-with-sidebar__newsletter">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row blog-newsletter">
                <div class="col-lg-12">
                    <!-- Newsletter Title -->
                    <h3 class="blog-newsletter__title font-family-jost text-center">{{ $pageData->getTranslation('heading8', $lang) }}</h3>
                    <!-- End newsletter title -->
                </div>

                <div class="col-lg-6">
                    <p class="newsletter-text-area">{{ $pageData->getTranslation('heading9', $lang) }}</p>
                </div>
                <div class="col-lg-6">
                    <!-- Newsletter form -->
                    <form class="blog-newsletter__form"  id="newsletterForm">
                        <input type="email" placeholder="{{trans('email')}}"  name="email" class="blog-newsletter__input" />
                        <button type="submit" class="blog-newsletter__submit">{{ trans('messages.subscribe') }}</button>
                    </form>
                    <div id="newsletterMessage"></div>
                    <!-- End newsletter form -->
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </div>
    <!-- End newsletter -->

    <!-- Container -->
    <div class="container">

        <!-- Menu -->
        <ul class="modern-footer__menu">
            <li><a href="{{route('home')}}">{{ trans('messages.home') }} </a></li>
            <li><a href="{{route('about_us')}}">{{ trans('messages.about_us') }} </a></li>
            <li><a href="{{route('products.index')}}">{{ trans('messages.shop') }} </a></li>
            <li><a href="{{route('terms')}}">{{ trans('messages.terms_conditions') }} </a></li>
            <li><a href="{{route('privacy')}}">{{ trans('messages.privacy_policy') }}</a></li>
            <li><a href="{{route('contact')}}">{{ trans('messages.contact') }}</a></li>
        </ul>
        <!-- End menu -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-4 mobile-order-2">
                <!-- Social -->
                <div class="modern-footer__social">
                    <p>{{ get_setting('social_title') }}</p>
                    <ul>
                        <li><a href="{{ get_setting('instagram_link') }}"><img src="{{ asset('assets/images/instagram.svg') }}" alt=""></a></li>
                        <li><a href="{{ get_setting('facebook_link') }}"><img src="{{ asset('assets/images/facebook.svg') }}"></a></li>
                        <li><a href="{{ get_setting('youtube_link') }}"><img src="{{ asset('assets/images/youtube.svg') }}"></a></li>
                        <li><a href="{{ get_setting('linkedin_link') }}"><img src="{{ asset('assets/images/LinkedIn.svg') }}"></a></li>
                    </ul>
                </div>
                <!-- End social -->
            </div>
            <div class="col-lg-4">
                <!-- Logo -->
                <div class="modern-footer__logo">
                    <img width="250" src="{{ asset('assets/img/logo.avif') }}" alt="">
                </div>
                <!-- End logo -->
                <!-- Address -->
                <div class="modern-footer__address">

                    <ul>
                        <li><a href="#"><img width="40" src="{{ asset('assets/images/email.svg') }}" alt=""></a></li>
                        <li><a href="#"><img width="40" src="{{ asset('assets/images/chat.svg') }}"></a></li>
                        <li><a href="#"><img width="40" src="{{ asset('assets/images/phone.svg') }}"></a></li>
                        <li><a href="#"><img width="40" src="{{ asset('assets/images/visit.svg') }}"></a></li>
                    </ul>
                </div>
                <!-- End address -->
                <!-- Payment -->
                <div class="modern-footer__payment d-none d-lg-block">
                    <img src="{{ uploaded_asset(get_setting('payment_method_images')) }}" alt="Payment" />
                </div>
                <!-- End payment -->
            </div>
            <div class="col-lg-4 mobile-order-3">
                <!-- Currency -->
                <div class="modern-footer__currency">
                    <p>{{ trans('messages.join_with_us') }}</p>

                    <div class="become_promotor" bis_skin_checked="1"><a href="#"><i
                                class="lnr lnr-bullhorn"></i>{{ trans('messages.become_promotor') }}
                        </a></div>
                    <div class="become_partner" bis_skin_checked="1"><a href="#"><i
                                class="lnr lnr-thumbs-up"></i>{{ trans('messages.become_partner') }}
                        </a></div>



                </div>
                <!-- End currency -->
            </div>
        </div>
        <!-- End row -->
        <!-- Payment -->
        <div class="modern-footer__payment d-block d-lg-none">
            <img src="{{ asset('assets/images/payment.svg') }}" alt="Payment" />
        </div>
        <!-- End payment -->


        <!-- Copyright -->
        <div class="modern-footer__copyright"> {!! get_setting('frontend_copyright_text', null, $lang) !!} {{ trans('messages.design_by') }}  {{ trans('messages.tomsher') }}</div>
        <!-- End copyright -->

    </div>

    <!-- End container -->
</footer>
