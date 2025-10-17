<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        \Log::info('Login attempt started', ['email' => $this->email, 'remember' => $this->remember]);

        $this->validate();
        \Log::info('Validation passed');

        $this->ensureIsNotRateLimited();
        \Log::info('Rate limit check passed');

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            \Log::warning('Auth attempt failed', ['email' => $this->email]);
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        \Log::info('Auth attempt succeeded', [
            'user_id' => Auth::id(),
            'session_id_before' => session()->getId(),
        ]);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        \Log::info('Session regenerated', [
            'session_id_after' => session()->getId(),
            'auth_check' => Auth::check(),
            'user_id' => Auth::id(),
        ]);

        $this->redirectIntended(default: route('dashboard'));
        \Log::info('Redirect called to dashboard');
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
