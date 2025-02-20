@extends('backend.layouts.app')

@section('content')
<style>
    .bread .breadcrumb {
        all: unset;
    }

    .bread .breadcrumb li {
        display: inline-block;
    }

    .bread nav {
        display: inline-block;
        max-width: 250px;
    }

    .bread .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
    }

    .breadcrumb-item+.breadcrumb-item {
        padding-left: 0;
    }

    .bread a {
        pointer-events: none;
        cursor: sw-resize;
    }
</style>
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">All products</h1>
            </div>
            @if ($type != 'Seller')
                <div class="col text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-circle btn-info">
                        <span>Add New Product</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <br>

    <div class="card">
        <form class="" id="sort_products" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">All Product</h5>
                </div>

               
                <div class="col-md-3 bootstrap-select">
                    
                    <select class="form-control form-control-sm aiz-selectpicker mb-md-0" data-live-search="true"
                            name="category" id="" data-selected={{ $category }}>
                        <option value="0">All</option>
                        @foreach (getAllCategories()->where('parent_id', 0) as $item)
                            <option value="{{ $item->id }}" @if( $category == $item->id)  {{ 'selected' }} @endif )>{{ $item->name }}</option>
                            @if ($item->child)
                                @foreach ($item->child as $cat)
                                    @include('backend.categories.menu_child_category', [
                                        'category' => $cat,
                                        'old_data' => $category,
                                    ])
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 bootstrap-select">
                    <select class="form-control form-control-sm aiz-selectpicker mb-md-0" name="type" id="type"
                        onchange="sort_products()">
                        <option value="">Sort By</option>
                        <option
                            value="status,1"@isset($col_name, $query) @if ($col_name == 'status' && $query == '1') selected @endif @endisset>
                            Published</option>
                        <option
                            value="status,0"@isset($col_name, $query) @if ($col_name == 'status' && $query == '0') selected @endif @endisset>
                            Unpublished</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control form-control-sm" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="Type & Enter">
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-info " type="submit">Filter</button>
                    <a href="{{ route('products.all') }}" class="btn btn-cancel">Reset</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            {{-- <th>
                                <div class="form-group">
                                    <div class="aiz-checkbox-inline">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-all">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                            </th> --}}
                            <th>#</th>
                            <th>{{ trans('messages.image') }}</th>
                            <th>{{ trans('messages.name') }}</th>
                            <th >{{ trans('messages.category') }}</th>
                            <th >{{ trans('messages.brand') }}</th>
                            <th class="text-center">{{ trans('messages.published') }}</th>
                            <th class="text-center">{{ trans('messages.options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                
                                <td>
                                    {{-- w-200px w-md-250px mw-100 --}}
                                    <div class="row gutters-5 ">

                                        @if ($product->thumbnail_img)
                                            <div class="col-auto">
                                                <img src="{{ get_product_image($product->thumbnail_img, '300') }}"
                                                    alt="Image" class="size-50px img-fit">
                                                   
                                            </div>
                                        @endif

                                    </div>
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td class="bread">
                                    {{ Breadcrumbs::render('product_admin', $product) }}
                                </td>
                                <td>
                                    {{ $product->brand->name }}
                                </td>
                                
                                <td class="text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_published(this)" value="{{ $product->id }}"
                                            type="checkbox" <?php if ($product->published == 1) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                             
                                <td class="text-center">
                                    
                                    <a class="btn btn-soft-primary btn-icon btn-circle"
                                        href="{{ route('products.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                        title="Edit">
                                        <i class="las la-edit"></i>
                                    </a>
                                   
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle confirm-delete"
                                        data-href="{{ route('products.destroy', $product->id) }}" title="Delete">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Todays Deal updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Published products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var approved = 1;
            } else {
                var approved = 0;
            }
            $.post('{{ route('products.approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                approved: approved
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Product approval update successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Featured products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-product-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
