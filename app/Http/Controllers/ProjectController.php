<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectFeedback;
use App\Models\ProjectIssue;
use App\Models\ProjectNote;
use App\Models\ProjectPayment;
use App\Models\ProjectTask;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('client')->paginate(10);

        if ($request->ajax()) {
            return response()->json();
        }
        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $users = User::all();

        return view('pages.projects.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'requirments' => 'required',
            'client_id' => 'required|integer',
            'started_at' => 'required|date',
            'delivered_at' => 'required|date',
            'delivery_date' => 'required|date',
            'admin_id' => 'required|integer',
            'budget' => 'required|numeric',
        ]);

        $validation['created_by'] = auth()->id();

        Project::create($validation);

        return redirect()->route('project.index')->with('success', 'Project Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();

        $projectNotes = ProjectNote::where('project_id', $id)
            ->with('user', 'project')
            ->orderBy('created_at', 'desc')
            ->get();

        $projectTasks = ProjectTask::where('project_id', $id)
            ->with('user', 'project')
            ->orderBy('created_at', 'desc')
            ->get();

        $projectFeedbacks = ProjectFeedback::where('project_id', $id)
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->get();

        $projectIssues = ProjectIssue::where('project_id', $id)
            ->with('user', 'project')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.projects.view', compact('project', 'users', 'projectNotes', 'projectTasks', 'projectFeedbacks', 'projectIssues'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $project = Project::findOrFail($id);
        $clients = Client::all();
        $users = User::all();
        return view('pages.projects.edit', compact('project', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'requirments' => 'required',
            'client_id' => 'required|integer',
            'started_at' => 'required|date',
            'delivered_at' => 'required|date',
            'delivery_date' => 'required|date',
            'admin_id' => 'required|integer',
            'budget' => 'required|numeric',
        ]);

        $project->update($validation);

        return redirect()->route('project.index')->with('success', 'Project Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project Deleted Successfully');
    }


    // project notes function start
    public function storeNote(Request $request, $projectId)
    {
        $validation = $request->validate([
            'note' => 'required',
            'media' => 'nullable',
        ]);
        $project = Project::findOrFail($projectId);
        $validation['created_by'] = auth()->id();
        $validation['project_id'] = $projectId;
        
        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/media', $name_gen);
                $mediaPaths[] = 'uploads/project/media/' . $name_gen;
            }
        }

        $validation['media'] = json_encode($mediaPaths);

        ProjectNote::create($validation);

        return redirect()->route('project.show', ['project' => $project])->with('success', 'Project Notes Created Successfully');
    }


    // project notes function end

    // project tasks function start
    public function storeTask(Request $request, $projectId)
    {
        $validation = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $validation['admin_id'] = auth()->id();
        $validation['created_by'] = auth()->id();
        $validation['project_id'] = $projectId;

        ProjectTask::create($validation);

        return redirect()->route('project.show', ['project' => $projectId])
            ->with('success', 'Project Task Created Successfully');
    }

    // project tasks function end

    // project users function start
    // public function storeUser(Request $request)
    // {
    //     $validation = $request([
    //         'project_id' => 'required',
    //         'user_id' => 'required',
    //     ]);

    //     $project = Project::findOrFail($request->project_id);
    //     $validation['created_by'] = auth()->id();
    //     ProjectUser::create($validation);
    //     return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    // }
    // project users function end

    // project payment function start
    // public function storePayment(Request $request)
    // {
    //     $validation = $request->validate([
    //         'project_id' => 'required',
    //         'amount' => 'required',
    //         'note' => 'required',
    //         'media' => 'required',
    //     ]);

    //     $project = Project::findOrFail($request->project_id);
    //     $validation['created_by'] = auth()->id();

    //     ProjectPayment::create($validation);

    //     return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    // }
    // project payment function end

    // project feedback function start
    public function storeFeedback(Request $request, $projectId)
    {
        $validation = $request->validate([
            'note' => 'required',
            'media.*' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi|max:5120',
            'status' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $validation['created_by'] = auth()->id();
        $validation['project_id'] = $projectId;

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/feedback', $name_gen);
                $mediaPaths[] = 'uploads/project/feedback/' . $name_gen;
            }
        }

        $validation['media'] = json_encode($mediaPaths);

        ProjectFeedback::create($validation);

        return redirect()->route('project.show', ['project' => $project])
            ->with('success', 'Project Feedback Created Successfully');
    }

    // project feedback function end

    // project issue function start
    public function storeIssue(Request $request, $projectId)
    {
        $validation = $request->validate([
            'note' => 'required',
            'media' => 'required'
        ]);

        $project = Project::findOrFail($projectId);
        $validation['created_by'] = auth()->id();
        $validation['project_id'] = $projectId;

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/issue', $name_gen);
                $mediaPaths[] = 'uploads/project/issue/' . $name_gen;
            }
        }

        $validation['media'] = json_encode($mediaPaths);

        ProjectIssue::create($validation);

        return redirect()
            ->route('project.show', ['project' => $project])
            ->with('success', 'Project Issue Created Successfully');
    }


    // public function storeIssue(Request $request, $projectId)
    // {

    //     $validation = $request->validate([
    //         'note' => 'required',
    //         'media' => 'required'
    //     ]);

    //     $project = Project::findOrFail($request->project_id);
    //     $validation['created_by'] = auth()->id();
    //     $validation['project_id'] = $projectId;

    //     $mediaPaths = [];

    //     if ($request->hasFile('media')) {
    //         foreach ($request->file('media') as $file) {
    //             $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
    //             $file->move('uploads/project/issue', $name_gen);
    //             $mediaPaths[] = 'uploads/project/issue/' . $name_gen;
    //         }
    //     }

    //     $validation['media'] = json_encode($mediaPaths);

    //     ProjectIssue::create($validation);

    //     return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Issue Created Successfully');
    // }
    // project issue function end

    
}
