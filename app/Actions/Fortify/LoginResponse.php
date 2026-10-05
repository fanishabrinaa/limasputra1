<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Mengarahkan admin ke dashboard dan pelanggan ke halaman beranda.
        if (auth()->user()->role === 'admin') {
            return redirect('/dashboard');
        }

        return redirect()->route('beranda');
    }
}