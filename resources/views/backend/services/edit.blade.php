@extends('backend.layouts.app')

@section('content')
    <style>
        .remove-attachment {
            display: none;
        }
    </style>

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h4">{{ trans('messages.service').' '.trans('messages.information') }}</h5>
    </div>

    <div class="col-lg-11 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                {{-- <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Models\Language::all() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                href="{{ route('service.edit', ['id' => $service->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul> --}}
                <form class="p-4" action="{{ route('service.update', $service->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Type</label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="type" id="type" required>
                                <option value="">Select</option>
                                <option {{ old('type', $service->type) == 'service' ? 'selected' : '' }} value="service">Service</option>
                                <option {{ old('type', $service->type) == 'solution' ? 'selected' : '' }} value="solution">Solution</option>
                            </select>
                            @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{trans('messages.name')}} <i
                                class="las la-language text-danger" title="{{ trans('messages.translatable') }}"></i></label>
                        <div class="col-md-10">
                            <input type="text" name="name" value="{{ $service->getTranslation('name', $lang) }}" class="form-control" id="name" onchange="title_update(this)" placeholder="{{ trans('messages.name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ trans('messages.slug') }}<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" placeholder="{{ trans('messages.slug') }}" id="slug" name="slug" class="form-control" value="{{ $service->slug }}">
                            @error('slug')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">{{ trans('messages.image') }}</label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ trans('messages.browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                <input type="hidden" name="image" value="{{  $service->image }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-from-label">Short Description</label>
                        <div class="col-md-10">
                            <textarea class="aiz-text-editor" data-min-height="300" name="short_description">{{ old('short_description', $service->getTranslation('short_description', $lang)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-from-label">{{trans('messages.description') }}</label>
                        <div class="col-md-10">
                            <textarea class="aiz-text-editor" data-min-height="300" name="description">{{ old('description', $service->getTranslation('description', $lang)) }}</textarea>
                        </div>
                    </div>

                    @if ($lang == 'en')
                        <div class="form-group  row">
                            <label class="col-md-2 col-form-label">{{ trans('messages.active_status') }}</label>
                            <div class="col-md-10">
                                <select class="select2 form-control" name="status">
                                    <option {{ old('status', $service->status) == 1 ? 'selected' : '' }} value="1">{{ trans('messages.yes') }}
                                    </option>
                                    <option {{ old('status', $service->status) == 0 ? 'selected' : '' }} value="0">{{ trans('messages.no') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <h5 class="mb-0 h6">Home Page Points</h5>
                    <hr>

                    <div class="repeater">
                        <div data-repeater-list="points">
                          
                            <div data-repeater-item >
                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label">Point</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" >
                                    </div>
                                </div>
    
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-soft-danger" data-repeater-delete>Delete</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-soft-success mb-2" data-repeater-create>Add New </button>
                    </div>

                    <h5 class="mb-0 h6">{{trans('messages.seo_section')}}</h5>
                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">{{trans('messages.meta_title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="meta_title"
                                placeholder="{{trans('messages.meta_title')}}" value="{{ old('meta_title', $service->getTranslation('meta_title', $lang)) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                            for="name">{{trans('messages.meta_description')}}</label>
                        <div class="col-md-10">
                            <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description', $service->getTranslation('meta_description', $lang)) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">{{trans('messages.meta_keywords')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="meta_keywords"
                                placeholder="{{trans('messages.meta_keywords')}}" value="{{ old('meta_keywords', $service->getTranslation('meta_keywords', $lang)) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">{{trans('messages.og_title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="og_title"
                                placeholder="{{trans('messages.og_title')}}" value="{{ old('og_title', $service->getTranslation('og_title', $lang)) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                            for="name">{{trans('messages.og_description')}}</label>
                        <div class="col-md-10">
                            <textarea name="og_description" rows="5" class="form-control">{{ old('og_description', $service->getTranslation('og_description', $lang)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                            for="name">{{trans('messages.twitter_title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="twitter_title"
                                placeholder="{{trans('messages.twitter_title')}}" value="{{ old('twitter_title', $service->getTranslation('twitter_title', $lang)) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                            for="name">{{trans('messages.twitter_description')}}</label>
                        <div class="col-md-10">
                            <textarea name="twitter_description" rows="5" class="form-control">{{ old('twitter_description', $service->getTranslation('twitter_description', $lang)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Save') }}</button>
                        <a href="{{ route('service.index') }}" class="btn btn-cancel">{{trans('messages.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
        $points = [];
        foreach ($service->points as $key => $point) {
            $points[$key]['service_id'] = $point->id;
            $points[$key]['title'] = $point->title;
        }
    @endphp


@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery.repeater/jquery.repeater.min.js"></script>
    <script>
    function title_update(e) {
        var title = e.value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('generate-slug') }}",
            type: 'GET',
            data: {
                title: title
            },
            success: function(response) {
                $('#slug').val(response);
            }
        });
    }

    $(document).ready(function () {
        var repeater =  $('.repeater').repeater({
                        initEmpty: false,
                        show: function() {
                            $(this).slideDown();
                            // updateRepeaterHeadings();
                        },
                        hide: function(deleteElement) {
                            if (confirm('Are you sure you want to delete this element?')) {
                                $(this).slideUp(deleteElement);
                                // updateRepeaterHeadings();
                            }
                        },
                    });

        repeater.setList({!! json_encode($points) !!});
    });

    </script>
@endsection

