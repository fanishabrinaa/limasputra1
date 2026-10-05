<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Http\Responses\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengatur proses autentikasi, halaman autentikasi, dan batas percobaan.
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        // Menghubungkan proses daftar, reset kata sandi, dan respons login khusus.
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);

        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Actions\Fortify\LoginResponse::class
        );
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        // Menentukan halaman yang dipakai untuk setiap proses autentikasi.
        Fortify::loginView(fn () => view('pages.auth.login'));
        Fortify::verifyEmailView(fn () => view('pages.auth.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('pages.auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('pages.auth.confirm-password'));
        Fortify::registerView(fn () => view('pages.auth.register'));
        Fortify::resetPasswordView(function (Request $request) {
    return view('pages.auth.reset-password', ['request' => $request]);
});
        Fortify::requestPasswordResetLinkView(fn () => view('pages.auth.forgot-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        // Membatasi jumlah percobaan login, verifikasi dua langkah, dan passkey.
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()).'|'.$request->ip(),
            );
        });
    }
}