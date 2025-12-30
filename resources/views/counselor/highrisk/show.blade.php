<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>High-Risk Student Detail – TelU Mental Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #59121A;
    --soft-bg: #F6EFE8;
    --page-bg: linear-gradient(to bottom, #F4EDE5, #B98A8A);
    --danger: #C62828;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: var(--page-bg);
    color: #3A0D12;
    min-height: 100vh;
}

/* ===== CONTAINER ===== */
.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 50px 60px 80px;
}

/* ===== TITLE ===== */
.page-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 26px;
}

/* ===== CARD ===== */
.card {
    background: var(--soft-bg);
    border-radius: 22px;
    padding: 34px 38px;
    border: 2px solid var(--primary);
}

/* ===== INFO GRID ===== */
.info-grid {
    display: grid;
    grid-template-columns: 200px auto;
    row-gap: 14px;
    font-size: 14px;
}

.info-grid span.label {
    font-weight: 600;
    color: #5a1a1a;
}

/* ===== DIVIDER ===== */
.divider {
    height: 1px;
    background: rgba(0,0,0,0.12);
    margin: 26px 0;
}

/* ===== ALERT ===== */
.alert {
    margin-top: 24px;
    padding: 16px 20px;
    border-left: 6px solid var(--danger);
    background: #FFECEC;
    color: #8B0000;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ===== BUTTON ===== */
.actions {
    margin-top: 34px;
}

.btn {
    display: inline-block;
    background: var(--primary);
    color: white;
    padding: 12px 26px;
    border-radius: 999px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}
</style>
</head>

<body>

@include('counselor.partials.navbar')

<div class="container">

    <div class="page-title">
        High-Risk Student Detail
    </div>

    <div class="card">

        <!-- BASIC INFO -->
        <div class="info-grid">
            <span class="label">Student Name</span>
            <span>: {{ $student->name }}</span>

            <span class="label">Email</span>
            <span>: {{ $student->email }}</span>

            @if($student->phone)
                <span class="label">Phone</span>
                <span>: {{ $student->phone }}</span>
            @endif

            <span class="label">Source</span>
            <span>: {{ ucfirst($type) }}</span>
        </div>

        <div class="divider"></div>

        <!-- SOURCE DETAIL -->
        @if($type === 'consultation')
            <div class="info-grid">
                <span class="label">Topic</span>
                <span>: {{ $data->topic }}</span>

                <span class="label">Preferred Date</span>
                <span>: {{ $data->preferred_date }}</span>

                <span class="label">Preferred Time</span>
                <span>: {{ $data->preferred_time }}</span>
            </div>
        @endif

        @if($type === 'stress')
            <div class="info-grid">
                <span class="label">Stress Score</span>
                <span>: {{ $data->stress_score }}</span>

                <span class="label">Stress Level</span>
                <span>: {{ ucfirst($data->stress_level) }}</span>
            </div>
        @endif

        <!-- ALERT -->
        <div class="alert">
            ⚠️ {{ $reason }}
        </div>

        <!-- ACTION -->
        <div class="actions">
            <a href="{{ route('counselor.highrisk.index') }}" class="btn">
                ← Back to High-Risk List
            </a>
        </div>

    </div>

</div>

</body>
</html>
