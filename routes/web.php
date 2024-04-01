<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\PromptFavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/prompt')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Route::name('prompt.')->group(function () {
        //     Route::post('prompt/{prompt}/comment',[CommentController::class,'store'])->name('prompt.comment.store');
        //     Route::delete('prompt/{prompt}/comment/{comment}',[CommentController::class,'destroy'])->name('prompt.comment.delete');    
        //     Route::put('prompt/{prompt}/comment/{comment}',[CommentController::class,'update'])->name('prompt.comment.update');    
        // });
    // Route::resource('prompt', PromptController::class);
    // Route::post('prompt/{prompt}/comment',[CommentController::class,'store'])->name('prompt.comment.store');
    // Route::delete('prompt/{prompt}/comment/{comment}',[CommentController::class,'destroy'])->name('prompt.comment.delete');    
    // Route::put('prompt/{prompt}/comment/{comment}',[CommentController::class,'update'])->name('prompt.comment.update');  
    // Route::post('prompt/{prompt}/favorite',[PromptFavoriteController::class,'store'])->name('prompt.favorite');
    // Route::delete('prompt/{prompt}/unfavorite',[PromptFavoriteController::class,'destroy'])->name('prompt.unfavorite');
    
    
    
    // Route::post('prompt/{prompt}/like',[PromptController::class,'like'])->name('prompt.like');
    // Route::delete('prompt/{prompt}/unlike',[PromptController::class,'unLike'])->name('prompt.unlike');

    // Route::post('comment/{comment}/like',[CommentController::class,'like'])->name('comment.like');
    // Route::delete('comment/{comment}/unlike',[CommentController::class,'unLike'])->name('comment.unlike');
    Route::resource('prompt', PromptController::class);
    Route::prefix('prompt/{prompt}')->name('prompt.')->group(function () {
        
        Route::post('comment', [CommentController::class, 'store'])->name('comment.store');
        Route::delete('comment/{comment}', [CommentController::class, 'destroy'])->name('comment.delete');    
        Route::put('comment/{comment}', [CommentController::class, 'update'])->name('comment.update');  
        
        Route::post('favorite', [PromptFavoriteController::class, 'store'])->name('favorite');
        Route::delete('unfavorite', [PromptFavoriteController::class, 'destroy'])->name('unfavorite');
        
        Route::post('like', [PromptController::class, 'like'])->name('like');
        Route::delete('unlike', [PromptController::class, 'unLike'])->name('unlike');
    });
    
    Route::prefix('comment')->name('comment.')->group(function () {
        Route::post('/{comment}/like', [CommentController::class, 'like'])->name('like');
        Route::delete('/{comment}/unlike', [CommentController::class, 'unLike'])->name('unlike');
    });
    

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
