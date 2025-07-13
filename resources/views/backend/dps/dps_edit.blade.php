@extends('backend.admin_master')

@section('content')
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit DPS</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dps.index') }}">DPS List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <form action="{{ route('dps.update', $dps->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-dark mb-3">
            <div class="card-header"><h5>DPS Information</h5></div>
            <div class="card-body">
                <div class="row gy-4">

                    <div class="col-md-6">
                        <label>DPS Number*</label>
                        <input type="text" name="dps_number" class="form-control" value="{{ old('dps_number', $dps->dps_number) }}">
                        @error('dps_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" value="{{ old('amount', $dps->amount) }}">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Member*</label>
                        <select name="user_id" class="form-control">
                            <option value="">Select user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $dps->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->mobile_number }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>DPS Type*</label>
                        <select name="dps_type_id" class="form-control">
                            <option value="">Select DPS Type</option>
                            @foreach ($dpsType as $type)
                                <option value="{{ $type->id }}" {{ old('dps_type_id', $dps->dps_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }} ({{ $type->percentage }}%)
                                </option>
                            @endforeach
                        </select>
                        @error('dps_type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Open Date*</label>
                        <input type="date" name="open_date" class="form-control" value="{{ old('date', \Carbon\Carbon::parse($loanCollection->date)->format('Y-m-d')) }}">
                        @error('open_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Closing Date</label>
                        <input type="date" name="close_date" class="form-control" value="{{ old('close_date', $dps->close_date) }}">
                        @error('close_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Closed Date</label>
                        <input type="date" name="closed_date" class="form-control" value="{{ old('closed_date', $dps->closed_date) }}">
                        @error('closed_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Status*</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $dps->status) == 1 ? 'selected' : '' }}>Pending</option>
                            <option value="2" {{ old('status', $dps->status) == 2 ? 'selected' : '' }}>Running</option>
                            <option value="3" {{ old('status', $dps->status) == 3 ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer col-md-6">
                <button type="submit" class="btn btn-success form-control">Update DPS</button>
            </div>
        </div>
    </form>
</main>
@endsection