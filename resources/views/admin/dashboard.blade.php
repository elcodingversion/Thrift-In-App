@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, Admin! Berikut ringkasan operasional toko Anda.')

@push('styles')
<style>
    /* ====== DASHBOARD PREMIUM ====== */
    .dash-greeting {
        background: linear-gradient(135deg, var(--charcoal) 0%, #3a3a3a 100%);
        color: var(--white);
        border-radius: 16px;
        padding: 32px 40px;
        margin-bottom: var(--spacing-md);
        display: flex; justify-content: space-between; align-items: center;
        box-shadow: 0 8px 32px rgba(47, 47, 47, 0.18);
        overflow: hidden; position: relative;
    }
    .dash-greeting::after {
        content: ''; position: absolute; right: -60px; top: -60px;
        width: 200px; height: 200px; border-radius: 50%;
        background: rgba(201, 217, 195, 0.1);
    }
    .dash-greeting h2 { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
    .dash-greeting p { font-size: 14px; color: var(--sage-primary); font-weight: 400; }
    .dash-greeting .time-badge {
        background: rgba(255,255,255,0.1); padding: 8px 16px; border-radius: 100px;
        font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 8px;
    }

    /* STAT CARDS ROW */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: var(--spacing-md);
    }
    .kpi-card {
        background: var(--white); border: 1px solid var(--sage-border); border-radius: 16px;
        padding: 24px; box-shadow: var(--shadow-sm); transition: all 0.3s ease;
        position: relative; overflow: hidden;
    }
    .kpi-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
    .kpi-card .kpi-icon {
        width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center;
        justify-content: center; font-size: 20px; margin-bottom: 16px;
    }
    .kpi-card .kpi-value { font-size: 32px; font-weight: 700; color: var(--charcoal); margin-bottom: 4px; }
    .kpi-card .kpi-label { font-size: 13px; font-weight: 500; color: var(--sage-dark); text-transform: uppercase; letter-spacing: 0.5px; }

    .icon-revenue { background: #DCFCE7; color: #166534; }
    .icon-orders { background: #E0F2FE; color: #0369A1; }
    .icon-items { background: #FEF3C7; color: #B45309; }
    .icon-users { background: #F3E8FF; color: #7E22CE; }

    /* ORDER PIPELINE */
    .pipeline-section {
        background: var(--white); border: 1px solid var(--sage-border); border-radius: 16px;
        padding: 28px; box-shadow: var(--shadow-sm); margin-bottom: var(--spacing-md);
    }
    .pipeline-title { font-size: 16px; font-weight: 700; color: var(--charcoal); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .pipeline-title i { color: var(--sage-dark); }
    .pipeline-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; }
    .pipeline-step {
        text-align: center; padding: 16px 12px; border-radius: 12px; border: 1px solid var(--sage-border);
        transition: all 0.2s; cursor: default;
    }
    .pipeline-step:hover { border-color: var(--sage-secondary); }
    .pipeline-step .p-count { font-size: 28px; font-weight: 700; margin-bottom: 4px; }
    .pipeline-step .p-label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .p-menunggu { background: #FFFBEB; color: #B45309; }
    .p-diproses { background: #EFF6FF; color: #1D4ED8; }
    .p-dikirim { background: #FAF5FF; color: #7E22CE; }
    .p-selesai { background: #F0FDF4; color: #166534; }
    .p-batal { background: #FEF2F2; color: #B91C1C; }

    /* DUAL PANEL */
    .dual-panel {
        display: grid; grid-template-columns: 1.4fr 0.6fr; gap: 20px;
    }

    /* RECENT ORDERS TABLE */
    .panel-card {
        background: var(--white); border: 1px solid var(--sage-border); border-radius: 16px;
        padding: 28px; box-shadow: var(--shadow-sm);
    }
    .panel-header {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--sage-border);
    }
    .panel-title { font-size: 16px; font-weight: 700; color: var(--charcoal); display: flex; align-items: center; gap: 10px; }
    .panel-title i { color: var(--sage-dark); }
    .btn-view-all {
        font-size: 12px; color: var(--sage-dark); text-decoration: none; font-weight: 600;
        padding: 6px 14px; border-radius: 8px; border: 1px solid var(--sage-border);
        transition: all 0.2s;
    }
    .btn-view-all:hover { background: var(--charcoal); color: var(--white); border-color: var(--charcoal); }

    .order-list { list-style: none; }
    .order-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 14px 0; border-bottom: 1px solid rgba(230, 238, 228, 0.5);
    }
    .order-item:last-child { border-bottom: none; }
    .order-left { display: flex; align-items: center; gap: 14px; }
    .order-thumb {
        width: 44px; height: 44px; border-radius: 10px; background: #F3F4F6;
        overflow: hidden; flex-shrink: 0; border: 1px solid var(--sage-border);
    }
    .order-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .order-meta h4 { font-size: 14px; font-weight: 600; color: var(--charcoal); margin: 0 0 2px 0; }
    .order-meta p { font-size: 12px; color: var(--sage-dark); margin: 0; }
    .order-right { text-align: right; }
    .order-price { font-size: 14px; font-weight: 700; color: var(--charcoal); }
    .order-status {
        display: inline-block; padding: 3px 10px; border-radius: 6px;
        font-size: 11px; font-weight: 600; margin-top: 4px;
    }
    .os-menunggu { background: #FEF3C7; color: #B45309; }
    .os-diproses { background: #E0F2FE; color: #0369A1; }
    .os-dikirim { background: #F3E8FF; color: #7E22CE; }
    .os-selesai { background: #DCFCE7; color: #166534; }
    .os-batal { background: #FEE2E2; color: #B91C1C; }

    /* ITEM INVENTORY SIDEBAR */
    .inv-item {
        display: flex; align-items: center; gap: 14px; padding: 12px 0;
        border-bottom: 1px solid rgba(230, 238, 228, 0.5);
    }
    .inv-item:last-child { border-bottom: none; }
    .inv-thumb {
        width: 40px; height: 40px; border-radius: 8px; overflow: hidden;
        border: 1px solid var(--sage-border); flex-shrink: 0; background: #F3F4F6;
    }
    .inv-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .inv-meta { flex: 1; }
    .inv-meta h5 { font-size: 13px; font-weight: 600; color: var(--charcoal); margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }
    .inv-meta span { font-size: 11px; color: var(--sage-dark); }
    .inv-status { font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 6px; white-space: nowrap; }
    .is-tersedia { background: #DCFCE7; color: #166534; }
    .is-diproses { background: #E0F2FE; color: #0369A1; }
    .is-terjual { background: #FEE2E2; color: #991B1B; }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .kpi-grid { grid-template-columns: repeat(2, 1fr); }
        .pipeline-grid { grid-template-columns: repeat(3, 1fr); }
        .dual-panel { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .kpi-grid { grid-template-columns: 1fr; }
        .pipeline-grid { grid-template-columns: repeat(2, 1fr); }
        .dash-greeting { flex-direction: column; align-items: flex-start; gap: 16px; padding: 24px; }
    }
</style>
@endpush

@section('content')

{{-- GREETING BANNER --}}
<div class="dash-greeting">
    <div>
        <h2>Halo, {{ Auth::user()->name }}! 👋</h2>
        <p>Pantau seluruh aktivitas toko dan pengiriman dari sini.</p>
    </div>
    <div class="time-badge">
        <i class="far fa-clock"></i> {{ now()->translatedFormat('l, d F Y') }}
    </div>
</div>

{{-- KPI CARDS --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon icon-revenue"><i class="fas fa-wallet"></i></div>
        <div class="kpi-value">Rp {{ number_format($revenue, 0, ',', '.') }}</div>
        <div class="kpi-label">Total Pendapatan</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon icon-orders"><i class="fas fa-shopping-bag"></i></div>
        <div class="kpi-value">{{ $totalOrders }}</div>
        <div class="kpi-label">Total Pesanan</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon icon-items"><i class="fas fa-tshirt"></i></div>
        <div class="kpi-value">{{ $totalItems }}</div>
        <div class="kpi-label">Total Produk <span style="font-size: 11px; color: #166534;">({{ $itemsTersedia }} aktif)</span></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon icon-users"><i class="fas fa-users"></i></div>
        <div class="kpi-value">{{ $totalUsers }}</div>
        <div class="kpi-label">Pelanggan Terdaftar</div>
    </div>
</div>

{{-- ORDER PIPELINE --}}
<div class="pipeline-section">
    <div class="pipeline-title"><i class="fas fa-stream"></i> Alur Pesanan Saat Ini</div>
    <div class="pipeline-grid">
        <div class="pipeline-step p-menunggu">
            <div class="p-count">{{ $ordersMenunggu }}</div>
            <div class="p-label"><i class="fas fa-clock"></i> Menunggu</div>
        </div>
        <div class="pipeline-step p-diproses">
            <div class="p-count">{{ $ordersDiproses }}</div>
            <div class="p-label"><i class="fas fa-box-open"></i> Dikemas</div>
        </div>
        <div class="pipeline-step p-dikirim">
            <div class="p-count">{{ $ordersDikirim }}</div>
            <div class="p-label"><i class="fas fa-shipping-fast"></i> Dikirim</div>
        </div>
        <div class="pipeline-step p-selesai">
            <div class="p-count">{{ $ordersSelesai }}</div>
            <div class="p-label"><i class="fas fa-check-double"></i> Selesai</div>
        </div>
        <div class="pipeline-step p-batal">
            <div class="p-count">{{ $ordersBatal }}</div>
            <div class="p-label"><i class="fas fa-times"></i> Dibatalkan</div>
        </div>
    </div>
</div>

{{-- DUAL PANEL: RECENT ORDERS + INVENTORY --}}
<div class="dual-panel">
    {{-- LEFT: RECENT ORDERS --}}
    <div class="panel-card">
        <div class="panel-header">
            <div class="panel-title"><i class="fas fa-receipt"></i> Pesanan Terbaru</div>
            <a href="{{ route('admin.klaims.index') }}" class="btn-view-all">Lihat Semua →</a>
        </div>
        <ul class="order-list">
            @forelse($recentClaims as $claim)
                @php
                    $st = strtolower($claim->status_klaim ?? '');
                    $osClass = 'os-menunggu';
                    if(strpos($st, 'proses') !== false) $osClass = 'os-diproses';
                    elseif(strpos($st, 'kirim') !== false) $osClass = 'os-dikirim';
                    elseif(strpos($st, 'selesai') !== false) $osClass = 'os-selesai';
                    elseif(strpos($st, 'batal') !== false) $osClass = 'os-batal';
                @endphp
                <li class="order-item">
                    <div class="order-left">
                        <div class="order-thumb">
                            @if($claim->item && $claim->item->foto_path)
                                <img src="{{ asset('storage/' . $claim->item->foto_path) }}" alt="img">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#9CA3AF;"><i class="fas fa-image"></i></div>
                            @endif
                        </div>
                        <div class="order-meta">
                            <h4>#{{ str_pad($claim->id, 5, '0', STR_PAD_LEFT) }} — {{ Str::limit($claim->item->nama_item ?? 'N/A', 24) }}</h4>
                            <p>{{ $claim->user->name ?? 'User Dihapus' }} · {{ $claim->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="order-right">
                        <div class="order-price">Rp {{ number_format($claim->item->harga ?? 0, 0, ',', '.') }}</div>
                        <div class="order-status {{ $osClass }}">{{ $claim->status_klaim }}</div>
                    </div>
                </li>
            @empty
                <li style="text-align: center; padding: 40px 0; color: var(--sage-dark);">
                    <i class="fas fa-inbox" style="font-size: 32px; color: var(--sage-border); margin-bottom: 12px; display: block;"></i>
                    Belum ada pesanan masuk.
                </li>
            @endforelse
        </ul>
    </div>

    {{-- RIGHT: ITEM INVENTORY --}}
    <div class="panel-card">
        <div class="panel-header">
            <div class="panel-title"><i class="fas fa-boxes-stacked"></i> Produk Terbaru</div>
            <a href="{{ route('admin.items.index') }}" class="btn-view-all">Kelola →</a>
        </div>
        @forelse($recentItems as $item)
            <div class="inv-item">
                <div class="inv-thumb">
                    @if($item->foto_path)
                        <img src="{{ asset('storage/' . $item->foto_path) }}" alt="img">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#9CA3AF;font-size:12px;"><i class="fas fa-image"></i></div>
                    @endif
                </div>
                <div class="inv-meta">
                    <h5 title="{{ $item->nama_item }}">{{ $item->nama_item }}</h5>
                    <span>{{ $item->kategori->nama_kategori ?? '-' }} · Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                </div>
                @php
                    $isClass = 'is-tersedia';
                    if($item->status === 'Diproses') $isClass = 'is-diproses';
                    elseif($item->status === 'Terjual') $isClass = 'is-terjual';
                @endphp
                <span class="inv-status {{ $isClass }}">{{ $item->status }}</span>
            </div>
        @empty
            <p style="text-align: center; padding: 30px 0; color: var(--sage-dark); font-size: 14px;">Belum ada produk.</p>
        @endforelse
    </div>
</div>

@endsection