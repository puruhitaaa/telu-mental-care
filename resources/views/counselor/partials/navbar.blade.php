<style>
/* ===== NAVBAR ===== */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 70px;
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.nav-left img {
    width: 42px;
}

.nav-left span {
    font-size: 18px;
    font-weight: 600;
    color: #59121A;
}

/* ===== RIGHT ===== */
.nav-right {
    display: flex;
    align-items: center;
    gap: 22px;
    position: relative;
}

/* ===== NOTIFICATION DROPDOWN ===== */
.notif-dropdown {
    display: none;
    position: absolute;
    top: 60px;
    right: 60px;
    width: 300px;
    max-height: 360px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 14px 32px rgba(0,0,0,.18);
    overflow-y: auto;
    z-index: 999;
}

.notif-header {
    padding: 14px 18px;
    font-weight: 600;
    font-size: 15px;
    color: #59121A;
    border-bottom: 1px solid #eee;
}

.notif-item {
    padding: 14px 18px;
    text-decoration: none;
    display: block;
    border-bottom: 1px solid #f0f0f0;
}

.notif-item:hover {
    background: #f6eeee;
}

.notif-title {
    font-size: 14px;
    font-weight: 600;
    color: #59121A;
    margin-bottom: 4px;
}

.notif-text {
    font-size: 13px;
    color: #555;
    line-height: 1.4;
}

.notif-empty {
    padding: 16px;
    font-size: 13px;
    color: #777;
    text-align: center;
}

.profile {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
}

/* ===== MENU DROPDOWN ===== */
.menu-dropdown {
    display: none;
    position: absolute;
    top: 60px;
    right: 0;
    background: #fff;
    border-radius: 14px;
    width: 220px;
    box-shadow: 0 14px 32px rgba(0,0,0,.18);
    overflow: hidden;
    z-index: 999;
}

.menu-dropdown a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 18px;
    text-decoration: none;
    color: #59121A;
    font-size: 14px;
}

.menu-dropdown a:hover {
    background: #f6eeee;
}

/* ===== CLICKABLE ===== */
.menu-btn,
.notification,
.profile,
.menu-dropdown a,
.notif-item {
    cursor: pointer;
}
</style>

<div class="navbar">

    <!-- LEFT -->
    <div class="nav-left">
        <img src="{{ asset('assets/intro/TMCrb.png') }}">
        <span>TelU Mental Care</span>
    </div>

    <!-- RIGHT -->
    <div class="nav-right">

        <!-- HAMBURGER -->
        <div class="menu-btn" id="menuBtn">☰</div>

        <!-- 🔔 NOTIFICATION ICON -->
        <!-- 🔥 FIX: TIDAK pakai onclick inline -->
        <div class="notification" id="notifBtn">
            🔔
        </div>

        <!-- PROFILE -->
        <img class="profile"
             id="profileBtn"
             src="{{ auth()->user()->profile_photo_path
                ? asset('storage/' . auth()->user()->profile_photo_path)
                : asset('assets/default-avatar.png') }}">

        <!-- MENU DROPDOWN -->
        <div id="menuDropdown" class="menu-dropdown">
            <a href="{{ route('counselor.dashboard') }}">📊 Dashboard</a>
            <a href="{{ route('counselor.schedule.index') }}">📅 Counseling Schedule</a>
            <a href="{{ route('counselor.highrisk.index') }}">🔥 High-Risk Student</a>
            <a href="{{ route('counselor.records.index') }}">📁 Student Records</a>
        </div>

        <!-- 🔔 NOTIF DROPDOWN -->
        <div id="notifDropdown" class="notif-dropdown">
            <div class="notif-header">Notifications</div>

            @forelse(auth()->user()->unreadNotifications as $notif)
                <!-- 🔥 FIX: LINK NORMAL, TIDAK DIBLOK JS -->
                <a href="{{ $notif->data['url'] }}"
   class="notif-item"
   data-link="{{ $notif->data['url'] }}">
                    <div class="notif-title">
                        {{ $notif->data['title'] }}
                    </div>
                    <div class="notif-text">
                        {{ $notif->data['message'] }}
                    </div>
                </a>
            @empty
                <div class="notif-empty">
                    No notifications available.
                </div>
            @endforelse
        </div>

        <!-- PROFILE DROPDOWN -->
        <div id="profileDropdown" class="menu-dropdown">
            <a href="{{ route('counselor.profile.edit') }}">✏️ Edit Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="
                    width:100%;
                    padding:14px 18px;
                    border:none;
                    background:none;
                    color:#c62828;
                    text-align:left;
                    cursor:pointer;">
                    🚪 Logout
                </button>
            </form>
        </div>

    </div>
</div>

<script>
const menuDropdown    = document.getElementById('menuDropdown');
const notifDropdown   = document.getElementById('notifDropdown');
const profileDropdown = document.getElementById('profileDropdown');

const menuBtn    = document.getElementById('menuBtn');
const notifBtn   = document.getElementById('notifBtn');
const profileBtn = document.getElementById('profileBtn');

function hideAll() {
    menuDropdown.style.display = 'none';
    notifDropdown.style.display = 'none';
    profileDropdown.style.display = 'none';
}

menuBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    hideAll();
    menuDropdown.style.display = 'block';
});

notifBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    hideAll();
    notifDropdown.style.display = 'block';
});

profileBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    hideAll();
    profileDropdown.style.display = 'block';
});

document.querySelectorAll('.notif-item').forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault(); // hentikan anchor default
        window.location.href = this.dataset.link; // 🔥 PAKSA PINDAH PAGE
    });
});
</script>
