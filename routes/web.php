<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| php artisan migrate:refresh --path=database/migrations/2021_07_11_090609_create_posts_table.php / delete all records only post
| php artisan migrate:reset drop all table,php artisan migrate:refresh delete records all table
| php artisan db:seed --class=UserSeeder
| https://laravel.com/docs/8.x/eloquent-relationships#the-save-method role
| return $user->append('is_admin')->toArray();
|Session::flash('success', 'Bạn tạo bài post thành công');
|https://viblo.asia/p/tim-hieu-eloquent-trong-laravel-phan-1-eloquent-model-database-QpmleBAo5rd
| https://www.youtube.com/watch?v=wwGjcKXaG-I  selectRows

| https://www.youtube.com/watch?v=IYlf58kxsQg gg drive
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect'])->name('login.provider');
Route::get('/callback/{provider}', [SocialController::class, 'callback']);


Route::group(['middleware' => ['web', 'auth']], function() {


    Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::group(['prefix'=>'admintp','middleware'=>'admintp'], function()
    {
        Route::get('/', [AdminController::class,'index']);

        //POST ADMINTP
        Route::get('/posts',[AdminPostController::class,'post']);
        Route::get('/chua-duyet',[AdminPostController::class,'chua_duyet'])->middleware('can:post.draft');
        Route::get('/da-duyet',[AdminPostController::class,'da_duyet']);
        Route::get('/create-post', [AdminPostController::class,'create_post'])->name('create_post_ad');
        Route::post('/create-post', [AdminPostController::class,'store'])->name('store_post_ad');
        Route::get('/edit/{post}', [AdminPostController::class,'edit'])->name('edit_post_ad')->middleware('can:post.update,post');
        Route::post('/edit/{post}', [AdminPostController::class,'update'])->name('update_post_ad')->middleware('can:post.update,post');
        Route::get('/publish/{post}', [AdminPostController::class,'publish'])->name('publish_post_ad')->middleware('can:post.publish');
        Route::get('/unpublish/{post}', [AdminPostController::class,'unpublish'])->name('unpublish_post_ad')->middleware('can:post.publish');

        Route::post('/upload_image',[AdminPostController::class,'uploadImage'])->name('upload');

        //ACCOUNTS
        Route::get('/all-accounts',[AdminController::class,'all_account'])->name('all_accounts');
        Route::put('/update-role-user',[AdminController::class,'update_role_user'])->name('update_role_user')->middleware('can:role.update-user');
        Route::get('/blocked',[AdminController::class,'blocked']);

        //roles and permissions
        Route::get('roles-permissions',[AdminController::class,'role_permission'])->name('roles_permissions')->middleware('can:role.view');
        Route::get('permission/{role}',[AdminController::class,'permissions'])->name('edit-permisson')->middleware('can:role.update');
        Route::post('permission/{role}',[AdminController::class,'update_permissions'])->name('update-permissons')->middleware('can:role.update');

        Route::get('role/create',[AdminController::class,'role_create'])->name('role-create')->middleware('can:role.create');
        //ANALYTICS
        Route::get('/analytics-users', [AdminController::class,'analyticUser'])->name('analytic-user');
    });



    // Route::resource('/messages', MessagesController::class)->only([
    //     'index', 'show','store'
    // ]);

    //SOCKET IO (node serversk)
    Route::get('/messages', [MessagesController::class, 'index_room']);
    Route::get('messages/{id}', [MessagesController::class, 'show_room']);


    //POST
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/drafts', [PostController::class,'drafts'])->name('list_drafts');
        Route::get('/create', [PostController::class,'create'])->name('create_post')->middleware('can:post.create');
        Route::post('/create', [PostController::class,'store'])->name('store_post')->middleware('can:post.create');
        Route::get('/edit/{post}', [PostController::class,'edit'])->name('edit_post')->middleware('can:post.update,post');
        Route::post('/edit/{post}', [PostController::class,'update'])->name('update_post')->middleware('can:post.update,post');
        Route::get('/publish/{post}', [PostController::class,'publish'])->name('publish_post')->middleware('can:post.publish');
    });
});

//SEARCH 
Route::get('/posts', [PostController::class, 'index'])->name('list_posts');
Route::get('/p/{slug}', [PostController::class,'find_slug'])->name('slug_post');
Route::get('/show/{id}', [PostController::class,'show'])->name('show_post');
Route::get('/count', [App\Http\Livewire\Counter::class,'render']);
Route::get('/test', function () {
    dd(true);
    // return view('livewire.list-user');
});

Route::get('/admin-gate', [AdminController::class,'testGate']);
Route::get('/test-upload', [AdminController::class,'testUpload']);
Route::get('/list', [AdminController::class,'list']);

