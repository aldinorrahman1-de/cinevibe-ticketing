<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineVibe Premiere Cinema')</title>
    <!-- Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 50% 0%, #062b1e 0%, #03140e 60%, #010805 100%);
            min-height: 100vh;
        }
        .gold-glow {
            text-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
        }
        .luxury-card {
            background: linear-gradient(135deg, rgba(8, 41, 30, 0.75) 0%, rgba(4, 21, 15, 0.85) 100%);
            backdrop-filter: blur(16px);
        }
    </style>
</head>
<body class="text-emerald-50 flex flex-col antialiased selection:bg-amber-400 selection:text-black">

    <!-- Header Glassmorphism Mewah -->
    <header class="border-b border-emerald-800/40 bg-[#020b08]/80 sticky top-0 z-50 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('movies.index') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-amber-300 flex items-center justify-center text-slate-950 font-black shadow-lg shadow-amber-500/20 group-hover:scale-105 transition">
                    <i class="fa-solid fa-crown text-base"></i>
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-wider text-amber-400 gold-glow">CINE<span class="text-emerald-300">VIBE</span></span>
                    <span class="block text-[9px] uppercase tracking-widest text-emerald-400/70 font-semibold -mt-1">Premiere Cinema</span>
                </div>
            </a>
            
            <nav class="flex items-center gap-6">
                <a href="{{ route('movies.index') }}" class="text-sm font-semibold text-emerald-200 hover:text-amber-400 transition flex items-center gap-2">
                    <i class="fa-solid fa-film"></i> Now Showing
                </a>
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    Dolby Atmos & IMAX Live
                </div>
            </nav>
        </div>
    </header>

    <!-- Konten Halaman -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-6 py-10">
        @yield('content')
    </main>

    <!-- Footer Elegan -->
    <footer class="border-t border-emerald-900/60 bg-[#010805] text-emerald-400/60 text-xs py-8 text-center">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; {{ date('Y') }} CineVibe Luxury Reservation System. Crafted with Laravel.</p>
            <div class="flex gap-4 text-emerald-400 text-sm">
                <span class="hover:text-amber-400 transition cursor-pointer"><i class="fa-brands fa-instagram"></i></span>
                <span class="hover:text-amber-400 transition cursor-pointer"><i class="fa-brands fa-twitter"></i></span>
                <span class="hover:text-amber-400 transition cursor-pointer"><i class="fa-brands fa-youtube"></i></span>
            </div>
        </div>
    </footer>

</body>
</html>