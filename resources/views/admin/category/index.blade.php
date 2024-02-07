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
                            <button class="btn btn-sm btn-primary" onclick="addItem()" data-bs-toggle="modal" data-bs-target="#createFormModal">
                                <i class="ri-add-line fs-3"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <th>Id</th>
                                    <th>Name (English)</th>
                                    <th>Name (Khmer)</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <th>Id</th>
                                    <th>Name (English)</th>
                                    <th>Name (Khmer)</th>
                                    <th>Created At</th>
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
    @include('admin.category.form-modal')
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            getData();
        });

        let editID = null;
        $('#pageLoading').hide();

        // Get Data Backend
        let getData = () => {
            $.ajax({
                url: "{{ route('category.get-data') }}",
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
            console.log(data);

            let cols = [
                {
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(id, type, row) {
                        return id ? id : `<span class="text-body-tertiary">N/A</span>`;
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
                    "data": "name_kh",
                    "name": "name_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(name_kh, type, row) {
                        return name_kh ? name_kh : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "created_at",
                    "name": "created_at",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(created_at, type, row) {
                        return created_at != null ? moment(created_at).format('MMM D, YYYY') : `<span class="text-body-tertiary">N/A</span>`;
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

        let getFormValue = (method = null) => {
            let name_en = $('#name_en').val();
            let name_kh = $('#name_kh').val();

            let formData = new FormData();
            formData.append('name_en', name_en);
            formData.append('name_kh', name_kh);

            if (method == 'patch') {
                formData.append("_method", 'PATCH');
            }

            return formData;
        }

        let clearValue = () => {
            $('#name_en').val('');
            $('#name_kh').val('');
        }

        // Edit Item
        let edit = (id) => {
            editID = id;
            clearValue();
            $('#btnStoreItem').hide();
            $('#btnUpdateItem').show();
            $.ajax({
                url: "{{ url('admin/category') }}/" + id + "/edit",
                type: "GET",
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response){
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
            $('#name_en').val(data.name_en);
            $('#name_kh').val(data.name_kh);
        }

        // Update Item
        let updateItem = () => {
            $.ajax({
                url: "{{ url('admin/category') }}/" + editID,
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
        let addItem = () => {
            clearValue();
            $('#btnStoreItem').show();
            $('#btnUpdateItem').hide();
        }
        let storeItem = () => {
            $.ajax({
                url: "{{ route('category.store') }}",
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

        // Delete Item
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
                        url: "{{ url('admin/category') }}/" + id,
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
