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
                    Home - <span class="fw-normal">Task Details</span>
                </h4>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{ url('/'); }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="{{ url('/'); }}" class="breadcrumb-item">Home</a>
                    <a href="{{ url('/tasks'); }}" class="breadcrumb-item">Tasks</a>
                    <span class="breadcrumb-item active">Task Details</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Content area -->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Task Details</h5>
            </div>

            <div class="card-body border-top">
                <form action="#">
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Title:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                <p>{{ $task->title }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Description:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                {!! $task->description  !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Priority:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                <p>{{ $task->priority }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Reporter:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                <p>{{ $task->firstname . ' ' . $task->lastname }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Status:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                <p>{{ $task->status }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Created At:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->created_at)->format('d M Y h:i A'); }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">Updated At:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext">
                                <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->updated_at)->format('d M Y h:i A'); }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ url('/tasks'); }}" class="btn btn-light"><i class="ph ph-arrow-left me-1"></i> Back To Tasks</a>
                    </div>
                </form>
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
