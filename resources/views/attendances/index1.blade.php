@extends('layouts.app')
@section('content')
    <div class="modal fade" id="Add_AttendanceModel">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Attendance</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                  </div>
                <div class="modal-body">
                    {{-- <form id="Add_supplierForm" autocomplete="off"> --}}
                    <form id="Add_attendanceForm" action="{{ route('attendances.store') }}" method="POST">
                        @csrf
                        {{-- @method('POST') --}}
                        <div class="form-group">
                            <select name="student_id" id="student_id" class="form-control">
                                <option value="" disabled selected>Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger student_id"></div>
                        </div>

                        <div class="form-group">
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="" disabled selected>Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger course_id"></div>
                        </div>

                        <div class="form-group">
                            <input type="date" class="form-control" id="date" name="date">
                            <div class="text-start text-danger date"></div>
                        </div>
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="text-start text-danger status"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Add</button>
                            <!-- <a class="btn btn-light" data-bs-dismiss="modal">Close</a> -->
                            <a class="btn btn-light" onclick="Cancel_Student()">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Student --}}

    <div class="modal fade" id="Edit_Student_Model">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Student</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                     <form id="Edit_student_Form" autocomplete="off">
                        {{-- <form id="Edit_Supplier_form" action="{{ url('suppliers/update') }}" method="POST"> --}}
                         @csrf
                         @method('PUT')
                        <div class="form-group">
                            <input type="hidden" id="student_id">
                            <input type="text" class="form-control" id="edit_name"  name="edit_name"
                                placeholder="Name">
                            <div class="text-start text-danger edit_name"></div>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" id="edit_email" name="edit_email"
                                placeholder="Email">
                            <div class="text-start text-danger edit_email"></div>
                        </div>

                        <div class="form-group">
                            <select name="edit_status" id="edit_status" class="form-control form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="text-start text-danger edit_status"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Update</button>
                            <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ROW-5 -->
    <div class="row row-sm mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header  d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Attendance</h3>
                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                    href="#Add_AttendanceModel"><span><i class="fe fe-plus"></i></span> Add New</button>
                    {{-- @php
                        $permission = new \App\Models\Permission();
                        $create_check = $permission->checkPermission('vehicles.create');
                    @endphp
                    @if ($create_check == 1)
                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                        href="#Add_SupplierModel"><span>
                            <i class="fe fe-plus"></i>
                        </span> Add New</button>
                    @endif --}}

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="attendances_table_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Student</th>
                                    <th class="bg-transparent border-bottom-0">Course</th>
                                    <th class="bg-transparent border-bottom-0">Date</th>
                                    <th class="bg-transparent border-bottom-0">Status</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($attendances))
                                    @php $i = 1; @endphp
                                    @foreach ($attendances as $attendance)
                                        <tr class="border-bottom">
                                            <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}
                                            </td>
                                            <td>{{ $attendance->student->name }}</td>
                                            <td> {{ $attendance->course->title }} </td>
                                            <td> {{ $attendance->date }} </td>
                                            @if ($attendance->status == 1)
                                                <td class="text-success fs-12 fw-semibold">Active</td>
                                            @else
                                                <td class="text-danger fs-12 fw-semibold">Inactive</td>
                                            @endif
                                            <td class="">
                                             {{-- @php
                                                $permission = new \App\Models\Permission();
                                                $edit_check = $permission->checkPermission('suppliers.edit');
                                            @endphp
                                            @if($edit_check == 1) --}}
                                                <button class="bg-primary border-0 me-1" data-bs-effect="effect-fall"
                                                    data-bs-toggle="modal"
                                                    onclick="return EditAttendanceModel({{ $attendance->id }})"
                                                    style="border-radius: 5px;">

                                                    <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                        </svg></i>
                                                </button>
                                            {{-- @endif --}}

                                            {{-- @php
                                                $permission = new \App\Models\Permission();
                                                $delete_check = $permission->checkPermission('suppliers.delete');
                                            @endphp
                                            @if($delete_check == 1) --}}
                                                <button class="bg-danger border-0" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete" style="border-radius: 5px;"
                                                    onclick="deleteOrder('{{ $attendance->id }}')"><i><svg
                                                            class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                        </svg></i></button>
                                            {{-- @endif --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div><!-- ROW-5 END -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#attendaces_table_lists').DataTable();
            $("#status").select2({
                width: "100%",
            });
            $("#edit_status").select2({
                width: "100%",
            });
        });
        $('#Add_attendanceForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status) {
                            alert('Attendance added successfully!');
                            // Optionally, reload the table or page to show the new data
                            table.ajax.reload(); // Reload the DataTable
                        } else {
                            alert('Failed to add Attendance!');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                    }
                });
            });

        // edit Student

        function EditStudentModel(id) {

            $('#Edit_Student_Model').modal('show');

            $.ajax({
                url: '{{ url('/') }}' + "/students/" + id + "/edit",
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {

                    $("#edit_name").val(res.data.name);
                    $("#edit_email").val(res.data.email);
                    $("#edit_status").val(res.data.status).trigger("change");
                    $("#student_id").val(res.data.id);
                },
            });
        }

 // update student

$('#Edit_student_Form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ url('students') }}/' + $("#student_id").val(),
        method: 'PUT',
        data: $(this).serialize(),
        success: function(response) {
            if (response.status) {
                alert('Student updated successfully!');
                $('#Edit_Student_Model').modal('hide');
                // Optionally, reload the table or update UI as needed
                table.ajax.reload(); // Reload the DataTable
            } else {
                alert('Failed to update student!');
            }
        },
        error: function(xhr) {
            alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
});

 function deleteOrder(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Student?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var redirect = $('meta[name="base_url"]').attr('content') + '/students';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: '{{ url('/') }}' + "/students/" + id + "/delete",
                            data: formData,
                            data: {
                    _token: "{{ csrf_token() }}", // Include CSRF token
                    id: id
                },
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Student has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Student Delete Failed", "Please try again. :)",
                                        "error");
                                }
                            }
                        });

                    } else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }

        function Cancel_Student() {
            $("#Add_StudentModel").modal("hide");
            $("#Add_studentForm")[0].reset();
            $(".err").html("");
        }

        function Cancel_edit_ledger() {
            $("#Edit_Student_Model").modal("hide");
            $(".err").html("");
        }
    </script>
@endsection
