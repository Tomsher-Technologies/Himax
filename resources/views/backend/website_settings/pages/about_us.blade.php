@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">Edit Page Information</h1>
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
                <h5 class="fw-600 mb-0">Page Contents</h5>
            </div>
            <div class="card-body px-0">
                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Banner Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title<span class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title"
                            value="{{ $page->getTranslation('title', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">Image
                        <br> <small>(Image size - 1920 x 520)</small>
                    </label>
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
                    <h6 class="mb-1 ml-3"><u>About Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title1"
                            value="{{ old('title1', $page->getTranslation('title1', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="sub_title"
                            value="{{ old('sub_title', $page->getTranslation('sub_title', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="{{ trans('messages.content') }}"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content">{!! $page->getTranslation('content', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">Image <br> <small>(Image size - 800 x
                            800)</small></label>
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
                    <h6 class="mb-1 mt-2 col-sm-4">Count Section</h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Count Value 1<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title2"
                            value="{{ old('title2', $page->getTranslation('title2', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Count Title 1<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="title3"
                            value="{{ old('title3', $page->getTranslation('title3', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Count Value 2<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading1"
                            value="{{ old('heading1', $page->getTranslation('heading1', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Count Title 2<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading2"
                            value="{{ old('heading2', $page->getTranslation('heading2', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Who We Are Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading3"
                            value="{{ old('heading3', $page->getTranslation('heading3', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading4"
                            value="{{ old('heading4', $page->getTranslation('heading4', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="{{ trans('messages.content') }}"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content1">{!! $page->getTranslation('content1', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Discover Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">Background Image<br> <small>(Image size -
                            1920 x 668)</small></label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ trans('messages.browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                            <input type="hidden" name="image33" class="selected-files" value="{{ $page->image3 }}">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading5"
                            value="{{ old('heading5', $page->getTranslation('heading5', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Youtube Video Link<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading6"
                            value="{{ old('heading6', $page->getTranslation('heading6', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Partners Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading7" value="{{ old('heading7', $page->getTranslation('heading7', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading8" value="{{ old('heading8', $page->getTranslation('heading8', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Enter..." name="content2" rows="5">{!! $page->getTranslation('content2', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">Video Image
                        <br> <small>(Image size - 774 x 334)</small>
                    </label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ trans('messages.browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                            <input type="hidden" name="image44" class="selected-files" value="{{ $page->image4 }}">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Youtube Video Link<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter..." name="heading9"
                            value="{{ old('heading9', $page->getTranslation('heading9', $lang)) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-from-label">Brands</label>
                    <div class="col-md-10">
                        <input type="hidden" name="types[]" value="about_brands">
                        <select name="about_brands[]" id="about_brands" class="form-control aiz-selectpicker" multiple
                            data-live-search="true" data-actions-box="true"
                            data-selected="{{ get_setting('about_brands') }}">

                            @foreach (\App\Models\Brand::where('is_active', 1)->get() as $key => $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Mission & Vision Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading10" value="{{ old('heading10', $page->getTranslation('heading10', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading11" value="{{ old('heading11', $page->getTranslation('heading11', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Mission Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading12" value="{{ old('heading12', $page->getTranslation('heading12', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Mission Content<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="{{ trans('messages.content') }}"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content3">{!! $page->getTranslation('content3', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Vision Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading13" value="{{ old('heading13', $page->getTranslation('heading13', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Vision Content<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="{{ trans('messages.content') }}"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content4">{!! $page->getTranslation('content4', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Core Values Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading14" value="{{ old('heading14', $page->getTranslation('heading14', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading15" value="{{ old('heading15', $page->getTranslation('heading15', $lang)) }}"
                            required>
                    </div>
                </div>

                @php
                    $content5 = $page->getTranslation('content5', $lang);
                    $points = $content5 != 'null' && $content5 != null ? json_decode($content5, true) : [];
                @endphp
                @for ($i = 0; $i < 5; $i++)
                    <div class="form-group row">
                        <h6 class="ml-3">Point {{ $i + 1 }}</h6>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="name">Title <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter..."
                                name="points[{{ $i }}][title]" value="{!! $points[$i]['title'] ?? '' !!}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Subtitle"
                                name="points[{{ $i }}][sub_title]" value="{!! $points[$i]['sub_title'] ?? '' !!}" required>
                        </div>
                    </div>
                @endfor

                <div class="form-group row">
                    <h6 class="mb-1 ml-3"><u>Footer Section</u></h6>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading16" value="{{ old('heading16', $page->getTranslation('heading16', $lang)) }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Button Text <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}"
                            name="heading17" value="{{ old('heading17', $page->getTranslation('heading17', $lang)) }}"
                            required>
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
    <script>
        $(document).ready(function() {
            var lang = '{{ $lang }}';

            if (lang == 'ae') {
                setEditorDirection(true);
            } else {
                setEditorDirection(false);
            }

            function setEditorDirection(isRtl) {
                const editor = $('.aiz-text-editor').next('.note-editor').find('.note-editable');
                editor.attr('dir', isRtl ? 'rtl' : 'ltr'); // Set direction
                editor.css('text-align', isRtl ? 'right' : 'left');
            }

            $('.aiz-selectpicker').on('shown.bs.select', function() {
                var select = $(this);
                var selectedOptions = select.find('option:selected').detach();
                select.prepend(selectedOptions);
                select.selectpicker('refresh');
            });
        });
    </script>
@endsection
