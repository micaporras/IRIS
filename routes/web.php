<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ToDoController;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('registration', [AuthController::class, 'registration'])->name('registration');
Route::get('list', [ToDoController::class, 'list'])->name('list');
Route::get('todoCalendar', [ToDoController::class, 'todoCalendar'])->name('todoCalendar');
Route::get('todoCalendar1', [ToDoController::class, 'todoCalendar1'])->name('todoCalendar1');
Route::get('todoCalendar2', [ToDoController::class, 'todoCalendar2'])->name('todoCalendar2');
Route::get('editOnlyList', [ToDoController::class, 'editOnlyList'])->name('editOnlyList');
Route::get('viewOnlyList', [ToDoController::class, 'viewOnlyList'])->name('viewOnlyList');
Route::get('usersList', [ToDoController::class, 'usersList'])->name('usersList');
Route::get('create', [ToDoController::class, 'create'])->name('create');
Route::get('bookmarkTab', [ToDoController::class, 'bookmarkTab'])->name('bookmarkTab');
Route::get('bookmarkTab1', [ToDoController::class, 'bookmarkTab1'])->name('bookmarkTab1');
Route::get('edit/{id}', [ToDoController::class, 'edit'])->name('edit');
Route::get('bookmark/{id}', [ToDoController::class, 'bookmark'])->name('bookmark');
Route::get('bookmark1/{id}', [ToDoController::class, 'bookmark1'])->name('bookmark1');
Route::get('editUsers/{id}', [ToDoController::class, 'editUsers'])->name('editUsers');
Route::get('edit2/{id}', [ToDoController::class, 'edit2'])->name('edit2');
Route::post('post-store', [ToDoController::class, 'store'])->name('create.post');
Route::put('update', [ToDoController::class, 'update'])->name('update');
Route::put('addBookmark', [ToDoController::class, 'addBookmark'])->name('addBookmark');
Route::put('addBookmark1', [ToDoController::class, 'addBookmark1'])->name('addBookmark1');
Route::put('update2', [ToDoController::class, 'update2'])->name('update2');
Route::put('updateUser', [ToDoController::class, 'updateUser'])->name('updateUser');
Route::delete('delete/{id}', [ToDoController::class, 'delete'])->name('delete');
Route::delete('deleteEvent/{id}', [ToDoController::class, 'deleteEvent'])->name('deleteEvent');
Route::delete('deleteBM/{id}', [ToDoController::class, 'deleteBM'])->name('deleteBM');
Route::delete('deleteUser/{id}', [ToDoController::class, 'deleteUser'])->name('deleteUser');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('registration.post');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');