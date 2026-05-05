<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Something Went Wrong | Prime Trade Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #08060f;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.3; animation: float 8s ease-in-out infinite; }
        .orb-1 { width: 400px; height: 400px; background: #EF4444; top: -100px; left: -100px; }
        .orb-2 { width: 300px; height: 300px; background: #7C3AED; bottom: -80px; right: -80px; animation-delay: 3s; }
        @keyframes float { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-30px) scale(1.05); } }
        .container { text-align: center; z-index: 10; padding: 40px; max-width: 600px; }
        .error-code { font-size: 140px; font-weight: 800; background: linear-gradient(135deg, #EF4444, #7C3AED); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1; margin-bottom: 8px; }
        .emoji { font-size: 64px; margin-bottom: 20px; animation: spin 4s ease-in-out infinite; }
        @keyframes spin { 0%, 100% { transform: rotate(0deg); } 25% { transform: rotate(10deg); } 75% { transform: rotate(-10deg); } }
        h1 { font-size: 28px; font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px; }
        p { font-size: 16px; color: #8a8b9a; line-height: 1.6; margin-bottom: 32px; }
        .btn-group { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px; border-radius: 30px; font-size: 15px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none; }
        .btn-primary { background: linear-gradient(135deg, #EF4444, #7C3AED); color: #fff; box-shadow: 0 4px 20px rgba(239, 68, 68, 0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(239, 68, 68, 0.5); }
        .btn-secondary { background: rgba(255,255,255,0.06); color: #fff; border: 1px solid rgba(255,255,255,0.1); }
        .btn-secondary:hover { background: rgba(255,255,255,0.1); transform: translateY(-2px); }
        .logo-link { position: absolute; top: 30px; left: 30px; display: flex; align-items: center; gap: 10px; text-decoration: none; color: #fff; font-weight: 700; font-size: 18px; z-index: 10; }
        .logo-link img { height: 32px; }
        @media (max-width: 600px) { .error-code { font-size: 100px; } h1 { font-size: 22px; } .container { padding: 20px; } }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <a href="/" class="logo-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
        Prime Trade Access
    </a>

    <div class="container">
        <div class="emoji">⚙️</div>
        <div class="error-code">500</div>
        <h1>Something went wrong on our end</h1>
        <p>We're experiencing a temporary hiccup. Our team has been notified and is working on it. Please try again in a moment!</p>
        <div class="btn-group">
            <a href="/" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Go Home
            </a>
            <a href="javascript:location.reload()" class="btn btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                Try Again
            </a>
        </div>
    </div>
</body>
</html>
