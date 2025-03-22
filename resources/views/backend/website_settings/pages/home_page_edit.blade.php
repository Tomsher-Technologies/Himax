@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-xl-10 mx-auto">
            <h4 class="fw-600">Home Page Settings</h4>


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
                <div class="card-header">
                    <h5 class="mb-0">Landing Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading15" value="{{ old('heading15', $page->getTranslation('heading15', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading16" value="{{ old('heading16', $page->getTranslation('heading16', $lang)) }}" required>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Content</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Enter..." name="content6" rows="5">{!! $page->getTranslation('content6',$lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading17" value="{{ old('heading17', $page->getTranslation('heading17', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="signinSrEmail">Video</label>
                            <div class="col-md-10">
                                <input type="file" name="video" accept="video/mp4,video/x-m4v,video/*" class="form-control" value="{{ old('video') }}">

                                @if ($page->video)
                                    <div class="file-preview box md">
                                        <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                            <div class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                <video autoplay muted loop id="myVideo" class="w-100">
                                                    <source src="{{ asset($page->video) }}" type="video/mp4">
                                                </video>
                                            </div>
                                           
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label">Categories<br> </label> 
                            {{-- (Max 8) --}}
                            <div class="col-sm-10 new_collection-categories-target">
                                <input type="hidden" name="types[]" value="home_categories">
                               
                                <input type="hidden" name="lang" value="{{ $lang }}">
                                
                                @if (get_setting('home_categories') != null && get_setting('home_categories') != 'null')
                                    @foreach (json_decode(get_setting('home_categories'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" data-selected={{ $value }}
                                                        required>
                                                        <option value="">Select Category</option>
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
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="mt-1 btn btn-icon btn-circle btn-soft-danger"
                                                    data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-soft-primary" data-toggle="add-more" id="addMoreBtn"
                                data-content='<div class="row gutters-5">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" required>
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $key => $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @foreach ($category->childrenCategories as $childCategory)
                                                            @include('backend.categories.child_category', [
                                                                'child_category' => $childCategory,
                                                            ])
                                                            @endforeach
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>'
                                    data-target=".new_collection-categories-target">
                                    Add New
                                </button>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">About Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="title" value="{{ old('title', $page->getTranslation('title', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="sub_title" value="{{ old('sub_title', $page->getTranslation('sub_title', $lang)) }}" required>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Content</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Enter..." name="content" rows="5">{!! $page->getTranslation('content',$lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="signinSrEmail">Image</label>
                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control" accept="image/*">
        
                                @if ($page->image)
                                    <div class="file-preview box sm">
                                        <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                            <div class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                <img src="{{ asset($page->image) }}" class="img-fit">
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <h6 class="mb-1 mt-2 col-sm-4"><b><u>Count Section</u></b></h6>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Count Value 1<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="title1" value="{{ old('title1', $page->getTranslation('title1', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Count Title 1<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="title2" value="{{ old('title2', $page->getTranslation('title2', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Count Value 2<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="title3" value="{{ old('title3', $page->getTranslation('title3', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Count Title 2<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading1" value="{{ old('heading1', $page->getTranslation('heading1', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading2" value="{{ old('heading2', $page->getTranslation('heading2', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Middle Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading18" value="{{ old('heading18', $page->getTranslation('heading18', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading19" value="{{ old('heading19', $page->getTranslation('heading19', $lang)) }}" required>
                            </div>
                        </div>
                        
                        <div class="repeater">
                            <div data-repeater-list="home_points">
                                @if (!empty($home_points[0]))
                                    @foreach ($home_points as $key => $point)
                                        <div data-repeater-item >
                                            <hr>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-from-label">Point</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control" value="{{$point->title}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label" for="signinSrEmail">Image</label>
                                                <div class="col-md-10">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ trans('messages.browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                                        <input type="hidden" name="icon" class="selected-files"
                                                            value="{{$point->image}}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group text-right">
                                                <button type="button" class="btn btn-soft-danger" data-repeater-delete>Delete</button>
                                            </div>
                                        </div>                                     
                                    @endforeach
                                @else
                                    <div data-repeater-item >
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-from-label">Point</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="signinSrEmail">Image</label>
                                            <div class="col-md-10">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                            {{ trans('messages.browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                                    <input type="hidden" name="icon" class="selected-files"
                                                        value="">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-soft-danger" data-repeater-delete>Delete</button>
                                        </div>
                                    </div> 
                                @endif
                                    


                                
                            </div>
                            <button type="button" class="btn btn-soft-success mb-2" data-repeater-create>Add New </button>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Our Services Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading3" value="{{ old('heading3', $page->getTranslation('heading3', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading4" value="{{ old('heading4', $page->getTranslation('heading4', $lang)) }}" required>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Content</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Enter..." name="content1" rows="5">{!! $page->getTranslation('content1',$lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row @if($lang != 'en') d-none @endif">
                            <label class="col-md-2 col-from-label">Services & Solutions</label>
                            <div class="col-md-10">
                                <input type="hidden" name="types[]" value="featured_services">
                                <input type="hidden" name="page_type" value="featured_services">
                                <select name="featured_services[]" class="form-control aiz-selectpicker" multiple data-actions-box="true" data-live-search="true" title="Select" data-selected="{{ get_setting('featured_services') }}">
                                    {{-- <option disabled value=""></option> --}}
                                    @foreach ($services as $key => $serv)
                                        <option value="{{ $serv->id }}">{{ $serv->getTranslation('name', 'en') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Featured Products</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Heading <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading5" value="{{ old('heading5', $page->getTranslation('heading5', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Sub Heading<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading6" value="{{ old('heading6', $page->getTranslation('heading6', $lang)) }}" required>
                            </div>
                        </div>
                    
                        <div class="form-group row @if($lang != 'en') d-none @endif">
                            <label class="col-md-2 col-from-label">{{ trans('messages.products') }} (Max 10)</label>
                            <div class="col-md-10">
                                <input type="hidden" name="types[]" value="featured_products">
                                <input type="hidden" name="page_type" value="featured_products">
                                <select name="featured_products[]" class="form-control aiz-selectpicker" multiple
                                    data-live-search="true" title="Select Products" data-selected="{{ get_setting('featured_products') }}">
                                    {{-- <option disabled value=""></option> --}}
                                    @foreach ($products as $key => $prod)
                                        <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">See More Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading7" value="{{ old('heading7', $page->getTranslation('heading7', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="heading8" value="{{ old('heading8', $page->getTranslation('heading8', $lang)) }}" required>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Industries Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="content2" value="{{ old('content2', $page->getTranslation('content2', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter..." name="content3" value="{{ old('content3', $page->getTranslation('content3', $lang)) }}" required>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Content</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Enter..." name="content4" rows="5">{!! $page->getTranslation('content4',$lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Partners Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading9" value="{{ old('heading9', $page->getTranslation('heading9', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading10" value="{{ old('heading10', $page->getTranslation('heading10', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Content</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Enter..." name="content5" rows="5">{!! $page->getTranslation('content5',$lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="signinSrEmail">Image</label>
                            <div class="col-md-10">
                                <input type="file" name="image1" class="form-control" accept="image/*">
        
                                @if ($page->image1)
                                    <div class="file-preview box sm">
                                        <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                            <div class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                <img src="{{ asset($page->image1) }}" class="img-fit">
                                            </div>
                                           
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-from-label">Brands</label>
                            <div class="col-md-10">
                                <input type="hidden" name="types[]" value="home_brands">
                                <select name="home_brands[]" id="home_brands" class="form-control aiz-selectpicker" multiple  data-live-search="true" data-actions-box="true" data-selected="{{ get_setting('home_brands') }}">
                                    
                                    @foreach (\App\Models\Brand::all() as $key => $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
         
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Blogs Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading11" value="{{ old('heading11', $page->getTranslation('heading11', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading12" value="{{ old('heading12', $page->getTranslation('heading12', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Footer Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading13" value="{{ old('heading13', $page->getTranslation('heading13', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading14" value="{{ old('heading14', $page->getTranslation('heading14', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <form class="p-4" action="{{ route('business_settings.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                    <div class="card-header px-0">
                        <h6 class="fw-600 mb-0">Seo Fields</h6>
                    </div>
                    <div class="card-body px-0">
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.meta_title') }}" name="meta_title"
                                    value="{{ $page->getTranslation('meta_title', $lang) }}">
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="{{ trans('messages.meta_description') }}" name="meta_description"  rows="5">{!! $page->getTranslation('meta_description',$lang) !!}</textarea>
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_keywords') }}</label>
                            <div class="col-sm-10">
                                <textarea rows="5" class="resize-off form-control" placeholder="{{ trans('messages.meta_keywords') }}" name="keywords">{!! $page->getTranslation('keywords',$lang) !!}</textarea>
                                <small class="text-muted">Separate with coma</small>
                            </div>
                        </div>
        
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.og_title') }}"
                                    name="og_title" value="{{ $page->getTranslation('og_title',$lang) }}">
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="{{ trans('messages.og_description') }}" name="og_description" rows="5">{!! $page->getTranslation('og_description',$lang) !!}</textarea>
                            </div>
                        </div>
        
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{trans('messages.twitter_title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="{{ trans('messages.twitter_title') }}"
                                    name="twitter_title" value="{{ $page->getTranslation('twitter_title',$lang) }}">
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.twitter_description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" rows="5" placeholder="{{ trans('messages.twitter_description') }}" name="twitter_description">{!! $page->getTranslation('twitter_description',$lang) !!}</textarea>
                            </div>
                        </div>
        
                       
        
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery.repeater/jquery.repeater.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function () {
            AIZ.plugins.bootstrapSelect('refresh');


            $('.aiz-selectpicker').on('shown.bs.select', function () {
                var select = $(this);
                var selectedOptions = select.find('option:selected').detach();
                select.prepend(selectedOptions);
                select.selectpicker('refresh');
            });

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
           
        });

       
        $('.remove-galley').on('click', function() {
            thumbnail = $(this)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('page.delete_image') }}',
                data: {
                    url: $(thumbnail).data('url'),
                    id: '{{ $page->id }}'
                },
                success: function(data) {
                    if (data == 1) {
                        $(thumbnail).closest('.file-preview-item').remove();
                        AIZ.plugins.notify('success', "{{ trans('messages.image').trans('messages.deleted_msg') }}");
                    } else {
                        AIZ.plugins.notify('danger', "{{ trans('messages.something_went_wrong')}}");
                    }
                    
                }
            });
        });

    </script>
@endsection
