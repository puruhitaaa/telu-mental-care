<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard – TelU Mental Care</title>

<style>
body {
    margin: 0;
    font-family: Poppins, sans-serif;
    background: linear-gradient(to bottom, #F4EDE5, #59121A);
    min-height: 100vh;
    color: #374138;
}

/* ===== NAVBAR ===== */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 60px;
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.nav-left img { width: 42px; }

.nav-left span {
    font-weight: 600;
    font-size: 18px;
    color: #59121A;
}

.nav-center {
    background: #ffffff;
    height: 48px;
    padding: 4px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.nav-center a {
    height: 40px;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 500;
    color: #59121A;
    opacity: 0.6;
    text-decoration: none;
    border-radius: 999px;
}

.nav-center a.active {
    background: #59121A;
    color: white;
    opacity: 1;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 18px;
}

.notification {
    position: relative;
    font-size: 20px;
    cursor: pointer;
    color: #59121A;
}

.notification .dot {
    position: absolute;
    top: 2px;
    right: 2px;
    width: 8px;
    height: 8px;
    background: #c62828;
    border-radius: 50%;
}

.nav-right img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

/* ===== MAIN ===== */
.main {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 40px 120px;
}

.left { width: 460px; }

.left h1 {
    font-size: 30px;
    color: #59121A;
}

.left p {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 22px;
}

/* ===== STATUS CARD ===== */
.status-card {
    background: #fff;
    border-radius: 16px;
    padding: 26px 24px;
    box-shadow: 0 10px 28px rgba(0,0,0,0.15);
}

.step {
    display: flex;
    gap: 14px;
    margin-bottom: 22px;
}

.icon { font-size: 20px; }

.success { color: #2e7d32; }
.failed { color: #c62828; }
.locked { color: #bb9e7f; }

.box {
    margin-top: 8px;
    padding: 10px 12px;
    border-radius: 8px;
    font-size: 13px;
}

.box.success { background: #e6f2ea; }
.box.failed { background: #fdecea; }

.request-wrapper {
    margin-top: 26px;
    padding-top: 18px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: center;
}

.request-btn {
    width: 100%;
    max-width: 280px;
    background: #59121A;
    color: white;
    padding: 13px;
    border-radius: 999px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
}

.right img {
    width: 420px;
    margin-top: 20px;
}

/* ===== FOOTER INFO ===== */
.footer-info {
    margin-top: 120px;
    padding: 36px 20px;
    background: rgba(255,255,255,0.45);
    backdrop-filter: blur(6px);
    text-align: center;
}

.footer-info h4 {
    margin: 0 0 10px;
    font-size: 16px;
    font-weight: 600;
    color: #59121A;
}

.footer-info p {
    margin: 6px 0;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

.footer-contact {
    margin-top: 12px;
    font-size: 14px;
    color: #59121A;
}

.footer-contact span {
    margin: 0 10px;
    white-space: nowrap;
}

</style>
</head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('moodChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Mood Level',
                data: @json($data),
                borderColor: '#59121A',
                backgroundColor: 'rgba(89,18,26,0.15)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#59121A'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    min: 1,
                    max: 5,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>

<body>

@php
    $hasConsultation = $consultationRequest !== null;
@endphp

<!-- NAVBAR -->
@include('student.partials.navbar')

<div class="wrapper">

<!-- MAIN -->
<div class="main">

<div class="left">
    <h1>Welcome, {{ auth()->user()->name }}!</h1>

    <p>
        Before you can track your mood or complete a stress assessment,
        we need to verify your student status and counseling request.
    </p>

    <div class="status-card">

    @if (session('success'))
    <div 
        id="successAlert"
        style="
            background:#e6f4ea;
            color:#2e7d32;
            padding:14px 18px;
            border-radius:12px;
            margin-bottom:20px;
            font-size:14px;
            transition: opacity .5s ease;
        "
    >
        {{ session('success') }}
    </div>
@endif

        {{-- COMMON --}}
        <div class="step">
            <div class="icon success">😊</div>
            <div><strong>Loading Profile</strong><br><span class="success">Success</span></div>
        </div>

        {{-- BEFORE REQUEST --}}
        @if(!$hasConsultation)

            <div class="step">
                <div class="icon failed">☹️</div>
                <div>
                    <strong>Consulting Session Required</strong><br>
                    <span class="failed">Failed</span>
                    <div class="box failed">
                        • You have not requested a counseling session yet.<br>
                        • Features will unlock after request.
                    </div>
                </div>
            </div>

            <div class="step"><div class="icon locked">😐</div><div>Mood Recording<br><span class="locked">Locked</span></div></div>
            <div class="step"><div class="icon locked">😐</div><div>Stress Assessment<br><span class="locked">Locked</span></div></div>
            <div class="step"><div class="icon locked">😐</div><div>Dashboard Insight<br><span class="locked">Locked</span></div></div>

            <div class="request-wrapper">
                <a href="{{ route('student.consultation.create') }}" class="request-btn">
                    Request Consulting Session
                </a>
            </div>

        {{-- AFTER REQUEST --}}
        @else

            <div class="step">
                <div class="icon success">😊</div>
                <div>
                    <strong>Consulting Session Required</strong><br>
                    <span class="success">Success</span>
                    <div class="box success">
                        • Consultation request submitted<br>
                        • All features unlocked
                    </div>
                </div>
            </div>

            <div class="step"><div class="icon success">😊</div><div>Mood Recording<br><span class="success">Available</span></div></div>
            <div class="step"><div class="icon success">😊</div><div>Stress Assessment<br><span class="success">Available</span></div></div>
            <div class="step"><div class="icon success">😊</div><div>Dashboard Insight<br><span class="success">Available</span></div></div>

            {{-- CHART --}}
            <div style="margin-top:30px;">
                <strong style="color:#59121A;">Mood Tracking Overview</strong>
                <p style="font-size:13px;">Here’s an overview of your mood pattern.</p>
                <div style="height:220px;background:#d0d0c5;border-radius:10px;
                    display:flex;align-items:center;justify-content:center;">
                    <canvas id="moodChart" height="120" style="margin-top:20px;"></canvas>
                </div>
            </div>

            {{-- REQUEST ANOTHER CONSULTATION --}}
<div 
    style="
        margin-top:32px;
        padding-top:22px;
        border-top:1px solid #eee;
        text-align:center;
    "
>
    <strong style="color:#59121A;font-size:15px;">
        Still need someone to talk to?
    </strong>

    <p style="font-size:13px;margin:10px 0 18px;">
        You can request another counseling session anytime you feel the need.
    </p>

    <a 
        href="{{ route('student.consultation.create') }}"
        style="
            display:inline-block;
            background:#59121A;
            color:white;
            padding:12px 26px;
            border-radius:999px;
            font-size:14px;
            font-weight:600;
            text-decoration:none;
        "
    >
        Request Another Consultation
    </a>
</div>

        @endif

    </div>
</div>

<div class="right">
    <img src="{{ asset('assets/student/5.png') }}">
</div>

</div>

<script>
setTimeout(() => {
    const alert = document.getElementById('successAlert');
    if (alert) {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }
}, 3000); // 3 detik
</script>

<script>
function toggleProfile() {
    const p = document.getElementById('profileDropdown');
    const n = document.getElementById('notifDropdown');
    n.style.display = 'none';
    p.style.display = p.style.display === 'block' ? 'none' : 'block';
}

function toggleNotif() {
    const n = document.getElementById('notifDropdown');
    const p = document.getElementById('profileDropdown');
    p.style.display = 'none';
    n.style.display = n.style.display === 'block' ? 'none' : 'block';
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.nav-right')) {
        document.getElementById('profileDropdown').style.display = 'none';
        document.getElementById('notifDropdown').style.display = 'none';
    }
});
</script>

<!-- ===== FOOTER INFO ===== -->
<div class="footer-info">
    <h4>TelU Mental Care</h4>

    <p>
        TelU Mental Care is an official mental health support service  
        provided by <strong>Telkom University</strong>.
    </p>

    <p>
        If you have any questions or need further assistance, feel free to contact us:
    </p>

    <div class="footer-contact">
        <span>📞 +62 21 1696 8323</span>
        <span>|</span>
        <span>✉️ telumentalcare@telkomuniversity.ac.id</span>
    </div>
</div>

</body>
</html>
