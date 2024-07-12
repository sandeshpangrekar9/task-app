@extends('layouts.master')

@section('content')
@include('editor.trumbowyg');
<!-- Main content -->
<div class="content-wrapper">
<!-- Inner content -->
<div class="content-inner">
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Home - <span class="fw-normal">Tasks</span>
                </h4>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{ url('/'); }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="{{ url('/'); }}" class="breadcrumb-item">Home</a>
                    <span class="breadcrumb-item active">Tasks</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Content area -->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <div class="fs-5">
                    Tasks List
                    <span class="float-end">
                        <button type="button" class="btn btn-dark" name="create-task-btn" id="create-task-btn"><i class="ph ph-plus-circle me-1"></i>Create</button>
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tasks-table" class="table table-bordered table-striped table-hover w-100" data-listing-url="{{ url('/tasks/list') }}" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th class="text-center">Priority</th>
                            <th>Reporter</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- start of createTaskModal -->
        <div class="modal" id="createTaskModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/tasks/store'); }}" name="form-create-task" id="form-create-task">
                        @csrf
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Create Task</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body modal-body-scrollable">
                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Title <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" id="fc_title" class="form-control" autocomplete="off">
                                    <div class="validation_message">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Description <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="fc_description" class="form-control fce_description" rows="6"></textarea>
                                    <div class="validation_message" id="fc_description_msg">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Priority <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select type="text" name="priority" id="fc_priority" class="form-control">
                                        <option selected="" disabled="" value="">Select Option</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                    <div class="validation_message">
                                        @error('priority')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Reporter <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select type="text" name="reporter_id" id="fc_reporter_id" class="form-control">
                                        <option selected="" disabled="" value="">Select Option</option>
                                        @if(!empty($reporters) && count($reporters))
		                                    @foreach($reporters as $reporter)
                                                <option value="{{ $reporter->id }}">{{ $reporter->firstname . ' ' . $reporter->lastname }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="validation_message">
                                        @error('reporter_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Status <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select type="text" name="status" id="fc_status" class="form-control">
                                        <option selected="" disabled="" value="">Select Option</option>
                                        <option value="Pending">Pending</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="To Review">To Review</option>
                                        <option value="In Testing">In Testing</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                    <div class="validation_message">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light me-2"><i class="ph ph-x me-1"></i>Close</button>
                            <button type="submit" id="submit-create-task" class="btn btn-dark"><i class="ph-check-circle me-1"></i>Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- end of createTaskModal -->

        <!-- start of editTaskModal -->
        <div class="modal" id="editTaskModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form method="POST" action="#" name="form-edit-task" id="form-edit-task">
                        @csrf
                        @method('PUT');
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Task</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body modal-body-scrollable">
                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Title <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" id="fe_title" class="form-control" autocomplete="off">
                                    <div class="validation_message">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Description <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="fe_description" class="form-control fce_description" rows="6"></textarea>
                                    <div class="validation_message" id="fe_description_msg">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Priority <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select type="text" name="priority" id="fe_priority" class="form-control">
                                        <option selected="" disabled="" value="">Select Option</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                    <div class="validation_message">
                                        @error('priority')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Reporter <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select type="text" name="reporter_id" id="fe_reporter_id" class="form-control">
                                        <option selected="" disabled="" value="">Select Option</option>
                                        @if(!empty($reporters) && count($reporters))
		                                    @foreach($reporters as $reporter)
                                                <option value="{{ $reporter->id }}">{{ $reporter->firstname . ' ' . $reporter->lastname }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="validation_message">
                                        @error('reporter_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-sm-3">Status <sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <select type="text" name="status" id="fe_status" class="form-control">
                                        <option selected="" disabled="" value="">Select Option</option>
                                        <option value="Pending">Pending</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="To Review">To Review</option>
                                        <option value="In Testing">In Testing</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                    <div class="validation_message">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light me-2"><i class="ph ph-x me-1"></i>Close</button>
                            <button type="submit" id="submit-edit-task" class="btn btn-dark"><i class="ph-check-circle me-1"></i>Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- end of editTaskModal -->

        <!-- start of deleteTaskModal -->
        <div class="modal" id="deleteTaskModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="#" name="form-delete-task" id="form-delete-task">
                        @csrf
                        @method('DELETE');

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Task</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body modal-body-scrollable">
                            <div class="mb-3">
                                Are you sure you want to delete this task?
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal"><i class="ph ph-x-circle me-1"></i>No</button>
                            <button type="submit" id="submit-delete-task" class="btn btn-dark"><i class="ph-check-circle me-1"></i>Yes</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- end of deleteTaskModal -->
    </div>
    <!-- /content area -->
    @include('layouts.footer')

</div>
<!-- /inner content -->

</div>
<!-- /main content -->
@endsection

@push('js_pre_content')

<script src="{{ asset('assets/base/js/vendor/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/pickers/datepicker.min.js') }}"></script>

@endpush

@push('js_post_content')

<script>
    
    $(document).ready(function () {

        var tasksTable = $('#tasks-table').DataTable({
            serverSide: true,
            processing: true,
            order: [[5, 'desc']],
            ajax: {
                url: $('#tasks-table').data('listing-url'),
                type: 'GET',
                dataType: 'json',
            },
            scrollX: false,
            fixedHeader: {
                header: true,
                footer: true
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            columns: [
                { 
                    data: 'title',
                    name: 'title'
                },
                { 
                    data: 'description',
                    name: 'description',
                    render: function (data, type, row) {
                        var html = `<div class="modal" id="moreModal_` + row.id + `">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">More..</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="more-modal-body">` + data + `</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>`;
                        html += `<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#moreModal_` + row.id + `" class="text-decoration-underline">Read Description</a>`;
                        return html;

                    }
                },
                { 
                    data: 'priority',
                    name: 'priority',
                    className: 'text-center',
                    render: function (data, type, row) {
                        return getPriority(data);
                    }
                },
                { 
                    data: 'users.firstname',
                    name: 'users.firstname',
                    render: function (data, type, row) {
                        return row.firstname + ' ' + row.lastname;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                    render: function (data, type, row) {
                        return getStatus(row.status);
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center',
                    width: '15%'
                },
                {
                    data: 'action',
                    className: 'text-center',
                    render: function (data, type, row) {
                        return `<div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph ph-list"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="/tasks/view/` + row.id + `" target="_blank" data-id="`+ row.id +`" data-action="/tasks/view/` + row.id + `" class="dropdown-item view-task-link">
                                                <i class="ph ph-eye me-2"></i>
                                                View
                                            </a>
                                            <a href="javascript:void(0);" data-id="`+ row.id +`" data-action="/tasks/update/` + row.id + `" class="dropdown-item edit-task-link">
                                                <i class="ph ph-pencil me-2"></i>
                                                Edit
                                            </a>
                                            <a href="javascript:void(0);" data-id="`+ row.id +`" data-action="/tasks/destroy/` + row.id + `" class="dropdown-item delete-task-link">
                                                <i class="ph ph-trash me-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>`;
                    },
                    orderable: false,
                    searchable: false
                },
            ],
        });

        $(document).on("click", "#create-task-btn", function(e) {
            resetCreateTaskForm();
            var createTaskModal = new bootstrap.Modal(document.getElementById('createTaskModal'))
            createTaskModal.show();
        });

        function resetCreateTaskForm() {

            $('#form-create-task').trigger("reset");
            $( "#fc_priority" ).val('').trigger('change');
            $( "#fc_status" ).val('').trigger('change');
            $("#form-create-task div[class=validation_message]").empty();

        }

        function validateCreateTaskForm() {

            var title = $("#fc_title").val();
            //var description = $("#fc_description").val();
            var description = $('#fc_description').trumbowyg('html');
            var priority = $("#fc_priority").val();
            var reporter_id = $("#fc_reporter_id").val();
            var status = $("#fc_status").val();
            var errors = 0;

            if(title == "" || title == null) {

                $("#fc_title")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else if(title.length > 100) {
                
                $("#fc_title")
                .siblings('.validation_message')
                .empty()
                .html(pError('You are allowed to enter upto 100 characters length only.'));
                errors++;

            } else {

                $("#fc_title")
                .siblings('.validation_message')
                .empty();

            }

            if(description == "" || description == null || description.length === 0) {

                $("#fc_description_msg")
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else if(description.length > 6000) {
                
                $("#fc_description_msg")
                .empty()
                .html(pError('You are allowed to enter upto 6000 characters length only.'));
                errors++;

            } else {

                $("#fc_description_msg")
                .empty();

            }

            if(priority == "" || priority == null) {

                $("#fc_priority")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else {

                $("#fc_priority")
                .siblings('.validation_message')
                .empty();

            }

            if(reporter_id == "" || reporter_id == null) {

                $("#fc_reporter_id")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else {

                $("#fc_reporter_id")
                .siblings('.validation_message')
                .empty();

            }

            if(status == "" || status == null) {

                $("#fc_status")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else {

                $("#fc_status")
                .siblings('.validation_message')
                .empty();

            }

            if(errors > 0) {

                return false;

            } else {

                return true;

            }

        }

        $(document).on("click", "#submit-create-task", function(e) {

            if(validateCreateTaskForm() === true) {

                $("#form-create-task").submit();

            } else {

                e.preventDefault();

            }

        });

        $(document).on("focus", "#form-create-task input", function(e) {
            $("#form-create-task input[name=" + e.target.name + "]")
            .siblings('.validation_message')
            .empty();
        });

        $(document).on("click", ".delete-task-link", function(e) {
            $('#form-delete-task').attr('action', $(this).data('action'));
            var deleteTaskModal = new bootstrap.Modal(document.getElementById('deleteTaskModal'))
            deleteTaskModal.show();
        });

        $(document).on("click", ".edit-task-link", function(e) {

            var id = $(this).data('id');
            $('#form-edit-task').attr('action', $(this).data('action'));

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : "{{ url('/tasks/get-task') }}",
                data : { id : id },
                type : 'POST',
                dataType : 'json',
                success : function(data, textStatus, xhr) {

                    if(textStatus == "success") {

                        if(data.data) {
                            resetEditTaskForm();
                            $("#fe_title").val(data.data.title);
                            //$("#fe_description").val(data.data.description);
                            $('#fe_description').trumbowyg('html', data.data.description);
                            $("#fe_priority").val(data.data.priority);
                            $("#fe_reporter_id").val(data.data.reporter_id);
                            $("#fe_status").val(data.data.status);
                            var editTaskModal = new bootstrap.Modal(document.getElementById('editTaskModal'))
                            editTaskModal.show();
                        } else {

                            notify('No data found!', 'error');

                        }

                    } else {

                        notify('Something went wrong!', 'error');

                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {

                    notify('Something went wrong!', 'error');

                }

            });

        });


        function validateEditTaskForm() {

            var title = $("#fe_title").val();
            //var description = $("#fe_description").val();
            var description = $('#fe_description').trumbowyg('html');
            var priority = $("#fe_priority").val();
            var reporter_id = $("#fe_reporter_id").val();
            var status = $("#fe_status").val();
            var errors = 0;

            if(title == "" || title == null) {

                $("#fe_title")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else if(title.length > 100) {
                
                $("#fe_title")
                .siblings('.validation_message')
                .empty()
                .html(pError('You are allowed to enter upto 100 characters length only.'));
                errors++;

            } else {

                $("#fe_title")
                .siblings('.validation_message')
                .empty();

            }

            if(description == "" || description == null || description.length === 0) {

                $("#fe_description_msg")
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else if(description.length > 6000) {
                
                $("#fe_description_msg")
                .empty()
                .html(pError('You are allowed to enter upto 6000 characters length only.'));
                errors++;

            } else {

                $("#fe_description_msg")
                .empty();

            }

            if(priority == "" || priority == null) {

                $("#fe_priority")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else {

                $("#fe_priority")
                .siblings('.validation_message')
                .empty();

            }

            if(reporter_id == "" || reporter_id == null) {

                $("#fe_reporter_id")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else {

                $("#fe_reporter_id")
                .siblings('.validation_message')
                .empty();

            }

            if(status == "" || status == null) {

                $("#fe_status")
                .siblings('.validation_message')
                .empty()
                .html(pError('This field is required.'));
                errors++;

            } else {

                $("#fe_status")
                .siblings('.validation_message')
                .empty();

            }

            if(errors > 0) {

                return false;

            } else {

                return true;

            }

        }

        $(document).on("click", "#submit-edit-task", function(e) {

            if(validateEditTaskForm() === true) {

                $("#form-edit-task").submit();

            } else {

                e.preventDefault();

            }

        });

        function resetEditTaskForm() {

            $('#form-edit-task').trigger("reset");
            $("#form-edit-task div[class=validation_message]").empty();

        }

    });

    function getStatus(status) {

        switch (status) {
            case 'Pending':
                text = '<span class="badge bg-dark text-white">Pending</span>';
                break;
            case 'On Hold':
                text = '<span class="badge bg-danger text-white">On Hold</span>';
                break;
            case 'In Progress':
                text = '<span class="badge bg-warning text-white">In Progress</span>';
                break;
            case 'To Review':
                text = '<span class="badge bg-info text-white">To Review</span>';
                break;
            case 'In Testing':
                text = '<span class="badge bg-purple text-white">In Testing</span>';
                break;
            case 'Completed':
                text = '<span class="badge bg-success text-white">Completed</span>';
                break;
            default:
                text = "-";
        }

        return text;

    }

    function getPriority(priority) {

        switch (priority) {
            case 'High':
                textPriority = '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-danger">' + priority + '</span>';
                break;
            case 'Medium':
                textPriority = '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-primary">' + priority + '</span>';
                break;
            case 'Low':
                textPriority = '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-info">' + priority + '</span>';
                break;
            default:
                textPriority = "-";
        }

        return textPriority;

    }
</script>

@endpush
