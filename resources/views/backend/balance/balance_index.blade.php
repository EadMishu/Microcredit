@extends('backend.admin_master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">Transaction List</h3>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <div class="d-flex justify-content-between align-items-center mb-3">
               
                <!-- Date-wise Search (Right) -->
                <form action="" method="GET" class="d-flex align-items-center">
                    <label class="me-2 mb-0">From:</label>
                    <input type="date" name="from" class="form-control me-2" required>
                    <label class="me-2 mb-0">To:</label>
                    <input type="date" name="to" class="form-control me-2" required>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="mb-3">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Details</th>
                        <th> Amount</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($assets as $detail => $data)
                    <tr>
                        <td>Assets : {{ $detail }}</td>
                        <td>{{ $data['out'] > 0 ? number_format($data['out'], 2) : '' }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><h6>Total Assets</h6></td>
                        <td>
                            <div>
                                <span class="badge bg-primary">
                                    {{ number_format($assetsum, 2) }} ৳
                                </span>
                            </div>
                        </td>
                    </tr>
                     @foreach($liabilities as $detail => $data2)
                    <tr>
                        <td>Liabilities : {{$detail }}</td>
                        <td>{{ $data2['in'] > 0 ? number_format($data2['in'], 2) : '' }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><h6>Total Liabilities:</h6></td>
                        <td>
                            <div>
                                <span class="badge bg-danger">
                                    {{ number_format($liabilitiesum, 2) }} ৳
                                </span>
                            </div>
                        </td>
                    </tr>
                    @foreach($equity as $detail => $data3)
                    <tr>
                        <td>Equity : {{ $detail }}</td>
                        <td>{{ $data3['in'] > 0 ? number_format($data3['in'], 2) : '' }}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td><h6>Net Income:</h6></td>
                        <td>
                            <div>
                                <span class="badge bg-primary">
                                    {{ number_format($totalincome, 2) }} ৳
                                </span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td><h6>Total Equity:</h6></td>
                        <td>
                            <div>
                                <span class="badge bg-primary">
                                    {{ number_format($equitysummry, 2) }} ৳
                                </span>
                            </div>
                        </td>
                    </tr>



                 </tbody>
                
            </table>
             
            </div>
            
          
           
             
            {{-- Pagination --}}
            @if(method_exists($transactions, 'links'))
                <div class="mt-3">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection