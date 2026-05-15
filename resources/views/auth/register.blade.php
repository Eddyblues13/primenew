<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up | Prime Trade Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #08060f; color: #fff; height: 100vh; overflow: hidden; display: flex; }
        
        .right-panel {
            flex: 1;
            background: radial-gradient(circle at center, #2e125c 0%, #15092a 60%, #08060f 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-panel img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            filter: drop-shadow(0 0 40px rgba(110, 40, 200, 0.4));
        }

        .activate-windows {
            position: absolute;
            bottom: 40px;
            right: 40px;
            text-align: left;
            color: rgba(255, 255, 255, 0.6);
            font-family: 'Segoe UI', system-ui, sans-serif;
            z-index: 100;
        }
        
        .activate-windows h3 {
            font-weight: 400;
            font-size: 20px;
            margin-bottom: 2px;
            color: rgba(255, 255, 255, 0.7);
        }

        .activate-windows p {
            font-size: 14px;
            font-weight: 300;
        }

        .left-panel {
            width: 100%;
            max-width: 620px;
            background: #0d0a14;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 10;
            border-top-right-radius: 36px;
            border-bottom-right-radius: 36px;
            box-shadow: 20px 0 60px rgba(0,0,0,0.6);
            overflow-y: auto;
        }
        
        /* Custom scrollbar for left panel */
        .left-panel::-webkit-scrollbar { width: 6px; }
        .left-panel::-webkit-scrollbar-track { background: transparent; }
        .left-panel::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 40px;
        }

        .logo { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            text-decoration: none; 
            color: #fff; 
            font-weight: 600; 
            font-size: 26px; 
            letter-spacing: -0.5px; 
        }

        .signup-cta { display: flex; align-items: center; gap: 16px; font-size: 13px; color: #8a8b9a; }
        .btn-signup {
            background: #2a2536;
            color: #fff;
            padding: 10px 24px;
            border-radius: 24px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: background 0.2s;
        }
        .btn-signup:hover { background: #383147; }

        .form-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px 60px;
            max-width: 100%;
            margin: 0 auto;
            width: 100%;
        }

        h1 { font-size: 42px; font-weight: 400; text-align: center; margin-bottom: 40px; letter-spacing: -0.5px; }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-group { margin-bottom: 20px; position: relative; flex: 1; }
        .form-label { display: block; font-size: 11px; font-weight: 600; color: #a4a2b3; margin-bottom: 10px; letter-spacing: 0.5px; text-transform: uppercase; }
        
        .form-input {
            width: 100%;
            background: #1c192b;
            border: 1px solid transparent;
            padding: 18px 24px;
            border-radius: 30px;
            color: #fff;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }
        .form-input:focus { outline: none; border-color: #5c4799; }
        
        /* Select Input Styling */
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%238b889a%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 24px top 50%;
            background-size: 12px auto;
            color: #fff;
        }
        .form-select option {
            background: #1c192b;
            color: #fff;
        }
        
        .eye-icon {
            position: absolute;
            right: 20px;
            top: 39px;
            color: #8b889a;
            cursor: pointer;
            width: 22px;
            height: 22px;
        }

        .btn-submit {
            width: 100%;
            background: #615e71;
            color: #1a1723;
            border: none;
            padding: 18px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: opacity 0.2s;
        }
        .btn-submit:hover { opacity: 0.9; }

        .bottom-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 40px;
            font-size: 12px;
            color: #8a8b9a;
            margin-top: auto;
        }

        .btn-help {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #2a2536;
            color: #fff;
            padding: 10px 20px;
            border-radius: 24px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
        .btn-help:hover { background: #383147; }

        /* Custom decorative scroll button middle right of screen */
        .right-nav-btn {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: bold;
            box-shadow: 0 0 10px rgba(255,255,255,0.2);
            z-index: 20;
        }

        .right-nav-btn::before {
            content: '';
            position: absolute;
            left: -8px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            box-shadow: 0 -8px 0 rgba(255,255,255,0.5), 0 8px 0 rgba(255,255,255,0.5), 0 -16px 0 rgba(255,255,255,0.5), 0 16px 0 rgba(255,255,255,0.5);
        }

        /* Mobile styling */
        @media (max-width: 900px) {
            .left-panel { max-width: 100%; border-radius: 0; box-shadow: none; }
            .right-panel { display: none; }
            .form-container { padding: 0 40px; }
            .form-row { flex-direction: column; gap: 0; }
            .top-header { padding: 20px 30px; }
            .bottom-footer { padding: 20px 30px; flex-direction: column; gap: 20px; }
            .signup-cta span { display: none; }
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <div class="top-header">
            <a href="/" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Prime Trade Access" style="height: 140px;" />
            </a>
            <div class="signup-cta">
                <span>Already have an account?</span>
                <a href="/login" class="btn-signup">Log In</a>
            </div>
        </div>

        <div class="form-container">
            <h1>Sign Up</h1>
            <form action="/register" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div style="background: rgba(255,50,50,0.1); color: #ff5252; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">FULL NAME</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">USERNAME</label>
                        <input type="text" name="username" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">EMAIL</label>
                    <input type="email" name="email" class="form-input" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">COUNTRY</label>
                        <select name="country" class="form-input form-select" required>
                            <option value="" disabled selected>Select country</option>
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="GB">United Kingdom</option>
                            <option value="AU">Australia</option>
                            <option value="DE">Germany</option>
                            <option value="FR">France</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">PHONE NUMBER</label>
                        <input type="tel" name="phone" class="form-input" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" x-data="{ show: false }">
                        <label class="form-label">PASSWORD</label>
                        <div style="position: relative;">
                            <input :type="show ? 'text' : 'password'" name="password" id="password" class="form-input" required>
                            <svg @click="show = !show" class="eye-icon" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path x-show="show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" style="display: none;" />
                            </svg>
                        </div>
                    </div>
                    <div class="form-group" x-data="{ show: false }">
                        <label class="form-label">CONFIRM PASSWORD</label>
                        <div style="position: relative;">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_conf" class="form-input" required>
                            <svg @click="show = !show" class="eye-icon" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path x-show="show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" style="display: none;" />
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Sign Up</button>
            </form>
        </div>

        <div class="bottom-footer">
            <div>© 2026 Prime Trade Access. All rights reserved.</div>
            <a href="#" class="btn-help">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd"/>
                </svg>
                Help
            </a>
        </div>
    </div>
    <div class="right-panel">
        <img src="/images/ndax_3d_illustration.png" alt="3D Illustration">
        <div class="right-nav-btn">3</div>
        <div class="activate-windows">
            <h3>Activate Windows</h3>
            <p>Go to Settings to activate Windows.</p>
        </div>
    </div>

    <script>
        function toggleEye(iconId, inputId) {
            const icon = document.getElementById(iconId);
            const input = document.getElementById(inputId);
            icon.addEventListener('click', () => {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
                } else {
                    input.type = 'password';
                    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
                }
            });
        }
        toggleEye('eye-pwd', 'password');
        toggleEye('eye-conf', 'password_conf');
    </script>
</body>
</html>
