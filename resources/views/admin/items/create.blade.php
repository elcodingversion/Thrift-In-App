@extends('layouts.admin')

@section('title', 'Tambah Item Baru')

@push('styles')
<style>
    /* Main Layout */
    .create-item-container {
        max-width: 900px;
        margin: 0 auto;
        padding: var(--spacing-sm) 0;
        animation: fadeSlideUp 0.5s ease-out;
    }

    /* Breadcrumb adjustments */
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
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--sage-secondary), var(--sage-primary));
    }

    /* Header */
    .card-heading {
        padding: var(--spacing-lg) var(--spacing-lg) var(--spacing-sm);
        border-bottom: 1px solid rgba(230, 238, 228, 0.5);
    }
    .card-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--charcoal);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .card-title i {
        color: var(--charcoal);
        background: var(--sage-primary);
        padding: 10px;
        border-radius: 12px;
        font-size: 18px;
        box-shadow: var(--shadow-sm);
    }
    .card-subtitle {
        color: var(--sage-dark);
        font-size: 14px;
        margin-left: 52px;
    }

    /* Form Body */
    .card-body {
        padding: var(--spacing-lg) var(--spacing-lg) var(--spacing-md);
    }

    /* Group Styling */
    .form-section {
        margin-bottom: var(--spacing-lg);
        background: #FAFAFA;
        padding: var(--spacing-md);
        border-radius: 12px;
        border: 1px solid var(--sage-border);
    }
    .form-section-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--sage-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: var(--spacing-md);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group {
        margin-bottom: var(--spacing-md);
        position: relative;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--charcoal);
        margin-bottom: 8px;
    }
    .form-label.required::after {
        content: " *";
        color: #e53e3e;
    }
    
    /* Input Wrapper */
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-icon {
        position: absolute;
        left: 16px;
        color: var(--sage-dark);
        font-size: 16px;
        transition: color 0.3s ease;
        z-index: 2;
    }

    /* Inputs */
    .form-control, .form-select {
        width: 100%;
        padding: 14px 16px 14px 44px;
        border: 1.5px solid var(--sage-border);
        border-radius: 12px;
        background: var(--white);
        font-family: inherit;
        font-size: 15px;
        color: var(--charcoal);
        transition: all 0.3s ease;
        position: relative;
    }
    
    /* Removed padding-left for select to let default arrow be visible but also keep icon?
       Actually, standard select is tricky with icons. We'll add custom style for it. */
    .form-select {
        padding-left: 44px; /* Space for absolute icon */
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236E7C6F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        background-size: 16px;
    }

    textarea.form-control {
        padding: 16px; 
        min-height: 120px;
        resize: vertical;
        line-height: 1.6;
    }

    /* Remove spinner from number input */
    .form-control[type="number"]::-webkit-inner-spin-button, 
    .form-control[type="number"]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    
    .form-control::placeholder, .form-select:invalid {
        color: #a0aec0;
        font-weight: 400;
    }
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--sage-primary);
        box-shadow: 0 0 0 4px rgba(201, 217, 195, 0.25);
    }
    .form-control:focus + .input-icon, 
    .form-control:focus ~ .input-icon,
    .form-select:focus + .input-icon,
    .form-select:focus ~ .input-icon {
        color: var(--charcoal);
    }

    /* File Input Premium */
    .file-drop-area {
        border: 2px dashed var(--sage-border);
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        background: var(--white);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }
    .file-drop-area:hover {
        border-color: var(--sage-primary);
        background: #F7FAF7;
    }
    .file-drop-area i {
        font-size: 32px;
        color: var(--sage-dark);
        margin-bottom: 12px;
    }
    .file-drop-area span {
        display: block;
        font-size: 14px;
        color: var(--charcoal);
        font-weight: 500;
    }
    .file-drop-area small {
        display: block;
        color: var(--sage-dark);
        font-size: 12px;
        margin-top: 4px;
    }
    .file-input-hidden {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Validations */
    .is-invalid {
        border-color: #e53e3e !important;
        background-color: #fff5f5 !important;
    }
    .is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1) !important;
    }
    .invalid-feedback {
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        animation: slideInLeft 0.3s ease;
    }

    /* Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 16px;
        margin-top: var(--spacing-lg);
        padding-top: var(--spacing-md);
        border-top: 1px dashed var(--sage-border);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        letter-spacing: 0.3px;
    }

    .btn-cancel {
        background: var(--white);
        color: var(--charcoal);
        border: 1.5px solid var(--sage-border);
    }
    .btn-cancel:hover {
        background: var(--sage-border);
        color: var(--charcoal);
    }

    .btn-submit {
        background: var(--charcoal);
        color: var(--white);
        box-shadow: 0 4px 12px rgba(47, 47, 47, 0.2);
    }
    .btn-submit:hover {
        background: #1a1a1a;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(47, 47, 47, 0.3);
    }
    .btn-submit:active {
        transform: translateY(0);
    }

    /* Animation */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Utilities */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -12px;
        margin-left: -12px;
    }
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 12px;
        padding-left: 12px;
    }
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        padding-right: 12px;
        padding-left: 12px;
    }
    
    @media (max-width: 768px) {
        .col-md-6, .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .form-actions {
            flex-direction: column-reverse;
        }
        .btn {
            width: 100%;
            justify-content: center;
        }
        .modern-card {
            border-radius: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="create-item-container">
    {{-- Modern Breadcrumb --}}
    <div class="breadcrumb-modern">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home"></i> Home
        </a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('admin.items.index') }}">
            Daftar Item
        </a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span class="breadcrumb-current">
            <i class="fas fa-plus"></i> Tambah Baru
        </span>
    </div>

    {{-- Premium Form Card --}}
    <div class="modern-card">
        <div class="card-heading">
            <h2 class="card-title">
                <i class="fas fa-box-open"></i>
                Tambah Item Baru
            </h2>
            <p class="card-subtitle">Lengkapi formulir di bawah ini untuk menambahkan produk baru ke katalog toko Anda.</p>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- INFORMASI DASAR --}}
                <div class="form-section">
                    <div class="form-section-title"><i class="fas fa-info-circle"></i> Informasi Dasar</div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_item" class="form-label required">Nama Item</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-tag input-icon"></i>
                                    <input type="text" class="form-control @error('nama_item') is-invalid @enderror" id="nama_item" name="nama_item" value="{{ old('nama_item') }}" placeholder="Contoh: Kemeja Flannel Vintage" autofocus autocomplete="off">
                                </div>
                                @error('nama_item')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_id" class="form-label required">Kategori Produk</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-layer-group input-icon"></i>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                        <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih kategori yang sesuai...</option>
                                        @foreach ($categories as $kategori) 
                                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kategori_id')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="deskripsi" class="form-label">Deskripsi Produk Ringkas</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" placeholder="Tuliskan spesifikasi produk, bahan, atau kondisi barang (opsional)...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- HARGA & SPESIFIKASI --}}
                <div class="form-section">
                    <div class="form-section-title"><i class="fas fa-tags"></i> Harga & Spesifikasi Lainnya</div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="harga" class="form-label required">Harga Normal (Rp)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-money-bill-wave input-icon"></i>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 150000" min="1000">
                                </div>
                                @error('harga')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="harga_diskon" class="form-label">Harga Sale / Diskon (Rp)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-percent input-icon"></i>
                                    <input type="number" class="form-control @error('harga_diskon') is-invalid @enderror" id="harga_diskon" name="harga_diskon" value="{{ old('harga_diskon') }}" placeholder="Kosongkan jika tidak sale" min="0">
                                </div>
                                @error('harga_diskon')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ukuran" class="form-label required">Ukuran (Size)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-ruler input-icon"></i>
                                    <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran" value="{{ old('ukuran') }}" placeholder="Contoh: M, L, XL, 42..." maxlength="50">
                                </div>
                                @error('ukuran')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status" class="form-label required">Status Barang</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-check-circle input-icon"></i>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="Tersedia" {{ old('status', 'Tersedia') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses (Di-booking)</option>
                                        <option value="Terjual" {{ old('status') == 'Terjual' ? 'selected' : '' }}>Terjual (Sold Out)</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MEDIA / FOTO --}}
                <div class="form-section mb-0">
                    <div class="form-section-title"><i class="fas fa-image"></i> Visual Produk</div>
                    
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="foto" class="form-label required">Foto Utama</label>
                        <div class="file-drop-area @error('foto') is-invalid @enderror">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span id="file-name-display">Klik untuk memilih gambar atau seret file ke sini</span>
                            <small>Mendukung JPG, PNG, GIF, JPEG. Berkas maksimal berukuran 2 MB.</small>
                            <input class="file-input-hidden" type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/gif" required onchange="document.getElementById('file-name-display').textContent = this.files[0] ? this.files[0].name : 'Klik untuk memilih gambar atau seret file ke sini';">
                        </div>
                        @error('foto')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <a href="{{ route('admin.items.index') }}" class="btn btn-cancel">
                        Batalkan
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> Simpan Item Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection