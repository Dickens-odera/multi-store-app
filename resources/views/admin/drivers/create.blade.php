@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Create New Driver</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('drivers.store') }}">
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
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="vehicle_type">Vehicle Type</label>
                                <select name="vehicle_type" class="form-control @error('vehicle_type') is-invalid @enderror" id="vehicle_type" value="{{ old('vehicle_type') }}">
                                    <option value="">Select Vehicle Type</option>
                                    @foreach($vehicle_types as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_type')
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
