<div class="modal fade" id="extendModal2" tabindex="-1" aria-labelledby="modalLabel-extend" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('add-balance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="user_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Balance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Balance</label>
                        <input type="text" name="balance" class="form-control">
                        @error('balance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="date" value="{{ old('date', now()->format('Y-m-d')) }}">
                    
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