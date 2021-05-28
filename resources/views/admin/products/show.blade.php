@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Product Details</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $product->avatar !== NULL ? \Storage::url($product->avatar) : asset('assets/images/laptop.jpg') }}" style="width:100%; height:auto; overflow:none"/>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div clas="card-header">
                                    <div class="card-title">{{  $product->name }}</div>
                                </div>
                                <div class="card-body">
                                    <h4>Price: {{ $product->price }}</h4>
                                    <form method="post" action="{{ route('product.new_purchase', $product->id) }}">
                                        @csrf

                                        <div class="form-group">
                                            <label class="form-label" for="qty">Quantity</label>
                                                <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" id="qty" value="{{ old('qty') }}">
                                                @error('qty')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Buy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Previous Purchases</div>
                            </div>
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client Name</th>
                                                    <th>Client Email</th>
                                                    <th>Client Phone</th>
                                                    <th>Qty</th>
                                                    <th>Total Payments</th>
                                                    <th>Date Purchased</th>
                                                    <th>Action<th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($product->purchases as $purchase)
                                                    <tr>
                                                        <td>{{ $purchase->id }}</td> 
                                                        <td>{{ $purchase->customer->name ?? NULL }}</td>
                                                        <td>{{ $purchase->customer->email ?? NULL }}</td> 
                                                        <td>{{ $purchase->customer->phone ?? NULL }}</td>  
                                                        <td>{{ $purchase->qty }}</td> 
                                                        <td>{{ $purchase->total }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y') }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                                Send Promotional Mail
                                                              </button>   
                                                        </td>     
                                                    <tr>
                                                @empty
                                                    <p>No previous purchases</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Promotional Message to Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('promotions.send_mail', $purchase->id) }}">
                @csrf
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-info">Send </button>
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
