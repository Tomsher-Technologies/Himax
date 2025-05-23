@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">Edit {{ $page->slug }} Page Information</h1>
            </div>
        </div>
    </div>
    <div class="card">
        {{-- <ul class="nav nav-tabs nav-fill border-light">
            @foreach (\App\Models\Language::all() as $key => $language)
                <li class="nav-item">
                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->type, 'lang'=> $language->code] ) }}">
                        <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                        <span>{{$language->name}}</span>
                    </a>
                </li>
            @endforeach
        </ul> --}}

        <form class="p-4" action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name='lang' value="{{ $lang }}">
            <input type="hidden" name="page_id" value="{{ $page_id }}">

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Page Content</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Banner Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title<span class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title"
                            value="{{ $page->getTranslation('title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">Image <br> <small>(Image size - 1920 x
                            520)</small></label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ trans('messages.browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                            <input type="hidden" name="image11" class="selected-files" value="{{ $page->image1 }}">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Connect Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title1"
                            value="{{ old('title1', $page->getTranslation('title1', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="sub_title"
                            value="{{ old('sub_title', $page->getTranslation('sub_title', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Address Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title2"
                            value="{{ old('title2', $page->getTranslation('title2', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="content">Address Content<span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="content">{!! $page->getTranslation('content', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Email Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading3"
                            value="{{ old('heading3', $page->getTranslation('heading3', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="sub_heading2">Email Content<span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" placeholder="Email" name="heading1"
                            value="{{ $page->getTranslation('heading1', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Phone Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title3"
                            value="{{ old('title3', $page->getTranslation('title3', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="heading2">Phone Content<span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Phone" name="content1"
                            value="{{ $page->getTranslation('content1', $lang) }}">
                        <span class="text-muted">((If you want to add multiple phone numbers, please separate each value
                            with a /.))</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Working Hours Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading2"
                            value="{{ old('heading2', $page->getTranslation('heading2', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="content2">Working Hours Content<span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Phone" name="content2"
                            value="{{ $page->getTranslation('content2', $lang) }}">
                        <span class="text-muted">((If you want to add multiple Working Hours, please separate each value
                            with a /.))</span>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Social Media Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading4"
                            value="{{ old('heading4', $page->getTranslation('heading4', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading5"
                            value="{{ old('heading5', $page->getTranslation('heading5', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Facebook</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Social Media Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading6"
                            value="{{ old('heading6', $page->getTranslation('heading6', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Link <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading7"
                            value="{{ old('heading7', $page->getTranslation('heading7', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Twitter</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Social Media Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading8"
                            value="{{ old('heading8', $page->getTranslation('heading8', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Link <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading9"
                            value="{{ old('heading9', $page->getTranslation('heading9', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>LinkedIn</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Social Media Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading10"
                            value="{{ old('heading10', $page->getTranslation('heading10', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Link <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading11"
                            value="{{ old('heading11', $page->getTranslation('heading11', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Instagram</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Social Media Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading12"
                            value="{{ old('heading12', $page->getTranslation('heading12', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Link <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading13"
                            value="{{ old('heading13', $page->getTranslation('heading13', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>YouTube</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Social Media Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading14"
                            value="{{ old('heading14', $page->getTranslation('heading14', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Link <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading15"
                            value="{{ old('heading15', $page->getTranslation('heading15', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Newsletter Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading16"
                            value="{{ old('heading16', $page->getTranslation('heading16', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading17"
                            value="{{ old('heading17', $page->getTranslation('heading17', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Contact Form Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading18"
                            value="{{ old('heading18', $page->getTranslation('heading18', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading19"
                            value="{{ old('heading19', $page->getTranslation('heading19', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">Background Image
                        <br> <small>(Image size - 1920 x 673)</small>
                    </label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ trans('messages.browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                            <input type="hidden" name="image22" class="selected-files" value="{{ $page->image2 }}">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Google Map Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="content3"
                            value="{{ old('content3', $page->getTranslation('content3', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="content4"
                            value="{{ old('content4', $page->getTranslation('content4', $lang)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Map Link <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" placeholder="Enter..." name="content5" rows="4">{{ old('content5', $page->getTranslation('content5', $lang)) }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Contacts Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="content6"
                            value="{{ old('content6', $page->getTranslation('content6', $lang)) }}">
                    </div>
                </div>

            </div>

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Seo Fields</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" @if ($lang == 'ae') dir="rtl" @endif class="form-control"
                            placeholder="{{ trans('messages.meta_title') }}" name="meta_title"
                            value="{{ $page->getTranslation('meta_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label"
                        for="name">{{ trans('messages.meta_description') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.meta_description') }}" name="meta_description">{!! $page->getTranslation('meta_description', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_keywords') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.meta_keywords') }}" name="keywords">{!! $page->getTranslation('keywords', $lang) !!}</textarea>
                        <small class="text-muted">Separate with coma</small>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" @if ($lang == 'ae') dir="rtl" @endif class="form-control"
                            placeholder="{{ trans('messages.og_title') }}" name="og_title"
                            value="{{ $page->getTranslation('og_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_description') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.og_description') }}" name="og_description">{!! $page->getTranslation('og_description', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.twitter_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" @if ($lang == 'ae') dir="rtl" @endif class="form-control"
                            placeholder="{{ trans('messages.twitter_title') }}" name="twitter_title"
                            value="{{ $page->getTranslation('twitter_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label"
                        for="name">{{ trans('messages.twitter_description') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.twitter_description') }}" name="twitter_description">{!! $page->getTranslation('twitter_description', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update Page</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places&v=weekly"></script>
    <script src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>

    <script>
        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            loadMap(lat, lng)
        }

        function showPositionerror() {
            loadMap(25.2048, 55.2708)
        }

        function loadMap(lat, lng) {
            $('#us3').locationpicker({
                zoom: 12,
                location: {
                    latitude: lat,
                    longitude: lng
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
        }

        $(document).ready(function() {
            loadMap({{ $page->heading4 ?? '25.2048' }}, {{ $page->heading5 ?? '55.2708' }})
            // if (navigator.geolocation) {
            //     console.log(navigator.geolocation);
            //     navigator.geolocation.watchPosition(showPosition, showPositionerror);
            // } else {
            //     console.log("asas");
            //     loadMap(25.2048, 55.2708)
            // }
        });
    </script>
@endsection
