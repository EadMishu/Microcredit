@extends('backend.admin_master')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif


<main class="main-content px-3">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3 class="text-muted">expence Type List</h3>
        <a href="{{ route('expense-types.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">


   <table class="table">
       <thead>
           <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Action</th>
           </tr>
       </thead>
       <tbody>
           @foreach($expenseTypes as $expenseType)
           <tr>
               <td>{{ $expenseType->id }}</td>
               <td>{{ $expenseType->name }}</td>
               <td>
                   <a href="{{ route('expense-types.edit', $expenseType->id) }}" class="btn btn-sm"><i class="bi bi-pencil-square"></i></a>
                   <form action="{{ route('expense-types.destroy', $expenseType->id) }}" method="POST" class="d-inline">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-sm bi-trash"></button>
                   </form>
               </td>
           </tr>
           @endforeach
       </tbody>
   </table>
</main>


@endsection