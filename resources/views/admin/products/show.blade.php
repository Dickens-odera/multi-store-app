@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Product Details</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $product->avatar !== NULL ? $product->avatar : asset('assets/images/laptop.jpg') }}" style="width:100%; height:auto; overflow:none"/>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div clas="card-header">
                                    <div class="card-title">{{  $product->name }}</div>
                                </div>
                                <div class="card-body">
                                    <h4>Price: {{ $product->price }}</h4>
                                    <form method="post" action="{{ route('product.new_purchase', $product->id) }}">
                                        @csrf

                                        <div class="form-group">
                                            <label class="form-label" for="qty">
                                                <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" id="qty" value="{{ old('qty') }}">
                                                @error('qty')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Buy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
