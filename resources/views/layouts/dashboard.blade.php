@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="max-width: 100%;">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden"
                    style="background: hsl(215, 100%, 97%); border-top: 4px solid hsl(215, 100%, 48%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Products</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalStokeIn">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <i class="ri-box-3-fill text-primary" style="font-size: 2.5rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden"
                    style="background: hsl(157, 100%, 97%); border-top: 4px solid hsl(157, 100%, 37%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Categories</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalStokeOut">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <i class="ri-menu-search-fill text-success" style="font-size: 2.5rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden"
                    style="background: hsl(47, 100%, 97%); border-top: 4px solid hsl(47, 100%, 50%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Slides</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalExpiryAlert">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <i class="ri-slideshow-3-fill text-warning" style="font-size: 2.5rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflow-hidden"
                    style="background: hsl(345, 100%, 97%); border-top: 4px solid hsl(345, 100%, 53%) !important;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Blogs</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold" id="totalExpiry">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <i class="ri-article-fill text-danger" style="font-size: 2.5rem"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
