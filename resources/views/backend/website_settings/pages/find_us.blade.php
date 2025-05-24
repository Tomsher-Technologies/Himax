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
                <h6 class="fw-600 mb-0">{{ $page->slug }} Page Content</h6>
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

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <h6 class="mb-1 ml-3"><u>Listing Section</u></h6>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Title" name="title1"
                            value="{{ $page->getTranslation('title1', $lang) }}">
                    </div>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Subtitle" name="sub_title"
                            value="{{ $page->getTranslation('sub_title', $lang) }}">
                    </div>
                </div>

                {{-- <div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">Contact Title <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Title" name="heading1" value="{{ $page->getTranslation('heading1',$lang) }}" required >
				</div>
			</div> --}}
            </div>

            <div class="card-header px-0 @if ($page->type == 'product_details') d-none @endif">
                <h6 class="fw-600 mb-0">Seo Fields</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Meta Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Meta Title" name="meta_title"
                            value="{{ $page->getTranslation('meta_title', $lang) }}"
                            @if ($lang == 'ae') dir="rtl" @endif>
                    </div>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Meta Description</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Description" name="meta_description"
                            @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('meta_description', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Keywords</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Keywords" name="keywords"
                            @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('keywords', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">OG Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="OG Title" name="og_title"
                            value="{!! $page->getTranslation('og_title', $lang) !!}" @if ($lang == 'ae') dir="rtl" @endif>
                    </div>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">OG Description</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="OG Description" name="og_description"
                            @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('og_description', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Twitter Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Twitter Title" name="twitter_title"
                            value="{!! $page->getTranslation('twitter_title', $lang) !!}" @if ($lang == 'ae') dir="rtl" @endif>
                    </div>
                </div>

                <div class="form-group row @if ($page->type == 'product_details') d-none @endif">
                    <label class="col-sm-2 col-from-label" for="name">Twitter Description</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Twitter Description" name="twitter_description"
                            @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('twitter_description', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('website.pages') }}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
