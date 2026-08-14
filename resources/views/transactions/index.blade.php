@extends('layouts.app')

@section('page_title', 'Pencatatan Keuangan (Pemasukan & Pengeluaran)')

@section('content')

    <div class="grid grid-cols-1 @if(Auth::user()->isFinance() && request('view') !== 'history') lg:grid-cols-3 @endif gap-8">
        
        @if(Auth::user()->isFinance() && request('view') !== 'history')
        <!-- Forms panel (Left 1 column) -->
        <div class="space-y-8">
            
            <!-- Tambah Transaksi -->
            <div class="glass-panel p-6 rounded-2xl relative overflow-hidden">
                <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Catat Transaksi</h3>
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tipe Transaksi</label>
                        <select name="type" id="tx_type" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="income">Pemasukan (Income)</option>
                            <option value="expense">Pengeluaran (Expense)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kategori Keuangan</label>
                        <select name="category_id" id="tx_category" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->name }} ({{ ucfirst($category->type) }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Jumlah (Rupiah)</label>
                        <input type="text" id="amount_input" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 150.000">
                        <input type="hidden" name="amount" id="amount_hidden">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tanggal</label>
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Keterangan / Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Detail transaksi..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium transition duration-200">
                        Simpan Transaksi
                    </button>
                </form>
            </div>

            <!-- Tambah Kategori -->
            <div class="glass-panel p-6 rounded-2xl border border-slate-800">
                <h3 class="font-bold text-base text-slate-200 border-b border-slate-800 pb-3 mb-3">Kategori Baru</h3>
                <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Kategori</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Internet Kantor">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tipe Kategori</label>
                        <select name="type" required class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="expense">Pengeluaran</option>
                            <option value="income">Pemasukan</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium transition duration-200">
                        Tambah Kategori
                    </button>
                </form>
            </div>

        </div>
        @endif

        <!-- Transactions list panel -->
        <div class="@if(Auth::user()->isOwner() || request('view') === 'history') lg:col-span-3 @else lg:col-span-2 @endif glass-panel p-6 rounded-2xl">
            <div class="flex justify-between items-center border-b border-slate-800 pb-4 mb-4">
                <h3 class="font-bold text-lg text-slate-200">Riwayat Buku Keuangan</h3>
                @if(Auth::user()->isFinance() && request('view') === 'history')
                    <a href="{{ route('transactions.index') }}" class="text-xs text-blue-400 hover:underline">← Tambah Transaksi / Kategori</a>
                @endif
            </div>

            <!-- Date Filter Form -->
            <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap items-end gap-4 my-4 bg-slate-900/35 p-4 rounded-xl border border-slate-800">
                @if(request('view'))
                    <input type="hidden" name="view" value="{{ request('view') }}">
                @endif
                
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tanggal Selesai</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-semibold transition">
                        Filter Tanggal
                    </button>
                    @if(request('start_date') || request('end_date'))
                        <a href="{{ request()->fullUrlWithQuery(['start_date' => null, 'end_date' => null]) }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl text-xs font-semibold transition flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
            
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px] text-left text-sm">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-800">
                            <th class="pb-2">Tanggal</th>
                            <th class="pb-2">Jenis</th>
                            <th class="pb-2">Kategori</th>
                            <th class="pb-2">Deskripsi</th>
                            <th class="pb-2 text-right">Jumlah</th>
                            @if(Auth::user()->isFinance())
                                <th class="pb-2 text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/40">
                        @foreach($transactions as $tx)
                            <tr class="hover:bg-slate-900/10 transition">
                                <td class="py-3.5 text-slate-300">{{ $tx->date->format('d/m/Y') }}</td>
                                <td class="py-3.5">
                                    <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $tx->type === 'income' ? 'bg-emerald-950 text-emerald-400' : 'bg-rose-950 text-rose-400' }}">
                                        {{ $tx->type === 'income' ? 'MASUK' : 'KELUAR' }}
                                    </span>
                                </td>
                                <td class="py-3.5 text-slate-300">{{ $tx->category->name }}</td>
                                <td class="py-3.5 text-slate-400 max-w-[150px] truncate" title="{{ $tx->description }}">{{ $tx->description ?? '-' }}</td>
                                <td class="py-3.5 text-right font-bold {{ $tx->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                    Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                </td>
                                @if(Auth::user()->isFinance())
                                    <td class="py-3.5 text-center">
                                        <form action="{{ route('transactions.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini dicatat di log audit.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:text-rose-300 text-xs hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @if($transactions->isEmpty())
                            <tr>
                                <td colspan="@if(Auth::user()->isFinance()) 6 @else 5 @endif" class="py-6 text-center text-slate-500">Belum ada transaksi tercatat. @if(Auth::user()->isFinance()) Catat transaksi di panel kiri. @endif</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @if(Auth::user()->isFinance() && request('view') !== 'history')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('tx_type');
            const categorySelect = document.getElementById('tx_category');
            
            if (typeSelect && categorySelect) {
                const originalOptions = Array.from(categorySelect.options);

                function filterCategories() {
                    const selectedType = typeSelect.value;
                    
                    // Clear category select
                    categorySelect.innerHTML = '';

                    // Filter options matching the selected type
                    const filteredOptions = originalOptions.filter(option => option.getAttribute('data-type') === selectedType);
                    
                    filteredOptions.forEach(option => {
                        categorySelect.appendChild(option.cloneNode(true));
                    });

                    // Automatically select the first option of the filtered list
                    if (categorySelect.options.length > 0) {
                        categorySelect.selectedIndex = 0;
                    }
                }

                // Listen to type changes
                typeSelect.addEventListener('change', filterCategories);

                // Run initially
                filterCategories();
            }

            // Currency formatting logic
            const amountInput = document.getElementById('amount_input');
            const amountHidden = document.getElementById('amount_hidden');

            if (amountInput && amountHidden) {
                amountInput.addEventListener('input', function (e) {
                    let value = this.value.replace(/\D/g, '');
                    amountHidden.value = value;
                    this.value = value ? formatNumber(value) : '';
                });
            }

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
    @endif

@endsection
