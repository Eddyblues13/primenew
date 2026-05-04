<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Log in | Prime Trade Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 480px;
            background: #0d0a14;
            padding: 60px 50px;
            border-radius: 24px;
            box-shadow: 0 0 50px rgba(160, 113, 255, 0.1);
            border: 1px solid rgba(160, 113, 255, 0.2);
            position: relative;
            z-index: 10;
        }

        .logo { 
            display: flex; 
            align-items: center; 
            justify-content: center;
            gap: 12px; 
            text-decoration: none; 
            color: #fff; 
            font-weight: 600; 
            font-size: 26px; 
            letter-spacing: -0.5px; 
            margin-bottom: 40px;
        }

        h1 { font-size: 32px; font-weight: 400; text-align: center; margin-bottom: 40px; letter-spacing: -0.5px; }

        .form-group { margin-bottom: 24px; position: relative; }
        .form-label { display: block; font-size: 11px; font-weight: 600; color: #a4a2b3; margin-bottom: 12px; letter-spacing: 0.5px; text-transform: uppercase; }
        
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-input {
            width: 100%;
            background: #1c192b;
            border: 1px solid transparent;
            padding: 18px 24px;
            border-radius: 12px;
            color: #fff;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }
        .password-wrapper .form-input {
            padding-right: 54px;
        }
        .form-input:focus { outline: none; border-color: #5c4799; }

        .eye-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 22px;
            height: 22px;
            color: #a4a2b3;
            cursor: pointer;
            flex-shrink: 0;
            transition: color 0.2s;
        }
        .eye-icon:hover { color: #a071ff; }
        
        .btn-submit {
            width: 100%;
            background: #a071ff;
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: opacity 0.2s, background 0.2s;
        }
        .btn-submit:hover { background: #b48eff; }

        /* ── Mobile Responsive ── */
        @media (max-width: 540px) {
            .container {
                padding: 40px 24px;
                border-radius: 18px;
            }
            .logo {
                font-size: 20px;
                gap: 8px;
                margin-bottom: 28px;
            }
            h1 {
                font-size: 24px;
                margin-bottom: 28px;
            }
            .form-input {
                padding: 15px 18px;
                font-size: 14px;
            }
            .password-wrapper .form-input {
                padding-right: 48px;
            }
            .eye-icon {
                right: 14px;
                width: 20px;
                height: 20px;
            }
            .btn-submit {
                padding: 15px;
                font-size: 15px;
            }
        }

        @media (max-width: 380px) {
            .container {
                padding: 32px 18px;
            }
            .logo {
                font-size: 17px;
                flex-wrap: wrap;
                justify-content: center;
            }
            h1 {
                font-size: 21px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="logo">
            <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                <rect x="4" y="8" width="6" height="18" fill="#a071ff" rx="1"/>
                <rect x="18" y="6" width="6" height="18" fill="#42a5f5" rx="1"/>
                <path d="M4 10 L22 22 L18 24 L2 12 Z" fill="#66bb6a" />
            </svg>
            Prime Trade Access Admin
        </a>

        <h1>Admin Log in</h1>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div style="background: rgba(255,50,50,0.1); color: #ff5252; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required>
            </div>
            <div class="form-group" x-data="{ show: false }">
                <label class="form-label">PASSWORD</label>
                <div class="password-wrapper">
                    <input :type="show ? 'text' : 'password'" name="password" id="password" class="form-input" required>
                    <svg @click="show = !show" class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        <path x-show="show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" style="display: none;" />
                    </svg>
                </div>
            </div>
            <button type="submit" class="btn-submit">Log In</button>
        </form>
    </div>
</body>
</html>
