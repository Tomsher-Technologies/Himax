@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h1 class="mb-0 h6">Edit Product</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-10 m-auto">
                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <div class="card">
                        <div class="card-body p-0">
                            {{-- <ul class="nav nav-tabs nav-fill border-light">
                                @foreach (\App\Models\Language::all() as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                            href="{{ route('products.edit', ['id' => $product->id, 'lang' => $language->code]) }}">
                                            <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                height="11" class="mr-1">
                                            <span>{{ $language->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul> --}}
                            <div class=" p-4">
                                <div class="form-group row ">
                                    <label class="col-lg-3 col-from-label">{{ trans('messages.product').' '.trans('messages.name') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="name" placeholder="{{ trans('messages.product').' '.trans('messages.name') }}"
                                            value="{{ $product->getTranslation('name',$lang) }}" required>
                                    </div>
                                </div>
                                <div class="form-group row @if ($lang != 'en') d-none @endif" id="category">
                                    <label class="col-lg-3 col-from-label">{{ trans('messages.category') }}<span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                            data-selected="{{ $product->category_id }}" data-live-search="true" required>
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

                                <div class="form-group row @if ($lang != 'en') d-none @endif" id="brand">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.brand') }}</label>
                                    <div class="col-md-8">
                                        @php   
                                            $brands = \App\Models\Brand::where('is_active',1)->orderBy('name','asc')->get();
                                        @endphp
                                        <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id"
                                            data-live-search="true" required>
                                            <option value="">{{ trans('messages.select').' '.trans('messages.brand') }}</option>
                                            @foreach ($brands as $brand)
                                                <option @if ($product->brand_id == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="form-group row" id="service">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.service') }}</label>
                                    <div class="col-md-8">
                                        <select name="services[]" id="services" multiple class="form-control aiz-selectpicker" data-live-search="true">
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" {{ in_array($service->id, old('services', $product->services->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
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
                                            placeholder="{{ trans('messages.type_hit_enter_add_tag') }}" value="{{ $product->getTranslation('tags',$lang) }}" >
                                        <small class="text-muted">{{ trans('messages.tag_details') }}</small>
                                    </div>
                                </div>

                                <div class="form-group row @if ($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">{{ trans('messages.slug') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="{{ trans('messages.slug') }}" id="slug" name="slug" required
                                            class="form-control" value="{{ $product->slug }}">
                                        @error('slug')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.sku') }} </label>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="{{ trans('messages.sku') }}" name="sku" class="form-control"  value="{{ $product->stocks[0]->sku ?? $product->sku }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card  @if ($lang != 'en') d-none @endif">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' '.trans('messages.images') }}</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-group row @if ($lang != 'en') d-none @endif">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{ trans('messages.thumbnail_image') }}
                                    <small>({{ trans('messages.1000*1000') }})</small></label>
                                <div class="col-md-8">
                                    <input type="file" name="thumbnail_image" class="form-control" accept="image/*">

                                    @if ($product->thumbnail_img)
                                        <div class="file-preview box sm">
                                            <div
                                                class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                                <div
                                                    class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                    <img src="{{ $product->image($product->thumbnail_img) }}"
                                                        class="img-fit">
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-link remove-thumbnail" type="button">
                                                        <i class="la la-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">Datasheet (PDF)</label>
                                <div class="col-md-8">
                                    <input type="file" name="datasheet_pdf" class="form-control" accept="application/pdf">
    
                                    @if ($product->datasheet_pdf)
                                        <div class="file-preview box sm">
                                            <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                                <div class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                    <a href="{{ asset($product->datasheet_pdf) }}" target="_blank">
                                                        <img src="{{ asset('assets/images/pdf.png') }}" class="img-fit">
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-link remove-datasheet" type="button">
                                                        <i class="la la-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
    
                                </div>
                            </div>
                        </div>
                       
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' '.trans('messages.description') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-12 col-from-label">{{trans('messages.description') }}</label>
                                <div class="col-md-12">
                                    <textarea class="aiz-text-editor"  data-min-height="300" name="description">{{ $product->getTranslation('description',$lang) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' Specifications' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-12 col-from-label">Specifications</label>
                                <div class="col-md-12">
                                    <textarea class="aiz-text-editor" data-min-height="300" name="specification">
                                        {{ $product->getTranslation('specification',$lang) }}
                                    </textarea>
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
                                    <input type="text" class="form-control"
                                        value="{{ $product->getSeoTranslation('meta_title',$lang) }}" name="meta_title"
                                        placeholder="Meta Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.meta_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="meta_description" rows="8" class="form-control">{{ $product->getSeoTranslation('meta_description',$lang) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.meta_keywords') }}</label>
                                <div class="col-md-8">
                                    {{-- data-max-tags="1" --}}
                                    <input type="text" class="form-control aiz-tag-input" name="meta_keywords[]"
                                        placeholder="Type and hit enter to add a keyword"
                                        value="{{ $product->getSeoTranslation('meta_keywords',$lang) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="og_title" placeholder="{{ trans('messages.og_title') }}"
                                        value="{{ $product->getSeoTranslation('og_title',$lang) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="og_description" rows="8" class="form-control">{{ $product->getSeoTranslation('og_description',$lang)  }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="twitter_title"
                                        placeholder="{{ trans('messages.twitter_title') }}"
                                        value="{{ $product->getSeoTranslation('twitter_title',$lang) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="twitter_description" rows="8" class="form-control">{{ $product->getSeoTranslation('twitter_description',$lang) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3 text-right">
                        <button type="submit" name="button" class="btn btn-info">{{ trans('messages.update').' '.trans('messages.product') }}</button>
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

        $('.remove-thumbnail').on('click', function() {
            thumbnail = $(this)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('products.delete_thumbnail') }}',
                data: {
                    id: '{{ $product->id }}'
                },
                success: function(data) {
                    $(thumbnail).closest('.file-preview-item').remove();
                }
            });

        });
       
    </script>

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
            height: 200,
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
     
        AIZ.plugins.tagify();

        $(document).ready(function() {
            $('.remove-files').on('click', function() {
                $(this).parents(".col-md-4").remove();
            });
        });

      
    </script>
@endsection
