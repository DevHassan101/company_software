<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
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
    public function index()
    {
        $projects = Project::with('client')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $users = User::all();

        return view('projects.create', compact('clients', 'users'));
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

        return redirect()->route('project.index')->with('message', 'Project Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        return view('projects.view', compact('project', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $project = Project::findOrFail($id);
        $clients = Client::all();
        $users = User::all();
        return view('projects.edit', compact('project', 'clients', 'users'));
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

        return redirect()->route('project.index')->with('message', 'Project Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('project.index')->with('message', 'Project Created Successfully');
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

        if ($request->hasFile('media')) {
            $image = $request->file('media');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/project/media', $name_gen);
            $validation['media'] = 'uploads/project/media/' . $name_gen;
        }

        ProjectNote::create($validation);

        return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    }
    // project notes function end

    // project tasks function start
    public function  storeTask(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'admin_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $validation['created_by'] = auth()->id();
        $project = Project::findOrFail($request->project_id);
        ProjectTask::create($validation);

        return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    }
    // project tasks function end

    // project users function start
    public function storeUser(Request $request)
    {
        $validation = $request([
            'project_id' => 'required',
            'user_id' => 'required',
        ]);

        $project = Project::findOrFail($request->project_id);
        $validation['created_by'] = auth()->id();
        ProjectUser::create($validation);
        return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    }
    // project users function end

    // project payment function start
    public function storePayment(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'amount' => 'required',
            'note' => 'required',
            'media' => 'required',
        ]);

        $project = Project::findOrFail($request->project_id);
        $validation['created_by'] = auth()->id();

        ProjectPayment::create($validation);

        return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    }
    // project payment function end

    // project feedback function start
    public function storeFeedback(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'note' => 'required',
            'media' => 'required',
            'status' => 'required'
        ]);

        $project = Project::findOrFail($request->project_id);
        $validation['created_by'] = auth()->id();
        return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    }
    // project feedback function end

    // project issue function start
    public function storeIssue(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'note' => 'required',
            'media' => 'required'
        ]);

        $project = Project::findOrFail($request->project_id);
        $validation['created_by'] = auth()->id();
        return redirect()->route('project.show', ['project' => $project])->with('message', 'Project Notes Created Successfully');
    }
    // project issue function end
}
