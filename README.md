# ThriftApp 🌿

**ThriftApp** adalah platform e-commerce berbasis web yang dikembangkan khusus untuk ekosistem penjualan barang *pre-loved* atau pakaian bekas berkualitas. Berbeda dengan e-commerce umum, aplikasi ini dirancang untuk menangani karakteristik unik barang *thrift* yang biasanya memiliki stok tunggal (*one-of-a-kind items*), dengan antarmuka yang bersih dan estetik.

## 🏗️ Arsitektur Sistem
Aplikasi ini mengintegrasikan dua sisi pengguna dalam satu ekosistem yang sinkron:
- **Sisi Pengguna (Client-Side):** Berfokus pada pengalaman eksplorasi katalog yang visual dan proses klaim barang yang cepat.
- **Sisi Pengelola (Admin-Side):** Berfokus pada manajemen inventori yang dinamis, pemantauan transaksi, dan verifikasi klaim secara real-time.

## ✨ Fitur Utama
- **Smart Catalog Management**: Sistem tampilan produk yang informatif, mencakup status ketersediaan barang secara akurat untuk menghindari *double booking*.
- **Integrated Claim System**: Alur transaksi yang efisien melalui fitur klaim barang, memungkinkan interaksi langsung antara pembeli dan admin untuk penyelesaian pesanan.
- **Unified Authentication**: Keamanan akses akun yang memisahkan otoritas antara pelanggan umum dan administrator toko.
- **Centralized Admin Dashboard**: Pusat kendali operasional untuk mengelola data produk, memantau riwayat klaim, dan manajemen basis data pengguna.
- **Aesthetic Responsive UI**: Desain antarmuka minimalis yang responsif, memastikan kenyamanan navigasi baik melalui perangkat desktop maupun smartphone.

## 💻 Tech Stack
- **Core Framework**: Laravel (PHP)
- **Data Management**: MySQL
- **Frontend Engine**: Blade Templating & CSS Framework
- **Dependency Manager**: Composer & NPM
