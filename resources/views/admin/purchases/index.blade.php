<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    {{-- <th>#</th> --}}
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
                                                        {{-- <td>{{ $purchase->id }}</td>  --}}
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