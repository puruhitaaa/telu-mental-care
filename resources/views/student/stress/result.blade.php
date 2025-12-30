<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stress Assessment Result</title>

<style>
body {
    margin: 0;
    font-family: Poppins, sans-serif;
    background: linear-gradient(to bottom, #F4EDE5, #59121A);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card {
    background: white;
    width: 520px;
    padding: 36px;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,.2);
    text-align: center;
}

.card h1 {
    color: #59121A;
}

.score {
    font-size: 48px;
    font-weight: 700;
    margin: 20px 0;
}

.level {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
}

.level.high { color: #c62828; }
.level.medium { color: #f9a825; }
.level.low { color: #2e7d32; }

.alert {
    background: #fdecea;
    color: #c62828;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 22px;
    font-size: 14px;
}

.btn {
    display: inline-block;
    margin-top: 12px;
    padding: 12px 26px;
    border-radius: 999px;
    background: #59121A;
    color: white;
    text-decoration: none;
    font-weight: 600;
}
</style>
</head>

<body>

<div class="card">

    <h1>Stress Assessment Result</h1>

    <div class="score">{{ $assessment->stress_score }}</div>

    <div class="level {{ strtolower($assessment->stress_level) }}">
        Risk Level: {{ $assessment->stress_level }}
    </div>

    @if ($assessment->stress_level === 'High')
        <div class="alert">
            ⚠️ Your stress level is categorized as <strong>High Risk</strong>.<br>
            You are strongly advised to request a counseling session immediately.
        </div>

        <a href="{{ route('student.consultation.create') }}" class="btn">
            Request Counseling Now
        </a>
    @else
        <a href="{{ route('student.dashboard') }}" class="btn">
            Back to Dashboard
        </a>
    @endif

</div>

</body>
</html>
