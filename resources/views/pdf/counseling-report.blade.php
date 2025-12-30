<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Counseling Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 18px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 6px;
        }
        .row {
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<table width="100%" style="margin-bottom:20px;">
    <tr>
        <td width="80">
            <img src="{{ public_path('assets/intro/TMCrb.png') }}" width="70">
        </td>
        <td>
            <strong style="font-size:16px;">TelU Mental Care</strong><br>
            <span style="font-size:12px;">
                Counseling Report
            </span>
        </td>
    </tr>
</table>

<hr>

<div class="section">
    <div class="section-title">Student Information</div>
    <div class="row">Name: {{ $student->name }}</div>
    <div class="row">Email: {{ $student->email }}</div>
</div>

<div class="section">
    <div class="section-title">Counselor</div>
    <div class="row">{{ $counselor->name }}</div>
</div>

<div class="section">
    <div class="section-title">Stress Assessment History</div>
    @forelse($student->stressAssessments as $stress)
        <div class="row">
            {{ $stress->created_at->format('d M Y') }}
            — {{ $stress->stress_score }}/25 ({{ $stress->stress_level }})
        </div>
    @empty
        <div class="row">No data</div>
    @endforelse
</div>

<div class="section">
    <div class="section-title">Mood Records</div>
    @forelse($student->moodRecords as $mood)
        <div class="row">
            {{ $mood->created_at->format('d M Y') }}
            — Mood Level {{ $mood->mood_level }}
        </div>
    @empty
        <div class="row">No data</div>
    @endforelse
</div>

<div class="section">
    <div class="section-title">Counselor Notes</div>
    @forelse($student->counselorNotes as $note)
        <div class="row">
            {{ $note->created_at->format('d M Y H:i') }}
        </div>
        <div class="row">{{ $note->note }}</div>
        <br>
    @empty
        <div class="row">No notes</div>
    @endforelse
</div>

<br><br>
<div>Signed by,</div>
<div>{{ $counselor->name }}</div>

</body>
</html>
