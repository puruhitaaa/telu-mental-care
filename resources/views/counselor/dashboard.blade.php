<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Counselor Dashboard – TelU Mental Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
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

.nav-left img {
    width: 42px;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 18px;
    position: relative;
}

.icon {
    font-size: 20px;
    cursor: pointer;
    position: relative;
}

.badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: #C62828;
    color: white;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 999px;
}

/* ===== DROPDOWN ===== */
.dropdown {
    position: absolute;
    top: 52px;
    right: 0;
    background: white;
    border-radius: 16px;
    width: 240px;
    box-shadow: 0 12px 30px rgba(0,0,0,.2);
    display: none;
    z-index: 20;
}

.dropdown a {
    display: block;
    padding: 14px 18px;
    text-decoration: none;
    color: #59121A;
    font-size: 14px;
}

.dropdown a.active,
.dropdown a:hover {
    background: #59121A;
    color: white;
}

/* ===== PROFILE ===== */
.profile-wrapper {
    position: relative;
}

.profile-img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: cover;
    cursor: pointer;
}

.profile-dropdown {
    position: absolute;
    top: 52px;
    right: 0;
    background: white;
    border-radius: 16px;
    width: 200px;
    box-shadow: 0 12px 30px rgba(0,0,0,.2);
    display: none;
    z-index: 30;
}

.profile-dropdown a,
.profile-dropdown button {
    display: block;
    width: 100%;
    padding: 12px 16px;
    border: none;
    background: none;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
    color: #59121A;
}

.profile-dropdown a:hover,
.profile-dropdown button:hover {
    background: #59121A;
    color: white;
}

/* ===== CONTENT ===== */
.container {
    padding: 40px 60px;
}

.cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.card {
    background: #F6EFE8;
    border-radius: 22px;
    padding: 30px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
@include('counselor.partials.navbar')

<!-- CONTENT -->
<div class="container">
    <h1>Dashboard Overview</h1>
    <p>General wellbeing trends of Telkom University students.</p>

    <div class="cards">
        <div class="card">
            <h3>Weekly Stress Trend</h3>
            <canvas id="stressChart"></canvas>
        </div>

        <div class="card">
            <h3>Weekly Mood Trend</h3>
            <canvas id="moodChart"></canvas>
        </div>
    </div>
</div>

<script>
function toggleMenu() {
    const el = document.getElementById('menuDropdown');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}
function toggleProfile() {
    const el = document.getElementById('profileDropdown');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

new Chart(document.getElementById('stressChart'), {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            data: @json($stressValues),
            borderColor: '#59121A',
            tension: 0.4
        }]
    }
});

new Chart(document.getElementById('moodChart'), {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            data: @json($moodValues),
            borderColor: '#8B5E5E',
            tension: 0.4
        }]
    }
});
</script>

</body>
</html>
