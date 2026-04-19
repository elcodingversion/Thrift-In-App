<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resi #{{ str_pad($klaim->id, 5, '0', STR_PAD_LEFT) }} - Thrift-In</title>
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

        /* BREADCRUMBS */
        .breadcrumbs {
            margin-top: 100px; padding: 0 5%; max-width: 1200px; margin-left: auto; margin-right: auto;
            font-size: 14px; font-weight: 600; color: var(--sage-dark);
            display: flex; align-items: center; gap: 8px;
        }
        .breadcrumbs a { color: var(--charcoal); text-decoration: none; transition: var(--transition-smooth); }
        .breadcrumbs a:hover { color: var(--sage-dark); }
        .breadcrumbs span { color: var(--sage-dark); }

        /* MAIN INVOICE CONTAINER */
        .invoice-container { max-width: 1000px; margin: 30px auto 100px; padding: 0 5%; }
        
        .invoice-card {
            background: var(--white); border-radius: 32px; overflow: hidden;
            box-shadow: 0 24px 64px rgba(110, 124, 111, 0.08); border: 1px solid var(--sage-border);
            display: flex; flex-direction: column; 
            margin-bottom: 30px;
        }

        .invoice-header {
            padding: 40px; background: var(--charcoal); color: var(--white);
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;
        }
        .invoice-title { font-size: 28px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 4px; }
        .invoice-id { color: var(--sage-primary); font-family: monospace; font-size: 18px; }
        
        @php
            $statusStr = $klaim->status_klaim ?? $klaim->status;
            $statusClass = explode(' ', trim($statusStr))[0]; 
        @endphp
        
        .status-badge { padding: 10px 20px; border-radius: var(--radius-full); font-size: 14px; font-weight: 800; display: inline-flex; align-items: center; gap: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-Menunggu, .status-Pending { background: #F5E6B8; color: #8A6400; }
        .status-Diproses { background: #D0E3F0; color: #1E5C8B; }
        .status-Dikirim { background: #F3E8FF; color: #7E22CE; }
        .status-Selesai { background: var(--sage-primary); color: var(--charcoal); }
        .status-Ditolak, .status-Dibatalkan { background: #F4D4D4; color: #8B1E1E; }

        .invoice-body { padding: 40px; display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 40px; }
        
        .info-block { display: flex; flex-direction: column; gap: 6px; margin-bottom: 24px; }
        .info-label { font-size: 12px; font-weight: 700; color: var(--sage-dark); text-transform: uppercase; letter-spacing: 1px; }
        .info-value { font-size: 16px; font-weight: 600; color: var(--charcoal); }
        
        .admin-note {
            background: rgba(201, 217, 195, 0.3); border-left: 4px solid var(--sage-dark);
            padding: 16px 20px; border-radius: 0 var(--radius-md) var(--radius-md) 0;
            margin-top: 16px; font-weight: 600; color: var(--charcoal); font-size: 14px;
        }

        .product-preview {
            background: var(--cream-bg); border-radius: var(--radius-lg); padding: 30px;
            display: flex; flex-direction: column; align-items: center; text-align: center; gap: 16px;
            border: 1px dashed var(--sage-dark);
        }
        .product-image {
            width: 160px; height: 160px; border-radius: 16px; object-fit: cover;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1); border: 4px solid var(--white);
        }
        .product-name a { font-size: 20px; font-weight: 800; color: var(--charcoal); text-decoration: none; transition: var(--transition-smooth); }
        .product-name a:hover { color: var(--sage-dark); text-decoration: underline; }
        .product-price { font-size: 24px; font-weight: 800; color: var(--sage-dark); }

        .btn-action {
            width: 100%; padding: 16px; border: none;
            border-radius: var(--radius-full); font-weight: 800; font-size: 15px; cursor: pointer;
            transition: var(--transition-smooth); display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 16px;
            text-decoration: none;
        }
        .btn-cancel { background: #F4D4D4; color: #8B1E1E; }
        .btn-cancel:hover { background: #ECA3A3; transform: translateY(-2px); }
        
        .btn-edit { background: var(--sage-primary); color: var(--charcoal); }
        .btn-edit:hover { background: var(--sage-secondary); transform: translateY(-2px); }

        @media (max-width: 768px) {
            .nav-brand span { display: none; }
            .invoice-body { grid-template-columns: 1fr; gap: 30px; }
            .invoice-header { flex-direction: column; align-items: flex-start; }
            .product-preview { order: -1; }
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
            <a href="{{ route('customer.klaim.index') }}" class="btn btn-outline" style="border: none;"><i class="fas fa-arrow-left"></i> Dasbor Profil</a>
        </div>
    </nav>

    <div class="breadcrumbs">
        <a href="{{ route('customer.klaim.index') }}">Profil Saya</a>
        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
        <span>Detail Pesanan</span>
    </div>

    <!-- MAIN INVOICE -->
    <main class="invoice-container">
        
        @if (session('success'))
            <div style="background-color: var(--sage-primary); color: var(--charcoal); padding: 16px 24px; border-radius: var(--radius-md); margin-bottom: 24px; font-weight: 700; display: flex; align-items: center; gap: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="invoice-card">
            
            <div class="invoice-header">
                <div>
                    <h1 class="invoice-title">Tracking Pesanan</h1>
                    <div class="invoice-id">Invoice #{{ str_pad($klaim->id, 5, '0', STR_PAD_LEFT) }}</div>
                </div>
                
                <div class="status-badge status-{{ $statusClass }}">
                    @if($statusClass == 'Menunggu' || $statusClass == 'Pending')
                        <i class="fas fa-clock"></i>
                    @elseif($statusClass == 'Diproses')
                        <i class="fas fa-box-open"></i>
                    @elseif($statusClass == 'Dikirim')
                        <i class="fas fa-shipping-fast"></i>
                    @elseif($statusClass == 'Selesai')
                        <i class="fas fa-check-circle"></i>
                    @else
                        <i class="fas fa-times-circle"></i>
                    @endif
                    STATUS: {{ $statusStr }}
                </div>
            </div>

            <div class="invoice-body">
                
                <!-- KIRI: INFORMASI TRANSAKSI -->
                <div class="invoice-info">
                    <div class="info-block">
                        <span class="info-label">Tanggal Pengajuan Pesanan</span>
                        <span class="info-value"><i class="far fa-calendar-alt"></i> {{ $klaim->created_at->format('d F Y - H:i') }} WIB</span>
                    </div>

                    @if ($klaim->updated_at > $klaim->created_at)
                    <div class="info-block">
                        <span class="info-label">Pembaruan Sistem Terakhir</span>
                        <span class="info-value"><i class="fas fa-history"></i> {{ $klaim->updated_at->format('d F Y - H:i') }} WIB</span>
                    </div>
                    @endif

                    <div class="info-block" style="margin-top: 16px; padding: 16px; background: #F9FAFB; border-radius: 12px; border: 1px dashed var(--sage-border);">
                        <span class="info-label"><i class="fas fa-map-marker-alt" style="color: var(--sage-dark);"></i> Alamat Pengiriman</span>
                        <span class="info-value" style="font-size: 14px; margin-top: 4px;">{{ $klaim->alamat_pengiriman ?? 'Alamat tidak disertakan di sistem lama.' }}</span>
                        
                        @if ($klaim->resi_pengiriman)
                            <hr style="border: 0; border-top: 1px solid var(--sage-border); margin: 12px 0;">
                            <span class="info-label"><i class="fas fa-barcode" style="color: var(--sage-dark);"></i> Resi Ekspedisi (Lacak Paket)</span>
                            <span class="info-value" style="font-size: 16px; color: #0369A1; font-family: monospace; letter-spacing: 1px; margin-top: 4px;">{{ $klaim->resi_pengiriman }}</span>
                        @endif
                    </div>

                    @if ($klaim->alasan)
                    <div class="info-block" style="margin-top: 30px;">
                        <span class="info-label">Catatan Pembeli / Alasan Klaim</span>
                        <div style="background: var(--cream-bg); padding: 16px; border-radius: var(--radius-md); font-size: 14px; color: var(--charcoal); margin-top: 6px; border: 1px solid var(--sage-border);">
                            "{{ $klaim->alasan }}"
                        </div>
                    </div>
                    @endif

                    @if ($klaim->status_admin_note)
                    <div class="admin-note">
                        <div style="font-size: 11px; text-transform: uppercase; color: var(--sage-dark); margin-bottom: 4px;">Balasan dari Admin / CS Thrift-In:</div>
                        {{ $klaim->status_admin_note }}
                    </div>
                    @endif

                    @if ($statusStr == 'Pending' || str_contains(strtolower($statusStr), 'menunggu'))
                    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px dashed var(--sage-border);">
                        
                        <!-- Tombol Edit (Tergantung route ada atau tidak) -->
                        <a href="{{ route('customer.klaim.edit', $klaim->id) }}" class="btn-action btn-edit" style="margin-bottom: 12px;">
                            <i class="fas fa-edit"></i> Edit Catatan / Pesanan
                        </a>
                        
                        <form action="{{ route('customer.klaim.destroy', $klaim->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan klaim pesanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-cancel">
                                <i class="fas fa-trash-alt"></i> Batalkan / Hapus Pesanan Ini
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <!-- KANAN: PREVIEW BARANG -->
                <div>
                    <div class="product-preview">
                        <img src="{{ asset('storage/' . ($klaim->item->foto_path ?? 'images/placeholder.jpg')) }}" alt="Foto Baju" class="product-image">
                        <div class="product-name">
                            <a href="{{ route('katalog.show', $klaim->item_id) }}">{{ $klaim->item->nama_item ?? 'Produk Dihapus/Hilang' }}</a>
                        </div>
                        <div class="product-price">Rp {{ number_format($klaim->item->harga ?? 0, 0, ',', '.') }}</div>
                        <div style="font-size: 13px; font-weight: 700; color: var(--sage-dark); padding: 4px 12px; background: var(--white); border-radius: 50px;">
                            <i class="fas fa-tag"></i> {{ $klaim->item->kategori->nama_kategori ?? 'Kategori Umum' }}
                        </div>
                    </div>
                    
                    @if ($klaim->file_bukti)
                    <div style="margin-top: 24px; text-align: center;">
                        <span style="font-size: 12px; font-weight: 700; color: var(--sage-dark); text-transform: uppercase;">File Bukti Tambahan</span><br>
                        <a href="{{ asset('storage/' . $klaim->file_bukti) }}" target="_blank" class="btn" style="background: var(--white); border: 1px solid var(--sage-border); font-size: 13px; padding: 8px 16px; margin-top: 8px;">
                            <i class="fas fa-external-link-alt"></i> Lihat File Terlampir
                        </a>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

</body>
</html>