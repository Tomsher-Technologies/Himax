@extends('frontend.layouts.app')
@section('content')
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
                        Contact Us
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section id="contact-info">
        <div class="container">
            <h2 class="text-white"> {{ $page->getTranslation('title1', $lang) }}</h2>
            <p>{{$page->getTranslation('sub_title', $lang)}}</p>

            <div id="contact-grid">
                <div id="contact-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3 class="text-white">{{$page->getTranslation('title2', $lang)}}</h3>
                    <p>{!! $page->getTranslation('content', $lang) !!}</p>
                </div>

                <div id="contact-card">
                    <i class="fas fa-envelope"></i>
                    <h3 class="text-white">{{$page->getTranslation('heading3', $lang)}}</h3>
                    <p>{{ $page->getTranslation('heading1', $lang) }}</p>
                </div>

                @php
                    $phones = explode('/', $page->getTranslation('content1', $lang));
                    $phone = '';
                    foreach($phones as $ph){
                        $phone .= '<a href="tel:'.$ph.'">'.$ph .'</a><br>';
                    }
                @endphp

                <div id="contact-card">
                    <i class="fas fa-phone-alt"></i>
                    <h3 class="text-white">{{ $page->getTranslation('title3', $lang) }}</h3>
                    <p style="color: white">
                        {!! $phone !!}
                    </p>
                </div>

                @php
                    $working_hours = explode('/', $page->getTranslation('content2', $lang));
                    $hours = '';
                    foreach($working_hours as $wh){
                        $hours .= $wh .'<br>';
                    }
                @endphp

                <div id="contact-card">
                    <i class="fas fa-clock"></i>
                    <h3 class="text-white">{{ $page->getTranslation('heading2', $lang) }}</h3>
                    <p>{!! $hours !!}</p>
                </div>
            </div>


        </div>
    </section>

    <section id="connect-with-us">
        <div id="social-links-container" class="container">
            <h2>{{ $page->getTranslation('heading4', $lang) }}</h2>
            <p>{{ $page->getTranslation('heading5', $lang) }}</p>

            <div id="social-icons-grid">
                <a href="{{ $page->getTranslation('heading7', $lang) }}"  target="_blank" class="social-icon-card" id="facebook-card">
                    <div class="icon-wrapper">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <h3>Facebook</h3>
                    <p>{{ $page->getTranslation('heading6', $lang) }}</p>
                    <span class="follow-text">Follow Us</span>
                </a>
                <a href="{{ $page->getTranslation('heading9', $lang) }}" target="_blank" class="social-icon-card" id="twitter-x-card">
                    <div class="icon-wrapper">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <h3>Twitter</h3>
                    <p>{{ $page->getTranslation('heading8', $lang) }}</p>
                    <span class="follow-text">Follow Us</span>
                </a>
                <a href="{{ $page->getTranslation('heading11', $lang) }}" target="_blank" class="social-icon-card" id="linkedin-card">
                    <div class="icon-wrapper">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <h3>LinkedIn</h3>
                    <p>{{ $page->getTranslation('heading10', $lang) }}</p>
                    <span class="follow-text">Connect</span>
                </a>
                <a href="{{ $page->getTranslation('heading13', $lang) }}" target="_blank" class="social-icon-card" id="instagram-card">
                    <div class="icon-wrapper">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <h3>Instagram</h3>
                    <p>{{ $page->getTranslation('heading12', $lang) }}</p>
                    <span class="follow-text">Follow Us</span>
                </a>
                <a href="{{ $page->getTranslation('heading15', $lang) }}" target="_blank" class="social-icon-card" id="youtube-card">
                    <div class="icon-wrapper">
                        <i class="fab fa-youtube"></i>
                    </div>
                    <h3>YouTube</h3>
                    <p>{{ $page->getTranslation('heading14', $lang) }}</p>
                    <span class="follow-text">Subscribe</span>
                </a>
            </div>

            <div id="newsletter-signup">
                <h3>{{ $page->getTranslation('heading16', $lang) }}</h3>
                <p>{{ $page->getTranslation('heading17', $lang) }}</p>
                <form id="newsletter-form">
                    @csrf
                    <input type="email" placeholder="Enter your email" id="email" name="email" style="background:white;">
                    <button type="submit">Subscribe</button>
                   
                </form>
                <p id="message" class="mt-2"></p>
            </div>

        </div>
    </section>

    <section id="contact-form-section" style="background-image:url('{{ uploaded_asset($page->image2) }}')">
        <div class="container">
            
            <div class="contact-form-wrapper">
                <h2 class="section-title text-white text-center">{{ $page->getTranslation('heading18', $lang) }}</h2>
                <p class="section-subtitle text-white text-center pb-40">{{ $page->getTranslation('heading19', $lang) }}</p>


                <form id="contact-form">
                    <div class="form-row">
                        <div class="form-column">
                            <input type="text" name="name" id="name" placeholder="Your Name" required>
                            <input type="email" name="emailc" id="emailc" placeholder="Your Email" required>
                            <input type="tel" maxlength="15" name="phone" id="phone" placeholder="Your Phone Number">
                           
                        </div>
                        <div class="form-column">
                            <input type="text" name="subject" id="subject" placeholder="Subject" required>
                            <textarea name="message" id="messagec" placeholder="Your Message" required></textarea>
                            
                        </div>
                    </div>
                    <button type="submit" class="submit-form">Send Message</button>
                </form>
                <p id="responseMessage" class="mt-3"></p>
            </div>
        </div>
    </section>

    <section id="map-section">
        <div class="container">
            <h2 class="section-title">{{ $page->getTranslation('content3', $lang) }}</h2>
            <p class="section-subtitle">{{ $page->getTranslation('content4', $lang) }}</p>

            <div class="map-container">
                <div class="map-wrapper">
                    <!-- Replace the src with your actual Google Maps embed URL -->
                    <iframe src="{{$page->getTranslation('content5', $lang)}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"> </iframe>
                </div>
                <div class="location-info">
                    <h3>{{ $page->getTranslation('content6', $lang) }}</h3>
                    <p><i class="fas fa-map-marker-alt"></i> {!! $page->getTranslation('content', $lang) !!}</p>
                    <p><i class="fas fa-phone"></i>  {!! $phone !!}</p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:{{ $page->getTranslation('heading1', $lang) }}">{{ $page->getTranslation('heading1', $lang) }}</a></p>
                    
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $('#newsletter-form').on('submit', function(e){
        e.preventDefault();

        let email = $('#email').val();
        let _token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ route('newsletter.subscribe') }}",
            type: "POST",
            data: { email: email, _token: _token },
            success: function(response) {
                $('#message').text(response.message).css('color', 'green');
                $('#email').val('');
            },
            error: function(xhr) {
                let error = xhr.responseJSON.errors.email[0];
                $('#message').text(error).css('color', 'red');
            }
        });
    });

    $('#contact-form').on('submit', function(e){
        e.preventDefault();

        let formData = {
            name: $('#name').val(),
            email: $('#emailc').val(),
            phone: $('#phone').val(),
            subject: $('#subject').val(),
            message: $('#messagec').val(),
            _token: $('input[name="_token"]').val()
        };

        $.ajax({
            url: "{{ route('contact.send') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                $('#responseMessage').html(response.message).css('color', 'green');
                $('#contact-form')[0].reset();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = errors ? Object.values(errors).join(', ') : 'Something went wrong';
                $('#responseMessage').text(errorMsg).css('color', 'red');
            }
        });
    });
</script>
@endsection
