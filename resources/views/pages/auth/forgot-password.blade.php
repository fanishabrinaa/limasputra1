<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Lupa Password - {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}
    </title>
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
    <div class="absolute top-1/3 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-rose-600/10 blur-[130px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 blur-[140px] rounded-full pointer-events-none"></div>


    <div class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10">

        <div class="w-full max-w-4xl grid lg:grid-cols-2 rounded-3xl overflow-hidden shadow-2xl border border-white/10">


            <!-- ====================================================== -->
            <!-- PANEL KIRI - GAMBAR FULL -->
            <!-- ====================================================== -->

            <div class="hidden lg:flex flex-col justify-between relative overflow-hidden">

                <img
                    src="{{ asset('images/login-limas-putra.png') }}"
                    alt="Putra Limas - Bus Pariwisata, Toko Bangunan dan Jasa Konstruksi"
                    class="absolute inset-0 w-full h-full object-cover"
                >

                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/10 to-black/70"></div>

                <a
                    href="{{ route('beranda') }}"
                    class="relative z-10 inline-flex items-center gap-2 text-xl font-black text-white tracking-tight hover:opacity-90 transition w-fit p-10"
                >
                    <span class="w-3 h-3 rounded-full bg-white"></span>
                    {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}
                </a>

                <div class="relative z-10 text-white p-10">
                    <p class="text-lg font-bold leading-snug">
                        Lupa password?
                        <br>
                        Tenang, kami bantu reset.
                    </p>
                    <p class="text-slate-200/80 text-sm mt-2">
                        Masukkan email terdaftar untuk menerima link reset password.
                    </p>
                </div>

            </div>



            <!-- ====================================================== -->
            <!-- CARD KANAN -->
            <!-- ====================================================== -->

            <div class="bg-white/95 backdrop-blur-xl p-8 sm:p-10 flex flex-col justify-center relative w-full max-w-sm mx-auto lg:max-w-none">

                <!-- MOBILE HEADER -->
                <div class="lg:hidden -mx-8 sm:-mx-10 -mt-8 sm:-mt-10 mb-8 relative overflow-hidden px-8 sm:px-10 pt-8 pb-10">

                    <img
                        src="{{ asset('images/login-limas-putra.png') }}"
                        alt="Putra Limas"
                        class="absolute inset-0 w-full h-full object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/70"></div>

                    <div class="relative z-10">
                        <a
                            href="{{ route('beranda') }}"
                            class="inline-flex items-center gap-2 text-lg font-black text-white tracking-tight hover:opacity-90 transition"
                        >
                            <span class="w-2.5 h-2.5 rounded-full bg-white"></span>
                            {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}
                        </a>

                        <p class="text-slate-200/80 text-xs font-medium mt-3">
                            Masukkan email terdaftar untuk menerima link reset password.
                        </p>
                    </div>

                </div>


                <!-- HEADER -->
                <div class="mb-6 hidden lg:block">

                    <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                        </svg>
                    </div>

                    <h1 class="text-2xl font-black text-slate-900">
                        Lupa Password
                    </h1>

                    <p class="text-slate-400 text-sm mt-1 font-medium">
                        Masukkan email Anda, kami akan kirimkan link untuk reset password.
                    </p>

                </div>


                <!-- STATUS SUKSES -->
                @if (session('status'))
                    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3">
                        {{ session('status') }}
                    </div>
                @endif


                <!-- FORM -->
                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">

                    @csrf

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Alamat Email
                        </label>

                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="nama@email.com"
                                class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-11 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition"
                            >
                        </div>

                        @error('email')
                            <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>


                    <button
                        type="submit"
                        class="w-full bg-rose-700 hover:bg-rose-800 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-rose-950/20 hover:scale-[1.01] flex items-center justify-center gap-2"
                    >
                        <span>Kirim Link Reset Password</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>

                </form>


                <p class="text-center text-xs text-slate-400 mt-6 font-medium">
                    <a href="{{ route('login') }}" class="hover:text-rose-700 transition flex items-center justify-center gap-1">
                        <span>← Kembali ke Login</span>
                    </a>
                </p>

            </div>

        </div>

    </div>

</body>
</html>