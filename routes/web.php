<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\MessagesController;

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
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect'])->name('login.provider');
Route::get('/callback/{provider}', [SocialController::class, 'callback']);


Route::group(['middleware' => 'auth'], function() {
    Route::resource('/messages', MessagesController::class)->only([
        'index', 'show','store'
    ]);
});