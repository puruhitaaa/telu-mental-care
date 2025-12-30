<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Profile – Student</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom, #F4EDE5, #59121A);
    min-height: 100vh;
    color: #59121A;
}
.container {
    max-width: 520px;
    margin: 60px auto;
    background: #F6EFE8;
    padding: 36px;
    border-radius: 22px;
}
.avatar {
    text-align: center;
    margin-bottom: 20px;
}
.avatar img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
}
label {
    font-size: 14px;
    font-weight: 500;
}
input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 2px solid #59121A;
    margin-bottom: 18px;
}
button {
    width: 100%;
    padding: 14px;
    border-radius: 999px;
    background: #59121A;
    color: white;
    border: none;
    font-size: 15px;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="container">
    <h2>Edit Profile</h2>

    <div class="avatar">
        <img 
            id="previewImage"
            src="{{ auth()->user()->profile_photo_path 
                ? asset('storage/' . auth()->user()->profile_photo_path)
                : asset('assets/default-avatar.png') }}"
        >
    </div>

    <form 
        method="POST" 
        action="{{ route('student.profile.update') }}" 
        enctype="multipart/form-data"
    >
        @csrf

        <label>Profile Photo</label>
        <input type="file" name="photo" accept="image/*" onchange="previewPhoto(event)">

        <label>Full Name</label>
        <input type="text" name="name" value="{{ auth()->user()->name }}" required>

        <label>Email</label>
        <input type="email" value="{{ auth()->user()->email }}" readonly>

        <label>Phone Number</label>
        <input type="text" name="phone" value="{{ auth()->user()->phone }}">

        <button>Save Changes</button>
    </form>
</div>

<script>
function previewPhoto(event) {
    const reader = new FileReader();
    reader.onload = () => {
        document.getElementById('previewImage').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
