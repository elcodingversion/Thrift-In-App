<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\KlaimAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| UNIVERSAL DASHBOARD REDIRECT (USER & ADMIN)
|--------------------------------------------------------------------------
| Mengarahkan ke dashboard yang sesuai. (Pengecekan 'can:admin' di sini tetap diperlukan 
| agar redirect otomatis tetap bekerja, tapi bukan di middleware grup Admin)
*/

Route::get('/dashboard', function () {
    // Jika user admin, arahkan ke admin dashboard.
    if (auth()->check() && auth()->user()->can('admin')) {
        return redirect()->route('admin.dashboard');
    }
    
    // Jika user biasa, arahkan ke dasbor pengguna (profil riwayat klaim).
    return redirect()->route('customer.klaim.index');

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| ROUTES | KUSTOMER (PUBLIK & USER TERDAFTAR)
|--------------------------------------------------------------------------
*/

// == PUBLIC ACCESS ROUTES ==
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::controller(CustomerController::class)->group(function () {
    Route::get('/katalog', 'index')->name('katalog.index');
    Route::get('/katalog/item/{item}', 'show')->name('katalog.show');
});


// == AUTHENTICATED USER ROUTES ==
Route::middleware('auth')->group(function () {
    
    // ------------------------------------------------------------------
    // >>> PENAMBAHAN/MODIFIKASI: KLAIM GROUP UNTUK CUSTOMER <<<
    // Mengganti dan melengkapi rute klaim (history, create, store, edit, SHOW)
    // ------------------------------------------------------------------
    Route::controller(CustomerController::class)->group(function () {
        
        // Riwayat Klaim User (customer.klaim.index)
        // URL: /riwayat-klaim
        Route::get('/riwayat-klaim', 'history')->name('customer.klaim.index'); 
        
        // PENAMBAHAN BARU: Detail Klaim (customer.klaim.show)
        // URL: /riwayat-klaim/{klaim}
        Route::get('/riwayat-klaim/{klaim}', 'showKlaim')->name('customer.klaim.show'); // <<< RUTE YANG HILANG DITAMBAHKAN
        
        // 1. Tampilkan Formulir Pengajuan Klaim Baru (customer.klaim.create)
        // URL: /klaim/create
        Route::get('/klaim/create', 'createKlaim')->name('customer.klaim.create');
        
        // 2. Proses Simpan Klaim Baru (customer.klaim.store)
        // URL: /klaim
        Route::post('/klaim', 'storeKlaim')->name('customer.klaim.store');

        // 3. Proses Klaim Langsung dari Halaman Item (klaim.item - POST)
        // URL: /klaim/{item}
        Route::post('/klaim/{item}', 'klaimItem')->name('klaim.item'); 
        
        // 4. Edit, Update, & Batalkan Klaim
        // URL: /klaim/{klaim}/edit
        Route::get('/klaim/{klaim}/edit', 'editKlaim')->name('customer.klaim.edit');
        // URL: /klaim/{klaim}
        Route::patch('/klaim/{klaim}', 'updateKlaim')->name('customer.klaim.update');
        // URL: DELETE /klaim/{klaim}
        Route::delete('/klaim/{klaim}', 'destroyKlaim')->name('customer.klaim.destroy');
    });

    // 3. Route Bawaan Breeze untuk Profil User (tetap sama)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])->name('profile.foto');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ROUTES | ADMIN PANEL (PROTEKSI: auth SAJA)
|--------------------------------------------------------------------------
| Catatan: Menggunakan 'auth' saja berarti Admin dan User yang login 
| bisa mengaksesnya jika tahu URL-nya.
*/

// PERUBAHAN KRITIS: HANYA MENYISAKAN 'auth'
Route::middleware(['auth']) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function () { 

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 1. CRUD KATEGORI
        Route::resource('kategoris', KategoriController::class)
            ->parameters([
                'kategoris' => 'kategori'
            ]); 

        // 2. CRUD ITEM
        Route::resource('items', ItemController::class);

        // 2. DATA KLAIM MASUK
        Route::controller(KlaimAdminController::class)->group(function () {
            Route::get('klaims', 'index')->name('klaims.index'); 
            Route::patch('klaims/{klaim}/confirm', 'confirm')->name('klaims.confirm'); 
            Route::patch('klaims/{klaim}/reject', 'reject')->name('klaims.reject'); 
            Route::patch('klaims/{klaim}/ship', 'ship')->name('klaims.ship'); 
            Route::patch('klaims/{klaim}/complete', 'complete')->name('klaims.complete'); 
        });

    }); 


require __DIR__.'/auth.php';