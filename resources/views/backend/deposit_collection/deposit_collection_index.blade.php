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
        <h3 class="text-muted">deposit Collection List</h3>
        <a href="{{ route('deposit_collections.create') }}" class="btn btn-primary">Add New deposit Collection</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                     
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($depositCollections as $index => $collection)
                   
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($collection->user)->name ?? 'N/A' }}</td>
                         
                            <td>{{ $collection->date ? \Carbon\Carbon::parse($collection->date)->format('d-m-Y') : '—' }}</td>
                            <td>{{ number_format($collection->amount, 2) }}</td>
                            <td>
                                <a href="{{ route('deposit_collections.edit', $collection->id) }}" class="btn btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('deposit_collections.destroy', $collection->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete this deposit collection?')" class="btn btn-sm bi-trash"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if(method_exists($depositCollections, 'links'))
                <div class="mt-3">
                    {{ $depositCollections->links() }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection