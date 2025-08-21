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
        <h3 class="text-muted">Deposit List</h3>
        <a href="{{ route('deposit.create') }}" class="btn btn-primary">Add New deposit</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Deposit Number</th>
                        <th>Amount</th>
                        <th>Member Name</th>
                        <th>deposit Type</th>
                        <th>Dpen Date</th>
                        <th>Closing Date</th>
                        <th>Closed Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deposit as $index => $deposit)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $deposit->deposit_number }}</td>
                            <td>{{ $deposit->amount }}</td>
                            <td>{{ optional($deposit->member)->name ?? 'N/A' }}</td>
                            <td>{{ optional($deposit->depositType)->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($deposit->open_date)->format('d-m-Y') }}</td>
                            <td>{{ $deposit->close_date ? \Carbon\Carbon::parse($deposit->close_date)->format('d-m-Y') : '—' }}</td>
                            <td>{{ $deposit->closed_date ? \Carbon\Carbon::parse($deposit->closed_date)->format('d-m-Y') : '—' }}</td>
                            @php
                                $selectClass = match($deposit->status) {
                                    1 => 'bg-warning text-dark',
                                    2 => 'bg-success text-white',
                                    3 => 'bg-secondary text-white',
                                    default => 'bg-light text-dark',
                                };
                            @endphp
                            <td>
                                <form action="{{ route('deposit.updateStatus', $deposit->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select 
                                    name="status" 
                                    class="status-change form-select form-select-sm {{ $selectClass }}"
                                    @if($deposit->status == 3) disabled @endif
                                    >
                                        <option value="1" {{ $deposit->status == 1 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $deposit->status == 2 ? 'selected' : '' }}>Running</option>
                                        <option value="3" {{ $deposit->status == 3 ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                 <button type="button" class="btn btn-sm bi bi-plus-lg" onclick="AddInterest('{{ $deposit->id }}')"></button>
                                 <button type="button" class="btn btn-sm bi bi-cloud-arrow-up" onclick="CashWithdraw('{{ $deposit->id }}')"></button>
                                <a href="{{ route('deposit.edit', $deposit->id) }}" class="btn btn-sm "><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('deposit.destroy', $deposit->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete this deposit?')" class="btn btn-sm  bi-trash"></button>
                                </form>
                            </td>
                        </tr>
                    
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if(method_exists($deposit, 'links'))
                <div class="mt-3">
                    {{ $deposit->links() }}
                </div>
            @endif
        </div>
    </div>
</main>


@include('backend.deposit.interest_modal')
@include('backend.deposit.modal')
@endsection


@push('js')
<script>
    function CashWithdraw(id) {
        $('#withdraw_deposit_id').val(id); // Set user ID input value
        $('#withdrawModal').modal('show'); // Show modal
    }

    function AddInterest(id2) {
        $('#interest_deposit_id').val(id2); // Set user ID input value
        $('#interestModal').modal('show'); // Show modal
    }
</script>
@endpush