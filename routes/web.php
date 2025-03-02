<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadLaterController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware([ 'admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin_user', [AdminController::class, 'manageUser'])->name('admin_user');
        // duyệt xóa
        Route::get('post/{id}/approve',[AdminController::class,'approve'])->name('approve');
        Route::get('post/{id}/reject',[AdminController::class,'reject'])->name('reject');
        //remove user
        Route::delete('/remove_user/{id}', [AdminController::class, 'remove_user'])->name('remove_user');

    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function(){
    Route::prefix('/post/')->group(function(){
        Route::get('addpost',[PostController::class,'addpost'])->name('addpost');
        Route::post('storepost',[PostController::class,'storepost'])->name('storepost');
        Route::get('allpost',[PostController::class,'all_post'])->name('all_post');
        Route::get('postdetail/{slug}',[PostController::class,'post_detail'])->name('post_detail');
        // update
        Route::get('editpost/{slug}',[PostController::class,'edit_post'])->name('edit_post');
        Route::put('updatepost/{slug}',[PostController::class,'update_post'])->name('update_post');
        //delete
        Route::delete('deletepost/{slug}',[PostController::class,'destroy_post'])->name('destroy_post');
        // like
        Route::post('like/{id}',[PostController::class,'like'])->name('like');
        // avatar
        Route::put('user/avatar',[PostController::class,'avatar'])->name('avatar');
        // comment
        Route::post('comment/{id}',[PostController::class,'store_comment'])->name('store_comment');
        // search
        Route::get('search',[PostController::class,'search'])->name('search');
        // profile
        Route::get('/profile/{id}', [PostController::class, 'show'])->name('profile_detail');
        

    });
    Route::post('/reading-list/add_later/{postId}',[ReadLaterController::class,'add_later'])->name('add_later');
    Route::delete('/reading-list/remove_later/{postId}',[ReadLaterController::class,'remove_later'])->name('remove_later');
    Route::get('reading-list',[ReadLaterController::class,'index'])->name('read_later_list');
});

require __DIR__.'/auth.php';
