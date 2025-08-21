@extends('backend.admin_master')

@section('content')
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit Expense</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('expense.index') }}">Expense List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('expense.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Date*</label>
                    <input type="date" class="form-control" name="date" value="{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}" required>

                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Expense Type*</label>
                    <select name="expense_type_id" class="form-control">
                        <option value="">Select Expense Type</option>
                        @foreach ($expenseTypes as $type)
                            <option value="{{ $type->id }}" {{ $expense->expense_type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('expense_type_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $expense->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Expense</button>
            </form>
        </div>
    </div>
</main>
@endsection