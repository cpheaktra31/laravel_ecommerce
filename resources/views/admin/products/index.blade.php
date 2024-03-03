@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="max-width: 100%;">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex align-item-center">
                            <h4 class="mb-0">Product List</h4>
                            <div class="ms-auto"></div>
                            <button class="btn btn-sm btn-primary" onclick="addProduct()" data-bs-toggle="modal"
                                data-bs-target="#createFormModal">
                                <i class="ri-add-line fs-3"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Active</th>
                                    <th>Feature</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Active</th>
                                    <th>Feature</th>
                                    <th>Action</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.products.form-modal')
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            getData();

            let getDefaultImage = () => {
                let defaultImg = "{{ asset('assets/images/default.png') }}";
                return defaultImg;
            }

            const sNoteOption = (placeholder = "Note", height = 300) => {
                return {
                    placeholder: placeholder,
                    tabsize: 2,
                    height: height,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                };
            }

            $('#description_kh').summernote(sNoteOption("Description (Khmer)", 200));
            $('#description_en').summernote(sNoteOption("Description (English)", 200));
        });

        $('#featured_image').on('change', (event) => {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#displayFeaturedImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        let editID = null;
        $('#pageLoading').hide();

        // Get Data Backend
        let getData = () => {
            $.ajax({
                url: "{{ route('product.get-data') }}",
                type: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        getDataTable(response.result);
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }

        let changeCurrency = (value, currency) => {
            if (currency == "USD" || currency == "usd" || currency == "Usd")
                return parseFloat(value).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                });
            else if (currency == "KHR" || currency == "khr" || currency == "Khr")
                return parseFloat(value).toLocaleString('en-KH', {
                    style: 'currency',
                    currency: 'KHR',
                    minimumFractionDigits: 0
                }).replace('KHR', '') + '៛';
        }

        // Data Table
        let getDataTable = (data) => {
            let cols = [{
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "featured_image",
                    "name": "featured_image",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    render: function(featured_image, type, row) {
                        return featured_image != "undefined" ?
                            `<img src="${featured_image}" alt="${featured_image}" height="40">` :
                            `<img src="{{ asset('assets/images/default.png') }}" alt="default_${data.id}" height="40">`;
                    }
                },
                {
                    "data": "name_en",
                    "name": "name_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(name_en, type, row) {
                        return name_en ? name_en : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "price",
                    "name": "price",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(price, type, row) {
                        return price ? changeCurrency(price, "USD") :
                            `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "catNameEn",
                    "name": "catNameEn",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(catNameEn, type, row) {
                        return catNameEn ? catNameEn : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "is_active",
                    "name": "is_active",
                    "searchable": false,
                    "orderable": true,
                    "visible": true,
                    render: function(is_active, type, row) {
                        return `<div class="d-flex justify-content-center align-items-center">
                                <label class="switch-button">
                                    <input type="checkbox" ${is_active==1?"checked":""} onclick="btnActive(${row.id})">
                                    <span class="slider round"></span>
                                </label>
                            </div>`;
                    }
                },
                {
                    "data": "is_feature",
                    "name": "is_feature",
                    "searchable": false,
                    "orderable": true,
                    "visible": true,
                    render: function(is_feature, type, row) {
                        return `<div class="d-flex justify-content-center align-items-center">
                                <label class="switch-button">
                                    <input type="checkbox" ${is_feature==1?"checked":""} onclick="btnFeature(${row.id})">
                                    <span class="slider round"></span>
                                </label>
                            </div>`;
                    }
                },
                {
                    "data": null,
                    "name": "Action",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    render: function(data, type, row) {
                        let cta = `<div class="d-flex gap-1">
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#createFormModal" onclick="edit(${row.id})">
                                <i class="ri-edit-box-line fs-4"></i>
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="deleteItem(${row.id})">
                                <i class="ri-delete-bin-6-line fs-4"></i>
                            </button>
                        </div>`;
                        return cta;
                    }
                },
            ];
            // <a href="{{ url('admin/product/out/') }}/${row.id}" class="btn btn-sm btn-success d-flex align-items-center" style="width:max-content;">
            //                     Stock Out
            //                 </a>

            if ($.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable().clear();
                $('#dataTable').DataTable().destroy();
            }

            let datatable = $('#dataTable').DataTable({
                "data": data,
                "columns": cols,
                "buttons": [],
                "order": [0, 'desc'],
                "rowId": "id",
                "responsive": "true",
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12 table-responsive'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
        }

        let getFormValue = (method = null) => {
            let category_id = $('#category_id').val();
            let name_en = $('#name_en').val();
            let name_kh = $('#name_kh').val();
            let short_info_kh = $('#short_info_kh').val();
            let short_info_en = $('#short_info_en').val();
            let price = $('#price').val();
            let description_kh = $('#description_kh').val();
            let description_en = $('#description_en').val();
            let featured_image = $('#featured_image').val();

            let formData = new FormData();
            formData.append('category_id', category_id);
            formData.append('name_en', name_en);
            formData.append('name_kh', name_kh);
            formData.append('short_info_kh', short_info_kh);
            formData.append('short_info_en', short_info_en);
            formData.append('price', price);
            formData.append('description_kh', description_kh);
            formData.append('description_en', description_en);

            if (method == 'patch') {
                formData.append("_method", 'PATCH');
            }

            let featuredImageInput = $('#featured_image')[0].files[0];
            formData.append('featured_image', featuredImageInput);

            return formData;
        }

        let clearValue = () => {
            $('#category_id').val('');
            $('#name_en').val('');
            $('#name_kh').val('');
            $('#short_info_kh').val('');
            $('#short_info_en').val('');
            $('#price').val('');
            $('#description_en').summernote('code', '');
            $('#description_kh').summernote('code', '');
            $('#featured_image').val('');
            $('#displayFeaturedImage').attr('src', '');
        }

        // Edit Product
        let edit = (id) => {
            editID = id;
            clearValue();
            $('#btnStoreProduct').hide();
            $('#btnUpdateProduct').show();
            $.ajax({
                url: "{{ url('admin/product') }}/" + id + "/edit",
                type: "GET",
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        assignEditData(response.result);
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }
        let assignEditData = (data) => {
            $('#category_id').val(data.category_id);
            $('#name_en').val(data.name_en);
            $('#name_kh').val(data.name_kh);
            $('#short_info_kh').val(data.short_info_kh);
            $('#short_info_en').val(data.short_info_en);
            $('#price').val(data.price);
            $('#description_en').summernote('code', data.description_en);
            $('#description_kh').summernote('code', data.description_kh);
            $('#displayFeaturedImage').attr('src', data.featured_image);
        }

        // Update Product
        let updateProduct = () => {
            $.ajax({
                url: "{{ url('admin/product') }}/" + editID,
                type: "post",
                data: getFormValue('patch'),
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        clearValue();
                        $('#createFormModal').modal('toggle');
                        toastr.success(response.message);
                        getData();
                    } else {
                        $('#pageLoading').hide();
                        console.log(response.result);
                        toastr.error(response.message);
                    }
                }
            });
        }

        $('#loadingIcon').hide();
        // Adding Product
        let addProduct = () => {
            clearValue();
            $('#btnStoreProduct').show();
            $('#btnUpdateProduct').hide();
        }
        let storeProduct = () => {
            $.ajax({
                url: "{{ route('product.store') }}",
                type: "POST",
                data: getFormValue(),
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        clearValue();
                        $('#createFormModal').modal('toggle');
                        toastr.success(response.message);
                        getData();
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }

        // Delete Product
        let deleteItem = (id) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/product') }}/" + id,
                        type: "DELETE",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $('#pageLoading').show();
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                $('#pageLoading').hide();
                                toastr.success(response.message);
                                getData();
                            } else {
                                $('#pageLoading').hide();
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
        }

        const btnActive = (id) => {
            $.ajax({
                url: "{{ url('admin/product/btn-active') }}/" + id,
                type: "POST",
                // data: {id:id},
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        toastr.success(response.message);
                        getData();
                    } else if (response.status == 'warning') {
                        $('#pageLoading').hide();
                        toastr.warning(response.message);
                        getData();
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }

        const btnFeature = (id) => {
            $.ajax({
                url: "{{ url('admin/product/btn-feature') }}/" + id,
                type: "POST",
                // data: {id:id},
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        toastr.success(response.message);
                        getData();
                    } else if (response.status == 'warning') {
                        $('#pageLoading').hide();
                        toastr.warning(response.message);
                        getData();
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }
    </script>
@endsection
