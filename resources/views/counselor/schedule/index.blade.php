<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Counseling Schedule – TelU Mental Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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

/* ===== BADGE ===== */
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
    text-decoration: none;
    background: none;
    border: none;
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

.subtitle {
    font-size: 14px;
    margin-bottom: 26px;
}

/* ===== TABLE ===== */
.table-wrapper {
    background: #F6EFE8;
    border-radius: 18px;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 18px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background: #F0E6DC;
    font-weight: 600;
}

select {
    padding: 8px 12px;
    border-radius: 10px;
    border: 1.5px solid #59121A;
    background: white;
}

.btn-view {
    display: inline-block;
    background: #59121A;
    color: white;
    padding: 8px 16px;
    border-radius: 999px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: background 0.2s ease;
}

.btn-view:hover {
    background: #3f0d12;
    color: white;
}

</style>
</head>

<body>

<!-- NAVBAR -->
@include('counselor.partials.navbar')

<!-- CONTENT -->
<div class="container">
    <h1>Counseling Schedule</h1>
    <p class="subtitle">Manage and update student counseling appointment status.</p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->student->name }}</td>
<td>{{ $schedule->preferred_date }}</td>
<td>{{ $schedule->preferred_time }}</td>

<td>
    <form method="POST"
          action="{{ route('counselor.schedule.updateStatus', $schedule->id) }}">
        @csrf
        <select name="status" onchange="this.form.submit()">
            <option value="pending" {{ $schedule->status==='pending'?'selected':'' }}>
                Pending
            </option>
            <option value="confirmed" {{ $schedule->status==='confirmed'?'selected':'' }}>
                Confirmed
            </option>
            <option value="completed" {{ $schedule->status==='completed'?'selected':'' }}>
                Completed
            </option>
        </select>
    </form>
</td>

<td>
    <a href="{{ route('counselor.schedule.show', $schedule->id) }}"
   class="btn-view">
    View Student
</a>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:30px;color:#999;">
                        No counseling requests yet
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleMenu() {
    const el = document.getElementById('menuDropdown');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}
function toggleNotif() {
    const el = document.getElementById('notifDropdown');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}
function toggleProfile() {
    const el = document.getElementById('profileDropdown');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>
