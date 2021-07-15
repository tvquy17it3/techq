<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| php artisan db:seed --class=UserSeeder
| php artisan migrate:refresh --path=database/migrations/2021_07_11_090609_create_posts_table.php / delete all records only post
| php artisan migrate:reset drop all table,php artisan migrate:refresh delete records all table
| php artisan db:seed --class=UserSeeder
| https://laravel.com/docs/8.x/eloquent-relationships#the-save-method role
| return $user->append('is_admin')->toArray();
|Session::flash('success', 'Bạn tạo bài post thành công');
|https://viblo.asia/p/tim-hieu-eloquent-trong-laravel-phan-1-eloquent-model-database-QpmleBAo5rd
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

    Route::group(['prefix'=>'admintp','middleware'=>'admin'], function()
    {
        Route::get('/', [AdminController::class,'index']);
        Route::get('/posts',[AdminController::class,'post']);
        Route::get('/all-accounts',[AdminController::class,'all_account'])->name('all_accounts');
        Route::get('/blocked',[AdminController::class,'blocked']);
        Route::get('/chua-duyet',[AdminController::class,'chua_duyet']);
        
    });

    // Route::resource('/messages', MessagesController::class)->only([
    //     'index', 'show','store'
    // ]);
    //SOCKET IO (node serversk)
    Route::get('/messages', [MessagesController::class, 'index_room']);
    Route::get('messages/{id}', [MessagesController::class, 'show_room']);

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/drafts', [PostController::class,'drafts'])->name('list_drafts');
        Route::get('/create', [PostController::class,'create'])->name('create_post')->middleware('can:post.create');
        Route::post('/create', [PostController::class,'store'])->name('store_post')->middleware('can:post.create');
        Route::get('/edit/{post}', [PostController::class,'edit'])->name('edit_post')->middleware('can:post.update,post');
        Route::post('/edit/{post}', [PostController::class,'update'])->name('update_post')->middleware('can:post.update,post');
        Route::get('/publish/{post}', [PostController::class,'publish'])->name('publish_post')->middleware('can:post.publish');
    });
});

Route::get('/posts', [PostController::class, 'index'])->name('list_posts');
Route::get('/p/{slug}', [PostController::class,'find_slug'])->name('slug_post');
Route::get('/show/{id}', [PostController::class,'show'])->name('show_post');
Route::get('/count', [App\Http\Livewire\Counter::class,'render']);
Route::get('/users', function () {
    return view('livewire.list-user');
});
