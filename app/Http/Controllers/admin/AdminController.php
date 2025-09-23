<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectPayment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $projectCount = Project::count();
        $clientCount = Client::count();
        $userCount = User::count();

        return view('admin.pages.dashboard', [
            'projectCount' => $projectCount,
            'clientCount' => $clientCount,
            'userCount' => $userCount
        ]);
    }

    public function showClient(Request $request)
    {
        $user = Auth::user();
        $clients = Client::orderBy('name', 'DESC')->paginate(10);

        if ($request->ajax()) {
            $html = view('pages.clients.table', compact('clients'))->render();
            $records = $clients;
            $pagination = view('pages.appends.pagination', compact('records'))->render();
            return response()->json([
                'error' => false,
                'html' => $html,
                'pagination' => $pagination
            ]);
        }
        return view('admin.pages.clients.index', compact('clients'));
    }

    public function showProject(Request $request)
    {

        $user = Auth::user();
        $projects = Project::with('client')->paginate(10);

        if ($request->ajax()) {
            return response()->json();
        }
        return view('admin.pages.projects.index', compact('projects'));
    }

    public function showTask(Request $request)
    {
        $user = Auth::user();
        $projectTasks = ProjectTask::with('project', 'user')->paginate(10);
        return view('admin.pages.tasks.index', compact('projectTasks'));
    }

    public function showPayment(Request $request)
    {
        $payments = ProjectPayment::with('project')->latest()->paginate(10);
        return view('admin.pages.payments.index', compact('payments'));
    }
}
