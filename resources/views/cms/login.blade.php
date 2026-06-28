<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Admin Sign-in | Yan</title>
    <link rel="icon" href="{{ asset('icons/ico.png') }}?v={{ time() }}">
    
    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/ibm-plex-mono-3" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(17, 24, 39, 0.45);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-color: #f3f4f6;
            --text-muted: #9ca3af;
            --accent-color: #fb7185;
            --accent-hover: #f43f5e;
            --font-mono: 'IBM Plex Mono', monospace;
            --font-sans: 'Inter', sans-serif;
        }

        body.light-theme {
            --bg-color: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.45);
            --border-color: rgba(0, 0, 0, 0.08);
            --text-color: #0f172a;
            --text-muted: #64748b;
            --accent-color: #e11d48;
            --accent-hover: #be123c;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: var(--font-sans);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Glow Blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.15;
            z-index: 0;
        }
        .blob-1 {
            width: 400px;
            height: 400px;
            background-color: var(--accent-color);
            top: -100px;
            left: -100px;
        }
        .blob-2 {
            width: 500px;
            height: 500px;
            background-color: #3b82f6;
            bottom: -150px;
            right: -150px;
        }

        /* Glass Login Container */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            animation: float-in 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes float-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-japanese {
            font-family: var(--font-mono);
            font-size: 0.85rem;
            color: var(--accent-color);
            letter-spacing: 0.2em;
            display: block;
            margin-bottom: 0.25rem;
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.03em;
        }

        .login-subtitle {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
            display: block;
        }

        /* Form Controls */
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            box-sizing: border-box;
            padding: 0.85rem 1rem;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            font-family: var(--font-sans);
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }
        
        body.light-theme .form-input {
            background: rgba(255, 255, 255, 0.6);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(251, 113, 133, 0.15);
            background: rgba(0, 0, 0, 0.35);
        }
        
        body.light-theme .form-input:focus {
            background: #ffffff;
        }

        /* Buttons */
        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background: var(--accent-color);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-family: var(--font-mono);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            letter-spacing: 0.05em;
            margin-top: 0.5rem;
            box-shadow: 0 4px 12px rgba(251, 113, 133, 0.25);
        }

        .btn-submit:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(251, 113, 133, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Alerts */
        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            padding: 0.8rem 1rem;
            color: #f87171;
            font-size: 0.8rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-mono);
        }
        
        body.light-theme .alert-error {
            color: #dc2626;
            background: rgba(239, 68, 68, 0.08);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.25s ease;
        }

        .back-link:hover {
            color: var(--accent-color);
        }
    </style>
</head>
<body>
    <!-- Theme Script -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.body.classList.remove('light-theme');
            } else {
                document.body.classList.add('light-theme');
            }
        })();
    </script>

    <!-- Glowing Background blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- Login Box -->
    <div class="login-container" id="login-container">
        <div class="login-header">
            <span class="login-japanese">「システムログイン」</span>
            <h1 class="login-title">ADMIN CMS</h1>
            <span class="login-subtitle">Yan Portfolio Manager</span>
        </div>

        @if ($errors->any())
            <div class="alert-error" id="login-error-alert">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ url('cms/login') }}" method="POST" id="login-form">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <div class="input-wrapper">
                    <input type="text" id="username" name="username" class="form-input" required autocomplete="username" placeholder="Enter admin username" value="{{ old('username') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-input" required autocomplete="current-password" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn-submit" id="btn-login-submit">SIGN IN</button>
        </form>

        <a href="{{ url('/') }}" class="back-link" id="link-back-to-site">← Back to Portfolio</a>
    </div>
</body>
</html>
