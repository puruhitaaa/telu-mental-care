<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Mood Recording – TelU Mental Care</title>

<style>
body {
    margin: 0;
    font-family: Poppins, sans-serif;
    background: linear-gradient(to bottom, #F4EDE5, #59121A);
    color: #374138;
    overflow-y: auto; 
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
    font-size: 14px;
    color: #59121A;
    opacity: .6;
    text-decoration: none;
    border-radius: 999px;
}

.nav-center a.active {
    background: #59121A;
    color: #fff;
    opacity: 1;
}

.nav-right {
    display: flex;
    gap: 18px;
    align-items: center;
}

.nav-right img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
}

.page-content {
    padding-bottom: 80px;   
}

/* ===== CARD ===== */
.wrapper {
    display: flex;
    justify-content: center;
    padding: 40px 0 80px;
}

.card {
    width: 560px;
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 14px 40px rgba(0,0,0,.18);
}

.card h1 {
    margin: 0;
    color: #59121A;
}

.subtitle {
    font-size: 14px;
    margin-bottom: 28px;
}

/* ===== MOOD ===== */
.moods {
    display: flex;
    justify-content: space-between;
    margin: 32px 0;
}

.mood label {
    font-size: 36px;
    cursor: pointer;
    padding: 10px;
    border-radius: 50%;
    transition: all .2s ease;
    opacity: .4;
}

.mood input {
    display: none;
}

.mood input:checked + label {
    opacity: 1;
    background: #f3e6e8;
    transform: scale(1.15);
}

/* ===== SLIDER ===== */
.slider {
    margin: 30px 0;
}

.slider input[type=range] {
    width: 100%;
    accent-color: #59121A;
}

/* ===== NOTE ===== */
textarea {
    width: 100%;
    height: 120px;
    padding: 14px;
    border-radius: 12px;
    border: 1.8px solid #59121A;
    resize: none;
}

/* ===== BUTTON ===== */
button {
    margin-top: 32px;
    width: 100%;
    padding: 16px;
    border-radius: 999px;
    background: #59121A;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* ===== ALERT ===== */
.notif-success {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #2e7d32;
    color: white;
    padding: 14px 22px;
    border-radius: 10px;
    font-size: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    z-index: 9999;
    animation: fadeOut 3s forwards;
}

@keyframes fadeOut {
    0% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; }
}

.error {
    color: #c62828;
    font-size: 13px;
    margin-bottom: 12px;
}
</style>
</head>

<body>

{{-- SUCCESS NOTIF --}}
@if(session('success'))
<div class="notif-success">
    {{ session('success') }}
</div>
@endif

<!-- NAVBAR -->
@include('student.partials.navbar')

<div class="page-content">
    <div class="wrapper">

<!-- CONTENT -->

<div class="card">
<h1>How are you feeling today?</h1>
<p class="subtitle">Select the mood that best describes how you feel.</p>

{{-- ERROR --}}
@if($errors->any())
    <div class="error">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('student.mood.store') }}">
@csrf

<!-- MOOD -->
<div class="moods">
@foreach([1=>'😡',2=>'😕',3=>'😐',4=>'😊',5=>'😁'] as $v=>$emoji)
    <div class="mood">
        <input type="radio" name="mood_level" id="m{{ $v }}" value="{{ $v }}" required>
        <label for="m{{ $v }}">{{ $emoji }}</label>
    </div>
@endforeach
</div>

<!-- STRESS -->
<div class="slider">
    <strong>Stress Level</strong>
    <input type="range" min="1" max="5" name="stress_level" value="3">
</div>

<!-- NOTE -->
<strong>Daily Journal</strong>
<textarea name="note" placeholder="Tell us how your day was..."></textarea>

<button type="submit">Save Mood</button>

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
