@php
    $hasConsultation = auth()->user()
        ->consultationRequests()
        ->exists();
@endphp

<style>
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
    background: #fff;
    height: 48px;
    padding: 4px;
    border-radius: 999px;
    display: flex;
    gap: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.nav-center a {
    padding: 0 22px;
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #59121A;
    text-decoration: none;
    border-radius: 999px;
    opacity: .6;
}

.nav-center a.active {
    background: #59121A;
    color: white;
    opacity: 1;
}

.nav-center a.locked {
    pointer-events: none;
    opacity: .35;
    cursor: not-allowed;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 18px;
    position: relative;
    color: #59121A;
}

.notification {
    font-size: 20px;
    cursor: pointer;
    position: relative;
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
    width: 38px;
    height: 38px;
    border-radius: 50%;
    cursor: pointer;
}

/* ===== DROPDOWN ===== */
.menu-dropdown {
    display: none;
    position: absolute;
    top: 55px;
    right: 0;
    background: white;
    border-radius: 14px;
    width: 240px;
    box-shadow: 0 12px 30px rgba(0,0,0,.2);
    z-index: 999;
}

.menu-dropdown a {
    display: block;
    padding: 12px 16px;
    text-decoration: none;
    color: #59121A;
    font-size: 13px;
}

.menu-dropdown a:hover {
    background: #f6eeee;
}
</style>

<div class="navbar">

    <!-- LEFT -->
    <div class="nav-left">
        <img src="{{ asset('assets/intro/TMCrb.png') }}">
        <span>TelU Mental Care</span>
    </div>

    <!-- CENTER -->
    <div class="nav-center">
        <a href="{{ route('student.dashboard') }}"
           class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a
            href="{{ $hasConsultation ? route('student.mood.index') : '#' }}"
            class="
                {{ request()->routeIs('student.mood.*') ? 'active' : '' }}
                {{ !$hasConsultation ? 'locked' : '' }}
            "
            title="{{ !$hasConsultation ? 'Submit counseling request first' : '' }}"
        >
            Mood Recording
        </a>

        <a
            href="{{ $hasConsultation ? route('student.stress.index') : '#' }}"
            class="
                {{ request()->routeIs('student.stress.*') ? 'active' : '' }}
                {{ !$hasConsultation ? 'locked' : '' }}
            "
            title="{{ !$hasConsultation ? 'Submit counseling request first' : '' }}"
        >
            Stress Assessment
        </a>
    </div>

    <!-- RIGHT -->
    <div class="nav-right">

        <!-- NOTIFICATION -->
        <div class="notification" onclick="toggleNotif()">
            🔔
            @if(auth()->user()->unreadNotifications->count())
                <span class="dot"></span>
            @endif
        </div>

        <!-- PROFILE -->
        <img
            src="{{ auth()->user()->profile_photo_path
                ? asset('storage/' . auth()->user()->profile_photo_path)
                : asset('assets/default-avatar.png') }}"
            onclick="toggleProfile()"
        >

        <!-- NOTIF DROPDOWN -->
        <div id="notifDropdown" class="menu-dropdown" style="right:60px;">
            <strong style="padding:14px 18px;display:block;">Notifications</strong>
            <hr>

            @forelse(auth()->user()->unreadNotifications as $notif)
                <a href="{{ $notif->data['url'] }}">
                    <strong>{{ $notif->data['title'] }}</strong><br>
                    <small>{{ $notif->data['message'] }}</small>
                </a>
            @empty
                <p style="padding:14px 18px;font-size:13px;color:#777;margin:0;">
                    No notifications available.
                </p>
            @endforelse
        </div>

        <!-- PROFILE DROPDOWN -->
        <div id="profileDropdown" class="menu-dropdown">
            <a href="{{ route('student.profile.edit') }}">✏️ Edit Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="width:100%;padding:12px 16px;border:none;background:none;color:#c62828;text-align:left;">
                    🚪 Logout
                </button>
            </form>
        </div>

    </div>
</div>

<script>
function hideAll() {
    notifDropdown.style.display = 'none';
    profileDropdown.style.display = 'none';
}
function toggleNotif() {
    hideAll();
    notifDropdown.style.display =
        notifDropdown.style.display === 'block' ? 'none' : 'block';
}
function toggleProfile() {
    hideAll();
    profileDropdown.style.display =
        profileDropdown.style.display === 'block' ? 'none' : 'block';
}
document.addEventListener('click', e => {
    if (!e.target.closest('.nav-right')) hideAll();
});
</script>
