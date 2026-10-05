<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    public function create(array $input): User
    {
        // Memeriksa data pendaftaran sebelum membuat akun baru.
        Validator::make($input, [
            ...$this->profileRules(),
            'no_hp'    => 'required|string|max:20',
            'password' => $this->passwordRules(),
        ])->validate();

        // Membuat akun dengan kata sandi yang sudah diubah menjadi bentuk hash.
        $user = User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'no_hp'    => $input['no_hp'],
            'password' => Hash::make($input['password']),
        ]);

        // Menetapkan akun pendaftar sebagai pelanggan.
        $user->forceFill(['role' => 'customer'])->save();

        return $user;
    }
}