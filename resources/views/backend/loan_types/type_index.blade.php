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
        <h3 class="text-muted">Loan Type List</h3>
        <a href="{{ route('loan-types.create') }}" class="btn btn-primary">Add New</a>
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
                    @foreach ($loanTypes as $index => $loantype)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $loantype->name }}</td>
                            <td>{{ $loantype->percentage }}</td>
                            <td>{{ $loantype->duration }}</td>
                            <td>{{ $loantype->number_of_installments }}</td>
                            <td>
                                <form action="{{ route('loan-types.toggle-status', $loantype->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-check form-switch">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input" 
                                            id="status-{{ $loantype->id }}" 
                                            name="status" 
                                            value="1"
                                            {{ $loantype->status ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="status-{{ $loantype->id }}">
                                            {{ $loantype->status ? '' : '' }}
                                        </label>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('loan-types.edit',$loantype->id) }}" class="btn btn-sm "><i class="bi bi-pencil-square"></i> </a>
                                <form action="{{ route('loan-types.destroy', $loantype->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm bi-trash"></button>
                                </form>
                            </td>
                          
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if(method_exists($loanTypes, 'links'))
                <div class="mt-3">
                    {{ $loanTypes->links() }}
                </div>
            @endif
        </div>
    </div>
</main>


@endsection