@extends('template.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">My Products Purchases</div>
                
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Total Payments</th>
                                <th>Date Purchased</th>
                                <th>Action<th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $purchase)
                                <tr>  
                                    <td>{{ $purchase->qty }}</td> 
                                    <td>{{ $purchase->total }}</td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('products.show', $purchase->product_id ) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>   
                                    </td>     
                                <tr>
                            @empty
                                <p>No previous purchases</p>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $purchases->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
