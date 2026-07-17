<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun TaskFlow</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-radial from-slate-50 to-slate-200 min-h-screen flex items-center justify-center p-4 antialiased font-sans">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 flex items-center justify-center gap-2">
                🚀 <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">TaskFlow</span>
            </h1>
            <p class="text-sm text-slate-500 mt-2 font-medium">Mulai organisasi tugas kuliahmu hari ini.</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl border border-white shadow-2xl rounded-2xl p-8 transition-all duration-300 hover:shadow-blue-500/5">
            
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800">Registrasi Akun Baru</h2>
                <p class="text-xs text-slate-400 mt-1">Lengkapi data di bawah untuk membuat workspace privat Anda.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm placeholder-slate-400"
                        placeholder="Contoh: Ahmad Fauzi">
                    @if($errors->has('name'))
                        <p class="text-xs text-red-500 mt-1.5 font-medium">⚠️ {{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm placeholder-slate-400"
                        placeholder="nama@mahasiswa.ac.id">
                    @if($errors->has('email'))
                        <p class="text-xs text-red-500 mt-1.5 font-medium">⚠️ {{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1.5">Kata Sandi</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm placeholder-slate-400"
                        placeholder="Minimal 8 karakter">
                    @if($errors->has('password'))
                        <p class="text-xs text-red-500 mt-1.5 font-medium">⚠️ {{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-slate-700 text-xs font-semibold uppercase tracking-wider mb-1.5">Ulangi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm placeholder-slate-400"
                        placeholder="••••••••">
                    @if($errors->has('password_confirmation'))
                        <p class="text-xs text-red-500 mt-1.5 font-medium">⚠️ {{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform active:scale-[0.99] cursor-pointer text-sm text-center">
                        Buat Akun Sekarang
                    </button>
                </div>
            </form>

            <div class="relative flex py-4 items-center">
                <div class="flex-grow border-t border-slate-100"></div>
                <span class="flex-shrink mx-4 text-slate-400 text-[10px] uppercase font-bold tracking-widest">Atau</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <p class="text-center text-sm text-slate-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                    Masuk ke Akun
                </a>
            </p>
        </div>
    </div>

</body>
</html>