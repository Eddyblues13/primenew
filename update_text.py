import re

file_path = r'c:\Users\user\primenew\resources\views\welcome.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Ndax's and NDAX's
content = re.sub(r"Ndax's", "Prime Trade Access'", content)
content = re.sub(r"NDAX's", "Prime Trade Access'", content)

# Replace Ndax and NDAX
content = re.sub(r"\bNdax\b", "Prime Trade Access", content)
content = re.sub(r"\bNDAX\b", "Prime Trade Access", content)

# Replace navbar auth links
nav_auth_old = """            <div class="nav-auth-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="login-link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="login-link">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="signup-link">Sign Up</a>
                        @endif
                    @endauth
                @endif
            </div>"""

nav_auth_new = """            <div class="nav-auth-links">
                <a href="/login" class="login-link">Login</a>
                <a href="/register" class="signup-link">Register</a>
            </div>"""

content = content.replace(nav_auth_old, nav_auth_new)

mobile_auth_old = """        <div class="mobile-auth">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="m-login">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="m-login">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="m-signup">Sign Up</a>
                    @endif
                @endauth
            @endif
        </div>"""

mobile_auth_new = """        <div class="mobile-auth">
            <a href="/login" class="m-login">Login</a>
            <a href="/register" class="m-signup">Register</a>
        </div>"""

content = content.replace(mobile_auth_old, mobile_auth_new)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Replacements complete!")
