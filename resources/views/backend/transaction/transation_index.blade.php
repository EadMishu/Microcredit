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
                <!-- Total Amount (Left) -->
                <div>
                    <h5>Total Amount: 
                        <span class="badge bg-success">
                            {{ number_format($totalAmount, 2) }} ৳
                        </span>
                    </h5>
                </div>
                <!-- Date-wise Search (Right) -->
                <form action="" method="GET" class="d-flex align-items-center">
                    <label class="me-2 mb-0">From:</label>
                    <input type="date" name="from" class="form-control me-2" required>
                    <label class="me-2 mb-0">To:</label>
                    <input type="date" name="to" class="form-control me-2" required>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Details</th>
                        <th>In Amount</th>
                        <th>Out Amount</th>
                        <th>Net Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupedByDetails as $detail => $data)
    <tr>
        <td>{{ $detail }}</td>
        <td>{{ $data['in'] > 0 ? number_format($data['in'], 2) : '' }}</td>
        <td>{{ number_format($data['out'], 2) }}</td>
        <td>{{ number_format($data['net'], 2) }}</td>
    </tr>
@endforeach
                </tbody>
            </table>
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