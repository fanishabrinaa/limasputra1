<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}</title>
    @php
    $logoLogin = \App\Models\Setting::get('logo');
@endphp

@if ($logoLogin)
    <link rel="icon" type="image/png" href="{{ Storage::url($logoLogin) }}">
@endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 font-sans antialiased text-slate-800 selection:bg-rose-500 selection:text-white relative min-h-screen overflow-x-hidden">

    <!-- Ambient Glow Background -->
    <div class="absolute top-1/3 right-1/4 translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-rose-600/10 blur-[130px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600/10 blur-[140px] rounded-full pointer-events-none"></div>

    <div class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10">
        <div class="w-full max-w-4xl grid lg:grid-cols-2 rounded-3xl overflow-hidden shadow-2xl border border-white/10">

            <!-- CARD DAFTAR (kiri di layar besar, agar berbeda arah dari login) -->
            <div class="order-2 lg:order-1 bg-white/95 backdrop-blur-xl p-8 sm:p-10 flex flex-col justify-center relative w-full max-w-sm mx-auto lg:max-w-none">

                <!-- Strip visual untuk mobile (panel ilustrasi penuh hanya ada di desktop) -->
                <div class="lg:hidden -mx-8 sm:-mx-10 -mt-8 sm:-mt-10 mb-8 relative overflow-hidden px-8 sm:px-10 pt-8 pb-10">
                    <img
                        src="{{ asset('images/login-limas-putra.png') }}"
                        alt="Putra Limas"
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/70"></div>

                    <div class="relative z-10 flex items-center justify-between">
                       
                        <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                    </div>
                    <p class="relative z-10 text-slate-200/80 text-xs font-medium mt-3">Buat akun baru dan mulai bergabung bersama kami.</p>
                </div>

                <div class="mb-6 hidden lg:block">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900">Buat Akun Baru</h1>
                    <p class="text-slate-400 text-sm mt-1 font-medium">Lengkapi data di bawah untuk mulai bergabung.</p>
                </div>

                <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
                    @csrf

                    <!-- NAMA LENGKAP -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus
                                   placeholder="Nama lengkap Anda"
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition">
                        </div>
                        @error('name') <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required
                                   placeholder="nama@email.com"
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition">
                        </div>
                        @error('email') <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <!-- NO. HP / WHATSAPP -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">No. HP / WhatsApp</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <input type="text"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                required
                                placeholder="08xxxxxxxxxx"
                                class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition">
                        </div>
                        @error('no_hp') <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

<!-- PASSWORD -->
<div>
    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
        Password
    </label>

    <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z"
                />
            </svg>
        </span>

        <input
            type="password"
            name="password"
            id="password"
            required
            placeholder="••••••••"
            class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-12 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition"
        >

        <!-- Tombol lihat password -->
        <button
            type="button"
            onclick="togglePassword('password', this)"
            class="absolute right-0 top-0 h-full px-4 flex items-center text-slate-400 hover:text-slate-600 transition"
            aria-label="Tampilkan password"
        >
            <!-- mata terbuka -->
            <svg
                class="eye-open w-4 h-4"
                style="display:block"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                />
            </svg>

            <!-- mata dicoret -->
            <svg
                class="eye-closed w-4 h-4"
                style="display:none"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                />
            </svg>
        </button>
    </div>

    @error('password')
        <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
    @enderror
</div>

                    <!-- KONFIRMASI PASSWORD -->
<div>
    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
        Konfirmasi Password
    </label>

    <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
        </span>

        <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            required
            placeholder="••••••••"
            class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-12 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition"
        >

        <!-- Tombol lihat password -->
        <button
            type="button"
            onclick="togglePassword('password_confirmation', this)"
            class="absolute right-0 top-0 h-full px-4 flex items-center text-slate-400 hover:text-slate-600 transition"
            aria-label="Tampilkan konfirmasi password"
        >
            <!-- mata terbuka -->
            <svg
                class="eye-open w-4 h-4"
                style="display:block"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                />
            </svg>

            <!-- mata dicoret -->
            <svg
                class="eye-closed w-4 h-4"
                style="display:none"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                />
            </svg>
        </button>
    </div>

    @error('password_confirmation')
        <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
    @enderror
</div>
                <!-- LOGIN LINK -->
                <div class="pt-6 mt-6 border-t border-slate-100 text-center">
                    <p class="text-xs text-slate-500">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="text-rose-700 font-bold hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <!-- FOOTER BACK TO HOME -->
                <p class="text-center text-xs text-slate-400 mt-6 font-medium">
                    <a href="{{ route('beranda') }}" class="hover:text-rose-700 transition flex items-center justify-center gap-1">
                        <span>← Kembali ke Beranda</span>
                    </a>
                </p>
            </div>

            <!-- PANEL ILUSTRASI (kanan di layar besar) - GAMBAR FULL, TANPA MERAH -->
            <div class="order-1 lg:order-2 hidden lg:flex flex-col justify-between relative overflow-hidden">

                <img
                    src="{{ asset('images/login-limas-putra.png') }}"
                    alt="Putra Limas - Bus Pariwisata, Toko Bangunan dan Jasa Konstruksi"
                    class="absolute inset-0 w-full h-full object-cover"
                >

                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/10 to-black/70"></div>
            </div>

        </div>
    </div>
</body>
</html>