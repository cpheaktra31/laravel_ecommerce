<div class="modal fade" id="createFormModal" tabindex="-1" aria-labelledby="createFormModalLabel" aria-hidden="true"
    data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <label for="title_en">Name (English) <span class="text-danger">*</span>:</label>
                                <input type="text" name="title_en" class="form-control" id="title_en">
                            </div>
                            <div class="mb-3">
                                <label for="title_kh">Name (Khmer) <span class="text-danger">*</span>:</label>
                                <input type="text" name="title_kh" class="form-control" id="title_kh">
                            </div>
                            <div class="mb-3">
                                <label for="short_info_en">Short Info (English):</label>
                                <textarea name="short_info_en" class="form-control" id="short_info_en" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="short_info_kh">Short Info (Khmer):</label>
                                <textarea name="short_info_kh" class="form-control" id="short_info_kh" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="url">URL:</label>
                                <input type="text" name="url" class="form-control" id="url">
                            </div>
                            <div class="mb-3">
                                <label for="ordering">Ordering:</label>
                                <input type="number" name="ordering" class="form-control" id="ordering"
                                    value="{{ old('ordering') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="">
                                <label for="image">Image: <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" id="image"
                                    accept="image/*">
                            </div>
                            <img src="" id="displayImage" class="img-fluid mb-3 mt-3" alt="">
                            <div class="">
                                <label for="background">Background:</label>
                                <input type="file" name="background" class="form-control" id="background"
                                    accept="image/*">
                            </div>
                            <img src="" id="displayBackgroundImage" class="img-fluid mb-3 mt-3" alt="">
                        </div>
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
