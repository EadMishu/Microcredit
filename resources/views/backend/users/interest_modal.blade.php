<!-- start Modal  -->

<div class="modal fade" id="interestModal" tabindex="-1" aria-labelledby="modalLabel-interest" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('users.interest.store') }}" method="POST">
            @csrf
           
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Interest</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               <div class="modal-body">

    <input type="hidden" id="todayDate" name="date" value="{{ date('Y-m-d') }}"> <!-- Added -->
    
                    <div class="mb-3">
                        <label class="form-label">Interest Amount</label>
                        <input type="text" name="balance" class="form-control">
                        @error('balance')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="user_id" id="interest_user_id"> <!-- Added -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
  // Get today's date in YYYY-MM-DD format
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('todayDate').value = today;
</script>
<!-- end Modal  -->