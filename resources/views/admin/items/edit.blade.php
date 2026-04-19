@extends('layouts.admin')

@section('title', 'Edit Item: ' . $item->nama_item)

@push('styles')
<style>
    /* Main Layout */
    .edit-item-container {
        max-width: 900px;
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

    /* Premium Card Design for Edit (Amber Accent) */
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
        top: 0; left: 0; right: 0; height: 6px;
        background: linear-gradient(90deg, #F59E0B, #FBBF24);
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
        color: #B45309;
        background: #FEF3C7;
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
    
    .form-select {
        padding-left: 44px;
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

    .form-control[type="number"]::-webkit-inner-spin-button, 
    .form-control[type="number"]::-webkit-outer-spin-button { 
        -webkit-appearance: none; margin: 0; 
    }
    
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #FBBF24;
        box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.25);
    }
    .form-control:focus + .input-icon, 
    .form-control:focus ~ .input-icon,
    .form-select:focus + .input-icon,
    .form-select:focus ~ .input-icon {
        color: var(--charcoal);
    }

    /* File Input & Current Image Preview */
    .image-preview-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 24px;
    }
    .current-image {
        width: 120px;
        height: 120px;
        flex-shrink: 0;
        border-radius: 12px;
        border: 1px solid var(--sage-border);
        overflow: hidden;
        background: #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-sm);
    }
    .current-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .current-image i {
        font-size: 30px;
        color: #9CA3AF;
    }

    .file-drop-area {
        flex: 1;
        border: 2px dashed var(--sage-border);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        background: var(--white);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }
    .file-drop-area:hover {
        border-color: #FBBF24;
        background: #FFFBEB;
    }
    .file-drop-area i {
        font-size: 28px;
        color: var(--sage-dark);
        margin-bottom: 8px;
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

    /* Adjust utilities */
    .row { display: flex; flex-wrap: wrap; margin-right: -12px; margin-left: -12px; }
    .col-md-6 { flex: 0 0 50%; max-width: 50%; padding-right: 12px; padding-left: 12px; }
    .col-md-4 { flex: 0 0 33.333333%; max-width: 33.333333%; padding-right: 12px; padding-left: 12px; }
    
    @media (max-width: 768px) {
        .col-md-6, .col-md-4 { flex: 0 0 100%; max-width: 100%; }
        .form-actions { flex-direction: column-reverse; }
        .btn { width: 100%; justify-content: center; }
        .image-preview-wrapper { flex-direction: column; align-items: stretch; gap: 16px; }
        .current-image { width: 100%; height: 200px; }
    }
    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush

@section('content')
<div class="edit-item-container">
    {{-- Modern Breadcrumb --}}
    <div class="breadcrumb-modern">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('admin.items.index') }}">Daftar Item</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span class="breadcrumb-current"><i class="fas fa-pen"></i> Edit Item</span>
    </div>

    {{-- Premium Form Card --}}
    <div class="modern-card">
        <div class="card-heading">
            <h2 class="card-title">
                <i class="fas fa-pen-nib"></i>
                Edit Item: {{ $item->nama_item }}
            </h2>
            <p class="card-subtitle">Perbarui spesifikasi produk. Biarkan kolom foto kosong jika tidak ingin mengganti gambar.</p>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- INFORMASI DASAR --}}
                <div class="form-section">
                    <div class="form-section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Produk</div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_item" class="form-label required">Nama Item</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-tag input-icon"></i>
                                    <input type="text" class="form-control @error('nama_item') is-invalid @enderror" id="nama_item" name="nama_item" value="{{ old('nama_item', $item->nama_item) }}" placeholder="Contoh: Kemeja Flannel Vintage" required>
                                </div>
                                @error('nama_item')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_id" class="form-label required">Kategori Produk</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-layer-group input-icon"></i>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                        <option value="" disabled>Pilih kategori yang sesuai...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('kategori_id', $item->kategori_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama_kategori ?? $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kategori_id')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="deskripsi" class="form-label">Deskripsi Produk Ringkas</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" placeholder="Tuliskan spesifikasi produk, bahan, atau kondisi barang (opsional)...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- HARGA & SPESIFIKASI --}}
                <div class="form-section">
                    <div class="form-section-title"><i class="fas fa-tags"></i> Harga & Status</div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="harga" class="form-label required">Harga Normal (Rp)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-money-bill-wave input-icon"></i>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $item->harga) }}" min="1000" required>
                                </div>
                                @error('harga')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="harga_diskon" class="form-label">Harga Sale / Diskon (Rp)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-percent input-icon"></i>
                                    <input type="number" class="form-control @error('harga_diskon') is-invalid @enderror" id="harga_diskon" name="harga_diskon" value="{{ old('harga_diskon', $item->harga_diskon) }}" placeholder="Kosongkan jika tidak sale" min="0">
                                </div>
                                @error('harga_diskon')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ukuran" class="form-label required">Ukuran (Size)</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-ruler input-icon"></i>
                                    <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran" value="{{ old('ukuran', $item->ukuran) }}" maxlength="50" required>
                                </div>
                                @error('ukuran')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status" class="form-label required">Status Barang</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-check-circle input-icon"></i>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="Tersedia" {{ old('status', $item->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="Diproses" {{ old('status', $item->status) == 'Diproses' ? 'selected' : '' }}>Diproses (Di-booking)</option>
                                        <option value="Terjual" {{ old('status', $item->status) == 'Terjual' ? 'selected' : '' }}>Terjual (Sold Out)</option>
                                    </select>
                                </div>
                                @error('status')<div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MEDIA / FOTO --}}
                <div class="form-section mb-0">
                    <div class="form-section-title"><i class="fas fa-image"></i> Visual Produk</div>
                    
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Ganti Foto Utama (Opsional)</label>
                        <div class="image-preview-wrapper">
                            <div class="current-image" title="Gambar Saat Ini">
                                @if ($item->foto_path)
                                    <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama_item }}">
                                @else
                                    <i class="fas fa-image"></i>
                                @endif
                            </div>
                            <div class="file-drop-area @error('foto') is-invalid @enderror">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span id="file-name-display">Klik untuk memilih gambar atau seret file ke sini</span>
                                <small>Hanya pilih gambar jika Anda ingin mengganti foto yang sudah ada. Maks: 2 MB.</small>
                                <input class="file-input-hidden" type="file" id="foto" name="foto" accept="image/*" onchange="document.getElementById('file-name-display').textContent = this.files[0] ? this.files[0].name : 'Kosongkan jika tidak diganti';">
                            </div>
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
                        <i class="fas fa-save"></i> Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection