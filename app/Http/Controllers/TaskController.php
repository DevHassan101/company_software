<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectTasks = ProjectTask::with('project', 'user')->paginate(10);
        return view('pages.tasks.index', compact('projectTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('pages.tasks.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $validation['admin_id'] = auth()->id();
        $validation['created_by'] = auth()->id();

        ProjectTask::create($validation);

        return redirect()->route('task.index')
            ->with('message', 'Project Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        return view('pages.tasks.show', compact('projectTask'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        $users = User::all();
        $projects = Project::all();
        return view('pages.tasks.edit', compact('projectTask', 'users', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $projectTask = ProjectTask::findOrFail($id);
        $validation = $request->validate([
            'project_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $validation['admin_id'] = auth()->id();
        $validation['created_by'] = auth()->id();

        $projectTask->update($validation);
        return redirect()->route('task.index')->with('message', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        $projectTask->delete();
        return redirect()->route('task.index')->with('message', 'Task Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $projectTask = ProjectTask::findOrFail($id);
            $projectTask->update(['status' => $request->status]);

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Status Updated Successfully'
                ]);
            }

            return redirect()->route('task.index')->with('message', 'Status Updated Successfully');
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
