@extends('template.layouts.main')
@section('content')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Drivers</div>
                    <a href="{{ route('drivers.create') }}" type="button" class="btn btn-primary btn-sm" style="float:right">
                        New
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Added By</th>
                            <th>Vehicle Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td>{{ $driver->id }}</td>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->email }}</td>
                                <td>{{ $driver->phone }}</td>
                                <td>{{ $driver->user->name ?? NULL }}</td>
                                <td>{{ $driver->vehicle->name ?? NULL }}</td>
                                <td>
                                    <button class="btn-group btn-group-sm" style="border: none">
{{--                                        <a class="btn btn-sm btn-success" href="{{ route('drivers.show',$driver->id) }}"><i class="fas fa-eye"></i></a>--}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('drivers.edit',$driver->id) }}"><i class="fas fa-pencil-alt"></i> </a>
                                        <form method="post" action="{{ route('drivers.destroy', $driver->id) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                        </form>
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ $driver->id }}" data-target="#exampleModalCenter">
                                        Assign Products
                                    </button>  
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $drivers->links() }}
                </div>
            </div>
        </div>
    </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Driver Product Assignments</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('stores.store') }}">
                                            @csrf
                                            <input type="hidden" name="driver_id" id="driver_id" value="">
                                            <div class="form-group">
                                                <label for="product_id">Assign Product</label>
                                                <select name="product_id" id="multiple-checkboxes" class="form-control  @error('product_id') is-invalid @enderror">
                                                    <option value="">Select Product </option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        $(document).ready(function() {
                            $('#multiple-checkboxes').multiselect({
                            includeSelectAllOption: true,
                        });
    });
                            </script>
@endsection
