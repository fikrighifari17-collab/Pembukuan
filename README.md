# 🏢 ADMS PEMBUKUAN
### PT ARMADA DIGITAL MARKETING SYARIAH
Sistem Keuangan, Penggajian, Operasional & Absensi Karyawan Terintegrasi.

---

## 🔑 Akun Demo Login

Gunakan kredensial berikut untuk masuk dan menguji sistem:

| Peran (Role) | Hak Akses Utama | Alamat Email | Password |
| :--- | :--- | :--- | :--- |
| **Owner** | Laporan Keuangan, Absensi (Read-Only) & Approval Request | `owner@example.com` | `password` |
| **Finance** | Pencatatan Transaksi Kas, Kelola Gaji & Request Pembelian | `finance@example.com` | `password` |
| **HRD** | Manajemen Absensi Karyawan, Request Absensi & Laporan Kehadiran | `hrd@example.com` | `password` |
| **Andi (Karyawan)** | Check-in / Check-out Absensi, Pengajuan Request Pembelian & Slip Gaji | `andi@example.com` | `password` |

---

---

## 🌟 Fitur & Keunggulan Utama Aplikasi

### 1. 💰 Pencatatan & Manajemen Keuangan (Accounting & Cash Flow)
- **Pencatatan Pemasukan & Pengeluaran**: Pencatatan riwayat transaksi keuangan perusahaan secara real-time.
- **Kategori Transaksi Dinamis**: Pengelompokan transaksi berdasarkan kategori (Penjualan, Biaya Operasional, Gaji, Pembelian Aset, dll).
- **Kalkulasi Otomatis**: Menghitung otomatis **Saldo Uang Perusahaan**, **Total Pemasukan**, **Total Pengeluaran**, dan **Saldo Bersih Operasional**.
- **Audit Logs**: Memantau seluruh catatan aktivitas transaksi keuangan demi akuntabilitas & transparansi.

### 2. 🖨️ Cetak & Ekspor Laporan Resmi (PDF / Print Ready)
- **Laporan Keuangan Perusahaan**: Cetak Laporan Kas Lengkap, Saldo Uang Perusahaan, Pemasukan, Pengeluaran, & Saldo Operasional.
- **Slip Gaji Karyawan (Official Payslip)**: Cetak Slip Gaji resmi individu karyawan.
- **Laporan Kehadiran Karyawan**: Cetak Laporan Absensi Harian, Rekapitulasi Absensi Bulanan, dan Laporan Kehadiran Individu.
- **Header / Kop Surat Resmi**: Setiap hasil cetak dilengkapi dengan Kop Surat resmi **ADMS PEMBUKUAN - PT Armada Digital Marketing Syariah**.

### 3. 💵 Manajemen Penggajian (Payroll System)
- **Pengaturan Gaji & Tunjangan**: Pengaturan nominal Gaji Pokok dan Tunjangan per karyawan oleh tim Finance.
- **Generate Payslip Otomatis**: Pembuatan Slip Gaji bulanan secara otomatis.
- **Pembayaran Gaji Terintegrasi**: Proses pembayaran gaji (*Pay Payslip*) yang secara otomatis memotong saldo perusahaan dan mencatat transaksi pengeluaran.
- **Privasi Terjamin**: Gaji karyawan bersifat rahasia (hanya Finance yang mengelola, karyawan hanya bisa melihat slip miliknya sendiri).

### 4. ⏱️ Sistem Absensi & Kehadiran Karyawan (Employee Attendance)
- **Absensi Mandiri (Self Check-in & Check-out)**: Karyawan dapat melakukan absensi masuk dan keluar langsung dari Dashboard.
- **Kalkulasi Lembur & Alpa**: Pencatatan otomatis jam lembur (*overtime*) dan akumulasi ketidakhadiran.
- **Verifikasi & Input Manual HRD**: Tim HRD dapat mengelola dan memverifikasi data absensi karyawan.
- **Workflow Request Absensi**: Fitur *Attendance Request* dari bagian Finance ke HRD untuk penyerahan data rekap absensi sebelum proses penggajian.

### 5. 🛒 Request Pembelian & Pengadaan (Purchase Request Workflow)
- **Pengajuan Pembelian Barang/Jasa**: Seluruh karyawan & staf dapat mengajukan permintaan kebutuhan kerja (misal: Upgrade RAM, Lisensi Figma, Peralatan Kantor).
- **Workflow Approval**: Sistem persetujuan berjenjang oleh Owner & Finance (*Pending*, *Approved*, atau *Rejected*).
- **Auto-Transaction**: Jika pengajuan disetujui, sistem secara otomatis mencatat pengeluaran keuangan terkait.

### 6. 🔐 Akses Berbasis Peran (Role-Based Access Control - RBAC)
Sistem memiliki 4 Peran (*Role*) dengan hak akses yang terpisah:
- 👑 **Owner**: Akses laporan executive, approval purchase request, & monitoring absensi *(Read-Only Keuangan)*.
- 💳 **Finance Staff**: Pengelolaan penuh keuangan, pencatatan transaksi, penggajian (payroll), & purchase request.
- 📋 **HRD Staff**: Pengelolaan penuh data karyawan, pencatatan absensi, & penyerahan rekap absensi bulanan.
- 🧑‍💻 **Karyawan (Employee)**: Absensi mandiri, pengajuan request pembelian, & cetak slip gaji pribadi.

### 🎨 7. Antarmuka Modern & Responsif (UI/UX Modern)
- **Desain Glassmorphism Navy & Gold**: Tampilan visual premium dan elegan.
- **Toggle Dark / Light Mode**: Fitur pergantian mode gelap dan terang sesuai kenyamanan pengguna.
- **Responsive Layout**: Kompatibel digunakan di Desktop, Tablet, maupun Smartphone.

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
