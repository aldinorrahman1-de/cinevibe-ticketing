@extends('layouts.app')

@section('title', 'Pilih Kursi - ' . $movie['title'])

@section('content')
<div class="mb-6">
    <a href="{{ route('movies.show', $movie['id']) }}" class="text-emerald-300 hover:text-amber-400 text-xs font-semibold inline-flex items-center gap-2 transition bg-emerald-950/40 px-3.5 py-2 rounded-xl border border-emerald-800/50">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Rincian Film
    </a>
</div>

@if ($errors->any())
<div class="mb-6 p-4 bg-red-950/80 border border-red-500/70 rounded-2xl text-red-200 text-sm shadow-xl">
    <p class="font-bold flex items-center gap-2 mb-1 text-red-400"><i class="fa-solid fa-triangle-exclamation"></i> Terjadi Kesalahan:</p>
    <ul class="list-disc list-inside space-y-1 text-xs">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('movies.checkout', $movie['id']) }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Denah Kursi Interaktif (Layar Lengkung Cinema) -->
        <div class="lg:col-span-2 luxury-card border border-emerald-800/70 rounded-3xl p-6 md:p-8 shadow-2xl">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-amber-400">Denah Kursi Studio</h2>
                    <p class="text-xs text-emerald-300/70 mt-0.5">{{ $movie['studio'] }}</p>
                </div>
                <span class="px-3 py-1 bg-amber-400/10 text-amber-400 border border-amber-400/30 rounded-lg text-xs font-bold">
                    {{ $selectedTime }} WIB
                </span>
            </div>

            <!-- Efek Layar Cinema Melengkung dengan Cahaya Emas -->
            <div class="w-4/5 mx-auto mb-10">
                <div class="h-2 w-full bg-gradient-to-r from-transparent via-amber-300 to-transparent rounded-full shadow-[0_15px_30px_rgba(245,158,11,0.4)]"></div>
                <p class="text-center text-[10px] tracking-[0.3em] text-emerald-400/60 uppercase mt-3 font-bold">Area Layar Bioskop (Screen)</p>
            </div>

            <!-- Grid Kursi -->
            <div class="flex flex-col gap-3.5 items-center">
                @php
                    $rows = ['A', 'B', 'C', 'D'];
                    $cols = [1, 2, 3, 4, 5, 6];
                    $bookedSeats = ['B3', 'B4', 'C2', 'D5']; // Kursi yang sudah terisi
                @endphp

                @foreach($rows as $row)
                <div class="flex items-center gap-2.5">
                    <span class="w-6 text-xs font-black text-amber-400 text-center">{{ $row }}</span>
                    @foreach($cols as $col)
                        @php $seatId = $row . $col; @endphp
                        @if(in_array($seatId, $bookedSeats))
                            <!-- Kursi Terisi -->
                            <button type="button" disabled class="w-11 h-11 rounded-xl bg-zinc-900 text-zinc-600 text-xs font-bold border border-zinc-800 cursor-not-allowed flex items-center justify-center">
                                <i class="fa-solid fa-user-xmark text-xs"></i>
                            </button>
                        @else
                            <!-- Kursi Bebas -->
                            <button type="button" 
                                    onclick="toggleSeat('{{ $seatId }}', this)" 
                                    id="btn-{{ $seatId }}" 
                                    class="seat-btn w-11 h-11 rounded-xl bg-emerald-950/80 hover:bg-emerald-700 text-emerald-200 text-xs font-extrabold border border-emerald-600/60 transition-all duration-150 shadow-md hover:scale-105">
                                {{ $seatId }}
                            </button>
                        @endif
                    @endforeach
                </div>
                @endforeach
            </div>

            <!-- Panduan Status Kursi -->
            <div class="flex items-center justify-center gap-8 mt-10 pt-6 border-t border-emerald-800/60 text-xs">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-lg bg-emerald-950 border border-emerald-600"></span>
                    <span class="text-emerald-300 font-medium">Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-lg bg-amber-400 border border-amber-300 shadow-[0_0_10px_rgba(245,158,11,0.5)]"></span>
                    <span class="text-amber-400 font-bold">Dipilih</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-lg bg-zinc-900 border border-zinc-800"></span>
                    <span class="text-zinc-500 font-medium">Terisi</span>
                </div>
            </div>
        </div>

        <!-- Form Pemesanan Mewah -->
        <div class="luxury-card border border-emerald-800/70 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-black text-amber-400 mb-1">Data Reservasi</h2>
                <p class="text-xs text-emerald-300/70 mb-6">Pastikan identitasmu sesuai kartu pengenal.</p>

                <input type="hidden" name="seats" id="selectedSeatsInput" value="{{ old('seats') }}">

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-emerald-300 mb-1.5">Jam Penayangan</label>
                        <select name="showtime" class="w-full bg-[#020e0a] border border-emerald-700/80 rounded-xl px-3.5 py-2.5 text-sm text-emerald-100 focus:outline-none focus:border-amber-400">
                            @foreach($movie['schedules'] as $sch)
                                <option value="{{ $sch }}" {{ $selectedTime == $sch ? 'selected' : '' }}>{{ $sch }} WIB - {{ $movie['studio'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-emerald-300 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Contoh: Aldi Nor Rahman" class="w-full bg-[#020e0a] border border-emerald-700/80 rounded-xl px-3.5 py-2.5 text-sm text-emerald-100 placeholder-emerald-700 focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-emerald-300 mb-1.5">Email Aktif</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="name@example.com" class="w-full bg-[#020e0a] border border-emerald-700/80 rounded-xl px-3.5 py-2.5 text-sm text-emerald-100 placeholder-emerald-700 focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-emerald-300 mb-1.5">No. WhatsApp / HP</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="08xxxxxxxxxx" class="w-full bg-[#020e0a] border border-emerald-700/80 rounded-xl px-3.5 py-2.5 text-sm text-emerald-100 placeholder-emerald-700 focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <!-- Box Rincian Real-time -->
                <div class="mt-6 p-4 bg-[#020e0a]/90 border border-emerald-800/80 rounded-2xl text-xs space-y-2.5">
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-400">Kursi Dipilih:</span>
                        <span id="selectedSeatsText" class="font-black text-amber-300">- Belum ada -</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-400">Harga Satuan:</span>
                        <span class="text-emerald-200 font-semibold">Rp {{ number_format($movie['price'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2.5 border-t border-emerald-800/80 font-bold">
                        <span class="text-emerald-300">Total Pembayaran:</span>
                        <span id="totalPriceText" class="text-amber-400 text-base font-extrabold">Rp 0</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-6 w-full py-3.5 bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:brightness-110 text-slate-950 font-black rounded-2xl text-sm transition-all duration-200 shadow-xl shadow-amber-500/20 uppercase tracking-wider">
                Konfirmasi & Terbitkan Tiket
            </button>
        </div>
    </div>
</form>

<script>
    let selectedSeats = [];
    const seatPrice = {{ $movie['price'] }};

    function toggleSeat(seatId, element) {
        const index = selectedSeats.indexOf(seatId);

        if (index > -1) {
            selectedSeats.splice(index, 1);
            element.classList.remove('bg-amber-400', 'text-slate-950', 'border-amber-300', 'shadow-[0_0_15px_rgba(245,158,11,0.6)]');
            element.classList.add('bg-emerald-950/80', 'text-emerald-200', 'border-emerald-600/60');
        } else {
            selectedSeats.push(seatId);
            element.classList.remove('bg-emerald-950/80', 'text-emerald-200', 'border-emerald-600/60');
            element.classList.add('bg-amber-400', 'text-slate-950', 'border-amber-300', 'shadow-[0_0_15px_rgba(245,158,11,0.6)]');
        }

        document.getElementById('selectedSeatsInput').value = selectedSeats.join(',');
        document.getElementById('selectedSeatsText').innerText = selectedSeats.length > 0 ? selectedSeats.join(', ') : '- Belum ada -';
        
        const total = selectedSeats.length * seatPrice;
        document.getElementById('totalPriceText').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>
@endsection