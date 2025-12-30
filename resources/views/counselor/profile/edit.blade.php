<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Profile – Counselor</title>

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

/* ===== FORM WRAPPER ===== */
.wrapper {
    display: flex;
    justify-content: center;
    padding: 60px 0;
}

.card {
    width: 520px;
    background: #fff;
    border-radius: 22px;
    padding: 36px 40px;
    box-shadow: 0 14px 36px rgba(0,0,0,.15);
}

.card h1 {
    margin-top: 0;
}

label {
    display: block;
    margin-top: 18px;
    font-weight: 500;
}

input, textarea {
    width: 100%;
    padding: 12px 14px;
    margin-top: 6px;
    border-radius: 10px;
    border: 2px solid #59121A;
    font-family: inherit;
    font-size: 14px;
}

textarea {
    resize: none;
    height: 90px;
}

.save-btn {
    margin-top: 28px;
    width: 100%;
    background: #59121A;
    color: white;
    border: none;
    padding: 14px;
    font-size: 16px;
    border-radius: 999px;
    cursor: pointer;
}

/* ===== AVATAR ===== */
.avatar {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.avatar img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <img src="{{ asset('assets/intro/TMCrb.png') }}">
        <strong>TelU Mental Care</strong>
    </div>
</div>

<!-- CONTENT -->
<div class="wrapper">
    <div class="card">

        <div class="avatar">
    <img 
        src="{{ auth()->user()->profile_photo_path 
            ? asset('storage/' . auth()->user()->profile_photo_path)
            : asset('assets/default-avatar.png') }}"
        id="previewImage"
    >
</div>

        <h1>Edit Profile</h1>
        <p>Update your counselor information.</p>

        <!-- FORM (UI ONLY, READY BACKEND) -->
        <form 
    method="POST" 
    action="{{ route('counselor.profile.update') }}" 
    enctype="multipart/form-data"
>
    @csrf

    <label>Profile Photo</label>
    <input 
        type="file" 
        name="photo" 
        accept="image/*"
        onchange="previewPhoto(event)"
    >

    <label>Full Name</label>
    <input 
        type="text" 
        name="name"
        value="{{ auth()->user()->name }}"
        required
    >

    <label>Email</label>
    <input 
        type="email" 
        value="{{ auth()->user()->email }}" 
        readonly
    >

    <label>Phone Number</label>
<input 
    type="text" 
    name="phone" 
    value="{{ auth()->user()->phone }}"
    placeholder="e.g. 08xxxxxxxxxx"
>

    <button class="save-btn">Save Changes</button>
</form>

<script>
function previewPhoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImage').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

    </div>
</div>

</body>
</html>
