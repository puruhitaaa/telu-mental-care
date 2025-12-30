<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Request Consulting Session – TelU Mental Care</title>

<style>
body {
    margin: 0;
    font-family: Poppins, sans-serif;
    background: linear-gradient(to bottom, #F4EDE5, #59121A);
    min-height: 100vh;
    color: #374138;
}

/* ===== NAVBAR ===== */
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
    cursor: pointer;
}

/* ===== MAIN ===== */
.main {
    display: flex;
    justify-content: center;
    padding: 50px 20px;
}

.form-card {
    background: white;
    width: 100%;
    max-width: 620px;
    padding: 36px 40px;
    border-radius: 22px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.form-card h2 {
    color: #59121A;
    margin-bottom: 32px;
}

/* ===== FORM ===== */
.form-group {
    margin-bottom: 28px;
}

.form-group .title {
    display: block;
    font-weight: 600;
    margin-bottom: 10px;
    color: #59121A;
}

input, select, textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 14px;
    border: 2px solid #59121A;
    font-size: 14px;
}

textarea {
    min-height: 120px;
    resize: vertical;
}

/* ===== RADIO & CHECKBOX (FINAL FIX) ===== */
.radio-list,
.checkbox-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.option {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    cursor: pointer;
}

.option input {
    accent-color: #59121A;
    width: auto;
}

/* ===== SUBMIT ===== */
.submit-btn {
    margin-top: 36px;
    width: 100%;
    padding: 15px;
    border-radius: 999px;
    background: linear-gradient(135deg, #59121A, #3f0d12);
    color: white;
    border: none;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(89,18,26,0.45);
}
</style>
</head>

<body>

<div class="navbar">

    <div class="nav-left">
        <img src="{{ asset('assets/intro/TMCrb.png') }}">
        <span>TelU Mental Care</span>
    </div>

    <div class="nav-center">
        <a class="active">Dashboard</a>
        <a>Mood Recording</a>
        <a>Stress Assessment</a>
    </div>

    <div class="nav-right" style="position:relative; gap:18px;">

        <!-- NOTIFICATION -->
        <div class="notification">
            🔔 <span class="dot"></span>
        </div>

        <!-- PROFILE -->
        <img 
            src="{{ auth()->user()->profile_photo_path 
                ? asset('storage/' . auth()->user()->profile_photo_path)
                : asset('assets/default-avatar.png') }}"
            onclick="toggleProfile()"
        >

        <!-- PROFILE DROPDOWN -->
        <div 
            id="profileDropdown"
            style="
                display:none;
                position:absolute;
                top:55px;
                right:0;
                background:white;
                border-radius:14px;
                width:180px;
                box-shadow:0 12px 30px rgba(0,0,0,.2);
                overflow:hidden;
                z-index:20;
            "
        >
            <a 
                href="{{ route('student.profile.edit') }}"
                style="display:block;padding:12px 16px;text-decoration:none;color:#59121A;"
            >
                ✏️ Edit Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    style="
                        width:100%;
                        border:none;
                        background:none;
                        padding:12px 16px;
                        text-align:left;
                        cursor:pointer;
                        color:#c62828;
                    "
                >
                    🚪 Logout
                </button>
            </form>
        </div>

    </div>

</div>
<div class="main">
<div class="form-card">

<h2>Request Consulting Session</h2>

<form method="POST" action="{{ route('student.consultation.store') }}">
@csrf

<div class="form-group">
    <label class="title">Consultation Topic</label>
    <select name="topic" required>
        <option disabled selected>Select Topic</option>
        <option value="Academic Stress">Academic Stress</option>
        <option value="Personal Issues">Personal Issues</option>
        <option value="Anxiety">Anxiety</option>
        <option value="Depression">Depression</option>
    </select>
</div>

<div class="form-group">
    <label class="title">Preferred Date</label>
    <input type="date" name="preferred_date" required>
</div>

<div class="form-group">
    <label class="title">Preferred Time</label>
    <input 
    type="time" 
    name="preferred_time" 
    min="07:00" 
    max="17:00" 
    step="1800"
    required
>
</div>

<div class="form-group">
    <label class="title">Urgency Level</label>
    <div class="radio-list">
        <label class="option">
            <input type="radio" name="urgency" value="low" required> Low
        </label>
        <label class="option">
            <input type="radio" name="urgency" value="medium"> Medium
        </label>
        <label class="option">
            <input type="radio" name="urgency" value="high"> High
        </label>
    </div>
</div>

<div class="form-group">
    <label class="title">Additional Notes</label>
    <textarea name="notes" placeholder="Feel free to describe your condition..."></textarea>
</div>

<div class="form-group">
    <label class="title">Communication Preference</label>
    <div class="radio-list">
        <label class="option">
            <input type="radio" name="communication" value="chat" required> Chat
        </label>
        <label class="option">
            <input type="radio" name="communication" value="video_call"> Video Call
        </label>
        <label class="option">
            <input type="radio" name="communication" value="in_person"> In Person
        </label>
    </div>
</div>

<div class="form-group">
    <label class="option">
        <input type="checkbox" name="agree" required>
        I agree to TelU Mental Care consultation guidelines
    </label>
</div>

<button class="submit-btn">Submit Request</button>
</form>
</div>
</div>

<script>
const timeInput = document.querySelector('input[name="preferred_time"]');

timeInput.addEventListener('change', () => {
    const value = timeInput.value;
    if (value < '07:00' || value > '17:00') {
        alert('Please select time between 07:00 and 17:00');
        timeInput.value = '';
    }
});
</script>

</body>
</html>
