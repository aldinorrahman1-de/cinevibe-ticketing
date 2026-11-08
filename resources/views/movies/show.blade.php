@extends('layouts.app')

@section('title', $movie['title'] . ' - Premiere Detail')

@section('content')
<div class="mb-6">
    <a href="{{ route('movies.index') }}" class="text-emerald-300 hover:text-amber-400 text-xs font-semibold inline-flex items-center gap-2 transition bg-emerald-950/40 px-3.5 py-2 rounded-xl border border-emerald-800/50">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog Film
    </a>
</div>

<div class="luxury-card border border-emerald-700/60 rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden">
    <div class="flex flex-col md:flex-row gap-10">
        <!-- Poster Frame Emas -->
        <div class="w-full md:w-1/3 flex-shrink-0">
            <div class="rounded-2xl overflow-hidden border-2 border-amber-400/30 shadow-2xl shadow-emerald-950/80">
                <img src="{{ $movie['banner'] }}" alt="{{ $movie['title'] }}" class="w-full h-auto object-cover max-h-[460px]">
            </div>
        </div>

        <!-- Metadata & Sinopsis -->
        <div class="w-full md:w-2/3 flex flex-col justify-between">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="px-3 py-1 bg-amber-400/10 text-amber-400 border border-amber-400/30 rounded-lg text-xs font-bold uppercase tracking-wider">
                        {{ $movie['genre'] }}
                    </span>
                    <span class="px-3 py-1 bg-emerald-900/60 text-emerald-200 border border-emerald-700/60 rounded-lg text-xs font-semibold">
                        {{ $movie['studio'] }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">{{ $movie['title'] }}</h1>

                <div class="flex flex-wrap items-center gap-6 text-sm text-emerald-200/80 mt-4 pb-6 border-b border-emerald-800/60">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-star text-amber-400"></i> <strong class="text-white">{{ $movie['rating'] }}</strong> Rating</span>
                    <span class="flex items-center gap-2"><i class="fa-regular fa-clock text-amber-400"></i> <strong class="text-white">{{ $movie['duration'] }}</strong> Durasi</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-ticket text-amber-400"></i> <strong class="text-amber-400">Rp {{ number_format($movie['price'], 0, ',', '.') }}</strong> / Kursi</span>
                </div>

                <div class="mt-6">
                    <h3 class="text-xs font-bold text-amber-300 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-align-left text-amber-400"></i> Sinopsis Cerita
                    </h3>
                    <p class="text-emerald-100/80 text-sm leading-relaxed">{{ $movie['synopsis'] }}</p>
                </div>
            </div>

            <!-- Pilihan Jam Tayang Elegan -->
            <div class="mt-10 pt-6 border-t border-emerald-800/80">
                <h3 class="text-xs font-bold text-emerald-300 uppercase tracking-widest mb-3">Pilih Jam Penayangan Tersedia:</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($movie['schedules'] as $time)
                    <a href="{{ route('movies.book', ['id' => $movie['id'], 'time' => $time]) }}" 
                       class="py-3 px-4 bg-emerald-950/70 hover:bg-amber-400 hover:text-slate-950 border border-emerald-700/70 hover:border-amber-400 rounded-2xl font-extrabold text-center transition-all duration-200 shadow-md flex flex-col items-center group">
                        <span class="text-[10px] uppercase font-semibold text-emerald-400 group-hover:text-slate-900">Showtime</span>
                        <span class="text-base mt-0.5">{{ $time }} WIB</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection