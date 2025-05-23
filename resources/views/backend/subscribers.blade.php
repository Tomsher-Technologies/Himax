@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">All Subscribers</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>Email</th>
                    <th data-breakpoints="lg">Date</th>
                    <th data-breakpoints="lg" class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $key => $subscriber)
                  <tr>
                      <td>{{ ($key+1) + ($subscribers->currentPage() - 1)*$subscribers->perPage() }}</td>
				              <td><div class="text-truncate">{{ $subscriber->email }}</div></td>
                      <td>{{ date('d-m-Y', strtotime($subscriber->created_at)) }}</td>
                      <td class="text-right">
                          <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('subscriber.destroy', $subscriber->id)}}" title="Delete">
                              <i class="las la-trash"></i>
                          </a>
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $subscribers->appends(request()->input())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
