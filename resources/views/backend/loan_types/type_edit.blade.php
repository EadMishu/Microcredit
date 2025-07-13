@extends('backend.admin_master')

@section('content')

<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit Loan Type</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('loan-types.index') }}">Loan Type List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <form action="{{ route('loan-types.update', $loanType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-dark mb-3">
            <div class="card-header"><h5>Edit Loan Type</h5></div>
            <div class="card-body">
                <div class="row gy-4">

                    <div class="col-md-6">
                        <label>Name*</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $loanType->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Percentage (%)*</label>
                        <input type="number" name="percentage" class="form-control" step="0.01" value="{{ old('percentage', $loanType->percentage) }}">
                        @error('percentage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Duration (Months)*</label>
                        <input type="number" name="duration" class="form-control" value="{{ old('duration', $loanType->duration) }}">
                        @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Number of Installments*</label>
                        <input type="number" name="number_of_installments" class="form-control" value="{{ old('number_of_installments', $loanType->number_of_installments) }}">
                        @error('number_of_installments')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Status*</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $loanType->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $loanType->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer  col-md-6">
                <button type="submit" class="btn btn-success form-control">Update Loan Type</button>
            </div>
        </div>
    </form>
</main>

@endsection