@extends('frontend.layouts.app')
@section('content')
    <div class="row" style="background: #010c48;">
        <div class="col-xl-10 mx-auto">
            <!-- Start: error page -->
            <div class=" content-center">
                <div class="error-page text-center mt-4">
                    <img src="{{ asset('assets/img/403.svg') }}" alt="404" class="svg" style="height: 500px;margin-top: 80px !important;">
                    <!-- <div class="error-page__title">404</div> -->
                    <h5 class="fw-500 mt-2 mb-4 text-white"><b>404 | Page Not Found</b></h5>
                    
                </div>
            </div>
            <!-- End: error page -->
        </div>
    </div>
    
@endsection
