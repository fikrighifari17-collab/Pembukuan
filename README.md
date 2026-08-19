# ADMS PEMBUKUAN
### PT ARMADA DIGITAL MARKETING SYARIAH
Sistem Keuangan, Operasional & Absensi Karyawan Terintegrasi.

---

## 🔑 Akun Demo Login

Gunakan kredensial berikut untuk masuk ke dalam sistem:

| Peran (Role) | Hak Akses | Alamat Email | Password |
| :--- | :--- | :--- | :--- |
| **Owner** | Laporan Keuangan, Absensi (Read-Only) & Approval Request | `owner@example.com` | `password` |
| **Finance** | Pencatatan Transaksi Kas, Kelola Gaji & Request Pembelian | `finance@example.com` | `password` |
| **HRD** | Manajemen Absensi Karyawan, Request Absensi & Laporan Kehadiran | `hrd@example.com` | `password` |
| **Andi (Karyawan)** | Check-in / Check-out Absensi, Pengajuan Request Pembelian & Slip Gaji | `andi@example.com` | `password` |

---

## 🛠️ Cara Instalasi & Pengaturan Database

### Opsi A: Import File SQL (phpMyAdmin)
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru bernama `akutansi`.
3. Klik menu **Import** -> pilih file [`database/akutansi.sql`](database/akutansi.sql) -> klik **Go / Kirim**.

### Opsi B: Laravel Migration & Seeder
1. Buat database kosong bernama `akutansi` di MySQL/XAMPP.
2. Jalankan perintah berikut di terminal:
   ```bash
   php artisan migrate:fresh --seed
   ```
3. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
4. Buka browser di `http://127.0.0.1:8000/login`.
