@extends('template.layouts.main')
@section('content')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Stores</div>
                    @can('add store')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new_store_modal" style="float:right">
                            Add New Store
                        </button>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Description</th>
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
                                <td>{{ $store->description }}</td>
                                <td>{{ $store->status }}</td>
                                <td>
                                    <button class="btn-group btn-group-sm" style="border: none">
{{--                                        <a class="btn btn-sm btn-success" href="#"><i class="fas fa-eye"></i></a>--}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('stores.edit', $store->id) }}"><i class="fas fa-pencil-alt"></i> </a>
                                        @can('delete store')
                                            <a class="btn btn-danger btn-sm" onclick="confirmDelete({{ $store->id }})" id="deleteStoreModalBtn" data-id="{{ $store->id }}" href="#"><i class="fa fa-trash"></i>
                                                <input type="hidden" name="_method" value="DELETE"/>
                                            </a>
                                        @endcan
                                        @if($store->status === \App\Models\Store::STATUS_ACTIVE)
                                            <form method="post" action="{{ route('store.deactivate', ['id' => $store->id ]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
                                            </form>
                                        @elseif($store->status === \App\Models\Store::STATUS_DEACTIVATED)
                                            <form method="post" action="{{ route('store.activate', ['id' => $store->id ]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info">Activate</button>
                                            </form>
                                        @endif
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
    <script type="text/javascript">
        function confirmDelete(id=null)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "This store will be deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    //let store_id = $('deleteStoreModalBtn').data('id');
                    let id = "{{  $store->id }} ";
                    let url = '{{ route("stores.destroy", $store->id ) }}';
                    //url.replace(':id', store_id);
                    $.ajax({
                        url:url,
                        method:'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success:function(){
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Store Deleted Successfully.',
                                'success'
                            ).then(
                                window.location.reload()
                            );
                        }
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'You successfully cancelled the delete action',
                        'success'
                    )
                }
            })
        }
        $(document).ready(function(){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
        });
        });

    </script>
@endsection
