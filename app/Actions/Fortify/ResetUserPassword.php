<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {
        // Memeriksa kata sandi baru sebelum memperbarui akun pengguna.
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        // Menyimpan kata sandi baru pada akun yang sedang dipulihkan.
        $user->forceFill([
            'password' => $input['password'],
        ])->save();
    }
}
