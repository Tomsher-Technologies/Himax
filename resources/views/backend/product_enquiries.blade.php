@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">All Product Enquiries</h1>
		</div>
		<div class="col-md-6 text-md-right">
			
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header row gutters-5">
        <div class="col">
            <form>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5 class="mb-md-0 h6">Product Enquiries</h5>
                    </div>

                    <div class="col-md-3 bootstrap-select">
                        <select class="form-control form-control-sm aiz-selectpicker mb-md-0" data-live-search="true"
                                name="product" id="" data-selected={{ $filterProduct }}>
                            <option value="">All</option>
                            @foreach ($products as $prod)
                                <option value="{{ $prod->id }}"  @if( $filterProduct == $prod->id)  {{ 'selected' }} @endif>{{ $prod->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control form-control-sm" id="search" name="search" @isset($keyword_search) value="{{ $keyword_search }}" @endisset placeholder="Type & Enter Customer Details">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control aiz-date-range" id="date_range"  name="date_range" placeholder="{{ trans('messages.select').' '.trans('messages.date') }}" data-time-picker="false" data-format="DD-MM-Y" data-separator=" to " autocomplete="off" @if($start_date && $end_date) value="{{ $start_date . ' to ' . $end_date }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-info " type="submit">Filter</button>
                        <a href="{{ route('enquiries.products') }}" class="btn btn-cancel">Reset</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="card-body">
        

        <table class="table aiz-table mb-0 ">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Sl No:</th>
                    <th scope="col" style="width:25%;">Customer Info</th>
                    <th scope="col" style="width:30%;">Product Info</th>
                    <th scope="col" style="width:30%;">Message</th>
                    <th scope="col" class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($enquiries[0]))
                    @foreach ($enquiries as $key=>$con)
                        <tr>
                            <td scope="row" class="text-center">{{ $key + 1 + ($enquiries->currentPage() - 1) * $enquiries->perPage() }}</td>
                            <td>
                                <div class="product-details">
                                    <span><b>Name</b> <span>: &nbsp;{{$con->name ?? ''}}</span></span>
                                    <span><b>Email</b> <span>: &nbsp;{{$con->email ?? ''}}</span></span>
                                    <span><b>Phone</b> <span>: &nbsp;{{$con->phone ?? ''}}</span></span>
                                </div>
                            </td>
                            <td>
                                <div class="product-details">
                                    <span><b>Name</b> <span>: &nbsp;{{$con->product->getTranslation('name') ?? ''}}</span></span>
                                    <span><b>Category</b> <span>: &nbsp;{{$con->product->category->getTranslation('name') ?? ''}}</span></span>
                                    <span><b>Brand</b> <span>: &nbsp;{{$con->product->brand->getTranslation('name') ?? ''}}</span></span>
                                    <span><b>Quantity</b> <span>: &nbsp;{{$con->quantity ?? ''}}</span></span>
                                </div>
                            </td>
                            <td>{{ $con->message }}</td>
                            
                            <td class="text-center">{{ date('d M,Y', strtotime($con->created_at)) }}</td>
                        </tr>
                    @endforeach
               
                @endif
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $enquiries->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection

@section('header')
<style>
    .product-details {
        display: table;
        /* width: 100%; */
    }
    .product-details span {
        display: table-row;
    }
    .product-details b, .product-details span span {
        display: table-cell;
        padding: 1px 3px; /* Adjust spacing */
    }
</style>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
