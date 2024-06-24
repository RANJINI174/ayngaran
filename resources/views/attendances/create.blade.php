@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Record Attendance</h2>

        <form action="{{ route('attendances.create') }}" method="GET">
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

            <button type="submit" class="btn btn-primary">Filter Students</button>
        </form>

        @if($students->isNotEmpty())
            <form action="{{ route('attendances.store') }}" method="POST">
                @csrf

                <input type="hidden" name="course_id" value="{{ request('course_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <input type="hidden" name="attendances[{{ $loop->index }}][student_id]" value="{{ $student->id }}">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="attendance[{{ $loop->index }}][status]" id="present{{ $loop->index }}" value="1" checked>
                                        <label class="form-check-label" for="present{{ $loop->index }}">Present</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="attendance[{{ $loop->index }}][status]" id="absent{{ $loop->index }}" value="0">
                                        <label class="form-check-label" for="absent{{ $loop->index }}">Absent</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-success">Submit Attendance</button>
            </form>
        @endif
    </div>
@endsection
