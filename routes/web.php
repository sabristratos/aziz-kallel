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

    Route::get('/bewertung', \App\Livewire\SubmitReview::class)->name('review.submit');

    // Legal pages
    Route::get('/impressum', function () {
        return view('legal.impressum');
    })->name('imprint');
});

Route::get('/debug-auth', function () {
    return response()->json([
        'authenticated' => auth()->check(),
        'user_id' => auth()->id(),
        'user_email' => auth()->user()?->email,
        'session_id' => session()->getId(),
        'session_driver' => config('session.driver'),
        'session_data' => session()->all(),
        'cookies' => request()->cookies->all(),
        'has_session_cookie' => request()->hasCookie(config('session.cookie')),
    ]);
})->name('debug.auth');

Route::get('dashboard', \App\Livewire\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('admin/settings', \App\Livewire\Admin\Settings\Index::class)->name('admin.settings');
    Route::get('admin/testimonials', \App\Livewire\Admin\Testimonials\Index::class)->name('admin.testimonials');
    Route::get('admin/faqs', \App\Livewire\Admin\Faqs\Index::class)->name('admin.faqs');
    Route::get('admin/consultation-requests', \App\Livewire\Admin\ConsultationRequests\Index::class)->name('admin.consultation-requests');

    // User settings routes
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
