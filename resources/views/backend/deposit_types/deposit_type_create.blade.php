@extends('backend.admin_master')

@section('content')
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Add deposit Type</h3>

    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposit-types.index') }}">Deposit Type List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <form action="{{ route('deposit-types.store') }}" method="POST">
        @csrf

        <div class="card card-dark mb-3">
            <div class="card-header"><h5>deposit Type Information</h5></div>
            <div class="card-body">
                <div class="row gy-4">

                    <div class="col-md-6">
                        <label>Name*</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Interest Percentage (%)*</label>
                        <input type="number" step="0.01" name="percentage" class="form-control" value="{{ old('percentage') }}" required>
                        @error('percentage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Duration (months)*</label>
                        <input type="number" name="duration" class="form-control" value="{{ old('duration') }}" required>
                        @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
<div class="">
                        <input type="hidden" name="status" value="1">
                    </div>

                   

                </div>
            </div>

            <div class="card-footer col-md-6">
                <button type="submit" class="btn btn-success form-control">Save deposit Type</button>
                
            </div>
        </div>
    </form>
</main>
@endsection