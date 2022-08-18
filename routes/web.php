<?php

use App\Models\Posts;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\SearchController;
use Laravel\Socialite\Facades\Socialite;


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
    return view("home",[
        'tags'=>Tag::all(),
        'posts'=>Posts::latest('created_at')->get()
    ]);
});

Route::middleware('can:admin')->group(function(){

    Route::get('publish', [Postcontroller::class, 'create']);
    Route::post('publish', [Postcontroller::class, 'store']);
    Route::get('publish/{post}/edit', [Postcontroller::class, 'edit']);
    Route::patch('publish/{post}', [Postcontroller::class, 'update']);
    Route::delete('publish/{post}', [Postcontroller::class, 'destroy']);

});

Route::get('home/{post:slug}', [Postcontroller::class, 'view']);

// Route::get('home/{post:slug}', function (Posts $post) {
//     return view("publish.post",[
//         'post' => $post,
//         'tags'=>Tag::all()
//     ]);
// });

Route::get('tag', [Searchcontroller::class, 'viewtag']);
Route::get('tag/{tag:slug}', [Postcontroller::class, 'filter']);

Route::get('register',[Registercontroller::class, 'create'])->middleware('guest');
Route::post('register',[Registercontroller::class, 'store'])->middleware('guest');
Route::get('login',[Logincontroller::class, 'create']);
Route::post('login',[Logincontroller::class, 'store'])->middleware('guest');
Route::get('google/redirect', [GoogleController::class, 'redirect'])->middleware('guest');
Route::get('google/callback', [GoogleController::class, 'callback'])->middleware('guest');
Route::get('facebook/redirect', [FacebookController::class, 'redirect'])->middleware('guest');
Route::get('facebook/callback', [FacebookController::class, 'callback'])->middleware('guest');

Route::post('logout',[Logoutcontroller::class, 'destroy'])->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
