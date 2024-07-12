@extends('layouts.master')

@section('content')
<!-- Main content -->
<div class="content-wrapper">
<!-- Inner content -->
<div class="content-inner">
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Home
                </h4>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{ url('/'); }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="{{ url('/'); }}" class="breadcrumb-item">Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-inline-flex bg-dark bg-opacity-10 text-dark rounded-pill p-2 mb-3 mt-1">
                            <i class="ph-circles-four ph-2x m-1"></i>
                        </div>
                        <h6 class="card-title">Task Status</h6>
                        <h3><span class="badge bg-dark text-white">Pending - {{ $counts->pending; }}</span></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-inline-flex bg-danger bg-opacity-10 text-danger rounded-pill p-2 mb-3 mt-1">
                            <i class="ph-circles-four ph-2x m-1"></i>
                        </div>
                        <h6 class="card-title">Task Status</h6>
                        <h3><span class="badge bg-danger text-white">On Hold - {{ $counts->on_hold; }}</span></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-inline-flex bg-warning bg-opacity-10 text-warning rounded-pill p-2 mb-3 mt-1">
                            <i class="ph-circles-four ph-2x m-1"></i>
                        </div>
                        <h6 class="card-title">Task Status</h6>
                        <h3><span class="badge bg-warning text-white">In Progress - {{ $counts->in_progress; }}</span></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-inline-flex bg-info bg-opacity-10 text-info rounded-pill p-2 mb-3 mt-1">
                            <i class="ph-circles-four ph-2x m-1"></i>
                        </div>
                        <h6 class="card-title">Task Status</h6>
                        <h3><span class="badge bg-info text-white">To Review - {{ $counts->to_review; }}</span></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-inline-flex bg-purple bg-opacity-10 text-purple rounded-pill p-2 mb-3 mt-1">
                            <i class="ph-circles-four ph-2x m-1"></i>
                        </div>
                        <h6 class="card-title">Task Status</h6>
                        <h3><span class="badge bg-purple text-white">In Testing - {{ $counts->in_testing; }}</span></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="d-inline-flex bg-success bg-opacity-10 text-success rounded-pill p-2 mb-3 mt-1">
                            <i class="ph-circles-four ph-2x m-1"></i>
                        </div>
                        <h6 class="card-title">Task Status</h6>
                        <h3><span class="badge bg-success text-white">Completed - {{ $counts->completed; }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
    @include('layouts.footer')

</div>
<!-- /inner content -->

</div>
<!-- /main content -->
@endsection
