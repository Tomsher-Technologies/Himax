@extends('frontend.layouts.app')
@section('content')
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
                        Products
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section>
        <div class="container">
            <div id="product-dt">
                <div id="product-dt-images">
                    <div id="main-image-slider" class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="{{ get_product_image($product->thumbnail_img ?? '', '300') }}" alt="Camera Image 1">
                            </div>
                        </div>
                        <!-- Navigation buttons -->
                        {{-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> --}}
                    </div>
                    {{-- <div id="thumbnail-gallery" class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="{{ get_product_image($product->thumbnail_img, '300') }}" alt="Thumbnail 1"></div>
                        </div>
                    </div> --}}
                </div>

                <div id="product-dt-info">
                    <h1 id="product-title">{{ $product->getTranslation('name', $lang) }}</h1>
                    <p id="product-model">Brand: {{ $product->brand->getTranslation('name', $lang) }}</p>
                    <p id="product-description">
                        {!! $product->getTranslation('description', $lang) !!}
                    </p>
{{-- 
                    <div id="product-features">
                        <h3>Key Features:</h3>
                        <ul>
                            <li>1080p Full HD resolution for clear images</li>
                            <li>Weatherproof design for outdoor use</li>
                            <li>Night vision up to 30 meters</li>
                            <li>Motion detection with customizable alerts</li>
                            <li>Easy setup with mobile app support</li>
                        </ul>
                    </div> --}}

                    <a href="#" id="cta-button" class=" mt-4"  data-bs-toggle="modal" data-bs-target="#enquiryModal">Request a Quote</a>

                    @if ($product->datasheet_pdf != NULL)
                        <a href="{{ asset($product->datasheet_pdf) }}" target="_blank" id="cta-button" class=" mt-3">Product Datasheet</a>
                    @endif
                    

                    <div id="product-specs">
                        <h3>Specifications:</h3>
                        {{-- <table id="spec-table">
                            <tr>
                                <th>Image Sensor</th>
                                <td>1/2.9" CMOS</td>
                            </tr>
                            <tr>
                                <th>Max Resolution</th>
                                <td>1920 x 1080</td>
                            </tr>
                            <tr>
                                <th>Frame Rate</th>
                                <td>30fps @ 1080p</td>
                            </tr>
                            <tr>
                                <th>Lens</th>
                                <td>3.6mm</td>
                            </tr>
                            <tr>
                                <th>Viewing Angle</th>
                                <td>90°</td>
                            </tr>
                        </table> --}}
                        {!! $product->getTranslation('specification', $lang) !!}
                    </div>


                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryModalLabel">Request a Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productEnquiryForm" class="row">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <div class="col-sm-6 mb-3">
                            <label for="name" class="form-label">Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" >
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="email" class="form-label">Email <span style="color: red">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" >
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="phone" class="form-label">Phone <span style="color: red">*</span></label>
                            <input type="tel" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="phone" id="phone" placeholder="Your Phone" >
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="phone" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" >
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="message" class="form-label">Message <span style="color: red">*</span></label>
                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Your Message" ></textarea>
                        </div>
                        <div class="col-sm-12 mb-3 text-center">
                            <button type="submit" class="btn btn-success w-50"  id="submitButton">
                                <span id="btnText">Submit Enquiry</span>
                                <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none"></span>
                            </button>
                            <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </div>
                        <p id="responseMessage" class="mt-2"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('header')
<style>
    /* Product Details Styling */
    #product-dt {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        background-color: #fff;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        border-radius: 8px;
        padding: 30px;
    }

    /* Product Images Styling */
    #product-dt-images {
        flex: 1;
        min-width: 300px;
    }

    /* Main Image Slider Styling */
    #product-dt #main-image-slider {
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        position: relative;
    }

    #product-dt #main-image-slider img {
        width: 500px;
        height: 500px;
        margin-top: 100px;
        margin-bottom: 100px;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        display: block;
        object-fit: cover;
        transition: transform 0.3s ease;
    }


    /* Navigation Arrows Styling */
    #product-d .swiper-button-next,
    #product-d .swiper-button-prev {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #000 !important;
        background-color: transparent;
        padding: 10px;
        border-radius: 50%;
        z-index: 10;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    #product-d .swiper-button-next:hover,
    #product-d .swiper-button-prev:hover {
   
        
        background-color: transparent;

    }

    #product-d .swiper-button-next {
        right: 10px;
    }

    #product-d .swiper-button-prev {
        left: 10px;
    }

    /* Thumbnail Gallery Styling */
    #product-dt #thumbnail-gallery {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        justify-content: center;
    }

    #product-dt #thumbnail-gallery .swiper-slide {
        width: 80px;
        height: 80px;
        cursor: pointer;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #product-dt #thumbnail-gallery .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    #product-dt #thumbnail-gallery .swiper-slide:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Product Info Styling */
    #product-dt-info {
        flex: 1;
        min-width: 300px;
        padding: 20px;
    }

    #product-dt #product-title {
        font-size: 2em;
        font-weight: bold;
        margin-bottom: 10px;
        color: var(--primary-color);
    }

    #product-model {
        font-size: 1.2em;
        color: #777;
        margin-bottom: 20px;
    }

    #product-description {
        font-size: 1em;
        line-height: 1.7;
        margin-bottom: 30px;
        color: #555;
    }

    /* Product Features Styling */
    #product-features h3,
    #product-specs h3 {
        font-size: 1.4em;
        margin-bottom: 15px;
        color: var(--primary-color);
        border-bottom: 2px solid #eee;
        padding-bottom: 5px;
    }

    #product-features {

        padding-bottom: 20px;
    }

    #product-features ul {
        list-style-type: none;
        padding-left: 0;
    }

    #product-features li {
        margin-bottom: 8px;
        padding-left: 25px;
        position: relative;
    }

    #product-features li:before {
        content: '\2022';
        position: absolute;
        left: 0;
        color: var(--secondary-color);
        font-size: 1.5em;
    }

    /* Product Specs Styling */



    #product-specs {

        padding-top: 20px;
    }




    #spec-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    #spec-table th,
    #spec-table td {
        padding: 12px 15px;
        border: 1px solid #eee;
        text-align: left;
    }

    #spec-table th {
        background-color: #f9f9f9;
        font-weight: bold;
        color: var(--primary-color);
    }

    /* CTA Button Styling */
    #cta-button {
        display: inline-block;
        padding: 12px 30px;
        font-size: 1.1em;
        text-decoration: none;
        background-color: var(--secondary-color);
        color: white;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #cta-button:hover {
        background-color: #931c1e;
        /* Darken slightly on hover */
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #product-dt {
            flex-direction: column;
        }

        #product-dt-images,
        #product-dt-info {
            min-width: 100%;
        }

        #product-title {
            font-size: 2em;
        }

        #product-model {
            font-size: 1em;
        }

        #product-description {
            font-size: 0.9em;
        }

        #product-features h3,
        #product-specs h3 {
            font-size: 1.2em;
        }

        #cta-button {
            font-size: 1em;
        }
    }
</style>
@endsection

@section('script')

<script>
    $(document).ready(function(){
        $('#productEnquiryForm').on('submit', function(e){
            e.preventDefault();

            $('#submitButton').attr('disabled', true);
            $('#btnText').text('Submitting...');
            $('#loadingSpinner').removeClass('d-none');

            let formData = {
                product_id: $('#product_id').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                quantity: $('#quantity').val(),
                message: $('#message').val(),
                _token: $('input[name="_token"]').val()
            };

            $.ajax({
                url: "{{ route('product.enquiry') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    $('#responseMessage').html(response.message).css('color', 'green');
                    $('#productEnquiryForm')[0].reset();
                    $('#submitButton').attr('disabled', false);
                    $('#btnText').text('Submit Enquiry');
                    $('#loadingSpinner').addClass('d-none');
                    setTimeout(() => {
                        $('#enquiryModal').modal('hide');
                        $('#responseMessage').text('');
                    }, 2000);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = errors ? Object.values(errors).join('<br> ') : 'Something went wrong';
                    $('#responseMessage').html('<div class="alert alert-danger">'+errorMsg+'</div>').css('color', 'red');
                    // Hide loading effect & reset button
                    $('#submitButton').attr('disabled', false);
                    $('#btnText').text('Submit Enquiry');
                    $('#loadingSpinner').addClass('d-none');
                }
            });
        });
    });
    </script>
@endsection
