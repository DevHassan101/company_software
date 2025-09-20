<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\user\UserDashboardController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
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
    
    $projectCount = Project::count();
    $clientCount = Client::count();
    $userCount = User::count();
    return view('dashboard', [
        'projectCount' => $projectCount,
        'clientCount' => $clientCount,
        'userCount' => $userCount
    ]);


})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::resource('user', UserController::class);
    Route::get('user/{id}/show', [UserController::class, 'show'])->name('user.show');
    Route::resource('client', ClientController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('salary', SalaryController::class);
    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{id}/show', [TaskController::class, 'show'])->name('task.show');
    Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/task/{id}update', [TaskController::class, 'update'])->name('task.update');
    Route::put('/task/{id}/status', [TaskController::class, 'updateStatus'])->name('task.status');
    Route::delete('/task/{id}/delete', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('project/{projectId}/notes', [ProjectController::class, 'storeNote'])->name('project.store-note');
    Route::post('project/{projectId}/tasks', [ProjectController::class, 'storeTask'])->name('project.store-task');
    Route::post('project/users', [ProjectController::class, 'storeUser'])->name('project.store-user');
    Route::post('project/payment', [ProjectController::class, 'storePayment'])->name('project.store-payment');
    Route::post('project/{projectId}/feedback', [ProjectController::class, 'storeFeedback'])->name('project.store-feedback');
    Route::post('project/{projectId}/Issue', [ProjectController::class, 'storeIssue'])->name('project.store-issue');
    // Route::get('user', [UserController::class, 'index'])->name('users.index');
    // Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('test', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('getProject', [UserDashboardController::class, 'getProjects'])->name('getProject.index');
Route::get('showProject/{project}', [UserDashboardController::class, 'showProjects'])->name('showProject.show');
Route::get('getTask', [UserDashboardController::class, 'getTasks'])->name('getTask.index');
Route::get('showTask/{projectTask}', [UserDashboardController::class, 'showTask'])->name('showTask.show');
Route::get('profile-settings', [UserDashboardController::class, 'profileSettings'])->name('user.profile-settings.edit');
Route::put('user/update-profile', [UserDashboardController::class, 'updateProfile'])->name('user.update-profile');
Route::put('userUpdate', [UserDashboardController::class, 'userUpdate'])->name('userUpdate.update');
Route::put('updatePassword', [UserDashboardController::class, 'updatePassword'])->name('updatePassword.update');
Route::delete('userDelete', [UserDashboardController::class, 'userDelete'])->name('userDelete.delete');


require __DIR__ . '/auth.php';
