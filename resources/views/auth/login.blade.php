<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - TelU Mental Care</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100%;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #59121A, #F5F5F5, #59121A);
            color: #59121A;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 40px 20px;
        }

        .hand-left, .hand-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 350px;
            opacity: 0.95;
        }

        .hand-left { left: 0; }
        .hand-right { right: 0; }

        .login-box {
            width: 420px;
            background: #FFFFFF;
            padding: 40px 50px;
            border-radius: 14px;
            border: 2px solid #59121A;
            text-align: center;
            z-index: 10;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .logo {
            height: 65px;
            margin-bottom: 10px;
        }

        h1 {
            margin: 10px 0;
            font-size: 32px;
            font-weight: 700;
        }

        .subtitle {
            margin-bottom: 25px;
            font-size: 16px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
            display: block;
            text-align: left;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #59121A;
            margin-bottom: 6px;
            font-size: 15px;
        }

        .error {
            color: #c70039;
            font-size: 13px;
            text-align: left;
            margin-bottom: 12px;
        }

        .login-btn {
            background-color: #59121A;
            color: #F5F5F5;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-btn:hover {
            opacity: 0.9;
        }

        .register-text {
            margin-top: 18px;
            font-size: 14px;
        }

        .register-text a {
            color: #59121A;
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .hand-left, .hand-right { display: none; }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <img src="{{ asset('assets/intro/3.png') }}" class="hand-left">
    <img src="{{ asset('assets/intro/4.png') }}" class="hand-right">

    <div class="login-box">

        <img src="{{ asset('assets/intro/TMCrb.png') }}" class="logo">
        <div style="font-weight:600; margin-bottom:20px;">TelU Mental Care</div>

        <h1>Log In</h1>
        <p class="subtitle">Sign in to access your mental health dashboard</p>

        {{-- GLOBAL ERROR --}}
        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- LOGIN FORM -->
        <form method="POST" action="{{ route('login.perform') }}">
    @csrf

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required autofocus>

    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label>Password</label>
    <input type="password" name="password" required>

    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit" class="login-btn">Log In</button>
</form>


        <div class="register-text">
            New here? <a href="{{ route('register') }}">Create an account</a>
        </div>

    </div>

</div>

</body>
</html>
