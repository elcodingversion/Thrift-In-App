<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift-In | Elevate Your Style Sustainably</title>
    
    <!-- Google Fonts: Plus Jakarta Sans for Modern Gen-Z Look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ================================================
           CSS VARIABLES (Sage Minimalist + High Contrast)
           ================================================ */
        :root {
            --sage-primary: #C9D9C3;
            --sage-secondary: #B7C8B5;
            --sage-dark: #6E7C6F;
            --sage-border: #E6EEE4;
            --cream-bg: #FDFBF7;
            --charcoal: #1C1C1A;
            --white: #FFFFFF;
            
            --spacing-xs: 8px;
            --spacing-sm: 16px;
            --spacing-md: 24px;
            --spacing-lg: 40px;
            --spacing-xl: 80px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-full: 9999px;
            
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--cream-bg);
            color: var(--charcoal);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ================================================
           NAVBAR (Glassmorphism)
           ================================================ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 16px 5%;
            z-index: 1000;
            background: rgba(253, 251, 247, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(230, 238, 228, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition-smooth);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--charcoal);
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -0.5px;
        }

        .nav-brand img {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: var(--spacing-sm);
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border-radius: var(--radius-full);
            transition: var(--transition-smooth);
            cursor: pointer;
            border: none;
        }

        .btn-outline {
            background: transparent;
            color: var(--charcoal);
            border: 2px solid var(--sage-border);
        }

        .btn-outline:hover {
            border-color: var(--charcoal);
        }

        .btn-primary {
            background: var(--charcoal);
            color: var(--white);
            border: 2px solid var(--charcoal);
            box-shadow: 0 8px 24px rgba(28, 28, 26, 0.15);
        }

        .btn-primary:hover {
            background: #2D2D2A;
            border-color: #2D2D2A;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(28, 28, 26, 0.25);
        }

        /* ================================================
           HERO SECTION
           ================================================ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: calc(80px + var(--spacing-xl)) 5% var(--spacing-xl);
            position: relative;
            overflow: hidden;
        }

        /* Decorative Background Blob */
        .hero-blob {
            position: absolute;
            top: 10%;
            right: -10%;
            width: 70vw;
            height: 70vw;
            max-width: 800px;
            max-height: 800px;
            background: radial-gradient(circle, var(--sage-primary) 0%, rgba(201,217,195,0) 70%);
            opacity: 0.5;
            z-index: -1;
            border-radius: 50%;
            filter: blur(60px);
            animation: float 10s ease-in-out infinite;
        }

        .hero-blob-2 {
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            max-width: 600px;
            max-height: 600px;
            background: radial-gradient(circle, var(--sage-secondary) 0%, rgba(183,200,181,0) 70%);
            opacity: 0.3;
            z-index: -1;
            border-radius: 50%;
            filter: blur(40px);
            animation: float 14s ease-in-out infinite reverse;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: var(--spacing-xl);
            align-items: center;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-text {
            animation: slideUpFade 0.8s ease-out forwards;
        }

        .badge-new {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            border: 1px solid var(--sage-border);
            padding: 8px 16px;
            border-radius: var(--radius-full);
            font-size: 13px;
            font-weight: 600;
            color: var(--sage-dark);
            margin-bottom: var(--spacing-md);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .badge-new span.dot {
            width: 8px;
            height: 8px;
            background: var(--sage-dark);
            border-radius: 50%;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        .hero-title {
            font-size: clamp(3rem, 6vw, 5.5rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
            margin-bottom: var(--spacing-md);
            color: var(--charcoal);
        }

        .hero-title span {
            color: var(--sage-dark);
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 8%;
            left: 0;
            width: 100%;
            height: 30%;
            background: var(--sage-primary);
            z-index: -1;
            transform: skewX(-15deg);
            opacity: 0.4;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #5A5A55;
            margin-bottom: var(--spacing-lg);
            max-width: 90%;
            font-weight: 400;
        }

        .hero-actions {
            display: flex;
            gap: var(--spacing-sm);
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-large {
            padding: 18px 40px;
            font-size: 17px;
            border-radius: var(--radius-full);
        }

        .hero-visual {
            position: relative;
            animation: fadeIn 1s ease-out 0.3s forwards;
            opacity: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .visual-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 24px 64px rgba(110, 124, 111, 0.15);
            transform: rotate(3deg);
            transition: var(--transition-smooth);
            width: 100%;
            max-width: 480px;
            aspect-ratio: 4/5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .visual-card:hover {
            transform: rotate(0deg) translateY(-10px);
            box-shadow: 0 32px 80px rgba(110, 124, 111, 0.2);
        }

        .visual-card img {
            width: 60%;
            max-width: 250px;
            height: auto;
            object-fit: contain;
            margin-bottom: 20px;
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));
        }
        
        .visual-badge {
            position: absolute;
            background: var(--charcoal);
            color: var(--white);
            padding: 12px 24px;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 12px 32px rgba(28,28,26,0.3);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-top {
            top: -20px;
            right: 20px;
            animation: float-fast 4s ease-in-out infinite;
        }

        .badge-bottom {
            bottom: 40px;
            left: -30px;
            background: var(--white);
            color: var(--charcoal);
            animation: float-fast 5s ease-in-out infinite reverse;
        }

        .badge-bottom i {
            color: var(--sage-dark);
        }

        /* ================================================
           FEATURES SECTION
           ================================================ */
        .features {
            padding: var(--spacing-xl) 5%;
            background: var(--white);
            position: relative;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-lg);
            max-width: 1280px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--cream-bg);
            border: 1px solid var(--sage-border);
            padding: 40px 32px;
            border-radius: var(--radius-lg);
            transition: var(--transition-smooth);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(110, 124, 111, 0.1);
            background: var(--white);
            border-color: var(--sage-secondary);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            background: var(--sage-primary);
            color: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            border-radius: 20px;
            margin-bottom: 24px;
            transform: rotate(-5deg);
            transition: var(--transition-smooth);
        }

        .feature-card:hover .feature-icon {
            transform: rotate(0deg) scale(1.1);
            background: var(--charcoal);
            color: var(--white);
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--charcoal);
            letter-spacing: -0.5px;
        }

        .feature-desc {
            color: #5A5A55;
            line-height: 1.7;
        }

        /* ================================================
           FOOTER
           ================================================ */
        .footer {
            padding: var(--spacing-lg) 5%;
            text-align: center;
            border-top: 1px solid var(--sage-border);
            background: var(--cream-bg);
        }

        .footer p {
            color: #8C8C85;
            font-size: 14px;
            font-weight: 500;
        }

        /* ================================================
           ANIMATIONS & RESPONSIVE
           ================================================ */
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        @keyframes float-fast {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(110, 124, 111, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(110, 124, 111, 0); }
            100% { box-shadow: 0 0 0 0 rgba(110, 124, 111, 0); }
        }

        @media (max-width: 992px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 60px;
            }
            .hero-actions {
                justify-content: center;
            }
            .hero-title {
                font-size: 3.5rem;
            }
            .hero-subtitle {
                margin: 0 auto 32px auto;
            }
            .visual-card {
                transform: rotate(0deg);
                aspect-ratio: auto;
                padding: 60px 40px;
            }
        }

        @media (max-width: 640px) {
            .hero {
                padding-top: 120px;
            }
            .hero-title {
                font-size: 2.8rem;
            }
            .nav-brand span {
                display: none; /* Hide text on small screens, show only logo */
            }
            .btn-large {
                width: 100%;
                padding: 16px 20px;
            }
            .nav-links .btn-outline {
                display: none; /* Simplify mobile nav */
            }
            .badge-bottom {
                left: 10px;
                bottom: 20px;
            }
            .badge-top {
                right: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="{{ route('landing') }}" class="nav-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Thrift-In Logo">
            <span>Thrift-In</span>
        </a>
        <div class="nav-links">
            <a href="{{ route('katalog.index') }}" class="btn btn-outline"><i class="fas fa-search"></i> Jelajahi</a>
            
            @auth
                @can('admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('customer.klaim.index') }}" class="btn btn-primary">Profil Saya</a>
                @endcan
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="border-radius: 50px; padding: 10px 20px; font-size: 14px;">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <main class="hero">
        <div class="hero-blob"></div>
        <div class="hero-blob-2"></div>
        
        <div class="hero-content">
            <div class="hero-text">
                <div class="badge-new">
                    <span class="dot"></span> Platform Thrift Kekinian
                </div>
                <!-- Gen-Z bold catchy headline -->
                <h1 class="hero-title">
                    Thrift the Best.<br>
                    Leave the <span>Rest.</span>
                </h1>
                <p class="hero-subtitle">
                    Temukan koleksi *preloved* eksklusif dengan kualitas kurasi terbaik. Tampil gaya tidak harus merusak bumi, dan pastinya ramah di kantong.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('katalog.index') }}" class="btn btn-primary btn-large">
                        Mulai Belanja <i class="fas fa-arrow-right" style="margin-left: 4px;"></i>
                    </a>
                    <a href="#features" class="btn btn-outline btn-large">
                        Kenapa Thrift-In?
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <!-- Aesthetic visual card -->
                <div class="visual-card">
                    <div class="visual-badge badge-top">
                        <i class="fas fa-star" style="color: #FBBF24;"></i> Premium Curated
                    </div>
                    <img src="{{ asset('images/logo.png') }}" alt="Thrift-In Illustration">
                    <h3 style="font-size: 24px; font-weight: 800; color: var(--charcoal); margin-bottom: 8px;">Elevate Your Style</h3>
                    <p style="color: var(--sage-dark); text-align: center; font-size: 14px; font-weight: 500;">Sustainable fashion for the conscious generation.</p>
                    
                    <div class="visual-badge badge-bottom">
                        <i class="fas fa-tags"></i> Harga Terbaik
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FEATURES SECTION -->
    <section id="features" class="features">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="feature-title">Eco-Friendly</h3>
                <p class="feature-desc">Memilih baju *thrift* berarti kamu ikut menyelamatkan bumi dari limbah *fast fashion*. Gaya maksimal, jejak karbon minimal.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h3 class="feature-title">Premium Brands</h3>
                <p class="feature-desc">Semua barang di Thrift-In melalui proses kurasi yang ketat. Dapatkan *brand* terkenal internasional dengan kondisi seperti baru.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="feature-title">Best Price</h3>
                <p class="feature-desc">Tampil elegan tidak harus mahal. Dapatkan *outfit* kekinian dengan harga yang jauh di bawah harga *retail* resmi.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Thrift-In. All rights reserved. Crafted for Gen-Z.</p>
    </footer>

    <!-- Smooth Scrolling Script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
