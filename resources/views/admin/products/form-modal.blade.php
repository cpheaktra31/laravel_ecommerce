<div class="modal fade" id="createFormModal" tabindex="-1" aria-labelledby="createFormModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-lg-8 col-md-9 col-sm-12">
                            <div class="mb-3">
                                <label for="name_en">Name (English) <span class="text-danger">*</span> :</label>
                                <input type="text" name="name_en" class="form-control" id="name_en">
                            </div>
                            <div class="mb-3">
                                <label for="name_kh">Name (Khmer) <span class="text-danger">*</span> :</label>
                                <input type="text" name="name_kh" class="form-control" id="name_kh">
                            </div>
                            <div class="mb-3">
                                <label for="max_price">Maximum Price <span class="text-danger">*</span> :</label>
                                <input type="number" name="max_price" class="form-control" id="max_price">
                            </div>
                            <div class="mb-3">
                                <label for="min_price">Minimum Price <span class="text-danger">*</span> :</label>
                                <input type="number" name="min_price" class="form-control" id="min_price">
                            </div>
                            <div class="mb-3">
                                <label for="description_en">Description (English) <span class="text-danger">*</span>
                                    :</label>
                                <textarea id="description_en" name="description_en"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description_kh">Description (Khmer) <span class="text-danger">*</span>
                                    :</label>
                                <textarea id="description_kh" name="description_kh"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="category_id">Category <span class="text-danger">*</span> :</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    @foreach (@$categories as $key => $item)
                                        <option value="{{ $item->id }}" {{ $key == 0 ? 'selected' : '' }}>
                                            {{ $item->name_en }} - {{ $item->name_kh }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <label for="featured_image">Feature Image:</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image"
                                    accept="image/*">
                            </div>
                            <img src="" id="displayFeaturedImage" class="img-fluid mb-3 mt-3" alt="">
                            <div class="mb-3">
                                <label for="short_info_en">Short Info (English)</label>
                                <textarea name="short_info_en" class="form-control" id="short_info_en" rows="3">{{ old('short_info_en') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="short_info_kh">Short Info (Khmer)</label>
                                <textarea name="short_info_kh" class="form-control" id="short_info_kh" rows="3">{{ old('short_info_kh') }}</textarea>
                            </div>
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
