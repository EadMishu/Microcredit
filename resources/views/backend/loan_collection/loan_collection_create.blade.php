@extends('backend.admin_master')
@section('content')

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">Add Loan Collection</h3>
        <a href="{{ route('loan_collections.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            

            {{-- Form --}}
            <form action="{{ route('loan_collections.store') }}" method="POST">
    @csrf
     <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" id="date" class="form-control"
               value="{{ old('date', date('Y-m-d')) }}">
    </div>

    <!-- Then comes your table and foreach loop -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Loan Number</th>
                <th>Loan Premium</th>
                <th>Balance</th>
                <th>Collection Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loan->user?->member_number ?? '—' }}</td>
                    <td>{{ $loan->user->name ?? 'N/A' }}</td>
                    <td>{{ $loan->loan_number ?? '—' }}</td>
                    <td>{{ number_format($loan->premium, 2) }}</td>
                    <td>{{ number_format(loan_balance($loan->id), 2) }}</td>
                    <td>
                        <input type="number" name="collections[{{ $index }}][amount]" class="form-control"
                               value="{{ old('collections.' . $index . '.amount') }}" step="0.01" min="0">
                        <input type="hidden" name="collections[{{ $index }}][loan_id]" value="{{ $loan->id }}">
                        <input type="hidden" name="collections[{{ $index }}][user_id]" value="{{ $loan->user?->id }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Save</button>
</form>
        </div>
    </div>
</main>

@endsection