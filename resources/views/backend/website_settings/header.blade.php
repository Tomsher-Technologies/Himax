@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">Website Header</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">Header Setting</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					

					<div class="form-group row ">
	                    <label class="col-md-12 col-from-label">Header Logo</label>
						<div class="col-md-12">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
		                        </div>
		                        <div class="form-control file-amount">Choose File</div>
								<input type="hidden" name="types[]" value="header_logo">
		                        <input type="hidden" name="header_logo" class="selected-files" value="{{ get_setting('header_logo') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>

                    <div class="">
                        <div class="form-group row">
							<label class="col-md-12 col-from-label">Main Contact Number</label>
							<div class="col-md-12">
								<div class="form-group">
									<input type="hidden" name="types[]" value="main_contact_number">
									<input type="text" class="form-control" placeholder="Phone number" name="main_contact_number" value="{{ get_setting('main_contact_number') }}">
								</div>
							</div>
						</div>
                    </div>

					<div class="form-group">
						<label>Services</label>
						<input type="hidden" name="types[][{{ env('DEFAULT_LANGUAGE') }}]" value="header_services">
						<select name="header_services[]" class="form-control aiz-selectpicker" multiple data-actions-box="true" data-live-search="true" title="Select" data-selected="{{ get_setting('header_services') }}">
							{{-- <option disabled value=""></option> --}}
							@foreach (App\Models\Service::where('status',1)->get() as $key => $serv)
								<option value="{{ $serv->id }}">{{ $serv->getTranslation('name', 'en') }}</option>
							@endforeach
						</select>
					</div>
					
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
