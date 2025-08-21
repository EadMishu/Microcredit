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

<main class="main-content px-3">
    @stack('js')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">owner List</h3>
        <a href="{{ route('owner.create') }}" class="btn btn-primary">Add New owner</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name </th>
                        <th>Mobile</th>
                        <th>Rules</th>
                        <th>Occupation</th>
                        <th>Division</th>
                        <th>District</th>
                       <th>Balance</th>
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
                            <td><span class="badge rounded-pill text-bg-primary">@if($user->role == 4) owner @endif</span></td>
                            <td>{{ $user->occupation }}</td>
                            <td>{{ optional($user->presentDivision)->name }}</td>
                            <td>{{ optional($user->presentDistrict)->name }}</td>
                            <td>{{ $user->balance }}</td>
                             @php
                                $selectClass = match($user->status) {
                                    1 => 'bg-warning text-dark',
                                    2 => 'bg-success text-white',
                                    3 => 'bg-secondary text-white',
                                    default => 'bg-light text-dark',
                                };
                            @endphp
                            <td>
                                <form action="{{ route('owner.updateStatus', $user->id) }}" method="POST">
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
                                <button type="button" class="btn btn-sm bi bi-plus-lg" onclick="userExtends({{$user->id}})"></button>
                                <a href="{{ route('owner.edit', $user->id) }}" class="btn btn-sm "><i class="bi bi-pencil-square"></i> </a>
                                <form action="{{ route('owner.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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

@include('backend.owner.modal')

@endsection

@push('js')
<script>
    function userExtends(id) {
        $('#user_id').val(id); // Set user_id input value
        $('#extendModal2').modal('show'); // Show modal
    }
</script>
@endpush