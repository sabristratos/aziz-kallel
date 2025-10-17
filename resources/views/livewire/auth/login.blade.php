<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <div class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Remember me')" />

        <div class="flex items-center justify-end">
            <flux:button
                wire:click="login"
                variant="primary"
                class="w-full"
                x-on:click="console.log('Login button clicked', { email: $wire.email, remember: $wire.remember })"
            >
                <span wire:loading.remove>{{ __('Log in') }}</span>
                <span wire:loading>{{ __('Logging in...') }}</span>
            </flux:button>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized on login page');

            Livewire.on('redirect', (url) => {
                console.log('Livewire redirect event:', url);
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            console.log('Login page loaded', {
                cookies: document.cookie,
                sessionStorage: Object.keys(sessionStorage),
                localStorage: Object.keys(localStorage)
            });
        });
    </script>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
        </div>
    @endif
</div>
