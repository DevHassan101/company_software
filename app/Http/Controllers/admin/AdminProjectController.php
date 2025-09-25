<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectFeedback;
use App\Models\ProjectIssue;
use App\Models\ProjectNote;
use App\Models\User;
use App\Models\ProjectTask;
use App\Models\ProjectTaskUser;
use App\Models\ProjectUser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('client', 'projectUsers')->paginate(10);
        if ($request->ajax()) {
            return response()->json();
        }
        return view('admin.pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $users = User::all();

        return view('admin.pages.projects.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'requirments' => 'nullable',
            'client_id' => 'required|integer',
            'started_at' => 'required|date',
            'delivered_at' => 'required|date',
            'delivery_date' => 'required|date',
            'budget' => 'nullable|numeric',
        ]);

        $validatedData['created_by'] = auth()->id();

        $project = Project::create($validatedData);

        if ($request->has('admin_ids') && $request->input('admin_ids')) {
            foreach ($request->input('admin_ids') as $index => $adminId) {
                ProjectUser::create([
                    'project_id' => $project->id,
                    'user_id' => $request->input('admin_ids')[$index],
                    'created_by' => auth()->id()
                ]);
            }
        }

        return redirect()->route('admin.project.index')->with('success', 'Project Created Successfully');
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
            ->with('user', 'project', 'createdBy')
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

        return view('admin.pages.projects.view', compact('project', 'users', 'projectNotes', 'projectTasks', 'projectFeedbacks', 'projectIssues'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $project = Project::with('projectUsers.user')->findOrFail($id);
        $clients = Client::all();
        $users = User::all();
        return view('admin.pages.projects.edit', compact('project', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'requirments' => 'nullable',
            'client_id' => 'required|integer',
            'started_at' => 'required|date',
            'delivered_at' => 'required|date',
            'delivery_date' => 'required|date',
            'budget' => 'nullable|numeric',
        ]);

        $project->update($validation);

        if ($request->has('admin_ids') && $request->input('admin_ids')) {
            $project->projectUsers()->delete();
            foreach ($request->input('admin_ids') as $index => $adminId) {
                ProjectUser::create([
                    'project_id' => $project->id,
                    'user_id' => $request->input('admin_ids')[$index],
                    'created_by' => auth()->id()
                ]);
            }
        }

        return redirect()->route('admin.project.index')->with('success', 'Project Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'Project Deleted Successfully');
    }


    // project notes function start
    public function storeNote(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'media.*' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'noteErrors')->withInput();
        }

        $project = Project::findOrFail($projectId);
        $validatedData = $validator->validated();
        $validatedData['created_by'] = auth()->id();
        $validatedData['project_id'] = $projectId;

        $mediaPaths = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/project/media'), $name_gen);
                $mediaPaths[] = 'uploads/project/media/' . $name_gen;
            }
        }

        $validatedData['media'] = json_encode($mediaPaths);
        ProjectNote::create($validatedData);

        return redirect()->route('admin.project.show', ['project' => $project])->with('success', 'Project Notes Created Successfully');
    }

    // public function updateNote(Request $request, $id)
    // {
    //     $note = ProjectNote::findOrFail($id);

    //     $validator = Validator::make($request->all(), [
    //         'note' => 'required|string',
    //         'media.*' => 'nullable'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator, 'noteErrors')->withInput();
    //     }

    //     $validatedData = $validator->validated();

    //     $mediaPaths = [];
    //     if ($request->hasFile('media')) {
    //         if ($note->image && file_exists(public_path($note->image))) {
    //             foreach ($request->file('media') as $file) {
    //                 $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
    //                 $file->move(public_path('uploads/project/media'), $name_gen);
    //                 $mediaPaths[] = 'uploads/project/media/' . $name_gen;
    //             }
    //         }
    //     }

    //     $note->update($validatedData);

    //     return redirect()->route('project.show', ['project' => $note->project_id])
    //         ->with('success', 'Note updated successfully!');
    // }

    public function updateNote(Request $request, string $id)
    {

        $note = ProjectNote::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'media.*' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'noteErrors')->withInput();
        }

        $validatedData = $validator->validated();
        $mediaPaths = [];

        if ($request->hasFile('media')) {
            if ($note->media) {
                $oldMediaPaths = json_decode($note->media, true);
                if (is_array($oldMediaPaths)) {
                    foreach ($oldMediaPaths as $path) {
                        if (File::exists(public_path($path))) {
                            File::delete(public_path($path));
                        }
                    }
                }
            }

            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/project/media/' . $name_gen;
                $file->move(public_path('uploads/project/media'), $name_gen);
                $mediaPaths[] = $path;
            }

            $validatedData['media'] = json_encode($mediaPaths);
        }

        $note->update($validatedData);

        return redirect()->route('admin.project.show', ['project' => $note->project_id])
            ->with('success', 'Note updated successfully!');
    }




    public function destroyNote(Request $request, $id)
    {
        $note = ProjectNote::findOrFail($id);
        $projectId = $note->project_id;

        $note->delete();

        return redirect()->route('admin.project.show', ['project' => $projectId])
            ->with('success', 'Note Deleted Successfully');
    }

    // project notes function end

    // project tasks function start
    public function storeTask(Request $request, $projectId)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'taskErrors')->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['admin_id'] = auth()->id();
        $validatedData['created_by'] = auth()->id();
        $validatedData['project_id'] = $projectId;

        $projectTask =  ProjectTask::create($validatedData);

        if ($request->has('admin_ids') && $request->input('admin_ids')) {
            foreach ($request->input('admin_ids') as $index => $adminId) {
                ProjectTaskUser::create([
                    'task_id' => $projectTask->id,
                    'user_id' => $adminId,
                    'created_by' => auth()->id()
                ]);
            }
        }

        return redirect()->route('admin.project.show', ['project' => $projectId])
            ->with('success', 'Project Task Created Successfully');
    }

    public function updateTask(Request $request, $id)
    {

        $task = ProjectTask::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'taskErrors')->withInput();
        }

        $task->update($validator->validated());

        if ($request->has('admin_ids') && $request->input('admin_ids')) {
            $task->projectTaskUsers()->delete();
            foreach ($request->input('admin_ids') as $index => $adminId) {
                ProjectTaskUser::create([
                    'task_id' => $task->id,
                    'user_id' => $request->input('admin_ids')[$index],
                    'created_by' => $task->id
                ]);
            }
        }

        return redirect()->route('admin.project.show', ['project' => $task->project_id])
            ->with('success', 'Task updated successfully!');
    }

    public function destroyTask(Request $request, $id)
    {
        $task = ProjectTask::findOrFail($id);

        $projectId = $task->project_id;

        $task->delete();

        return redirect()->route('admin.project.show', ['project' => $projectId])
            ->with('success', 'Task Deleted Successfully');
    }


    // project tasks function end

    // project feedback function start
    public function storeFeedback(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'media.*' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'feedbackErrors')->withInput();
        }

        $project = Project::findOrFail($projectId);
        $validatedData = $validator->validated();
        $validatedData['created_by'] = auth()->id();
        $validatedData['project_id'] = $projectId;

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/feedback', $name_gen);
                $mediaPaths[] = 'uploads/project/feedback/' . $name_gen;
            }
        }

        $validatedData['media'] = json_encode($mediaPaths);

        ProjectFeedback::create($validatedData);

        return redirect()->route('admin.project.show', ['project' => $project])
            ->with('success', 'Project Feedback Created Successfully');
    }

    public function updateFeedback(Request $request, $id)
    {

        $feedback = ProjectFeedback::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'note' => 'required|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'feedbackErrors')->withInput();
        }

        $validatedData = $validator->validated();
        $newMediaPaths = [];
        if ($request->hasFile('media')) {
            if ($feedback->media) {
                $oldMediaPaths = json_decode($feedback->media, true);
                if (is_array($oldMediaPaths)) {
                    foreach ($oldMediaPaths as $oldPath) {
                        if (File::exists(public_path($oldPath))) {
                            File::delete(public_path($oldPath));
                        }
                    }
                }
            }
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/project/media/' . $name_gen;
                $file->move(public_path('uploads/project/media'), $name_gen);
                $newMediaPaths[] = $path;
            }

            $validatedData['media'] = json_encode($newMediaPaths);
        }
        $feedback->update($validatedData);
        return redirect()->route('admin.project.show', ['project' => $feedback->project_id])
            ->with('success', 'Feedback updated successfully!');
    }

    public function destroyFeedback($id)
    {
        $feedback = ProjectFeedback::findOrFail($id);

        $projectId = $feedback->project_id;

        $feedback->delete();

        return redirect()->route('admin.project.show', ['project' => $projectId])
            ->with('success', 'Feedback Deleted Successfully');
    }

    // project feedback function end

    // project issue function start
    public function storeIssue(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'media.*' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'issuekErrors')->withInput();
        }

        $project = Project::findOrFail($projectId);
        $validatedData = $validator->validated();
        $validatedData['created_by'] = auth()->id();
        $validatedData['project_id'] = $projectId;

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/issue', $name_gen);
                $mediaPaths[] = 'uploads/project/issue/' . $name_gen;
            }
        }

        $validatedData['media'] = json_encode($mediaPaths);

        ProjectIssue::create($validatedData);

        return redirect()
            ->route('admin.project.show', ['project' => $project])
            ->with('success', 'Project Issue Created Successfully');
    }

    public function updateIssue(Request $request, $id)
    {

        $issue = ProjectIssue::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'note' => 'required|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'issueErrors')->withInput();
        }

        $validatedData = $validator->validated();
        $newMediaPaths = [];

        if ($request->hasFile('media')) {
            if ($issue->media) {
                $oldMediaPaths = json_decode($issue->media, true);
                if (is_array($oldMediaPaths)) {
                    foreach ($oldMediaPaths as $oldPath) {
                        if (File::exists(public_path($oldPath))) {
                            File::delete(public_path($oldPath));
                        }
                    }
                }
            }

            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/project/media/' . $name_gen;
                $file->move(public_path('uploads/project/media'), $name_gen);
                $newMediaPaths[] = $path;
            }

            $validatedData['media'] = json_encode($newMediaPaths);
        }

        if (!$request->hasFile('media') && $issue->media) {
            $validatedData['media'] = $issue->media;
        }
        $issue->update($validatedData);
        return redirect()->route('admin.project.show', ['project' => $issue->project_id])
            ->with('success', 'Issue updated successfully!');
    }



    public function destroyIssue(Request $request, $id)
    {
        $issue = ProjectIssue::findOrFail($id);

        $projectId = $issue->project_id;

        $issue->delete();

        return redirect()->route('admin.project.show', ['project' => $projectId])
            ->with('success', 'Issue Deleted Successfully');
    }

    // project issue function start
}
