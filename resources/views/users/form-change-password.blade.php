<div class="modal fade" id="passwordFormModal" tabindex="-1" aria-labelledby="createFormModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="true">
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
                                <label for="password">New password <span class="text-danger">*</span>:</label>
                                <input type="text" name="password" class="form-control" id="new_password" value="{{old('password')}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateProduct" onclick="updatePassword()">Submit</button>
            </div>
        </div>
    </div>
</div>
