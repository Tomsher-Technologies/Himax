@extends('backend.layouts.app')

@section('content')
    <style>
        
    </style>

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h4">{{ 'Industry ' .trans('messages.information') }}</h5>
    </div>

    <div class="col-lg-11 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                
                <form class="p-4" action="{{ route('industries.update', $industry->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ trans('messages.name') }}<span
                                class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" placeholder="{{ trans('messages.name') }}" id="name"
                                name="name" class="form-control" value="{{ old('name', $industry->name) }}">
                            @error('name')
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
                                <input type="hidden" name="image" value="{{  $industry->image }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input type="text" placeholder="Enter.." id="title" name="title" class="form-control" value="{{ old('title', $industry->title) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-from-label">Content</label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="5" name="content">{{ old('content', $industry->content) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-md-2 col-form-label" for="exampleInputEmail1">Sort Order</label>
                        <div class="col-md-10">
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $industry->sort_order) }}">
                        </div>
                    </div>

                    <div class="form-group  row">
                        <label class="col-md-2 col-form-label">{{ trans('messages.active_status') }}</label>
                        <div class="col-md-10">
                            <select class="select2 form-control" name="status">
                                <option {{ old('status', $industry->status) == 1 ? 'selected' : '' }} value="1">{{ trans('messages.yes') }}
                                </option>
                                <option {{ old('status', $industry->status) == 0 ? 'selected' : '' }} value="0">{{ trans('messages.no') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- <h5 class="mb-0 h6">{{trans('messages.seo_section')}}</h5>
                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">{{trans('messages.meta_title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="meta_title"
                                placeholder="{{trans('messages.meta_title')}}" value="{{ old('meta_title', $service->getTranslation('meta_title', $lang)) }}">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                            for="name">{{trans('messages.meta_description')}}</label>
                        <div class="col-md-10">
                            <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description', $service->getTranslation('meta_description', $lang)) }}</textarea>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
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
                    </div> --}}
                    {{-- <div class="form-group row">
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
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label class="col-md-2 col-form-label"
                            for="name">{{trans('messages.twitter_description')}}</label>
                        <div class="col-md-10">
                            <textarea name="twitter_description" rows="5" class="form-control">{{ old('twitter_description', $service->getTranslation('twitter_description', $lang)) }}</textarea>
                        </div>
                    </div> --}}

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Save') }}</button>
                        <a href="{{ route('industries.index') }}" class="btn btn-cancel">{{trans('messages.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

   
@endsection

