<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GlobalSettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout',[LoginController::class,'logout']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile',function(){
    $roles = Role::all();
    return view('sections.profile.show',compact('roles'));
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('articles',ArticleController::class);
    Route::put('/global-setting-update',[GlobalSettingController::class, 'update'])->name('globalSettingUpdate');

});
