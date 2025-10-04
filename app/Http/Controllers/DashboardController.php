<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Expense;
use App\Models\ProjectPayment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $projectStatusCounts = Project::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $pending   = $projectStatusCounts['pending'] ?? 0;
        $ongoing   = $projectStatusCounts['ongoing'] ?? 0;
        $delivered = $projectStatusCounts['delivered'] ?? 0;
        $continued = $projectStatusCounts['continued'] ?? 0;

        $projectCount = Project::count();

        $clientCount = Client::count();

        $userCount = User::count();

        $totalExpenses = Expense::sum('amount');

        $salary = Expense::where('type', 'salary')->sum('amount');

        $totalRemainExpenses = Expense::sum('amount');

        $amount = $totalRemainExpenses - $salary;

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

        $months = range(1, 12);
        $labels = collect($months)->map(fn($m) => date('F', mktime(0, 0, 0, $m, 1)))->toArray();

        $expensesData = collect($months)->map(fn($m) => $monthlyExpenses->get($m, 0));
        $paymentsData = collect($months)->map(fn($m) => $monthlyPayments->get($m, 0));

        $filteredData = Project::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        $projects = Project::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $projectlabels = [];
        $projectdata = [];
        foreach ($projects as $p) {
            $projectlabels[] = Carbon::createFromDate($p->year, $p->month)->format('F Y');
            $projectdata[] = $p->count;
        }

        $statusCounts = [
            'pending' => $filteredData['pending'] ?? 0,
            'ongoing' => $filteredData['ongoing'] ?? 0,
            'delivered' => $filteredData['delivered'] ?? 0,
            'continued' => $filteredData['continued'] ?? 0,
        ];

        return view('dashboard', [
            'projectCount'   => $projectCount,
            'clientCount'    => $clientCount,
            'userCount'      => $userCount,
            'pending'        => $pending,
            'ongoing'        => $ongoing,
            'delivered'      => $delivered,
            'continued'      => $continued,
            'expenses'       => $totalExpenses,
            'salary'         => $salary,
            'amount'         => $amount,
            'labels'         => $labels,
            'expensesData'   => $expensesData,
            'paymentsData'   => $paymentsData,
            'projectlabels'  => $projectlabels,
            'projectdata'    => $projectdata,
            'statusCounts'   => $statusCounts,
        ]);
    }

    public function filterData($filter, $model)
    {
        if ($model == 'projects') {
            $query = Project::query();
        } elseif ($model == 'clients') {
            $query = Client::query();
        } elseif ($model == "users") {
            $query = User::query();
        } elseif ($model == 'expenses') {
            $query = Expense::query();
        } elseif ($model == 'salary') {
            $query = Expense::where('type', 'salary');
        } elseif ($model == 'remain') {
            $expensesQuery = Expense::query();
            $salaryQuery   = Expense::where('type', 'salary');
        } else {
            return response()->json(['error' => 'Invalid model specified.'], 400);
        }
        $applyFilter = function ($q, $filter) {
            if ($filter == 'today') {
                $q->whereDate('created_at', now());
            } elseif ($filter == 'this_week') {
                $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter == 'this_month') {
                $q->whereMonth('created_at', now()->month);
            } elseif ($filter == 'this_year') {
                $q->whereYear('created_at', now()->year);
            } elseif ($filter == 'last_year') {
                $q->whereYear('created_at', now()->subYear()->year);
            }
        };
        if ($model == 'remain') {
            $applyFilter($expensesQuery, $filter);
            $applyFilter($salaryQuery, $filter);
            $totalExpenses = $expensesQuery->sum('amount');
            $salary        = $salaryQuery->sum('amount');
            $remain        = $totalExpenses - $salary;
            return response()->json([
                'total' => round($remain),
            ]);
        }

        $applyFilter($query, $filter);
        if ($model == 'expenses' || $model == 'salary') {
            return response()->json([
                'total' => round($query->sum('amount')),
            ]);
        }
        return response()->json([
            'count' => $query->count(),
        ]);
    }

    public function getChartData(Request $request)
    {
        $filter = $request->get('filter');
        $expensesQuery = Expense::query();
        $salaryQuery = Expense::where('type', 'salary');

        $applyFilter = function ($query, $filter) {
            if ($filter === 'today') {
                $query->whereDate('created_at', now());
            } elseif ($filter === 'this_week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'this_month') {
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            } elseif ($filter === 'this_year') {
                $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
            } elseif ($filter === 'last_year') {
                $query->whereBetween('created_at', [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()]);
            }
        };

        $applyFilter($expensesQuery, $filter);
        $applyFilter($salaryQuery, $filter);

        $totalExpenses = $expensesQuery->sum('amount');
        $totalPayments = $salaryQuery->sum('amount');

        return response()->json([
            'labels' => ['Filtered Data'],
            'expensesData' => [$totalExpenses],
            'paymentsData' => [$totalPayments],
        ]);
    }

    public function filter(Request $request)
    {
        $filter = $request->get('filter');
        $projectsCount = 0;
        $clientsCount = 0;
        $usersCount = 0;
        $expensesTotal = 0;
        $salaryTotal = 0;
        $remainAmount = 0;

        $applyFilter = function ($query) use ($filter) {
            if ($filter === 'today') {
                $query->whereDate('created_at', now());
            } elseif ($filter === 'this_week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'this_month') {
                $query->whereMonth('created_at', now()->month);
            } elseif ($filter === 'this_year') {
                $query->whereYear('created_at', now()->year);
            } elseif ($filter === 'last_year') {
                $query->whereYear('created_at', now()->subYear()->year);
            }
        };

        if ($filter) {
            $projectsCount = tap(Project::query(), $applyFilter)->count();
            $clientsCount = tap(Client::query(), $applyFilter)->count();
            $usersCount = tap(User::query(), $applyFilter)->count();
            $expensesQuery = Expense::query();
            $applyFilter($expensesQuery);
            $expensesTotal = $expensesQuery->sum('amount');
            $salaryQuery = Expense::where('type', 'salary');
            $applyFilter($salaryQuery);
            $salaryTotal = $salaryQuery->sum('amount');

            $remainAmount = $expensesTotal - $salaryTotal;
        } else {
            $projectsCount = Project::count();
            $clientsCount = Client::count();
            $usersCount = User::count();
            $expensesTotal = Expense::sum('amount');
            $salaryTotal = Expense::where('type', 'salary')->sum('amount');
            $remainAmount = $expensesTotal - $salaryTotal;
        }

        return response()->json([
            'projectCount' => $projectsCount,
            'clientCount' => $clientsCount,
            'userCount' => $usersCount,
            'expenseTotal' => round($expensesTotal),
            'salaryTotal' => round($salaryTotal),
            'remainAmount' => round($remainAmount),
        ]);
    }

    public function getProjectChartData(Request $request)
    {
        $filter = $request->get('filter');
        $projectsQuery = Project::query();
        $applyFilter = function ($query) use ($filter) {
            if ($filter === 'today') {
                $query->whereDate('created_at', now());
            } elseif ($filter === 'this_week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'this_month') {
                $query->whereMonth('created_at', now()->month);
            } elseif ($filter === 'this_year') {
                $query->whereYear('created_at', now()->year);
            } elseif ($filter === 'last_year') {
                $query->whereYear('created_at', now()->subYear()->year);
            }
        };
        if ($filter) {
            $applyFilter($projectsQuery);
        }
        $projectCount = $projectsQuery->count();
        return response()->json([
            'labels' => [$filter ? ucfirst($filter) : 'All Projects'],
            'data' => [$projectCount],
        ]);
    }

    public function getStatusOverviewData(Request $request)
    {
        $filter = $request->get('filter');

        $applyFilter = function ($query) use ($filter) {
            if ($filter === 'today') {
                $query->whereDate('created_at', now());
            } elseif ($filter === 'this_week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'this_month') {
                $query->whereMonth('created_at', now()->month);
            } elseif ($filter === 'this_year') {
                $query->whereYear('created_at', now()->year);
            } elseif ($filter === 'last_year') {
                $query->whereYear('created_at', now()->subYear()->year);
            }
        };

        $projectsQuery = Project::query();
        $applyFilter($projectsQuery);
        $statusCounts = $projectsQuery
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
        $labels = array_keys($statusCounts);
        $data = array_values($statusCounts);
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
