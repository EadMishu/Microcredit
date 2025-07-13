<div class="modal fade" id="extendModal" tabindex="-1" aria-labelledby="modalLabel-{{ $loan->id }}"  aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('time-extension.store') }}" method="POST">
            @csrf
            <input type="hidden" name="loan_id" id="loan_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="extendModalLabel">Extend Time</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-12">
                            <label class="form-label">Amount</label>
                            <input type="text" name="amount"  class="form-control">
                            @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Closing Date</label>
                            <input type="date" name="close_date"  class="form-control">
                            @error('close_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
<!-- end Modal  -->