@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Create New Vehicle Type</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('vehicle_types.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Type</label>
                            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" id="name" value="{{ old('type') }}">
                            @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
