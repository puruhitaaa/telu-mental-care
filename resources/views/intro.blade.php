<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TelU Mental Care - Intro</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100%;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #F5F5F5, #59121A);
            color: #59121A;
            overflow-x: hidden;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 25px 40px;
        }

        .logo img {
            height: 45px;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px 60px;
            width: 100%;
            box-sizing: border-box;
        }

        .left-content {
            max-width: 50%;
        }

        .left-content h1 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .left-content p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 15px;
            font-weight: 400;
        }

        .login-btn a {
            background-color: #59121A;
            color: #F5F5F5;
            padding: 12px 35px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 12px;
            display: inline-block;
            margin-top: 20px;
            font-weight: 500;
        }

        .login-btn a:hover {
            opacity: 0.85;
        }

        .right-image img {
            height: 440px;
            object-fit: contain;
        }

        /* RESPONSIVE */
        @media (max-width: 950px) {
            .container {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .left-content {
                max-width: 100%;
            }

            .right-image img {
                height: 300px;
                margin-top: 40px;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <!-- LOGO TOP -->
    <div class="logo">
        <img src="{{ asset('assets/intro/TMCrb.png') }}" alt="TelU Logo">
        <span style="font-size: 20px; font-weight: 600;">TelU Mental Care</span>
    </div>

    <!-- CONTENT AREA -->
    <div class="container">

        <div class="left-content">
            <h1>Hi, Mahasiswa TelU!</h1>

            <p>TelU Mental Care adalah ruang aman untuk membantu kamu memahami mood dan stres harian.</p>

            <p>Di sini, kamu bisa mencatat perasaanmu, melihat progres, dan terhubung dengan konselor kampus yang siap mendukungmu.</p>

            <p>Yuk, login dan mulai perjalanan well-being kamu.</p>

            <div class="login-btn">
                <a href="{{ url('/login') }}">Log In</a>
            </div>
        </div>

        <div class="right-image">
            <img src="{{ asset('assets/intro/1.png') }}" alt="Reflection Illustration">
        </div>

    </div>

</div>

</body>
</html>
