<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Under Maintenance | Prime Trade Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:#08060f;color:#fff;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative}
        .orb{position:absolute;border-radius:50%;filter:blur(80px);opacity:.3;animation:float 8s ease-in-out infinite}
        .orb-1{width:400px;height:400px;background:#10B981;top:-100px;left:-100px}
        .orb-2{width:300px;height:300px;background:#06B6D4;bottom:-80px;right:-80px;animation-delay:3s}
        @keyframes float{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-30px) scale(1.05)}}
        .container{text-align:center;z-index:10;padding:40px;max-width:600px}
        .error-code{font-size:140px;font-weight:800;background:linear-gradient(135deg,#10B981,#06B6D4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1;margin-bottom:8px}
        .emoji{font-size:64px;margin-bottom:20px;animation:wrench 3s ease-in-out infinite}
        @keyframes wrench{0%,100%{transform:rotate(0deg)}25%{transform:rotate(20deg)}75%{transform:rotate(-20deg)}}
        h1{font-size:28px;font-weight:700;margin-bottom:12px}
        p{font-size:16px;color:#8a8b9a;line-height:1.6;margin-bottom:32px}
        .btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;border-radius:30px;font-size:15px;font-weight:600;text-decoration:none;transition:all .3s ease;border:none;cursor:pointer;background:linear-gradient(135deg,#10B981,#06B6D4);color:#fff;box-shadow:0 4px 20px rgba(16,185,129,.3)}
        .btn:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(16,185,129,.5)}
        .logo-link{position:absolute;top:30px;left:30px;display:flex;align-items:center;gap:10px;text-decoration:none;color:#fff;font-weight:700;font-size:18px;z-index:10}
        .logo-link img{height:32px}
        .progress-bar{width:200px;height:4px;background:rgba(255,255,255,.1);border-radius:4px;margin:0 auto 32px;overflow:hidden}
        .progress-fill{height:100%;width:60%;background:linear-gradient(90deg,#10B981,#06B6D4);border-radius:4px;animation:loading 2s ease-in-out infinite}
        @keyframes loading{0%{transform:translateX(-100%)}100%{transform:translateX(250%)}}
        @media(max-width:600px){.error-code{font-size:100px}h1{font-size:22px}.container{padding:20px}}
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <a href="/" class="logo-link"><img src="{{ asset('images/logo.png') }}" alt="Logo"/>Prime Trade Access</a>
    <div class="container">
        <div class="emoji">🔧</div>
        <div class="error-code">503</div>
        <h1>We're sprucing things up!</h1>
        <p>Prime Trade Access is currently undergoing scheduled maintenance. We'll be back shortly with an even better experience. Thank you for your patience!</p>
        <div class="progress-bar"><div class="progress-fill"></div></div>
        <a href="javascript:location.reload()" class="btn">Check Again</a>
    </div>
</body>
</html>
