@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attendance Reports</h1>
    <div class="list-group">
        @foreach($courses as $course)
            <a href="{{ route('attendances.report.course', $course->id) }}" class="list-group-item list-group-item-action">
                {{ $course->title }}
            </a>
        @endforeach
    </div>
</div>
@endsection
