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
                                <option value="1">Present</option>
                                <option value="0">Absent</option>
                            </select>
                            <div class="text-start text-danger status"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Add</button>
                            <!-- <a class="btn btn-light" data-bs-dismiss="modal">Close</a> -->
                            <a class="btn btn-light" onclick="Cancel_Attendance()">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Attendance --}}

    <div class="modal fade" id="Edit_Attendance_Model">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Attendance</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Edit_attendance_Form" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" id="attendance_id" name="attendance_id">
                            <select name="student_id" id="edit_student_id" class="form-control">
                                <option value="" disabled selected>Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger edit_student_id"></div>
                        </div>

                        <div class="form-group">
                            <select name="course_id" id="edit_course_id" class="form-control">
                                <option value="" disabled selected>Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger edit_course_id"></div>
                        </div>

                        <div class="form-group">
                            <input type="date" class="form-control" id="edit_date" name="date">
                            <div class="text-start text-danger edit_date"></div>
                        </div>

                        <div class="form-group">
                            <select name="status" id="edit_status" class="form-control form-select">
                                <option value="1">Present</option>
                                <option value="0">Absent</option>
                            </select>
                            <div class="text-start text-danger status"></div>
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
                    <h3 class="card-title mb-0">Attendances</h3>

                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                    href="#Add_AttendanceModel"><span><i class="fe fe-plus"></i></span> Add New</button>

                    {{-- <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                    href="#Add_AttendanceModel"><span><i class="fe fe-plus"></i></span> report</button> --}}
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
                    <div class="col-12">
                        <div class="form-group">
                            <label for="date">Select Date:</label>
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                        <button class="btn btn-primary" onclick="fetchAttendance()">Fetch Attendance</button>
                    </div>
                    <div class="table-responsive">
                        <table id="attendances_table_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                            <td>{{ $attendance->course->title }}</td>
                                            <td>{{ $attendance->date }}</td>
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
        $("#Add_attendanceForm").on("submit", function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '{{ route("attendances.store") }}',
            method: "POST",
            data: formData,
            success: function(res) {
                if (res.status) {
                    swal("Created!", res.message, "success");
                    // Refresh the table or update the DOM to reflect the new student
                    $('#Add_AttendanceModel').modal('hide');
                    $("#Add_attendanceForm")[0].reset();
                    location.reload(); // Reload the page to see the changes
                } else {
                    swal("Error!", res.message, "error");
                }
            },
            error: function(xhr) {
                var response = JSON.parse(xhr.responseText);
                var errors = response.errors;

                $.each(errors, function(key, value) {
                    $("." + key).html(value[0]);
                });

                swal("Error!", "There are errors in the form. Please fix them and try again.", "error");
            }
        });
    });
});


$("#Edit_attendance_Form").on("submit", function(event) {
        event.preventDefault();
        var id = $("#attendance_id").val();
        var formData = $(this).serialize();

        $.ajax({
            url: '{{ url('/') }}' + "/attendances/" + id,
            method: "PUT",
            data: formData,
            success: function(res) {
                if (res.status) {
                    swal("Updated!", res.message, "success");
                    $('#Edit_Attendance_Model').modal('hide');
                    $("#Edit_attendance_Form")[0].reset();
                    location.reload(); // Reload the page to see the changes
                } else {
                    swal("Error!", res.message, "error");
                }
            },
            error: function(xhr) {
                var response = JSON.parse(xhr.responseText);
                var errors = response.errors;

                $.each(errors, function(key, value) {
                    $("." + key).html(value[0]);
                });

                swal("Error!", "There are errors in the form. Please fix them and try again.", "error");
            }
        });
    });


//edit attendance
 function EditAttendanceModel(id) {
    $('#Edit_Attendance_Model').modal('show');

    $.ajax({
        url: '{{ url('/') }}' + "/attendances/" + id + "/edit",
        method: "GET",
        data: { id: id },
        contentType: false,
        processData: false,
        success: function(res) {
            $("#edit_student_id").val(res.data.student_id);
            $("#edit_course_id").val(res.data.course_id);
            $("#edit_date").val(res.data.date);
            $("#edit_status").val(res.data.status).trigger("change");
            $("#attendance_id").val(res.data.id);
        },

    });
}


 function deleteOrder(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Attendance?",
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
                        var redirect = $('meta[name="base_url"]').attr('content') + '/attendances';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: '{{ url('/') }}' + "/attendances/" + id + "/delete",
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
                                    swal("Deleted!", "Attendance has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("attendance Delete Failed", "Please try again. :)",
                                        "error");
                                }
                            }
                        });

                    } else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }

        function Cancel_Attendance() {
            $("#Add_AttendanceModel").modal("hide");
            $("#Add_attendanceForm")[0].reset();
            $(".err").html("");
        }

        function Cancel_edit_ledger() {
            $("#Edit_Attendance_Model").modal("hide");
            $(".err").html("");
        }
//fetch the attendance

    //     function fetchAttendance() {
    //     var selectedDate = document.getElementById('date').value;
    //     $.ajax({
    //         url: "{{ route('attendance.fetch') }}",
    //         type: "GET",
    //         data: {
    //             date: selectedDate
    //         },
    //         success: function(response) {
    //             var attendances = response.attendances;
    //             var html = '';
    //             attendances.forEach(function(attendance, index) {
    //                 html += '<tr>';
    //                 html += '<td>' + (index + 1) + '</td>';
    //                 html += '<td>' + attendance.student.name + '</td>';
    //                 html += '<td>' + attendance.course.name + '</td>';
    //                 html += '<td>' + attendance.date + '</td>';
    //                 html += '<td>' + attendance.status + '</td>';
    //                 html += '</tr>';
    //             });
    //             $('#attendanceBody').html(html);
    //         },
    //         error: function(xhr) {
    //             console.log(xhr.responseText);
    //         }
    //     });
    // }

    function fetchAttendance() {
        var date = document.getElementById('date').value;

        if (!date) {
            alert('Please select a date.');
            return;
        }

        $.ajax({
            url: '{{ route('attendance.fetch') }}',
            method: 'GET',
            data: {
                date: date
            },
            success: function(response) {
                var attendances = response.attendances;
                var tbody = '';

                if (attendances.length > 0) {
                    attendances.forEach(function(attendance, index) {
                        tbody += '<tr class="border-bottom">' +
                            '<td class="text-muted fs-12 fw-semibold text-center">' + (index + 1) + '</td>' +
                            '<td>' + attendance.student.name + '</td>' +
                            '<td>' + attendance.course.title + '</td>' +
                            '<td>' + attendance.date + '</td>' +
                            (attendance.status == 1 ?
                                '<td class="text-success fs-12 fw-semibold">Active</td>' :
                                '<td class="text-danger fs-12 fw-semibold">Inactive</td>') +
                            '<td>' +
                                '<button class="bg-primary border-0 me-1" data-bs-effect="effect-fall" ' +
                                    'data-bs-toggle="modal" onclick="return EditAttendanceModel(' + attendance.id + ')" ' +
                                    'style="border-radius: 5px;">' +
                                    '<i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 24 24" width="12">' +
                                        '<path d="M0 0h24v24H0V0z" fill="none" />' +
                                        '<path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />' +
                                    '</svg></i>' +
                                '</button>' +
                                '<button class="bg-danger border-0" data-bs-toggle="tooltip" data-bs-original-title="Delete" ' +
                                    'style="border-radius: 5px;" onclick="deleteOrder(' + attendance.id + ')">' +
                                    '<i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 24 24" width="12">' +
                                        '<path d="M0 0h24v24H0V0z" fill="none" />' +
                                        '<path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />' +
                                    '</svg></i>' +
                                '</button>' +
                            '</td>' +
                        '</tr>';
                    });
                } else {
                    tbody = '<tr><td colspan="6" class="text-center">No data found for the selected date.</td></tr>';
                }

                document.querySelector('#attendances_table_lists tbody').innerHTML = tbody;
            },
            error: function(error) {
                console.error('Error fetching attendance:', error);
                alert('An error occurred while fetching attendance.');
            }
        });
    }

    </script>
@endsection
