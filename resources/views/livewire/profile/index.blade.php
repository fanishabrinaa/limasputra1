<div class="max-w-3xl mx-auto px-4 md:px-0 py-10 space-y-6">

    <!-- PAGE HEADER -->
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Profil Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola informasi akun dan keamanan login kamu.</p>
    </div>

    <!-- ====================================================== -->
    <!-- INFORMASI PROFIL -->
    <!-- ====================================================== -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-1">Informasi Profil</h2>
        <p class="text-xs text-slate-500 mb-5">Update nama, email, dan nomor HP kamu.</p>

        @if (session()->has('message'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-xl flex items-center gap-2 text-sm font-semibold mb-5">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit="updateProfile" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" wire:model="name"
                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                @error('name') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Alamat Email</label>
                <input type="email" wire:model="email"
                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                @error('email') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">No. HP / WhatsApp</label>
                <input type="text" wire:model="no_hp"
                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                @error('no_hp') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- ====================================================== -->
    <!-- GANTI PASSWORD -->
    <!-- ====================================================== -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-1">Ganti Password</h2>
        <p class="text-xs text-slate-500 mb-5">Pastikan gunakan password yang kuat dan tidak dipakai di tempat lain.</p>

        @if (session()->has('message_password'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-xl flex items-center gap-2 text-sm font-semibold mb-5">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('message_password') }}
            </div>
        @endif

        <form wire:submit="updatePassword" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Password Saat Ini</label>
                <input type="password" wire:model="current_password"
                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                @error('current_password') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Password Baru</label>
                <input type="password" wire:model="password"
                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                @error('password') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Konfirmasi Password Baru</label>
                <input type="password" wire:model="password_confirmation"
                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-md">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- LINK RIWAYAT PEMESANAN (khusus customer) -->
    @if (auth()->user()->role === 'customer')
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Riwayat Pemesanan</h2>
                <p class="text-xs text-slate-500 mt-1">Lihat semua pemesanan yang pernah kamu buat.</p>
            </div>
            <a href="{{ route('pemesanan.riwayat') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold px-5 py-2.5 rounded-xl transition">
                Lihat →
            </a>
        </div>
    @endif
</div>