@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->user->name ?? NULL }}</td>
                                <td>{{ $store->status }}</td>
                                <td>
                                    <button class="btn-group btn-group-sm" style="border: none">
                                        <a class="btn btn-sm btn-success" href="#"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-pencil-alt"></i> </a>
                                        <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-wrench"></i> </a>
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
