<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (auth()->user()->role === 'admin') {
            return redirect('/dashboard');
        }

        return redirect()->route('beranda');
    }
}