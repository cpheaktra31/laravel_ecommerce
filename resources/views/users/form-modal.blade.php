<div class="modal fade" id="createFormModal" tabindex="-1" aria-labelledby="createFormModalLabel" aria-hidden="true"
    data-bs-keyboard="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label for="name">Name <span class="text-danger">*</span>:</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email <span class="text-danger">*</span>:</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="mb-3 is_create">
                                <label for="password">Password <span class="text-danger">*</span>:</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{ old('password') }}">
                            </div>
                            <div class="mb-3 is_create">
                                <label for="confirm_password">Confirm Password <span
                                        class="text-danger">*</span>:</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm_password" value="{{ old('confirm_password') }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label for="image">Image:</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    accept="image/*">
                            </div>
                            <img src="" id="displayImage" class="img-fluid" alt="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnStoreProduct"
                    onclick="storeProduct()">Add</button>
                <button type="button" class="btn btn-primary" id="btnUpdateProduct"
                    onclick="updateProduct()">Update</button>
            </div>
        </div>
    </div>
</div>
