@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Stores</div>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new_store_modal" style="float:right">
                        Add New Store
                    </button>
                </div>
                @include('template.layouts.info')
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
                    <!-- Modal -->
                    <div class="modal fade" id="new_store_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">New Store</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('stores.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="store_owner">Assign Owner</label>
                                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                                <option value="">Select Owner </option>
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
                                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description">{{ old('description') }}</textarea>
                                            @error('description')
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
                </div>
            </div>
        </div>
    </div>
@endsection
