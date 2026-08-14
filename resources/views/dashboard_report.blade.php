<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Perusahaan - {{ now()->format('d/m/Y') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff;
                color: #000000;
            }
            .print-card {
                border: none !important;
                box-shadow: none !important;
                background: transparent !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="p-4 md:p-12">

    <!-- Top Action Bar -->
    <div class="max-w-4xl mx-auto mb-6 flex justify-between items-center no-print">
        <button onclick="window.close()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Tutup Halaman</span>
        </button>
        
        <button onclick="window.print()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-blue-500/10 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            <span>Cetak PDF / Print</span>
        </button>
    </div>

    <!-- Report document -->
    <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-3xl p-8 md:p-12 shadow-xl print-card">
        
        <!-- Header / Kop Surat -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b-2 border-slate-800 pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold uppercase tracking-wide text-slate-900">
                    @if($type === 'all') LAPORAN KAS & KEUANGAN LENGKAP @endif
                    @if($type === 'company_funds') LAPORAN SALDO UANG PERUSAHAAN @endif
                    @if($type === 'income') LAPORAN TOTAL PEMASUKAN (INCOME) @endif
                    @if($type === 'expense') LAPORAN TOTAL PENGELUARAN (EXPENSE) @endif
                    @if($type === 'balance') LAPORAN SALDO BERSIH OPERASIONAL @endif
                </h1>
                <p class="text-xs text-slate-500 mt-1">Diekspor secara otomatis dari Sistem Pembukuan ERP</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-xs text-slate-400">Tanggal Cetak</p>
                <p class="text-sm font-semibold text-slate-800">{{ now()->translatedFormat('d F Y H:i') }}</p>
            </div>
        </div>

        <!-- Core Metrics Summary Cards Grid -->
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Rangkuman Indikator Keuangan</h3>
        <div class="grid grid-cols-1 @if($type === 'all') md:grid-cols-2 lg:grid-cols-4 @else md:grid-cols-2 max-w-2xl @endif gap-4 mb-8">
            
            @if($type === 'all' || $type === 'company_funds')
                <div class="p-4 bg-violet-50 border border-violet-100 rounded-2xl ring-2 ring-violet-500">
                    <span class="text-[10px] uppercase font-bold text-violet-600 tracking-wider">Uang Perusahaan</span>
                    <p class="text-lg font-bold text-violet-800 mt-1">Rp {{ number_format($companyFunds, 0, ',', '.') }}</p>
                </div>
            @endif

            @if($type === 'all' || $type === 'income')
                <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl ring-2 ring-emerald-500">
                    <span class="text-[10px] uppercase font-bold text-emerald-600 tracking-wider">Total Pemasukan</span>
                    <p class="text-lg font-bold text-emerald-800 mt-1">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            @endif

            @if($type === 'all' || $type === 'expense')
                <div class="p-4 bg-rose-50 border border-rose-100 rounded-2xl ring-2 ring-rose-500">
                    <span class="text-[10px] uppercase font-bold text-rose-600 tracking-wider">Total Pengeluaran</span>
                    <p class="text-lg font-bold text-rose-800 mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            @endif

            @if($type === 'all' || $type === 'balance')
                <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl ring-2 ring-blue-500">
                    <span class="text-[10px] uppercase font-bold text-blue-600 tracking-wider">Saldo Kas Bersih</span>
                    <p class="text-lg font-bold text-blue-800 mt-1">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                </div>
            @endif

        </div>

        <!-- Explanations / Penjelasan Laporan -->
        <div class="mb-10 bg-slate-50 border border-slate-100 rounded-2xl p-6">
            <h3 class="text-sm font-bold text-slate-800 mb-4">📖 Penjelasan Indikator Laporan</h3>
            <div class="space-y-4 text-xs text-slate-600 leading-relaxed">
                
                @if($type === 'all' || $type === 'company_funds')
                    <div>
                        <strong class="text-slate-800 block text-xs">Uang Perusahaan (Kas & Bank)</strong>
                        Menunjukkan total seluruh aset likuid aktif yang dipegang dan dikelola oleh kas utama perusahaan saat ini. Nilai ini dihitung berdasarkan modal awal perusahaan sebesar **Rp 10.000.000.000 (10 Miliar)** disesuaikan secara real-time dengan laba bersih (pemasukan dikurangi pengeluaran) dari operasional bisnis.
                    </div>
                @endif

                @if($type === 'all' || $type === 'income')
                    <div>
                        <strong class="text-slate-800 block text-xs">Total Pemasukan (Income)</strong>
                        Jumlah kotor dari seluruh arus kas masuk (pendapatan/omset) yang berhasil dicatat oleh sistem, seperti hasil penjualan produk, pendapatan jasa, maupun suntikan dana dari investor.
                    </div>
                @endif

                @if($type === 'all' || $type === 'expense')
                    <div>
                        <strong class="text-slate-800 block text-xs">Total Pengeluaran (Expense)</strong>
                        Jumlah akumulatif dari semua dana keluar yang digunakan untuk membiayai operasional kantor (listrik, internet), pembelian inventaris aset baru, belanja barang yang disetujui, dan pembayaran payroll bulanan gaji karyawan.
                    </div>
                @endif

                @if($type === 'all' || $type === 'balance')
                    <div>
                        <strong class="text-slate-800 block text-xs">Saldo Bersih (Kas)</strong>
                        Selisih bersih antara Total Pemasukan dan Total Pengeluaran. Nilai positif menunjukkan perusahaan berada dalam kondisi profit/laba operasional, sedangkan nilai negatif menunjukkan defisit kas.
                    </div>
                @endif

            </div>
        </div>

        <!-- History of transactions contributing -->
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
            @if($type === 'income') Rincian Riwayat Transaksi Masuk @elseif($type === 'expense') Rincian Riwayat Transaksi Keluar @else Rincian Riwayat Buku Kas @endif
        </h3>
        <div class="border border-slate-200 rounded-2xl overflow-hidden mb-12">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold">
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Tipe</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Keterangan</th>
                        <th class="p-3 text-right">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($transactions as $tx)
                        <tr>
                            <td class="p-3 text-slate-500">{{ $tx->date->format('d/m/Y') }}</td>
                            <td class="p-3 uppercase font-bold text-[10px] {{ $tx->type === 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $tx->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                            </td>
                            <td class="p-3 text-slate-700 font-medium">{{ $tx->category->name }}</td>
                            <td class="p-3 text-slate-500">{{ $tx->description ?? '-' }}</td>
                            <td class="p-3 text-right font-bold text-slate-800">
                                {{ $tx->type === 'income' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    @if($transactions->isEmpty())
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-400">Belum ada transaksi terekam pada laporan ini.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Signature/Approval footer -->
        <div class="grid grid-cols-2 gap-8 text-xs text-center border-t border-dashed border-slate-200 pt-8">
            <div>
                <p class="text-slate-400 mb-16">Dibuat Oleh,</p>
                <div class="w-32 mx-auto border-b border-slate-400"></div>
                <p class="font-semibold text-slate-700 mt-2">Staff Finance</p>
            </div>
            <div>
                <p class="text-slate-400 mb-16">Disetujui Oleh,</p>
                <div class="w-32 mx-auto border-b border-slate-400"></div>
                <p class="font-semibold text-slate-700 mt-2">Owner Perusahaan</p>
            </div>
        </div>

    </div>

</body>
</html>
