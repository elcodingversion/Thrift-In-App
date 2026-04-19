<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift-In - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sage-primary: #C9D9C3;
            --sage-secondary: #B7C8B5;
            --sage-dark: #6E7C6F;
            --sage-border: #E6EEE4;
            --cream-bg: #F6F5F2;
            --charcoal: #2F2F2F;
            --white: #FFFFFF;
            --soft-yellow: #F5E6B8;
            --soft-red: #F4D4D4;
            --spacing-xs: 8px;
            --spacing-sm: 16px;
            --spacing-md: 24px;
            --spacing-lg: 32px;
            --radius: 12px;
            --shadow-sm: 0 2px 8px rgba(110, 124, 111, 0.08);
            --shadow-md: 0 4px 16px rgba(110, 124, 111, 0.12);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--cream-bg) 0%, #E8F1E5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-md);
        }

        .login-container {
            display: flex;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .login-sidebar {
            background: linear-gradient(165deg, var(--sage-primary) 0%, var(--sage-secondary) 100%);
            padding: var(--spacing-lg);
            width: 45%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-sidebar::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .login-sidebar::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -80px;
            left: -80px;
        }

        .brand-logo {
            font-size: 42px;
            font-weight: 800;
            color: var(--charcoal);
            margin-bottom: var(--spacing-sm);
            z-index: 1;
            letter-spacing: -1px;
        }

        .brand-tagline {
            font-size: 16px;
            color: var(--sage-dark);
            line-height: 1.6;
            z-index: 1;
            max-width: 280px;
        }

        .illustration {
            margin-top: var(--spacing-lg);
            z-index: 1;
        }

        .illustration svg {
            width: 180px;
            height: 180px;
            opacity: 0.9;
        }

        .login-form-section {
            padding: var(--spacing-lg) 48px;
            width: 55%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: var(--spacing-lg);
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: var(--spacing-xs);
        }

        .form-subtitle {
            font-size: 14px;
            color: var(--sage-dark);
        }

        .status-message {
            background: var(--soft-yellow);
            color: var(--charcoal);
            padding: var(--spacing-sm);
            border-radius: var(--radius);
            margin-bottom: var(--spacing-md);
            font-size: 14px;
            border-left: 4px solid #D4A017;
        }

        .form-group {
            margin-bottom: var(--spacing-md);
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: var(--spacing-xs);
        }

        .form-input {
            width: 100%;
            padding: 14px var(--spacing-sm);
            border: 2px solid var(--sage-border);
            border-radius: var(--radius);
            font-size: 15px;
            color: var(--charcoal);
            background: var(--white);
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--sage-primary);
            box-shadow: 0 0 0 4px rgba(201, 217, 195, 0.15);
        }

        .form-input::placeholder {
            color: #999;
        }

        .error-message {
            color: #d32f2f;
            font-size: 13px;
            margin-top: var(--spacing-xs);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: var(--spacing-md);
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            border: 2px solid var(--sage-border);
            border-radius: 4px;
            cursor: pointer;
            accent-color: var(--sage-primary);
        }

        .checkbox-label {
            margin-left: var(--spacing-xs);
            font-size: 14px;
            color: var(--charcoal);
            cursor: pointer;
            user-select: none;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: var(--spacing-sm);
            gap: var(--spacing-sm);
        }

        .forgot-link {
            color: var(--sage-dark);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--sage-primary);
        }

        .submit-button {
            background: var(--sage-primary);
            color: var(--charcoal);
            padding: 14px var(--spacing-lg);
            border: none;
            border-radius: var(--radius);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            font-family: inherit;
        }

        .submit-button:hover {
            background: var(--sage-secondary);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: var(--spacing-lg);
            font-size: 14px;
            color: var(--sage-dark);
        }

        .register-link a {
            color: var(--sage-dark);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-sidebar {
                width: 100%;
                padding: var(--spacing-lg) var(--spacing-md);
            }

            .login-form-section {
                width: 100%;
                padding: var(--spacing-lg) var(--spacing-md);
            }

            .form-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .submit-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Sidebar -->
        <div class="login-sidebar">
            <div class="brand-logo">Thrift-In</div>
            <p class="brand-tagline">Discover sustainable fashion treasures and give pre-loved items a new story</p>
            <div class="illustration">
                <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="80" fill="#6E7C6F" opacity="0.2"/>
                    <path d="M70 80 L130 80 L140 120 L60 120 Z" fill="#2F2F2F" opacity="0.7"/>
                    <circle cx="100" cy="60" r="20" fill="#2F2F2F" opacity="0.7"/>
                    <rect x="85" y="120" width="30" height="40" rx="5" fill="#2F2F2F" opacity="0.7"/>
                </svg>
            </div>
        </div>

        <!-- Form Section -->
        <div class="login-form-section">
            <div class="form-header">
                <h1 class="form-title">Welcome Back</h1>
                <p class="form-subtitle">Sign in to continue your thrifting journey</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input 
                        id="email" 
                        class="form-input" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="you@example.com"
                        required 
                        autofocus 
                        autocomplete="username"
                    />
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input 
                        id="password" 
                        class="form-input"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required 
                        autocomplete="current-password"
                    />
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox-group">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        class="checkbox-input" 
                        name="remember"
                    />
                    <label for="remember_me" class="checkbox-label">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="submit-button">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

            <div class="register-link">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        </div>
    </div>
</body>
</html>