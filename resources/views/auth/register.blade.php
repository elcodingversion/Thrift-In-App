<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift-In - Register</title>
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
            margin-bottom: var(--spacing-md);
            text-align: center;
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

        .form-group {
            margin-bottom: 14px; /* Slightly tighter for register to fit 4 fields */
        }

        .form-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 12px var(--spacing-sm);
            border: 2px solid var(--sage-border);
            border-radius: var(--radius);
            font-size: 14.5px;
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

        .form-footer {
            margin-top: 20px;
        }

        .submit-button {
            width: 100%;
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
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Sidebar -->
        <div class="login-sidebar">
            <div class="brand-logo">Thrift-In</div>
            <p class="brand-tagline">Join our community of sustainable fashion lovers</p>
            <div class="illustration">
                <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="80" fill="#6E7C6F" opacity="0.2"/>
                    <!-- A slightly different icon representing a user profile / joining -->
                    <circle cx="100" cy="75" r="25" fill="#2F2F2F" opacity="0.7"/>
                    <path d="M50 145 C50 115 150 115 150 145 L150 150 L50 150 Z" fill="#2F2F2F" opacity="0.7"/>
                </svg>
            </div>
        </div>

        <!-- Form Section -->
        <div class="login-form-section">
            <div class="form-header">
                <h1 class="form-title">Create Account</h1>
                <p class="form-subtitle">Sign up to start your thrifting journey</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input 
                        id="name" 
                        class="form-input" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Your full name"
                        required 
                        autofocus 
                        autocomplete="name"
                    />
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

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
                        placeholder="Create a password"
                        required 
                        autocomplete="new-password"
                    />
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input 
                        id="password_confirmation" 
                        class="form-input"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required 
                        autocomplete="new-password"
                    />
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="submit-button">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>

            <div class="register-link">
                Already have an account? <a href="{{ route('login') }}">Log in</a>
            </div>
        </div>
    </div>
</body>
</html>
