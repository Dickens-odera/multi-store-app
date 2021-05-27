@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Vehicle Types</div>
                    <a href="{{ route('vehicle_types.create') }}" type="button" class="btn btn-primary btn-sm" style="float:right">
                        New
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse($vehicle_types as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->id }}</td>
                                        <td>{{ $vehicle->name }}</td>
                                        <td>
                                            <button class="btn-group btn-group-sm" style="border: none">
                                                <a class="btn btn-primary btn-sm" href="{{ route('vehicle_types.edit', $vehicle->id) }}"><i class="fas fa-pencil-alt"></i> </a>
                                                <form method="post" action="{{ route('vehicle_types.destroy', $vehicle->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                                </form>
                                            </button>
                                        </td>
                                    </tr>
                               @empty
                                       <p>No Vehicle types at the moment, please create some new vehicle types</p>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
