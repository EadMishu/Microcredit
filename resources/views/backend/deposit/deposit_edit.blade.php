@extends('backend.admin_master')

@section('content')
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit deposit</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposit.index') }}">Deposit List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <form action="{{ route('deposit.update', $deposit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-dark mb-3">
            <div class="card-header"><h5>deposit Information</h5></div>
            <div class="card-body">
                <div class="row gy-4">

                    <div class="col-md-6">
                        <label>deposit Number*</label>
                        <input type="text" name="deposit_number" class="form-control" value="{{ old('deposit_number', $deposit->deposit_number) }}">
                        @error('deposit_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" value="{{ old('amount', $deposit->amount) }}">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Member*</label>
                        <select name="member_id" class="form-control">
                            <option value="">Select Member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id', $deposit->member_id) == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->mobile_number }})
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>deposit Type*</label>
                        <select name="deposit_type_id" class="form-control">
                            <option value="">Select deposit Type</option>
                            @foreach ($depositType as $type)
                                <option value="{{ $type->id }}" {{ old('deposit_type_id', $deposit->deposit_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }} ({{ $type->percentage }}%)
                                </option>
                            @endforeach
                        </select>
                        @error('deposit_type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Open Date*</label>
                        <input type="date" name="open_date" class="form-control" value="{{ old('open_date', $deposit->open_date) }}">
                        @error('open_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Closing Date</label>
                        <input type="date" name="close_date" class="form-control" value="{{ old('close_date', $deposit->close_date) }}">
                        @error('close_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Closed Date</label>
                        <input type="date" name="closed_date" class="form-control" value="{{ old('closed_date', $deposit->closed_date) }}">
                        @error('closed_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                   

                </div>
            </div>

            <div class="card-footer col-md-6">
                <button type="submit" class="btn btn-success form-control">Update deposit</button>
            </div>
        </div>
    </form>
</main>
@endsection