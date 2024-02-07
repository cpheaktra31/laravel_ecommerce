<div class="modal fade" id="createFormModal" tabindex="-1" aria-labelledby="createFormModalLabel" aria-hidden="true"
    data-bs-keyboard="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="name_en">Name (English) <span class="text-danger">*</span>:</label>
                        <input type="text" name="name_en" class="form-control" id="name_en" value="{{old('name_en')}}">
                    </div>
                    <div class="mb-3">
                        <label for="name_kh">Name (Khmer) <span class="text-danger">*</span>:</label>
                        <input type="text" name="name_kh" class="form-control" id="name_kh" value="{{old('name_kh')}}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnStoreItem" onclick="storeItem()">Add</button>
                <button type="button" class="btn btn-primary" id="btnUpdateItem" onclick="updateItem()">Update</button>
            </div>
        </div>
    </div>
</div>
