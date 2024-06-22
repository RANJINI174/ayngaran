@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attendance Report for {{ $course->title }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Is Present?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($course->attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->student->name }}</td>
                    <td>{{ $attendance->is_present ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
