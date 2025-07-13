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

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Loan Number</th>
                            <th>User Name</th>
                            <th>Balance</th>
                            <th>Collection Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $index => $loan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                               <td>{{ $loan->loan_number ?? '—' }}</td>
        <td>{{ $loan->user->name ?? 'N/A' }}</td>
        <td>{{ number_format($loan->$loanCollection->amount, 2) }}</td>
                                <td>
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" step="0.01" min="0">
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