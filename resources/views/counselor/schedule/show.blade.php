<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Schedule Detail</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
body {
    margin:0;
    font-family:Poppins;
    background:linear-gradient(to bottom,#F4EDE5,#59121A);
    color:#59121A;
}
.container {
    padding:40px 60px;
    max-width:900px;
}
.card {
    background:#F6EFE8;
    border-radius:18px;
    border:2px solid #59121A;
    padding:28px;
    margin-bottom:24px;
}
.label {
    font-weight:600;
}
.value {
    margin-bottom:12px;
}

</style>
</head>

<body>

@include('counselor.partials.navbar')

<div class="container">

    <h1>Student Counseling Detail</h1>
    <p>Review student information and counseling request.</p>

    <div class="card">
        <h2>Student Information</h2>
        <div class="value"><span class="label">Name:</span> {{ $schedule->student->name }}</div>
        <div class="value"><span class="label">Email:</span> {{ $schedule->student->email }}</div>
        <div class="value"><span class="label">Phone:</span> {{ $schedule->student->phone ?? '-' }}</div>
    </div>

    <div class="card">
        <h2>Counseling Request</h2>
        <div class="value"><span class="label">Topic:</span> {{ $schedule->topic }}</div>
        <div class="value"><span class="label">Preferred Date:</span> {{ $schedule->preferred_date }}</div>
        <div class="value"><span class="label">Preferred Time:</span> {{ $schedule->preferred_time }}</div>
        <div class="value"><span class="label">Urgency:</span> {{ ucfirst($schedule->urgency) }}</div>
        <div class="value"><span class="label">Communication:</span> {{ ucfirst($schedule->communication) }}</div>
        <div class="value"><span class="label">Status:</span> {{ ucfirst($schedule->status) }}</div>
    </div>

    <div class="card">
        <h3>Student Feedback</h3>

        @if($schedule->feedback)
            <p>{{ $schedule->feedback->feedback }}</p>
            <small>
                Submitted at {{ $schedule->feedback->created_at->format('d M Y H:i') }}
            </small>
        @else
            <p>Student has not submitted feedback yet.</p>
        @endif
    </div>

</div>

</body>
</html>
