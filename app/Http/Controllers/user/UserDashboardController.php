<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectNote;
use App\Models\ProjectFeedback;
use App\Models\ProjectIssue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rule;

class UserDashboardController extends Controller
{
    public function index()
    {

        return view('user.pages.dashboard');
    }

    public function getProjects()
    {
        $user = Auth::user();
        $projects = $user->projects;

        return view('user.pages.projects.index', compact('projects'));
    }

    public function showProjects(string $id)
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
        return view('user.pages.projects.view', compact('project', 'users', 'projectNotes', 'projectTasks', 'projectFeedbacks', 'projectIssues'));
    }


    public function getTasks()
    {
        $user = Auth::user();
        $projectTasks = $user->projectTasks;
        return view('user.pages.tasks.index', compact('projectTasks'));
    }


    public function showTask(string $id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        return view('user.pages.tasks.show', compact('projectTask'));
    }

    public function profileSettings()
    {
        $user = Auth::user();
        return view('user.pages.profile-setting', compact('user'));
    }



    public function userUpdate(ProfileUpdateRequest $request)
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return back()->with('success', 'user update successfully');

    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password'  => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'password update successfully');
    }

    public function userDelete(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return Redirect::to('/');
    }
}
