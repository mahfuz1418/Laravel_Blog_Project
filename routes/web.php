<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontendController::class, 'home'])->name('home');
Route::get('/blog/{slug}',[FrontendController::class, 'blog'])->name('blog');
Route::get('/search',[FrontendController::class, 'search'])->name('search');
Route::get('/showpost/{id}',[FrontendController::class, 'showpost'])->name('showpost');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
 
    // create user routes 
    Route::get('/user', [AdminUserController::class, 'create'])->name('user.create')->middleware('RoleChecker');
    Route::post('/user', [AdminUserController::class, 'store'])->name('user.create')->middleware('RoleChecker');
    Route::get('/user_destroy/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy')->middleware('RoleChecker');
    Route::get('/profile', [AdminUserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [AdminUserController::class, 'update'])->name('profile.update');
    Route::post('/profile/password/{id}', [AdminUserController::class, 'update_password'])->name('profile.password.update');
    Route::resource('category', CategoryController::class)->middleware('RoleChecker');
    Route::post('/category/delete/{id}', [CategoryController::class, 'delete'])->middleware('RoleChecker')->name('category.delete');
    Route::get('/category/resotre/{id}', [CategoryController::class, 'restore'])->middleware('RoleChecker')->name('category.restore');

    // sub category route 
    Route::get('/subcategory/destroy/{id}', [CategoryController::class, 'subdestroy'])->middleware('RoleChecker')->name('subcategory.destroy');
    Route::post('/subcategory/delete/{id}', [CategoryController::class, 'subdelete'])->middleware('RoleChecker')->name('subcategory.delete');
    Route::get('/subcategory/resotre/{id}', [CategoryController::class, 'subrestore'])->middleware('RoleChecker')->name('subcategory.restore');
    Route::resource('tag', TagController::class);
    Route::resource('post', PostController::class);
    Route::post('/post/subcategorylist', [PostController::class, 'getSubCategory']);
    Route::post('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
    Route::get('/post/restore/{id}', [PostController::class, 'restore'])->name('post.restore');
});

require __DIR__.'/auth.php';
