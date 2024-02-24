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
                            <button class="btn btn-sm btn-primary" onclick="addItem()" data-bs-toggle="modal"
                                data-bs-target="#createFormModal">
                                <i class="ri-add-line fs-3"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name (English)</th>
                                    <th>Name (Khmer)</th>
                                    <th style="max-width: 50px !important;">Active</th>
                                    <th style="max-width: 80px !important;">Promotion</th>
                                    <th>Ordering</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name (English)</th>
                                    <th>Name (Khmer)</th>
                                    <th>Active</th>
                                    <th>Promotion</th>
                                    <th>Ordering</th>
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
    @include('admin.slides.form-modal')
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            getData();
        });

        let editID = null;
        $('#pageLoading').hide();

        // Get Data Backend
        const getData = () => {
            $.ajax({
                url: "{{ route('slide.get-data') }}",
                type: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        console.log(response.result);
                        getDataTable(response.result);
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }

        const getDefaultImage = () => {
            let defaultImg = "{{ asset('assets/images/default.png') }}";
            return defaultImg;
        }

        $('#image').on('change', (event) => {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#displayImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#background').on('change', (event) => {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#displayBackgroundImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        // Data Table
        const getDataTable = (data) => {
            console.log(data);

            let cols = [{
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(id, type, row) {
                        return id ?? `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "image",
                    "name": "image",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    render: function(image, type, row) {
                        return image != "undefined" ? `<img src="${image}" alt="${image}" height="40">` :
                            `<img src="${getDefaultImage()}" alt="default_${data.id}" height="40">`;
                    }
                },
                {
                    "data": "title_en",
                    "name": "title_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(title_en, type, row) {
                        return title_en ?? `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "title_kh",
                    "name": "title_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(title_kh, type, row) {
                        return title_kh ?? `<span class="text-body-tertiary">N/A</span>`;
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
                    "data": "is_promotion",
                    "name": "is_promotion",
                    "searchable": false,
                    "orderable": true,
                    "visible": true,
                    render: function(is_promotion, type, row) {
                        return `<div class="d-flex justify-content-center align-items-center">
                                <label class="switch-button">
                                    <input type="checkbox" ${is_promotion==1?"checked":""} onclick="btnPromotion(${row.id})">
                                    <span class="slider round"></span>
                                </label>
                            </div>`;
                    }
                },
                {
                    "data": "ordering",
                    "name": "ordering",
                    "searchable": false,
                    "orderable": true,
                    "visible": true,
                    render: function(ordering, type, row) {
                        return ordering ?? `<span class="text-body-tertiary">N/A</span>`;
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
                            <button type="submit" class="btn btn-sm btn-danger" onclick="deleteItem(${row.id}, '${row.title_en}')">
                                <i class="ri-delete-bin-6-line fs-4"></i>
                            </button>
                        </div>`;
                        return cta;
                    }
                },
            ];

            if ($.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable().clear();
                $('#dataTable').DataTable().destroy();
            }

            let datatable = $('#dataTable').DataTable({
                "data": data,
                "columns": cols,
                "buttons": [],
                "order": [0, 'asc'],
                "rowId": "id",
                "responsive": "true",
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12 table-responsive'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
        }

        const btnActive = (id) => {
            $.ajax({
                url: "{{ url('admin/slide/btn-active') }}/" + id,
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

        const btnPromotion = (id) => {
            $.ajax({
                url: "{{ url('admin/slide/btn-promotion') }}/" + id,
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

        const getFormValue = (method = null) => {
            let title_en = $('#title_en').val();
            let title_kh = $('#title_kh').val();
            let short_info_en = $('#short_info_en').val();
            let short_info_kh = $('#short_info_kh').val();
            let url = $('#url').val();
            let image = $('#image').val();
            let background = $('#background').val();
            // let is_active = $('#is_active').prop('checked') ? 1 : 0;
            let ordering = $('#ordering').val() ?? 0;

            let formData = new FormData();
            formData.append('title_en', title_en);
            formData.append('title_kh', title_kh);
            formData.append('short_info_en', short_info_en);
            formData.append('short_info_kh', short_info_kh);
            formData.append('url', url);
            // formData.append('is_active', is_active);
            formData.append('ordering', ordering);

            if (method == 'patch') {
                formData.append("_method", 'PATCH');
            }

            let imageInput = $('#image')[0].files[0];
            let backgroundImageInput = $('#background')[0].files[0];
            formData.append('image', imageInput);
            formData.append('background', backgroundImageInput);

            return formData;
        }

        const clearValue = () => {
            $('#title_en').val('');
            $('#title_kh').val('');
            $('#short_info_en').val('');
            $('#short_info_kh').val('');
            $('#url').val('');
            $('#image').val('');
            $('#background').val('');
            $('#is_active').val('');
            $('#is_promotion').val('');
            $('#ordering').val('');
        }

        // Edit Item
        const edit = (id) => {
            editID = id;
            clearValue();
            $('#btnStoreItem').hide();
            $('#btnUpdateItem').show();
            $.ajax({
                url: "{{ url('admin/slide') }}/" + id + "/edit",
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
        const assignEditData = (data) => {
            $('#title_en').val(data.title_en);
            $('#title_kh').val(data.title_kh);
            $('#short_info_en').val(data.short_info_en);
            $('#short_info_kh').val(data.short_info_kh);
            $('#url').val(data.url);
            $('#displayImage').attr('src', data.image);
            $('#displayBackgroundImage').attr('src', data.background);
            $('#ordering').val(data.ordering);
        }

        // Update Item
        const updateItem = () => {
            $.ajax({
                url: "{{ url('admin/slide') }}/" + editID,
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
                        toastr.error(response.message);
                    }
                }
            });
        }

        $('#loadingIcon').hide();
        // Adding Product
        const addItem = () => {
            clearValue();
            $('#btnStoreItem').show();
            $('#btnUpdateItem').hide();
        }
        const storeItem = () => {
            $.ajax({
                url: "{{ route('slide.store') }}",
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

        // Delete Item
        const deleteItem = (id, name) => {
            Swal.fire({
                title: "Are you sure?",
                text: `Do you want to delete item "${name}"?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/slide') }}/" + id,
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
    </script>
@endsection
