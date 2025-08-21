@extends('backend.admin_master')

@section('content')
 
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit Loan</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('loans.index') }}">Loan List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-dark mb-3">
            <div class="card-header"><h5>Loan Information</h5></div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <label>Loan Number*</label>
                        <input type="text" name="loan_number" class="form-control" value="{{ old('loan_number', $loan->loan_number) }}">
                        @error('loan_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" value="{{ old('amount', $loan->amount) }}">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-6">
                        <label>Loan Fee</label>
                        <input type="text" name="loan_fee" class="form-control" value="{{ old('loan_fee', $loan->loan_fee) }}">
                        @error('loan_fee')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-6">
                        <label>Service Charge</label>
                        <input type="text" name="loan_service_charge" class="form-control" value="{{ old('loan_service_charge', $loan->service_charge) }}">
                        @error('service_charge')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-6">
                        <label>Stamp Charge</label>
                        <input type="text" name="stamp_charge" class="form-control" value="{{ old('stamp_charge', $loan->stamp_charge) }}">
                        @error('stamp_charge')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-6">
                        <label>Premium</label>
                        <input type="text" name="premium" class="form-control" value="{{ old('premium', $loan->premium) }}">
                        @error('premium')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Member*</label>
                        <select name="user_id" class="form-control">
                            <option value="">Select user</option>
                            @foreach ($users as $user)
                            
                                <option value="{{ $user->id }}" {{ old('user_id', $loan->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->mobile_number }})
                                    
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Loan Type*</label>
                        <select name="loan_type_id" class="form-control">
                            <option value="">Select Loan Type</option>
                            @foreach ($loanTypes as $type)
                                <option value="{{ $type->id }}" {{ old('loan_type_id', $loan->loan_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }} ({{ $type->percentage }}%)
                                </option>
                            @endforeach
                        </select>
                        @error('loan_type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Open Date*</label>
                        <input type="date" name="open_date" class="form-control" value="{{ old('open_date', $loan->open_date) }}">
                        @error('open_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Closing Date</label>
                        <input type="date" name="close_date" class="form-control" value="{{ old('close_date', $loan->close_date) }}">
                        @error('close_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Closed Date</label>
                        <input type="date" name="closed_date" class="form-control" value="{{ old('closed_date', $loan->closed_date) }}">
                        @error('closed_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Status*</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $loan->status) == 1 ? 'selected' : '' }}>Pending</option>
                            <option value="2" {{ old('status', $loan->status) == 2 ? 'selected' : '' }}>Running</option>
                            <option value="3" {{ old('status', $loan->status) == 3 ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer col-md-6">
                <button type="submit" class="btn btn-success form-control">Update Loan</button>
            </div>
        </div>
    </form>
</main>
@endsection