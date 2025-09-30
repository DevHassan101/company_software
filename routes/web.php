<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminClientController;
use App\Http\Controllers\admin\AdminProjectController;
use App\Http\Controllers\admin\AdminTaskController;
use App\Http\Controllers\admin\AdminPaymentController;
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
use App\Models\Expense;
use App\Models\ProjectPayment;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
    $projectStatusCounts = Project::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

    $pending = $projectStatusCounts['pending'] ?? 0;
    $ongoing = $projectStatusCounts['ongoing'] ?? 0;
    $delivered = $projectStatusCounts['delivered'] ?? 0;
    $continued = $projectStatusCounts['continued'] ?? 0;

    $projectCount = Project::count();
    $clientCount = Client::count();
    $userCount = User::count();

    $totalExpenses = Expense::sum('amount');
    $salary = Expense::where('type', 'salary')->sum('amount');
    $amount = $totalExpenses - $salary;

    $monthlyExpenses = Expense::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(amount) as total_amount')
    )
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total_amount', 'month');

    $monthlyPayments = ProjectPayment::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(amount) as total_amount')
    )
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total_amount', 'month');

    $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $labels = collect($months)->map(function ($month) {
        return date('F', mktime(0, 0, 0, $month, 1));
    })->toArray();

    $expensesData = collect($months)->map(function ($month) use ($monthlyExpenses) {
        return $monthlyExpenses->get($month, 0);
    });

    $paymentsData = collect($months)->map(function ($month) use ($monthlyPayments) {
        return $monthlyPayments->get($month, 0);
    });

    $projects = Project::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    $projectlabels = [];
    $projectdata = [];

    foreach ($projects as $project) {
        $projectlabels[] = Carbon::createFromDate($project->year, $project->month)->format('F Y');
        $projectdata[] = $project->count;
    }

    return view('dashboard', [
        'projectCount' => $projectCount,
        'clientCount' => $clientCount,
        'userCount' => $userCount,
        'pending' => $pending,
        'ongoing' => $ongoing,
        'delivered' => $delivered,
        'continued' => $continued,
        'expenses' => $totalExpenses,
        'salary' => $salary,
        'amount' => $amount,
        'labels' => $labels,
        'expensesData' => $expensesData,
        'paymentsData' => $paymentsData,
        'projectlabels' => $projectlabels,
        'projectdata' => $projectdata
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user-registrations-chart', [UserController::class, 'showUserRegistrations']);
    Route::resource('user', UserController::class);
    Route::get('user/{id}/show', [UserController::class, 'show'])->name('user.show');
    Route::resource('client', ClientController::class);
    Route::resource('project', ProjectController::class);
    Route::put('/project/{id}/status', [ProjectController::class, 'updateStatus'])->name('project.status');
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
    Route::put('/notes/{id}/updateNote', [ProjectController::class, 'updateNote'])->name('note.updateNote');
    Route::put('/task/{id}/updateTask', [ProjectController::class, 'updateTask'])->name('task.updateTask');
    Route::put('/feedback/{id}/updateFeedback', [ProjectController::class, 'updateFeedback'])->name('task.updateFeedback');
    Route::put('/issue/{id}/updateIssue', [ProjectController::class, 'updateIssue'])->name('task.updateIssue');
    Route::delete('/task/{id}/destroyTask', [ProjectController::class, 'destroyTask'])->name('task.destroyTask');
    Route::delete('/task/{id}/destroyNote', [ProjectController::class, 'destroyNote'])->name('task.destroyNote');
    Route::delete('/task/{id}/destroyFeedback', [ProjectController::class, 'destroyFeedback'])->name('task.destroyFeedback');
    Route::delete('/task/{id}/destroyIssue', [ProjectController::class, 'destroyIssue'])->name('task.destroyIssue');
    // Route::get('user', [UserController::class, 'index'])->name('users.index');
    // Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('profile-settings', [AdminController::class, 'profileSettings'])->name('profile-settings.edit');
    Route::put('adminUpdate', [AdminController::class, 'adminUpdate'])->name('adminUpdate.update');
    Route::put('updatePassword', [AdminController::class, 'updatePassword'])->name('updatePassword.update');
    Route::delete('adminDelete', [AdminController::class, 'adminDelete'])->name('adminDelete.delete');
    Route::resource('client', AdminClientController::class);
    Route::resource('project', AdminProjectController::class);
    Route::post('project/{projectId}/notes', [AdminProjectController::class, 'storeNote'])->name('project.store-note');
    Route::post('project/{projectId}/tasks', [AdminProjectController::class, 'storeTask'])->name('project.store-task');
    Route::post('project/users', [AdminProjectController::class, 'storeUser'])->name('project.store-user');
    Route::post('project/payment', [AdminProjectController::class, 'storePayment'])->name('project.store-payment');
    Route::post('project/{projectId}/feedback', [AdminProjectController::class, 'storeFeedback'])->name('project.store-feedback');
    Route::post('project/{projectId}/Issue', [AdminProjectController::class, 'storeIssue'])->name('project.store-issue');
    Route::put('/notes/{id}/updateNote', [AdminProjectController::class, 'updateNote'])->name('admin.note.updateNote');
    Route::put('/task/{id}/updateTask', [AdminProjectController::class, 'updateTask'])->name('admin.task.updateTask');
    Route::put('/feedback/{id}/updateFeedback', [AdminProjectController::class, 'updateFeedback'])->name('admin.task.updateFeedback');
    Route::put('/issue/{id}/updateIssue', [AdminProjectController::class, 'updateIssue'])->name('admin.task.updateIssue');
    Route::delete('/task/{id}/destroyTask', [AdminProjectController::class, 'destroyTask'])->name('task.destroyTask');
    Route::delete('/task/{id}/destroyNote', [AdminProjectController::class, 'destroyNote'])->name('note.destroyNote');
    Route::delete('/task/{id}/destroyFeedback', [AdminProjectController::class, 'destroyFeedback'])->name('feedback.destroyFeedback');
    Route::delete('/task/{id}/destroyIssue', [AdminProjectController::class, 'destroyIssue'])->name('issue.destroyIssue');
    Route::resource('task', AdminTaskController::class);
    Route::put('/task/{id}/status', [AdminTaskController::class, 'updateStatus'])->name('admin.task.status');
    Route::resource('payment', AdminPaymentController::class);
});

#0078ff

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('userDashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('getProject', [UserDashboardController::class, 'getProjects'])->name('getProject.index');
    Route::get('showProject/{project}', [UserDashboardController::class, 'showProjects'])->name('showProject.show');
    Route::get('getTask', [UserDashboardController::class, 'getTasks'])->name('getTask.index');
    // Route::get('showTask/{projectTasks}', [UserDashboardController::class, 'showTask'])->name('showTask.show');
    Route::get('showTask/{projectTask}', [UserDashboardController::class, 'showTask'])->name('showTask.show');
    Route::get('profile-settings', [UserDashboardController::class, 'profileSettings'])->name('user.profile-settings.edit');
    Route::put('user/update-profile', [UserDashboardController::class, 'updateProfile'])->name('user.update-profile');
    Route::put('userUpdate', [UserDashboardController::class, 'userUpdate'])->name('userUpdate.update');
    Route::put('updatePassword', [UserDashboardController::class, 'updatePassword'])->name('updatePassword.update');
    Route::delete('userDelete', [UserDashboardController::class, 'userDelete'])->name('userDelete.delete');
});

require __DIR__ . '/auth.php';
