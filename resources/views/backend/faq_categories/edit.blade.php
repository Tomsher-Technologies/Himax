@extends('backend.layouts.app', [ 'title' => 'Edit Partner Details'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5>Edit FAQ Category Details</h5>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">

                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('faq_categories.update', $faqCategory->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $faqCategory->name) }}" required>
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $faqCategory->sort_order) }}">
                                    @error('sort_order')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control select2-single mb-3">
                                    <option {{ old('status', $faqCategory->is_active) == '1' ? 'selected' : '' }} value="1">
                                        Enabled
                                    </option>
                                    <option {{ old('status', $faqCategory->is_active) == '0' ? 'selected' : '' }} value="0">
                                        Disabled
                                    </option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mb-0">Update</button>
                            <a href="{{ route('faq_categories.index') }}" class="btn btn-cancel mb-0"> Cancel</a>
                           
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('header')
   
@endpush
@push('footer')
    
    <script>
      
    </script>
@endpush
