@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Products</div>
                    @can('add product')
                    <a href="{{ route('products.create') }}" type="button" class="btn btn-primary btn-sm" style="float:right">
                        New
                    </a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>In Stock(Available)</th>
                            <th>Store Name</th>
                            <th>Added By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->in_stock }}</td>
                                <td>{{ $product->store->name ?? NULL }}</td>
                                <td>{{ $product->user->name ?? NULL }}</td>
                                 {{-- <td>{{ $product->status }}</td> --}}
                                <td>
                                    <button class="btn-group btn-group-sm" style="border: none">
                                        <a class="btn btn-sm btn-success" href="{{ route('products.show', $product->id ) }}"><i class="fas fa-eye"></i></a>
                                        <form method="post" action="{{ route('products.destroy', $product->id) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                        </form>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
