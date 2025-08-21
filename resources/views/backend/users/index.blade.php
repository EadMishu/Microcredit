@extends('backend.admin_master')


@section('content')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">User List</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Balance</th>
                        <th>Occupation</th>
                        <th>Division</th>
                        <th>District</th>
                        <th>Closed Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->mobile_number }}</td>
                            <td>{{ $user->balance }}</td>
                            <td>{{ $user->occupation }}</td>
                            <td>{{ optional($user->presentDivision)->name }}</td>
                            <td>{{ optional($user->presentDistrict)->name }}</td>
                            <td>{{ $user->closed_date ? \Carbon\Carbon::parse($user->closed_date)->format('d-m-Y') : '—' }}</td>
                            @php
                                $selectClass = match($user->status) {
                                    1 => 'bg-warning text-dark',
                                    2 => 'bg-success text-white',
                                    3 => 'bg-secondary text-white',
                                    default => 'bg-light text-dark',
                                };
                            @endphp
                            <td>
                                <form action="{{ route('user.updateStatus', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select 
                                    name="status" 
                                    class="status-change form-select form-select-sm {{ $selectClass }}"
                                    @if($user->status == 3) disabled @endif
                                    >
                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Running</option>
                                        <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            

                            <td>
                                 <button type="button" class="btn btn-sm bi bi-plus-lg" onclick="AddInterest({{ $user->id }})"></button>
                                 <button type="button" class="btn btn-sm bi bi-chevron-double-up" onclick="CashWithdraw({{ $user->id }})"></button>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm "><i class="bi bi-pencil-square"></i> </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm bi-trash"></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination (if using) --}}
            @if(method_exists($users, 'links'))
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</main>
@include('backend.users.modal')
@include('backend.users.interest_modal')
@endsection

@push('js')
<script>
    function CashWithdraw(id) {
        $('#withdraw_user_id').val(id); // Set user ID input value
        $('#withdrawModal').modal('show'); // Show modal
    }
</script>
@endpush
@push('js')
<script>
    function AddInterest(id) {
        $('#interest_user_id').val(id); // Set user ID input value
        $('#interestModal').modal('show'); // Show modal
    }
</script>
@endpush