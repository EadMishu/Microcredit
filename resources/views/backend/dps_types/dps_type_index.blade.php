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
        <h3 class="text-muted">Dps Type List</h3>
        <a href="{{ route('dps-types.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Percentage</th>
                        <th>Duration</th>
                        <th>Number Of Installment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dpsTypes as $index => $dpstype)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dpstype->name }}</td>
                            <td>{{ $dpstype->percentage }}</td>
                            <td>{{ $dpstype->duration }}</td>
                            <td>{{ $dpstype->number_of_installments }}</td>
                            <td>
                                <form action="{{ route('dps-types.toggle-status', $dpstype->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-check form-switch">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input" 
                                            id="status-{{ $dpstype->id }}" 
                                            name="status" 
                                            value="1"
                                            {{ $dpstype->status ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="status-{{ $dpstype->id }}">
                                            {{ $dpstype->status ? '' : '' }}
                                        </label>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('dps-types.edit',$dpstype->id) }}" class="btn btn-sm "><i class="bi bi-pencil-square"></i> </a>
                                <form action="{{ route('dps-types.destroy', $dpstype->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm bi-trash"></button>
                                </form>
                            </td>
                          
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if(method_exists($dpsTypes, 'links'))
                <div class="mt-3">
                    {{ $dpsTypes->links() }}
                </div>
            @endif
        </div>
    </div>
</main>


@endsection