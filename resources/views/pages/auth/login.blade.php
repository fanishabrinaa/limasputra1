<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – {{ \App\Models\Setting::get('nama_perusahaan', 'Limas Putra') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-950 to-slate-900 font-sans antialiased text-slate-800 relative min-h-screen flex items-center justify-center overflow-x-hidden">

    <!-- Ambient rose glow -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[720px] h-[420px] bg-rose-600/10 blur-[140px] rounded-full"></div>
    </div>

    <div class="w-full max-w-md px-4 py-12 relative z-10">

        <!-- LOGO & TITLE -->
        <div class="text-center mb-10">
            <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2 text-3xl font-extrabold text-white transition-colors hover:text-rose-200">
                <span class="w-4 h-4 rounded-full bg-rose-600"></span>
                {{ \App\Models\Setting::get('nama_perusahaan', 'Limas Putra') }}
            </a>
            <p class="text-slate-400 text-sm mt-3 font-medium">
                Selamat datang kembali! Silakan masuk ke akun Anda.
            </p>
        </div>

        <!-- CARD LOGIN -->
        <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-3xl p-8 sm:p-10 shadow-2xl relative">
            <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                @csrf

                <!-- EMAIL -->
                <div class="relative">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-rose-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/>
                            </svg>
                        </span>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               placeholder="nama@email.com"
                               class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition"/>
                    </div>
                    @error('email')
                        <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-rose-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 11v10h12V11M4 11h16"/>
                            </svg>
                        </span>
                        <input type="password"
                               name="password"
                               required
                               placeholder="••••••••"
                               class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition"/>
                    </div>
                    @error('password')
                        <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- REMEMBER / FORGOT -->
                <div class="flex items-center justify-between text-xs font-medium pt-1">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox"
                               name="remember"
                               class="rounded border-slate-300 text-rose-700 focus:ring-rose-700 w-4 h-4">
                        <span>Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-rose-600 font-semibold hover:underline">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- SUBMIT -->
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-rose-700 hover:bg-rose-800 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-[1.02]">
                    <span>Masuk ke Akun</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- REGISTER LINK -->
            @if (Route::has('register'))
                <div class="pt-6 mt-6 border-t border-slate-200 text-center">
                    <p class="text-xs text-slate-500">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}"
                           class="text-rose-600 font-bold hover:underline">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            @endif
        </div>

        <!-- BACK TO HOME -->
        <p class="text-center text-xs text-slate-400 mt-8 font-medium">
            <a href="{{ route('beranda') }}"
               class="flex items-center justify-center gap-1 text-slate-400 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </p>
    </div>

</body>
</html>