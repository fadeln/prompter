<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\PromptController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PromptFavoriteController;

use App\Http\Controllers\Web\CommentController;

Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::redirect('/dashboard', '/prompts');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Include prompt routes
require __DIR__.'/web/promptRoutes.php';


require __DIR__.'/auth.php';
