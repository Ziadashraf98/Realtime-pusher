<?php

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/get', function () {
//     // $post = Comment::first()->created_at;
//     $z = date('d m Y | h:i A' , strtotime(now()));
//     return $z;
// });

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/comment', [App\Http\Controllers\HomeController::class, 'saveComment'])->name('comment.save');