<?php

use App\Http\Controllers\Web\PromptController;
use App\Http\Controllers\Web\PromptFavoriteController;
use App\Http\Controllers\Web\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified'])->prefix('prompts')->group(function () {
    Route::get('/', [PromptController::class, 'index'])->name('prompt.index');
    Route::get('/table', [PromptController::class, 'table'])->name('prompt.table');

    Route::get('/create', [PromptController::class, 'create'])->name('prompt.create');
    Route::post('/', [PromptController::class, 'store'])->name('prompt.store');

    Route::post('/{prompt}/like', [PromptController::class, 'like'])->name('prompt.like');
    Route::delete('/{prompt}/unlike', [PromptController::class, 'unLike'])->name('prompt.unlike');
    Route::post('/{prompt}/favorite', [PromptFavoriteController::class, 'store'])->name('prompt.favorite');
    Route::delete('/{prompt}/unfavorite', [PromptFavoriteController::class, 'destroy'])->name('prompt.unfavorite');

    Route::get('/favorites', [PromptController::class, 'favorites'])->name('favorites.index');

    Route::get('/{prompt}', [PromptController::class, 'show'])->name('prompt.show');
    Route::get('/{prompt}/edit', [PromptController::class, 'edit'])->name('prompt.edit');
    Route::put('/{prompt}', [PromptController::class, 'update'])->name('prompt.update');
    Route::delete('/{prompt}', [PromptController::class, 'destroy'])->name('prompt.destroy');

    // Comments routes
    Route::post('/{prompt}/comments', [CommentController::class, 'store'])->name('prompt.comment.store');
    Route::delete('/{prompt}/comments/{comment}', [CommentController::class, 'destroy'])->name('prompt.comment.delete');
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comment.like');
    Route::delete('/comments/{comment}/unlike', [CommentController::class, 'unLike'])->name('comment.unlike');
});


