<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stress Assessment – TelU Mental Care</title>

<style>
body {
    margin: 0;
    font-family: Poppins, sans-serif;
    background: linear-gradient(to bottom, #F4EDE5, #59121A);
    min-height: 100vh;
    color: #59121A;
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

.nav-center {
    background: #fff;
    height: 48px;
    padding: 4px;
    border-radius: 999px;
    display: flex;
    gap: 6px;
}

.nav-center a {
    padding: 0 22px;
    display: flex;
    align-items: center;
    border-radius: 999px;
    text-decoration: none;
    color: #59121A;
    opacity: .6;
}

.nav-center a.active {
    background: #59121A;
    color: white;
    opacity: 1;
}

.nav-right {
    display: flex;
    gap: 16px;
    align-items: center;
}

/* ===== CARD ===== */
.wrapper {
    display: flex;
    justify-content: center;
    padding: 50px 0;
}

.card {
    width: 680px;
    background: #fff;
    border-radius: 18px;
    padding: 36px 40px;
    box-shadow: 0 12px 32px rgba(0,0,0,.15);
}

.card h1 {
    margin-top: 0;
}

.question {
    margin-top: 26px;
}

.question label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
}

select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 2px solid #59121A;
    font-size: 14px;
}

.submit-btn {
    margin-top: 40px;
    width: 100%;
    background: #59121A;
    color: white;
    border: none;
    padding: 14px;
    font-size: 16px;
    border-radius: 999px;
    cursor: pointer;
}
</style>
</head>

<body>

<!-- NAVBAR -->
@include('student.partials.navbar')

<div class="wrapper">

@if (session('success'))
    <div style="
        background:#e6f4ea;
        color:#2e7d32;
        padding:12px 18px;
        border-radius:10px;
        margin-bottom:20px;
        font-size:14px;
    ">
        {{ session('success') }}
    </div>
@endif

<!-- CONTENT -->
<div class="wrapper">
<div class="card">

<h1>Stress Assessment</h1>
<p>
This short assessment helps you reflect on how you've been feeling recently.
</p>

<form method="POST" action="{{ route('student.stress.store') }}">
@csrf

<div class="question">
<label>1. How often do you feel overwhelmed?</label>
<select name="q1" required>
    <option value="">Select</option>
    <option value="1">Never</option>
    <option value="2">Sometimes</option>
    <option value="3">Often</option>
    <option value="4">Very Often</option>
</select>
</div>

<div class="question">
<label>2. How anxious have you felt in the past week?</label>
<select name="q2" required>
    <option value="">Select</option>
    <option value="1">Not at all</option>
    <option value="2">Slightly</option>
    <option value="3">Moderately</option>
    <option value="4">Extremely</option>
</select>
</div>

<div class="question">
<label>3. Do you experience difficulty concentrating?</label>
<select name="q3" required>
    <option value="">Select</option>
    <option value="1">Never</option>
    <option value="2">Sometimes</option>
    <option value="3">Often</option>
</select>
</div>

<div class="question">
<label>4. How would you rate your sleep quality recently?</label>
<select name="q4" required>
    <option value="">Select</option>
    <option value="1">Very Good</option>
    <option value="2">Good</option>
    <option value="3">Poor</option>
    <option value="4">Very Poor</option>
</select>
</div>

<div class="question">
<label>5. How often do you feel mentally exhausted?</label>
<select name="q5" required>
    <option value="">Select</option>
    <option value="1">Never</option>
    <option value="2">Sometimes</option>
    <option value="3">Often</option>
    <option value="4">Always</option>
</select>
</div>

<button class="submit-btn">Submit Assessment</button>

</form>

</div>
</div>

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

</body>
</html>
