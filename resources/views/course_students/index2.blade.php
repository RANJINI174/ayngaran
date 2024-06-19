@extends('layouts.app')

@section('content')

    <!-- Add Course-Student Modal -->
    <div class="modal fade" id="Add_CourseStudent_Model">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Enroll Student in Course</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Add_courseStudent_Form" action="javascript:void(0);">
                        @csrf
                        <div class="form-group">
                            <select name="student_id" id="student_id" class="form-control">
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger student_id"></div>
                        </div>
                        <div class="form-group">
                            <select name="course_id" id="course_id" class="form-control">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger course_id"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary m-1">Enroll</button>
                            <a class="btn btn-light" onclick="Cancel_CourseStudent()">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Course-Student Modal -->
    <div class="modal fade" id="Edit_CourseStudent_Model">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Enrollment</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Edit_courseStudent_Form" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="course_student_id">
                        <div class="form-group">
                            <select name="edit_student_id" id="edit_student_id" class="form-control">
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger edit_student_id"></div>
                        </div>
                        <div class="form-group">
                            <select name="edit_course_id" id="edit_course_id" class="form-control">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            <div class="text-start text-danger edit_course_id"></div>
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

    <!-- Courses-Students Table -->
    <div class="row row-sm mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Course-Student Enrollments</h3>
                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                        href="#Add_CourseStudent_Model">
                        <span><i class="fe fe-plus"></i></span> Enroll Student
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="course_students_table_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Student Name</th>
                                    <th class="bg-transparent border-bottom-0">Course Title</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($course_students))
                                    @php $i = 1; @endphp
                                    @foreach ($course_students as $cs)
                                        <tr class="border-bottom">
                                            <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                            <td>{{ $cs->student->name }}</td>
                                            <td>{{ $cs->course->title }}</td>
                                            <td class="">
                                                <button class="bg-primary border-0 me-1" data-bs-effect="effect-fall"
                                                    data-bs-toggle="modal"
                                                    onclick="return EditCourseStudentModel({{ $cs->id }})"
                                                    style="border-radius: 5px;">
                                                    <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                        </svg></i>
                                                </button>
                                                <button class="bg-danger border-0" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Unenroll" style="border-radius: 5px;"
                                                    onclick="deleteCourseStudent('{{ $cs->id }}')">
                                                    <i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                        </svg></i>
                                                </button>
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
    $(document).ready(function () {
        $("#Add_courseStudent_Form").on("submit", function (event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("course_students.store") }}',
                method: "POST",
                data: formData,
                success: function (res) {
                    if (res.status) {
                        swal("Enrolled!", res.message, "success");
                        $('#Add_CourseStudent_Model').modal('hide');
                        $("#Add_courseStudent_Form")[0].reset();
                        location.reload();
                    } else {
                        swal("Error!", res.message, "error");
                    }
                },
                error: function (xhr) {
                    var response = JSON.parse(xhr.responseText);
                    var errors = response.errors;

                    $.each(errors, function (key, value) {
                        $("." + key).html(value[0]);
                    });

                    swal("Error!", "There are errors in the form. Please fix them and try again.", "error");
                }
            });
        });
    });

    $("#Edit_courseStudent_Form").on("submit", function (event) {
        event.preventDefault();
        var id = $("#course_student_id").val();
        var formData = $(this).serialize();

        $.ajax({
            url: '{{ url('/') }}' + "/course_students/" + id,
            method: "PUT",
            data: formData,
            success: function (res) {
                if (res.status) {
                    swal("Updated!", res.message, "success");
                    $('#Edit_CourseStudent_Model').modal('hide');
                    $("#Edit_courseStudent_Form")[0].reset();
                    location.reload();
                } else {
                    swal("Error!", res.message, "error");
                }
            },
            error: function (xhr) {
                var response = JSON.parse(xhr.responseText);
                var errors = response.errors;

                $.each(errors, function (key, value) {
                    $("." + key).html(value[0]);
                });

                swal("Error!", "There are errors in the form. Please fix them and try again.", "error");
            }
        });
    });

    function EditCourseStudentModel(id) {
        $('#Edit_CourseStudent_Model').modal('show');

        $.ajax({
            url: '{{ url('/') }}' + "/course_students/" + id + "/edit",
            method: "GET",
            data: { id: id },
            contentType: false,
            processData: false,
            success: function (res) {
                $("#edit_student_id").val(res.data.student_id).trigger("change");
                $("#edit_course_id").val(res.data.course_id).trigger("change");
                $("#course_student_id").val(res.data.id);
            },
        });
    }

    function deleteCourseStudent(id) {
        swal({
                title: "Are you sure?",
                text: "Confirm to unenroll this student from the course?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Unenroll",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    var redirect = $('meta[name="base_url"]').attr('content') + '/course_students';
                    var token = $('meta[name="csrf-token"]').attr("content");

                    $.ajax({
                        url: '{{ url('/') }}' + "/course_students/" + id,
                        method: 'DELETE',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function (res) {
                            if (res.status) {
                                swal("Unenrolled!", "Student has been unenrolled from the course.", "success");
                                window.location.href = redirect;
                            } else {
                                swal("Unenrollment Failed", "Please try again.", "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "Cancelled", "error");
                }
            });
    }

    function Cancel_CourseStudent() {
        $("#Add_CourseStudent_Model").modal("hide");
        $("#Add_courseStudent_Form")[0].reset();
        $(".err").html("");
    }
</script>
@endsection
