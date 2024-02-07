@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="max-width: 100%;">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden" style="background: hsl(215, 100%, 97%); border-top: 4px solid hsl(215, 100%, 48%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Monthly Stock In</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalStokeIn">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" style="max-width: 48px; height: auto; fill: hsl(215, 100%, 48%);" data-name="Layer 1" viewBox="0 0 24 24">
                                    <path d="m16,8h-2V3h2v5Zm7-1v5c0,2.206-1.794,4-4,4h-8c-2.206,0-4-1.794-4-4v-5c0-2.206,1.794-4,4-4h1v5c0,1.103.897,2,2,2h2c1.103,0,2-.897,2-2V3h1c2.206,0,4,1.794,4,4Zm0,11h-15c-1.654,0-3-1.346-3-3V4C5,1.794,3.206,0,1,0,.448,0,0,.447,0,1s.448,1,1,1c1.103,0,2,.897,2,2v11c0,2.045,1.237,3.802,3,4.576v1.424c0,1.654,1.346,3,3,3s3-1.346,3-3v-1h5v1c0,1.654,1.346,3,3,3s3-1.346,3-3v-1c.552,0,1-.447,1-1s-.448-1-1-1Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden" style="background: hsl(157, 100%, 97%); border-top: 4px solid hsl(157, 100%, 37%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Monthly Stock Out</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalStokeOut">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" style="max-width: 48px; height: auto; fill: hsl(157, 100%, 37%);" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                    <path d="M20.474,17a3.541,3.541,0,0,0-.475.032V5a3,3,0,0,1,3-3,1,1,0,0,0,0-2,5.006,5.006,0,0,0-5,5V16.279l-2.734.912a3,3,0,0,0-.156-1l-1.553-5.1A3.007,3.007,0,0,0,9.788,9.142l-6.7,2.13A3.013,3.013,0,0,0,1.129,15l1.634,5.373a2.966,2.966,0,0,0,.457.831l-2.536.845a1,1,0,0,0,.632,1.9l16.267-5.422A3.5,3.5,0,1,0,20.474,17ZM8.888,13.65l-2.465.784a1,1,0,0,1-.606-1.906l2.465-.784a1,1,0,1,1,.606,1.906Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden" style="background: hsl(47, 100%, 97%); border-top: 4px solid hsl(47, 100%, 50%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Expiry Alert</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalExpiryAlert">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <svg id="Layer_1" viewBox="0 0 24 24" style="max-width: 48px; height: auto; fill: hsl(47, 100%, 50%);" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1">
                                    <path d="m16.551 12a12.556 12.556 0 0 0 4.406-7.449 3.943 3.943 0 0 0 -.918-3.151 4.017 4.017 0 0 0 -3.039-1.4h-9.995a4.014 4.014 0 0 0 -3.044 1.4 3.94 3.94 0 0 0 -.917 3.158 12.522 12.522 0 0 0 4.401 7.442 12.522 12.522 0 0 0 -4.4 7.444 3.94 3.94 0 0 0 .916 3.156 4.014 4.014 0 0 0 3.044 1.4h9.995a4.017 4.017 0 0 0 3.044-1.4 3.944 3.944 0 0 0 .918-3.156 12.557 12.557 0 0 0 -4.411-7.444zm1.277 8.559a1 1 0 0 1 -.828.441h-10a1 1 0 0 1 -.928-1.374 14.856 14.856 0 0 1 4.6-5.656l.7-.559a1 1 0 0 1 1.245 0l.69.551a15.013 15.013 0 0 1 4.61 5.662 1 1 0 0 1 -.089.935zm-2.479-1.559h-6.7a14.962 14.962 0 0 1 3.271-3.462l.08-.066.071.055a15.3 15.3 0 0 1 3.278 3.473z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden" style="background: hsl(345, 100%, 97%); border-top: 4px solid hsl(345, 100%, 53%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Product Expiry</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalExpiry">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" style="max-width: 48px; height: auto; fill: hsl(345, 100%, 53%);" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                    <path d="M23.843,22.248l-6.855-11.67c-.441-.771-1.533-.771-1.974,0l-6.855,11.67c-.444,.777,.105,1.752,.987,1.752h13.711c.882,0,1.432-.976,.987-1.752Zm-7.843-.248c-.552,0-1-.448-1-1s.448-1,1-1,1,.448,1,1-.448,1-1,1Zm1-4c0,.552-.447,1-1,1s-1-.448-1-1v-3c0-.552,.447-1,1-1s1,.448,1,1v3Zm-10.579,3.254l6.867-11.689c.549-.958,1.592-1.565,2.712-1.565s2.163,.607,2.723,1.584l5.277,8.982V5c0-2.757-2.243-5-5-5H5C2.243,0,0,2.243,0,5v14c0,2.757,2.243,5,5,5h1.252c-.352-.891-.314-1.901,.169-2.746ZM8,3c.552,0,1,.448,1,1s-.448,1-1,1-1-.448-1-1,.448-1,1-1Zm-4,2c-.552,0-1-.448-1-1s.448-1,1-1,1,.448,1,1-.448,1-1,1Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header border d-flex align-item-center">
                        <h4 class="mb-0">Product Expiry Alert List</h4>
                        <div class="ms-auto"></div>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Id</th>
                                <th>Name (English)</th>
                                <th>Name (Khmer)</th>
                                <th>Category Id</th>
                                <th>Price</th>
                                <th>Info (English)</th>
                                <th>Info (Khmer)</th>
                                <th>Description (English)</th>
                                <th>Description (Khmer)</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Id</th>
                                <th>Name (English)</th>
                                <th>Name (Khmer)</th>
                                <th>Category Id</th>
                                <th>Price</th>
                                <th>Info (English)</th>
                                <th>Info (Khmer)</th>
                                <th>Description (English)</th>
                                <th>Description (Khmer)</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            getData();
            getMonthlyStock();
        });

        // Get Data Backend
        let getData = () => {
            $.ajax({
                url: "{{ route('dash-board.getProductExpire') }}",
                type: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $('#pageLoading').show();
                },
                success: function(response){
                    $('#pageLoading').hide();
                    getDataTable(response.result);
                },
                error: function(xhr,status,error) {
                    console.log(error);
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }

        let changeCurrency = (value, currency) => {
            if (currency == "USD" || currency == "usd" || currency == "Usd")
                return parseFloat(value).toLocaleString('en-US', {style: 'currency', currency: 'USD', minimumFractionDigits: 2});
            else if (currency == "KHR" || currency == "khr" || currency == "Khr")
                return parseFloat(value).toLocaleString('en-KH', {style: 'currency', currency: 'KHR', minimumFractionDigits: 0}).replace('KHR', '') + '៛';
        }

        // Data Table
        let getDataTable = (data) => {
            let cols = [
                {
                    "data": "id",
                    "name": "id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true
                },
                {
                    "data": "name_en",
                    "name": "name_en",
                    "searchable": false,
                    "orderable": false,
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
                    "data": "category_id",
                    "name": "category_id",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(category_id, type, row) {
                        return category_id ? category_id : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "price",
                    "name": "price",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(price, type, row) {
                        return price ? price : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "short_info_en",
                    "name": "short_info_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(short_info_en, type, row) {
                        return short_info_en ? short_info_en : `<span class="text-body-tertiary">N/A</span>`;
                    }

                },
                {
                    "data": "short_info_kh",
                    "name": "short_info_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(short_info_kh, type, row) {
                        return short_info_kh ? short_info_kh : `<span class="text-body-tertiary">N/A</span>`;
                    }

                },
                {
                    "data": "description_en",
                    "name": "description_en",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(description_en, type, row) {
                        return description_en ? description_en : `<span class="text-body-tertiary">N/A</span>`;
                    }
                },
                {
                    "data": "description_kh",
                    "name": "description_kh",
                    "searchable": true,
                    "orderable": true,
                    "visible": true,
                    render: function(description_kh, type, row) {
                        return description_kh ? description_kh : `<span class="text-body-tertiary">N/A</span>`;
                    }
                }
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

        // Get Monthly Stock
        let getMonthlyStock = () => {
            $.ajax({
                url: "{{ route('dash-board.get-monthly-stock') }}",
                type: "GET",
                dataType: 'json',
                success: function(response){
                    console.log(response.result);
                    $('#totalStokeIn').text(response.result.in_current_month);
                    $('#totalStokeOut').text(response.result.out_current_month);
                    $('#totalExpiryAlert').text(response.result.alert_ext_current_month);
                    $('#totalExpiry').text(response.result.expiry_current_month);
                },
                error: function(xhr,status,error) {
                    console.log(error);
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    </script>
@endsection
