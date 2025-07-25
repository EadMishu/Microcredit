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
        <h3 class="text-muted">dps List</h3>
        <a href="{{ route('dps.create') }}" class="btn btn-primary">Add New dps</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>dps Number</th>
                        <th>Amount</th>
                        <th>Member Name</th>
                        <th>dps Type</th>
                        <th>Open Date</th>
                        <th>Clos Date</th>
                        <th>Closed Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dps as $index => $dps)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dps->dps_number }}</td>
                            <td>{{ $dps->amount }}</td>
                            <td>{{ optional($dps->user)->name ?? 'N/A' }}</td>
                            <td>{{ optional($dps->dpsType)->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($dps->open_date)->format('d-m-Y') }}</td>
                            <td>{{ $dps->close_date ? \Carbon\Carbon::parse($dps->close_date)->format('d-m-Y') : '—' }}</td>
                            <td>{{ $dps->closed_date ? \Carbon\Carbon::parse($dps->closed_date)->format('d-m-Y') : '—' }}</td>
                            @php
    $selectClass = match($dps->status) {
        1 => 'bg-warning text-dark',
        2 => 'bg-success text-white',
        3 => 'bg-secondary text-white',
        default => 'bg-light text-dark',
    };
@endphp

<td>
    <form action="{{ route('dps.updateStatus', $dps->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm {{ $selectClass }}">
            <option value="1" {{ $dps->status == 1 ? 'selected' : '' }}>Pending</option>
            <option value="2" {{ $dps->status == 2 ? 'selected' : '' }}>Running</option>
            <option value="3" {{ $dps->status == 3 ? 'selected' : '' }}>Closed</option>
        </select>
    </form>
</td>
                            <td>
                                <a href="{{ route('dps.edit', $dps->id) }}" class="btn btn-sm "><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('dps.destroy', $dps->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete this dps?')" class="btn btn-sm  bi-trash"></button>
                                </form>
                            </td>
                        </tr>
                    
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if(method_exists($dps, 'links'))
                <div class="mt-3">
                    {{ $dps->links() }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection