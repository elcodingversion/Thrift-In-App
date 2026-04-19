<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil & Pemesanan Saya - Thrift-In</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
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
        /* NAVBAR */
        .navbar {
            position: fixed; top: 0; left: 0; width: 100%; padding: 16px 5%;
            z-index: 1000; background: rgba(253, 251, 247, 0.85);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(230, 238, 228, 0.5);
            display: flex; justify-content: space-between; align-items: center;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 12px; text-decoration: none;
            color: var(--charcoal); font-weight: 800; font-size: 22px; letter-spacing: -0.5px;
        }
        .nav-brand img { height: 38px; width: auto; object-fit: contain; }
        .nav-links { display: flex; gap: var(--spacing-sm); align-items: center; }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px 24px; font-size: 15px; font-weight: 600; text-decoration: none;
            border-radius: var(--radius-full); transition: var(--transition-smooth); cursor: pointer; border: none;
        }
        .btn-outline { background: transparent; color: var(--charcoal); border: 2px solid var(--sage-border); }
        .btn-outline:hover { border-color: var(--charcoal); }
        .btn-primary { background: var(--charcoal); color: var(--white); }
        .btn-primary:hover { background: #2D2D2A; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(28,28,26,0.2); }
        /* HERO DASHBOARD */
        .dashboard-hero {
            margin-top: 80px; padding: 60px 5%; text-align: center;
            background: linear-gradient(135deg, var(--white) 0%, var(--cream-bg) 100%);
            border-bottom: 1px solid var(--sage-border);
        }
        .dashboard-hero h1 { font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: var(--charcoal); margin-bottom: 8px; letter-spacing: -0.5px; }
        .dashboard-hero p { color: var(--sage-dark); font-size: 16px; font-weight: 500; }
        .user-avatar {
            width: 80px; height: 80px; border-radius: 50%; background: var(--charcoal);
            color: var(--white); font-size: 32px; font-weight: 800; display: inline-flex;
            align-items: center; justify-content: center; margin-bottom: 16px;
            overflow: hidden; border: 4px solid var(--sage-border);
        }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        /* MAIN CONTENT */
        .dashboard-content { max-width: 1200px; margin: 40px auto 100px; padding: 0 5%; }
        .section-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid var(--sage-border); }
        .section-title { font-size: 24px; font-weight: 800; color: var(--charcoal); }
        /* ALERTS */
        .alert-message { padding: 16px 24px; border-radius: var(--radius-md); margin-bottom: 24px; font-weight: 700; display: flex; align-items: center; gap: 12px; }
        .alert-success { background-color: var(--sage-primary); color: var(--charcoal); }
        
        /* DASHBOARD MENUS (STATS) */
        .dashboard-menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .menu-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 24px;
            border: 1px solid var(--sage-border);
            display: flex; flex-direction: column; align-items: center; text-align: center;
            box-shadow: 0 4px 12px rgba(110, 124, 111, 0.05);
            transition: var(--transition-smooth); gap: 12px;
            text-decoration: none; color: inherit;
        }
        .menu-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(110, 124, 111, 0.12); border-color: var(--sage-primary); }
        .menu-card.active-menu { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(110, 124, 111, 0.12); border-color: var(--charcoal); outline: 2px solid var(--charcoal); }
        .menu-icon {
            width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 24px; margin-bottom: 8px;
        }
        .icon-proses { background: #E0F2FE; color: #0369A1; }
        .icon-kirim { background: #F3E8FF; color: #7E22CE; }
        .icon-selesai { background: #DCFCE7; color: #166534; }
        .icon-pengaturan { background: var(--cream-bg); color: var(--sage-dark); border: 1px solid var(--sage-border); }
        
        .menu-card h4 { font-size: 15px; font-weight: 700; color: var(--charcoal); margin: 0; }
        .menu-count { font-size: 28px; font-weight: 800; color: var(--sage-dark); line-height: 1; }
        .menu-desc { font-size: 12px; font-weight: 500; color: #8C8C85; }

        /* CLAIM CARDS */
        .claim-grid { display: flex; flex-direction: column; gap: 20px; }
        .claim-card {
            background: var(--white); border-radius: var(--radius-lg); padding: 24px;
            display: flex; justify-content: space-between; align-items: center; gap: 24px;
            box-shadow: 0 4px 16px rgba(110, 124, 111, 0.05); border: 1px solid var(--sage-border);
            transition: var(--transition-smooth); text-decoration: none; color: inherit;
        }
        .claim-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(110, 124, 111, 0.12); border-color: var(--sage-primary); }
        
        .claim-main { display: flex; flex-direction: column; gap: 8px; flex: 1; }
        .claim-code { font-size: 13px; font-weight: 700; color: var(--sage-dark); letter-spacing: 1px; text-transform: uppercase; }
        .claim-item-name { font-size: 20px; font-weight: 800; line-height: 1.2; color: var(--charcoal); }
        .claim-date { font-size: 14px; font-weight: 500; color: #8C8C85; display: flex; align-items: center; gap: 6px; }
        .claim-status-area { display: flex; flex-direction: column; align-items: flex-end; gap: 12px; }
        
        /* STATUS BADGES */
        .status-badge { padding: 8px 16px; border-radius: var(--radius-full); font-size: 13px; font-weight: 700; display: inline-block; white-space: nowrap; }
        .status-Menunggu, .status-Pending { background: #F5E6B8; color: #8A6400; }
        .status-Diproses { background: #D0E3F0; color: #1E5C8B; }
        .status-Dikirim { background: #F3E8FF; color: #7E22CE; }
        .status-Selesai { background: var(--sage-primary); color: var(--charcoal); }
        .status-Ditolak, .status-Dibatalkan { background: #F4D4D4; color: #8B1E1E; }
        .btn-detail {
            padding: 8px 20px; font-size: 14px; background: var(--cream-bg); color: var(--charcoal);
            border: 1px solid var(--sage-border); border-radius: var(--radius-full);
            font-weight: 600; text-decoration: none; transition: var(--transition-smooth); display: inline-flex; align-items: center; gap: 6px;
        }
        .claim-card:hover .btn-detail { background: var(--charcoal); color: var(--white); border-color: var(--charcoal); }
        .empty-state { text-align: center; padding: 80px 20px; background: var(--white); border-radius: var(--radius-lg); border: 1px dashed var(--sage-dark); }
        .empty-icon { font-size: 48px; color: var(--sage-primary); margin-bottom: 16px; }
        .pagination-container { margin-top: 40px; display: flex; justify-content: center; font-size: 14px; }
        .pagination-container nav { width: 100%; display: flex; justify-content: center; } 
        .pagination-container svg { width: 20px; height: 20px; }
        @media (max-width: 768px) {
            .nav-brand span { display: none; }
            .claim-card { flex-direction: column; align-items: flex-start; }
            .claim-status-area { align-items: flex-start; width: 100%; flex-direction: row; justify-content: space-between; margin-top: 12px; }
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
            <a href="{{ route('katalog.index') }}" class="btn btn-outline" style="border: none;"><i class="fas fa-shopping-bag"></i> Katalog</a>
            
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-primary" style="background: var(--sage-dark);">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>
    <!-- DASHBOARD HERO -->
    <header class="dashboard-hero">
        <div class="user-avatar">
            @if(Auth::user()->foto_profil)
                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto Profil">
            @else
                {{ substr(Auth::user()->name, 0, 1) }}
            @endif
        </div>
        <h1>Halo, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
        <p>Selamat datang di Dasbor Profil Anda. Pantau semua riwayat pesanan baju thrift di sini.</p>
    </header>
    <!-- MAIN DASHBOARD CONTENT -->
    <main class="dashboard-content">

        <!-- DASHBOARD MENUS (STATISTIK) -->
        <div class="dashboard-menu-grid">
            <a href="{{ route('customer.klaim.index', ['status' => 'diproses']) }}" class="menu-card {{ request('status') === 'diproses' ? 'active-menu' : '' }}">
                <div class="menu-icon icon-proses"><i class="fas fa-box-open"></i></div>
                <div class="menu-count">{{ $countProses ?? 0 }}</div>
                <h4>Sedang Diproses</h4>
                <div class="menu-desc">Pesanan yang masih dikemas atau menunggu.</div>
            </a>
            <a href="{{ route('customer.klaim.index', ['status' => 'dikirim']) }}" class="menu-card {{ request('status') === 'dikirim' ? 'active-menu' : '' }}">
                <div class="menu-icon icon-kirim"><i class="fas fa-shipping-fast"></i></div>
                <div class="menu-count">{{ $countKirim ?? 0 }}</div>
                <h4>Sedang Dikirim</h4>
                <div class="menu-desc">Paket dalam perjalanan ke alamat Anda.</div>
            </a>
            <a href="{{ route('customer.klaim.index', ['status' => 'selesai']) }}" class="menu-card {{ request('status') === 'selesai' ? 'active-menu' : '' }}">
                <div class="menu-icon icon-selesai"><i class="fas fa-check-circle"></i></div>
                <div class="menu-count">{{ $countSelesai ?? 0 }}</div>
                <h4>Selesai</h4>
                <div class="menu-desc">Riwayat transaksi yang sudah tuntas.</div>
            </a>
            <a href="{{ route('profile.edit') }}" class="menu-card">
                <div class="menu-icon icon-pengaturan"><i class="fas fa-user-cog"></i></div>
                <div style="height: 30px;"></div>
                <h4>Pengaturan Akun</h4>
                <div class="menu-desc">Ubah nama pengguna atau password Anda.</div>
            </a>
        </div>

        <div class="section-header" style="align-items: center;">
            <h2 class="section-title">
                @if(request('status') === 'diproses')
                    Pesanan Dalam Proses
                @elseif(request('status') === 'dikirim')
                    Paket Sedang Dikirim
                @elseif(request('status') === 'selesai')
                    Riwayat Pesanan Selesai
                @else
                    Semua Riwayat Pesanan
                @endif
            </h2>
            @if(request()->has('status'))
                <a href="{{ route('customer.klaim.index') }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 13px;">Tampilkan Semua</a>
            @endif
        </div>
        @if (session('success'))
            <div class="alert-message alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if ($riwayatKlaim->isEmpty())
            <div class="empty-state">
                <i class="fas fa-box-open empty-icon" style="opacity: 0.5;"></i>
                @if(request()->has('status'))
                    <h3>Tidak Ada Data Transaksi</h3>
                    <p style="color: var(--sage-dark); margin-bottom: 24px;">Tidak ditemukan pesanan dengan status menu yang Anda pilih.</p>
                    <a href="{{ route('customer.klaim.index') }}" class="btn btn-primary" style="background-color: var(--charcoal);">Hapus Filter</a>
                @else
                    <h3>Wah, Lemari Anda Masih Kosong</h3>
                    <p style="color: var(--sage-dark); margin-bottom: 24px;">Anda belum memiliki riwayat pesanan (klaim) pakaian. Mulai cari gaya baru sekarang!</p>
                    <a href="{{ route('katalog.index') }}" class="btn btn-primary">Eksplor Katalog Baju</a>
                @endif
            </div>
        @else
            <div class="claim-grid">
                @foreach ($riwayatKlaim as $klaim)
                    <a href="{{ route('customer.klaim.show', $klaim->id) }}" class="claim-card">
                        <div class="claim-main">
                            @php
                                $statusStr = $klaim->status_klaim ?? $klaim->status;
                                $statusClass = explode(' ', trim($statusStr))[0]; 
                            @endphp
                            <div class="claim-code">Invoice #{{ str_pad($klaim->id, 5, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="claim-item-name">{{ $klaim->item->nama_item ?? 'Produk tidak ditemukan' }}</h3>
                            <div class="claim-date">
                                <i class="far fa-calendar-alt"></i> Pesanan dibuat pada {{ $klaim->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="claim-status-area">
                            <span class="status-badge status-{{ $statusClass }}">
                                {{ $statusStr }}
                            </span>
                            <div class="btn-detail">Lihat Resi <i class="fas fa-chevron-right" style="font-size: 12px;"></i></div>
                        </div>
                    </a>
                @endforeach
            </div>
            <!-- PAGINATION -->
            <div class="pagination-container">
                {{ $riwayatKlaim->links() }}
            </div>
        @endif
    </main>
</body>
</html>