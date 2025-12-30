<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>High-Risk Student – TelU Mental Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #59121A;
    --soft-bg: #F6EFE8;
    --page-bg: linear-gradient(to bottom, #F4EDE5, #B98A8A);
    --danger: #C62828;
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

.header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 30px;
    margin-bottom: 40px;
}

.header h1 {
    margin: 0;
    font-size: 30px;
    color: var(--primary);
}

.header p {
    margin-top: 8px;
    font-size: 14px;
    max-width: 520px;
    line-height: 1.6;
}

.export-all {
    background: var(--primary);
    color: white;
    padding: 12px 24px;
    border-radius: 999px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
}

.section-title {
    margin: 42px 0 20px;
    font-size: 20px;
    color: var(--primary);
    font-weight: 700;
}

.card {
    background: var(--soft-bg);
    border-radius: 18px;
    padding: 22px 26px;
    margin-bottom: 22px;
    border: 2px solid var(--primary);
}

.card h3 {
    margin: 0 0 14px;
    color: var(--primary);
    font-size: 18px;
}

.card-row {
    display: grid;
    grid-template-columns: 160px auto;
    font-size: 14px;
    margin-bottom: 8px;
}

.card-row span:first-child {
    font-weight: 600;
}

.status {
    font-weight: 700;
    color: var(--danger);
}

.badge-risk {
    display: inline-block;
    background: var(--danger);
    color: white;
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 999px;
    margin-left: 8px;
}

.actions {
    margin-top: 18px;
}

.btn {
    display: inline-block;
    background: var(--primary);
    color: white;
    padding: 10px 22px;
    border-radius: 999px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.page-wrapper {
    min-height: calc(100vh - 90px);
    padding: 40px 0;
}

.content-card {
    background: #fff;
    border-radius: 26px;
    padding: 46px 50px 60px;
    box-shadow: 0 18px 50px rgba(0,0,0,.12);
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #7a4a4a;
}

.empty-state h3 {
    margin-bottom: 10px;
    font-size: 20px;
    color: var(--primary);
}

.empty-state p {
    font-size: 14px;
    max-width: 420px;
    margin: auto;
    line-height: 1.6;
}

</style>
</head>

<body>

@include('counselor.partials.navbar')

<div class="page-wrapper">
    <div class="container">
        <div class="content-card">

    <!-- HEADER -->
    <div class="header">
        <div>
            <h1>High-Risk Student</h1>
            <p>
                Students identified as requiring immediate emotional or psychological attention
                based on consultation urgency or stress assessment results.
            </p>
        </div>

        <a href="{{ route('counselor.highrisk.exportCsv') }}" class="export-all">
            Export CSV
        </a>
    </div>

    {{-- ================= HIGH URGENCY CONSULTATION ================= --}}
    @if($highUrgency->isNotEmpty())
        <div class="section-title">High Urgency Consultation</div>

        @foreach($highUrgency as $item)
            <div class="card">
                <h3>
                    {{ $item->student->name }}
                    <span class="badge-risk">HIGH RISK</span>
                </h3>

                <div class="card-row">
                    <span>Source</span>
                    <span>: Consultation Request</span>
                </div>

                <div class="card-row">
                    <span>Urgency</span>
                    <span>: {{ ucfirst($item->urgency) }}</span>
                </div>

                <div class="card-row">
                    <span>Preferred Date</span>
                    <span>: {{ $item->preferred_date }}</span>
                </div>

                <div class="card-row">
                    <span>Status</span>
                    <span class="status">: High Risk</span>
                </div>

                <div class="actions">
                    <a href="{{ route('counselor.highrisk.show', ['type'=>'consultation','id'=>$item->id]) }}"
                       class="btn">
                        View Detail
                    </a>
                </div>
            </div>
        @endforeach
    @endif

    {{-- ================= HIGH STRESS ASSESSMENT ================= --}}
    @if($highStress->isNotEmpty())
        <div class="section-title">High Stress Assessment</div>

        @foreach($highStress as $item)
            <div class="card">
                <h3>
                    {{ $item->student->name }}
                    <span class="badge-risk">HIGH RISK</span>
                </h3>

                <div class="card-row">
                    <span>Source</span>
                    <span>: Stress Assessment</span>
                </div>

                <div class="card-row">
                    <span>Stress Score</span>
                    <span>: {{ $item->stress_score }}</span>
                </div>

                <div class="card-row">
                    <span>Stress Level</span>
                    <span class="status">: {{ $item->stress_level }}</span>
                </div>

                <div class="actions">
                    <a href="{{ route('counselor.highrisk.show', ['type'=>'stress','id'=>$item->id]) }}"
                       class="btn">
                        View Detail
                    </a>
                </div>
            </div>
        @endforeach
    @endif

    {{-- ================= EMPTY STATE ================= --}}
    @if($highUrgency->isEmpty() && $highStress->isEmpty())
        <div class="empty-state">
    <h3>No High-Risk Students</h3>
    <p>
        There are currently no students classified as high risk based on
        consultation urgency or stress assessment results.
    </p>
</div>

    @endif

</div>
</div>
    </div>
</div>
</body>
</html>
