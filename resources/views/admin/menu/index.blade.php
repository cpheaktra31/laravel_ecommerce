@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="max-width: 100%;">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex align-item-center">
                            <h4 class="mb-0">Blog List</h4>
                            <div class="ms-auto"></div>
                            <button class="btn btn-sm btn-primary" onclick="addItem()" data-bs-toggle="modal"
                                data-bs-target="#createFormModal">
                                <i class="ri-add-line fs-3"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Name (English)</th>
                                    <th>Name (Title)</th>
                                    <th>Menu Type</th>
                                    <th>Type</th>
                                    <th style="max-width: 70px !important;">Ordering</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <th>ID</th>
                                    <th>Name (English)</th>
                                    <th>Name (Title)</th>
                                    <th>Menu Type</th>
                                    <th>Type</th>
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
    @include('admin.menu.form-modal')
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            getDataTable();

            let getDefaultImage = () => {
                let defaultImg = "{{ asset('assets/images/default.png') }}";
                return defaultImg;
            }
        });

        let editID = null;
        $('#pageLoading').hide();

        // Data Table
        const getDataTable = () => {
            let cols = [{
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                },
                {
                    "data": "name_en",
                    "name": "name_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(name_en, type, row) {
                        return name_en ?? `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "name_kh",
                    "name": "name_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(name_kh, type, row) {
                        return name_kh ?? `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "menu_type",
                    "name": "menu_type",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(menu_type, type, row) {
                        return menu_type ?? `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "type",
                    "name": "type",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(type, type_1, row) {
                        return type ?? `<span class="text-body-tertiary">N/A</span>`;
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
                            <button type="submit" class="btn btn-sm btn-danger" onclick="deleteItem(${row.id}, '${row.name_en}')">
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

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('menu.get-data') }}",
                    type: 'GET',
                    data: function(d) {
                        d.draw = d.draw;
                        d.start = d.start;
                        d.length = d.length;
                        d.search = d.search;
                        d.order = [{
                            column: d.order[0].column,
                            dir: d.order[0].dir
                        }];
                    },
                    error: function(xhr, error, thrown) {
                        // Handle error if needed
                        console.log('ERR');
                    }
                },
                columns: cols,
            });
        }

        let getFormValue = (method = null) => {
            let name_en = $('#name_en').val();
            let name_kh = $('#name_kh').val();
            let menu_type = $('#menu_type').val();
            let type = $('#type').val();
            let url = $('#url').val();
            let ordering = $('#ordering').val();

            let formData = new FormData();
            formData.append('name_en', name_en);
            formData.append('name_kh', name_kh);
            formData.append('menu_type', menu_type);
            formData.append('type', type);
            formData.append('url', url);
            formData.append('ordering', ordering);

            if (method == 'patch') {
                formData.append("_method", 'PATCH');
            }

            return formData;
        }

        let clearValue = () => {
            $('#name_en').val('');
            $('#name_kh').val('');
            $('#menu_type').val('');
            $('#type').val('');
            $('#url').val('');
            $('#ordering').val('');
        }

        // Edit Item
        let edit = (id) => {
            editID = id;
            clearValue();
            $('#btnStoreItem').hide();
            $('#btnUpdateItem').show();
            $.ajax({
                url: "{{ url('admin/menu') }}/" + id + "/edit",
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
            $('#name_en').val(data.name_en);
            $('#name_kh').val(data.name_kh);
            $('#menu_type').val(data.menu_type);
            $('#type').val(data.type);
            $('#url').val(data.url);
            $('#ordering').val(data.ordering);
        }

        // Update Item
        let updateItem = () => {
            $.ajax({
                url: "{{ url('admin/menu') }}/" + editID,
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
                        getDataTable();
                    } else {
                        $('#pageLoading').hide();
                        console.log(response.result);
                        toastr.error(response.message);
                    }
                }
            });
        }

        $('#loadingIcon').hide();
        // Adding Blog
        let addItem = () => {
            clearValue();
            $('#btnStoreItem').show();
            $('#btnUpdateItem').hide();
        }
        let storeItem = () => {
            $.ajax({
                url: "{{ route('menu.store') }}",
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
                        getDataTable();
                    } else {
                        $('#pageLoading').hide();
                        toastr.error(response.message);
                    }
                }
            });
        }

        // Delete Item
        let deleteItem = (id, item) => {
            Swal.fire({
                title: "Are you sure?",
                text: `Do you want to delete item "${item}"?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/menu') }}/" + id,
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
                                getDataTable();
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
