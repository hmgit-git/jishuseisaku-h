
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::middleware('auth')->group(function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');
    Route::get('/items/export/csv', [App\Http\Controllers\ItemController::class, 'exportCsv'])->name('items.exportCsv');
});

Route::group(['middleware' => ['auth', 'can:admin']], function (){

    Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index'); // ニュース一覧
    Route::post('/news', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store'); // ニュース追加
    Route::delete('/news/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy'); // ニュース削除

    Route::prefix('items')->group(function () {
        Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::put('/update/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{id}/destroy', [App\Http\Controllers\ItemController::class, 'destroy'])->name('items.destroy');
        Route::get('/items/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('items.edit');
    });
    // 編集画面表示
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    // 更新処理
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    // 削除ルート（必要に応じて）
    Route::delete('/users/{id}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});    