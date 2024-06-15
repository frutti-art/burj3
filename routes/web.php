<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\OnlyNonAdminAllowedMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
   return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/panel');
})->name('logout');

Route::get('/levels-calculator', [MainController::class, 'levelsCalculator'])->name('levels-calculator');

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

    Route::get('/level-upgrade/{level}', [LevelController::class, 'upgrade'])->name('user.level.upgrade');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('user.transactions');

    Route::get('/withdraw', [TransactionController::class, 'withdraw'])->name('user.withdraw');
    Route::post('/withdraw', [TransactionController::class, 'withdrawAction'])->name('user.withdrawAction');
    Route::get('/deposit', [TransactionController::class, 'deposit'])->name('user.deposit');
    Route::post('/claim-bonus', [LevelController::class, 'claimBonusAction'])->name('user.claim-bonus');
});
