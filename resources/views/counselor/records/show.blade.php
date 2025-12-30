<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Detail – TelU Mental Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #59121A;
    --soft-bg: #F6EFE8;
    --page-bg: linear-gradient(to bottom, #F4EDE5, #B98A8A);
}

* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: var(--page-bg);
    color: #3A0D12;
}

.container {
    padding: 40px 60px 80px;
    max-width: 1100px;
    margin: auto;
}

h1, h2 {
    color: var(--primary);
}

.section {
    background: var(--soft-bg);
    border-radius: 18px;
    border: 2px solid var(--primary);
    padding: 26px 30px;
    margin-bottom: 28px;
}

.btn {
    background: var(--primary);
    color: white;
    padding: 10px 22px;
    border-radius: 999px;
    border: none;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
}

textarea {
    width: 100%;
    min-height: 140px;
    border-radius: 12px;
    border: 1.5px solid #ccc;
    padding: 14px;
    font-family: 'Poppins';
    font-size: 14px;
}
</style>
</head>

<body>

@include('counselor.partials.navbar')

<div class="container">

    {{-- HEADER --}}
    <h1>{{ $student->name }}</h1>
    <p>Student Mental Health Record</p>

    {{-- ================= STRESS HISTORY ================= --}}
    <div class="section">
        <h2>Stress Assessment History</h2>

        @forelse($student->stressAssessments as $stress)
            <p>
                {{ $stress->created_at->format('d M Y') }} —
                <strong>{{ $stress->stress_score }}/25</strong>
            </p>
        @empty
            <p>No stress assessment data.</p>
        @endforelse
    </div>

    {{-- ================= MOOD HISTORY ================= --}}
    <div class="section">
        <h2>Mood Records</h2>

        @forelse($student->moodRecords as $mood)
            <p>
                {{ $mood->created_at->format('d M Y') }} —
                Mood Level {{ $mood->mood_level }}
            </p>
        @empty
            <p>No mood record data.</p>
        @endforelse
    </div>

    {{-- ================= COUNSELING FEEDBACK ================= --}}
    <div class="section">
        <h2>Counseling Feedback</h2>
        <p style="font-size:13px;color:#555;">
            Official feedback provided by the counselor for the student.
        </p>

        @php
            $latestNote = $student->counselorNotes->first();
        @endphp

        {{-- ===== JIKA SUDAH ADA FEEDBACK ===== --}}
        @if($latestNote)

            <small>{{ $latestNote->created_at->format('d M Y H:i') }}</small>

            {{-- TEXT VIEW --}}
            <p id="feedback-text" style="margin-top:12px; line-height:1.6;">
                {{ $latestNote->note }}
            </p>

            <button
                class="btn"
                style="padding:6px 18px;font-size:12px;"
                onclick="toggleEditFeedback()"
            >
                Edit
            </button>

            {{-- EDIT FORM (HIDDEN) --}}
            <form
                method="POST"
                action="{{ route('counselor.records.notes.update', [$student->id, $latestNote->id]) }}"
                id="edit-feedback-form"
                style="display:none; margin-top:16px;"
            >
                @csrf
                @method('PUT')

                <textarea name="note" required>{{ $latestNote->note }}</textarea>

                <button class="btn" style="margin-top:10px;">
                    Update Feedback
                </button>
            </form>

        {{-- ===== JIKA BELUM ADA FEEDBACK ===== --}}
        @else
            <form
                method="POST"
                action="{{ route('counselor.records.notes.store', $student->id) }}"
                style="margin-top:12px;"
            >
                @csrf

                <textarea
                    name="note"
                    placeholder="Write counseling feedback here..."
                    required
                ></textarea>

                <button class="btn" style="margin-top:10px;">
                    Save Feedback
                </button>
            </form>
        @endif
    </div>

    {{-- ================= EXPORT ================= --}}
    <a href="{{ route('counselor.records.export.pdf', $student->id) }}"
   class="btn">
   Export Counseling Report (PDF)
</a>

</div>

<script>
function toggleEditFeedback() {
    const form = document.getElementById('edit-feedback-form');
    const text = document.getElementById('feedback-text');

    if (!form || !text) return;

    if (form.style.display === 'none') {
        form.style.display = 'block';
        text.style.display = 'none';
    } else {
        form.style.display = 'none';
        text.style.display = 'block';
    }
}
</script>

</body>
</html>
