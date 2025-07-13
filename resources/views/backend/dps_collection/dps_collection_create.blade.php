@extends('backend.admin_master')
@section('content')

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">Add dps Collection</h3>
        <a href="{{ route('dps_collections.index') }}" class="btn btn-secondary">Back to List</a>
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
            <form action="{{ route('dps_collections.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="user_id" class="form-label">Select User</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="dps_id" class="form-label">Select dps (Optional)</label>
                    <select name="dps_id" id="dps_id" class="form-select">
                        <option value="">-- Select dps --</option>
                        @foreach($dpss as $dps)
                            <option value="{{ $dps->id }}" {{ old('dps_id') == $dps->id ? 'selected' : '' }}>
                                dps >{{ $dps->dps_number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" step="0.01" min="0">
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</main>

@endsection