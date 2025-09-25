<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectTask;
use App\Models\ProjectTaskUser;
use App\Models\Project;

class AdminTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectTasks = ProjectTask::with('project', 'projectTaskUsers')->paginate(10);
        return view('admin.pages.tasks.index', compact('projectTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('admin.pages.tasks.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $validation['admin_id'] = auth()->id();
        $validation['created_by'] = auth()->id();

        $projectTask = ProjectTask::create($validation);

        if ($request->has('admin_ids') && $request->input('admin_ids')) {
            foreach ($request->input('admin_ids') as $index => $adminId) {
                ProjectTaskUser::create([
                    'task_id' => $projectTask->id,
                    'user_id' => $request->input('admin_ids')[$index],
                    'created_by' => $projectTask->id
                ]);
            }
        }

        return redirect()->route('admin.task.index')
            ->with('success', 'Project Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        return view('admin.pages.tasks.show', compact('projectTask'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projectTask = ProjectTask::with('projectTaskUsers.user')->findOrFail($id);
        $users = User::all();
        $projects = Project::all();
        return view('admin.pages.tasks.edit', compact('projectTask', 'users', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $projectTask = ProjectTask::findOrFail($id);
        $validation = $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $validation['admin_id'] = auth()->id();
        $validation['created_by'] = auth()->id();

        $projectTask->update($validation);

        if ($request->has('admin_ids') && $request->input('admin_ids')) {
            $projectTask->projectTaskUsers()->delete();
            foreach ($request->input('admin_ids') as $index => $adminId) {
                ProjectTaskUser::create([
                    'task_id' => $projectTask->id,
                    'user_id' => $request->input('admin_ids')[$index],
                    'created_by' => $projectTask->id
                ]);
            }
        }

        return redirect()->route('admin.task.index')->with('success', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        $projectTask->delete();
        return redirect()->route('admin.task.index')->with('success', 'Task Deleted Successfully');
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

            return redirect()->route('admin.task.index')->with('success', 'Status Updated Successfully');
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
