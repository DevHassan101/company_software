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
    public function index(Request $request)
    {
        $projectStatusCounts = Project::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $expense = Expense::query();
        $projectPayment = ProjectPayment::query();
        $query = Project::query();
        $projetFilter = Project::query();

        if ($request->filled('filter')) {
            if ($request->filter == 'today') {
                $expense->whereDay('created_at', now());
                $projectPayment->whereDay('created_at', now());
                $query->whereDay('created_at', now());
                $projetFilter->whereDay('created_at', now());
            } else if ($request->filter == 'this_week') {
                $startWeek = Carbon::now()->startOfWeek();
                $endWeek = Carbon::now()->endOfWeek();
                $expense->whereBetween('created_at', [$startWeek, $endWeek]);
                $projectPayment->whereBetween('created_at', [$startWeek, $endWeek]);
                $query->whereBetween('created_at', [$startWeek, $endWeek]);
                $projetFilter->whereBetween('created_at', [$startWeek, $endWeek]);
            } else if ($request->filter == 'this_month') {
                $expense->whereMonth('created_at', Carbon::now());
                $projectPayment->whereMonth('created_at', Carbon::now());
                $query->whereMonth('created_at', Carbon::now());
                $projetFilter->whereMonth('created_at', Carbon::now());
            } else if ($request->filter == 'this_year') {
                $expense->whereYear('created_at', Carbon::now());
                $projectPayment->whereYear('created_at', Carbon::now());
                $query->whereYear('created_at', Carbon::now());
                $projetFilter->whereYear('created_at', Carbon::now());
            } else if ($request->filter == 'last_year') {
                $expense->whereYear('created_at', now()->subYear()->year);
                $projectPayment->whereYear('created_at', now()->subYear()->year);
                $query->whereYear('created_at', now()->subYear()->year);
                $projetFilter->whereYear('created_at', now()->subYear()->year);
            }
        }

        $pending   = $projectStatusCounts['pending'] ?? 0;
        $ongoing   = $projectStatusCounts['ongoing'] ?? 0;
        $delivered = $projectStatusCounts['delivered'] ?? 0;
        $continued = $projectStatusCounts['continued'] ?? 0;

        $totalProject = Project::query();
        if ($request->filled('totalProject')) {
            if ($request->totalProject == 'today') {
                $totalProject->whereDate('created_at', now());
            } else if ($request->totalProject == 'this_week') {
                $totalProject->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->totalProject == 'this_month') {
                $totalProject->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month);
            } else if ($request->totalProject == 'this_year') {
                $totalProject->whereYear('created_at', now()->year);
            } else if ($request->totalProject == 'last_year') {
                $totalProject->whereYear('created_at', now()->subYear()->year);
            }
        }
        $projectCount = $totalProject->count();

        $totalClient = Client::query();
        if ($request->filled('client')) {
            if ($request->client == 'today') {
                $totalClient->whereDate('created_at', now());
            } else if ($request->client == 'this_week') {
                $totalClient->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->client == 'this_month') {
                $totalClient->whereMonth('created_at', now()->month);
            } else if ($request->client == 'this_year') {
                $totalClient->whereYear('created_at', now()->year);
            } else if ($request->client == 'last_year') {
                $totalClient->whereYear('created_at', now()->subYear()->year);
            }
        }
        $clientCount = $totalClient->count();

        $totalUser = User::query();
        if ($request->filled('totalUser')) {
            if ($request->totalUser == 'today') {
                $totalUser->whereDate('created_at', now());
            } else if ($request->totalUser == 'this_week') {
                $totalUser->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->totalUser == 'this_month') {
                $totalUser->whereMonth('created_at', now()->month);
            } else if ($request->totalUser == 'this_year') {
                $totalUser->whereYear('created_at', now()->year);
            } else if ($request->totalUser == 'last_year') {
                $totalUser->whereYear('created_at', now()->subYear()->year);
            }
        }
        $userCount = $totalUser->count();

        $getTotal = Expense::query();
        if ($request->filled('totalAmount')) {
            if ($request->totalAmount == 'today') {
                $getTotal->whereDate('created_at', now());
            } else if ($request->totalAmount == 'this_week') {
                $getTotal->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->totalAmount == 'this_month') {
                $getTotal->whereMonth('created_at', now()->month);
            } else if ($request->totalAmount == 'this_year') {
                $getTotal->whereYear('created_at', now()->year);
            } else if ($request->totalAmount == 'last_year') {
                $getTotal->whereYear('created_at', now()->subYear()->year);
            }
        }
        $totalExpenses = $getTotal->sum('amount');

        $getSalary = Expense::query();
        if ($request->filled('totalSalary')) {
            if ($request->totalSalary == 'today') {
                $getSalary->whereDate('created_at', now());
            } else if ($request->totalSalary == 'this_week') {
                $getSalary->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->totalSalary == 'this_month') {
                $getSalary->whereMonth('created_at', now()->month);
            } else if ($request->totalSalary == 'this_year') {
                $getSalary->whereYear('created_at', now()->year);
            } else if ($request->totalSalary == 'last_year') {
                $getSalary->whereYear('created_at', now()->subYear()->year);
            }
        }
        $salary = $getSalary->where('type', 'salary')->sum('amount');

        $remainQuery = Expense::query();
        if ($request->filled('totalRemain')) {
            if ($request->totalRemain == 'today') {
                $remainQuery->whereDate('created_at', now());
            } elseif ($request->totalRemain == 'this_week') {
                $remainQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($request->totalRemain == 'this_month') {
                $remainQuery->whereMonth('created_at', now()->month);
            } elseif ($request->totalRemain == 'this_year') {
                $remainQuery->whereYear('created_at', now()->year);
            } elseif ($request->totalRemain == 'last_year') {
                $remainQuery->whereYear('created_at', now()->subYear()->year);
            }
        }
        $totalRemainExpenses = $remainQuery->sum('amount');
        $amount = $totalRemainExpenses - $salary;

        $monthlyExpenses = $expense->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_amount', 'month');

        $monthlyPayments = $projectPayment->select(
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

        if ($request->filled('option')) {
            if ($request->option == 'today') {
                $query->whereDay('created_at', now());
            } else if ($request->option == 'this_week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->option == 'this_month') {
                $query->whereMonth('created_at', Carbon::now());
            } else if ($request->option == 'this_year') {
                $query->whereYear('created_at', Carbon::now());
            } else if ($request->option == 'last_year') {
                $query->whereYear('created_at', now()->subYear()->year);
            }
        }

        $filteredData = $query->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        if ($request->filled('project')) {
            if ($request->project == 'today') {
                $projetFilter->whereDay('created_at', now());
            } else if ($request->project == 'this_week') {
                $projetFilter->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } else if ($request->project == 'this_month') {
                $projetFilter->whereMonth('created_at', Carbon::now());
            } else if ($request->project == 'this_year') {
                $projetFilter->whereYear('created_at', Carbon::now());
            } else if ($request->project == 'last_year') {
                $projetFilter->whereYear('created_at', now()->subYear()->year);
            }
        }

        $projects = $projetFilter->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as count')
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
}
