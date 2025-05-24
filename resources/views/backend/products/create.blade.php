@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ trans('messages.add') . ' ' . trans('messages.new') . ' ' . trans('messages.product') }}</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" id="addNewProduct" action="{{ route('products.store') }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-10 m-auto">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product') . ' ' . trans('messages.information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">

                                <label
                                    class="col-md-3 col-from-label">{{ trans('messages.product') . ' ' . trans('messages.name') }}
                                    <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name"
                                        placeholder="{{ trans('messages.product') . ' ' . trans('messages.name') }}"
                                        onkeyup="title_update(this)" required>
                                </div>
                            </div>
                            <div class="form-group row" id="category">
                                <label class="col-md-3 col-from-label">{{ trans('messages.category') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                        data-live-search="true" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('backend.categories.child_category', [
                                                    'child_category' => $childCategory,
                                                ])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="brand">
                                <label class="col-md-3 col-from-label">{{ trans('messages.brand') }}</label>
                                <div class="col-md-8">
                                    @php
                                        $brands = \App\Models\Brand::where('is_active', 1)
                                            ->orderBy('name', 'asc')
                                            ->get();
                                    @endphp
                                    <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id"
                                        data-live-search="true" required>
                                        <option value="">{{ trans('messages.select') . ' ' . trans('messages.brand') }}
                                        </option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="service">
                                <label class="col-md-3 col-from-label">{{ trans('messages.service') }}</label>
                                <div class="col-md-8">
                                    <select name="services[]" id="services" multiple class="form-control aiz-selectpicker"
                                        data-live-search="true">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.tags') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control aiz-tag-input" name="tags[]"
                                        placeholder="{{ trans('messages.type_hit_enter_add_tag') }}">
                                    <small class="text-muted">{{ trans('messages.tag_details') }}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">{{ trans('messages.slug') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" placeholder="{{ trans('messages.slug') }}" id="slug"
                                        name="slug" required class="form-control">
                                    @error('slug')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.sku') }} </label>
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ trans('messages.sku') }}" name="sku"
                                        class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product') . ' ' . trans('messages.files') }}</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    for="signinSrEmail">{{ trans('messages.thumbnail_image') }}
                                    <br><small>(Image size - 500 x 500)</small></label>
                                <div class="col-md-8">
                                    <input type="file" name="thumbnail_image" class="form-control" accept="image/*"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">Datasheet (PDF)</label>
                                <div class="col-md-8">
                                    <input type="file" name="datasheet_pdf" class="form-control"
                                        accept="application/pdf">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product') . ' ' . trans('messages.description') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-12 col-from-label">{{ trans('messages.description') }}</label>
                                <div class="col-md-12">
                                    <textarea class="aiz-text-editor" data-min-height="300" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product') . ' Specifications' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-12 col-from-label">Specifications</label>
                                <div class="col-md-12">
                                    <textarea class="aiz-text-editor" data-min-height="300" name="specification"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.seo_section') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.meta_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="meta_title"
                                        placeholder="{{ trans('messages.meta_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.meta_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="meta_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.meta_keywords') }}</label>
                                <div class="col-md-8">
                                    {{-- data-max-tags="1" --}}
                                    <input type="text" class="form-control aiz-tag-input" name="meta_keywords[]"
                                        placeholder="{{ trans('messages.type_hit_enter_add_keyword') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="og_title"
                                        placeholder="{{ trans('messages.og_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="og_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="twitter_title"
                                        placeholder="{{ trans('messages.twitter_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="twitter_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-10  m-auto">
                    <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="submit" name="button" value="draft"
                                class="btn btn-cancel action-btn">{{ trans('messages.save_draft') }}</button>
                        </div>

                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" name="button" value="publish"
                                class="btn btn-info action-btn">{{ trans('messages.save_publish') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <style>

    </style>
@endsection
@section('script')
    <script>
        let buttons = [
            ["font", ["bold", "underline", "italic", "clear"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["style", ["style"]],
            ["color", ["color"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "undo", "redo"]],
        ];
        $('.description-text-area').summernote({
            toolbar: buttons,
            height: 300,
            callbacks: {
                onImageUpload: function(data) {
                    data.pop();
                },
                onPaste: function(e) {
                    if (format) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window
                            .clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            }
        });
    </script>

    <script type="text/javascript">
        $('form').bind('submit', function(e) {
            if ($(".action-btn").attr('attempted') == 'true') {
                e.preventDefault();
            } else {
                $(".action-btn").attr("attempted", 'true');
            }
        });

        function title_update(e) {
            title = e.value;
            title = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
            $('#slug').val(title)
        }
    </script>
@endsection
