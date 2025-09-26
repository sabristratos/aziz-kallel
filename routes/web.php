<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// Root redirect to default locale
Route::get('/', function () {
    return redirect('/de');
});

// Localized routes
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'de|ar']], function () {
    Route::get('/', function () {
        return view('homepage');
    })->name('home');

    Route::get('/landing', function () {
        return view('landing');
    })->name('landing');

    // Legal pages
    Route::get('/datenschutz', function () {
        return view('legal.datenschutz');
    })->name('privacy');

    Route::get('/impressum', function () {
        return view('legal.impressum');
    })->name('imprint');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
