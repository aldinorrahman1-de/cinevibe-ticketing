@extends('layouts.app')

@section('title', 'E-Ticket Resmi - ' . $bookingCode)

@section('content')
<div class="max-w-xl mx-auto">
    
    <!-- Banner Notifikasi Sukses -->
    <div class="mb-6 p-4 bg-emerald-950/60 border border-emerald-500/60 rounded-2xl text-center shadow-xl">
        <div class="w-12 h-12 bg-amber-400 text-slate-950 rounded-full flex items-center justify-center mx-auto mb-2 text-xl shadow-lg shadow-amber-400/30">
            <i class="fa-solid fa-check"></i>
        </div>
        <h1 class="text-xl font-extrabold text-white">Tiket Resmi Berhasil Diterbitkan</h1>
        <p class="text-xs text-emerald-300/80 mt-0.5">Silakan simpan atau cetak kode booking untuk penukaran tiket fisik.</p>
    </div>

    <!-- Desain Kartu Tiket Mewah (VIP Golden Pass) -->
    <div class="luxury-card border-2 border-amber-400/60 rounded-3xl overflow-hidden shadow-2xl relative">
        
        <!-- Header Pass -->
        <div class="bg-[#020b08] p-6 border-b border-dashed border-emerald-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-400 flex items-center justify-center text-slate-950 font-black">
                    <i class="fa-solid fa-crown text-xs"></i>
                </div>
                <div>
                    <span class="text-[10px] text-amber-400 font-extrabold tracking-widest uppercase block">Premiere Pass</span>
                    <h2 class="text-xl font-black text-white">{{ $movie['title'] }}</h2>
                </div>
            </div>
            <div class="text-right">
                <span class="text-[9px] text-emerald-400/70 block uppercase font-bold tracking-wider">Pass Code</span>
                <span class="text-base font-black text-amber-400 tracking-wider">{{ $bookingCode }}</span>
            </div>
        </div>

        <!-- Body Tiket -->
        <div class="p-6 space-y-4 text-xs">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-emerald-400/70 block font-semibold">Nama Penonton</span>
                    <span class="font-extrabold text-white text-sm mt-0.5 block">{{ $booking['customer_name'] }}</span>
                </div>
                <div>
                    <span class="text-emerald-400/70 block font-semibold">Kontak WhatsApp</span>
                    <span class="font-medium text-emerald-100 mt-0.5 block">{{ $booking['customer_phone'] }}</span>
                </div>
                <div>
                    <span class="text-emerald-400/70 block font-semibold">Studio & Jam</span>
                    <span class="font-bold text-amber-300 text-sm mt-0.5 block">{{ $booking['showtime'] }} WIB</span>
                    <span class="text-[10px] text-emerald-400">{{ $movie['studio'] }}</span>
                </div>
                <div>
                    <span class="text-emerald-400/70 block font-semibold">Waktu Pemesanan</span>
                    <span class="font-medium text-emerald-100 mt-0.5 block">{{ $bookingDate }}</span>
                </div>
            </div>

            <!-- Kursi Terpilih -->
            <div class="pt-4 border-t border-emerald-800/70">
                <span class="text-emerald-400/70 block font-semibold mb-2">Kursi Bioskop Terpilih ({{ $totalSeats }} Kursi):</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($seats as $seat)
                    <span class="px-3.5 py-1.5 bg-amber-400 text-slate-950 font-black rounded-xl text-xs shadow-md">
                        {{ $seat }}
                    </span>
                    @endforeach
                </div>
            </div>

            <!-- Total Bayar -->
            <div class="pt-4 border-t border-emerald-800/70 flex items-center justify-between">
                <div>
                    <span class="text-emerald-400/70 block font-semibold">Status Transaksi</span>
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-circle-check mr-1"></i> Lunas (Verified)
                    </span>
                </div>
                <div class="text-xl font-black text-amber-400">
                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Footer Barcode & QR -->
        <div class="bg-[#020b08] p-5 border-t border-dashed border-emerald-800 flex items-center justify-between">
            <div class="text-xs text-emerald-400/70">
                <p class="font-semibold text-emerald-300">{{ $booking['customer_email'] }}</p>
                <p class="text-[10px] text-emerald-500/60 mt-0.5">Tunjukkan barcode ini langsung di pintu masuk studio.</p>
            </div>
            <div class="text-4xl text-amber-400">
                <i class="fa-solid fa-qrcode"></i>
            </div>
        </div>
    </div>

    <!-- Tombol Navigasi -->
    <div class="mt-6 flex gap-4">
        <a href="{{ route('movies.index') }}" class="w-1/2 py-3 bg-emerald-950/80 hover:bg-emerald-900 text-center font-bold text-emerald-200 rounded-2xl text-xs border border-emerald-700/60 transition">
            &larr; Pesan Film Lain
        </a>
        <button onclick="window.print()" class="w-1/2 py-3 bg-amber-400 hover:bg-amber-300 text-center font-black text-slate-950 rounded-2xl text-xs transition shadow-lg shadow-amber-400/20">
            <i class="fa-solid fa-print mr-1.5"></i> Cetak E-Ticket
        </button>
    </div>
</div>
@endsection