<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

// 教わったこと
Auth::routes([
    'register' => true,
    'reset' => false,
    'confirm' => true,
    'verify' => true,
]);

// 教わったこと
// bookmarksとかtasks複数にする → 一覧で出るから複数 {$id}をつければそのうちの一個だとURLからわかる。
// resourceは無駄なルートが増える しかもrouteを見ただけだと何を使っているかわからない
// /task などprefixが一緒でgroupingする機能がある。
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('', [TaskController::class, 'store'])->name('store');
        Route::get('/{task}', [TaskController::class, 'show'])->name('show');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
    });
    Route::get('/bookmarks', [TaskController::class, 'listBookmark'])->name('tasks.bookmark');
    Route::put('/bookmarks/{task}', [TaskController::class, 'updateBookmark'])->name('tasks.updateBookmark');
});