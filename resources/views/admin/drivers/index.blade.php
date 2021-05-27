@extends('template.layouts.main')
@section('content')
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
@endsection
