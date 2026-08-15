@extends('layouts.app')

@section('page_title', 'Request Pembelian Barang')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        @if(!Auth::user()->isOwner())
        <!-- Ajukan Request (Left 1 column) -->
        <div class="glass-panel p-6 rounded-2xl h-fit">
            <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">Ajukan Pembelian Baru</h3>
            <form action="{{ route('purchase_requests.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Barang / Pembelian</label>
                    <input type="text" name="title" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: SSD Upgrade 500GB">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Estimasi Biaya (Rupiah)</label>
                    <input type="text" id="amount_input" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 750.000">
                    <input type="hidden" name="amount" id="amount_hidden">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Alasan / Detail Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan kegunaan barang..."></textarea>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium transition duration-200">
                    Kirim Request Pembelian
                </button>
            </form>
        </div>
        @endif

        <!-- History/Approval List -->
        <div class="@if(Auth::user()->isOwner()) lg:col-span-3 @else lg:col-span-2 @endif glass-panel p-6 rounded-2xl">
            <h3 class="font-bold text-lg text-slate-200 border-b border-slate-800 pb-4 mb-4">
                {{ Auth::user()->isKaryawan() ? 'Riwayat Pengajuan Saya' : 'Daftar Pengajuan Pembelian' }}
            </h3>
            
            <div class="space-y-4">
                @foreach($requests as $req)
                    <div class="p-5 rounded-2xl bg-slate-900/40 border border-slate-800/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <h4 class="font-bold text-base text-slate-200">{{ $req->title }}</h4>
                                <span class="text-xs px-2.5 py-0.5 rounded-full font-bold uppercase {{ $req->status === 'approved' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : ($req->status === 'rejected' ? 'bg-rose-950 text-rose-400 border border-rose-800' : 'bg-amber-950 text-amber-400 border border-amber-800') }}">
                                    {{ $req->status }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-400">{{ $req->description ?? 'Tidak ada deskripsi.' }}</p>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500">
                                <span>Diajukan oleh: <strong class="text-slate-300">{{ $req->user->name }}</strong></span>
                                <span>Tanggal: {{ $req->created_at->format('d M Y H:i') }}</span>
                                @if($req->approver)
                                    <span>Pemeriksa: <strong class="text-slate-300">{{ $req->approver->name }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col items-end gap-3 justify-between shrink-0">
                            <span class="text-lg font-bold text-slate-200">
                                Rp {{ number_format($req->amount, 0, ',', '.') }}
                            </span>

                            <!-- Actions for Owner or Finance staff when Pending -->
                            @if($req->status === 'pending' && (Auth::user()->isOwner() || Auth::user()->isFinance()))
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('purchase_requests.approve', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold transition">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('purchase_requests.reject', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-semibold transition">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($requests->isEmpty())
                    <div class="py-12 text-center text-slate-500">
                        Belum ada pengajuan pembelian saat ini.
                    </div>
                @endif
            </div>
        </div>

    </div>

    @if(!Auth::user()->isOwner())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
