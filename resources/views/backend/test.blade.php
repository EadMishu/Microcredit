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

    <form method="POST" action="submit.php">
    <div id="repeater">
        <div class="input-group">
          <div class="col-md-2">
            <input type="text" class="form-control" name="name[]" placeholder="Name" >
            </div>
            <div class="col-md-2">
            <input type="text"placeholder="deposit_amount" name="deposit_amount" class="form-control" value="{{ old('deposit_amount') }}">
            </div>
            <div class="col-md-2">
             <input type="text"placeholder="loan_amount" name="loan_amount" class="form-control" value="{{ old('loan_amount') }}">
             </div>
             <div class="col-md-2">
              <input type="email" class="form-control" name="email[]" placeholder="Email" >
              </div>
            
            
            <button type="button" class="remove-btn">Remove</button>
        </div>
    </div>

    <button type="button" class="add-btn" id="addRow">Add More</button>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>
</main>

 <script>
    $(document).ready(function(){
        $("#addRow").click(function(){
            let html = `<div class="input-group">
                <input type="text"class="form-control" name="name[]" placeholder="Name" required>
                <input type="email" class="form-control"name="email[]" placeholder="Email" required>
                <input type="email" class="form-control"name="email[]" placeholder="Email" required>
                <input type="email" class="form-control" name="email[]" placeholder="Email" required>
                <button type="button" class="remove-btn">Remove</button>
            </div>`;
            $("#repeater").append(html);
        });

        $(document).on('click', '.remove-btn', function(){
            $(this).closest('.input-group').remove();
        });
    });
</script>


@endsection