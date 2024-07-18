<?php

use App\Filament\Pages\CustomLogin;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\OnlyNonAdminAllowedMiddleware;
use Filament\Pages\Auth\CustomRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $appName = env('APP_NAME');

    return view('welcome', compact('appName'));
})->name('landing');

Route::get('/auth/login', function () {
   return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('/auth/register', function () {
   return redirect()->route('filament.admin.auth.register');
})->name('register');

//Route::get('/register', function () {
//   return redirect()->route('filament.admin.auth.register', request()?->all());
//})->name('register');

Route::get('/register', CustomRegister::class)->name('filament.admin.auth.register');
Route::get('/login', CustomLogin::class)->name('filament.admin.auth.login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/panel');
})->name('logout');

Route::get('/levels-calculator', [MainController::class, 'levelsCalculator'])->name('levels-calculator');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::post('/contact', [MainController::class, 'contactAction'])->name('contact-action');
Route::get('/faq', [MainController::class, 'faq'])->name('faq');

Route::prefix('/panel')
    ->middleware([
        'auth',
        OnlyNonAdminAllowedMiddleware::class
    ])
    ->group(function () {
    Route::get('/', function () {
        return redirect()->route('user.home');
    });
    Route::get('/home', [MainController::class, 'home'])->name('user.home');
    Route::get('/levels', [MainController::class, 'levels'])->name('user.levels');
    Route::get('/team', [MainController::class, 'team'])->name('user.team');
    Route::get('/general', [MainController::class, 'general'])->name('user.general');
    Route::get('/profile', [MainController::class, 'profile'])->name('user.profile');
    Route::get('/change-password', [MainController::class, 'changePassword'])->name('user.change-password');
    Route::post('/change-password', [MainController::class, 'changePasswordAction'])->name('user.changePasswordAction');

    Route::get('/level-upgrade/{level}', [LevelController::class, 'upgrade'])->name('user.level.upgrade');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('user.transactions');

    Route::get('/withdraw', [TransactionController::class, 'withdraw'])->name('user.withdraw');
    Route::post('/withdraw', [TransactionController::class, 'withdrawAction'])->name('user.withdrawAction');
    Route::get('/deposit', [TransactionController::class, 'deposit'])->name('user.deposit');
    Route::post('/claim-bonus', [LevelController::class, 'claimBonusAction'])->name('user.claim-bonus');
});
