<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan import ini

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('login');
        }
        
        // 2. Cek apakah pengguna yang login adalah admin (Asumsi ada kolom is_admin=1 di tabel users)
        // Ganti Auth::user()->is_admin == 1 sesuai dengan kolom role/admin di model User Anda
        if (Auth::user()->is_admin == 1) { 
            return $next($request); // Lolos: Lanjutkan ke Admin Panel
        }

        // 3. Jika bukan admin, redirect ke halaman utama (atau tampilkan 403 Forbidden)
        return redirect('/')->with('error', 'Akses ditolak. Anda tidak memiliki izin Admin.'); 
    }
}