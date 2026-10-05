<?php

use Illuminate\Support\Facades\Route;

// Halaman pengaturan profil hanya bisa dibuka setelah pengguna login.
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::livewire('settings/profile', 'pages::settings.profile')->name('profile.edit');
});

// Pengaturan keamanan memerlukan akun terverifikasi dan konfirmasi kata sandi.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('settings/appearance', 'pages::settings.appearance')->name('appearance.edit');

    Route::livewire('settings/security', 'pages::settings.security')
        ->middleware([
            'password.confirm',
        ])
        ->name('security.edit');
});

Route::get('.well-known/passkey-endpoints', function () {
    // Memberi tahu aplikasi passkey alamat halaman untuk mengelola passkey.
    return response()->json([
        'enroll' => route('security.edit'),
        'manage' => route('security.edit'),
    ]);
})->name('well-known.passkeys');
