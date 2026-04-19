<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Thrift-In</title>
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
        .btn-outline:hover { background: var(--white); border-color: var(--sage-dark); }
        
        /* HERO & LAYOUT */
        .header-spacer { height: 100px; }
        .settings-container { max-width: 800px; margin: 0 auto 100px; padding: 0 5%; }
        .page-title { font-size: 32px; font-weight: 800; margin-bottom: 8px; letter-spacing: -1px; }
        .page-desc { color: var(--sage-dark); font-size: 15px; margin-bottom: 40px; }

        /* CARDS & FORMS */
        .settings-card {
            background: var(--white); border-radius: var(--radius-lg); padding: 40px;
            box-shadow: 0 12px 32px rgba(110, 124, 111, 0.08); border: 1px solid var(--sage-border);
            margin-bottom: 30px;
        }
        .card-title { font-size: 20px; font-weight: 800; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; }
        .card-desc { font-size: 14px; color: var(--sage-dark); margin-bottom: 24px; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-weight: 700; font-size: 13px; color: var(--charcoal);
            margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .form-control {
            width: 100%; padding: 16px; border-radius: 12px; border: 2px solid var(--sage-border);
            background: #FAF9F6; font-family: inherit; font-size: 15px; color: var(--charcoal);
            transition: border-color 0.3s, background 0.3s;
        }
        .form-control:focus { outline: none; border-color: var(--sage-dark); background: var(--white); }
        
        .btn-submit {
            padding: 16px 32px; background: var(--charcoal); color: var(--white);
            border-radius: var(--radius-full); font-weight: 700; font-size: 15px;
            border: none; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
            display: inline-flex; align-items: center; gap: 8px; margin-top: 12px;
        }
        .btn-submit:hover { background: #000; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }

        .btn-danger { background: #fee2e2; color: #991b1b; }
        .btn-danger:hover { background: #fecaca; box-shadow: 0 8px 24px rgba(153, 27, 27, 0.15); color: #7f1d1d;}

        .alert-success { background: var(--sage-primary); color: var(--charcoal); padding: 16px; border-radius: 12px; font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;}
        .alert-error { background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 12px; font-weight: 600; margin-bottom: 24px; font-size: 14px;}
        .alert-error ul { margin-top: 8px; padding-left: 20px; }

        /* PROFILE PHOTO */
        .photo-upload-area {
            display: flex; align-items: center; gap: 24px;
        }
        .photo-preview {
            width: 100px; height: 100px; border-radius: 50%; object-fit: cover;
            border: 4px solid var(--sage-border); background: #F3F4F6;
            display: flex; align-items: center; justify-content: center;
            font-size: 36px; font-weight: 800; color: var(--sage-dark); overflow: hidden;
            flex-shrink: 0;
        }
        .photo-preview img { width: 100%; height: 100%; object-fit: cover; }
        .photo-actions { display: flex; flex-direction: column; gap: 8px; }
        .photo-actions p { font-size: 12px; color: var(--sage-dark); }
        .btn-upload-file {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px;
            background: var(--charcoal); color: var(--white); border: none; border-radius: var(--radius-full);
            font-weight: 600; font-size: 14px; cursor: pointer; transition: var(--transition-smooth);
        }
        .btn-upload-file:hover { background: #000; }
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
            <a href="{{ route('customer.klaim.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali ke Dasbor</a>
        </div>
    </nav>

    <div class="header-spacer"></div>

    <main class="settings-container">
        <h1 class="page-title">Pengaturan Akun</h1>
        <p class="page-desc">Kelola informasi pribadi dan keamanan profil Anda.</p>

        @if (session('status') === 'profile-updated')
            <div class="alert-success"><i class="fas fa-check-circle"></i> Profil berhasil diperbarui.</div>
        @endif
        @if (session('status') === 'password-updated')
            <div class="alert-success"><i class="fas fa-key"></i> Kata sandi berhasil diperbarui.</div>
        @endif
        @if (session('status') === 'foto-updated')
            <div class="alert-success"><i class="fas fa-camera"></i> Foto profil berhasil diperbarui.</div>
        @endif
        @if ($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan pengisian form:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 0. FOTO PROFIL -->
        <div class="settings-card">
            <h2 class="card-title"><i class="fas fa-camera" style="color: var(--sage-dark);"></i> Foto Profil</h2>
            <p class="card-desc">Unggah foto profil Anda agar mudah dikenali.</p>
            
            <form method="post" action="{{ route('profile.foto') }}" enctype="multipart/form-data">
                @csrf
                <div class="photo-upload-area">
                    <div class="photo-preview">
                        @if ($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil">
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="photo-actions">
                        <label for="foto_profil" class="btn-upload-file"><i class="fas fa-upload"></i> Pilih Foto</label>
                        <input type="file" id="foto_profil" name="foto_profil" accept="image/*" style="display: none;" onchange="previewFoto(this)">
                        <p>JPG, PNG, atau WEBP. Maks 2MB.</p>
                        <button type="submit" class="btn-submit" style="margin-top: 0; padding: 10px 20px; font-size: 13px;">Simpan Foto</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- 1. INFORMASI PROFIL -->
        <div class="settings-card">
            <h2 class="card-title"><i class="fas fa-user-circle" style="color: var(--sage-dark);"></i> Informasi Pribadi</h2>
            <p class="card-desc">Perbarui nama dan alamat email akun Anda.</p>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="email">
                </div>

                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>

        <!-- 2. UBAH KATA SANDI -->
        <div class="settings-card">
            <h2 class="card-title"><i class="fas fa-lock" style="color: var(--sage-dark);"></i> Keamanan & Sandi</h2>
            <p class="card-desc">Pastikan akun Anda menggunakan kata sandi panjang dan acak agar tetap aman.</p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password" required>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                </div>

                <button type="submit" class="btn-submit">Ubah Kata Sandi</button>
            </form>
        </div>

        <!-- 3. HAPUS AKUN -->
        <div class="settings-card" style="border-color: #fecaca; background: #fff5f5;">
            <h2 class="card-title" style="color: #991b1b;"><i class="fas fa-user-slash"></i> Hapus Akun Permanen</h2>
            <p class="card-desc" style="color: #b91c1c;">Setelah akun Anada dihapus, semua sumber daya dan data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda sangat yakin ingin menghapus akun secara permanen?');">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="password_delete">Konfirmasi Kata Sandi untuk Menghapus</label>
                    <input type="password" id="password_delete" name="password" class="form-control" placeholder="Masukkan sandi Anda..." required>
                </div>

                <button type="submit" class="btn-submit btn-danger">Hapus Akun Saya</button>
            </form>
        </div>

    </main>

    <script>
        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('.photo-preview');
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>
