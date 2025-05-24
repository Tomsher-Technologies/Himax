@extends('backend.layouts.app')

@section('content')
    <style>
        .remove-attachment {
            display: none;
        }
    </style>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ 'Industry ' . trans('messages.information') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('industries.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.name') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{ trans('messages.name') }}" id="name"
                                    name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ trans('messages.image') }} <span
                                    class="text-danger">*</span>
                                <br> <small>(Image size - 1072 x 437)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="image" value="" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                @error('image')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter.." id="title" name="title"
                                    class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Content</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" name="content">{{ old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="exampleInputEmail1">Sort Order</label>
                            <div class="col-md-9">
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', 0) }}">
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.active_status') }}</label>
                            <div class="col-md-9">
                                <select class="select2 form-control" name="status">
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">
                                        {{ trans('messages.yes') }}
                                    </option>
                                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">
                                        {{ trans('messages.no') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- <h5 class="mb-0 h6">{{ trans('messages.seo_section') }}</h5>
                        <hr>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                for="name">{{ trans('messages.meta_title') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_title"
                                    placeholder="{{ trans('messages.meta_title') }}" value="{{ old('meta_title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                for="name">{{ trans('messages.meta_description') }}</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                for="name">{{ trans('messages.meta_keywords') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_keywords"
                                    placeholder="{{ trans('messages.meta_keywords') }}"
                                    value="{{ old('meta_keywords') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="name">{{ trans('messages.og_title') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="og_title"
                                    placeholder="{{ trans('messages.og_title') }}" value="{{ old('og_title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                for="name">{{ trans('messages.og_description') }}</label>
                            <div class="col-md-9">
                                <textarea name="og_description" rows="5" class="form-control">{{ old('og_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                for="name">{{ trans('messages.twitter_title') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="twitter_title"
                                    placeholder="{{ trans('messages.twitter_title') }}"
                                    value="{{ old('twitter_title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"
                                for="name">{{ trans('messages.twitter_description') }}</label>
                            <div class="col-md-9">
                                <textarea name="twitter_description" rows="5" class="form-control">{{ old('twitter_description') }}</textarea>
                            </div>
                        </div> --}}

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ trans('messages.Save') }}</button>
                            <a href="{{ route('industries.index') }}"
                                class="btn btn-cancel">{{ trans('messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
    @endsection
