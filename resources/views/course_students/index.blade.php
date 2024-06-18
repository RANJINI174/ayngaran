@extends('layouts.app')

@section('content')

    <!-- Add Course Modal -->
    <div class="modal fade" id="Add_Course_Model">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Course</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Add_course_Form" action="javascript:void(0);">
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
                            <button class="btn btn-primary m-1">Add</button>
                            <a class="btn btn-light" onclick="Cancel_Course()">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="row row-sm mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Courses</h3>
                    <button class="add_master_btn" data-bs-effect="effect-fall" data-bs-toggle="modal"
                        href="#Add_Course_Model">
                        <span><i class="fe fe-plus"></i></span> Add New
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="courses_table_lists" class="table table-bordered text-nowrap mb-0">
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
                                            <td>
                                                <button class="bg-danger border-0"
                                                    onclick="deleteCourseStudent('{{ $cs->id }}')"
                                                    style="border-radius: 5px;">
                                                    <i>
                                                        <svg class="table-delete" xmlns="http://www.w3.org/2000/svg"
                                                            height="16" viewBox="0 0 24 24" width="12">
                                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                                            <path
                                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                                        </svg>
                                                    </i>
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
        $("#Add_course_Form").on("submit", function (event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("course_students.store") }}',
                method: "POST",
                data: formData,
                success: function (res) {
                    if (res.status) {
                        swal("Created!", res.message, "success");
                        // Refresh the table or update the DOM to reflect the new course_student
                        $('#Add_Course_Model').modal('hide');
                        $("#Add_course_Form")[0].reset();
                        location.reload(); // Reload the page to see the changes
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

    function deleteCourseStudent(id) {
        swal({
            title: "Are you sure?",
            text: "Confirm to delete this Course Student relationship?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                var redirect = $('meta[name="base_url"]').attr('content') + '/course_students';
                var token = $('meta[name="csrf-token"]').attr("content");
                var formData = new FormData();
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("id", id);
                $.ajax({
                    url: '{{ url('/') }}' + "/course_students/" + id + "/delete",
                    data: formData,
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token
                        id: id
                    },
                    type: 'DELETE',
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (res) {
                        if (res) {
                            swal("Deleted!", "Course Student relationship has been deleted.",
                                "success");
                            window.location.href = redirect;

                        } else {
                            swal("Course Student Delete Failed", "Please try again. :)",
                                "error");
                        }
                    }
                });

            } else {
                swal("Cancelled", "Cancelled", "error");
            }
        });
    }

    function Cancel_Course() {
        $("#Add_Course_Model").modal("hide");
        $("#Add_course_Form")[0].reset();
        $(".err").html("");
    }
</script>
@endsection
