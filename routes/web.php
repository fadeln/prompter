<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\PromptLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/prompt')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('prompt', PromptController::class);
    
    Route::post('prompt/{prompt}/like',[PromptLikeController::class,'store'])->name('prompt.like');
    Route::delete('prompt/{prompt}/unlike',[PromptLikeController::class,'destroy'])->name('prompt.unlike');

    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
