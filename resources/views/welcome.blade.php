<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Manajemen Tugas Kuliah</title>
    <!-- Tailwind CSS modern via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-radial from-slate-50 to-slate-200 min-h-screen flex flex-col justify-between antialiased font-sans">

    <!-- Navbar Atas -->
    <header class="w-full max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2">
            🚀 <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">TaskFlow</span>
        </h1>
        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl shadow-md transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 px-4 py-2 rounded-xl shadow-xs transition-all">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <!-- Hero Section / Konten Utama -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="max-w-3xl text-center space-y-6">
            <!-- Badge Info -->
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full text-xs font-semibold text-blue-700 mx-auto">
                ✨ Manajemen Tugas Jauh Lebih Mudah
            </div>

            <!-- Headline Utama -->
            <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Atur Tugas Kuliahmu <br>
                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Tanpa Ribet, Kelar Tepat Waktu.</span>
            </h2>

            <!-- Deskripsi Singkat -->
            <p class="text-base sm:text-lg text-slate-500 max-w-xl mx-auto font-medium">
                Aplikasi workspace privat untuk mencatat, memantau, dan menyelesaikan seluruh deadline tugas akademikmu dalam satu dashboard terintegrasi.
            </p>

            <!-- Tombol Aksi Utama -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                            class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform active:scale-95 text-center text-sm">
                            Buka Workspace Anda ➡️
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                            class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform active:scale-95 text-center text-sm cursor-pointer">
                            Mulai Sekarang — Gratis
                        </a>
                        <a href="{{ route('login') }}" 
                            class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-700 font-semibold py-3.5 px-8 rounded-xl border border-slate-200 shadow-xs transition-all text-center text-sm cursor-pointer">
                            Sudah Punya Akun?
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </main>

    <!-- Footer Bawah -->
    <footer class="w-full max-w-6xl mx-auto px-6 py-5 text-center border-t border-slate-200/50">
        <p class="text-xs text-slate-400 font-medium">&copy; 2026 TaskFlow App. Dibuat untuk Kemudahan Akademik.</p>
    </footer>

</body>
</html>