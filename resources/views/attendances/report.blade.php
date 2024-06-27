{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Attendance Report</h2>

        @if($attendances->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->student->name }}</td>
                            <td>{{ $attendance->student->courses->pluck('title')->join(', ') }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td class="{{ $attendance->status == 1 ? 'text-success' : 'text-danger' }}">
                                {{ $attendance->status == 1 ? 'Present' : 'Absent' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No attendance records found for the selected course and date.</p>
        @endif

        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Back to Attendance</a>
    </div>
@endsection --}}

 @extends('layouts.app')
@section('content')
<div class="row row-sm mt-2">
    <div class="col-12 col-sm-12">
        <div class="card ">
            <div class="card-header  d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">Attendances Report</h3>

                {{-- <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                href="#Add_AttendanceModel"><span><i class="fe fe-plus"></i></span> Add New</button> --}}

            </div>
            <div class="card-body">
                {{-- <form action="{{ route('attendances.index') }}" method="GET"> --}}
                    <form action="{{ route('attendances.report') }}" method="GET">
                    <div class="form-group">
                        <label for="course_id">Select Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="" disabled selected>Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Select Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}" required>
                    </div>

                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    {{-- <button type="submit" class="btn btn-primary">Generate Report</button> --}}
                </form>
                <div class="mt-4">
                    <h4>Total Students: {{ $totalStudents }}</h4>
                </div>
                @if ($attendances->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No students are there for the selected date.
                </div>
                @else
                <div class="table-responsive">
                    <table id="attendances_table_lists" class="table table-bordered text-nowrap mb-0">
                        <thead class="border-top">
                            <tr>
                                <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                <th class="bg-transparent border-bottom-0">Student</th>
                                <th class="bg-transparent border-bottom-0">Course</th>
                                <th class="bg-transparent border-bottom-0">Date</th>
                                <th class="bg-transparent border-bottom-0">Status</th>
                                {{-- <th class="bg-transparent border-bottom-0">Action</th> --}}
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
                                        {{-- @if ($attendance->status == 1)
                                            <td class="text-success fs-12 fw-semibold">present</td>
                                        @else
                                            <td class="text-danger fs-12 fw-semibold">obsent</td>
                                        @endif --}}
                                        <td>
                                            <input type="radio" name="status_{{ $attendance->id }}" value="1" id="present_{{ $attendance->id }}" {{ $attendance->status == 1 ? 'checked' : '' }}>
                                            <label for="present_{{ $attendance->id }}" class="text-success fs-12 fw-semibold">present
                                                {{-- <i class="fa fa-check-circle"></i> present --}}
                                            </label>

                                            <input type="radio" name="status_{{ $attendance->id }}" value="0" id="absent_{{ $attendance->id }}" {{ $attendance->status == 0 ? 'checked' : '' }}>
                                            <label for="absent_{{ $attendance->id }}" class="text-danger fs-12 fw-semibold">absent
                                                {{-- <i class="fas fa-times-circle"></i> --}}
                                            </label>
                                        </td>
                                        {{-- <td class="">

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
                                            {{-- <button class="bg-danger border-0" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete" style="border-radius: 5px;"
                                                onclick="deleteOrder('{{ $attendance->id }}')"><i><svg
                                                        class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                        height="16" viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                    </svg></i></button> --}}
                                        {{-- @endif --}}
                                        {{-- </td> --}}

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
                @endif
            </div>
        </div>
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Back to Attendance</a>
    </div><!-- COL END -->
</div><!-- ROW-5 END -->
@endsection



@section('scripts')
<script>

$(document).ready(function() {
    $('#generateReportButton').on('click', function() {
        var courseId = $('#course_id').val();
        var date = $('#date').val();

        $.ajax({
            url: '{{ route("attendances.report") }}',
            method: 'GET',
            data: { course_id: courseId, date: date },
            success: function(response) {
                $('#reportContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function() {
    $('input[type=radio][name^=status_]').change(function() {
        var attendanceId = $(this).attr('name').split('_')[1];
        var status = $(this).val();

        // AJAX request to update the status
        $.ajax({
            url: '{{ route("attendances.updateStatus") }}', // Replace with your route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: attendanceId,
                status: status
            },
            success: function(response) {
                console.log(response); // Handle the success response
            },
            error: function(xhr, status, error) {
                console.error(error); // Handle the error response
            }
        });
    });
});
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
    </script>
@endsection
