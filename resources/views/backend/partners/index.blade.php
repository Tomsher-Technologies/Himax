@extends('backend.layouts.app', ['body_class' => '', 'title' => 'Partners'])
@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="h4">{{ trans('messages.all').' '.trans('messages.partners') }}</h5>
            </div>

            <div class="col-md-6 text-md-right">
                <a href="{{ route('partners.create') }}" class="btn btn-primary">
                    <span>{{ trans('messages.add_new').' '.trans('messages.partner') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        @if ($partners)
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table aiz-table mb-0">
                            <thead>
                                <tr>
                                    <th  class="text-center">Sl No.</th>
                                    <th >Name</th>
                                    <th  class="text-center">Image</th>
                                    <th  class="text-center">Sort Order</th>
                                    <th  class="text-center">Status</th>
                                    <th  class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $key=>$partner)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 + ($partners->currentPage() - 1) * $partners->perPage() }}</td>
                                        <td>{{ $partner->name }}</td>
                                        <td class="text-center">
                                            <img class=" h-50px" src="{{ uploaded_asset($partner->image) }}" alt="">
                                        </td>
                                        <td class="text-center">{{ $partner->sort_order }}</td>
                                        <td class="text-center">
                                            <b>{!! $partner->status == 1 ? '<span class="text-success">Enabled</span>' : '<span class="text-danger">Disabled</span>' !!}</b>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('partners.edit', $partner) }}" class="btn btn-soft-primary btn-icon btn-circle"><i class="las la-edit"></i></a>

                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle confirm-delete" data-href="{{ route('partners.delete', $partner->id) }}" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination float-right">
                            {{ $partners->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@push('header')
@endpush
