@extends('template.layouts.main')
@section('content')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Users</div>
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
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->getRoleNames()}}</td>
                                <td>
                                    <a href="{{ route('users.user_details', $user->id) }}" class="btn btn-sm btn-success">Details</a>
                                </td>
                                {{-- <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ $user->id }}" data-target="#exampleModalCenter">
                                        Assign Role
                                    </button>  
                                </td> --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Assign Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('stores.store') }}">
                                            @csrf
                                            <input type="hidden" name="role_id" id="role_id" value="">
                                            <div class="form-group">
                                                <label for="role_id">Assign Product</label>
                                                <select name="role_id" id="multiple-checkboxes" class="form-control  @error('role_id') is-invalid @enderror">
                                                    <option value="">Select Role </option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
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
