@extends('student.layout')

@section('content')
<h1>Counseling Report</h1>

<p><strong>Counselor:</strong> {{ $report->counselor->name }}</p>

<p>{{ $report->feedback }}</p>

<hr>

<h3>Your Feedback</h3>

<form method="POST" action="{{ route('student.feedback.store') }}">
    @csrf

    <textarea name="feedback" required></textarea>

    <input type="hidden" name="counselor_id" value="{{ $report->counselor_id }}">

    <button type="submit">Send Feedback</button>
</form>
@endsection
