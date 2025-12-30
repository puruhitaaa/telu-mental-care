<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Session Feedback – TelU Mental Care</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #59121A;
    --success: #2e7d32;
    --bg-gradient: linear-gradient(to bottom, #F4EDE5, #59121A);
}

* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: var(--bg-gradient);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 16px;
}

.card {
    background: #ffffff;
    width: 100%;
    max-width: 560px;
    padding: 40px 42px;
    border-radius: 24px;
    box-shadow: 0 18px 48px rgba(0,0,0,0.18);
    text-align: center;
}

h1 {
    margin: 0;
    color: var(--primary);
    font-size: 26px;
    font-weight: 700;
}

p {
    margin-top: 10px;
    margin-bottom: 28px;
    font-size: 14px;
    line-height: 1.6;
    color: #555;
}

/* ===== SUCCESS MESSAGE ===== */
.success-box {
    background: #e6f4ea;
    color: var(--success);
    padding: 16px 18px;
    border-radius: 14px;
    font-size: 14px;
    margin-bottom: 24px;
    text-align: left;
}

/* ===== FORM ===== */
textarea {
    width: 100%;
    min-height: 160px;
    padding: 16px 18px;
    border-radius: 16px;
    border: 2px solid var(--primary);
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    resize: vertical;
}

button {
    margin-top: 28px;
    width: 100%;
    padding: 15px;
    border-radius: 999px;
    background: linear-gradient(135deg, #59121A, #3f0d12);
    color: white;
    font-size: 15px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

/* ===== BACK BUTTON ===== */
.back-btn {
    display: inline-block;
    margin-top: 18px;
    font-size: 13px;
    color: #59121A;
    text-decoration: none;
    font-weight: 600;
}
</style>
</head>

<body>

<div class="card">

    <h1>Session Feedback</h1>

    @if($consultation->feedback)
    <div class="success-box">
        ✅ <strong>Feedback Submitted</strong><br>
        Thank you. Your feedback has already been sent to the counselor.
    </div>

    <a href="{{ route('student.dashboard') }}" class="back-btn">
        ← Back to Dashboard
    </a>

    @else

        <p>
            Please share your experience after completing the counseling session.
        </p>

        <form method="POST"
      action="{{ route('student.feedback.store', $consultation->id) }}">
    @csrf

            <textarea 
                name="feedback"
                placeholder="Write your feedback here..."
                required
            ></textarea>

            <button type="submit">
                Submit Feedback
            </button>
        </form>

    @endif

</div>

</body>
</html>
