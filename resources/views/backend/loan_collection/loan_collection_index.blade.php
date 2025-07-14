@extends('backend.admin_master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">Loan Collection List</h3>
        <a href="{{ route('loan_collections.create') }}" class="btn btn-primary">Add New Loan Collection</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Total Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $index => $collection)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($collection->date)->format('d-m-Y') }}</td>
                <td>{{ number_format($collection->total_amount, 2) }}</td>
                <td>
                    <a href="{{ route('loan_collections.edit_date', $collection->date) }}" class="btn btn-sm btn-primary" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ route('loan_collections.destroy_date', $collection->date) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure to delete all collections for this date?')" class="btn btn-sm btn-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
@if(method_exists($collections, 'links'))
    {{ $collections->links() }}
@endif

            {{-- Pagination --}}
            {{-- Pagination --}}
@if(method_exists($collections, 'links'))
    <div class="mt-3">
        {{ $collections->links() }}
    </div>
@endif
        </div>
    </div>
</main>
@endsection