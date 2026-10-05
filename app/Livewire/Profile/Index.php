<?php

namespace App\Livewire\Profile;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Index extends Component
{
    use PasswordValidationRules, ProfileValidationRules;

    // ===== Info Profil =====
    public $name;
    public $email;
    public $no_hp;

    // ===== Ganti Password =====
    public $current_password;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        // Mengisi formulir profil dengan data akun yang sedang login.
        $user = Auth::user();

        $this->name  = $user->name;
        $this->email = $user->email;
        $this->no_hp = $user->no_hp;
    }

    public function render()
    {
        return view('livewire.profile.index')->layout('layouts.app');
    }

    /**
     * Update informasi profil (nama, email, no. HP).
     */
    public function updateProfile()
    {
        $user = Auth::user();

        // Memeriksa data profil sebelum menyimpan perubahan.
        $this->validate([
            ...$this->profileRules($user->id),
            'no_hp' => 'required|string|max:20',
        ]);

        $user->fill([
            'name'  => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
        ])->save();

        session()->flash('message', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password akun (butuh verifikasi password lama).
     */
    public function updatePassword()
    {
        // Memeriksa kata sandi lama dan aturan kata sandi baru.
        $this->validate([
            'current_password' => $this->currentPasswordRules(),
            'password'         => $this->passwordRules(),
        ]);

        // Menyimpan kata sandi baru dalam bentuk hash.
        Auth::user()->forceFill([
            'password' => Hash::make($this->password),
        ])->save();

        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('message_password', 'Password berhasil diperbarui.');
    }
}