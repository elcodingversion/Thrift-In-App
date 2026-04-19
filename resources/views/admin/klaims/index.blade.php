@extends('layouts.admin')

@section('title', 'Data Klaim Masuk')

@push('styles')
<style>
    /* Main Layout */
    .klaim-index-container { max-width: 1200px; margin: 0 auto; padding: var(--spacing-sm) 0; animation: fadeSlideUp 0.5s ease-out; }
    .breadcrumb-modern { display: flex; align-items: center; gap: 8px; margin-bottom: var(--spacing-lg); font-size: 14px; font-weight: 500; background: var(--white); padding: 12px 20px; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--sage-border); }
    .breadcrumb-modern a { color: var(--sage-dark); text-decoration: none; transition: color 0.2s; display: flex; align-items: center; gap: 6px; }
    .breadcrumb-modern a:hover { color: var(--charcoal); }
    .breadcrumb-separator { color: var(--sage-secondary); font-size: 11px; }
    .breadcrumb-current { color: var(--charcoal); font-weight: 600; display: flex; align-items: center; gap: 6px; }
    .alert-modern { border-radius: var(--radius); padding: 16px 20px; margin-bottom: var(--spacing-lg); display: flex; align-items: center; gap: 12px; animation: slideInDown 0.4s ease-out; border: none; box-shadow: var(--shadow-sm); }
    .alert-modern i { font-size: 20px; }
    .alert-modern .btn-close { margin-left: auto; padding: 0; background: transparent; border: none; font-size: 16px; cursor: pointer; opacity: 0.6; }
    .alert-modern .btn-close:hover { opacity: 1; }
    .alert-success-modern { background-color: #F0FDF4; color: #166534; border-left: 4px solid #22C55E; }
    .alert-danger-modern { background-color: #FEF2F2; color: #991B1B; border-left: 4px solid #EF4444; }
    @keyframes slideInDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .modern-card { background: var(--white); border: 1px solid var(--sage-border); border-radius: 16px; box-shadow: var(--shadow-md); overflow: hidden; position: relative; }
    .modern-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, var(--sage-secondary), var(--sage-primary)); }
    .card-heading { padding: var(--spacing-lg); border-bottom: 1px solid rgba(230, 238, 228, 0.5); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
    .card-title-group { display: flex; align-items: center; gap: 16px; }
    .card-title-icon { color: var(--charcoal); background: var(--sage-primary); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 18px; box-shadow: var(--shadow-sm); }
    .card-title-text h2 { font-size: 20px; font-weight: 700; color: var(--charcoal); margin: 0 0 4px 0; }
    .card-title-text p { color: var(--sage-dark); font-size: 13px; margin: 0; }
    .table-container { padding: var(--spacing-lg); overflow-x: auto; }
    .modern-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .modern-table th { background: #FAFAFA; padding: 14px 16px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--sage-dark); font-weight: 700; border-bottom: 2px solid var(--sage-border); border-top: 1px solid var(--sage-border); text-align: left; }
    .modern-table th:first-child { border-left: 1px solid var(--sage-border); border-top-left-radius: 10px; }
    .modern-table th:last-child { border-right: 1px solid var(--sage-border); border-top-right-radius: 10px; text-align: center; }
    .modern-table td { padding: 16px; font-size: 14px; color: var(--charcoal); border-bottom: 1px solid var(--sage-border); vertical-align: middle; background: var(--white); transition: background 0.2s ease; }
    .modern-table tr:last-child td:first-child { border-bottom-left-radius: 10px; border-left: 1px solid var(--sage-border); }
    .modern-table tr:last-child td:last-child { border-bottom-right-radius: 10px; border-right: 1px solid var(--sage-border); }
    .modern-table tr td:first-child { border-left: 1px solid var(--sage-border); }
    .modern-table tr td:last-child { border-right: 1px solid var(--sage-border); }
    .item-info { display: flex; align-items: center; gap: 12px; margin-bottom: 8px; }
    .item-img { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; border: 1px solid var(--sage-border); background: #F3F4F6; display: flex; align-items: center; justify-content: center; color: #9CA3AF; flex-shrink: 0; }
    .item-details { display: flex; flex-direction: column; }
    .item-name { font-weight: 600; color: var(--charcoal); font-size: 15px; margin-bottom: 4px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .delivery-info { background: #F9FAFB; padding: 10px 12px; border-radius: 8px; border: 1px dashed var(--sage-border); }
    .delivery-info p { margin: 0 0 4px 0; font-size: 12px; color: var(--sage-dark); }
    .user-info { display: flex; align-items: center; gap: 12px; }
    .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--charcoal); color: var(--white); font-weight: 700; display: flex; align-items: center; justify-content: center; font-size: 14px; }
    .user-details strong { display: block; font-size: 14px; color: var(--charcoal); }
    .status-badge { display: inline-flex; align-items: center; justify-content: center; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; }
    .status-pending { background: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; }
    .status-diproses { background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; }
    .status-dikirim { background: #F3E8FF; color: #7E22CE; border: 1px solid #E9D5FF; }
    .status-selesai { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
    .status-ditolak { background: #FEE2E2; color: #B91C1C; border: 1px solid #FECACA; }
    .table-actions { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; }
    .btn-action { padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s; width: 100%; }
    .btn-approve { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
    .btn-approve:hover { background: #bbf7d0; transform: translateY(-2px); }
    .btn-reject { background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA; }
    .btn-reject:hover { background: #FECACA; transform: translateY(-2px); }
    .btn-ship { background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; }
    .btn-ship:hover { background: #BAE6FD; transform: translateY(-2px); }
    .btn-complete { background: #F3E8FF; color: #7E22CE; border: 1px solid #E9D5FF; }
    .btn-complete:hover { background: #E9D5FF; transform: translateY(-2px); }
    .btn-disabled { background: var(--cream-bg); color: var(--sage-dark); border: 1px solid var(--sage-border); cursor: not-allowed; }
    
    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-state-icon { font-size: 48px; color: var(--sage-secondary); margin-bottom: 16px; }

    /* Custom Modern Modal */
    .custom-modal-backdrop {
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(47, 47, 47, 0.4); backdrop-filter: blur(4px);
        z-index: 9998; display: none; opacity: 0; transition: opacity 0.3s ease;
    }
    .custom-modal {
        position: fixed; top: 50%; left: 50%; transform: translate(-50%, -40%);
        background: var(--white); border-radius: 16px; width: 90%; max-width: 480px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15); z-index: 9999;
        display: none; opacity: 0; flex-direction: column; overflow: hidden;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .custom-modal.show { opacity: 1; transform: translate(-50%, -50%); }
    .custom-modal-backdrop.show { opacity: 1; }
    .modal-header { padding: 20px 24px; border-bottom: 1px solid var(--sage-border); display: flex; justify-content: space-between; align-items: center; }
    .modal-title { font-size: 18px; font-weight: 700; color: var(--charcoal); display: flex; align-items: center; gap: 8px; margin: 0;}
    .modal-close { background: transparent; border: none; font-size: 20px; color: var(--sage-dark); cursor: pointer; }
    .modal-close:hover { color: var(--charcoal); }
    .modal-body { padding: 24px; color: var(--charcoal); font-size: 15px; line-height: 1.5; }
    .modal-footer { padding: 16px 24px; background: var(--cream-bg); border-top: 1px solid var(--sage-border); display: flex; justify-content: flex-end; gap: 12px; }
    .btn-modal { padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; border: none; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;}
    .btn-modal-cancel { background: var(--white); color: var(--charcoal); border: 1px solid var(--sage-border); }
    .form-control-modal { width: 100%; padding: 12px; border-radius: 8px; border: 2px solid var(--sage-border); margin-top: 8px; font-family: inherit; font-size: 14px; transition: border 0.3s; }
    .form-control-modal:focus { outline: none; border-color: var(--sage-dark); }
</style>
@endpush

@section('content')
<div class="klaim-index-container">
    <div class="breadcrumb-modern">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span class="breadcrumb-current"><i class="fas fa-file-invoice"></i> Data Pesanan (Klaim)</span>
    </div>

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

    <div class="modern-card">
        <div class="card-heading">
            <div class="card-title-group">
                <div class="card-title-icon"><i class="fas fa-truck-loading"></i></div>
                <div class="card-title-text">
                    <h2>Manajemen Pesanan & Ekspedisi</h2>
                    <p>Atur persetujuan pesanan, pengemasan, hingga penginputan resi kurir.</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Informasi Order</th>
                        <th style="width: 30%;">Item & Tujuan Pengiriman</th>
                        <th class="text-center" style="width: 15%;">Status Order</th>
                        <th class="text-center" style="width: 25%;">Aksi Kurir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($klaims as $index => $klaim)
                        <tr>
                            <td class="text-center" style="font-weight: 500; color: var(--sage-dark);">
                                {{ $index + 1 }}
                            </td>
                            
                            <td>
                                <strong>#{{ str_pad($klaim->id, 5, '0', STR_PAD_LEFT) }}</strong><br>
                                <span style="font-size: 12px; color: var(--sage-dark);">{{ $klaim->created_at->format('d M Y, H:i') }}</span>
                                <div class="user-info" style="margin-top: 12px;">
                                    <div class="user-avatar" style="width: 24px; height: 24px; font-size: 10px;">{{ substr($klaim->user->name ?? '?', 0, 1) }}</div>
                                    <div class="user-details" style="font-size: 13px;">
                                        <strong>{{ $klaim->user->name ?? 'User Dihapus' }}</strong>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="item-info">
                                    <div class="item-img">
                                        @if($klaim->item && $klaim->item->foto_path)
                                            <img src="{{ asset('storage/' . $klaim->item->foto_path) }}" alt="img" style="width:100%; height:100%; object-fit:cover; border-radius: 8px;">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name">{{ $klaim->item->nama_item ?? 'Produk Dihapus' }}</div>
                                        <div style="font-size: 13px; font-weight: 700; color: #4D7C0F;">Rp {{ number_format($klaim->item->harga ?? 0, 0, ',', '.') }}</div>
                                    </div>
                                </div>

                                <div class="delivery-info">
                                    <p><i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong> {{ $klaim->alamat_pengiriman ?? 'Alamat tidak disertakan (Sistem Lama)' }}</p>
                                    @if($klaim->resi_pengiriman)
                                        <p style="color: #0369A1; margin-top: 6px;"><i class="fas fa-barcode"></i> <strong>Resi:</strong> {{ $klaim->resi_pengiriman }}</p>
                                    @endif
                                </div>
                            </td>
                            
                            <td class="text-center">
                                @php
                                    $statusAsli = $klaim->status_klaim ?? 'Menunggu Konfirmasi';
                                    $statusLower = strtolower($statusAsli);
                                    
                                    $sClass = 'status-pending'; 
                                    if(strpos($statusLower, 'nunggu') !== false || strpos($statusLower, 'pending') !== false) {
                                        $sClass = 'status-pending'; 
                                    } elseif(strpos($statusLower, 'proses') !== false) {
                                        $sClass = 'status-diproses'; 
                                    } elseif(strpos($statusLower, 'kirim') !== false) {
                                        $sClass = 'status-dikirim'; 
                                    } elseif(strpos($statusLower, 'selesai') !== false) {
                                        $sClass = 'status-selesai'; 
                                    } elseif(strpos($statusLower, 'tolak') !== false || strpos($statusLower, 'batal') !== false) {
                                        $sClass = 'status-ditolak'; 
                                    }
                                @endphp
                                <div class="status-badge {{ $sClass }}">
                                    {{ $statusAsli }}
                                </div>
                            </td>
                            
                            <td>
                                <div class="table-actions">
                                    @if(strpos($statusLower, 'nunggu') !== false || strpos($statusLower, 'pending') !== false)
                                        <form id="form-action-{{ $klaim->id }}" action="" method="POST" style="margin: 0; min-width: 80px; width: 100%;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn-action btn-approve" style="margin-bottom: 8px;"
                                                onclick="openActionModal('{{ route('admin.klaims.confirm', $klaim->id) }}', 'approve', 'form-action-{{ $klaim->id }}')">
                                                <i class="fas fa-box-open"></i> Kemas Pesanan
                                            </button>
                                            <button type="button" class="btn-action btn-reject"
                                                onclick="openActionModal('{{ route('admin.klaims.reject', $klaim->id) }}', 'reject', 'form-action-{{ $klaim->id }}')">
                                                <i class="fas fa-times"></i> Batal (Tolak)
                                            </button>
                                        </form>

                                    @elseif(strpos($statusLower, 'proses') !== false)
                                        <form id="form-action-{{ $klaim->id }}" action="{{ route('admin.klaims.ship', $klaim->id) }}" method="POST" style="margin: 0; min-width: 80px; width: 100%;">
                                            @csrf
                                            @method('PATCH')
                                            <!-- Kita butuh input resi di dalam modal -->
                                            <button type="button" class="btn-action btn-ship" 
                                                onclick="openActionModal('{{ route('admin.klaims.ship', $klaim->id) }}', 'ship', 'form-action-{{ $klaim->id }}')">
                                                <i class="fas fa-truck-loading"></i> Kirim Pesanan
                                            </button>
                                        </form>

                                    @elseif(strpos($statusLower, 'kirim') !== false)
                                        <form id="form-action-{{ $klaim->id }}" action="" method="POST" style="margin: 0; min-width: 80px; width: 100%;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn-action btn-complete" 
                                                onclick="openActionModal('{{ route('admin.klaims.complete', $klaim->id) }}', 'complete', 'form-action-{{ $klaim->id }}')">
                                                <i class="fas fa-check-double"></i> Tandai Selesai
                                            </button>
                                        </form>

                                    @else
                                        <div class="btn-action btn-disabled" style="min-width: 100px; display: flex; justify-content: center; gap: 6px;">
                                            <i class="fas fa-lock"></i> Order Terkunci
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-state-icon"><i class="fas fa-clipboard-check"></i></div>
                                    <h4>Tidak Ada Antrean Order</h4>
                                    <p>Saat ini belum ada pesanan baru yang masuk dari pelanggan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Modal Overlay -->
<div id="modalBackdrop" class="custom-modal-backdrop"></div>

<!-- Action Modal Dinamis -->
<div id="actionModal" class="custom-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modalTitle"><i class="fas fa-cube"></i> Kelola Order</h3>
        <button type="button" class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
    </div>
    
    <div class="modal-body" id="modalBody">
        <!-- Text injected by JS -->
    </div>

    <div class="modal-footer">
        <button type="button" class="btn-modal btn-modal-cancel" onclick="closeModal()">Batal</button>
        <button type="button" class="btn-modal" id="btnModalConfirm" onclick="triggerSubmit()">Ya, Lanjutkan</button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let currentFormId = null;

    function openActionModal(actionUrl, actionType, formId) {
        currentFormId = formId;

        // Pasang target form nya ke actionUrl yang tepat
        if (formId) {
            document.getElementById(formId).action = actionUrl;
        }

        const modal = document.getElementById('actionModal');
        const backdrop = document.getElementById('modalBackdrop');
        const title = document.getElementById('modalTitle');
        const body = document.getElementById('modalBody');
        const confirmBtn = document.getElementById('btnModalConfirm');

        // Dynamic content UI
        if (actionType === 'approve') {
            title.innerHTML = '<i class="fas fa-box-open" style="color: #0369A1"></i> Proses & Kemas Pesanan';
            body.innerHTML = 'Apakah Anda bersedia melanjutkan pesanan ini ke tahap <strong>PENGEMASAN</strong>?<br><br><span style="color: #6E7C6F; font-size: 13px;">Item akan dikunci dari katalog.</span>';
            confirmBtn.style.backgroundColor = '#0369A1';
            confirmBtn.innerHTML = '<i class="fas fa-check"></i> Mengerti & Proses';
            confirmBtn.style.color = '#fff';

        } else if (actionType === 'reject') {
            title.innerHTML = '<i class="fas fa-times-circle" style="color: #991B1B"></i> Batalkan Pesanan';
            body.innerHTML = 'Apakah Anda yakin <strong>MENOLAK / MEMBATALKAN</strong> pesanan ini?<br><br><span style="color: #991B1B; font-size: 13px;">Stok barang yang dipesan akan dilepas kembali ke Katalog Publik.</span>';
            confirmBtn.style.backgroundColor = '#991B1B';
            confirmBtn.innerHTML = '<i class="fas fa-times"></i> Ya, Tolak Pesanan';
            confirmBtn.style.color = '#fff';

        } else if (actionType === 'ship') {
            title.innerHTML = '<i class="fas fa-shipping-fast" style="color: #7E22CE"></i> Serahkan ke Ekspedisi';
            body.innerHTML = `
                Masukkan Nomor Resi pengiriman agar pembeli dapat melacak keberadaan paketnya.
                <input type="text" id="resiInput" name="resi_pengiriman" form="${formId}" class="form-control-modal" placeholder="Contoh: JP1234567890" required minlength="5">
            `;
            confirmBtn.style.backgroundColor = '#7E22CE';
            confirmBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Paket';
            confirmBtn.style.color = '#fff';

        } else if (actionType === 'complete') {
            title.innerHTML = '<i class="fas fa-check-double" style="color: #166534"></i> Selesaikan Transaksi';
            body.innerHTML = 'Tandai transaksi ini sebagai <strong>SELESAI</strong>? <br><br>Gunakan opsi ini jika pembeli sudah mengkonfirmasi barang sampai, atau batas waktu retur sudah berakhir.';
            confirmBtn.style.backgroundColor = '#166534';
            confirmBtn.innerHTML = '<i class="fas fa-check-double"></i> Selesaikan';
            confirmBtn.style.color = '#fff';
        }

        backdrop.style.display = 'block';
        modal.style.display = 'flex';
        
        setTimeout(() => {
            backdrop.classList.add('show');
            modal.classList.add('show');
            if (actionType === 'ship' && document.getElementById('resiInput')) {
                document.getElementById('resiInput').focus();
            }
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('actionModal');
        const backdrop = document.getElementById('modalBackdrop');
        modal.classList.remove('show');
        backdrop.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
            backdrop.style.display = 'none';
            currentFormId = null;
        }, 300);
    }

    function triggerSubmit() {
        if (!currentFormId) return;
        
        const form = document.getElementById(currentFormId);
        
        // Cek validity input jika form memiliki tag resi
        if (form.reportValidity()) {
            form.submit();
        }
    }

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