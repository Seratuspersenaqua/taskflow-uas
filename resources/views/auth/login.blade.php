<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke TaskFlow</title>
    <!-- Tailwind CSS modern via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-radial from-slate-50 to-slate-200 min-h-screen flex items-center justify-center p-4 antialiased font-sans">

    <div class="w-full max-w-md">
        <!-- Logo / Branding Center -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 flex items-center justify-center gap-2">
                🚀 <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">TaskFlow</span>
            </h1>
            <p class="text-sm text-slate-500 mt-2 font-medium">Kelola tugas kuliahmu jauh lebih produktif.</p>
        </div>

        <!-- Card Box Login -->
        <div class="bg-white/80 backdrop-blur-xl border border-white shadow-2xl rounded-2xl p-8 transition-all duration-300 hover:shadow-blue-500/5">
            
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800">Selamat Datang Kembali</h2>
                <p class="text-xs text-slate-400 mt-1">Silakan masukkan akun Anda untuk melanjutkan ke dashboard.</p>
            </div>

            <!-- Session Status Error Bawaan Laravel -->
            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm placeholder-slate-400"
                        placeholder="nama@mahasiswa.ac.id">
                    @if($errors->has('email'))
                        <p class="text-xs text-red-500 mt-1.5 font-medium">⚠️ {{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-slate-700 text-xs font-semibold uppercase tracking-wider">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-blue-600 hover:text-blue-700 hover:underline font-medium" href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm placeholder-slate-400"
                        placeholder="••••••••">
                    @if($errors->has('password'))
                        <p class="text-xs text-red-500 mt-1.5 font-medium">⚠️ {{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" 
                        class="rounded border-slate-300 text-blue-600 w-4 h-4 cursor-pointer focus:ring-blue-500/20">
                    <label for="remember_me" class="ms-2 text-xs text-slate-500 font-medium cursor-pointer select-none">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform active:scale-[0.99] cursor-pointer text-sm text-center">
                        Masuk Ke Akun
                    </button>
                </div>
            </form>

            <!-- Divider Line -->
            <div class="relative flex py-4 items-center">
                <div class="flex-grow border-t border-slate-100"></div>
                <span class="flex-shrink mx-4 text-slate-400 text-[10px] uppercase font-bold tracking-widest">Atau</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <!-- Link Register -->
            <p class="text-center text-sm text-slate-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

</body>
</html>