<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Mengakhiri sesi setelah pendaftaran agar pengguna masuk melalui halaman login.
        // Fortify login otomatis setelah daftar, jadi kita logout lagi
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan masuk dengan email dan password Anda.');
    }
}