<!-- start Modal  -->

<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="modalLabel-withdraw" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('deposit.cash.withdraw.store') }}" method="POST">
            @csrf
           
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Cash Withdraw</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               <div class="modal-body">

                        <input type="hidden" id="todayDate" name="date" value="{{ date('Y-m-d') }}"> <!-- Added -->
                        <input type="hidden" name="deposit_id" id="withdraw_deposit_id"> <!-- Added -->
    
                    <div class="mb-3">
                        <label class="form-label">Withdraw Amount</label>
                        <input type="text" name="amount" class="form-control">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
             

               </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
