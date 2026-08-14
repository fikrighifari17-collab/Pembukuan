 Rancangan Sistem Pembukuan Akuntansi & HR (Laravel)

Berdasarkan fitur utama yang direncanakan (Pemasukan, Pengeluaran, Request Pembelian Mendatang, dan Pemotongan Gaji), sistem ini mengarah pada pembuatan mini-ERP. Karena dikembangkan menggunakan **Laravel**, pengembangan sistem dengan alur data seperti ini bisa dibuat sangat rapi dan skalabel.

Berikut adalah masukan beberapa fitur tambahan yang bisa melengkapi sistem pembukuan agar lebih profesional dan aman:

## 1. Sistem *Role & Permission* (Hak Akses)
Krusial untuk membatasi siapa yang bisa melihat atau mengubah data keuangan.
*   **Super Admin / Pemilik:** Akses penuh ke semua fitur.
*   **Staff Finance:** Hanya bisa input pemasukan dan pengeluaran.
*   **Karyawan Biasa:** Hanya bisa membuat *request* pembelian dan melihat slip gaji mereka sendiri.
*   *Tips Laravel:* Gunakan *package* `spatie/laravel-permission`.

## 2. Alur *Approval* (Persetujuan) Bertingkat
Untuk fitur **request pembelian mendatang**, sebaiknya jangan langsung berstatus "Disetujui".
*   **Status Request:** Tambahkan status seperti *Pending*, *Approved*, *Rejected*, atau *Revised*.
*   **Alur:** Karyawan A *request* pembelian barang -> Admin mengecek -> jika disetujui, dana keluar dan otomatis masuk ke tabel **Pengeluaran**.

## 3. Modul Manajemen Karyawan & Absensi
Karena ada fitur potongan gaji jika tidak masuk, sistem butuh data absensi.
*   **Master Data Karyawan:** Nama, jabatan, gaji pokok, dan tunjangan.
*   **Log Absensi:** Pencatatan kehadiran harian (manual atau otomatis).
*   **Generate Slip Gaji (Payslip):** Menghitung otomatis: Gaji Pokok - (Jumlah Hari Alpa x Nominal Potongan) = Total Gaji Bersih. 
*   *Tips Laravel:* Bisa diekspor ke PDF menggunakan `barryvdh/laravel-dompdf`.

## 4. Kategori Keuangan (*Chart of Accounts*)
Agar pencatatan tidak berantakan, pemasukan dan pengeluaran harus dikategorikan.
*   **Pemasukan:** Penjualan produk, Pendapatan jasa, Suntikan dana.
*   **Pengeluaran:** Biaya operasional (listrik, internet), Gaji karyawan, Pembelian aset.

## 5. Laporan & Dasbor Analitik (*Reporting*)
Data yang diinput harus bisa dibaca sebagai informasi bisnis.
*   **Dasbor Visual:** Grafik perbandingan pemasukan vs pengeluaran bulan ini.
*   **Laporan Laba Rugi (*Profit/Loss*):** Rangkuman bulanan atau tahunan.
*   *Tips Laravel:* Gunakan `maatwebsite/excel` untuk ekspor laporan keuangan ke format Excel.

## 6. *Audit Trail* (Log Aktivitas)
Fitur keamanan untuk melacak siapa yang melakukan apa. Jika ada data pengeluaran yang tiba-tiba dihapus atau diubah nominalnya, sistem akan mencatat jejak aktivitasnya.

---

## Pertanyaan Lanjutan
Untuk memberikan masukan yang lebih presisi, ada beberapa hal yang perlu dikonfirmasi:
1. **Skala Pengguna:** Website ini nantinya akan digunakan oleh berapa *role*? Apakah hanya untuk admin tunggal, atau karyawan lain juga login ke dalam sistem?
2. **Sistem Absensi:** Untuk pemotongan gaji, apakah data "tidak masuk" diinput manual tiap akhir bulan, atau karyawan absen mandiri melalui website ini?
3. **Pajak:** Apakah sistem ini perlu menghitung pajak secara otomatis (Pajak PPN untuk pembelian, atau PPh 21 untuk gaji karyawan)?