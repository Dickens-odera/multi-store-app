@extends('template.layouts.main')
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalStores }}</h3>

                    <p>Stores</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('stores.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>Clients</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>

                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Users -->
    <section class="admin-users-div">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Users</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>Admin</td> <!-- TODO fetch user role here-->
                                        {{-- <td>
                                            <button class="btn-group btn-group-sm" style="border: none">
                                                <a class="btn btn-sm btn-success" href="#"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-pencil-alt"></i> </a>
                                                <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i> </a>
                                            </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-sm btn-success"><i class="arrow arrow-right"></i> View More </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Stores</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stores as $store)
                                    <tr>
                                        <td>{{ $store->id }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->user->name ?? NULL }}</td>
                                        <td>{{ $store->status }}</td>
                                        {{-- <td>
                                            <button class="btn-group btn-group-sm" style="border: none">
                                                <a class="btn btn-sm btn-success" href="#"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-pencil-alt"></i> </a>
                                                <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i> </a>
                                            </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('stores.index') }}" class="btn btn-sm btn-success"><i class="arrow arrow-right"></i> View More </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Drivers</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                                <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Added By</th> 
                                   <th>Vehicle Type</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($drivers as $driver)
                                    <tr>
                                        {{-- <td>{{ $driver->id }}</td> --}}
                                        <td>{{ $driver->name }}</td>
                                        <td>{{ $driver->email }}</td>
                                        <td>{{ $driver->phone }}</td>
                                         <td>{{ $driver->user->name ?? NULL }}</td>
                                        <td>{{ $driver->vehicle->name ?? NULL }}</td>
                                        {{-- <td>
                                            <button class="btn-group btn-group-sm" style="border: none">
                                            
                                                <a class="btn btn-primary btn-sm" href="{{ route('drivers.edit',$driver->id) }}"><i class="fas fa-pencil-alt"></i> </a>
                                                <form method="post" action="{{ route('drivers.destroy', $driver->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                                </form>
                                            </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('drivers.index') }}" class="btn btn-sm btn-success"><i class="arrow arrow-right"></i> View More </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Products</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped table-responsive-xl" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Store Name</th>
                                    <th>Price</th>
                                    <th>In Stock</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->store->name ?? NULL }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->in_stock }}</td>
                                        {{-- <td>
                                            <button class="btn-group btn-group-sm" style="border: none">
                                                <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i class="fas fa-pencil-alt"></i> </a>
                                                <form method="post" action="{{ route('products.destroy', $product->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                                </form>
                                            </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-success"><i class="arrow arrow-right"></i> View More </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- Users -->
@endsection
