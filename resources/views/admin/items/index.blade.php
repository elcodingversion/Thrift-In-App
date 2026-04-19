@extends('layouts.admin')

@section('title', 'Daftar Produk')

@push('styles')
<style>
    /* Main Layout */
    .item-index-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: var(--spacing-sm) 0;
        animation: fadeSlideUp 0.5s ease-out;
    }

    /* Breadcrumb */
    .breadcrumb-modern {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: var(--spacing-lg);
        font-size: 14px;
        font-weight: 500;
        background: var(--white);
        padding: 12px 20px;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--sage-border);
    }
    .breadcrumb-modern a {
        color: var(--sage-dark);
        text-decoration: none;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .breadcrumb-modern a:hover {
        color: var(--charcoal);
    }
    .breadcrumb-separator {
        color: var(--sage-secondary);
        font-size: 11px;
    }
    .breadcrumb-current {
        color: var(--charcoal);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Alerts */
    .alert-modern {
        border-radius: var(--radius);
        padding: 16px 20px;
        margin-bottom: var(--spacing-lg);
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideInDown 0.4s ease-out;
        border: none;
        box-shadow: var(--shadow-sm);
    }
    .alert-modern i { font-size: 20px; }
    .alert-modern .btn-close {
        margin-left: auto; padding: 0; background: transparent; border: none; font-size: 16px; cursor: pointer; opacity: 0.6;
    }
    .alert-modern .btn-close:hover { opacity: 1; }
    .alert-success-modern { background-color: #F0FDF4; color: #166534; border-left: 4px solid #22C55E; }
    .alert-danger-modern { background-color: #FEF2F2; color: #991B1B; border-left: 4px solid #EF4444; }

    @keyframes slideInDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    /* Premium Card Design */
    .modern-card {
        background: var(--white);
        border: 1px solid var(--sage-border);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
        position: relative;
    }
    .modern-card::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px;
        background: linear-gradient(90deg, var(--sage-secondary), var(--sage-primary));
    }

    /* Header */
    .card-heading {
        padding: var(--spacing-lg);
        border-bottom: 1px solid rgba(230, 238, 228, 0.5);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .card-title-group { display: flex; align-items: center; gap: 16px; }
    .card-title-icon {
        color: var(--charcoal); background: var(--sage-primary); width: 44px; height: 44px;
        display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 18px; box-shadow: var(--shadow-sm);
    }
    .card-title-text h2 { font-size: 20px; font-weight: 700; color: var(--charcoal); margin: 0 0 4px 0; }
    .card-title-text p { color: var(--sage-dark); font-size: 13px; margin: 0; }
    
    .btn-add {
        display: inline-flex; align-items: center; gap: 8px; background: var(--charcoal); color: var(--white);
        padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(47, 47, 47, 0.2);
    }
    .btn-add:hover {
        background: #1a1a1a; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(47, 47, 47, 0.3); color: var(--white);
    }

    /* Action Bar (Search & Filters) */
    .action-bar { padding: 20px var(--spacing-lg) 0 var(--spacing-lg); }
    .filter-wrapper {
        display: flex; gap: 12px; background: var(--cream-bg); padding: 16px; border-radius: 12px;
        border: 1px dashed var(--sage-border); flex-wrap: wrap; align-items: center;
    }
    
    .filter-input-group { position: relative; flex: 2; min-width: 200px; }
    .filter-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--sage-dark); font-size: 14px; z-index: 2;}
    
    .filter-select-group { position: relative; flex: 1; min-width: 150px; }
    
    .filter-input, .filter-select {
        width: 100%; border: 1px solid var(--sage-border); border-radius: 8px; font-size: 14px; outline: none; transition: all 0.3s ease; background: var(--white); color: var(--charcoal);
    }
    .filter-input { padding: 10px 14px 10px 40px; }
    .filter-select { padding: 10px 14px 10px 36px; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236E7C6F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 14px; }
    
    .filter-input:focus, .filter-select:focus { border-color: var(--sage-primary); box-shadow: 0 0 0 3px rgba(201, 217, 195, 0.3); }

    .filter-actions { display: flex; gap: 8px; flex-shrink: 0; }
    .btn-search, .btn-reset {
        padding: 10px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; border: none;
        display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; text-decoration: none;
    }
    .btn-search { background: var(--white); color: var(--charcoal); border: 1px solid var(--sage-border); }
    .btn-search:hover { background: var(--sage-primary); border-color: var(--sage-primary); }
    .btn-reset { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
    .btn-reset:hover { background: #FEE2E2; }

    /* Table Styles */
    .table-container { padding: var(--spacing-lg); overflow-x: auto; }
    .modern-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .modern-table th {
        background: #FAFAFA; padding: 14px 16px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;
        color: var(--sage-dark); font-weight: 700; border-bottom: 2px solid var(--sage-border); border-top: 1px solid var(--sage-border); text-align: left;
    }
    .modern-table th:first-child { border-left: 1px solid var(--sage-border); border-top-left-radius: 10px; }
    .modern-table th:last-child { border-right: 1px solid var(--sage-border); border-top-right-radius: 10px; text-align: center; }
    
    .modern-table td {
        padding: 16px; font-size: 14px; color: var(--charcoal); border-bottom: 1px solid var(--sage-border);
        vertical-align: middle; background: var(--white); transition: background 0.2s ease;
    }
    .modern-table tr:last-child td:first-child { border-bottom-left-radius: 10px; border-left: 1px solid var(--sage-border); }
    .modern-table tr:last-child td:last-child { border-bottom-right-radius: 10px; border-right: 1px solid var(--sage-border); }
    .modern-table tr td:first-child { border-left: 1px solid var(--sage-border); }
    .modern-table tr td:last-child { border-right: 1px solid var(--sage-border); }

    .modern-table tbody tr:hover td { background: #FCFCFC; }

    /* Item Info Formatting */
    .item-info { display: flex; align-items: center; gap: 12px; }
    .item-img {
        width: 48px; height: 48px; border-radius: 8px; object-fit: cover; border: 1px solid var(--sage-border); background: #F3F4F6; display: flex; align-items: center; justify-content: center; color: #9CA3AF; flex-shrink: 0;
    }
    .item-details { display: flex; flex-direction: column; }
    .item-name { font-weight: 600; color: var(--charcoal); font-size: 15px; margin-bottom: 4px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .item-cat { font-size: 12px; color: var(--sage-dark); display: flex; align-items: center; gap: 4px; }
    
    .item-price { font-weight: 700; color: var(--charcoal); font-size: 15px; }

    /* Badges */
    .status-badge {
        display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;
    }
    .status-tersedia { background: #ECFCCB; color: #4D7C0F; border: 1px solid #D9F99D; }
    .status-diproses { background: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; }
    .status-terjual { background: #F3F4F6; color: #4B5563; border: 1px solid #E5E7EB; text-decoration: line-through; }
    
    .size-badge {
        display: inline-flex; align-items: center; justify-content: center; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; background: var(--cream-bg); color: var(--sage-dark); border: 1px solid var(--sage-border); margin-top: 4px;
    }

    /* Action Buttons in Table */
    .table-actions { display: flex; gap: 8px; justify-content: center; }
    .btn-icon {
        width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 13px; transition: all 0.2s ease; text-decoration: none; border: none; cursor: pointer;
    }
    .btn-edit { background: #FEF3C7; color: #D97706; }
    .btn-edit:hover { background: #FDE68A; transform: translateY(-2px); }
    .btn-delete { background: #FEE2E2; color: #DC2626; }
    .btn-delete:hover { background: #FECACA; transform: translateY(-2px); }

    /* Empty State */
    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-state-icon { font-size: 48px; color: var(--sage-secondary); margin-bottom: 16px; }
    .empty-state h4 { margin: 0 0 8px 0; color: var(--charcoal); font-size: 18px; font-weight: 600; }
    .empty-state p { margin: 0; color: var(--sage-dark); font-size: 14px; }

    /* Pagination */
    .pagination-wrapper { padding: 0 var(--spacing-lg) var(--spacing-lg) var(--spacing-lg); display: flex; justify-content: center; }
    .pagination { display: flex; gap: 6px; list-style: none; padding: 0; margin: 0; }
    .page-item .page-link {
        display: flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; background: var(--white); border: 1px solid var(--sage-border); color: var(--charcoal); font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.2s ease;
    }
    .page-item .page-link:hover { background: var(--sage-primary); border-color: var(--sage-primary); }
    .page-item.active .page-link { background: var(--charcoal); border-color: var(--charcoal); color: var(--white); }
    .page-item.disabled .page-link { background: var(--cream-bg); color: #A0AEC0; cursor: not-allowed; }

    /* Animation */
    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Responsive */
    @media (max-width: 768px) {
        .card-heading { flex-direction: column; align-items: flex-start; }
        .btn-add { width: 100%; justify-content: center; }
        .filter-wrapper { flex-direction: column; align-items: stretch; }
        .filter-actions { justify-content: stretch; width: 100%; }
        .filter-actions button, .filter-actions a { flex: 1; justify-content: center; }
        .modern-table th, .modern-table td { padding: 12px; }
    }
</style>
@endpush

@section('content')
<div class="item-index-container">
    {{-- Modern Breadcrumb --}}
    <div class="breadcrumb-modern">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span class="breadcrumb-current"><i class="fas fa-box"></i> Daftar Item</span>
    </div>

    {{-- Notifikasi Sukses/Gagal --}}
    @if (session('success'))
        <div class="alert-modern alert-success-modern" id="alert-message">
            <i class="fas fa-check-circle"></i>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
            <button type="button" class="btn-close" onclick="document.getElementById('alert-message').style.display='none'"><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert-modern alert-danger-modern" id="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div><strong>Gagal!</strong> {{ session('error') }}</div>
            <button type="button" class="btn-close" onclick="document.getElementById('alert-error').style.display='none'"><i class="fas fa-times"></i></button>
        </div>
    @endif

    {{-- Premium Main Card --}}
    <div class="modern-card">
        {{-- Card Header --}}
        <div class="card-heading">
            <div class="card-title-group">
                <div class="card-title-icon"><i class="fas fa-boxes"></i></div>
                <div class="card-title-text">
                    <h2>Manajemen Katalog</h2>
                    <p>Kelola daftar produk, update harga, stok ukuran, dan status barang.</p>
                </div>
            </div>
            <a href="{{ route('admin.items.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Produk Baru
            </a>
        </div>

        {{-- Search & Filter Action Bar --}}
        <div class="action-bar">
            <form action="{{ route('admin.items.index') }}" method="GET">
                <div class="filter-wrapper">
                    {{-- Search --}}
                    <div class="filter-input-group">
                        <i class="fas fa-search filter-icon"></i>
                        <input type="text" name="search" class="filter-input" placeholder="Cari nama barang..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                    
                    {{-- Category --}}
                    <div class="filter-select-group">
                        <i class="fas fa-layer-group filter-icon"></i>
                        <select name="category_id" class="filter-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="filter-select-group">
                        <i class="fas fa-filter filter-icon"></i>
                        @php
                            $statuses = ['Tersedia', 'Diproses', 'Terjual'];
                            $currentStatus = request('status', 'Semua');
                        @endphp
                        <select name="status" class="filter-select">
                            <option value="Semua" {{ $currentStatus == 'Semua' ? 'selected' : '' }}>Semua Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ $currentStatus == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="filter-actions">
                        <button type="submit" class="btn-search">Filter</button>
                        @if (request('search') || request('category_id') || request('status') && request('status') !== 'Semua')
                            <a href="{{ route('admin.items.index') }}" class="btn-reset" title="Hilangkan Filter">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Table Container --}}
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 35%;">Detail Produk</th>
                        <th style="width: 20%;">Harga</th>
                        <th class="text-center" style="width: 20%;">Status Barang</th>
                        <th style="width: 20%; text-align: center;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $index => $item)
                        <tr>
                            <td style="font-weight: 500; color: var(--sage-dark);">
                                {{ $items->firstItem() + $index }}
                            </td>
                            
                            <td>
                                <div class="item-info">
                                    <div class="item-img">
                                        @if($item->foto_path)
                                            <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama_item }}" style="width:100%; height:100%; object-fit:cover; border-radius: 8px;">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name" title="{{ $item->nama_item }}">{{ $item->nama_item }}</div>
                                        <div class="item-cat">
                                            <i class="fas fa-tag" style="font-size: 10px;"></i>
                                            {{ $item->kategori->nama_kategori ?? 'Kategori Dihapus' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="item-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                            </td>
                            
                            <td class="text-center">
                                @php
                                    $sClass = '';
                                    $sIcon = '';
                                    switch($item->status) {
                                        case 'Tersedia': $sClass = 'status-tersedia'; $sIcon = 'check-circle'; break;
                                        case 'Diproses': $sClass = 'status-diproses'; $sIcon = 'clock'; break;
                                        case 'Terjual': $sClass = 'status-terjual'; $sIcon = 'times-circle'; break;
                                        default: $sClass = 'status-tersedia'; $sIcon = 'info-circle';
                                    }
                                @endphp
                                <div class="status-badge {{ $sClass }}">
                                    <i class="fas fa-{{ $sIcon }} me-1" style="margin-right:4px;"></i> {{ $item->status }}
                                </div>
                                <div>
                                    <span class="size-badge">Size: {{ $item->ukuran }}</span>
                                </div>
                            </td>
                            
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.items.edit', $item->id) }}" class="btn-icon btn-edit" title="Edit Produk">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk \'{{ $item->nama_item }}\'? Tindakan in tidak bisa dikembalikan.');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" title="Hapus Produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-icon"><i class="fas fa-box-open"></i></div>
                                    @if(request('search') || request('category_id') || request('status') !== 'Semua')
                                        <h4>Produk Tidak Ditemukan</h4>
                                        <p>Tidak ada produk yang cocok dengan kombinasi filter pencarian Anda.</p>
                                    @else
                                        <h4>Katalog Masih Kosong</h4>
                                        <p>Belum ada produk yang ditambahkan ke katalog. Silakan klik tombol "Tambah Produk Baru".</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Wrapper --}}
        @if($items->hasPages())
            <div class="pagination-wrapper">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-modern');
        if(alerts.length > 0) {
            setTimeout(() => {
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => alert.style.display = 'none', 500);
                });
            }, 6000);
        }
    });
</script>
@endpush