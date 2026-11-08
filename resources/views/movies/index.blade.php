@extends('layouts.app')

@section('title', 'Luxury Now Showing - CineVibe Premiere')

@section('content')
<!-- Hero Section Mewah -->
<div class="relative rounded-3xl overflow-hidden p-8 md:p-12 mb-12 border border-emerald-700/40 shadow-2xl bg-gradient-to-r from-[#031d14] via-[#052b1e] to-[#02130d]">
    <div class="absolute -right-10 -bottom-10 opacity-10 text-[180px] text-amber-400 pointer-events-none">
        <i class="fa-solid fa-film"></i>
    </div>
    <div class="max-w-2xl relative z-10">
        <span class="px-3.5 py-1.5 rounded-full bg-amber-400/10 text-amber-400 border border-amber-400/30 text-xs font-bold uppercase tracking-widest inline-block mb-4">
            The Art Of Cinema 
        </span>
        <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">
            Keindahan Sinema<span class="text-amber-400 underline decoration-amber-500/50"> Indah dalam Setiap Adegan</span>
        </h1>
        <p class="text-emerald-200/80 mt-3 text-sm md:text-base leading-relaxed">
            Dari setiap bingkai hingga lantunan suara, rasakan keistimewaan menonton dalam balutan teknologi Dolby Atmos dan kenyamanan eksklusif
        </p>
    </div>
</div>

<!-- Header Judul & Filter Status -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-extrabold text-white flex items-center gap-3">
            <span class="w-2.5 h-6 bg-amber-400 rounded-full inline-block"></span>
            Sedang Tayang di Bioskop ({{ count($movies) }} Film)
        </h2>
        <p class="text-xs text-emerald-300/70 mt-1">Jadwal penayangan terupdate secara real-time</p>
    </div>
</div>

<!-- Grid 12 Film Mewah (3 Kolom di Laptop, 4 Kolom di Layar Lebar) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
    @foreach($movies as $movie)
    <div class="luxury-card border border-emerald-800/60 hover:border-amber-400/60 rounded-2xl overflow-hidden shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col justify-between">
        <div>
            <!-- Banner Poster -->
            <div class="h-72 overflow-hidden relative">
                <img src="{{ $movie['banner'] }}" alt="{{ $movie['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-[#04150f] via-transparent to-black/30"></div>
                
                <!-- Rating Badge -->
                <div class="absolute top-3 right-3 bg-black/80 backdrop-blur-md px-3 py-1 rounded-full text-amber-400 text-xs font-black flex items-center gap-1.5 border border-amber-400/40 shadow-lg">
                    <i class="fa-solid fa-star text-[11px]"></i> {{ $movie['rating'] }}
                </div>

                <!-- Studio Tag -->
                <div class="absolute bottom-3 left-3 bg-emerald-950/80 backdrop-blur-md px-2.5 py-1 rounded-lg text-emerald-200 text-[11px] font-semibold border border-emerald-600/50">
                    <i class="fa-solid fa-video text-amber-400 mr-1"></i> {{ $movie['studio'] }}
                </div>
            </div>

            <!-- Detail Film -->
            <div class="p-5">
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-400/90">{{ $movie['genre'] }}</span>
                <h3 class="text-lg font-bold text-white mt-1 group-hover:text-amber-300 transition line-clamp-1">{{ $movie['title'] }}</h3>
                <div class="flex items-center gap-2 text-xs text-emerald-300/70 mt-1">
                    <i class="fa-regular fa-clock"></i> <span>{{ $movie['duration'] }}</span>
                </div>
                <p class="text-xs text-emerald-100/70 mt-3 line-clamp-2 leading-relaxed">{{ $movie['synopsis'] }}</p>
            </div>
        </div>

        <!-- Bagian Bawah & Tombol -->
        <div class="p-5 pt-0">
            <div class="pt-4 border-t border-emerald-800/60 flex items-center justify-between">
                <div>
                    <span class="text-[10px] text-emerald-400/60 block uppercase font-medium">Tiket Mulai</span>
                    <span class="text-base font-extrabold text-amber-400">Rp {{ number_format($movie['price'], 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('movies.show', $movie['id']) }}" class="px-4 py-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-bold rounded-xl text-xs transition duration-200 shadow-md shadow-amber-500/20 flex items-center gap-1.5">
                    <span>Jadwal</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection