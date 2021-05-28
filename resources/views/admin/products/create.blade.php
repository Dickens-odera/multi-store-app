@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Create New Product</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                           <div class="col-md-6">
                               <label for="name">Name</label>
                               <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                               @error('name')
                               <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                           </div>
                            <div class="col-md-6">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="in_stock">In Stock(QTY)</label>
                                <input type="number" name="in_stock" class="form-control @error('in_stock') is-invalid @enderror" id="in_stock" value="{{ old('in_stock') }}">
                                @error('in_stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="vehicle_type">Store</label>
                                <select name="store_id" class="form-control @error('store_id') is-invalid @enderror" id="store_id" value="{{ old('store_id') }}">
                                    <option value="">Select Store</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="avatar">Upload Photo</label>
                                <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" id="avatar">
                                @error('avatar')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
