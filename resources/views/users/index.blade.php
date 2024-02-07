@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex align-item-center">
                            <h4 class="mb-0">Product List</h4>
                            <div class="ms-auto"></div>
                            <button class="btn btn-sm btn-primary" onclick="addProduct()" data-bs-toggle="modal" data-bs-target="#createFormModal">
                                <i class="ri-add-line fs-3"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
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
    @include('users.form-modal')
    @include('users.form-change-password')
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            getData();
        });

        $('#image').on('change', (event) => {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#displayImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        let editID = null;
        let changePasswordID = null;
        $('#pageLoading').hide();

        // Get Data Backend
        let getData = () => {
            $.ajax({
                url: "{{ route('users.get-data') }}",
                type: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response){
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

        // Data Table
        let getDataTable = (data) => {
            let cols = [
                {
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "image",
                    "name": "image",
                    "searchable": false,
                    "orderable": false,
                    "visible": true,
                    render: function(image, type, row) {
                        return image != "undefined" ? `<img src="${image}" alt="${image}" height="40">` : `<img src="${getDefaultImage()}" alt="default_${data.id}" height="40">`;
                    }
                },
                {
                    "data": "name",
                    "name": "name",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(name, type, row) {
                        return name ? name : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "email",
                    "name": "email",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(cateName, type, row) {
                        return cateName ? cateName : `<span class="text-body-tertiary">N/A</span>`;
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
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#passwordFormModal" onclick="changePassword(${row.id})">
                                <i class="ri-key-line fs-4"></i>
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="deleteItem(${row.id})">
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
                "order": [0, 'desc'],
                "rowId": "id",
                "responsive": "true",
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12 table-responsive'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
        }

        let getDefaultImage = () => {
            let defaultImg = "{{asset('assets/images/default.png')}}";
            return defaultImg;
        }

        let getFormValue = (method = null) => {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let confirm_password = $('#confirm_password').val();

            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('confirm_password', confirm_password);

            if (method == 'patch') {
                formData.append("_method", 'PATCH');
            }

            let imageInput = $('#image')[0].files[0];
            formData.append('image', imageInput);

            return formData;
        }

        let clearValue = () => {
            $('#name').val('');
            $('#email').val('');
        }

        // Edit user
        let edit = (id) => {
            editID = id;
            clearValue();
            $('.is_create').hide();
            $('#btnStoreProduct').hide();
            $('#btnUpdateProduct').show();
            $.ajax({
                url: "{{ url('admin/user') }}/" + id + "/edit",
                type: "GET",
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response){
                    if (response.status == 'success') {
                        console.log(response.result);
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
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#displayImage').attr('src', data.image);
        }

        // Update user
        let updateProduct = () => {
            $.ajax({
                url: "{{ url('admin/user') }}/" + editID + "/update",
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
                success: function(response){
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

        let changePassword = (id) => {
            changePasswordID = id;
            clearValue();
        }
        // Update user
        let updatePassword = () => {
            $.ajax({
                url: "{{ url('admin/user/change-password') }}/" + changePasswordID,
                type: "post",
                data:getFormValue('patch'),
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response){
                    if (response.status == 'success') {
                        $('#pageLoading').hide();
                        clearValue();
                        $('#passwordFormModal').modal('toggle');
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
        let addProduct = () => {
            clearValue();
            $('.is_create').show();
            $('#btnStoreProduct').show();
            $('#btnUpdateProduct').hide();
        }

        let storeProduct = () => {
            $.ajax({
                url: "{{ route('users.store') }}",
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
                success: function(response){
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
                        url: "{{ url('admin/user') }}/" + id + "/delete",
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
                        success: function(response){
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
