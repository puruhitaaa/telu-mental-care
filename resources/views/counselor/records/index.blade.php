<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Records – TelU Mental Care</title>

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

.profile-img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: cover;
    cursor: pointer;
}

.profile-wrapper {
    position: relative;
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
    color: var(--primary);
    font-size: 14px;
}

.dropdown a.active,
.dropdown a:hover {
    background: var(--primary);
    color: white;
}

/* ===== CONTENT ===== */
.container {
    padding: 40px 60px 80px;
    max-width: 1200px;
}

h1 {
    margin-bottom: 6px;
    color: var(--primary);
}

.subtitle {
    font-size: 14px;
    margin-bottom: 26px;
}

/* ===== SEARCH ===== */
.search-box {
    background: var(--soft-bg);
    border-radius: 999px;
    padding: 14px 22px;
    display: flex;
    align-items: center;
    margin-bottom: 28px;
    border: 2px solid var(--primary);
}

.search-box input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 14px;
    width: 100%;
    margin-left: 10px;
}

/* ===== TABLE ===== */
.table-wrapper {
    background: var(--soft-bg);
    border-radius: 18px;
    overflow: hidden;
    border: 2px solid var(--primary);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 18px;
    text-align: center;
    border-bottom: 1px solid #ccc;
    font-size: 14px;
}

th {
    background: #EFE2D8;
    font-weight: 600;
}

.btn-export {
    background: var(--primary);
    color: white;
    padding: 10px 18px;
    border-radius: 999px;
    text-decoration: none;
    font-size: 13px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
@include('counselor.partials.navbar')

<!-- CONTENT -->
<div class="container">
    <h1>Student Records</h1>
    <p class="subtitle">
        View all students, monitor current wellbeing status, and export individual reports.
    </p>

    <!-- SEARCH -->
    <form method="GET" class="search-box">
        🔍
        <input 
            type="text" 
            name="search" 
            placeholder="Search student name..."
            value="{{ request('search') }}"
        >
    </form>

    <!-- TABLE -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Latest Stress Score</th>
                    <th>Current Mood Status</th>
                    <th>Risk Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->stress_score }}</td>
                    <td>{{ $student->mood_trend }}</td>
                    <td>{{ $student->risk_status }}</td>
                    <td>
    <a 
        href="{{ route('counselor.records.show', $student->id) }}" 
        class="btn-export"
    >
        View / Notes
    </a>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:30px;color:#999;">
                        No student data found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleMenu() {
    const menu = document.getElementById('menuDropdown');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function toggleNotif() {
    const notif = document.getElementById('notifDropdown');
    notif.style.display = notif.style.display === 'block' ? 'none' : 'block';
}

function toggleProfile() {
    const profile = document.getElementById('profileDropdown');
    profile.style.display = profile.style.display === 'block' ? 'none' : 'block';
}
</script>   

</body>
</html>
