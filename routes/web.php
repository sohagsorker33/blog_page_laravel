<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

//Frontend Routes
Route::get('/dashboard',[FrontendController::class,'dashboard'])->middleware(['auth',
'verified'])->name('dashboard');
Route::get('/author_login',[FrontendController::class,'author_login'])->name('author.login');
Route::get('/author_register',[FrontendController::class,'author_register'])->name('author.register');
// Frontend Home Routes
Route::get('/',[HomeController::class,'master'])->name(name: 'master');
 require __DIR__.'/auth.php';


//Backend Routes

Route::get('/dashboard',[FrontendController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Profile Routes

Route::get('/edit_profile',[UserController::class,'edit_profile'])->middleware(['auth', 'verified'])->name('edit.profile');
Route::post('/update_profile',[UserController::class,'update_profile'])->name('update.profile');
Route::post('/update_password',[UserController::class,'update_password'])->name('update.password');
Route::post('/update_photo',[UserController::class,'update_photo'])->name('update.photo');
Route::get('/user_list',[UserController::class,'user_list'])->name('user.list')->middleware(['auth', 'verified']);
Route::get('/user_delete/{user_id}',[UserController::class,'user_delete'])->name('user.delete');
Route::post('/add_user',[UserController::class,'add_user'])->name('add.user');


// Category Routes

 Route::get('/category_user',[CategoryController::class,'category_user'])->middleware(['auth', 'verified'])->name('category.user');
Route::post('/category_add',[CategoryController::class,'category_add'])->name('category.add');

Route::get('/category_edit/{category_id}',[CategoryController::class,'category_edit'])->name('category.edit');
Route::post('/category_update/{category_id}',[CategoryController::class,'category_update'])->name('category.update');
 Route::get('/category_delete/{category_id}',[CategoryController::class,'category_delete'])->name('category.delete');
 Route::get('/category_trash',[CategoryController::class,'category_trash'])->middleware(['auth', 'verified'])->name('category.trash');
 Route::get('/category_restore/{category_id}',[CategoryController::class,'category_restore'])->name('category.restore');
 Route::get('/category_hard_delete/{category_id}',[CategoryController::class,'category_hard_delete'])->name('category.hard.delete');
Route::post('/check_delete',[CategoryController::class,'check_delete'])->name('check.delete');
Route::post('/restore_delete_check',[CategoryController::class,'restore_delete_check'])->name('restore.delete.check');
Route::get('/tags_list',[CategoryController::class,'tags_list'])->middleware(['auth', 'verified'])->name('tags.list');
Route::post('/tags_add',[CategoryController::class,'tags_add'])->name('tags.add');

Route::get('/tag_list_delete/{tag_id}',[CategoryController::class,'tag_list_delete'])->name('tag.list.delete');

// Author Routes

Route::post('/author_insert_register',[AuthorController::class,'author_insert_register'])->name('author.insert.register');
Route::post('/author_login_post',[AuthorController::class,'author_login_post'])->name('author.login.post');
Route::get('/author_logout',[AuthorController::class,'author_logout'])->name('author.logout');
Route::get('/author_admin_panel',[AuthorController::class,'author_admin_panel'])->middleware('author')->name('author.admin.panel');
Route::get('/admin_home',[AuthorController::class,'admin_home'])->middleware('author')->name('admin.home');
Route::get('/author',[UserController::class,'author'])->name('author');
Route::get('/author_status/{author_id}',[UserController::class,'author_status'])->name('author.status');
Route::get('/author_delete/{author_id}',[UserController::class,'author_delete'])->name('author.delete');
