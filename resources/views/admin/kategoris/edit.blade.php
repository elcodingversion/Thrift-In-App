@extends('layouts.admin')

@section('title', 'Edit Kategori: ' . $category->name)

@push('styles')
<style>
    /* Main Layout */
    .edit-category-container {
        max-width: 800px;
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
        background: linear-gradient(90deg, #EBD180, var(--soft-yellow)); /* Yellow gradient for edit */
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
        color: #8B7B3F;
        background: var(--soft-yellow);
        padding: 10px;
        border-radius: 12px;
        font-size: 18px;
        box-shadow: var(--shadow-sm);
    }
    .card-subtitle {
        color: var(--sage-dark);
        font-size: 14px;
        margin-left: 52px; /* Align with text */
    }

    /* Form Body */
    .card-body {
        padding: var(--spacing-lg) var(--spacing-lg) var(--spacing-md);
    }

    /* FormGroup */
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
    .form-control {
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
    textarea.form-control {
        padding: 16px; 
        min-height: 120px;
        resize: vertical;
        line-height: 1.6;
    }
    
    .form-control::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }
    .form-control:focus {
        outline: none;
        border-color: #EBD180;
        box-shadow: 0 0 0 4px rgba(245, 230, 184, 0.4);
    }
    .form-control:focus + .input-icon, 
    .form-control:focus ~ .input-icon {
        color: var(--charcoal);
    }

    .form-control[readonly] {
        background-color: #FAFAFA;
        color: var(--sage-dark);
        cursor: not-allowed;
        border-color: #EFEFEF;
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

    /* Helper Text */
    .form-hint {
        font-size: 13px;
        color: var(--sage-dark);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
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
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 640px) {
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
        .card-heading, .card-body {
            padding: var(--spacing-md);
        }
        .card-subtitle {
            margin-left: 0;
            margin-top: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="edit-category-container">
    {{-- Modern Breadcrumb --}}
    <div class="breadcrumb-modern">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home"></i> Home
        </a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('admin.kategoris.index') }}">
            Daftar Kategori
        </a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span class="breadcrumb-current">
            <i class="fas fa-pen"></i> Edit Kategori
        </span>
    </div>

    {{-- Premium Form Card --}}
    <div class="modern-card">
        <div class="card-heading">
            <h2 class="card-title">
                <i class="fas fa-pen-nib"></i>
                Edit Kategori: {{ $category->name }}
            </h2>
            <p class="card-subtitle">Perbarui informasi kategori produk ini. Pastikan slug belum digunakan kategori lain.</p>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kategoris.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Kategori --}}
                <div class="form-group">
                    <label for="name" class="form-label required">Nama Kategori</label>
                    <div class="input-wrapper">
                        <i class="fas fa-tag input-icon"></i>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               placeholder="Contoh: Pakaian Pria, Elektronik, Aksesoris..."
                               required
                               autocomplete="off">
                    </div>
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Slug Kategori --}}
                <div class="form-group">
                    <label for="slug" class="form-label">Slug (URL Kategori)</label>
                    <div class="input-wrapper">
                        <i class="fas fa-link input-icon"></i>
                        <input type="text" 
                               class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug', $category->slug) }}" 
                               readonly
                               required>
                    </div>
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i> URL otomatis diperbarui mengikuti perubahan nama kategori.
                    </div>
                    @error('slug')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Deskripsi (jika di migrasi ada kolom deskripsi) --}}
                {{-- Karena sebelumnya di index.blade.php disebut description ($category->description), saya tambahkan juga untuk edit --}}
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="description" class="form-label">Deskripsi Kategori</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              placeholder="Ceritakan dengan singkat barang apa saja yang akan masuk ke kategori ini... (Opsional)">{{ old('description', $category->description ?? '') }}</textarea>
                    <div class="form-hint">
                        <i class="far fa-comment-dots"></i> Opsional: Membantu pembeli memahami kelompok produk ini.
                    </div>
                    @error('description')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <a href="{{ route('admin.kategoris.index') }}" class="btn btn-cancel">
                        Batalkan
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('keyup', function() {
                // Generate slug: lowercase, replace invalid chars, trim, replace spaces with single dash
                let slug = this.value.toLowerCase().trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-');
                
                slugInput.value = slug;
            });
        }
    });
</script>
@endpush