<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->nama_item }} - Detail Produk</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--cream-bg);
            color: var(--charcoal);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* NAVBAR (Identical to Landing/Catalog) */
        .navbar {
            position: fixed;
            top: 0; left: 0; width: 100%; padding: 16px 5%;
            z-index: 1000;
            background: rgba(253, 251, 247, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(230, 238, 228, 0.5);
            display: flex; justify-content: space-between; align-items: center;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none; color: var(--charcoal);
            font-weight: 800; font-size: 22px; letter-spacing: -0.5px;
        }
        .nav-brand img { height: 38px; width: auto; object-fit: contain; }
        .nav-links { display: flex; gap: var(--spacing-sm); align-items: center; }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            gap: 8px; padding: 12px 24px; font-size: 15px; font-weight: 600;
            text-decoration: none; border-radius: var(--radius-full);
            transition: var(--transition-smooth); cursor: pointer; border: none;
        }
        .btn-outline { background: transparent; color: var(--charcoal); border: 2px solid var(--sage-border); }
        .btn-outline:hover { border-color: var(--charcoal); }
        .btn-primary { background: var(--charcoal); color: var(--white); }
        .btn-primary:hover { background: #2D2D2A; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(28,28,26,0.2); }

        /* BREADCRUMBS */
        .breadcrumbs {
            margin-top: 100px;
            padding: 0 5%;
            max-width: 1400px;
            margin-left: auto; margin-right: auto;
            font-size: 14px;
            font-weight: 600;
            color: var(--sage-dark);
            display: flex; align-items: center; gap: 8px;
        }
        .breadcrumbs a { color: var(--charcoal); text-decoration: none; transition: var(--transition-smooth); }
        .breadcrumbs a:hover { color: var(--sage-dark); }
        .breadcrumbs span { color: var(--sage-dark); }

        /* ITEM LAYOUT */
        .item-container {
            max-width: 1400px; margin: var(--spacing-md) auto var(--spacing-xl);
            padding: 0 5%;
        }
        
        .item-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            align-items: start;
        }

        /* IMAGE GALLERY AREA */
        .image-showcase {
            background: var(--white);
            border-radius: 32px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 4/5;
            box-shadow: 0 24px 64px rgba(110, 124, 111, 0.08);
            border: 1px solid var(--sage-border);
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        
        .category-floating-badge {
            position: absolute;
            bottom: 30px; left: 30px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            padding: 10px 20px;
            border-radius: var(--radius-full);
            font-size: 13px; font-weight: 700;
            color: var(--charcoal);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        /* PRODUCT INFO AREA */
        .info-panel {
            position: sticky;
            top: 120px;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
        }

        .item-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            color: var(--charcoal);
        }

        .item-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--sage-dark);
            margin-bottom: var(--spacing-xs);
        }

        .specs-grid {
            display: flex;
            gap: 12px;
            margin-bottom: var(--spacing-sm);
        }
        
        .spec-pill {
            background: var(--white);
            border: 1px solid var(--sage-border);
            padding: 12px 20px;
            border-radius: var(--radius-md);
            display: flex; flex-direction: column; gap: 4px;
            flex: 1;
        }
        .spec-pill .label { font-size: 12px; font-weight: 600; color: var(--sage-dark); text-transform: uppercase; letter-spacing: 0.5px; }
        .spec-pill .val { font-size: 16px; font-weight: 700; color: var(--charcoal); }

        .desc-box {
            background: var(--white);
            border: 1px solid var(--sage-border);
            border-radius: var(--radius-lg);
            padding: 24px;
            line-height: 1.8;
            color: #5A5A55;
            font-size: 15px;
            margin-bottom: var(--spacing-md);
        }
        .desc-box h3 { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: var(--charcoal); margin-bottom: 12px; font-weight: 800; }

        .status-box {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px;
            background: var(--sage-primary);
            border-radius: var(--radius-md);
            font-weight: 700;
        }
        .status-box.unavailable { background: var(--sage-border); color: #8C8C85; }

        .btn-claim {
            width: 100%;
            padding: 20px;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: var(--charcoal);
            color: var(--white);
            border: none; border-radius: var(--radius-full);
            font-weight: 800; cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: 0 12px 32px rgba(28,28,26,0.2);
        }
        .btn-claim:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(28,28,26,0.3);
        }
        
        .btn-claim-secondary {
            background: var(--sage-dark);
            box-shadow: 0 8px 24px rgba(110, 124, 111, 0.4);
        }

        .alert-message {
            padding: 16px 24px;
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-md);
            font-weight: 700;
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }
        .alert-success { background-color: var(--sage-primary); color: var(--charcoal); }
        .alert-error { background-color: #F4D4D4; color: var(--charcoal); }

        /* FOOTER */
        .footer {
            padding: 40px 5%; text-align: center; border-top: 1px solid var(--sage-border);
            background: var(--white);
        }
        .footer p { color: #8C8C85; font-size: 14px; font-weight: 500; }

        /* CHECKOUT MODAL */
        .modal-backdrop {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(28, 28, 26, 0.6); backdrop-filter: blur(8px);
            z-index: 1001; opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .modal-backdrop.active { opacity: 1; visibility: visible; }
        
        .checkout-modal {
            position: fixed; top: 50%; left: 50%; transform: translate(-50%, -45%);
            width: 90%; max-width: 500px; background: var(--white);
            border-radius: 24px; z-index: 1002; opacity: 0; visibility: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 24px 64px rgba(0,0,0,0.2); overflow: hidden;
        }
        .checkout-modal.active { opacity: 1; visibility: visible; transform: translate(-50%, -50%); }
        
        .modal-header {
            padding: 24px 32px; border-bottom: 1px solid var(--sage-border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .modal-header h3 { font-size: 20px; font-weight: 800; color: var(--charcoal); }
        .btn-close-modal {
            background: transparent; border: none; font-size: 20px; color: var(--sage-dark);
            cursor: pointer; transition: color 0.2s;
        }
        .btn-close-modal:hover { color: var(--charcoal); }
        
        .modal-body { padding: 32px; }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-weight: 700; color: var(--charcoal); font-size: 14px;
            margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .form-control {
            width: 100%; padding: 16px; border-radius: 12px;
            border: 2px solid var(--sage-border); background: #FAF9F6;
            font-family: inherit; font-size: 15px; color: var(--charcoal);
            transition: border-color 0.3s;
        }
        .form-control:focus { outline: none; border-color: var(--sage-dark); background: var(--white); }
        
        .modal-footer {
            padding: 24px 32px; background: #FAF9F6; border-top: 1px solid var(--sage-border);
        }
        .btn-submit-order {
            width: 100%; padding: 16px; background: var(--charcoal); color: var(--white);
            border: none; border-radius: var(--radius-full); font-size: 16px; font-weight: 700;
            cursor: pointer; transition: var(--transition-smooth);
        }
        .btn-submit-order:hover { background: #000; box-shadow: 0 8px 24px rgba(0,0,0,0.15); transform: translateY(-2px); }

        @media (max-width: 992px) {
            .item-grid { grid-template-columns: 1fr; gap: 40px; }
            .info-panel { position: relative; top: 0; padding: 0; }
            .image-showcase { aspect-ratio: 1/1; border-radius: 24px; }
        }
        @media (max-width: 640px) {
            .nav-brand span { display: none; }
            .specs-grid { flex-direction: column; }
            .item-title { font-size: 2.2rem; }
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
            <a href="{{ route('katalog.index') }}" class="btn btn-outline" style="background: var(--charcoal); color: var(--white); border: none;"><i class="fas fa-shopping-bag"></i> Katalog</a>
            
            @auth
                @can('admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('customer.klaim.index') }}" class="btn btn-primary">Profil Saya</a>
                @endcan
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </nav>

    <!-- BREADCRUMBS -->
    <div class="breadcrumbs">
        <a href="{{ route('katalog.index') }}">Katalog</a>
        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
        <a href="{{ route('katalog.index', ['kategori' => $item->kategori_id]) }}">{{ $item->kategori->nama_kategori ?? 'Lainnya' }}</a>
        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
        <span>Detail Produk</span>
    </div>

    <!-- ITEM DETAIL SECTION -->
    <main class="item-container">
        
        @if(session('success'))
            <div class="alert-message alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-message alert-error">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="item-grid">
            
            <!-- LEFT: IMAGE GALLERY -->
            <div class="image-showcase">
                <img src="{{ asset('storage/' . ($item->foto_path ?? 'images/placeholder.jpg')) }}" 
                     alt="{{ $item->nama_item }}" 
                     class="main-image">
                <div class="category-floating-badge">
                    <i class="fas fa-tag" style="color: var(--sage-dark); margin-right: 6px;"></i> 
                    {{ $item->kategori->nama_kategori ?? 'Lainnya' }}
                </div>
            </div>

            <!-- RIGHT: INFO PANEL -->
            <div class="info-panel">
                <h1 class="item-title">{{ $item->nama_item }}</h1>
                <div class="item-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                <div class="specs-grid">
                    <div class="spec-pill">
                        <span class="label"><i class="fas fa-ruler"></i> Ukuran</span>
                        <span class="val">{{ $item->ukuran }}</span>
                    </div>
                    <div class="spec-pill">
                        <span class="label"><i class="fas fa-star"></i> Kondisi</span>
                        <span class="val">{{ $item->kondisi }}</span>
                    </div>
                </div>

                @if($item->status === 'Tersedia')
                    <div class="status-box">
                        <span>Status Ketersediaan</span>
                        <span><i class="fas fa-check-circle"></i> Tersedia Segera</span>
                    </div>
                @else
                    <div class="status-box unavailable">
                        <span>Status Ketersediaan</span>
                        <span><i class="fas fa-lock"></i> {{ $item->status === 'Diproses' ? 'Sedang Diproses' : 'Terjual' }}</span>
                    </div>
                @endif

                <div class="desc-box">
                    <h3>Detail & Spesifikasi Lengkap</h3>
                    {{ $item->deskripsi }}
                    <br><br>
                    <p style="font-size: 13px; color: var(--sage-dark);"><i class="fas fa-shield-alt"></i> Jaminan 100% Produk Thrift Kurasi Original.</p>
                </div>

                <!-- CTA BUTTON -->
                @auth
                    @if ($item->status === 'Tersedia')
                        <button type="button" class="btn-claim" onclick="openCheckout()">
                            MENUKAR ITEM SEKARANG <i class="fas fa-shipping-fast" style="margin-left: 8px;"></i>
                        </button>
                    @endif
                @else
                    <div style="text-align: center; margin-top: 10px;">
                        <a href="{{ route('login') }}" class="btn-claim btn-claim-secondary" style="display: block; text-decoration: none;">
                            <i class="fas fa-user-lock"></i> Login Untuk Mengklaim
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Thrift-In. All rights reserved. Crafted for Gen-Z.</p>
    </footer>

    <!-- CHECKOUT MODAL OLEH THRIFT-IN -->
    <div class="modal-backdrop" id="checkoutBackdrop" onclick="closeCheckout()"></div>
    <div class="checkout-modal" id="checkoutModal">
        <div class="modal-header">
            <h3>Checkout & Pengiriman <i class="fas fa-box" style="margin-left: 8px; color: var(--sage-dark);"></i></h3>
            <button type="button" class="btn-close-modal" onclick="closeCheckout()"><i class="fas fa-times"></i></button>
        </div>
        
        <form action="{{ route('klaim.item', $item) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="alert-message alert-success" style="padding: 12px; font-size: 14px; margin-bottom: 24px;">
                    <i class="fas fa-info-circle"></i> Item "{{ Str::limit($item->nama_item, 20) }}" masih tersedia. Silakan isi alamat pengiriman paket Anda.
                </div>
                
                <div class="form-group">
                    <label for="alamat_pengiriman">Alamat Lengkap Pengiriman</label>
                    <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control" rows="4" 
                              placeholder="Masukkan detail jalan, RT/RW, kecamatan, kota, dan kodepos..." required minlength="10"></textarea>
                </div>
                <p style="font-size: 13px; color: var(--sage-dark); margin-top: -10px;">
                    <i class="fas fa-truck"></i> Ongkos kirim dibayarkan tunai ke kurir (COD Ongkir).
                </p>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-submit-order">Pesanan Terkonfirmasi - Beli Sekarang</button>
            </div>
        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        function openCheckout() {
            document.getElementById('checkoutBackdrop').classList.add('active');
            document.getElementById('checkoutModal').classList.add('active');
            setTimeout(() => {
                document.getElementById('alamat_pengiriman').focus();
            }, 300);
        }
        function closeCheckout() {
            document.getElementById('checkoutBackdrop').classList.remove('active');
            document.getElementById('checkoutModal').classList.remove('active');
        }
    </script>
</body>
</html>