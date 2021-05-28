@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Store</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('stores.update', $store->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH"/>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $store->name }}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="store_owner">Assign Owner</label>
                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                <option value="{{ $store->user_id }}">{{ $store->user->name }} </option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description">{{ $store->description }}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Products</div>
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
                        @foreach($store->products as $product)
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
                </div>
            </div>
        </div>
    </div>
@endsection
