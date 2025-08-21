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
        <h3 class="text-muted">Amount List</h3>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Total Amount (Left) -->
                <div>
                    <h5>Total In Amount: <span class="text-success">{{ number_format($totalIn, 2) }} ৳</span></h5>
                    <h5>Total Out Amount: <span class="text-danger">{{ number_format($totalOut, 2) }} ৳</span></h5>
                </div>
               
            </div>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Details</th>
                        <th>In Amount</th>
                        <th>Out Amount</th>
                     
                    </tr>
                </thead>
               <tbody>
                    @foreach ($summaries as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['details'] ?? $item->details }}</td>
                            <td>{{ number_format($item['total_in'] ?? $item->total_in, 2) }} ৳</td>
                            <td>{{ number_format($item['total_out'] ?? $item->total_out, 2) }} ৳</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            @if(method_exists($summaries, 'links'))
                <div class="mt-3">
                    {{ $summaries->links() }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection