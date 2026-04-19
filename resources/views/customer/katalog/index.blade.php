<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Publik - Thrift-In</title>
    
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

        /* NAVBAR (Identical to Landing) */
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

        /* CATALOG HEADER BANNER */
        .catalog-banner {
            margin-top: 80px; 
            padding: 80px 5%;
            background: linear-gradient(135deg, var(--sage-primary) 0%, var(--cream-bg) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .catalog-banner h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: var(--charcoal);
            letter-spacing: -1px;
            margin-bottom: 16px;
            position: relative;
            z-index: 2;
        }
        .catalog-banner p {
            font-size: 1.1rem;
            color: var(--sage-dark);
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* FILTER LAYOUT */
        .catalog-layout {
            max-width: 1400px;
            margin: 0 auto;
            padding: var(--spacing-lg) 5%;
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            background: var(--white);
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            border: 1px solid var(--sage-border);
        }

        .filter-controls {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            flex: 1;
        }

        .filter-select {
            padding: 12px 20px;
            border-radius: var(--radius-full);
            border: 1px solid var(--sage-border);
            background: var(--cream-bg);
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            color: var(--charcoal);
            cursor: pointer;
            transition: var(--transition-smooth);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%231C1C1A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 48px;
        }
        .filter-select:hover { border-color: var(--charcoal); }

        .filter-pills {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none; /* Firefox */
        }
        .filter-pills::-webkit-scrollbar { display: none; }

        .filter-pill {
            padding: 10px 20px;
            background: var(--cream-bg);
            color: var(--charcoal);
            border: 1px solid var(--sage-border);
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            white-space: nowrap;
            transition: var(--transition-smooth);
        }
        .filter-pill:hover, .filter-pill.active {
            background: var(--charcoal);
            color: var(--white);
            border-color: var(--charcoal);
        }

        .result-meta {
            font-size: 14px;
            font-weight: 600;
            color: var(--sage-dark);
            margin-bottom: var(--spacing-md);
        }

        /* PRODUCT GRID */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 32px;
        }

        .product-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            text-decoration: none;
            color: var(--charcoal);
            border: 1px solid var(--sage-border);
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(110, 124, 111, 0.15);
            border-color: var(--sage-primary);
        }

        .product-image-wrapper {
            width: 100%;
            aspect-ratio: 4/5;
            overflow: hidden;
            position: relative;
            background: #f0f0f0;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .product-card:hover .product-image {
            transform: scale(1.08);
        }

        .product-badges {
            position: absolute;
            top: 16px;
            left: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 10;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(8px);
        }

        .badge-available {
            background: rgba(255, 255, 255, 0.9);
            color: var(--charcoal);
        }

        .badge-claimed {
            background: rgba(28, 28, 26, 0.85);
            color: var(--white);
        }

        .badge-category {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .product-info {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--sage-dark);
            margin-top: auto;
        }
        .price-original {
            font-size: 14px; font-weight: 600; color: #9CA3AF;
            text-decoration: line-through; margin-right: 8px;
        }
        .price-sale {
            font-size: 20px; font-weight: 800; color: #DC2626;
        }
        .badge-sale {
            background: #DC2626; color: #fff;
        }
        .badge-new {
            background: #7E22CE; color: #fff;
        }

        /* COLLECTION TABS */
        .collection-tabs {
            display: flex; gap: 10px; padding: 0 5%; margin-top: 16px; flex-wrap: wrap;
        }
        .collection-tab {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 28px; border-radius: var(--radius-full);
            text-decoration: none; font-weight: 700; font-size: 14px;
            border: 2px solid var(--sage-border); color: var(--charcoal);
            background: var(--white); transition: var(--transition-smooth);
        }
        .collection-tab:hover { border-color: var(--charcoal); }
        .collection-tab.active { background: var(--charcoal); color: var(--white); border-color: var(--charcoal); }
        .collection-tab .tab-count {
            background: rgba(0,0,0,0.1); padding: 2px 10px; border-radius: 50px;
            font-size: 12px; font-weight: 700;
        }
        .collection-tab.active .tab-count { background: rgba(255,255,255,0.2); }

        /* EMPTY STATE */
        .empty-state {
            grid-column: 1 / -1;
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px dashed var(--sage-dark);
            padding: 80px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }
        .empty-icon {
            font-size: 48px;
            color: var(--sage-primary);
        }

        /* PAGINATION */
        .pagination-container {
            margin-top: 60px;
            display: flex;
            justify-content: center;
            font-size: 14px;
        }
        .pagination-container nav { width: 100%; display: flex; justify-content: center; } 
        .pagination-container svg { width: 20px; height: 20px; }
        
        /* FOOTER */
        .footer {
            padding: 40px 5%;
            text-align: center;
            border-top: 1px solid var(--sage-border);
            background: var(--white);
            margin-top: 80px;
        }
        .footer p { color: #8C8C85; font-size: 14px; font-weight: 500; }

        @media (max-width: 768px) {
            .nav-brand span { display: none; }
            .catalog-banner { padding: 60px 5%; margin-top: 70px; }
            .filter-header { flex-direction: column; align-items: stretch; position: relative; top: 0; }
            .filter-select { width: 100%; }
            .search-bar { width: 100%; }
        }

        /* SEARCH BAR */
        .search-bar {
            width: 100%; max-width: 560px; margin: 24px auto 0; position: relative;
        }
        .search-bar input {
            width: 100%; padding: 16px 56px 16px 24px; border-radius: var(--radius-full);
            border: 2px solid var(--sage-border); background: var(--white);
            font-family: inherit; font-size: 15px; font-weight: 500; color: var(--charcoal);
            transition: var(--transition-smooth); box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .search-bar input:focus { outline: none; border-color: var(--charcoal); box-shadow: 0 8px 32px rgba(0,0,0,0.08); }
        .search-bar input::placeholder { color: #9CA3AF; font-weight: 500; }
        .search-bar button {
            position: absolute; right: 6px; top: 50%; transform: translateY(-50%);
            width: 44px; height: 44px; border-radius: 50%; border: none;
            background: var(--charcoal); color: var(--white); cursor: pointer;
            font-size: 16px; transition: var(--transition-smooth);
            display: flex; align-items: center; justify-content: center;
        }
        .search-bar button:hover { background: #000; transform: translateY(-50%) scale(1.05); }
        .search-active-info {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 8px 16px; margin-top: 16px; font-size: 14px; font-weight: 600; color: var(--sage-dark);
        }
        .search-active-info a { color: var(--charcoal); text-decoration: underline; margin-left: 4px; }
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

    <!-- CATALOG BANNER -->
    <header class="catalog-banner">
        <h1>Our Collection</h1>
        <p>Eksplorasi ribuan item fashion thrift yang telah dikurasi dengan standar premium. Temukan gaya unikmu hari ini.</p>
        
        <!-- SEARCH BAR -->
        <form class="search-bar" action="{{ route('katalog.index') }}" method="GET">
            @if(request('koleksi'))<input type="hidden" name="koleksi" value="{{ request('koleksi') }}">@endif
            @if(request('kategori'))<input type="hidden" name="kategori" value="{{ request('kategori') }}">@endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk, misal: kemeja, jaket, hoodie..." autocomplete="off">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        @if(request('search'))
            <div class="search-active-info">
                <i class="fas fa-filter"></i> Hasil pencarian: "<strong>{{ request('search') }}</strong>"
                <a href="{{ route('katalog.index', request()->except('search')) }}"><i class="fas fa-times-circle"></i> Hapus</a>
            </div>
        @endif
    </header>

    <!-- COLLECTION TABS -->
    <div class="collection-tabs">
        <a href="{{ route('katalog.index') }}" class="collection-tab {{ !request('koleksi') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Semua
        </a>
        <a href="{{ route('katalog.index', ['koleksi' => 'new']) }}" class="collection-tab {{ request('koleksi') === 'new' ? 'active' : '' }}">
            <i class="fas fa-sparkles"></i> New Arrivals <span class="tab-count">{{ $countNew ?? 0 }}</span>
        </a>
        <a href="{{ route('katalog.index', ['koleksi' => 'bestseller']) }}" class="collection-tab {{ request('koleksi') === 'bestseller' ? 'active' : '' }}">
            <i class="fas fa-fire"></i> Best Seller <span class="tab-count">{{ $countSold ?? 0 }}</span>
        </a>
        <a href="{{ route('katalog.index', ['koleksi' => 'sale']) }}" class="collection-tab {{ request('koleksi') === 'sale' ? 'active' : '' }}">
            <i class="fas fa-percent"></i> Sale <span class="tab-count">{{ $countSale ?? 0 }}</span>
        </a>
    </div>

    <!-- MAIN APP LAYOUT -->
    <main class="catalog-layout">
        
        <!-- FILTER BAR -->
        <div class="filter-header">
            <!-- Kategori Pills -->
            <div class="filter-pills">
                <a href="{{ route('katalog.index', array_merge(request()->except('kategori'), request()->only(['status', 'sort']))) }}" 
                   class="filter-pill {{ !request()->get('kategori') ? 'active' : '' }}">
                    Semua
                </a>
                @foreach($kategoris as $kategori)
                    <a href="{{ route('katalog.index', array_merge(['kategori' => $kategori->id], request()->only(['status', 'sort']))) }}" 
                        class="filter-pill {{ request()->get('kategori') == $kategori->id ? 'active' : '' }}">
                        {{ $kategori->nama_kategori }}
                    </a>
                @endforeach
            </div>

            <div class="filter-controls">
                <select class="filter-select" id="statusFilter" onchange="applyFilters()">
                    <option value="">Status: Semua</option>
                    <option value="Tersedia" {{ request()->get('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Klaim" {{ request()->get('status') == 'Klaim' ? 'selected' : '' }}>Sudah Diklaim</option>
                </select>

                <select class="filter-select" id="sortPrice" onchange="applyFilters()">
                    <option value="">Harga: Relevan</option>
                    <option value="asc" {{ request()->get('sort') == 'asc' ? 'selected' : '' }}>Termurah ↗</option>
                    <option value="desc" {{ request()->get('sort') == 'desc' ? 'selected' : '' }}>Termahal ↘</option>
                </select>
            </div>
        </div>

        @if($items->total() > 0)
            <div class="result-meta">
                Menampilkan {{ $items->firstItem() }} - {{ $items->lastItem() }} dari {{ $items->total() }} produk
            </div>
        @endif

        <!-- PRODUCT GRID -->
        <div class="catalog-grid">
            @if($items->count() > 0)
                @foreach($items as $item)
                    <a href="{{ route('katalog.show', $item->id) }}" class="product-card">
                        <div class="product-image-wrapper">
                            <div class="product-badges">
                                @if($item->status == 'Tersedia')
                                    <span class="badge-status badge-available"><i class="fas fa-check-circle" style="color: var(--sage-dark); margin-right: 4px;"></i> Tersedia</span>
                                @else
                                    <span class="badge-status badge-claimed"><i class="fas fa-lock" style="margin-right: 4px;"></i> Diklaim</span>
                                @endif
                                @if($item->harga_diskon && $item->harga_diskon > 0)
                                    @php $persen = round((($item->harga - $item->harga_diskon) / $item->harga) * 100); @endphp
                                    <span class="badge-status badge-sale"><i class="fas fa-bolt" style="margin-right: 4px;"></i> -{{ $persen }}%</span>
                                @endif
                                @if($item->created_at >= now()->subDays(14))
                                    <span class="badge-status badge-new"><i class="fas fa-star" style="margin-right: 4px;"></i> NEW</span>
                                @endif
                            </div>
                            
                            <span class="badge-category">{{ $item->kategori->nama_kategori ?? 'Lainnya' }}</span>
                            
                            <img src="{{ asset('storage/' . ($item->foto_path ?? 'images/placeholder.jpg')) }}" 
                                 alt="{{ $item->nama_item }}" 
                                 class="product-image" loading="lazy">
                        </div>
                        
                        <div class="product-info">
                            <h3 class="product-name">{{ $item->nama_item }}</h3>
                            @if($item->harga_diskon && $item->harga_diskon > 0)
                                <p class="product-price">
                                    <span class="price-original">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    <span class="price-sale">Rp {{ number_format($item->harga_diskon, 0, ',', '.') }}</span>
                                </p>
                            @else
                                <p class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-box-open empty-icon"></i>
                    <h3>Ups, Produk Tidak Ditemukan</h3>
                    <p style="color: var(--sage-dark);">Coba sesuaikan filter pencarianmu atau kembali ke semua kategori.</p>
                    <a href="{{ route('katalog.index') }}" class="btn btn-primary" style="margin-top: 16px;">Reset Filter</a>
                </div>
            @endif
        </div>

        <!-- PAGINATION -->
        @if($items->hasPages())
            <div class="pagination-container">
                {{ $items->appends(request()->query())->links() }}
            </div>
        @endif

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Thrift-In. All rights reserved. Crafted for Gen-Z.</p>
    </footer>

    <!-- SCRIPT -->
    <script>
        function applyFilters() {
            const status = document.getElementById('statusFilter').value;
            const sort = document.getElementById('sortPrice').value;
            const currentUrl = new URL(window.location.href);
            
            if (status) currentUrl.searchParams.set('status', status);
            else currentUrl.searchParams.delete('status');
            
            if (sort) currentUrl.searchParams.set('sort', sort);
            else currentUrl.searchParams.delete('sort');
            
            window.location.href = currentUrl.toString();
        }
    </script>
</body>
</html>