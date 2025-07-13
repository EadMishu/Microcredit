@extends('backend.admin_master')
@section('content')

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">Loan List</h3>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">Add New Loan</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Loan Number</th>
                        <th>Amount</th>
                        <th>user Name</th>
                        <th>Loan Type</th>
                        <th>Open Date</th>
                        <th>Closing Date</th>
                        <th>Closed Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($loans as $index => $loan) <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $loan->loan_number }}</td>
                        <td>{{ $loan->amount }}</td>
                        <td>{{ optional($loan->user)->name ?? 'N/A' }}</td>
                        <td>{{ optional($loan->loanType)->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->open_date)->format('d-m-Y') }}</td>
                        <td>{{ $loan->extends ? $loan->extends?->close_date : \Carbon\Carbon::parse($loan->close_date)->format('d-m-Y') }}</td>
                        <td>{{ $loan->closed_date ? \Carbon\Carbon::parse($loan->closed_date)->format('d-m-Y') : '—' }}</td> @php $selectClass = match($loan->status) { 1 => 'bg-warning text-dark', 2 => 'bg-primary text-white', 3 => 'bg-success text-white', default => 'bg-light text-dark', }; @endphp <td>
                            <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST"> @csrf @method('PATCH') <select name="status" onchange="this.form.submit()" class="form-select form-select-sm {{ $selectClass }}">
                                    <option value="1" {{ $loan->status == 1 ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ $loan->status == 2 ? 'selected' : '' }}>Running</option>
                                    <option value="3" {{ $loan->status == 3 ? 'selected' : '' }}>complete</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            
                            <button type="button" class="btn btn-sm bi bi-hourglass-top" onclick="loanExtends({{$loan->id}})"></button>

                            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm ">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline-block;"> @csrf @method('DELETE')<button onclick="return confirm('Are you sure to delete this loan?')" class="btn btn-sm  bi-trash"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        
            {{-- Pagination --}}
            @if(method_exists($loans, 'links'))
            <div class="mt-3">{{ $loans->links() }}</div> 
            @endif
        </div>
    </div>
</main>
@include('backend.loans.modal')
@endsection

@push('js')
    <script>
        function loanExtends(id) {
            console.log(id);
            $('#loan_id').val(id);
           $('#extendModal').modal('show');
        }
    </script>
@endpush