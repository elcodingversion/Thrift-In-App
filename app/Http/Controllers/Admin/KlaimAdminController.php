<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Klaim; // Import Model Klaim
use Illuminate\Support\Facades\DB; // Untuk Transaction
use Illuminate\Http\Request;

class KlaimAdminController extends Controller
{
    public function index()
    {
        // Ambil SEMUA data klaim (termasuk yang selesai & ditolak)
        $klaims = Klaim::with(['user', 'item'])
                        ->latest()
                        ->get();

        return view('admin.klaims.index', compact('klaims'));
    }

    // 2. Memproses Konfirmasi Klaim (Workflow Kritis)
    public function confirm(Klaim $klaim)
    {
        // 2.1. Validasi
        if ($klaim->status_klaim == 'Selesai') {
            return back()->with('error', 'Klaim ini sudah diselesaikan sebelumnya.');
        }

        // Gunakan Transaction untuk memastikan Item dan Klaim terupdate bersamaan
        DB::beginTransaction();
        try {
            // 2.2. Update Status Item
            $item = $klaim->item; // Ambil Item yang terkait
            
            // Pastikan item statusnya 'Diproses' sebelum diubah ke 'Terjual'
            if ($item->status !== 'Diproses') {
                DB::rollback();
                return back()->with('error', 'Status item tidak valid untuk dikonfirmasi.');
            }

            $item->update(['status' => 'Terjual']);

            // 2.3. Update Status Klaim menjadi Diproses (Bukan langsung Selesai)
            $klaim->update(['status_klaim' => 'Diproses']);

            DB::commit();

            return redirect()->route('admin.klaims.index')->with('success', 'Klaim berhasil dikonfirmasi ke tahap Diproses! Item telah terkunci.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memproses konfirmasi. Coba lagi.');
        }
    }

    // 2.A. Memproses Pengiriman (Input Resi)
    public function ship(Request $request, Klaim $klaim)
    {
        $request->validate([
            'resi_pengiriman' => 'required|string|min:5|max:100'
        ]);

        if ($klaim->status_klaim !== 'Diproses') {
            return back()->with('error', 'Klaim belum siap untuk dikirim.');
        }

        $klaim->update([
            'status_klaim' => 'Dikirim',
            'resi_pengiriman' => $request->resi_pengiriman
        ]);

        return redirect()->route('admin.klaims.index')->with('success', 'Pesanan berhasil diubah menjadi DIKIRIM beserta resi pelacakan.');
    }

    // 2.B. Menyelesaikan Pesanan
    public function complete(Klaim $klaim)
    {
        if ($klaim->status_klaim !== 'Dikirim') {
            return back()->with('error', 'Pesanan belum dikirim, tidak bisa diselesaikan.');
        }

        $klaim->update([
            'status_klaim' => 'Selesai'
        ]);

        return redirect()->route('admin.klaims.index')->with('success', 'Transaksi selesai sepenuhnya.');
    }

    // 3. Memproses Penolakan Klaim
    public function reject(Klaim $klaim)
    {
        if ($klaim->status_klaim == 'Selesai' || str_contains(strtolower($klaim->status_klaim), 'tolak')) {
            return back()->with('error', 'Status klaim ini tidak bisa diubah lagi.');
        }

        DB::beginTransaction();
        try {
            $item = $klaim->item;
            
            // Mengembalikan status barang agar orang lain bisa membeli tiket
            if ($item) {
                $item->update(['status' => 'Tersedia']);
            }

            // Memperbarui status pesanan menjadi dibatalkan
            $klaim->update([
                'status_klaim' => 'Dibatalkan'
            ]);

            DB::commit();

            return redirect()->route('admin.klaims.index')->with('success', 'Klaim berhasil DITOLAK. Status stok baju dikembalikan ke Tersedia agar bisa dibeli pelanggan lain.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memproses penolakan. ' . $e->getMessage());
        }
    }
}