<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TelU Mental Care</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    width: 100%;
    font-family: 'Inter', sans-serif;
    color: #4A1A20;
    background: linear-gradient(to bottom, #F7EFEA, #D8B6B0);
}

        .page-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .form-section {
    width: 55%;
    padding: 60px 80px;
    background: rgba(255,255,255,0.35);
    backdrop-filter: blur(6px);
}

        h2.title {
            font-size: 27px;
            margin: 5px 0 28px;
            font-weight: 700;
        }

        label {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #6A2A32;
}

        input, select {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1.5px solid #C9A3A8;
    margin-bottom: 20px;
    font-size: 15px;
    background: rgba(255,255,255,0.85);
    color: #3A0D12;
}

input:focus, select:focus {
    outline: none;
    border-color: #8B3A42;
    background: #fff;
}

        /* ==============================
           FIX FIRST NAME - LAST NAME GAP
           ============================== */
        .row {
            display: flex;
            gap: 30px;            /* jarak antar input */
            margin-bottom: 10px;  /* jarak bawah row */
        }

        .col {
            width: 100%;
        }

        /* ==============================
           FIX SELECT ROLE (NATIVE)
           ============================== */
        .role-container {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        .role-container label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            padding: 0;
            font-size: 20px;
            font-weight: 600;
            line-height: 1;
            cursor: pointer;
        }

        .role-container input[type="radio"] {
            margin: 0;
            width: 18px;
            height: 18px;
            accent-color: #59121A;
        }

        .register-btn {
            background-color: #59121A;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            cursor: pointer;
        }

        .image-section {
            width: 45%;
            background-image: url('{{ asset('assets/intro/2.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <div class="form-section">

        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 35px;">
            <img src="{{ asset('assets/intro/TMCrb.png') }}" style="width: 60px;">
            <h2 style="margin: 0; font-size: 28px; font-weight: 700;">TelU Mental Care</h2>
        </div>

        <h2 class="title">Create Your TelU Mental Care Account</h2>

        <form action="{{ route('register.store') }}" method="POST">
    @csrf

    <!-- FIRST NAME + LAST NAME -->
    <div class="row">
        <div class="col">
            <label>First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required>
            @error('first_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="col">
            <label>Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required>
            @error('last_name') <div class="error">{{ $message }}</div> @enderror
        </div>
    </div>

    <label>Age</label>
    <select name="age" required>
        @for ($i = 15; $i <= 60; $i++)
            <option value="{{ $i }}" {{ old('age') == $i ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor
    </select>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <div class="error">{{ $message }}</div> @enderror

    <label>Password</label>
    <input type="password" name="password" required>
    @error('password') <div class="error">{{ $message }}</div> @enderror

    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" required>

    <label>Phone Number</label>
    <input type="text" name="phone" value="{{ old('phone') }}" required>

    <label>Select Role</label>
    <div class="role-container">
        <label>
            <input type="radio" name="role" value="student" {{ old('role') == 'student' ? 'checked' : '' }}>
            Student
        </label>
        <label>
            <input type="radio" name="role" value="counselor" {{ old('role') == 'counselor' ? 'checked' : '' }}>
            Counselor
        </label>
    </div>
    @error('role') <div class="error">{{ $message }}</div> @enderror

    <button type="submit" class="register-btn">Register</button>
</form>


    </div>

    <div class="image-section"></div>

</div>

</body>
</html>
