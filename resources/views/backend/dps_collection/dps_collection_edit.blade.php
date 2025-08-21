@extends('backend.admin_master')
@section('content')

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">Edit dps Collections for {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h3>
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
            <form action="{{ route('dps_collections.update_date', $date) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $date }}" readonly>
                </div>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>dps Number</th>
                            <th>dps Premium</th>
                            <th>Balance</th>
                            <th>Collection Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpss as $index => $dps)
                        
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dps->user?->member_number ?? '—' }}</td>
                                <td>{{ $dps->user->name ?? 'N/A' }}</td>
                                <td>{{ $dps->dps_number ?? '—' }}</td>
                                <td>{{ number_format($dps->premium, 2) }}</td>
                                <td>{{ number_format(dps_balance($dps->id), 2) }}</td>
                                <td>
                                    <input type="number" name="collections[{{ $index }}][amount]" class="form-control"
                                           value="{{ $dps->dpsCollection()?->whereDate('date', $date)->first()?->amount }}"
                                           step="0.01" min="0">
                                    <input type="hidden" name="collections[{{ $index }}][dps_id]" value="{{ $dps->id }}">
                                    <input type="hidden" name="collections[{{ $index }}][user_id]" value="{{ $dps->user_id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</main>

@endsection