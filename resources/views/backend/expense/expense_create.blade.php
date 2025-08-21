@extends('backend.admin_master')

@section('content')

<main class="main-content px-3">
   <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
       <h3 class="text-muted">Add New Expense</h3>
       <a href="{{ route('expense.index') }}" class="btn btn-primary">Back to List</a>
   </div>
   <div class="card">
       <div class="card-body">
           <form action="{{ route('expense.store') }}" method="POST">
               @csrf


                <div class="mb-3">
                     <label>Date*</label>
                     <input type="date" class="form-control" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                     @error('date')
                          <div class="text-danger">{{ $message }}</div>
                     @enderror
               </div>
               <div class="mb-3">
                    <label>Expense Type*</label>
                        <select name="expense_type_id" class="form-control">
    <option value="">Select Expense Type</option>
    @foreach ($expenseTypes as $type)
        <option value="{{ $type->id }}" {{ old('expense_type_id') == $type->id ? 'selected' : '' }}>
            {{ $type->name }}
        </option>
    @endforeach
</select>
                        @error('expense_type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
               </div>
               <div class="mb-3">
                   <label for="description" class="form-label">Description</label>
                   <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
               </div>
               <div class="mb-3">
                   <label for="amount" class="form-label">Amount</label>
                   <input type="number" class="form-control" id="amount" name="amount" required>
               </div>
               <button type="submit" class="btn btn-primary">Add Expense</button>
           </form>
       </div>
   </div>
</main>



@endsection
