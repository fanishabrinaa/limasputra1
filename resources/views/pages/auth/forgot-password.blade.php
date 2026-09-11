<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - {{ \App\Models\Setting::get('nama_perusahaan', 'Limas Putra') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="{{ route('beranda') }}" class="text-2xl font-bold text-rose-700">
                    {{ \App\Models\Setting::get('nama_perusahaan', 'Limas Putra') }}
                </a>
                <p class="text-slate-500 mt-2">Lupa Password</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                <p class="text-sm text-slate-500 mb-6">
                    Masukkan email kamu, kami akan kirim link untuk reset password.
                </p>

                @if (session('status'))
                    <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-rose-700">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-rose-700 hover:bg-rose-800 text-white font-semibold py-2.5 rounded-lg transition">
                        Kirim Link Reset Password
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-6">
                    <a href="{{ route('login') }}" class="text-rose-700 font-medium hover:underline">
                        ← Kembali ke Login
                    </a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>