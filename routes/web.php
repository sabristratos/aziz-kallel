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
    Route::view('/', 'homepage')->name('home');
    Route::view('/landing', 'landing')->name('landing');

    // Legal pages
    Route::view('/datenschutz', 'legal.datenschutz')->name('privacy');
    Route::view('/impressum', 'legal.impressum')->name('imprint');
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
