<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::resource('user', UserController::class);
    Route::resource('client', ClientController::class);
    Route::resource('project', ProjectController::class);
    Route::post('project/{projectId}/notes', [ProjectController::class, 'storeNote'])->name('project.store-note');
    Route::post('project/tasks', [ProjectController::class, 'storeTask'])->name('project.store-task');
    Route::post('project/users', [ProjectController::class, 'storeUser'])->name('project.store-user');
    Route::post('project/payment', [ProjectController::class, 'storePayment'])->name('project.store-payment');
    Route::post('project/feedback', [ProjectController::class, 'storeFeedback'])->name('project.store-feedback');
    Route::post('project/Issue', [ProjectController::class, 'storeIssue'])->name('project.store-issue');
    // Route::get('user', [UserController::class, 'index'])->name('users.index');
    // Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
